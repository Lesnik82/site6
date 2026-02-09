-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 24 2023 г., 23:50
-- Версия сервера: 5.6.51
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `insta`
--

-- --------------------------------------------------------

--
-- Структура таблицы `direct`
--

CREATE TABLE `direct` (
  `id` int(11) NOT NULL,
  `for_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `text` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `photo` int(1) DEFAULT '0',
  `from` int(11) NOT NULL,
  `np` int(11) DEFAULT '0',
  `count` int(11) DEFAULT '0',
  `del` int(11) DEFAULT '0',
  `dir` int(22) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `user_pen` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `direct_msg`
--

CREATE TABLE `direct_msg` (
  `id` int(11) NOT NULL,
  `for_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `text` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `photo` text,
  `np` int(11) DEFAULT '0',
  `del` int(11) DEFAULT '0',
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `for_id` int(11) NOT NULL,
  `type` int(1) DEFAULT '0',
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `for_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `sex` int(1) NOT NULL DEFAULT '1',
  `mod` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `refid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `new` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `public`
--

CREATE TABLE `public` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `text` varchar(2200) CHARACTER SET utf8mb4 NOT NULL,
  `photo` varchar(100) NOT NULL,
  `video` varchar(100) NOT NULL,
  `preview` varchar(100) NOT NULL,
  `place` varchar(50) NOT NULL,
  `like` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `public_cache`
--

CREATE TABLE `public_cache` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo` text,
  `video` text,
  `preview` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `public_comm`
--

CREATE TABLE `public_comm` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text` varchar(2200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `public_fav`
--

CREATE TABLE `public_fav` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `public_like`
--

CREATE TABLE `public_like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `keywords` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `dostup` int(1) NOT NULL,
  `reg` int(1) NOT NULL,
  `page` int(11) NOT NULL,
  `lang` varchar(5) NOT NULL,
  `official` int(11) NOT NULL,
  `video_time` varchar(50) NOT NULL,
  `video_size` int(11) NOT NULL,
  `updates` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `title`, `keywords`, `description`, `dostup`, `reg`, `page`, `lang`, `official`, `video_time`, `video_size`, `updates`) VALUES
(1, 'WONDERGRAM', 'Тест', 'Тест', 1, 1, 16, 'ru', 1, '00:03:01', 100, 1648576980);

-- --------------------------------------------------------

--
-- Структура таблицы `story`
--

CREATE TABLE `story` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `story_cache`
--

CREATE TABLE `story_cache` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo` text,
  `video` text,
  `preview` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `story_list`
--

CREATE TABLE `story_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `video` varchar(100) NOT NULL,
  `preview` varchar(100) NOT NULL,
  `text` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `type` varchar(50) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nick` varchar(30) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `pass` varchar(100) NOT NULL,
  `sex` int(1) DEFAULT NULL,
  `day` int(2) DEFAULT NULL,
  `month` int(2) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `about` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `site` varchar(100) DEFAULT NULL,
  `money` int(50) NOT NULL DEFAULT '0',
  `regtime` int(11) NOT NULL,
  `level` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `ip` varchar(25) NOT NULL,
  `ua` text NOT NULL,
  `device` varchar(15) NOT NULL,
  `visit` varchar(250) NOT NULL,
  `online` varchar(250) NOT NULL,
  `ban` int(1) DEFAULT '0',
  `ban_time` varchar(100) NOT NULL,
  `ban_text` varchar(500) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `access_page` int(1) DEFAULT '0',
  `access_fav` int(1) DEFAULT '0',
  `access_direct` int(1) DEFAULT '0',
  `access_online` int(1) DEFAULT '0',
  `verified` enum('0','1') NOT NULL DEFAULT '0',
  `notifications` int(11) DEFAULT NULL,
  `notifications_journal` int(11) DEFAULT '0',
  `notifications_mail` int(11) DEFAULT '0',
  `notifications_follow` int(11) DEFAULT '0',
  `count_follow` int(11) NOT NULL,
  `lang` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `nick`, `name`, `pass`, `sex`, `day`, `month`, `year`, `email`, `about`, `phone`, `site`, `money`, `regtime`, `level`, `ip`, `ua`, `device`, `visit`, `online`, `ban`, `ban_time`, `ban_text`, `avatar`, `access_page`, `access_fav`, `access_direct`, `access_online`, `verified`, `notifications`, `notifications_journal`, `notifications_mail`, `notifications_follow`, `count_follow`, `lang`) VALUES
(1, 'admin', '', 'c56d0e9a7ccec67b4ea131655038d604', NULL, NULL, NULL, NULL, 'admin@gmail.com', '', NULL, NULL, 0, 1698180572, '3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'Computer', '1698180646', '1', 0, '', '', '', 0, 0, 0, 0, '1', NULL, 0, 0, 0, 0, 'ru');

-- --------------------------------------------------------

--
-- Структура таблицы `users_new`
--

CREATE TABLE `users_new` (
  `id` int(11) NOT NULL,
  `nick` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `regtime` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `ua` text NOT NULL,
  `lang` varchar(5) NOT NULL,
  `link` varchar(50) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `direct`
--
ALTER TABLE `direct`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `direct_msg`
--
ALTER TABLE `direct_msg`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `public`
--
ALTER TABLE `public`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `public_cache`
--
ALTER TABLE `public_cache`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `public_comm`
--
ALTER TABLE `public_comm`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `public_fav`
--
ALTER TABLE `public_fav`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `public_like`
--
ALTER TABLE `public_like`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `story_cache`
--
ALTER TABLE `story_cache`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `story_list`
--
ALTER TABLE `story_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_new`
--
ALTER TABLE `users_new`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `direct`
--
ALTER TABLE `direct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `direct_msg`
--
ALTER TABLE `direct_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `public`
--
ALTER TABLE `public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `public_cache`
--
ALTER TABLE `public_cache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `public_comm`
--
ALTER TABLE `public_comm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `public_fav`
--
ALTER TABLE `public_fav`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `public_like`
--
ALTER TABLE `public_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `story`
--
ALTER TABLE `story`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `story_cache`
--
ALTER TABLE `story_cache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `story_list`
--
ALTER TABLE `story_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users_new`
--
ALTER TABLE `users_new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
