-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 26 2024 г., 16:19
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `form`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users_data`
--

CREATE TABLE `users_data` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users_data`
--

INSERT INTO `users_data` (`id`, `login`, `email`, `password`) VALUES
(1, 'Kendrick Lamar', 'lamar@gmail.com', 'lamar'),
(2, 'Victor', 'ray@gmail.com', 'ray123'),
(3, 'Travis', 'scott@gmail.com', 'scott14'),
(4, 'Frank', 'ocean@gmail.com', 'oceanfrank'),
(5, 'Kanye43', 'west@gmail.com', 'west123'),
(8, '21 Savage', 'savage@gmail.com', 'savage21'),
(9, 'Kid Cudi', 'cudi@gmail.com', 'kid1cudi'),
(10, 'Lorde', 'lorde@gmail.com', 'lorde14'),
(11, 'Nurba14', 'muradnurbolat85@gmail.com', '142577nur'),
(12, 'Myles', 'smith@gmail.com', 'smith123');

-- --------------------------------------------------------

--
-- Структура таблицы `user_comment`
--

CREATE TABLE `user_comment` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login` (`login`),
  ADD KEY `login_2` (`login`);

--
-- Индексы таблицы `user_comment`
--
ALTER TABLE `user_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users_data`
--
ALTER TABLE `users_data`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `user_comment`
--
ALTER TABLE `user_comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
