<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

# Публикация

function post($arr, $url = 0, $mb = 0, $rounded = 0, $cut = 0){
    global $user, $user_id, $mysqli, $lang;

    $count_like = $mysqli->query("SELECT `id` FROM `wall_like` WHERE `post_id` = '".$arr['id']."'")->num_rows;
    $count_comm = $mysqli->query("SELECT `id` FROM `wall_comm` WHERE `post_id` = '".$arr['id']."'")->num_rows;
    $count_repost = $mysqli->query("SELECT `id` FROM `wall_repost` WHERE `post_id` = '".$arr['id']."'")->num_rows;

    echo '<div class="bg-white br-c-v br-f br-n '.($rounded == 1?'round-10':'round-t-10').' '.($mb == 1?'mb-10':'').'">';

    echo '<div class="table p-15">';

    echo '<div class="con-avatar">'.user_avatar($arr['user_id']).'</div>
    <div class="con-online">'.user_online($arr['user_id']).'</div>
    <div class="con-info">
    <div class="user-name d-block">'.user_nick($arr['user_id'],1,1).'</div>
    '.(!empty($arr['place'])?'<div class="con-add">'.text($arr['place']).'</div>':'').'
    </div>';

    $ulevel = $mysqli->query("SELECT `id`, `level` FROM `users` WHERE `id` = '".$arr['user_id']."' LIMIT 1")->fetch_array();

    if (!empty($user_id) && ($user['level'] > $ulevel['level'] || $user['level'] > $ulevel['level'] || $user_id == $arr['user_id'])){

        echo '<a class="toggle-menu-act" onclick="UI.toggleMenu(this);"><span></span></a>
        <div class="toggle-menu">
        <div class="toggle-menu-arrow"><span></span></div>
        <ul class="toggle-menu-block">
        <a href="'.URL.'/p/edit/'.$arr['id'].'/">'.$lang['edit'].'</a>
        <a href="'.URL.'/p/del'.$arr['id'].'">'.$lang['delete'].'</a>
        </ul>
        </div>';

    }

    echo '</div>';

    echo '<div class="con-content">';

    # Фото


    if (!empty($arr['photo'])){

        echo '<div style="background:
        '.(file_exists(HOME .'/assets/files/public/'.$arr['user_id'].'/photo/full/'.$arr['photo'].'')?'
        url('.URL.'/assets/files/public/'.$arr['user_id'].'/photo/full/'.$arr['photo'].') no-repeat center,
        url('.URL.'/assets/icons/blur.png),
        url('.URL.'/assets/files/public/'.$arr['user_id'].'/photo/full/'.$arr['photo'].') no-repeat;
        background-size: contain, cover, cover;':'
        url('.URL.'/assets/icons/no-photo.png) no-repeat center;
        background-size: cover;').'
        " class="con-photo"></div>';

    }else if (!empty($arr['video'])){

        # Видеозапись

        echo '<div id="player'.$arr['id'].'"></div>';

        ?>
        <script>
        var player = new Playerjs({id:"player<?echo ''.$arr['id'].'';?>", file:"<?echo ''.URL.'/assets/files/public/'.$arr['user_id'].'/video/file/'.$arr['video'].'';?>", poster:"<?echo ''.URL.'/'.(!empty($arr['preview']) && file_exists(HOME .'/assets/files/public/'.$arr['user_id'].'/video/preview/'.$arr['preview'].'')?'assets/files/public/'.$arr['user_id'].'/video/preview/'.$arr['preview'].'':'/assets/icons/no-video.png').'';?>"});
        </script>
        <?

    }

    $count_like = $mysqli->query("SELECT `id` FROM `public_like` WHERE `post_id` = '".$arr['id']."'")->num_rows;
    $count_comm = $mysqli->query("SELECT `id` FROM `public_comm` WHERE `post_id` = '".$arr['id']."'")->num_rows;
    $count_fav = $mysqli->query("SELECT `id` FROM `public_fav` WHERE `post_id` = '".$arr['id']."'")->num_rows;

    # Навигация
    echo '<div class="con-panel">';

    # Лайк

    if (!empty($user_id)){

        if ($mysqli->query("SELECT `user_id`, `post_id` FROM `public_like` WHERE `user_id` = '".$user_id."' AND `post_id` = '".$arr['id']."' LIMIT 1")->num_rows == false){

            echo '<div class="con-panel-like" id="like_'.$arr['id'].'">
            <a class="go-like" href="'.URL.'/p/like'.$arr['id'].'" data-id="'.$arr['id'].'" none><i class="fa-light fa-heart"></i> '.($count_like>0?'<b>'.$count_like.'</b>':'').'</a>
            </div>';

        }else{

            echo '<div class="con-panel-like" id="like_'.$arr['id'].'">
            <a style="color: #f44336;" class="go-like" href="'.URL.'/p/like'.$arr['id'].'" data-id="'.$arr['id'].'" none><i class="fa-solid fa-heart"></i> '.($count_like>0?'<b>'.$count_like.'</b>':'').'</a>
            </div>';

        }

    }else{

        echo '<div class="con-panel-like"><a href="'.URL.'/p/like/'.$arr['id'].'/"><i class="fa-light fa-heart"></i> <b>'.$count_like.'</b></a></div>';

    }

    # Комментарии
    echo '<div class="con-panel-comm"><a href="'.URL.'/p/'.$arr['id'].'/"><i class="fa-light fa-comment"></i> '.($count_comm>0?'<b>'.$count_comm.'</b>':'').'</a></div>';

    # Избранное

    if (!empty($user_id)){

        if ($mysqli->query("SELECT `user_id`, `post_id` FROM `public_fav` WHERE `user_id` = '".$user_id."' AND `post_id` = '".$arr['id']."' LIMIT 1")->num_rows == false){

            echo '<div class="con-panel-fav" id="fav_'.$arr['id'].'">
            <a class="go-fav" href="'.URL.'/p/favorites'.$arr['id'].'" data-id="'.$arr['id'].'" none><i class="fa-light fa-bookmark"></i></a>
            </div>';

        }else{

            echo '<div class="con-panel-fav" id="fav_'.$arr['id'].'">
            <a class="go-fav" href="'.URL.'/p/favorites'.$arr['id'].'" data-id="'.$arr['id'].'" none><i class="fa-solid fa-bookmark"></i></a>
            </div>';

        }

    }

    echo '</div>';


    # Текст

    if (!empty($arr['adult'] == 0 || $user_id == $arr['user_id'] || $user['premium'] == 1 || $user['level'] > 0)){

        if (!empty($arr['text'])){

            echo '<div class="con-text lh-1">'.($cut == 1?' '.text(hashtag(links(emoji(cut($arr['text'], URL.'/p/'.$arr['id'].'/'))))).' ':' '.text(hashtag(links(emoji($arr['text'])))).'').'</div>';

        }

    }else{

        echo '<div class="con-text lh-1 center">'.$lang['no-adult'].'!</div>';

    }

    # Время публикации

    echo '<div class="con-time"><i style="padding: 0 3px 0 0;" class="fa-light fa-timer"></i> '.vtime($arr['time']).'</div>';

    echo '</div>';

    # Выводим последние лайки

    $all = $mysqli->query("SELECT `id` FROM `public_like` WHERE `post_id` = '".$arr['id']."'")->num_rows;
    $arr_like = $mysqli->query("SELECT * FROM `public_like` WHERE `post_id` = '".$arr['id']."' ORDER by RAND() DESC LIMIT 5");

    if ($all > 0){

        echo '<div class="con-panel-like-view"">';

        while ($arru = $arr_like->fetch_array()){
            echo '<div class="con-panel-like-view-avatars">';
            echo ''.user_avatar($arru['user_id'],0,0).'';
            echo '</div>';
        }

    $arr_like_time = $mysqli->query("SELECT * FROM `public_like` WHERE `post_id` = '".$arr['id']."' ORDER by time DESC LIMIT 1");

    echo '<div class="con-panel-like-view-put">';

    echo $lang['like'].' ';

    while ($arrt = $arr_like_time->fetch_array()){ echo ''.user_nick($arrt['user_id'],1,0,0).''; }

        echo ''.($count_like > 1 ?' и <a href="'.URL.'/p/like/'.$arr['id'].'/">ещё '.($count_like-1).'</a>':'').'';
        echo '</div>';
        echo '</div>';

    }

    echo '</div>';

    }

