<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

# Ник пользователя

function user_nick($id, $user_link = 1, $ver = 1){

	global $mysqli;
	global $user, $user_id, $system;
	$arr_user = $mysqli->query("SELECT `id`, `nick`, `verified` FROM `users` WHERE `id` = '".$id."' LIMIT 1")->fetch_array();

	if (isset($arr_user) && $arr_user['verified'] == 1) $verified = '<i class="fa-solid fa-badge-check verified"></i>';

	$user_nick = ''.($user_link==1?'<a href="'.URL.'/'.$arr_user['nick'].'/">':'').''.ucfirst($arr_user['nick']).''.($user_link==1?'</a>':'').''.($ver==1?''.$verified.'':'').'';
	return $user_nick;

}

# Имя пользователя

function user_name($id){

	global $mysqli;
	global $user, $user_id, $system;
	$arr_user = $mysqli->query("SELECT `id`, `name` FROM `users` WHERE `id` = '".$id."' LIMIT 1")->fetch_array();

	$user_name = ''.$arr_user['name'].'';
	return $user_name;

}

# Аватар пользователя

function user_avatar($id, $link = 1, $prem = 1) {
	global $mysqli;
	global $user, $user_id, $system;
	$arr_user = $mysqli->query("SELECT `id`, `avatar`, `nick`, `ban` FROM `users` WHERE `id` = '".$id."' LIMIT 1")->fetch_array();

	if (!empty($arr_user['avatar']) && file_exists(HOME .'/assets/files/avatars/'.$arr_user['id'].'/preview/'.$arr_user['avatar'])){
		$user_avatar = ''.($link==1?'<a href="'.URL.'/'.$arr_user['nick'].'/">':'').'<img src="'.URL.'/assets/files/avatars/'.$arr_user['id'].'/icons/'.$arr_user['avatar'].'"/>'.($link==1?'</a>':'').'';
	}else{
		$user_avatar = ''.($link==1?'<a href="'.URL.'/'.$arr_user['nick'].'/">':'').'<img src="'.URL.'/assets/icons/no-avatar.png">'.($link==1?'</a>':'').'';
	}
return $user_avatar;
}

# Аватар пользователя ссылка

function user_avatar_url($id) {
	global $mysqli;
	global $user, $user_id, $system;
	$arr_user = $mysqli->query("SELECT `id`, `avatar` FROM `users` WHERE `id` = '".$id."' LIMIT 1")->fetch_array();

	if (!empty($arr_user['avatar']) && file_exists(HOME .'/assets/files/avatars/'.$arr_user['id'].'/preview/'.$arr_user['avatar'])){
		$user_avatar_url = ''.URL.'/assets/files/avatars/'.$arr_user['id'].'/icons/'.$arr_user['avatar'].'';
	}else{
		$user_avatar_url = ''.URL.'/assets/icons/no-avatar.png';
	}
return $user_avatar_url;
}

# Аватар профиля

function profile_avatar($id) {
	global $mysqli;
	global $user, $user_id, $system;
	$arr_user = $mysqli->query("SELECT `id`, `avatar` FROM `users` WHERE `id` = '".$id."' LIMIT 1")->fetch_array();

	if (!empty($arr_user['avatar']) && file_exists(HOME .'/assets/files/avatars/'.$arr_user['id'].'/preview/'.$arr_user['avatar'])){
		$user_avatar = '<img src="'.URL.'/assets/files/avatars/'.$arr_user['id'].'/preview/'.$arr_user['avatar'].'">';
	}else{
		$user_avatar = '<img src="'.URL.'/assets/icons/no-avatar.png">';

	}

return $user_avatar;
}

# Вывод иконки онлайна

function user_online($id){
	global $mysqli;
	global $user, $user_id, $mysqli;

	$arr_user = $mysqli->query("SELECT `id`, `online`, `device` FROM `users` WHERE `id` = '".$id."' LIMIT 1")->fetch_array();

	if ($user_id == $id || 
    $mysqli->query("SELECT * FROM `follow` WHERE `user_id` = '".$user_id."' AND `for_id` = '".$id."' AND `type` = '1' LIMIT 1")->num_rows == true &&
    $mysqli->query("SELECT * FROM `follow` WHERE `user_id` = '".$id."' AND `for_id` = '".$user_id."' AND `type` = '1' LIMIT 1")->num_rows == true &&
    $user['access_online'] == 0
	){

	if (isset($arr_user) && $arr_user['online'] == 1) $online = '<span class="user-online"></span>';

	}

	$user_online = ''.$online.'';

	return $user_online;

}

# Должность

function user_level($id){
	global $mysqli;
	global $user, $user_id, $lang, $mysqli;

	$arr_user = $mysqli->query("SELECT `id`, `level` FROM `users` WHERE `id` = '".$id."' LIMIT 1")->fetch_array();

	if ($arr_user['level'] == 0){

	$user_level = $lang['user'];

	}else if ($arr_user['level'] == 1){

	$user_level = $lang['moder'];

	}else if ($arr_user['level'] == 2){

	$user_level = $lang['admin'];

	}else if ($arr_user['level'] == 3){

	$user_level = $lang['founder'];

	}else{

	$user_level = $lang['founder'];

	}

	return $user_level;

}

?>