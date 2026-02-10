// signal-server-offline.js - ЗВОНИМ ВСЕГДА
const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const cors = require('cors');
const mysql = require('mysql2/promise');

const app = express();
app.use(cors({
    origin: '*',
    methods: ['GET', 'POST']
}));

// Конфигурация БД (адаптируй под свою)
const dbConfig = {
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'your_database',
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
};

const pool = mysql.createPool(dbConfig);

// Middleware для БД
app.use(async (req, res, next) => {
    try {
        req.db = await pool.getConnection();
        req.db.release();
        next();
    } catch (err) {
        next(err);
    }
});

// Для отладки
app.get('/', (req, res) => {
    res.json({ status: 'ok', message: 'WebRTC Signal Server - ALWAYS CALL' });
});

const server = http.createServer(app);
const io = new Server(server, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST']
    },
    transports: ['websocket', 'polling'],
    pingTimeout: 60000,
    pingInterval: 25000
});

// Хранилище пользователей и их соединений
const userConnections = new Map(); // userId -> socketId
const activeCalls = new Map(); // callId -> call data

io.on('connection', (socket) => {
    console.log('🔗 Новое соединение:', socket.id);

    // Регистрация пользователя
    socket.on('register', async (userId) => {
        userConnections.set(userId, socket.id);
        console.log(`✅ Пользователь ${userId} зарегистрирован`);
        
        // Проверяем есть ли ожидающие звонки для этого пользователя
        await checkPendingCalls(userId, socket);
        
        socket.emit('registered', { userId });
    });

    // Запрос на звонок - ВСЕГДА отправляем
    socket.on('call-user', async (data) => {
        const { from, to, offer, type, call_id } = data;
        
        console.log(`📞 Запрос звонка от ${from} к ${to}, ID: ${call_id}`);
        
        // Сохраняем звонок в активные
        activeCalls.set(call_id, {
            from,
            to,
            offer,
            type,
            status: 'waiting',
            timestamp: Date.now()
        });
        
        // Сохраняем в БД
        try {
            const [db] = await pool.getConnection();
            await db.execute(
                'INSERT INTO active_calls (call_id, from_id, to_id, type, offer, status) VALUES (?, ?, ?, ?, ?, ?)',
                [call_id, from, to, type, JSON.stringify(offer), 'waiting']
            );
            db.release();
        } catch (err) {
            console.error('Ошибка сохранения звонка в БД:', err);
        }
        
        // Проверяем подключен ли получатель
        const targetSocketId = userConnections.get(to);
        
        if (targetSocketId) {
            // Пользователь онлайн - отправляем звонок сразу
            console.log(`🎯 Пользователь ${to} онлайн, отправляю звонок`);
            io.to(targetSocketId).emit('incoming-call', {
                from: from,
                offer: offer,
                type: type,
                call_id: call_id
            });
            
            // Обновляем статус звонка на "звонит"
            socket.emit('call-ringing', { call_id, to });
        } else {
            // Пользователь офлайн - сохраняем звонок и ждем
            console.log(`⏳ Пользователь ${to} офлайн, сохраняю звонок`);
            socket.emit('call-waiting', { 
                call_id, 
                to,
                message: 'Пользователь не в сети. Звонок будет доставлен при подключении.'
            });
        }
        
        socket.emit('call-sent', { to, call_id });
    });

    // Пользователь переподключился - проверяем ожидающие звонки
    socket.on('user-online', async (userId) => {
        console.log(`🌐 Пользователь ${userId} онлайн`);
        await checkPendingCalls(userId, socket);
    });

    // Проверка ожидающих звонков
    async function checkPendingCalls(userId, socket) {
        try {
            const [db] = await pool.getConnection();
            const [calls] = await db.execute(
                'SELECT * FROM active_calls WHERE to_id = ? AND status = "waiting" ORDER BY created_at DESC',
                [userId]
            );
            db.release();
            
            if (calls.length > 0) {
                console.log(`📬 У пользователя ${userId} ${calls.length} ожидающих звонков`);
                
                for (const call of calls) {
                    // Отправляем самый свежий звонок
                    socket.emit('incoming-call', {
                        from: call.from_id,
                        offer: JSON.parse(call.offer),
                        type: call.type,
                        call_id: call.call_id
                    });
                    
                    // Обновляем статус звонка
                    const [db2] = await pool.getConnection();
                    await db2.execute(
                        'UPDATE active_calls SET status = "ringing" WHERE call_id = ?',
                        [call.call_id]
                    );
                    db2.release();
                    
                    // Уведомляем звонящего что звонок доставлен
                    const callerSocketId = userConnections.get(call.from_id);
                    if (callerSocketId) {
                        io.to(callerSocketId).emit('call-ringing', { 
                            call_id: call.call_id,
                            to: userId
                        });
                    }
                    
                    // Отправляем только самый свежий звонок
                    break;
                }
            }
        } catch (err) {
            console.error('Ошибка проверки ожидающих звонков:', err);
        }
    }

    // Принятие звонка
    socket.on('accept-call', async (data) => {
        const { from, to, answer, call_id } = data;
        const callerSocketId = userConnections.get(from);
        
        console.log(`✅ Звонок принят ${to} -> ${from}, ID: ${call_id}`);
        
        if (callerSocketId) {
            io.to(callerSocketId).emit('call-accepted', {
                answer: answer,
                call_id: call_id
            });
            
            // Обновляем статус звонка
            activeCalls.set(call_id, {
                ...(activeCalls.get(call_id) || {}),
                status: 'active'
            });
            
            try {
                const [db] = await pool.getConnection();
                await db.execute(
                    'UPDATE active_calls SET status = "active", answer = ? WHERE call_id = ?',
                    [JSON.stringify(answer), call_id]
                );
                db.release();
            } catch (err) {
                console.error('Ошибка обновления звонка:', err);
            }
        }
    });

    // Отклонение звонка
    socket.on('reject-call', (data) => {
        const { from, to, call_id } = data;
        const callerSocketId = userConnections.get(from);
        
        console.log(`❌ Звонок отклонен ${to} -> ${from}, ID: ${call_id}`);
        
        if (callerSocketId) {
            io.to(callerSocketId).emit('call-rejected', {
                from: to,
                call_id: call_id
            });
        }
        
        // Удаляем звонок из активных
        activeCalls.delete(call_id);
    });

    // Завершение звонка
    socket.on('end-call', (data) => {
        const { to, call_id } = data;
        const targetSocketId = userConnections.get(to);
        
        console.log(`📴 Завершение звонка для ${to}, ID: ${call_id}`);
        
        if (targetSocketId) {
            io.to(targetSocketId).emit('call-ended', { call_id });
        }
        
        // Удаляем звонок
        activeCalls.delete(call_id);
    });

    // ICE кандидаты
    socket.on('ice-candidate', (data) => {
        const { to, candidate } = data;
        const targetSocketId = userConnections.get(to);
        
        if (targetSocketId) {
            io.to(targetSocketId).emit('new-ice-candidate', {
                candidate: candidate
            });
        }
    });

    // Отключение
    socket.on('disconnect', () => {
        for (let [userId, socketId] of userConnections.entries()) {
            if (socketId === socket.id) {
                userConnections.delete(userId);
                console.log(`❌ Пользователь ${userId} отключился`);
                break;
            }
        }
    });
});

// Очистка старых звонков каждые 5 минут
setInterval(() => {
    const now = Date.now();
    for (let [callId, callData] of activeCalls.entries()) {
        if (now - callData.timestamp > 10 * 60 * 1000) { // 10 минут
            activeCalls.delete(callId);
            console.log(`🧹 Очищен старый звонок ${callId}`);
        }
    }
}, 5 * 60 * 1000);

const PORT = process.env.PORT || 3001;
server.listen(PORT, () => {
    console.log(`🚀 Сигнальный сервер запущен на порту ${PORT}`);
    console.log(`📡 Режим: ВСЕГДА ЗВОНИМ (даже офлайн)`);
});
