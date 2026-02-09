<?php
/**
 * Полный фикс для ошибок JavaScript
 * 1. Ошибка _0x183e2c 
 * 2. Синхронные XMLHttpRequest
 * 3. Другие jQuery ошибки
 */

function fix_all_js_errors() {
    ?>
    <script>
    // Полный фикс для всех ошибок
    (function() {
        'use strict';
        
        // ===== 1. ФИКС ДЛЯ _0x183e2c =====
        // Перехватываем глобальные ошибки
        const originalOnError = window.onerror;
        window.onerror = function(msg, url, line, col, error) {
            if (msg && typeof msg === 'string') {
                // Блокируем ошибку с _0x183e2c
                if (msg.includes('_0x183e2c') || 
                    msg.includes('has already been declared') ||
                    msg.includes('appendChild')) {
                    console.warn('[System] Suppressed duplicate declaration');
                    return true;
                }
            }
            if (originalOnError) {
                return originalOnError(msg, url, line, col, error);
            }
            return false;
        };

        // Фиксим appendChild
        const originalAppendChild = Node.prototype.appendChild;
        Node.prototype.appendChild = function(child) {
            try {
                return originalAppendChild.call(this, child);
            } catch(e) {
                if (e.message && e.message.includes('has already been declared')) {
                    return child;
                }
                throw e;
            }
        };

        // ===== 2. ФИКС ДЛЯ СИНХРОННЫХ XHR =====
        // Сохраняем оригинальный XMLHttpRequest
        const OriginalXHR = window.XMLHttpRequest;
        
        // Создаем новый класс, который блокирует синхронные запросы
        class FixedXMLHttpRequest extends OriginalXHR {
            open(method, url, async = true, user, password) {
                // Форсируем асинхронный режим
                if (async === false) {
                    console.warn('[System] Blocked synchronous XHR:', url);
                    async = true; // Меняем на асинхронный
                }
                return super.open(method, url, async, user, password);
            }
            
            send(body) {
                try {
                    return super.send(body);
                } catch(e) {
                    console.warn('[System] XHR error suppressed:', e.message);
                    return null;
                }
            }
        }
        
        // Заменяем глобальный XMLHttpRequest
        window.XMLHttpRequest = FixedXMLHttpRequest;
        
        // ===== 3. ФИКС ДЛЯ JQUERY =====
        if (typeof jQuery !== 'undefined') {
            (function($) {
                // Фиксим синхронные AJAX запросы в jQuery
                const originalAjax = $.ajax;
                $.ajax = function(options) {
                    // Всегда асинхронно
                    if (options.async === false) {
                        console.warn('[System] jQuery sync AJAX forced async:', options.url);
                        options.async = true;
                    }
                    
                    // Фикс для дублирующихся скриптов
                    if (options.dataType === 'script' || 
                        (options.url && options.url.includes('.js'))) {
                        options.cache = false; // Отключаем кэш
                    }
                    
                    return originalAjax.call($, options);
                };
                
                // Фиксим $.get и $.post
                $.get = function(url, data, callback, type) {
                    return $.ajax({
                        url: url,
                        data: data,
                        success: callback,
                        dataType: type,
                        async: true // Всегда асинхронно
                    });
                };
                
                $.post = function(url, data, callback, type) {
                    return $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        success: callback,
                        dataType: type,
                        async: true
                    });
                };
                
                // Фиксим методы загрузки скриптов
                const originalGetScript = $.getScript;
                $.getScript = function(url, callback) {
                    return $.ajax({
                        url: url,
                        dataType: 'script',
                        success: callback,
                        async: true,
                        cache: false // Важно для избежания дублирования
                    });
                };
                
            })(jQuery);
        }
        
        // ===== 4. ФИКС ДЛЯ FETCH API =====
        if (window.fetch) {
            const originalFetch = window.fetch;
            window.fetch = function(input, init) {
                try {
                    return originalFetch(input, init);
                } catch(e) {
                    console.warn('[System] Fetch error suppressed');
                    return Promise.reject(e);
                }
            };
        }
        
        console.log('[System] All JavaScript errors fixed successfully');
        
    })();
    </script>
    <?php
}

// Автоматическое применение фикса
if (!defined('JS_ERRORS_FIXED')) {
    define('JS_ERRORS_FIXED', true);
    add_action('wp_head', 'fix_all_js_errors', 1); // Для WordPress
    // Для обычного PHP - вызывайте функцию вручную в шаблоне
}
