<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

if (isset($user['id'])) $user_id = $user['id'];
if (isset($user['nick'])) $user_nick = $user['nick'];

$dir = opendir(HOME.'/core/autoload/');
while ($file = readdir($dir)){
	if (preg_match('/\.php$/i', $file)) require_once(HOME.'/core/autoload/'. $file);
}

# Функция для отображения голосового сообщения
function voice_message($arr, $user_id) {
    global $mysqli, $lang;
    
    $duration = !empty($arr['voice_duration']) ? $arr['voice_duration'] : 0;
    $file_url = URL.'/assets/files/direct/'.$arr['dialog_id'].'/voice/'.$arr['voice'];
    
    # Форматируем длительность
    $minutes = floor($duration / 60);
    $seconds = $duration % 60;
    $duration_formatted = sprintf("%02d:%02d", $minutes, $seconds);
    
    $html = '<div class="voice-message-container">';
    $html .= '<div class="voice-message" data-file="'.$file_url.'" data-duration="'.$duration.'">';
    $html .= '<button class="voice-play-btn" title="Воспроизвести"><i class="fa-solid fa-play"></i></button>';
    $html .= '<div class="voice-waveform">';
    $html .= '<div class="voice-wave"></div>';
    $html .= '<div class="voice-progress"></div>';
    $html .= '</div>';
    $html .= '<div class="voice-duration">'.$duration_formatted.'</div>';
    $html .= '</div>';
    $html .= '</div>';
    
    return $html;
}

# Функция для сохранения голосового сообщения
function save_voice_message($dialog_id, $from_id, $for_id, $file, $duration = 0, $text = '') {
    global $mysqli;
    
    $time = TIME;
    
    $mysqli->query("INSERT INTO `voice_messages` SET 
        `dialog_id` = '".$dialog_id."',
        `from_id` = '".$from_id."',
        `for_id` = '".$for_id."',
        `file` = '".$file."',
        `duration` = '".$duration."',
        `text` = '".check($text)."',
        `time` = '".$time."',
        `np` = 1");
    
    return $mysqli->insert_id;
}

# Ajax навигация
function nav($page, $pages, $link) {

if ($pages > 1) {
echo '<div id="ajax_load" class="center p-15" data-page="1" data-max="'.$pages.'"><img src="'.URL.'/assets/icons/loading.svg"></div>';
?>
<script>
var block_show = false;
function scrollMore(){
var $target = $('#ajax_load');
if (block_show) {
return false;
}

var et = $('#ajax_load');

if (et.length) {
var wt = $(window).scrollTop();
var wh = $(window).height();
var et = $target.offset().top;
var eh = $target.outerHeight();
var dh = $(document).height(); 
}
  
if (wt + wh >= et || wh + wt == dh || eh + et < wh){
var page = $target.attr('data-page');	
page++;
block_show = true;
$.ajax({ 
url: '<?echo''.$link.'';?>&page=' + page,   
dataType: 'html',
success: function(data){
$('#load_content').append(data);
block_show = false;
}
});
$target.attr('data-page', page);
if (page ==  $target.attr('data-max')) {
$target.remove();
}
}
}

$(window).scroll(function(){
scrollMore();
});
$(document).ready(function(){ 
scrollMore();
});
</script>
<?
}
}

# Ajax навигация комментариев
function nav_comm($page, $pages, $link) {
global $lang;
if ($pages > 1) {
echo '<div style="cursor:pointer;" data-page="1" data-max="'.$pages.'" id="ajax_load_comm" class="bg-white p-15 center shadow br-c-b br-l br-r br-n"><div>'.$lang['show-comm'].'</div></div>';
?>
<script>
$(function(){
$('#ajax_load_comm').click(function (){
var $target = $(this);
var page = $target.attr('data-page');	
page++;
$.ajax({ 
url: '<?echo''.$link.'';?>&page=' + page,  
dataType: 'html',
success: function(data){
$('#load_content_comm').append(data);
}
});
$target.attr('data-page', page);
if (page ==  $target.attr('data-max')) {
$target.hide();
}		
return false;
});
});
</script>
<?
}

}

# Конвертация чисел

function convert_num($number) {
  if ($number >= 1000) {
    $num = round(($number/1000), 1);
    return $num.'k';
  } else {
    return $number;
  }
}

# Время
function vtime($time = NULL){
global $settings, $user, $mysqli, $lang;
if (!$time)

$time = TIME;
$data = date('j.n.y', $time);
if ($data == date('j.n.y'))
$res = ''.$lang['day1'].' '.date('G:i', $time);
elseif ($data == date('j.n.y', TIME - 86400))
$res = ''.$lang['day2'].' '.date('G:i', $time);
elseif ($data == date('j.n.y', TIME - 172800))
$res = ''.$lang['day3'].' '.date('G:i', $time);
else
{
$m = array(
'0',
''.$lang['jan'].'',
''.$lang['feb'].'',
''.$lang['mar'].'',
''.$lang['apr'].'',
''.$lang['may'].'',
''.$lang['jun'].'',
''.$lang['jul'].'',
''.$lang['aug'].'',
''.$lang['sen'].'',
''.$lang['oct'].'',
''.$lang['noy'].'',
''.$lang['dec'].'');
$res = date('j '.$m[date('n', $time)].' Y в G:i', $time);
$res = str_replace(date('Y'), '', $res);
}
return $res;
}

function cut($str, $href, $num = 150) {
	global $lang;
	if (mb_strlen($str) > $num) $str = str_replace("|", "", mb_substr(str_replace("", "|", $str), 0, $num, 'UTF-8')).'...
	<a href="'.$href.'" '.PAGE.'>'.$lang['more'].'...</a>';
	return $str;
}

function text($mes){
	$mes = nl2br($mes);
	return $mes;
}

function no_tags($mes){
	$mes = str_replace("<br />", "\r\n", $mes);
	return $mes;
}

# Успех
function success($text) {
	if (!empty($text)){
		$text = '<div class="success">'.$text.'</div>';
	}
	return $text;
}

# Ошибка
function error($error) {
	if ($error == true) $error = '<div class="error">'.$error.'</div>';
	else $error = '';
	return $error;
}

# Расширение файла
function getRaz($filename) {
    return end(explode(".", $filename));
}

function generate($number){
	$arr = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','X','Y','Z','1','2','3','4','5','6','7','8','9','0');  
	# Генерируем пароль  
	$pass = '';  
	for($i = 0; $i < $number; $i++){
		# Вычисляем случайный индекс массива
		$index = rand(0, count($arr) - 1);
		$pass .= $arr[$index];  
	}
	return $pass;  
}

# Ссылки

function links($text){
	$text=preg_replace("/\/id(\\w+)/","<a style='color: #507fb7;' href='/id$1' onclick='Page.Go(this.href); return false'>$0</a>",$text);
	$text = preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a style='color: #507fb7;' href=\"$3\" target=\"blank\">$3</a>", str_replace("<br />", "\n", $text));
	return str_replace("\n", "<br />", $text);
}

