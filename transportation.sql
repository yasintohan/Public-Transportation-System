-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 May 2020, 14:32:30
-- Sunucu sürümü: 10.4.11-MariaDB
-- PHP Sürümü: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `transportation`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `employee`
--

CREATE TABLE `employee` (
  `SSN` bigint(20) NOT NULL,
  `name` varchar(255) GENERATED ALWAYS AS (concat(`first_name`,' ',`middle_name`,' ',`last_name`)) STORED,
  `first_name` varchar(45) COLLATE utf8_turkish_ci NOT NULL,
  `middle_name` varchar(45) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `last_name` varchar(45) COLLATE utf8_turkish_ci NOT NULL,
  `gender` enum('Male','Female','Other') COLLATE utf8_turkish_ci NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) DEFAULT NULL,
  `adress` varchar(255) GENERATED ALWAYS AS (concat(`city`,' ',`state`,' ',`zipcode`)) STORED,
  `city` varchar(45) COLLATE utf8_turkish_ci NOT NULL,
  `state` varchar(45) COLLATE utf8_turkish_ci NOT NULL,
  `zipcode` int(11) NOT NULL,
  `garage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `employee`
--

INSERT INTO `employee` (`SSN`, `first_name`, `middle_name`, `last_name`, `gender`, `birthdate`, `age`, `city`, `state`, `zipcode`, `garage`) VALUES
(11945863940, 'Yasin', ' ', 'Tohan', 'Male', '1999-06-27', 21, 'Istanbul', 'Avcılar', 34310, 1),
(25874136900, 'Merve', ' ', 'Koca', 'Female', '1995-05-06', 25, 'Istanbul', 'Avcılar', 34320, 1),
(33548890254, 'Gülizar', ' ', 'Gümüş', 'Female', '1994-01-19', 26, 'Istanbul', 'Bakırköy', 34260, 3),
(78545002540, 'Hasan', 'Ali', 'Demir', 'Male', '1992-02-20', 28, 'Istanbul', 'Beylikdüzü', 34570, 2),
(78545632540, 'Rıdvan', ' ', 'Tufan', 'Male', '1990-09-06', 30, 'Istanbul', 'Beylikdüzü', 34580, 2),
(96480305047, 'Zeynep', 'Nur', 'Bakır', 'Female', '1991-07-14', 29, 'Istanbul', 'Bakırköy', 34200, 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `employee_contact`
--

CREATE TABLE `employee_contact` (
  `employee_SSN` bigint(20) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `employee_contact`
--

INSERT INTO `employee_contact` (`employee_SSN`, `contact`) VALUES
(11945863940, '05427108106'),
(11945863940, '05555999609'),
(25874136900, '05328523695'),
(78545002540, '05354642545'),
(78545002540, '05458785487'),
(78545632540, '05454789721'),
(33548890254, '05364896512'),
(96480305047, '05487221121');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `employee_drive`
--

CREATE TABLE `employee_drive` (
  `drive_SSN` bigint(20) NOT NULL,
  `drive_vehicle_Id` int(11) NOT NULL,
  `drive_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `employee_drive`
--

