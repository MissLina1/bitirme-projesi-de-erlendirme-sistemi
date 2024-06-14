-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 24 May 2024, 19:27:31
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `bitirme_projesi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `danismanlar`
--

CREATE TABLE `danismanlar` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `danismanlar`
--

INSERT INTO `danismanlar` (`id`, `ad_soyad`) VALUES
(2, 'Öğr. Gör. Tuğba Altındağ'),
(3, 'Öğr. Gör. Tenin Çolak'),
(4, 'Dr. Öğr. Ü. Ahmet Turgut Tuncer');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `juriler`
--

CREATE TABLE `juriler` (
  `id` int(11) NOT NULL,
  `ad` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `juriler`
--

INSERT INTO `juriler` (`id`, `ad`) VALUES
(1, 'Mehmet Gülşen'),
(2, 'Muhammed Yorulmaz'),
(3, 'Gülin Can'),
(4, 'Tusan Derya'),
(5, 'Ramazan Tekinarslan'),
(6, 'Filiz İşleyen'),
(7, 'Haydar Baş'),
(8, 'Nazlıcan Çakmak'),
(9, 'Güliz Ayla'),
(10, 'Burçin Çakır');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `ID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`ID`, `email`, `password`) VALUES
(1, 'aleynaturan06@icloud.com', 'e72f238664cea7727a952e5642fdacec');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notlar`
--

CREATE TABLE `notlar` (
  `id` int(11) NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `proje_id` int(11) NOT NULL,
  `juri1_id` int(11) DEFAULT NULL,
  `juri2_id` int(11) DEFAULT NULL,
  `juri3_id` int(11) DEFAULT NULL,
  `juri4_id` int(11) DEFAULT NULL,
  `juri1_not` float DEFAULT NULL,
  `juri2_not` float DEFAULT NULL,
  `juri3_not` float DEFAULT NULL,
  `juri4_not` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `notlar`
--

INSERT INTO `notlar` (`id`, `ogrenci_id`, `proje_id`, `juri1_id`, `juri2_id`, `juri3_id`, `juri4_id`, `juri1_not`, `juri2_not`, `juri3_not`, `juri4_not`) VALUES
(4, 3, 13, 1, 3, 6, 7, 80, 70, 91.6667, 80),
(6, 2, 2, 1, 2, 3, 4, 63.3333, 90, 60, 80),
(9, 4, 3, 3, NULL, NULL, NULL, 80, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciler`
--

