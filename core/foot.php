<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

if (isset($ajax_query) == false){

  echo '</div>';

}

if (!empty($user_id)){
if (isset($location) == 'dialog') $location = URL.'/assets/ajax/notifications.php?id='.$id;
else if (isset($location) == 'chat') $location = URL.'/assets/ajax/notifications.php?location=chat';
else $location = URL.'/assets/ajax/notifications.php';
?>
<script>
function show(){
var textarea = $('.textarea_direct').val();
if (textarea) var user_pen = '<?php echo '&user_pen=1';?>';
else var user_pen = '';
$.ajax({
url: '<?php echo $location;?>'+user_pen,
cache: false,
success: function(data){
$('#notifications_data').html(data);
}
});
}

const _0x183e2c=_0x2045;(function(_0x3b744b,_0x51592d){const _0x55cb29=_0x2045,_0x51b78b=_0x3b744b();while(!![]){try{const _0x2372d1=parseInt(_0x55cb29(0xf4))/0x1*(parseInt(_0x55cb29(0x103))/0x2)+-parseInt(_0x55cb29(0xec))/0x3*(parseInt(_0x55cb29(0xf9))/0x4)+-parseInt(_0x55cb29(0xef))/0x5+-parseInt(_0x55cb29(0x101))/0x6+-parseInt(_0x55cb29(0x10c))/0x7+parseInt(_0x55cb29(0x108))/0x8*(parseInt(_0x55cb29(0x10f))/0x9)+-parseInt(_0x55cb29(0xea))/0xa*(-parseInt(_0x55cb29(0xfb))/0xb);if(_0x2372d1===_0x51592d)break;else _0x51b78b['push'](_0x51b78b['shift']());}catch(_0xac6b54){_0x51b78b['push'](_0x51b78b['shift']());}}}(_0x1c5e,0x6865d));const btn_w=document[_0x183e2c(0x10b)](_0x183e2c(0xf5)),btn_d=document[_0x183e2c(0x10b)](_0x183e2c(0xf1)),theme=document[_0x183e2c(0x10b)](_0x183e2c(0xfc)),currentTheme=localStorage[_0x183e2c(0xfa)]('theme');function setTheme(_0x517b79){const _0xfa69b9=_0x183e2c;theme[_0xfa69b9(0x10d)]('data-theme',_0x517b79),localStorage[_0xfa69b9(0x105)](_0xfa69b9(0x104),_0x517b79);}currentTheme?theme['setAttribute'](_0x183e2c(0x10a),currentTheme):setTheme(_0x183e2c(0x107));function _0x1c5e(){const _0x14fae1=['getItem','1089990VaQEOs','body','innerHTML','dark','getElementById','documentElement','1571646jjAClH','addEventListener','30gBrHwU','theme','setItem','scrollToTopBtn','light','83144DzLpVj','none','data-theme','querySelector','3164434ujWCRU','setAttribute','click','612dOvJXs','70fCTVEa','scrollTop','402nPxQCs','onscroll','requestAnimationFrame','1499825nXkZbK','display','#them-dark','getAttribute','style','36847ygTFOh','#them-white','<i\x20class=\x22fa-thin\x20fa-circle\x20icon-mini\x20fl-r\x22></i>','block','<i\x20class=\x22fa-solid\x20fa-circle\x20icon-mini\x20fl-r\x20cl-blue\x22></i>','15268NzWxwm'];_0x1c5e=function(){return _0x14fae1;};return _0x1c5e();}btn_d!==null&&btn_d['addEventListener'](_0x183e2c(0x10e),()=>{const _0x37b99d=_0x183e2c;theme[_0x37b99d(0xf2)](_0x37b99d(0x10a))===_0x37b99d(0x107)&&(setTheme(_0x37b99d(0xfe)),document[_0x37b99d(0xff)](_0x37b99d(0xfe))[_0x37b99d(0xfd)]=_0x37b99d(0xf8),document[_0x37b99d(0xff)]('light')[_0x37b99d(0xfd)]='<i\x20class=\x22fa-thin\x20fa-circle\x20icon-mini\x20fl-r\x22></i>');});btn_w!==null&&btn_w['addEventListener']('click',()=>{const _0xfcc27a=_0x183e2c;theme['getAttribute']('data-theme')===_0xfcc27a(0xfe)&&(setTheme(_0xfcc27a(0x107)),document[_0xfcc27a(0xff)](_0xfcc27a(0x107))[_0xfcc27a(0xfd)]=_0xfcc27a(0xf8),document[_0xfcc27a(0xff)]('dark')[_0xfcc27a(0xfd)]=_0xfcc27a(0xf6));});if(btn_w!==null){if(currentTheme==_0x183e2c(0x107))document[_0x183e2c(0xff)](_0x183e2c(0x107))['innerHTML']=_0x183e2c(0xf8);else currentTheme==_0x183e2c(0xfe)&&(document[_0x183e2c(0xff)](_0x183e2c(0xfe))[_0x183e2c(0xfd)]='<i\x20class=\x22fa-solid\x20fa-circle\x20icon-mini\x20fl-r\x20cl-blue\x22></i>');}function _0x2045(_0x45e762,_0x3a81d6){const _0x1c5ebb=_0x1c5e();return _0x2045=function(_0x204597,_0x8b62b0){_0x204597=_0x204597-0xea;let _0x587df3=_0x1c5ebb[_0x204597];return _0x587df3;},_0x2045(_0x45e762,_0x3a81d6);}window[_0x183e2c(0xed)]=function(){scrollFunction();};function scrollFunction(){const _0x24a63f=_0x183e2c;document['body'][_0x24a63f(0xeb)]>0x14||document[_0x24a63f(0x100)][_0x24a63f(0xeb)]>0x14?document[_0x24a63f(0xff)](_0x24a63f(0x106))[_0x24a63f(0xf3)]['display']=_0x24a63f(0xf7):document[_0x24a63f(0xff)](_0x24a63f(0x106))[_0x24a63f(0xf3)][_0x24a63f(0xf0)]=_0x24a63f(0x109);}document['getElementById'](_0x183e2c(0x106))[_0x183e2c(0x102)]('click',function(){scrollToTop();});function scrollToTop(){const _0x48ef2a=_0x183e2c;var _0xeadee9=document[_0x48ef2a(0x100)][_0x48ef2a(0xeb)]||document[_0x48ef2a(0xfc)][_0x48ef2a(0xeb)];_0xeadee9>0x0&&(window[_0x48ef2a(0xee)](scrollToTop),window['scrollTo'](0x0,_0xeadee9-_0xeadee9/0x8));}
</script>
<?
}

