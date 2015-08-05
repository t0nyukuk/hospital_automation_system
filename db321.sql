-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 05 Ağu 2015, 10:42:14
-- Sunucu sürümü: 5.6.26
-- PHP Sürümü: 5.5.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `db321`
--

DELIMITER $$
--
-- Yordamlar
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `FutureRendezvous`(IN id_val INT)
BEGIN  
 SELECT r.id, r.time, d.name AS doctor_name, d.id AS doctor_id 
  FROM rendezvous r INNER JOIN doctor d ON r.doctor_id=d.id 
    WHERE r.time > now() AND r.patient_id = id_val ORDER BY time ASC; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PastRendezvous`(IN id_val INT)
BEGIN  
 SELECT r.id, r.time, d.name AS doctor_name, d.id AS doctor_id 
  FROM rendezvous r INNER JOIN doctor d ON r.doctor_id=d.id 
    WHERE r.time < now() AND r.patient_id = id_val ORDER BY time ASC; 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `branch`
--

INSERT INTO `branch` (`id`, `name`) VALUES
(1, 'tmp'),
(2, 'tmp2'),
(3, 'tmp3'),
(4, 'tmp4'),
(5, 'tmp5'),
(6, 'ymp6');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `service_begin_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `branch_id`, `birth_date`, `service_begin_date`) VALUES
(1, 'Hakan Kalayci', 1, '1995-05-29', '2010-05-29'),
(3, 'Fatih Kececi', 1, '1995-06-14', '2014-07-10'),
(5, 'Taha Genc', 6, '1995-10-31', '2015-07-30'),
(6, 'Batuhan Tuncel', 5, '1995-09-06', '2015-07-22');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `members`
--

INSERT INTO `members` (`id`, `name`, `lastname`, `email`, `password`, `type`) VALUES
(1, 'admin', 'reyiz', 'admin@example.com', 'admin', 0),
(2, 'yusuf hakan', 'kalayci', 'yusufhakank@gmail.com', '123456', 1),
(3, 'Yusuf hakan', 'kalayci', 'yhkalayci@gmail.com', '123456', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rendezvous`
--

CREATE TABLE IF NOT EXISTS `rendezvous` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `rendezvous`
--

INSERT INTO `rendezvous` (`id`, `time`, `doctor_id`, `patient_id`) VALUES
(5, '2015-10-20 23:00:00', 6, 2),
(6, '2015-09-10 23:00:00', 1, 2),
(7, '1970-01-16 00:00:00', 5, 2),
(8, '2015-09-04 23:00:00', 3, 2),
(9, '2015-08-08 23:00:00', 1, 2),
(10, '2015-10-04 23:00:00', 6, 2),
(11, '2015-08-04 23:00:00', 6, 3),
(14, '2015-08-04 23:00:00', 3, 3),
(17, '2015-09-04 23:00:00', 1, 3);

--
-- Tetikleyiciler `rendezvous`
--
DELIMITER $$
CREATE TRIGGER `new_rendezvous_added` AFTER INSERT ON `rendezvous`
 FOR EACH ROW BEGIN 
   INSERT INTO email (time,doctor_id,patient_id) VALUES (new.time,new.doctor_id,new.patient_id);
  END
$$
DELIMITER ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Tablo için indeksler `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Tablo için indeksler `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- Tablo için AUTO_INCREMENT değeri `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `rendezvous`
--
ALTER TABLE `rendezvous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`);

--
-- Tablo kısıtlamaları `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`),
  ADD CONSTRAINT `email_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `members` (`id`);

--
-- Tablo kısıtlamaları `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD CONSTRAINT `rendezvous_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`),
  ADD CONSTRAINT `rendezvous_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `members` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
