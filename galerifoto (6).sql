-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2024 at 12:32 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galerifoto`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `album_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `user_id`, `title`, `description`, `created_at`) VALUES
(63, 2, 'HEWAN PELIHARAAN', 'Peliharaanku', '2024-03-04 17:00:00'),
(64, 3, 'MASA PKL', 'Masa-Masa PKL di ACCESS MEDIA', '2024-03-04 17:00:00'),
(65, 4, 'SMKN 1 BANJAR', 'MOMENT RPL 2', '2024-03-04 17:00:00'),
(66, 5, 'TEMANKU', 'TEMAN-TEMAN SEKOLAH', '2024-03-04 17:00:00'),
(67, 6, 'KUNJUNGAN INDUSTRI ', 'KUNJUNGAN INDUSTRI SMKN 1 BANJAR', '2024-03-04 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `photo_id`, `comment_text`, `created_at`) VALUES
(93, 3, 92, 'waw bagus bnget', 0),
(95, 6, 97, 'waw lucu sekali', 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `user_id`, `photo_id`, `created_at`) VALUES
(38, 8, 3, '0000-00-00 00:00:00'),
(39, 8, 3, '0000-00-00 00:00:00'),
(40, 8, 3, '0000-00-00 00:00:00'),
(42, 3, 8, '0000-00-00 00:00:00'),
(48, 3, 10, '0000-00-00 00:00:00'),
(49, 3, 15, '0000-00-00 00:00:00'),
(51, 3, 13, '0000-00-00 00:00:00'),
(57, 3, 20, '0000-00-00 00:00:00'),
(58, 3, 19, '0000-00-00 00:00:00'),
(61, 123, 19, '0000-00-00 00:00:00'),
(62, 123, 20, '0000-00-00 00:00:00'),
(63, 123, 21, '0000-00-00 00:00:00'),
(64, 123, 22, '0000-00-00 00:00:00'),
(65, 123, 23, '0000-00-00 00:00:00'),
(66, 3, 21, '0000-00-00 00:00:00'),
(67, 3, 22, '0000-00-00 00:00:00'),
(68, 3, 24, '0000-00-00 00:00:00'),
(69, 3, 25, '0000-00-00 00:00:00'),
(70, 3, 27, '0000-00-00 00:00:00'),
(71, 3, 28, '0000-00-00 00:00:00'),
(73, 3, 32, '0000-00-00 00:00:00'),
(74, 3, 35, '0000-00-00 00:00:00'),
(75, 3, 36, '0000-00-00 00:00:00'),
(77, 3, 34, '0000-00-00 00:00:00'),
(78, 3, 33, '0000-00-00 00:00:00'),
(80, 3, 23, '0000-00-00 00:00:00'),
(81, 5, 21, '0000-00-00 00:00:00'),
(82, 5, 22, '0000-00-00 00:00:00'),
(85, 5, 23, '0000-00-00 00:00:00'),
(86, 5, 32, '0000-00-00 00:00:00'),
(87, 1, 21, '0000-00-00 00:00:00'),
(108, 1, 52, '0000-00-00 00:00:00'),
(110, 1, 51, '0000-00-00 00:00:00'),
(111, 1, 53, '0000-00-00 00:00:00'),
(112, 1, 54, '0000-00-00 00:00:00'),
(114, 1, 55, '0000-00-00 00:00:00'),
(116, 1, 74, '0000-00-00 00:00:00'),
(118, 1, 82, '0000-00-00 00:00:00'),
(119, 2, 86, '0000-00-00 00:00:00'),
(122, 11, 87, '0000-00-00 00:00:00'),
(123, 11, 86, '0000-00-00 00:00:00'),
(126, 3, 87, '0000-00-00 00:00:00'),
(127, 1, 86, '0000-00-00 00:00:00'),
(132, 1, 93, '0000-00-00 00:00:00'),
(134, 1, 92, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `lokasifile` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `user_id`, `album_id`, `title`, `description`, `lokasifile`, `created_at`) VALUES
(96, 2, 63, 'MIKO', 'Miko adalah anjing peliharaanku', '1502002972-images (2).jpeg', '2024-03-04 17:00:00'),
(97, 2, 63, '3 KUCING LUCUKU', 'Ini adalah 4 kucing lucuku bernama maw,miw,muw,mow', '300217475-download (8).jpeg', '2024-03-04 17:00:00'),
(98, 2, 63, 'RORO', 'Ini adalah burung peliharaanku yang bernama roro', '513442222-images (3).jpeg', '2024-03-04 17:00:00'),
(99, 2, 63, 'Cici', 'Ini adalah kelinci peliharaanku yang bernama cici', '1873797386-download (7).jpeg', '2024-03-04 17:00:00'),
(100, 3, 64, 'AWAL MASUK ACM', 'ini adalah kenangan saya selama saya baru pertama kali datang ke acm', '1752813950-IMG-20230703-WA0005.jpg', '2024-03-04 17:00:00'),
(101, 3, 64, 'BENTO CAFE', 'Ini pada saat kita semua di ajak ke bento cafe oleh direktur acm yaitu pak yana', '436993590-IMG-20230826-WA0059.jpg', '2024-03-04 17:00:00'),
(102, 3, 64, 'BREAFING PAGI', 'ini moment ketika breafing pagi ', '1085049454-IMG-20230724-WA0050.jpg', '2024-03-04 17:00:00'),
(103, 3, 64, 'PERSENTASI', 'Ini adalah moment saya ketika disuruh untuk mempersentasikan pekerjaan saya', '65e73e6b17143_IMG-20230729-WA0011.jpg', '2024-03-05 15:46:51'),
(104, 4, 65, '12 RPL 2', 'PHOTO  STUDIO', '388580061-12 RPL2.jpg', '2024-03-04 17:00:00'),
(105, 4, 65, '12 RPL 2', 'PHOTO STUDIO', '196482415-12 RPL2-6.jpg', '2024-03-04 17:00:00'),
(106, 4, 65, '12 RPL 2', 'PHOTO STUDIO	', '1874756017-12 RPL2-8.jpg', '2024-03-04 17:00:00'),
(107, 4, 65, '12 RPL 2', 'PHOTO STUDIO	', '1801930291-12 RPL2-4.jpg', '2024-03-04 17:00:00'),
(108, 5, 66, '12 RPL 2', 'CEWE-CEWE RPL 2', '1065352128-~560-1.JPG', '2024-03-04 17:00:00'),
(109, 5, 66, '12 RPL 2', 'CEWE-CEWE RPL 2	', '936022697-12 RPL2-8.jpg', '2024-03-04 17:00:00'),
(110, 5, 66, '12 RPL 2', 'CEWE-CEWE RPL 2	', '65e7408b1b0de_IMG-20230518-WA0038.jpg', '2024-03-05 15:55:55'),
(111, 5, 66, '12 RPL 2', 'CEWE-CEWE RPL 2	', '1609434169-IMG-20230517-WA0004.jpg', '2024-03-04 17:00:00'),
(112, 6, 67, 'KUNJUS', 'KUNJUNGAN INDUSTRI KE ROBOTIC', '1293887301-IMG-20230517-WA0009.jpg', '2024-03-05 16:15:56'),
(113, 6, 67, 'KUNJUS', 'BOROBUDUR', '1496940705-IMG_1829.JPG', '2024-03-04 17:00:00'),
(114, 6, 67, 'KUNJUS', 'MERAPI', '1043172924-IMG-20230519-WA0057.jpg', '2024-03-04 17:00:00'),
(115, 6, 67, 'KUNJUS', 'MALIOBORO', '491496533-IMG-20230517-WA0041.jpg', '2024-03-04 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id_report` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `reason` text NOT NULL,
  `report_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `photo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id_report`, `username`, `reason`, `report_at`, `photo_id`) VALUES
(1, '', 'buyvf', '2024-03-04 07:21:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(1, 'admin', 'admin', '$2y$10$gNTCkYrjNgUhiFT4Igji7ex5iMImJWZtlDX62DiJV/CVhRfx0zrla', 'admin123@gmail.com', 'admin', '2024-02-20 14:44:24'),
(2, 'nur', 'nur', '$2y$10$141skLC6lWWk8xEih4Wzoe/NphqVaHeF13fp7wZ7BTmn/fRJZ98aO', 'nur@gmail.com', 'users', '2024-03-01 14:29:51'),
(3, 'tansya', 'tansya', '$2y$10$xK7K1hcDJcGDCJSY6y/SeePpK5nacE8PrVRB2mRIgHGNrXWS7gWpq', 'iin123@gmail.com', 'users', '2024-02-21 02:38:50'),
(4, 'intan', 'intan', '$2y$10$dbsjk60gMmDeoMTwLnVuaeBQTPCd13DX/ua7wRBoR7geMy9DH3ns.', 'intan@gmail.com', 'users', '2024-03-05 15:21:15'),
(5, 'jirah', 'jirah', '$2y$10$/z4KRudTJFX.FmhPA.lzLO.6moWoFklYaqc2SGU/7FfBcUlAKzN/e', 'jirah@gmail.com', 'users', '2024-03-05 15:22:03'),
(6, 'amel', 'amel', '$2y$10$gF/J/7SXL2BC3ULVq2yKm./g60IoyrVEX96xtTZdzshdqFbD/YnZ.', 'amel@gmail.com', 'users', '2024-03-05 15:23:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id_report`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1238;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