# Хештеги

function hashtag($text){
    // Регулярное выражение для поиска хештегов в тексте
    $pattern = '/#(\p{L}+)/u';
    
    // Заменяем хештеги на ссылки
    $text = preg_replace_callback($pattern, function($matches) {
        $tag = $matches[1];
        return '<a class="cl-blue" href="'.URL.'/search/hashtag/?tag='.urlencode($tag).'" '.PAGE.'><b>#'.$tag.'</b></a>';
    }, $text);
    
    return $text;
}

# Запрещенные адреса

$error_url = [
    'account',
    'restore',
    'signup',
    'help',
    'about',
    'sogl',
    'rules',
    'faq',
    'contacts',
    'admin',
    'admins',
    'administrator',
    'moder',
    'moderator',
    'app',
    'lang',
    'news',
    'search',
    'notify',
    'direct',
    'edit',
    'settings',
    'panel',
    'exit',
    'followers',
    'following',
    'public',
    'story'
];

# Рекурсивное удаление папки
function delete_dir($dir){
	if (is_dir($dir)){$od=opendir($dir);
		while ($rd=readdir($od)){
			if ($rd == '.' || $rd == '..') continue;
				if (is_dir("$dir/$rd")){
					@chmod("$dir/$rd", 0777);
					delete_dir("$dir/$rd");}
						else{
							@chmod("$dir/$rd", 0777);
							@unlink("$dir/$rd");}}
							closedir($od);
							@chmod("$dir", 0777);
							return @rmdir("$dir");}
								else{
									@chmod("$dir", 0777);
									@unlink("$dir");}
}

# Функция для создания миниатюр аватарок
function create_avatar_thumbnail($source_path, $width, $height) {
    if (!file_exists($source_path)) {
        return false;
    }
    
    $info = getimagesize($source_path);
    if (!$info) {
        return false;
    }
    
    $mime = $info['mime'];
    
    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source_path);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source_path);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source_path);
            break;
        case 'image/webp':
            $image = imagecreatefromwebp($source_path);
            break;
        default:
            return false;
    }
    
    if (!$image) {
        return false;
    }
    
    $source_width = imagesx($image);
    $source_height = imagesy($image);
    
    // Создаем новое изображение
    $thumbnail = imagecreatetruecolor($width, $height);
    
    // Прозрачность для PNG/GIF
    if ($mime == 'image/png' || $mime == 'image/gif') {
        imagealphablending($thumbnail, false);
        imagesavealpha($thumbnail, true);
        $transparent = imagecolorallocatealpha($thumbnail, 0, 0, 0, 127);
        imagefill($thumbnail, 0, 0, $transparent);
    }
    
    // Масштабирование с сохранением пропорций
    $source_aspect = $source_width / $source_height;
    $thumbnail_aspect = $width / $height;
    
    if ($source_aspect > $thumbnail_aspect) {
        // Источник шире
        $new_height = $height;
        $new_width = $source_width * ($height / $source_height);
    } else {
        // Источник выше
        $new_width = $width;
        $new_height = $source_height * ($width / $source_width);
    }
    
    // Центрирование
    $x_offset = ($width - $new_width) / 2;
    $y_offset = ($height - $new_height) / 2;
    
    // Копирование и масштабирование
    imagecopyresampled($thumbnail, $image, $x_offset, $y_offset, 0, 0, $new_width, $new_height, $source_width, $source_height);
    
    // Сохранение
    switch ($mime) {
        case 'image/jpeg':
            imagejpeg($thumbnail, $source_path, 90);
            break;
        case 'image/png':
            imagepng($thumbnail, $source_path, 9);
            break;
        case 'image/gif':
            imagegif($thumbnail, $source_path);
            break;
        case 'image/webp':
            imagewebp($thumbnail, $source_path, 90);
            break;
    }
    
    imagedestroy($image);
    imagedestroy($thumbnail);
    
    return true;
}

# Блокировка аккаунта
require_once HOME.'/core/ban.php';
require_once HOME.'/core/dostup.php';

?>