CREATE TABLE `ogrenciler` (
  `id` int(11) NOT NULL,
  `ogrenci_no` int(11) NOT NULL,
  `ad` varchar(50) NOT NULL,
  `soyad` varchar(50) NOT NULL,
  `proje_id` int(11) DEFAULT NULL,
  `danisman_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ogrenciler`
--

INSERT INTO `ogrenciler` (`id`, `ogrenci_no`, `ad`, `soyad`, `proje_id`, `danisman_id`) VALUES
(2, 22293876, 'Esad', 'Diktepe', 2, 2),
(3, 22297916, 'Aleyna', 'Turan', 13, 2),
(4, 22290123, 'Berk', 'Kuru', 3, 3),
(5, 22234512, 'Ahmet', 'Doğan', NULL, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `projeler`
--

CREATE TABLE `projeler` (
  `id` int(11) NOT NULL,
  `proje_ad` varchar(200) NOT NULL,
  `proje_suresi` enum('1 ay','2 ay','3 ay','4 ay') NOT NULL,
  `proje_yili` enum('2022-2023 Bahar','2022-2023 Güz','2023-2024 Bahar','2023-2024 Güz') NOT NULL,
  `danisman_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `projeler`
--

INSERT INTO `projeler` (`id`, `proje_ad`, `proje_suresi`, `proje_yili`, `danisman_id`) VALUES
(2, 'PHP Bitirme Projesi', '1 ay', '2023-2024 Bahar', 2),
(3, 'C# Bitirme Projesi', '4 ay', '2022-2023 Bahar', 4),
(13, 'Ağ Temelleri Bitirme Projesi', '1 ay', '2023-2024 Güz', 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `proje_juriler`
--

CREATE TABLE `proje_juriler` (
  `id` int(11) NOT NULL,
  `proje_id` int(11) NOT NULL,
  `juri_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `proje_juriler`
--

INSERT INTO `proje_juriler` (`id`, `proje_id`, `juri_id`) VALUES
(28, 2, 1),
(29, 2, 2),
(30, 2, 3),
(31, 2, 4),
(50, 3, NULL),
(51, 3, NULL),
(49, 3, 1),
(48, 3, 2),
(14, 13, 1),
(15, 13, 3),
(12, 13, 6),
(13, 13, 7);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `danismanlar`
--
ALTER TABLE `danismanlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `juriler`
--
ALTER TABLE `juriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `notlar`
--
ALTER TABLE `notlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ogrenci_id` (`ogrenci_id`),
  ADD KEY `proje_id` (`proje_id`),
  ADD KEY `juri_id` (`juri1_id`),
  ADD KEY `juri2_id` (`juri2_id`),
  ADD KEY `juri3_id` (`juri3_id`),
  ADD KEY `juri4_id` (`juri4_id`);

--
-- Tablo için indeksler `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proje_id` (`proje_id`),
  ADD KEY `danisman_id` (`danisman_id`);

--
-- Tablo için indeksler `projeler`
--
ALTER TABLE `projeler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `danisman_id` (`danisman_id`);

--
-- Tablo için indeksler `proje_juriler`
--
ALTER TABLE `proje_juriler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proje_id` (`proje_id`,`juri_id`),
  ADD KEY `juri_id` (`juri_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `danismanlar`
--
ALTER TABLE `danismanlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `juriler`
--
ALTER TABLE `juriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `notlar`
--
ALTER TABLE `notlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciler`
--
ALTER TABLE `ogrenciler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `projeler`
--
ALTER TABLE `projeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `proje_juriler`
--
ALTER TABLE `proje_juriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `notlar`
--
ALTER TABLE `notlar`
  ADD CONSTRAINT `notlar_ibfk_1` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenciler` (`id`),
  ADD CONSTRAINT `notlar_ibfk_2` FOREIGN KEY (`proje_id`) REFERENCES `projeler` (`id`),
  ADD CONSTRAINT `notlar_ibfk_3` FOREIGN KEY (`juri1_id`) REFERENCES `juriler` (`id`),
  ADD CONSTRAINT `notlar_ibfk_4` FOREIGN KEY (`juri2_id`) REFERENCES `juriler` (`id`),
  ADD CONSTRAINT `notlar_ibfk_5` FOREIGN KEY (`juri3_id`) REFERENCES `juriler` (`id`),
  ADD CONSTRAINT `notlar_ibfk_6` FOREIGN KEY (`juri4_id`) REFERENCES `juriler` (`id`);

--
-- Tablo kısıtlamaları `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD CONSTRAINT `ogrenciler_ibfk_1` FOREIGN KEY (`proje_id`) REFERENCES `projeler` (`id`),
  ADD CONSTRAINT `ogrenciler_ibfk_2` FOREIGN KEY (`danisman_id`) REFERENCES `danismanlar` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `projeler`
--
ALTER TABLE `projeler`
  ADD CONSTRAINT `projeler_ibfk_5` FOREIGN KEY (`danisman_id`) REFERENCES `danismanlar` (`id`);

--
-- Tablo kısıtlamaları `proje_juriler`
--
ALTER TABLE `proje_juriler`
  ADD CONSTRAINT `proje_juriler_ibfk_1` FOREIGN KEY (`proje_id`) REFERENCES `projeler` (`id`),
  ADD CONSTRAINT `proje_juriler_ibfk_2` FOREIGN KEY (`juri_id`) REFERENCES `juriler` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
