<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

# Блокировка аккаунта

if (isset($user['ban']) && $user['ban'] == 1){

	$title = $user['nick'];
	require_once HOME.'/core/core.php';
	require_once HOME.'/core/head.php';

	echo '<div class="user-ban">
		<i class="fa-regular fa-user-slash"></i>
		'.$lang['ac-block-time'].'!

		<div>
		'.date('d.m.Y в H:i', $user['ban_time']).'</br>
		'.$user['ban_text'].'
		</div>

	</div>';

exit;

}

?>
