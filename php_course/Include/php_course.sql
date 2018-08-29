-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2018 at 04:00 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_course`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel`
--

CREATE TABLE `admin_panel` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `post` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_panel`
--

INSERT INTO `admin_panel` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(12, 'August-26-2018 20:34:59', 'Andorid Developer', 'Android developer', 'krishna', 'laptop.png', 'im lesrning android '),
(13, 'August-27-2018 10:05:36', 'krishna krishna', 'java Developer', 'krishna', 'krishna.jpg', 'hello its me'),
(14, 'August-27-2018 23:36:04', 'hello', 'hello', 'krishna', 'media.jpg', 'helo'),
(16, 'August-29-2018 11:43:10', 'akfkfmsdfsdf', 'Android developer', 'Godhand', 'image2.jpg', 'skdvvvk'),
(17, 'August-29-2018 21:08:49', 'krisha', 'krishna', 'Krishna', 'book.png', 'n krisnakrisnakrisnakrisnakrisnakrisna krisna krisna n krisnakrisnakrisnakrisnakrisnakrisna krisna krisna n krisnakrisnakrisnakrisnakrisnakrisna krisna krisna n krisnakrisnakrisnakrisnakrisnakrisna krisna krisna n krisnakrisnakrisnakrisnakrisnakrisna krisna krisna n krisnakrisnakrisnakrisnakrisnakrisna krisna krisna '),
(19, 'August-29-2018 21:16:31', 'java', 'java Developer', 'Krishna', 'image1.jpg', 'sanjdsjk'),
(20, 'August-29-2018 21:16:53', 'Andorid Developer', 'Android developer', 'Krishna', 'image2.jpg', 'sndvjkf'),
(21, 'August-29-2018 21:17:25', 'java', 'Java', 'Krishna', 'image3.jpg', 'snd'),
(22, 'August-29-2018 21:18:46', 'java', 'Android developer', 'Godhand', 'mountains.jpg', 'askskdl'),
(23, 'August-29-2018 21:19:00', 'adson', 'Android developer', 'Godhand', 'mountains.jpg', 'sdvks'),
(24, 'August-29-2018 21:19:16', 'pp', 'java Developer', 'Godhand', 'person1.jpg', 'kldsvls'),
(25, 'August-29-2018 21:19:33', 'PHP', 'PHP', 'Godhand', 'person2.jpg', 'sdvl'),
(26, 'August-29-2018 21:19:33', 'PHP', 'PHP', 'Godhand', 'person2.jpg', 'sdvl'),
(27, 'August-29-2018 21:19:48', 'nill', 'PHP', 'Godhand', 'person2.jpg', 'skldvlsd'),
(28, 'August-29-2018 21:20:06', 'philips', 'Android developer', 'Godhand', 'person3.jpg', 'skldl'),
(29, 'August-29-2018 21:20:22', 'perosn', 'Java', 'Godhand', 'comment.png', 'person'),
(30, 'August-29-2018 21:20:33', 'humtum1', 'krishna', 'Godhand', 'person1.jpg', 'smkslaf'),
(31, 'August-29-2018 21:20:54', 'tere bin', 'java Developer', 'Godhand', 'tp.png', 'skd'),
(32, 'August-29-2018 21:21:06', 'babrav', 'PHP', 'Godhand', 'image3.jpg', 'asf'),
(33, 'August-29-2018 21:21:22', 'author', 'java Developer', 'Godhand', 'media.jpg', 'slkdlsd'),
(34, 'August-29-2018 21:21:34', 'moutabin', 'PHP', 'Godhand', 'mountains.jpg', 'akscas'),
(35, 'August-29-2018 21:21:49', 'humtere', 'krishna', 'Godhand', 'person1.jpg', 'askcals'),
(36, 'August-29-2018 21:22:08', 'PHP', 'Android developer', 'Godhand', 'book.png', 'sldl'),
(37, 'August-29-2018 21:22:21', 'java', 'Android developer', 'Godhand', 'image1.jpg', 'askcas'),
(38, 'August-29-2018 21:22:32', 'andrid', 'Android developer', 'Godhand', 'image3.jpg', 'skldmcksd'),
(39, 'August-29-2018 21:22:45', 'i phone', 'Java', 'Godhand', 'mlogo.png', 'skdls'),
(40, 'August-29-2018 21:22:57', 'kese', 'PHP', 'Godhand', 'person2.jpg', 'sdkksd'),
(41, 'August-29-2018 21:23:11', 'kabhi kabhuk', 'Android developer', 'Godhand', 'media.jpg', 'aksls'),
(42, 'August-29-2018 21:23:26', 'love', 'Android developer', 'Godhand', 'slider2.jpg', 'skdl'),
(43, 'August-29-2018 21:23:37', 'PHP', 'Android developer', 'Godhand', 'mlogo.png', 'lkladslkf'),
(44, 'August-29-2018 22:19:05', 'last post', 'Android developer', 'Godhand', 'laptop.png', 'last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post last post '),
(45, 'August-30-2018 04:16:24', 'testing paraegraph', 'krishna', 'krishna', 'person1.jpg', 'this is krishna.\r\nand here im testing paragraph\r\nand its 3rd line to be added.');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `creatorname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `datetime`, `name`, `creatorname`) VALUES
(65, 'August-25-2018 15:29:07', 'Java', 'krishna'),
(66, 'August-25-2018 16:46:34', 'PHP', 'krishna'),
(68, 'August-26-2018 15:25:22', 'java Developer', 'krishna'),
(69, 'August-26-2018 20:34:31', 'Android developer', 'krishna'),
(71, 'August-29-2018 21:05:24', 'krishna', 'Krishna');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `approvedby` varchar(200) NOT NULL,
  `status` varchar(5) NOT NULL,
  `admin_panel_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `datetime`, `name`, `email`, `comment`, `approvedby`, `status`, `admin_panel_id`) VALUES
(9, 'August-26-2018 21:48:01', 'COmmnets ', 'krishna@gmail.com', 'added successfully', '', 'on', 12),
(10, 'August-26-2018 22:29:22', 'krishna', 'krishna@gmail.com', 'this is perfect', 'Godhand', 'on', 12),
(17, 'August-27-2018 23:01:09', 'krishna', 'krishna@gmail.com', ' krihsna krihsna krihsna krihsna', '', 'off', 13),
(18, 'August-27-2018 23:02:38', 'krishna testin', 'krishna@gmail.com', 'skdvsvv', '', 'Off', 13),
(19, 'August-27-2018 23:03:03', 'java testing', 'krishna@gmail.com', 'sdvv', '', 'on', 12),
(20, 'August-27-2018 23:36:29', 'hello', 'krishna@gmail.com', 'hello', '', 'on', 14),
(21, 'August-27-2018 23:36:42', 'commnets', 'krishna@gmail.com', 'comments', 'Krishna', 'on', 14),
(22, 'August-29-2018 11:55:25', 'krishna', 'krishna@gmail.com', '56656', 'Godhand', 'on', 13),
(23, 'August-30-2018 06:32:46', 'tetsing for comments only', 'krishna@gmail.com', 'asnsnksd', 'Godhand', 'off', 45),
(24, 'August-30-2018 06:32:56', 'once again', 'krishna@gmail.com', 'smklskdf', 'Godhand', 'on', 45);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `addedby` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `datetime`, `username`, `password`, `addedby`) VALUES
(2, 'August-28-2018 06:39:27', 'Godhand', '1234', 'krishna'),
(3, 'August-29-2018 09:53:49', 'Krishna', '1234', 'krishna'),
(4, 'August-29-2018 10:42:01', 'abc', '1234', 'krishna'),
(6, 'August-29-2018 11:45:30', 'krishna lodh', '12345', 'hello');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_panel`
--
ALTER TABLE `admin_panel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_panel_id` (`admin_panel_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_panel`
--
ALTER TABLE `admin_panel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `Foreign Key to admin_panel table` FOREIGN KEY (`admin_panel_id`) REFERENCES `admin_panel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
