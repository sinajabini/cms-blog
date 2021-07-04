-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2021 at 07:44 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(1, 'گرافیک'),
(2, 'امنیت'),
(3, 'برنامه نویسی'),
(23, 'اموزش'),
(24, 'اچ تی ام ال'),
(28, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `status` int(2) NOT NULL,
  `comment_reply` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `body`, `post_id`, `created_at`, `status`, `comment_reply`) VALUES
(72, 18, 'سلام این جواب تست می باشد', 1, '2021-07-03', 1, 0),
(75, 1, 'سلام این جواب تست می باشد', 1, '2021-07-03', 1, 72);

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

CREATE TABLE `option` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `option`
--

INSERT INTO `option` (`id`, `title`, `description`) VALUES
(1, 'وبلاگ تست', 'blog,test');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `text`, `image`, `category_id`, `created_at`, `tag`, `author`) VALUES
(1, 'اموزشی 1', 'در راهکار قبلی ، با نحوه طراحی یک فرم ساده HTML آشنا شدید . اما فرم قبلی بسیار ساده و بدون هیچ امکاناتی بود . یکی از ایرادات فرم قبل این بود که کاربر می توانست حتی بدون وارد کردن داده های لازم در فیلد های فرم ، آن را ارسال یا Submit نماید .\r\nبه عبارت دیگر کاربر اجباری به پر کردن فیلدهای داده ای نداشت . اما در اکثر اوقات شما نیاز دارید تا کاربر اطلاعاتی را حتما در فیلدهای داده ای وارد نماید . در اینجاست که باید از مکانیزمی استفاده نموده تا آنها را مجبور به وارد نمودن اطلاعات کرده و در غیر اینصورت پیام هشدار صادر می کند .\r\nدر این راهکار قصد داریم تا نحوه چک کردن مقادیر ورودی توسط کاربر در فیلدهای فرم و در صورت لازم ، اعلام پیام هشدار به وی را آموزش دهیم .\r\n\r\nمثال زیر یک فرم ثبت نام در PHP را نشان می دهد ، که در آن چندین فیلد برای وارد نمودن داده ها ، یک دکمه رادیویی جهت تعیین جنسیت و یک دکمه برای ارسال یا Submit فرم قرار دارد .\r\nدر این فرم ، همانطور که در جدول معرفی انواع فیلدهای آن نشان داده شده ، وارد نمودن مقدار برای فیلدهای \" Name \" و \" E-mail \" و همچنین انتخاب یک گزینه از جنسیت اجباری است . اما سایر فیلدها می توانند به دلخواه کاربر پر شده یا خالی رها شوند .\r\nدر راهکار قبلی ، با نحوه طراحی یک فرم ساده HTML آشنا شدید . اما فرم قبلی بسیار ساده و بدون هیچ امکاناتی بود . یکی از ایرادات فرم قبل این بود که کاربر می توانست حتی بدون وارد کردن داده های لازم در فیلد های فرم ، آن را ارسال یا Submit نماید .\r\nبه عبارت دیگر کاربر اجباری به پر کردن فیلدهای داده ای نداشت . اما در اکثر اوقات شما نیاز دارید تا کاربر اطلاعاتی را حتما در فیلدهای داده ای وارد نماید . در اینجاست که باید از مکانیزمی استفاده نموده تا آنها را مجبور به وارد نمودن اطلاعات کرده و در غیر اینصورت پیام هشدار صادر می کند .\r\nدر این راهکار قصد داریم تا نحوه چک کردن مقادیر ورودی توسط کاربر در فیلدهای فرم و در صورت لازم ، اعلام پیام هشدار به وی را آموزش دهیم .\r\n\r\nمثال زیر یک فرم ثبت نام در PHP را نشان می دهد ، که در آن چندین فیلد برای وارد نمودن داده ها ، یک دکمه رادیویی جهت تعیین جنسیت و یک دکمه برای ارسال یا Submit فرم قرار دارد .\r\nدر این فرم ، همانطور که در جدول معرفی انواع فیلدهای آن نشان داده شده ، وارد نمودن مقدار برای فیلدهای \" Name \" و \" E-mail \" و همچنین انتخاب یک گزینه از جنسیت اجباری است . اما سایر فیلدها می توانند به دلخواه کاربر پر شده یا خالی رها شوند .', 'cecff08de4fc9900ef2dd1676876de2f.jpg', 1, '2021-07-01', 'تست،سسس233', 'admin'),
(2, 'sssssssssssssssss', 'ssssssssssssssssss', '182001bead0eb7fdaf744e7b11a0b6e3.jpg', 2, '2021-06-29', 'sssss', 'admin'),
(3, 'sssssssssssss', 'sssssssssssssssssssadasd', '6d754cb567b4582cb612cb0830aed4b4.jpg', 3, '2021-06-29', 'برنامه,نویسی,بلاگ,تست', 'admin'),
(4, 'asdasdasdsad', 'asdasdasdasd', '94115f0f410ece6abe78447c3d2abb3e.jpg', 1, '2021-07-01', 'asdasd', 'admin'),
(5, 'gfgfdgfdg', 'dfgdfgdfggf', '7e60ec49a18eec87aa9f644f5048058c.jpg', 3, '2021-07-01', 'fdg', 'admin'),
(6, 'cdscdsc', 'cdscsdcsdfcsdf', '0522312d0e3efcd5933cff825e23f3a8.jpg', 1, '2021-07-01', 'cxzx', 'admin'),
(7, 'sssssssssssssssssssssssssss', 'xxxxxxxx', '05390f70fa8033abb7b153a6e33907fe.jpg', 1, '2021-07-01', 'zxccxczxc', 'admin'),
(8, 'ghfgfhgfh', 'gfhgfhgfh', 'c3c48ddec5a886b835bc2d66e08617f2.jpg', 1, '2021-07-01', 'gfhfgh', 'admin'),
(9, '111111111111111111', '222222222222222222222222222222222222222222222222222222222222222222222', '411a640f32ec977434f875cf29f05de0.jpg', 24, '2021-07-02', 'gfbfgb', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin'),
(18, 'sinaa', 'f3cd3a30041fb6bb38da8bda843de5ba', 'admin', 'sina'),
(38, 'mmd', '2bfd74adce8bb8d8c10364902a2ae19c', 'user', 'mmd');

--
-- Indexes for dumped tables
--

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
  ADD KEY `user_comment` (`user_id`);

--
-- Indexes for table `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `option`
--
ALTER TABLE `option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `user_comment` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
