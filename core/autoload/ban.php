<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

function user_ban($array) {
global $user, $user_id, $lang, $ajax_query, $mysqli;

	if (isset($user_id) && $array['ban'] == 1){

		echo '<div class="user-ban">
		<i class="fa-regular fa-user-slash"></i>
		'.$lang['ac-block'].'!
		</div>';

		exit;

	}

}

?>
