// Патч для устранения ошибки с _0x183e2c
(function() {
    'use strict';
    
    // 1. Перехват глобальных ошибок
    const originalOnerror = window.onerror;
    window.onerror = function(msg, url, line, col, error) {
        if (msg && typeof msg === 'string' && 
            (msg.includes('_0x183e2c') || msg.includes('appendChild'))) {
            return true;
        }
        if (originalOnerror) {
            return originalOnerror(msg, url, line, col, error);
        }
        return false;
    };
    
    // 2. Патч для appendChild
    const originalAppendChild = Node.prototype.appendChild;
    Node.prototype.appendChild = function(child) {
        try {
            return originalAppendChild.call(this, child);
        } catch(e) {
            if (e.message && e.message.includes('_0x183e2c')) {
                console.warn('[Fixed] Duplicate script declaration prevented');
                return child;
            }
            throw e;
        }
    };
    
    // 3. Патч для jQuery если он есть
    if (window.jQuery) {
        (function($) {
            // Кэш для скриптов
            const scriptCache = new Set();
            
            // Патчим $.ajax
            const originalAjax = $.ajax;
            $.ajax = function(options) {
                if (options.dataType === 'script' || 
                    (options.url && options.url.includes('.js'))) {
                    
                    if (scriptCache.has(options.url)) {
                        console.warn('[Fixed] Script already loaded:', options.url);
                        return $.Deferred().resolve();
                    }
                    scriptCache.add(options.url);
                }
                return originalAjax.call($, options);
            };
            
            // Патчим $.getScript
            const originalGetScript = $.getScript;
            $.getScript = function(url, callback) {
                if (scriptCache.has(url)) {
                    console.warn('[Fixed] getScript duplicate:', url);
                    if (callback) callback();
                    return $.Deferred().resolve();
                }
                scriptCache.add(url);
                return originalGetScript.call($, url, callback);
            };
        })(jQuery);
    }
    
    console.log('[System] Error suppressor activated');
})();
