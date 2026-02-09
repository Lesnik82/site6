// Глобальный фикс для синхронных XHR
(function() {
    // Патчим XMLHttpRequest
    var originalXHR = window.XMLHttpRequest;
    window.XMLHttpRequest = function() {
        var xhr = new originalXHR();
        var originalOpen = xhr.open;
        xhr.open = function(method, url, async, user, password) {
            if (async === false) {
                console.warn('Converted sync XHR to async:', url);
                async = true;
            }
            return originalOpen.call(this, method, url, async || true, user, password);
        };
        return xhr;
    };
    
    // Патчим jQuery
    if (window.jQuery) {
        jQuery.ajaxSetup({
            async: true
        });
    }
    
    console.log('XHR sync fix applied');
})();