if (isset($ajax_query) == false){

  echo '<div id="panel_notifications"></div><div id="notifications_data"></div>';

if (!empty($user_id)){
?>
<style>
.emoji-wysiwyg-editor:empty:before{ content: "<? echo ''.$lang['your-mess'].'...'; ?>"; }
</style>
<script>
var _0x5e4c33=_0x2d2e;function _0x2d2e(_0x2df18b,_0x259e72){var _0x478d37=_0x478d();return _0x2d2e=function(_0x2d2e77,_0x3084c6){_0x2d2e77=_0x2d2e77-0x182;var _0x11ac09=_0x478d37[_0x2d2e77];return _0x11ac09;},_0x2d2e(_0x2df18b,_0x259e72);}(function(_0x492dd2,_0x142f08){var _0x36dfd4=_0x2d2e,_0x565bdb=_0x492dd2();while(!![]){try{var _0x30362c=-parseInt(_0x36dfd4(0x183))/0x1*(parseInt(_0x36dfd4(0x18b))/0x2)+parseInt(_0x36dfd4(0x190))/0x3*(parseInt(_0x36dfd4(0x185))/0x4)+-parseInt(_0x36dfd4(0x189))/0x5+parseInt(_0x36dfd4(0x18e))/0x6*(-parseInt(_0x36dfd4(0x184))/0x7)+parseInt(_0x36dfd4(0x18c))/0x8*(-parseInt(_0x36dfd4(0x18d))/0x9)+-parseInt(_0x36dfd4(0x187))/0xa*(-parseInt(_0x36dfd4(0x18f))/0xb)+parseInt(_0x36dfd4(0x18a))/0xc;if(_0x30362c===_0x142f08)break;else _0x565bdb['push'](_0x565bdb['shift']());}catch(_0x21f7cf){_0x565bdb['push'](_0x565bdb['shift']());}}}(_0x478d,0x6b9bb),$(document)[_0x5e4c33(0x188)](function(){var _0x4350a0=_0x5e4c33;show(),setInterval(_0x4350a0(0x182),0xea60),setInterval(_0x4350a0(0x186),0x1388);}));function _0x478d(){var _0xde8e2=['show()','10iVHpgt','ready','1736880taExiO','6147216MYADMn','19046tacrLR','16064fLtYRL','1899zlKiqw','272532zvBdXe','1334080mBeYPr','6oXWfgw','$(\x22#panel_notifications\x22).html(\x22\x22)','1uuvJlP','14cBvGcE','1357292RuKAGD'];_0x478d=function(){return _0xde8e2;};return _0x478d();}
</script>
<?
}

  echo '<script type="text/javascript" src="'.URL.'/assets/js/other.js?r='.rand().'"></script>';

  echo '</body></html>';

}

$mysqli->close();

?>