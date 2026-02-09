<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

function notifications_journal($arr, $type) {
	global $user, $user_id, $lang, $mysqli;

	# Действия с фото
	if ($arr['mod'] == 'photo'){

		# Комментарий к фото
		if ($arr['type'] == 'comm'){

		echo '<div class="table align-start list">
		<div class="con-avatar">'.user_avatar($arr['from_id']).'</div>
		<div class="con-info">
		<div class="d-block cl-dark">'.user_nick($arr['from_id'],1,0,0).' '.$lang['notify-comm'].'.</div>
		<div class="con-add"><i style="padding: 0 3px 0 0;" class="fa-light fa-timer"></i> '.vtime($arr['time']).'</div>
		</div>';

		# Публикация
		echo '<div class="notify-photo">';
		$notify_photo = $mysqli->query("SELECT `id`, `photo`, `preview` FROM `public` WHERE `id` = '".$arr['refid']."' LIMIT 1")->fetch_array();
		if (!empty($notify_photo['photo'])){
		
		if (file_exists(HOME .'/assets/files/public/'.$user_id.'/photo/mini/'.$notify_photo['photo'])){
				echo '<a href="'.URL.'/p/'.$arr['refid'].'"><div style="background: url('.URL.'/assets/files/public/'.$user_id.'/photo/mini/'.$notify_photo['photo'].'); background-size: cover;"></div></a>';
		}

		}else if (!empty($notify_photo['preview'])){
		
		if (file_exists(HOME .'/assets/files/public/'.$user_id.'/video/preview/'.$notify_photo['preview'])){
				echo '<a href="'.URL.'/p/'.$arr['refid'].'"><div style="background: url('.URL.'/assets/files/public/'.$user_id.'/video/preview/'.$notify_photo['preview'].'); background-size: cover;"></div></a>';
		}
		
		}else{

			echo '<div class="notify-no-photo"></div>';

		}
		echo '</div>';
		echo '</div>';

		}

	# Лайк к фото
	if ($arr['type'] == 'like'){

		echo '<div class="table align-start list">
		<div class="con-avatar">'.user_avatar($arr['from_id']).'</div>
		<div class="con-info">
		<div class="d-block cl-dark">'.user_nick($arr['from_id'],1,0,0).' '.$lang['notify-like'].'.</div>
		<div class="con-add"><i style="padding: 0 3px 0 0;" class="fa-light fa-timer"></i> '.vtime($arr['time']).'</div>
		</div>';

		# Публикация
		echo '<div class="notify-photo">';
		$notify_photo = $mysqli->query("SELECT `id`, `photo`, `preview` FROM `public` WHERE `id` = '".$arr['refid']."' LIMIT 1")->fetch_array();
		if (!empty($notify_photo['photo'])){
		
		if (file_exists(HOME .'/assets/files/public/'.$user_id.'/photo/mini/'.$notify_photo['photo'])){
				echo '<a href="'.URL.'/p/'.$arr['refid'].'"><div style="background: url('.URL.'/assets/files/public/'.$user_id.'/photo/mini/'.$notify_photo['photo'].'); background-size: cover;"></div></a>';
		}

		}else if (!empty($notify_photo['preview'])){
		
		if (file_exists(HOME .'/assets/files/public/'.$user_id.'/video/preview/'.$notify_photo['preview'])){
				echo '<a href="'.URL.'/p/'.$arr['refid'].'"><div style="background: url('.URL.'/assets/files/public/'.$user_id.'/video/preview/'.$notify_photo['preview'].'); background-size: cover;"></div></a>';
		}
		
		}else{

			echo '<div class="notify-no-photo"></div>';

		}
		echo '</div>';
		echo '</div>';

		}

	}

	# Подписки
	if ($arr['mod'] == 'follow'){

		# Успешная подписка
		if ($arr['type'] == 'success'){

		echo '<div class="table align-start list">
		<div class="con-avatar">'.user_avatar($arr['from_id']).'</div>
		<div class="con-info">
		<div class="d-block cl-dark">'.user_nick($arr['from_id'],1,0,0).' '.$lang['notify-follow'].'.</div>
		<div class="con-add"><i style="padding: 0 3px 0 0;" class="fa-light fa-timer"></i> '.vtime($arr['time']).'</div>
		</div>
		</div>';

		}

	}

}

?>