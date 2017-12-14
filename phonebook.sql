-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 14 2017 г., 10:31
-- Версия сервера: 10.1.28-MariaDB
-- Версия PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `phonebook`
--

-- --------------------------------------------------------

--
-- Структура таблицы `phonebook`
--

CREATE TABLE `phonebook` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `patronymic` varchar(200) NOT NULL,
  `mainphone` varchar(20) NOT NULL,
  `workphone` varchar(20) NOT NULL,
  `birthday` date DEFAULT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phonebook`
--

INSERT INTO `phonebook` (`id`, `name`, `surname`, `patronymic`, `mainphone`, `workphone`, `birthday`, `comment`) VALUES
(85, 'Lena', 'Israfilova', 'Israfilovna', '09678554', '088545785', '1992-10-12', 'Заметко.'),
(87, 'Марина', 'Константировна', 'Михайловна', '454545454', '4545454545', '2017-12-10', 'Заметко'),
(88, 'jjj', '', 'jjjj', 'jjj', '', '2015-10-28', ''),
(89, 'гггг', '', '', 'ггг', '', '0000-00-00', ''),
(90, 'ооо', '', '', 'ооо', '', '0000-00-00', ''),
(91, 'Наталья', 'Савченко', 'Игоревна', '4588822', '', NULL, ''),
(92, 'Lena', 'israfilova', 'israfilovna', '065565656', '46556565', '0000-00-00', 'yyyyyy'),
(93, 'Lena', 'israfilova', 'israfilovna', '065565656', '46556565', '0000-00-00', 'yyyyyy'),
(94, 'Lena', 'Ivanova', 'Ivanovna', '458455555', '4555555', '1992-10-12', 'Comment'),
(95, 'Lena', 'Ivanova', 'Ivanovna', '458455555', '4555555', '1992-10-12', ''),
(96, 'Lena', 'Ivanova', 'Ivanovna', '458455555', '4555555', '1992-10-12', ''),
(97, 'Lena', 'Ivanova', 'Ivanovna', '458455555', '4555555', '1992-10-12', ''),
(98, 'Lena', 'Ivanova', 'Ivanovna', '458455555', '4555555', '1992-10-12', ''),
(99, 'Lena', 'Ivanova', 'Ivanovna', '458455555', '4555555', NULL, ''),
(100, 'гггг', '', '', 'ггг', '', '2017-12-20', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `phonebook`
--
ALTER TABLE `phonebook`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `phonebook`
--
ALTER TABLE `phonebook`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
