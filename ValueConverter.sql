-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 10, 2023 at 08:15 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ValueConverter`
--

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int NOT NULL,
  `login` tinytext NOT NULL,
  `password` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `login`, `password`) VALUES
(1, 'first', '8b04d5e3775d298e78455efc5ca404d5'),
(2, 'second', 'a9f0e61a137d86aa9db53465e0801612');

-- --------------------------------------------------------

--
-- Table structure for table `Value`
--

CREATE TABLE `Value` (
  `id` tinytext NOT NULL,
  `char_code` tinytext NOT NULL,
  `nominal` int NOT NULL,
  `name` tinytext NOT NULL,
  `value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Value`
--

INSERT INTO `Value` (`id`, `char_code`, `nominal`, `name`, `value`) VALUES
('R01010', 'AUD', 1, 'Австралийский доллар', 50.1132),
('R01020A', 'AZN', 1, 'Азербайджанский манат', 44.6709),
('R01035', 'GBP', 1, 'Фунт стерлингов Соединенного королевства', 90.3086),
('R01060', 'AMD', 100, 'Армянских драмов', 19.5632),
('R01090B', 'BYN', 1, 'Белорусский рубль', 26.6758),
('R01100', 'BGN', 1, 'Болгарский лев', 40.9781),
('R01115', 'BRL', 1, 'Бразильский реал', 14.7888),
('R01135', 'HUF', 100, 'Венгерских форинтов', 20.9873),
('R01150', 'VND', 10000, 'Вьетнамских донгов', 32.1251),
('R01200', 'HKD', 10, 'Гонконгских долларов', 96.9248),
('R01210', 'GEL', 1, 'Грузинский лари', 29.2834),
('R01215', 'DKK', 1, 'Датская крона', 10.7696),
('R01230', 'AED', 1, 'Дирхам ОАЭ', 20.677),
('R01235', 'USD', 1, 'Доллар США', 75.9406),
('R01239', 'EUR', 1, 'Евро', 80.4009),
('R01240', 'EGP', 10, 'Египетских фунтов', 24.5867),
('R01270', 'INR', 100, 'Индийских рупий', 92.3129),
('R01280', 'IDR', 10000, 'Индонезийских рупий', 49.1907),
('R01335', 'KZT', 100, 'Казахстанских тенге', 17.2154),
('R01350', 'CAD', 1, 'Канадский доллар', 55.0693),
('R01355', 'QAR', 1, 'Катарский риал', 20.8628),
('R01370', 'KGS', 100, 'Киргизских сомов', 86.8687),
('R01375', 'CNY', 1, 'Китайский юань', 10.8995),
('R01500', 'MDL', 10, 'Молдавских леев', 40.4538),
('R01530', 'NZD', 1, 'Новозеландский доллар', 46.3693),
('R01535', 'NOK', 10, 'Норвежских крон', 71.2495),
('R01565', 'PLN', 1, 'Польский злотый', 17.1741),
('R01585F', 'RON', 1, 'Румынский лей', 16.3718),
('R01589', 'XDR', 1, 'СДР (специальные права заимствования)', 100.6851),
('R01625', 'SGD', 1, 'Сингапурский доллар', 56.0117),
('R01670', 'TJS', 10, 'Таджикских сомони', 69.5841),
('R01675', 'THB', 10, 'Таиландских батов', 21.6778),
('R01700J', 'TRY', 10, 'Турецких лир', 40.0816),
('R01710A', 'TMT', 1, 'Новый туркменский манат', 21.6973),
('R01717', 'UZS', 10000, 'Узбекских сумов', 66.5731),
('R01720', 'UAH', 10, 'Украинских гривен', 20.5624),
('R01760', 'CZK', 10, 'Чешских крон', 33.9354),
('R01770', 'SEK', 10, 'Шведских крон', 70.5394),
('R01775', 'CHF', 1, 'Швейцарский франк', 81.6478),
('R01805F', 'RSD', 100, 'Сербских динаров', 68.5543),
('R01810', 'ZAR', 10, 'Южноафриканских рэндов', 41.1413),
('R01815', 'KRW', 1000, 'Вон Республики Корея', 57.3483),
('R01820', 'JPY', 100, 'Японских иен', 55.8757);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
