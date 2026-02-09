<?
// Функция для получения правильного URL с учетом HTTPS
function getSiteURL() {
    $protocol = 'https://'; // Принудительно используем HTTPS
    return $protocol . $_SERVER['HTTP_HOST'];
}

// Если константа URL еще не определена, определяем ее
if (!defined('URL')) {
    define('URL', getSiteURL());
}
?>
