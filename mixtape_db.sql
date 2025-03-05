-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 07:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mixtape_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mixtapes`
--

CREATE TABLE `mixtapes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `urls` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mixtapes`
--

INSERT INTO `mixtapes` (`id`, `name`, `slug`, `urls`, `created_at`) VALUES
(1, 'chill vibes', NULL, 'https://youtu.be/9Rroc89z-Oo?si=jVKcHkv0ZyDkyECP,https://youtu.be/rYOxmRUy2Aw?si=25-nG9BgZkuSoNQt', '2025-02-28 15:09:44'),
(2, 'chill vibes', NULL, 'https://youtu.be/9Rroc89z-Oo?si=jVKcHkv0ZyDkyECP,https://youtu.be/rYOxmRUy2Aw?si=25-nG9BgZkuSoNQt', '2025-02-28 15:14:35'),
(3, 'chill vibes', NULL, 'https://youtu.be/qFLhGq0060w?si=BM1snVrZ4MCOpYe6,https://youtu.be/XXYlFuWEuKI?si=O3GkYFbvEd8LCrmb', '2025-02-28 15:17:38'),
(4, 'mine', NULL, 'https://youtu.be/ApXoWvfEYVU?si=dTgyeux1PKoqdpz9,https://youtu.be/9gWIIIr2Asw?si=hnyd5eEAyzXNYs2d,https://youtu.be/9gWIIIr2Asw?si=7VJCNxbXRXkj6IFh,https://youtu.be/56WBK4ZK_cw?si=j-GZOpF273BQV9k6,https://youtu.be/V1Pl8CzNzCw?si=nxzjx2sOL-bBKP5I,https://youtu.be/ShZ978fBl6Y?si=D13pLjCg9BC4h6Ei', '2025-02-28 16:11:52'),
(5, 'mine', 'mine', 'https://youtu.be/ApXoWvfEYVU?si=dTgyeux1PKoqdpz9,https://youtu.be/9gWIIIr2Asw?si=hnyd5eEAyzXNYs2d,https://youtu.be/9gWIIIr2Asw?si=7VJCNxbXRXkj6IFh,https://youtu.be/56WBK4ZK_cw?si=j-GZOpF273BQV9k6,https://youtu.be/V1Pl8CzNzCw?si=nxzjx2sOL-bBKP5I,https://youtu.be/ShZ978fBl6Y?si=D13pLjCg9BC4h6Ei,https://youtu.be/2Vv-BfVoq4g?si=ui1-MSLrWFZqsCdS', '2025-02-28 16:35:57'),
(6, 'neww', 'neww', 'https://youtu.be/OG_PlH_UqiI?si=7A2p8F1QAo8BGGnw,https://youtu.be/CTFtOOh47oo?si=p80KPv72nVXjQJBA,https://youtu.be/MY_wW3QDcZw?si=dmFO1yRjl7cz85kC,https://youtu.be/bQARUbJTaTg?si=OoBEPfL8gvMrYGA_,https://youtu.be/h7m_nvDzh6M?si=MjJ4if2yk8RcYkvz', '2025-03-01 08:54:57'),
(7, 'best', 'best', 'https://youtu.be/NtNYwMSpIBg?si=NVw6OjAEMNkXevEH,https://youtu.be/X4DtxDZ-5b0?si=KbhIZaTfJYQrPGGk', '2025-03-05 18:02:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mixtapes`
--
ALTER TABLE `mixtapes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mixtapes`
--
ALTER TABLE `mixtapes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