# Контент публикации

function post_content($arr){
    global $user, $user_id, $mysqli;

        # Фото

        if (!empty($arr['photo'])){

            echo '<a href="'.URL.'/p/'.$arr['id'].'/">
            <div class="con-public">
            <div class="con-public-pic p-i i-p" style="background: url('.(file_exists(HOME .'/assets/files/public/'.$arr['user_id'].'/photo/mini/'.$arr['photo'].'')?''.URL.'/assets/files/public/'.$arr['user_id'].'/photo/mini/'.$arr['photo'].'':''.URL.'/assets/icons/no-photo.png').') no-repeat center; 
            background-size: cover;">
            </div>
            </div>
            </a>';

        }else if (!empty($arr['video'])){

            # Видео

            echo '<a href="'.URL.'/p/'.$arr['id'].'/">
            <div class="con-public">
            <div class="con-public-pic p-i i-v" style="background: url('.(!empty($arr['preview']) && file_exists(HOME .'/assets/files/public/'.$arr['user_id'].'/video/preview/'.$arr['preview'].'')?''.URL.'/assets/files/public/'.$arr['user_id'].'/video/preview/'.$arr['preview'].'':''.URL.'/assets/icons/no-video.png').') no-repeat center; 
            background-size: cover;">
            </div>
            </div>
            </a>';

        }

}

?>