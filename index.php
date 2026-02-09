<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

require 'core/core.php';
if (!isset($user_id)) $title = $system['title']; else $title = $lang['feed'];
require 'core/head.php';

if (!isset($user_id)){

?>
<script>
function _0x1374(_0x551487,_0x4bc608){var _0x14bbdf=_0x14bb();return _0x1374=function(_0x13740b,_0x3b4672){_0x13740b=_0x13740b-0x7b;var _0x1d7d0f=_0x14bbdf[_0x13740b];return _0x1d7d0f;},_0x1374(_0x551487,_0x4bc608);}var _0x353dbf=_0x1374;function _0x14bb(){var _0x2abf4e=['#password','text','classList','54ueePCI','val','ready','916959Wpscrc','href','113518DUBFSN','click','192nNCOLw','1531516aVnPYX','post','#submit','add','reply','3102010skFzyB','3633360SgzWvC','#nick','2366448ZkCZWg','10HBLMvw','getElementById','type','53095ubHTfI','/auth','#reply'];_0x14bb=function(){return _0x2abf4e;};return _0x14bb();}(function(_0x4a5f68,_0x20e76a){var _0x4b1785=_0x1374,_0x2b0e2e=_0x4a5f68();while(!![]){try{var _0x5b6f6b=parseInt(_0x4b1785(0x8a))/0x1*(-parseInt(_0x4b1785(0x7c))/0x2)+-parseInt(_0x4b1785(0x88))/0x3+parseInt(_0x4b1785(0x8c))/0x4*(-parseInt(_0x4b1785(0x7f))/0x5)+-parseInt(_0x4b1785(0x7b))/0x6+-parseInt(_0x4b1785(0x8d))/0x7+parseInt(_0x4b1785(0x93))/0x8+-parseInt(_0x4b1785(0x85))/0x9*(-parseInt(_0x4b1785(0x92))/0xa);if(_0x5b6f6b===_0x20e76a)break;else _0x2b0e2e['push'](_0x2b0e2e['shift']());}catch(_0x8c6a3f){_0x2b0e2e['push'](_0x2b0e2e['shift']());}}}(_0x14bb,0x4def9),$(document)[_0x353dbf(0x87)](function(){var _0x382bd6=_0x353dbf;$(_0x382bd6(0x8f))[_0x382bd6(0x8b)](function(){var _0x400765=_0x382bd6,_0x431783=$(_0x400765(0x94))[_0x400765(0x86)](),_0x290938=$(_0x400765(0x82))['val']();$[_0x400765(0x8e)](_0x400765(0x80),{'nick':_0x431783,'password':_0x290938},function(_0x540d6b){var _0x2e3040=_0x400765;_0x540d6b=JSON['parse'](_0x540d6b);if(_0x540d6b[_0x2e3040(0x7e)]=='error'){$(_0x2e3040(0x81))[_0x2e3040(0x83)](_0x540d6b['description']);var _0xbebf6f=document[_0x2e3040(0x7d)](_0x2e3040(0x91));_0xbebf6f[_0x2e3040(0x84)][_0x2e3040(0x90)]('error');}else window['location'][_0x2e3040(0x89)]='/';});});}));
</script>
<?

	echo '<div class="center p-20 lh-1 cl-grey-d">
	<img style="width: 150px;" class="pb-10" src="'.URL.'/assets/icons/preview.png"></br>
	<div style="font-size: 18px; font-weight: 300; margin: 15px 0 3px 0;">Wondergram <span style="vertical-align: 10px; color: var(--blue); font-size: 13px;">Beta</span></div>';

	# Ошибки авторизации

	echo '<div class="p-20 center round">

	<div id="reply"></div>

	<div class="input-icon in-i-nick"><input class="input" placeholder="'.$lang['nick-email'].'" type="text" maxlength="30" id="nick"></div>
	<div class="input-icon in-i-pass"><input class="input" placeholder="'.$lang['password'].'" type="password" maxlength="100" id="password"/></div>
	<button class="button" id="submit">'.$lang['come'].'</button>

	<a class="d-block p-20 center" href="'.URL.'/restore/">'.$lang['no-pass'].'?</a>

	<a class="button d-block cl-white w-auto center bg-green" href="'.URL.'/signup">'.$lang['new-account'].'</a>

    <div style="margin: 20px 0 0 0;" class="wap">

    <div class="mb-10">'.$lang['lang'].':</div>

    <a style="margin: 0 10px 0 0;" href="'.URL.'/?lang=ua" none><img width="30" src="'.URL.'/assets/icons/lang/ua.png"></a>
    <a style="margin: 0 10px 0 0;" href="'.URL.'/?lang=ru" none><img width="30" src="'.URL.'/assets/icons/lang/ru.png"></a>
    <a style="margin: 0 10px 0 0;" href="'.URL.'/?lang=en" none><img width="30" src="'.URL.'/assets/icons/lang/en.png"></a>
    <a style="margin: 0 10px 0 0;" href="'.URL.'/?lang=uz" none><img width="30" src="'.URL.'/assets/icons/lang/uz.png"></a>
    
    </div>

	</div>';

}else{

	require 'modules/feed/index.php';

}

require_once 'core/foot.php';

?>