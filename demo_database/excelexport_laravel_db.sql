
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `excelexport` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ItemName` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ItemCode` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `excelexport`
--

INSERT INTO `excelexport` (`id`, `ItemName`, `ItemCode`, `Date`, `Price`, `Quantity`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'car audio (CA)', 'NM-8010', '2017-11-10', 8544, 41, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'car-audio.jpg', NULL, NULL),
(2, 'car navigation (CN)', 'NM-8011', '2017-11-10', 9514, 14, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'car-navigation.jpg', NULL, NULL),
(3, 'copy machine (CM)', 'NM-8012', '2017-11-10', 105756, 100, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'copy-machine.jpg', NULL, NULL),
(4, 'computer (CP)', 'NM-8013', '2017-11-10', 45413, 54, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'computer.jpg', NULL, NULL),
(5, 'digital camera (DC)', 'NM-8014', '2017-11-11', 4597, 90, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'digital-camera.jpg', NULL, NULL),
(6, 'monitor', 'NM-8015', '2017-11-11', 7456, 50, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'monitor.jpg', NULL, NULL),
(7, 'digital video camera (DVC)', 'NM-8016', '2017-11-11', 90921, 45, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'digital-video-camera.jpg', NULL, NULL),
(8, 'digital video player (DVP)', 'NM-8017', '2017-11-11', 7458, 40, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'digital-video-player.jpg', NULL, NULL),
(9, 'digital video recorder (DVR)', 'NM-8018', '2017-11-11', 80756, 500, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'digital-video-recorder.jpg', NULL, NULL),
(10, 'fax (FAX)', 'NM-8019', '2017-11-11', 62584, 120, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'fax.jpg', NULL, NULL),
(11, 'RAM', 'NM-8020', '2017-11-12', 3695, 350, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'ram.jpg', NULL, NULL),
(12, 'hard disk drive (HDD)', 'NM-8021', '2017-11-12', 7522, 740, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'hard-disk-drive.jpg', NULL, NULL),
(13, 'multifunction printer (MFP)', 'NM-8022', '2017-11-12', 104521, 280, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'multifunction-printer.jpg', NULL, NULL),
(14, 'PCTV HD Card', 'NM-8023', '2017-11-12', 9685, 580, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'pctv-hd-card.jpg', NULL, NULL),
(15, 'mobile phone (MP)', 'NM-8024', '2017-11-13', 8657, 685, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'mobile-phone.jpg', NULL, NULL),
(16, 'network device (NW)', 'NM-8026', '2017-11-13', 40574, 385, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'network-device.jpg', NULL, NULL),
(17, 'personal computer (PC)', 'NM-8027', '2017-11-13', 52574, 452, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'personal-computer.jpg', NULL, NULL),
(18, 'portable media player (PMP)', 'NM-8028', '2017-11-13', 9685, 274, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'portable-media-player.jpg', NULL, NULL),
(19, 'printer (PR)', 'NM-8029', '2017-11-13', 70451, 200, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'printer.jpg', NULL, NULL),
(20, 'semiconductor (SC)', 'NM-8030', '2017-11-13', 3585, 500, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ex magni, nulla quam dicta voluptatum, nesciunt quibusdam veritatis deleniti quas esse ipsa explicabo asperiores voluptas laboriosam enim natus numquam cum!', 'semiconductor.jpg', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `excelexport`
--
ALTER TABLE `excelexport`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `excelexport`
--
ALTER TABLE `excelexport`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

