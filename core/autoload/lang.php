<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

# Получение текущего языка из сессии

if (isset($user_id)) {
    $selectedLang = isset($_SESSION['lang']) ? $_SESSION['lang'] : $user['lang'];
} else {
    $selectedLang = isset($_SESSION['lang']) ? $_SESSION['lang'] : $system['lang'];
}

# Загрузка языка в зависимости от выбранного языка
$languageFiles = [
    'ua' => HOME . '/core/lang/ua.php',
    'ru' => HOME . '/core/lang/ru.php',
    'en' => HOME . '/core/lang/en.php',
    'uz' => HOME . '/core/lang/uz.php',
];

if (array_key_exists($selectedLang, $languageFiles)) {
    include_once $languageFiles[$selectedLang];
}

# Обработка запроса на изменение языка
if (isset($_GET['lang'])) {
    $requestedLang = $_GET['lang'];

    # Проверяем, что запрошенный язык поддерживается
    if (in_array($requestedLang, array_keys($languageFiles))) {

        if (isset($user['id'])) {
            $mysqli->query("UPDATE `users` SET `lang` = '" . $requestedLang . "' WHERE `id` = '" . $user_id . "' LIMIT 1");
        }

        // Сохраняем выбранный язык в сессии
        $_SESSION['lang'] = $requestedLang;

        // После обновления языка, перенаправляем на ту же страницу
        header('Location: ?');
    }
}

?>