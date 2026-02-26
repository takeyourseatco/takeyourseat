-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2026 at 07:57 PM
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
-- Database: `takeyourseat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'TYSadmin', '$2y$10$YHKNIqLCvIJswPgljiH45ez/S8BZIzikUUt4m/CN5etyHvAUhRBOm');

-- --------------------------------------------------------

--
-- Table structure for table `admin_fcm_tokens`
--

CREATE TABLE `admin_fcm_tokens` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `token` text NOT NULL,
  `device` varchar(50) DEFAULT NULL,
  `last_active` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_fcm_tokens`
--

INSERT INTO `admin_fcm_tokens` (`id`, `admin_id`, `token`, `device`, `last_active`) VALUES
(8, NULL, 'fv0ZaCfAmurkVXFOuTlgzY:APA91bGL5wGmnERrbnB48c0NIiHGbhXjrzryh817zrqjHEUzIO8kRGp0oz0R7rbPyDjCwJB4PymT1OI6Tnieh2MsyEEmc8lK-8e3-pj37oNPSgup-r9MmV4', NULL, '2026-02-19 07:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `logo`, `status`, `created_at`) VALUES
(2, 'Mero Kinmel', '1768153624_client.png', 1, '2026-01-11 12:31:10'),
(3, 'Boston College', '1768153348_boston.png', 1, '2026-01-11 17:42:28'),
(4, 'Balkumari College', '1768153395_balkumari.jpg', 1, '2026-01-11 17:43:15'),
(5, 'CMT Hotel', '1768153425_cmt.png', 1, '2026-01-11 17:43:45'),
(6, 'Doko Namlo', '1768153516_client.jpeg', 1, '2026-01-11 17:44:18'),
(7, 'V Group', '1768153789_client.png', 1, '2026-01-11 17:48:54'),
(9, 'A Star Consultancy  ', '1768154288_client.jpg', 1, '2026-01-11 17:57:26'),
(10, 'Presidency College', '1768154425_client.png', 1, '2026-01-11 17:59:54'),
(11, 'Jalap Nepal', '1768154769_jalap.jpg', 1, '2026-01-11 18:06:09'),
(12, 'Dreams College', '1768155043_dreams_college.png', 1, '2026-01-11 18:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `is_featured`, `status`, `created_at`) VALUES
(2, 'Can I easily exchange money in Nepal?', 'Nepali Rupees (NPR) is the legal currency in Nepal. You can exchange major currencies (USD, GBP, Euro) to Nepali Rupees at banks and authorized money exchangers in Kathmandu, Pokhara, and other cities. However, we advise you to exchange currency in Kathmandu. You can also withdraw money from many ATMs in Kathmandu, but you might have to pay service fees.', 1, 1, '2026-01-16 18:00:11'),
(3, 'What services does Take Your Seat provide?', 'We offer domestic and international tour packages, flight ticketing, trekking, visa assistance, adventure activities, and customized travel solutions.', 1, 1, '2026-01-17 17:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `from_city` varchar(100) NOT NULL,
  `to_city` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `is_group_fare` tinyint(1) DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `from_city`, `to_city`, `image`, `description`, `price`, `is_group_fare`, `status`, `created_at`) VALUES
(2, 'Kathmandu', 'Australia', 'australia.jpg', NULL, NULL, 1, 1, '2025-12-22 16:59:26'),
(4, 'Kathmandu', 'London', 'london.jpg', '✈️ 𝐁𝐎𝐎𝐊 𝐘𝐎𝐔𝐑 𝐅𝐋𝐈𝐆𝐇𝐓 𝐓𝐎 𝐋𝐎𝐍𝐃𝐎𝐍 𝐖𝐈𝐓𝐇 𝐓𝐀𝐊𝐄 𝐘𝐎𝐔𝐑 𝐒𝐄𝐀𝐓!\r\nDreaming of studying, working, or exploring the UK? 🌍\r\nFly smart with Take Your Seat Tours & Travels and enjoy exclusive student discounts & extra luggage benefits 🎓🧳\r\n\r\n✨ 𝐖𝐡𝐲 𝐛𝐨𝐨𝐤 𝐰𝐢𝐭𝐡 𝐮𝐬?\r\n✔️ Best international fares\r\n✔️ Student-friendly tickets\r\n✔️ Extra baggage options\r\n✔️ Trusted airline partners\r\n✔️ Quick support & easy booking\r\n\r\n📍 From Kathmandu to London\r\n📞 Contact us now: +977-9764667165\r\n✈️ Let’s go together.\r\n\r\n🔴 𝐁𝐎𝐎𝐊 𝐍𝐎𝐖 & 𝐅𝐋𝐘 𝐖𝐈𝐓𝐇 𝐂𝐎𝐍𝐅𝐈𝐃𝐄𝐍𝐂𝐄!', NULL, 1, 1, '2025-12-22 17:00:54'),
(5, 'Kathmandu', 'Finland', 'finland.jpg', '✈️ 𝙁𝙇𝙔 𝙏𝙊 𝙁𝙄𝙉𝙇𝘼𝙉𝘿 with 𝐓𝐚𝐤𝐞 𝐘𝐨𝐮𝐫 𝐒𝐞𝐚𝐭 𝐓𝐨𝐮𝐫𝐬 & 𝐓𝐫𝐚𝐯𝐞𝐥𝐬\nDiscover the magic of Finland — a land of a thousand lakes, magical Northern Lights, peaceful nature, and world-famous saunas 🌌❄️\nWhether you’re traveling for study, work, or leisure, we’re here to get you the best flight deals with reliable service.\n\n🎓 Student-friendly fares available\n🧳 Smooth booking & expert support\n🌍 Travel with confidence — let’s go together\n\n📞 𝑪𝒐𝒏𝒕𝒂𝒄𝒕 𝒖𝒔 𝒕𝒐𝒅𝒂𝒚:\n📱 +977-9764667165\n📱 +977-9865507624\n\n📍 𝑻𝒂𝒌𝒆 𝒀𝒐𝒖𝒓 𝑺𝒆𝒂𝒕 𝑻𝒐𝒖𝒓𝒔 & 𝑻𝒓𝒂𝒗𝒆𝒍𝒔', NULL, 0, 1, '2025-12-22 17:01:10'),
(7, 'Kathmandu', 'Canada', '1766650264visa.jpg', '✈️ 𝐅𝐋𝐘 𝐓𝐎 𝐂𝐀𝐍𝐀𝐃𝐀\r\nToronto • Montreal • Vancouver • Calgary\r\n\r\nPlanning to study, work, or visit Canada? 🌎\r\nWe’ve got you covered with best flight options, student discounts & reliable support from booking to boarding.\r\n\r\n🎓 Student Discount Available\r\n🧳 Smooth & Hassle-Free Ticketing\r\n📞 Expert Travel Assistance\r\n\r\n📲 𝑪𝒐𝒏𝒕𝒂𝒄𝒕 𝑼𝒔 𝑵𝒐𝒘:\r\n☎️ +977-9764667165\r\n📱 +977-9865507624\r\n\r\n✨ Let’s go together — your journey starts here!\r\n', NULL, 0, 1, '2025-12-23 17:16:10'),
(8, 'Kathmandu', 'Canada', '1766849510_adventure.jpg', 'nnnnmmm', NULL, 0, 1, '2025-12-27 15:31:50'),
(9, 'Kathmandu', 'Canada', '1766915084_lumbini.jpg', 'cfbbcfcffb', NULL, 0, 0, '2025-12-28 09:44:44'),
(10, 'ff', 'dd', '1771585906_IMG20260219164125.jpg', 'ffrrr4444fdfefdfdfdfdf', NULL, 1, 1, '2026-02-20 11:11:46'),
(11, 'grtr', 'rtrt', '1771586532_IMG20260219164125.jpg', 'rtrttttttttttttttttttt', NULL, 1, 1, '2026-02-20 11:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_albums`
--

CREATE TABLE `gallery_albums` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_albums`
--

INSERT INTO `gallery_albums` (`id`, `title`, `slug`, `cover_image`, `description`, `status`, `created_at`) VALUES
(2, 'Pokhara-Mustang Tour', 'pokhara-mustang-tour', '1766654305bus.jpg', NULL, 1, '2025-12-23 09:46:01'),
(4, 'Kathmandu Tour hello', 'kathmandu-tour-hello', 'istockphoto-530450181-612x612.jpg', NULL, 1, '2025-12-25 09:22:10'),
(5, 'Lumbini', 'lumbini', 'lumbini.jpg', NULL, 1, '2025-12-27 16:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_photos`
--

CREATE TABLE `gallery_photos` (
  `id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_photos`
--

INSERT INTO `gallery_photos` (`id`, `album_id`, `image`, `caption`, `created_at`) VALUES
(6, 2, 'tours.jpg', NULL, '2025-12-25 08:34:06'),
(7, 2, 'about-banner.jpg', NULL, '2025-12-25 08:36:07'),
(8, 2, 'Founder.jpg', NULL, '2025-12-25 08:37:17'),
(9, 2, 'trip.jpg', NULL, '2025-12-25 08:38:35'),
(10, 2, 'WhatsApp Image 2025-12-21 at 11.35.24 PM.jpeg', NULL, '2025-12-25 08:39:32'),
(11, 2, 'pokhara.jpg', NULL, '2025-12-28 09:45:32'),
(12, 2, 'Everest-base-Camp-trek.jpeg', NULL, '2025-12-28 09:45:32'),
(13, 5, 'manaslu_circuit_trek.webp', NULL, '2026-01-12 19:58:17'),
(14, 5, 'DSC00719.jpeg', NULL, '2026-01-12 19:58:17'),
(15, 5, 'TAL-dubai-skyline-WHENDUBAI0623-2d04ce84e31849a1a6f2971518e7017e.jpg', NULL, '2026-01-12 19:58:17'),
(16, 2, 'Gemini_Generated_Image_9onnoc9onnoc9onn.png', NULL, '2026-01-15 13:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `tour_name` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `tour_name`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(59, 'Everest Base Camp Trek', 'Mero Kinmel', '', '7575757575', 'ddddddddddd', '2026-02-02 12:43:50'),
(60, 'Everest Base Camp Trek', 'Hello Hello', '', '97453556422', 'cccccccccccc', '2026-02-02 12:44:15'),
(61, NULL, 'Mero Kinmel', '', '9715454545', 'ffffffffffffff', '2026-02-02 12:45:05'),
(62, 'Manaslu Circuit Trek', 'dfdf dfdf', 'dfd3@gmail.com', '9745355605', 'ffffffffff', '2026-02-06 12:59:45'),
(63, 'Manaslu Circuit Trek', 'Kushal Comp', 'comp.kushal@gmail.com', '9745355644', 'hfhgfghfghf', '2026-02-06 15:22:09'),
(64, 'Manaslu Circuit Trek', 'Kushal Comp', 'comp.kushal@gmail.com', '9745355605', 'fffffffffffffffff', '2026-02-19 07:22:05'),
(65, 'Manaslu Circuit Trek', 'Kushal Comp', 'comp.kushal@gmail.com', '9745355605', 'hhhhhhhhhhhh', '2026-02-19 07:25:33'),
(66, 'Manaslu Circuit Trek', 'Kushal Comp', 'comp.kushal@gmail.com', '97453556422', 'ddddddddddddddd', '2026-02-19 07:26:24'),
(67, 'Manaslu Circuit Trek', 'Kushal Comp', 'comp.kushal@gmail.com', '97453556422', 'ggggggggggggg', '2026-02-19 07:28:20'),
(68, 'Manaslu Circuit Trek', '', '', '', '', '2026-02-20 18:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `service` varchar(150) DEFAULT NULL,
  `review` text NOT NULL,
  `rating` tinyint(4) DEFAULT 5,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `service`, `review`, `rating`, `status`, `created_at`) VALUES
(2, 'Bipin Chapai', 'Flight Ticketing', 'Very professional flight booking service.', 5, 1, '2026-01-11 11:37:08'),
(3, 'Himal Dahal', 'Visa Service', 'Visa process was smooth and well guided.', 5, 1, '2026-01-11 11:38:06'),
(4, 'Raghav Pandey', 'Camping', 'Got best camping package and equipment. Quick response and friendly support team.', 5, 1, '2026-01-11 11:39:46'),
(5, 'Kushal Acharya', 'Tour', 'Dammi tour package thyo. Highly recommended this company.', 5, 1, '2026-01-12 20:01:19'),
(6, 'ddd', 'ddd', 'fddddddddddddd', 5, 1, '2026-02-20 17:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `price_usd` decimal(10,2) DEFAULT NULL,
  `overview` text DEFAULT NULL,
  `highlights` text DEFAULT NULL,
  `itinerary` text DEFAULT NULL,
  `includes` text DEFAULT NULL,
  `excludes` text DEFAULT NULL,
  `pdf_file` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `is_popular` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `title`, `duration`, `price`, `price_usd`, `overview`, `highlights`, `itinerary`, `includes`, `excludes`, `pdf_file`, `banner_image`, `status`, `is_popular`, `created_at`, `type`) VALUES
(3, 'Nepal Cultural Tour', '7 Days / 6 Nights', '85,000', NULL, 'Experience the cultural and natural beauty of Nepal with our carefully crafted Nepal Cultural Tour. This journey offers ancient heritage sites, scenic landscapes, and authentic local experiences.', 'UNESCO World Heritage Sites in Kathmandu\r\nScenic drive to Pokhara\r\nJungle safari in Chitwan\r\nTraditional Nepali culture & cuisine\r\n', 'Day 01: Arrival in Kathmandu\r\nAirport pickup and transfer to hotel. Evening cultural walk.\r\nDay 02: Kathmandu Sightseeing\r\nVisit Pashupatinath, Boudhanath, Swayambhunath, and Patan Durbar Square.', 'Hotel accommodation\r\nPrivate transportation', 'International flights\r\nPersonal expenses\r\nTravel insurance', '1766648995_TYS_Letter_Pad.pdf', '1766649555tours.jpg', 1, 1, '2025-12-20 19:22:30', 'domestic'),
(4, 'pokhara tour', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pokhara.jpg', 1, 0, '2025-12-25 06:31:13', ''),
(5, 'Everest Base Camp Trek', '14', '150,000', NULL, 'Everest Base Camp Trek is one of the finest treks in the world that centers on the world\'s highest peak Mt. Everest (29,029 ft/ 8,848.68m). This trek will provide you with a natural thrill as it takes you through breathtaking high-altitude landscapes, esoteric Buddhist monasteries, traditional Sherpa villages, high-altitude flora and fauna, and snow-capped mountains.', 'The magnificent views of the world’s highest peak, Mt. Everest (8,848.68m)\r\nWorld’s highest airport at Syangboche (3,780m)\r\nExplore wide range of flora and fauna at Sagarmatha National Park\r\nWildlife like musk deer, colorful pheasants, snow leopards, and Himalayan Tahrs\r\nChance to explore the culture and lifestyles of the local Sherpa people\r\nPrayer wheels, colorful flags, Mani stones, high suspension bridges\r\nVisit an ancient monastery in Tengboche\r\nHighest glacier on Earth- Khumbu Glacier (4,900 m)\r\nAmazing panoramic views from Kala Patthar (5,555m)\r\nViews of other peaks such as Mt. Lhotse(8,516m), Cho Oyu (8,201m) and Mt. Makalu (8,463m)', 'Day\r\n1\r\nFlight from Kathmandu/Manthali to Lukla. Flight time: Approx 40 min from KTM/20 min from Manthali. Trek to Phakding (2,650 m). Trek time: Approx. 3 hrs.\r\nDay\r\n2\r\nTrek from Phakding to Namche Bazaar (3,440 m). Trek time: Approx. 6 hrs.\r\nDay\r\n3\r\nRest day and acclimatization at Namche Bazaar.\r\nDay\r\n4\r\nTrek from Namche to Tengboche/ Deboche (3,855 m). Trek time: Approx. 5 hrs.\r\nDay\r\n5\r\nTrek from Tengboche to Dingboche (4,360 m). Trek time: Approx. 5 hrs.\r\nDay\r\n6\r\nRest day and acclimatization at Dingboche.\r\nDay\r\n7\r\nTrek from Dingboche to Lobuche (4,930 m). Trek time: Approx. 5 hrs.\r\nDay\r\n8\r\nTrek from Lobuche to EBC (5,364 m) and back to Gorak Shep (5,185 m). Trek time: Approx. 7 hrs.\r\nDay\r\n9\r\nHike to Kala Patthar (5,555 m) viewpoint, trek to Gorak Shep, then to Pheriche (4,250 m). Trek time: Approx. 5 hrs.\r\nDay\r\n10\r\nTrek from Pheriche to Tengboche (3,855 m). Trek time: Approx. 5 hrs.\r\nDay\r\n11\r\nTrek from Tengboche to Namche Bazaar (3,440 m). Trek time: Approx. 5 hrs.\r\nDay\r\n12\r\nTrek from Namche Bazaar to Phakding (2,650 m). Trek time: Approx. 4 hrs.\r\nDay\r\n13\r\nTrek from Phakding to Lukla (2,850 m). Trek time: Approx. 4 hrs.\r\nDay\r\n14\r\nFly back to Kathmandu/ Manthali from Lukla. Flight time: Approx. 40 min for KTM/20 min for Manthali. Drive time: Approx. 5 hrs from Manthali to KTM', 'Transportation\r\nAccommodations\r\nFood\r\nGuide and Porter\r\nTrek permit and expenses\r\nMedical Assistance\r\nSouvenir\r\nFarewell', 'International Flight\r\nAccommodations\r\nFood\r\nGuide and Porter\r\nVisa\r\nTravel Insurance\r\nPersonal Expenses', '1766770952_Important-Questions.pdf', '1766770952_Everest-base-Camp-trek.jpeg', 1, 1, '2025-12-26 17:42:32', 'international'),
(6, 'Annapurna Circuit Trek', '14', '100000', NULL, 'The Annapurna Circuit Trek is Nepal’s classic Himalayan journey, circling the entire Annapurna massif through dramatically varied landscapes and cultures. The trek starts in the subtropical Besisahar region and ascends northwards to Thorong La Pass, and descends to Muktinath. From Muktinath, the trails proceed to Ghorepani and then Pokhara, the tourist capital of the world.', 'Pass by the yak pastures\r\nNatural hot springs at Tatopani where you can choose to take a dip\r\nJomsom - the headquarter of Mustang\r\nA day at tourist hub Pokhara\r\nSpectacular views of Mt. Annapurna, Thorung Peak, Nilgiri, Chulu West, and Chulu East, Tukuche Peak, Dhaulagiri, Lamjung Himal, Annapurna II, and Annapurna IV\r\nVisit the beautiful Manang district\r\nMagnificent lakes, glaciers, deep gorges, and stunning waterfalls\r\nVisit Muktinath (a sacred place for both Hindus and Buddhists) known for 108 stone faucets, and eternal flame\r\nCross Thorong La Pass at 5,416 meters\r\nVisit Barge Monastery, the largest monastery in the Manang district\r\nPoon Hill Viewpoint (3,210 m)', 'Day1 Drive from Kathmandu to Bhulbhule (845 m) west of Kathmandu. Drive time: Approx. 8 hrs.\r\nDay\r\n2\r\nTrek from Bhulbhule to Jagat (1,300 m). Trek time: Approx. 5 hrs.\r\nDay\r\n3\r\nTrek from Jagat to Dharapani (1,860 m). Trek time: Approx. 5 hrs.\r\nDay\r\n4\r\nTrek from Dharapani to Chame (2,610 m). Trek time: Approx. 6 hrs.\r\nDay\r\n5\r\nTrek from Chame to Upper Pisang (3,300 m). Trek time: Approx. 6 hrs.\r\nDay\r\n6\r\nTrek from Pisang to Manang (3,540 m). Trek time: Approx. 6 hrs.\r\nDay\r\n7\r\nRest and acclimatization day at Manang\r\nDay\r\n8\r\nTrek from Manang to Ledar (4,250 m). Trek time: Approx. 5 hrs.\r\nDay\r\n9\r\nTrek from Ledar to Thorong High Camp (4,925 m). Trek time: Approx. 5 hrs.\r\nDay\r\n10\r\nTrek from Thorong High Camp to Muktinath Temple (3,760 m) via Thorong La High Pass (5,416 m). Trek time: Approx. 9 hrs.\r\nDay\r\n11\r\nDrive from Muktinath to Jomsom and Tatopani (1,200 m). Drive time: Approx.4 hrs.\r\nDay\r\n12\r\nTrek from Tatopani to Ghorepani (2,860 m). Trek time: Approx. 7 hrs.\r\nDay\r\n13\r\nEarly morning hike to Poon Hill (3,210m) - then trek to Tikhedhunga (1,570m). Trek time: Approx. 4-5 hrs. Drive to Nayapul, Pokhara. Drive time: Approx. 2 hrs.\r\nDay\r\n14\r\nDrive from Pokhara (820 m) to Kathmandu (1,350 m). Drive time: Approx. 7 hrs.', 'dffwef', 'dfggdgfdf', '1766947255_Unit-5-Cloud-Security.pdf', '1766947255_DSC00719.jpeg', 1, 1, '2025-12-28 18:40:55', ''),
(10, 'Manaslu Circuit Trek', '16', '200000', 11.00, 'The Manaslu Circuit Trek is a rewarding Himalayan journey — a blend of rugged landscapes, cultural depth, and high-altitude adventure that leaves trekkers with memories of both breathtaking scenery and genuine human connection.', 'Scenic drive from Kathmandu to Soti Khola\r\nViews of the world\'s highest peaks- including Manaslu mountain (8,156m), Lamjung Himal, Mt.Annapurna II, etc.\r\nTrek along the Budhi Gandaki River gorge\r\nThe highest point on the trek - Larkya La Pass (5,106m / 16,751ft)\r\nRich biodiversity and beautiful natural scenery\r\nCaptivating flora and fauna\r\nInsight into Hindu and Buddhist culture\r\nPossibility of spotting wild endangered species like snow leopard', NULL, 'Transportation\r\nAccommodations\r\nFood\r\nGuide and Porter\r\nTrek Permits and Expenses\r\nMedical Assistance\r\nSouvenir\r\nFarewell', 'International Flight\r\nAccommodations\r\nFood\r\nGuide and Porter\r\nVisa\r\nTravel Insurance\r\nPersonal Expenses', '1768076727_Log-sheet-Sample.pdf', '1768076727_manaslu_circuit_trek.webp', 1, 1, '2026-01-10 20:25:27', ''),
(11, 'kkk', '7', '85000', 45.00, 'kkkkkkkkkkkkkkkkkkkkkkkkk', 'lllllllllll', NULL, 'kkkkkkkkk kk', 'lllllllllllllll', '', '1770131601_unnamed-Picsart-AiImageEnhancer.png', 0, 0, '2026-02-03 15:13:21', ''),
(13, 'Bali', '4 Nights / 5 Days', '115000', 800.00, 'This 4-night, 5-day Bali itinerary offers a blend of coastal adventure and cultural discovery. Based in the Kuta area, the trip includes water sports like banana boat rides at Tanjung Benoa and a sunset visit to the Uluwatu Temple. You will explore the island\'s interior with a visit to the Kintamani volcano and the artistic heritage of Ubud. A major highlight is a full-day fast boat excursion to Nusa Penida to see iconic landmarks such as Kelingking Beach and Angel\'s Billabong.', 'This 4-night Bali getaway combines Kuta\'s vibrant beaches and water sports with a scenic tour of the Kintamani volcano, the artistic charm of Ubud, and a stunning day trip to the iconic cliffs and shores of Nusa Penida.', NULL, 'International Ticket: KTM-DPS-KTM\r\n4 Nights hotel accommodation in Bali\r\nDaily breakfast at hotel\r\nAirport Transfer (Pick up and drop off)\r\nWatersports at Tanjung Benoa (Banana Boat)\r\nUluwatu Sunset Temple Tour\r\nKintamani Volcano viewpoint tour\r\nUbud Art Village exploration\r\nNusa Penida Island full-day tour with fast boat transfers\r\nLunch in Nusa Penida Island\r\nVisa fees\r\nAll tours and transfers on SIC Basis', 'Meals aside from those specifically included.\r\nCity and Resort Taxes (If Applicable)\r\nSurcharge (If Applicable)\r\nPersonal Expenses\r\nTips\r\nAny Other charge which is not mentioned in above inclusions', '1771841158_Important-Questions (1).pdf', '1771841158_bali-for-digital-nomads.jpg', 1, 1, '2026-02-23 10:05:58', 'international');

-- --------------------------------------------------------

--
-- Table structure for table `tour_itineraries`
--

CREATE TABLE `tour_itineraries` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `day_number` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_itineraries`
--

INSERT INTO `tour_itineraries` (`id`, `tour_id`, `day_number`, `title`, `description`) VALUES
(1, 5, 1, 'Flight from Kathmandu/Manthali to Lukla.', 'Flight time: Approx 40 min from KTM/20 min from Manthali. Trek to Phakding (2,650 m). Trek time: Approx. 3 hrs.'),
(2, 5, 2, 'Trek from Phakding to Namche Bazaar (3,440 m).', 'Trek time: Approx. 6 hrs.'),
(49, 10, 1, 'Drive from Kathmandu via Arughat to Soti Khola (730m / 2896ft)', 'dfdfgfg'),
(50, 10, 2, 'Trek from Soti Khola (730m / 2896ft) to Machha Khola (890m / 2,965ft)', 'dfdgfgeer4r4'),
(51, 10, 3, ' Trek from Machha Khola (890m / 2,965ft) to Doban (1,070m / 3510ft)', 'kuyliuliul'),
(55, 11, 1, 'llll', 'lllllllllllllll'),
(76, 13, 1, 'Arrive at Bali Airport. Transfer to Hotel. Check in. Free Time. Overnight.', 'Arrival in Bali\r\nMeet and greet with our representatives\r\nTransfer to hotel\r\nCheck-in to the hotel\r\nRelax, free time\r\nOvernight in Bali');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_fcm_tokens`
--
ALTER TABLE `admin_fcm_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_albums`
--
ALTER TABLE `gallery_albums`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `gallery_photos`
--
ALTER TABLE `gallery_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_itineraries`
--
ALTER TABLE `tour_itineraries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_fcm_tokens`
--
ALTER TABLE `admin_fcm_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gallery_albums`
--
ALTER TABLE `gallery_albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gallery_photos`
--
ALTER TABLE `gallery_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tour_itineraries`
--
ALTER TABLE `tour_itineraries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gallery_photos`
--
ALTER TABLE `gallery_photos`
  ADD CONSTRAINT `gallery_photos_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `gallery_albums` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tour_itineraries`
--
ALTER TABLE `tour_itineraries`
  ADD CONSTRAINT `tour_itineraries_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
