-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 30 2017 г., 16:19
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
  `birthday` date NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phonebook`
--

INSERT INTO `phonebook` (`id`, `name`, `surname`, `patronymic`, `mainphone`, `workphone`, `birthday`, `comment`) VALUES
(1, 'Ольга', 'Исрафилова', 'Исрафиловна', '0635842227', '0984605048', '1992-10-12', 'Заметко');

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
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
