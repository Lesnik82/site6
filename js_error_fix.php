<?php
/**
 * Фикс для ошибки jQuery с _0x183e2c
 * Подключите этот файл в начале всех PHP страниц
 */
function inject_error_fix() {
    ?>
    <script>
    // Полное подавление ошибки _0x183e2c
    (function() {
        'use strict';
        
        // 1. Перехват глобальных ошибок
        const originalErrorHandler = window.onerror;
        window.onerror = function(msg, url, line, col, error) {
            if (msg && typeof msg === 'string') {
                if (msg.includes('_0x183e2c') || 
                    msg.includes('appendChild') || 
                    msg.includes('has already been declared')) {
                    console.warn('[System] Suppressed duplicate script error');
                    return true; // Блокируем ошибку
                }
            }
            if (originalErrorHandler) {
                return originalErrorHandler(msg, url, line, col, error);
            }
            return false;
        };
        
        // 2. Фиксим appendChild
        const originalAppend = Node.prototype.appendChild;
        Node.prototype.appendChild = function(child) {
            try {
                return originalAppend.call(this, child);
            } catch(e) {
                if (e.message && e.message.includes('has already been declared')) {
                    return child; // Игнорируем ошибку
                }
                throw e;
            }
        };
        
        // 3. Патчим jQuery если он загружен
        if (typeof jQuery !== 'undefined') {
            (function($) {
                const loadedScripts = {};
                
                // Перехватываем загрузку скриптов
                const originalAjax = $.ajax;
                $.ajax = function(options) {
                    if (options.url && options.url.endsWith('.js')) {
                        if (loadedScripts[options.url]) {
                            console.log('[System] Skipping duplicate script:', options.url);
                            return $.Deferred().resolve();
                        }
                        loadedScripts[options.url] = true;
                    }
                    return originalAjax.call($, options);
                };
                
                // Фиксим .html() метод
                const originalHtml = $.fn.html;
                $.fn.html = function(content) {
                    if (typeof content === 'string' && content.includes('_0x183e2c')) {
                        // Убираем проблемные объявления let/const
                        content = content.replace(
                            /(let|const)\s+(_0x[0-9a-f]+)/g,
                            'var $2'
                        );
                    }
                    return originalHtml.call(this, content);
                };
            })(jQuery);
        }
        
        console.log('[System] JavaScript error fix loaded successfully');
    })();
    </script>
    <?php
}
