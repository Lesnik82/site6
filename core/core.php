<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

ini_set('error_reporting', false);
ini_set('display_errors', false);
ini_set('display_startup_errors', false);

if (isset($_POST['ajax'])) $ajax = $_POST['ajax'];
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {$ajax_query = true;}

# Запускаем сессии
session_start();
ob_start();

# Системные константы

define('URL', 'https://'.$_SERVER['HTTP_HOST']); // Адрес сайта
define('HOME', $_SERVER['DOCUMENT_ROOT']); // Главная директория
define('TIME', time()); // Время
define('PAGE', ''); // Ajax ссылки

# Подключение к бд

require HOME.'/core/config.php'; //Подключаем конфиг с параметрами
$mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
$mysqli->query("SET NAMES 'utf8mb4'");
if (mysqli_connect_errno()) {
	echo 'Не удалось подключится к базе данных.';
	exit();
}

# Настройки
$system = $mysqli->query("SELECT * FROM `settings` WHERE `id` = 1 LIMIT 1")->fetch_array();

function go($link) {
	header('location: '.$link); exit;
}

# Фильтр

function check($str) {

	global $mysqli;
	
	$str = htmlentities(trim($str), ENT_QUOTES, 'UTF-8');
	$str = nl2br($str);
	$str = strtr($str, array (
	chr(0)=> '',
	chr(1)=> '',
	chr(2)=> '',
	chr(3)=> '',
	chr(4)=> '',
	chr(5)=> '',
	chr(6)=> '',
	chr(7)=> '',
	chr(8)=> '',
	chr(9)=> '',
	chr(10)=> '',
	chr(11)=> '',
	chr(12)=> '',
	chr(13)=> '',
	chr(14)=> '',
	chr(15)=> '',
	chr(16)=> '',
	chr(17)=> '',
	chr(18)=> '',
	chr(19)=> '',
	chr(20)=> '',
	chr(21)=> '',
	chr(22)=> '',
	chr(23)=> '',
	chr(24)=> '',
	chr(25)=> '',
	chr(26)=> '',
	chr(27)=> '',
	chr(28)=> '',
	chr(29)=> '',
	chr(30)=> '',
	chr(31)=> ''
	));

	$str = str_replace("\'", "&#39;", $str);
	$str = str_replace('\\', "&#92;", $str);
	$str = str_replace("|", "I", $str);
	$str = str_replace("||", "I", $str);
	$str = str_replace("/\\\$/", "&#36;", $str);
	$str = str_replace("<br /><br /><br />", "<br />", $str);
	$str = mysqli_real_escape_string($mysqli, $str);

	return $str;

}

if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
elseif (isset($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) $ip = $_SERVER['REMOTE_ADDR'];
else die('Unknown');
$ua = check($_SERVER['HTTP_USER_AGENT']); 

function check_mobile() { 
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']); 
	$mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
foreach ($mobile_agent_array as $value) { 
	if (strpos($ua, $value) !== false) return true; 
} 
return false; 
}

$is_mobile_device = check_mobile();
if($is_mobile_device) $device = 'Mobile'; else $device = 'Computer';

# Куки

if (isset($_COOKIE['uid']) and isset($_COOKIE['upass'])){

	$uid = abs(intval($_COOKIE['uid']));
	$upass = check($_COOKIE['upass']);

	$user = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$uid."' and `pass` = '".$upass."' LIMIT 1")->fetch_assoc();

	$mysqli->query("UPDATE `users` SET `online` = 1, `visit` = '".TIME."', `ip` = '".$ip."', `ua` = '".$ua."', `device` = '".$device."' WHERE `id` = '".$user['id']."' LIMIT 1");

if (isset($user['id']) && $user['id'] != $uid or $user['pass'] != $upass){
	setcookie('uid', '', TIME - 86400 * 31);
	setcookie('upass', '', TIME - 86400 * 31);
}

}

# Онлайн

if ($mysqli->query("SELECT `id` FROM `users` WHERE `visit` < '".(TIME - 600)."' AND `online` = '1' LIMIT 1")->num_rows == true) $mysqli->query("UPDATE `users` SET `online` = '0' WHERE `visit` < '".(TIME - 600)."' AND `online` = '1'");

# Блокировка

if (isset($ban_time)){
	$ban_time = $mysqli->query("SELECT `id` FROM `users` WHERE `ban_time` = '".$ban_time['ban_time']."'");
}
if ($mysqli->query("SELECT `id` FROM `users` WHERE `ban_time` < '".(TIME - isset($ban_time))."' AND `ban` = '1' LIMIT 1")->num_rows == true) $mysqli->query("UPDATE `users` SET `ban` = '0' WHERE `ban_time` < '".(TIME - isset($ban_time))."' AND `ban` = '1'");

# Удаляем сторисы

if ($mysqli->query("SELECT `id` FROM `story_list` WHERE `time` < '".(TIME - 172800)."' LIMIT 1")->num_rows == true){

	$stor = $mysqli->query("SELECT * FROM `story_list` WHERE `time` < '".(TIME - 172800)."' ORDER BY `time` ASC");

	while ($arr_stor = $stor->fetch_array()){

		$mysqli->query("DELETE FROM `story_list` WHERE `user_id` = '".$arr_stor['user_id']."'");
		$mysqli->query("DELETE FROM `story` WHERE `user_id` = '".$arr_stor['user_id']."'");

		# Удаляем фото

		if (file_exists(HOME .'/assets/files/story/'.$arr_stor['user_id'].'/photo/'.$arr_stor['photo'])) {
			@unlink(HOME .'/assets/files/story/'.$arr_stor['user_id'].'/photo/'.$arr_stor['photo']);
		}

		# Удаляем видео

		if (file_exists(HOME .'/assets/files/story/'.$arr_stor['user_id'].'/video/file/'.$arr_stor['video'])) {
			@unlink(HOME .'/assets/files/story/'.$arr_stor['user_id'].'/video/file/'.$arr_stor['video']);
		}

		# Удаляем превью для видео

		if (file_exists(HOME .'/assets/files/story/'.$arr_stor['user_id'].'/video/preview/'.$arr_stor['preview'])) {
			@unlink(HOME .'/assets/files/story/'.$arr_stor['user_id'].'/video/preview/'.$arr_stor['preview']);
		}

	}

}

# Подключаем файл функций
require_once HOME.'/core/func.php';

# Функция для проверки и создания папок для голосовых сообщений
function create_voice_dirs($dialog_dir) {
    global $mysqli, $user_id;
    
    $base_dir = HOME.'/assets/files/direct/'.$dialog_dir;
    
    if (!is_dir($base_dir)) {
        mkdir($base_dir, 0777, true);
    }
    
    if (!is_dir($base_dir.'/voice')) {
        mkdir($base_dir.'/voice', 0777, true);
    }
    
    if (!is_dir($base_dir.'/photo')) {
        mkdir($base_dir.'/photo', 0777, true);
    }
}

# Функция для получения голосовых сообщений
function get_voice_messages($dialog_id, $user_id, $from_id) {
    global $mysqli;
    
    $query = "SELECT * FROM `voice_messages` 
              WHERE `dialog_id` = '".$dialog_id."' 
              AND ((`from_id` = '".$user_id."' AND `for_id` = '".$from_id."') 
              OR (`from_id` = '".$from_id."' AND `for_id` = '".$user_id."'))
              ORDER BY `time` ASC";
    
    $result = $mysqli->query($query);
    $messages = [];
    
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    
    return $messages;
}

?>