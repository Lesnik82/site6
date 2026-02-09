<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

if (isset($ajax_query) == false){

echo '<!--


Author Xaori69otori - Telegram @Xaori69otori


-->

<!DOCTYPE html>
	<html lang="'.$system['lang'].'">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#fff">
	<meta name="title" content="'.$title.'"/>
	<meta name="keywords" content="'.$system['keywords'].'" />
	<meta name="description" content="'.$system['description'].'" />
	<meta property="og:title" content="'.$title.'">
	<meta property="og:url" content="'.URL.'">
	<meta property="og:type" content="website">
	<meta property="og:image" content="'.URL.'/style/icons/og.png">
	<meta property="og:site_name" content="'.$title.'">
	<meta property="og:description" content="'.$system['description'].'">
	<meta content="Xaotik" name="author" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" type="text/css"/>
	<link rel="stylesheet" href="'.URL.'/assets/fontawesome/css/all.css" type="text/css"/>
	<link rel="stylesheet" href="'.URL.'/assets/theme/style.css?v='.$system['update'].'" type="text/css"/>
	<link rel="stylesheet" href="'.URL.'/assets/theme/adaptation.css?v='.$system['update'].'" type="text/css"/>
	<link rel="stylesheet" href="'.URL.'/assets/theme/story.css?v='.$system['update'].'" type="text/css"/>
	<link rel="shortcut icon" href="'.URL.'/assets/theme/favicon.ico?v='.$system['update'].'" />
	<script type="text/javascript" src="'.URL.'/assets/js/jquery.js"></script>
	<script type="text/javascript" src="'.URL.'/assets/js/upload.js?v='.$system['update'].'"></script>
	<script type="text/javascript" src="'.URL.'/assets/js/core.js?v='.$system['update'].'"></script>
	<script type="text/javascript" src="'.URL.'/assets/js/jquery.emojiarea.js?v='.$system['update'].'"></script>
	<script type="text/javascript" src="'.URL.'/assets/js/emojis.js?v='.$system['update'].'"></script>
	<script type="text/javascript" src="'.URL.'/assets/js/player.js?v='.$system['update'].'"></script>
	<title>'.$title.'</title>
	</head>
	<body>';
}

if (isset($ajax_query) == false){

echo '<div id="header">
	<div class="header_min">
		<div class="header-left"><a href="'.URL.'/"><i class="fa-brands fa-instagram"></i></a></div>
		<div class="header_title" id="titles"></div>';

		if (isset($user_id)){
		echo '<div class="header-right web">
		<button class="menu-post-click"></button>
		</div>

		<div class="menu-post-content">
    		<div class="menu-post">
    			<div class="web">
        			<a href="'.URL.'/public/new/"><i class="fa-solid fa-grid-2"></i> '.$lang['post'].'</a>
        			<a href="'.URL.'/story/new/"><i class="fa-solid fa-grid-2"></i> '.$lang['stories'].'</a>
        		</div>
        		<div class="wap left">
        			<a href="'.URL.'/public/new/"><i class="fa-solid fa-grid-2"></i> '.$lang['new-public'].'</a>
        			<a href="'.URL.'/story/new/"><i class="fa-solid fa-grid-2"></i> '.$lang['new-story'].'</a>
        		</div>
    		</div>
    	</div>

		<div class="header-right wap"><a href="'.URL.'/direct"><i class="fa-light fa-paper-plane-top"></i> <span id="count_mail_mobile">'.($user['notifications_mail']>0?'<b>'.convert_num($user['notifications_mail']).'</b>':'').'</span></a></div>';
		}
echo '</div>
</div>';

}

?>
<script type="text/javascript">document.title = '<?php echo $title;?>';</script>
<script>var titles = '<?php echo $title;?>';document.getElementById("titles").innerHTML = titles;</script>
<?

if (isset($ajax_query) == false){
if (isset($user_id)){

# Нижняя панель для пользователя
echo '<div class="table user-panel">
    <div><a href="'.URL.'/"><span class="p-home bold"></span></a></div>
    <div><a href="'.URL.'/search/"><span class="p-search"></span></a></div>
    <div><a><button class="menu-post-click"></button></a></div>
    <div><a href="'.URL.'/voice/"><span class="p-voice"></span></a></div>
    <div><a href="'.URL.'/notify"><span class="p-bell"></span> <span id="count_journal_mobile">'.($user['notifications_journal']>0?'<b></b>':'').'</span></a></div>
    <div><a href="'.URL.'/'.$user_nick.'/"><span class="p-user"></span></a></div>
</div>';

}

echo '<div class="content-left">

	<a href="'.URL.'/"><div class="logo"></div></a>';

echo '<div class="content-left-menu">';

if (isset($user_id)){

echo '<a href="'.URL.'/"><i class="fa-solid fa-house"></i> '.$lang['feed'].'</a>
    <a href="'.URL.'/'.$user_nick.'/"><i class="fa-solid fa-user"></i> '.$lang['profile'].'</a>
    <a href="'.URL.'/search/"><i class="fa-solid fa-magnifying-glass"></i> '.$lang['search'].'</a>
    <a href="'.URL.'/notify"><i class="fa-solid fa-bell"></i> '.$lang['notify'].' <span id="count_journal">'.($user['notifications_journal']>0?'<b>'.convert_num($user['notifications_journal']).'</b>':'').'</span></a>
    <a href="'.URL.'/direct"><i class="fa-solid fa-comment"></i> '.$lang['direct'].' <span id="count_mail">'.($user['notifications_mail']>0?'<b>'.convert_num($user['notifications_mail']).'</b>':'').'</span></a>
    <a href="'.URL.'/voice/"><i class="fa-solid fa-headphones"></i> '.($lang['voice_rooms'] ?? 'Voice Rooms').'</a>
    <a href="'.URL.'/account/settings/"><i class="fa-solid fa-gear"></i> '.$lang['settings'].'</a>
    '.($user['level'] > 0 ?'<a href="'.URL.'/panel/"><i class="fa-solid fa-shield"></i> '.$lang['adminka'].'</a>':'').'
    <a href="'.URL.'/out" none><i class="fa-solid fa-right-from-bracket"></i> '.$lang['exit'].'</a>';
	

}else{

	echo '<a href="'.URL.'/"><i class="fa-solid fa-user"></i> '.$lang['auth'].'</a>
	<a href="'.URL.'/signup"><i class="fa-solid fa-user-plus"></i> '.$lang['reg'].'</a>
	<a href="'.URL.'/restore/"><i class="fa-solid fa-user-lock"></i> '.$lang['recovery'].'</a>
	<a href="'.URL.'/app/"><i class="fa-brands fa-android"></i> '.$lang['download'].'</a>';

}

echo '<div class="content-left-d">
	<a href="'.URL.'/help/">'.$lang['help'].'</a> <a href="'.URL.'/sogl/">'.$lang['sogl'].'</a></br>
	<a href="'.URL.'/'.(isset($user_id)?'account/settings/language/':'lang/').'">'.$lang['lang'].'</a>
</div>';

echo '</div></div>

<div id="content" class="content">
<div id="notifications"></div>';

}

echo '<div id="loading"></div>
<div id="scrollToTopBtn"></div>';

?>