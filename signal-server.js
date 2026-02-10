// signal-server.js - ОПТИМИЗИРОВАННАЯ ВЕРСИЯ
const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const cors = require('cors');
const path = require('path');

const app = express();
app.use(cors({
    origin: '*',
    methods: ['GET', 'POST']
}));

// Для отладки
app.get('/', (req, res) => {
    res.json({ status: 'ok', message: 'WebRTC Signal Server is running' });
});

app.get('/health', (req, res) => {
    res.json({ status: 'healthy', timestamp: Date.now() });
});

const server = http.createServer(app);

// Настройки Socket.IO
const io = new Server(server, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST']
    },
    transports: ['websocket', 'polling'],
    pingTimeout: 60000,
    pingInterval: 25000
});

// Хранилище пользователей
const users = new Map();

io.on('connection', (socket) => {
    console.log('🔗 Новое соединение:', socket.id);

    // Регистрация пользователя
    socket.on('register', (userId) => {
        users.set(userId, {
            socketId: socket.id,
            userId: userId,
            timestamp: Date.now()
        });
        console.log(`✅ Пользователь ${userId} зарегистрирован как ${socket.id}`);
        
        // Подтверждение регистрации
        socket.emit('registered', { userId });
    });

    // Проверка онлайн статуса
    socket.on('check-online', (data) => {
        const { userId } = data;
        const user = users.get(userId);
        socket.emit('online-status', {
            userId,
            isOnline: !!user,
            lastSeen: user ? user.timestamp : null
        });
    });

    // Запрос на звонок
    socket.on('call-user', (data) => {
        const { from, to, offer, type } = data;
        const targetUser = users.get(to);
        
        console.log(`📞 Запрос звонка от ${from} к ${to}`);
        
        if (targetUser) {
            io.to(targetUser.socketId).emit('incoming-call', {
                from: from,
                offer: offer,
                type: type
            });
            
            // Подтверждение отправки
            socket.emit('call-sent', { to });
        } else {
            socket.emit('call-error', {
                message: 'Пользователь не в сети'
            });
        }
    });

    // Принятие звонка
    socket.on('accept-call', (data) => {
        const { from, to, answer } = data;
        const callerUser = users.get(from);
        
        console.log(`✅ Звонок принят ${to} -> ${from}`);
        
        if (callerUser) {
            io.to(callerUser.socketId).emit('call-accepted', {
                answer: answer
            });
        }
    });

    // Отклонение звонка
    socket.on('reject-call', (data) => {
        const { from, to } = data;
        const callerUser = users.get(from);
        
        console.log(`❌ Звонок отклонен ${to} -> ${from}`);
        
        if (callerUser) {
            io.to(callerUser.socketId).emit('call-rejected', {
                from: to
            });
        }
    });

    // Завершение звонка
    socket.on('end-call', (data) => {
        const { to } = data;
        const targetUser = users.get(to);
        
        console.log(`📴 Завершение звонка для ${to}`);
        
        if (targetUser) {
            io.to(targetUser.socketId).emit('call-ended');
        }
    });

    // ICE кандидаты
    socket.on('ice-candidate', (data) => {
        const { to, candidate } = data;
        const targetUser = users.get(to);
        
        if (targetUser) {
            io.to(targetUser.socketId).emit('new-ice-candidate', {
                candidate: candidate
            });
        }
    });

    // Отключение
    socket.on('disconnect', () => {
        for (let [userId, userData] of users.entries()) {
            if (userData.socketId === socket.id) {
                users.delete(userId);
                console.log(`❌ Пользователь ${userId} отключился`);
                break;
            }
        }
    });

    // Ошибка соединения
    socket.on('error', (error) => {
        console.error('Socket error:', error);
    });
});

// Очистка мертвых соединений каждые 5 минут
setInterval(() => {
    const now = Date.now();
    for (let [userId, userData] of users.entries()) {
        if (now - userData.timestamp > 5 * 60 * 1000) { // 5 минут
            users.delete(userId);
            console.log(`🧹 Очищен неактивный пользователь ${userId}`);
        }
    }
}, 5 * 60 * 1000);

// Порт из переменной окружения или 3001
const PORT = process.env.PORT || 3001;
const HOST = process.env.HOST || '0.0.0.0';

server.listen(PORT, HOST, () => {
    console.log(`🚀 Сигнальный сервер запущен на http://${HOST}:${PORT}`);
    console.log(`📡 WebSocket доступен на ws://${HOST}:${PORT}`);
});

// Обработка завершения
process.on('SIGINT', () => {
    console.log('\n🛑 Остановка сервера...');
    server.close(() => {
        console.log('✅ Сервер остановлен');
        process.exit(0);
    });
});
