<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) or strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {exit;}

require_once '../../core/core.php';

if (!empty($user['notifications'])) $mysqli->query("UPDATE `users` SET `notifications` = '' WHERE `id` = '".$user_id."'");

if (!empty($_GET['id']) && is_numeric($_GET['id'])){
$id = abs(intval($_GET['id']));
$result = $mysqli->query("SELECT * FROM `direct` WHERE `for_id` = '".$user_id."' AND `from_id` = '".$id."' LIMIT 1");
if ($result->num_rows == false) exit;
$arr_dialog = $result->fetch_array();
if ($arr_dialog['user_pen']>(time()-5)){
?><script type="text/javascript">$('#direct-pen').show();</script><?php
}else{
?><script type="text/javascript">$('#direct-pen').hide();</script><?php
}

if ($_GET['user_pen'] == 1) $mysqli->query("UPDATE `direct` SET `user_pen` = '".time()."' WHERE `for_id` = '".$id."' AND `from_id` = '".$user_id."' LIMIT 1");
	
if ($arr_dialog['count'] > 0){
$user['notifications_mail'] = $user['notifications_mail']-$arr_dialog['count'];
?>
<script type="text/javascript">
$('#direct-pen').hide();
Dialog.Refresh(<?php echo$arr_dialog['from_id'];?>);
</script>
<?
}

if ($arr_dialog['np'] == 0){
?>
<script type="text/javascript">
$('#refresh_dialog .direct-check').replaceWith('<b class="direct-check"><i class="fa-regular fa-check-double"></i></b>');
</script>
<?
}
}

?>
<script type="text/javascript">
$('#count_mail').html("<?php echo ($user['notifications_mail']>0?'<b>'.$user['notifications_mail'].'</b>':'');?>");
$('#count_mail_mobile').html("<?php echo ($user['notifications_mail']>0?'<b>'.$user['notifications_mail'].'</b>':'');?>");
</script>
<?

if (empty($user['notifications_journal'])){
?>
<script type="text/javascript">
$('#count_journal').html("");
$('#count_journal_mobile').html("");
</script>
<?
}

# Уведомления о подписчиках
if (!empty($user['notifications']) && $user['notifications_follow'] > 0){
echo '<audio autoplay="autoplay" src="'.URL.'/assets/sounds/sound.ogg"></audio>';
}

# Уведомления в директе
if (!empty($user['notifications']) && $user['notifications_mail'] > 0){
echo '<audio autoplay="autoplay" src="'.URL.'/assets/sounds/sound.ogg"></audio>';
}

# Уведомления в журнале
if (!empty($user['notifications']) && $user['notifications_journal'] > 0){
$res = $mysqli->query("SELECT * FROM `notifications` WHERE `for_id` = '".$user_id."' AND `time` > ".(time()-5)."".$where." ORDER by `time` DESC LIMIT 1");
if ($res->num_rows == true){
$arr = $res->fetch_array();
echo '<audio autoplay="autoplay" src="'.URL.'/assets/sounds/sound.ogg"></audio>';
?>
<script type="text/javascript">
$('#count_journal').html("<?php echo '<b>'.$user['notifications_journal'].'</b>';?>");
$('#count_journal_mobile').html("<?php echo '<b></b>';?>");
</script>
<?
}
}
	
$mysqli->close();

?>
