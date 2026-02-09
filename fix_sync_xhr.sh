#!/bin/bash
cd /home/a1213558/domains/godeondayz.ru/public_html/

echo "Fixing synchronous XHR calls..."

# 1. Исправляем JavaScript файлы
find . -name "*.js" -type f -exec sed -i '
    s/async:\s*false/async: true/g;
    s/async\s*=\s*false/async = true/g;
    s/open([^,]*,[^,]*,\s*false/open($1, $2, true/g;
' {} \;

# 2. Исправляем jQuery вызовы
find . -name "*.js" -type f -exec sed -i '
    s/\$\.ajax\s*({[^}]*async\s*:\s*false/\$.ajax({async: true/g;
    s/\$\.get\s*([^,]*,[^{]*{.*async\s*:\s*false/\$.get($1, $2{async: true/g;
    s/\$\.post\s*([^,]*,[^{]*{.*async\s*:\s*false/\$.post($1, $2{async: true/g;
' {} \;

# 3. Создаем глобальный фикс
cat > xhr_fix.js << 'JSFIX'
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
JSFIX

echo "Fix applied!"