INSERT INTO `employee_drive` (`drive_SSN`, `drive_vehicle_Id`, `drive_date`) VALUES
(11945863940, 1, '2020-05-13'),
(11945863940, 1, '2020-05-12'),
(11945863940, 1, '2020-05-10'),
(11945863940, 1, '2020-05-09'),
(11945863940, 1, '2020-05-08'),
(11945863940, 1, '2020-05-07'),
(11945863940, 3, '2020-05-06'),
(11945863940, 3, '2020-05-05'),
(11945863940, 3, '2020-05-04'),
(11945863940, 3, '2020-05-11'),
(11945863940, 1, '2020-05-03'),
(11945863940, 1, '2020-05-02'),
(11945863940, 1, '2020-05-01'),
(11945863940, 1, '2020-04-30'),
(11945863940, 1, '2020-04-29'),
(11945863940, 1, '2020-04-28'),
(11945863940, 3, '2020-04-27'),
(11945863940, 3, '2020-04-26'),
(11945863940, 3, '2020-04-25'),
(11945863940, 3, '2020-04-24'),
(11945863940, 1, '2020-04-23'),
(11945863940, 1, '2020-04-22'),
(11945863940, 1, '2020-04-21'),
(11945863940, 1, '2020-04-20'),
(11945863940, 1, '2020-04-19'),
(11945863940, 1, '2020-04-18'),
(11945863940, 3, '2020-04-17'),
(11945863940, 3, '2020-04-16'),
(11945863940, 3, '2020-04-15'),
(11945863940, 3, '2020-04-14'),
(25874136900, 3, '2020-05-13'),
(25874136900, 3, '2020-05-12'),
(25874136900, 3, '2020-05-10'),
(25874136900, 3, '2020-05-09'),
(25874136900, 3, '2020-05-08'),
(25874136900, 3, '2020-05-07'),
(25874136900, 1, '2020-05-06'),
(25874136900, 1, '2020-05-05'),
(25874136900, 1, '2020-05-04'),
(25874136900, 1, '2020-05-11'),
(25874136900, 3, '2020-05-03'),
(25874136900, 3, '2020-05-02'),
(25874136900, 3, '2020-05-01'),
(25874136900, 3, '2020-04-30'),
(25874136900, 3, '2020-04-29'),
(25874136900, 3, '2020-04-28'),
(25874136900, 1, '2020-04-27'),
(25874136900, 1, '2020-04-26'),
(25874136900, 1, '2020-04-25'),
(25874136900, 1, '2020-04-24'),
(25874136900, 3, '2020-04-23'),
(25874136900, 3, '2020-04-22'),
(25874136900, 3, '2020-04-21'),
(25874136900, 3, '2020-04-20'),
(25874136900, 3, '2020-04-19'),
(25874136900, 3, '2020-04-18'),
(25874136900, 1, '2020-04-17'),
(25874136900, 1, '2020-04-16'),
(25874136900, 1, '2020-04-15'),
(25874136900, 1, '2020-04-14'),
(78545002540, 2, '2020-05-13'),
(78545002540, 2, '2020-05-12'),
(78545002540, 4, '2020-05-10'),
(78545002540, 4, '2020-05-09'),
(78545002540, 6, '2020-05-08'),
(78545002540, 6, '2020-05-07'),
(78545002540, 2, '2020-05-06'),
(78545002540, 2, '2020-05-05'),
(78545002540, 4, '2020-05-04'),
(78545002540, 4, '2020-05-11'),
(78545002540, 6, '2020-05-03'),
(78545002540, 6, '2020-05-02'),
(78545002540, 2, '2020-05-01'),
(78545002540, 2, '2020-04-30'),
(78545002540, 4, '2020-04-29'),
(78545002540, 4, '2020-04-28'),
(78545002540, 6, '2020-04-27'),
(78545002540, 6, '2020-04-26'),
(78545632540, 4, '2020-05-13'),
(78545632540, 4, '2020-05-12'),
(78545632540, 6, '2020-05-10'),
(78545632540, 6, '2020-05-09'),
(78545632540, 2, '2020-05-08'),
(78545632540, 2, '2020-05-07'),
(78545632540, 4, '2020-05-06'),
(78545632540, 4, '2020-05-05'),
(78545632540, 6, '2020-05-04'),
(78545632540, 6, '2020-05-11'),
(78545632540, 2, '2020-05-03'),
(78545632540, 2, '2020-05-02'),
(78545632540, 4, '2020-05-01'),
(78545632540, 4, '2020-04-30'),
(78545632540, 6, '2020-04-29'),
(78545632540, 6, '2020-04-28'),
(78545632540, 2, '2020-04-27'),
(78545632540, 2, '2020-04-26'),
(33548890254, 5, '2020-05-13'),
(33548890254, 5, '2020-05-12'),
(33548890254, 5, '2020-05-10'),
(33548890254, 5, '2020-05-09'),
(33548890254, 5, '2020-05-08'),
(33548890254, 7, '2020-05-07'),
(33548890254, 7, '2020-05-06'),
(33548890254, 7, '2020-05-05'),
(33548890254, 5, '2020-05-04'),
(33548890254, 5, '2020-05-11'),
(33548890254, 5, '2020-05-03'),
(33548890254, 7, '2020-05-02'),
(33548890254, 7, '2020-05-01'),
(33548890254, 7, '2020-04-30'),
(33548890254, 5, '2020-04-29'),
(33548890254, 5, '2020-04-28'),
(33548890254, 5, '2020-04-27'),
(33548890254, 5, '2020-04-26'),
(96480305047, 7, '2020-05-13'),
(96480305047, 7, '2020-05-12'),
(96480305047, 7, '2020-05-10'),
(96480305047, 7, '2020-05-09'),
(96480305047, 7, '2020-05-08'),
(96480305047, 5, '2020-05-07'),
(96480305047, 5, '2020-05-06'),
(96480305047, 5, '2020-05-05'),
(96480305047, 7, '2020-05-04'),
(96480305047, 7, '2020-05-11'),
(96480305047, 7, '2020-05-03'),
(96480305047, 5, '2020-05-02'),
(96480305047, 5, '2020-05-01'),
(96480305047, 5, '2020-04-30'),
(96480305047, 7, '2020-04-29'),
(96480305047, 7, '2020-04-28'),
(96480305047, 7, '2020-04-27'),
(96480305047, 7, '2020-04-26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `garage`
--

CREATE TABLE `garage` (
  `garage_Id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `adress` varchar(255) GENERATED ALWAYS AS (concat(`city`,' ',`state`,' ',`zipcode`)) STORED,
  `city` varchar(45) COLLATE utf8_turkish_ci NOT NULL,
  `state` varchar(45) COLLATE utf8_turkish_ci NOT NULL,
  `zipcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `garage`
--

INSERT INTO `garage` (`garage_Id`, `capacity`, `city`, `state`, `zipcode`) VALUES
(1, 20, 'Istanbul', 'Avcılar', 34310),
(2, 35, 'Istanbul', 'Beylikdüzü', 34250),
(3, 51, 'Istanbul', 'Bakırköy', 34580);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `route`
--

CREATE TABLE `route` (
  `route_Id` int(11) NOT NULL,
  `source_stop` varchar(50) NOT NULL,
  `destination_stop` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `route`
--

INSERT INTO `route` (`route_Id`, `source_stop`, `destination_stop`) VALUES
(1, 'Beylikdüzü Son Durak', 'Güzelyurt'),
(2, 'Beylikdüzü Son Durak', 'Avcılar'),
(3, 'Güzelyurt', 'Beylikdüzü Son Durak'),
(4, 'Avcılar', 'Beylikdüzü Son Durak'),
(5, 'Avcılar', 'Sefaköy'),
(6, 'Sefaköy', 'Avcılar');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `route_departure_time`
--

CREATE TABLE `route_departure_time` (
  `route_id` int(11) NOT NULL,
  `departure_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `route_departure_time`
--

INSERT INTO `route_departure_time` (`route_id`, `departure_time`) VALUES
(1, '08:00:00'),
(1, '10:00:00'),
(1, '12:00:00'),
(2, '10:30:00'),
(2, '12:30:00'),
(2, '14:30:00'),
(3, '09:00:00'),
(3, '11:00:00'),
(3, '13:00:00'),
(4, '15:00:00'),
(4, '17:00:00'),
(4, '19:00:00'),
(5, '14:00:00'),
(5, '16:00:00'),
(5, '18:00:00'),
(6, '16:00:00'),
(6, '18:00:00'),
(6, '20:00:00'),
(1, '14:00:00'),
(1, '16:00:00'),
(1, '18:00:00'),
(5, '20:00:00'),
(5, '22:00:00'),
(3, '21:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `route_goes`
--

CREATE TABLE `route_goes` (
  `route_route_Id` int(11) NOT NULL,
  `stop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `route_goes`
--

INSERT INTO `route_goes` (`route_route_Id`, `stop_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(3, 7),
(3, 6),
(3, 5),
(3, 4),
(3, 3),
(3, 2),
(3, 1),
(4, 10),
(4, 9),
(4, 8),
(4, 7),
(4, 6),
(4, 5),
(4, 4),
(4, 3),
(4, 2),
(4, 1),
(4, 11),
(5, 11),
(5, 12),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(5, 17),
(5, 18),
(6, 11),
(6, 12),
(6, 13),
(6, 14),
(6, 15),
(6, 16),
(6, 17),
(6, 18);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stop`
--

CREATE TABLE `stop` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_turkish_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `stop`
--

INSERT INTO `stop` (`id`, `name`, `location`) VALUES
(1, 'Beylikdüzü Son Durak', 'Büyükçekmece'),
(2, 'Beykent', 'Büyükçekmece'),
(3, 'Hadımköy', 'Büyükçekmece'),
(4, 'Cumhuriyet Mahallesi', 'Büyükçekmece'),
(5, 'Beylikdüzü Belediyesi', 'Büyükçekmece'),
(6, 'Beylikdüzü', 'Büyükçekmece'),
(7, 'Güzelyurt', 'Esenyurt'),
(8, 'Haramidere', 'Esenyurt'),
(9, 'Saadetdere', 'Esenyurt'),
(10, 'Üniversite', 'Avcılar'),
(11, 'Avcılar', 'Avcılar'),
(12, 'Şükrübey', 'Avcılar'),
(13, 'İBB', 'Küçükçekmece'),
(14, 'Küçükçekmece', 'Küçükçekmece'),
(15, 'Cennet Mahallesi', 'Küçükçekmece'),
(16, 'Florya', 'Bakırköy'),
(17, 'Beşyol', 'Bakırköy'),
(18, 'Sefaköy', 'Bakırköy');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_Id` int(11) NOT NULL,
  `seat_number` int(11) NOT NULL,
  `type` enum('Bus','Tram','Metro') COLLATE utf8_turkish_ci NOT NULL,
  `model` varchar(45) COLLATE utf8_turkish_ci NOT NULL,
  `garage` int(11) NOT NULL,
  `route` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `vehicle`
--

INSERT INTO `vehicle` (`vehicle_Id`, `seat_number`, `type`, `model`, `garage`, `route`) VALUES
(1, 70, 'Bus', 'Mercedes', 1, 4),
(2, 120, 'Tram', 'ESTRAM', 2, 2),
(3, 80, 'Bus', 'BMC', 1, 5),
(4, 125, 'Tram', 'ESTRAM', 2, 3),
(5, 75, 'Bus', 'Mercedes', 3, 6),
(6, 200, 'Metro', 'ISMETRO', 2, 1),
(7, 220, 'Metro', 'ISMETRO', 3, 6);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`SSN`),
  ADD UNIQUE KEY `SSN_UNIQUE` (`SSN`),
  ADD KEY `garage` (`garage`);

--
-- Tablo için indeksler `employee_contact`
--
ALTER TABLE `employee_contact`
  ADD KEY `employee_SSN` (`employee_SSN`);

--
-- Tablo için indeksler `employee_drive`
--
ALTER TABLE `employee_drive`
  ADD KEY `drive_vehicle_Id` (`drive_vehicle_Id`),
  ADD KEY `drive_SSN` (`drive_SSN`);

--
-- Tablo için indeksler `garage`
--
ALTER TABLE `garage`
  ADD PRIMARY KEY (`garage_Id`),
  ADD UNIQUE KEY `garage_Id_UNIQUE` (`garage_Id`);

--
-- Tablo için indeksler `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_Id`),
  ADD UNIQUE KEY `route_Id_UNIQUE` (`route_Id`);

--
-- Tablo için indeksler `route_departure_time`
--
ALTER TABLE `route_departure_time`
  ADD KEY `departure_route_id` (`route_id`);

--
-- Tablo için indeksler `route_goes`
--
ALTER TABLE `route_goes`
  ADD KEY `route_route_Id` (`route_route_Id`),
  ADD KEY `stop_stop_id` (`stop_id`);

--
-- Tablo için indeksler `stop`
--
ALTER TABLE `stop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Tablo için indeksler `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_Id`),
  ADD UNIQUE KEY `vehicle_Id_UNIQUE` (`vehicle_Id`),
  ADD KEY `garage` (`garage`),
  ADD KEY `route` (`route`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `garage`
--
ALTER TABLE `garage`
  MODIFY `garage_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `route`
--
ALTER TABLE `route`
  MODIFY `route_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `stop`
--
ALTER TABLE `stop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_garage_fk` FOREIGN KEY (`garage`) REFERENCES `garage` (`garage_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `employee_contact`
--
ALTER TABLE `employee_contact`
  ADD CONSTRAINT `employee_contact_SSN_fk` FOREIGN KEY (`employee_SSN`) REFERENCES `employee` (`SSN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `employee_drive`
--
ALTER TABLE `employee_drive`
  ADD CONSTRAINT `drive_SSN_fk` FOREIGN KEY (`drive_SSN`) REFERENCES `employee` (`SSN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `drive_vehicle_Id_fk` FOREIGN KEY (`drive_vehicle_Id`) REFERENCES `vehicle` (`vehicle_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `route_departure_time`
--
ALTER TABLE `route_departure_time`
  ADD CONSTRAINT `departure_route_id_fk` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `route_goes`
--
ALTER TABLE `route_goes`
  ADD CONSTRAINT `id_fk` FOREIGN KEY (`stop_id`) REFERENCES `stop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `route_Id_fk` FOREIGN KEY (`route_route_Id`) REFERENCES `route` (`route_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_garage_fk` FOREIGN KEY (`garage`) REFERENCES `garage` (`garage_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicle_route_fk` FOREIGN KEY (`route`) REFERENCES `route` (`route_Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
