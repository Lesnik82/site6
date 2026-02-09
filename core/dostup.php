<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

$stop = false;
if ($system['dostup'] == 2 && empty($user_id)) $stop = true;
else if ($system['dostup'] == 3 && $user['level'] < 1) $stop = true;

if ($stop == true){

	echo '<!DOCTYPE html>
	<html lang="ru">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#f9f9f9">
	<link rel="stylesheet" href="'.URL.'/assets/theme/lock.css?r='.rand().'" type="text/css"/>
	<link rel="shortcut icon" href="'.URL.'/assets/theme/favicon.ico?r='.rand().'" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<title>Тех. работы</title>
	</head>';

	echo '<div class="close">

	<img src="'.URL.'/assets/icons/close.gif"><br>

	На сайте проводятся технические работы!</br>
	Пожалуйста зайдите позже.

	<div>
	<a href="'.URL.'">Обновить страницу</a><br>
	<a href="tg://resolve?domain=xaori69otori">Телеграм</a>
	</div>

	</div>';

	echo '</body></html>';

exit;

}

?>