-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2024 at 11:46 AM
-- Server version: 10.11.7-MariaDB-4
-- PHP Version: 8.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parlour`
--
CREATE DATABASE IF NOT EXISTS `parlour` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `parlour`;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `booking_date` date NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `status` enum('Pending','Confirmed','Cancelled') DEFAULT 'Pending',
  `payment_status` enum('Pending','Completed','Failed') DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `booking_time` varchar(20) NOT NULL DEFAULT 'Not Specified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `service_id`, `user_name`, `customer_email`, `booking_date`, `service_name`, `staff_id`, `status`, `payment_status`, `created_at`, `booking_time`) VALUES
(37, 5, 'antonio', 'antonio@gmail.com', '2024-11-06', 'Pedicure', 4, 'Pending', 'Pending', '2024-10-06 16:26:49', '00:22'),
(41, 4, 'antonio', 'antonio@gmail.com', '2024-10-06', 'Acne Treatments', 3, 'Pending', 'Pending', '2024-10-06 16:41:08', '10:00-12:00'),
(42, 7, 'Admin1', 'admin1@gmail', '2024-10-07', 'Acrylic Nail', 14, 'Pending', 'Pending', '2024-10-07 07:40:10', '10:00-12:00'),
(45, 1, 'Jerop', 'Jerop@gmail.com', '2024-10-19', 'Haircuts & Stylingf', 5, 'Pending', 'Pending', '2024-10-19 15:12:49', 'Not Specified'),
(46, 2, 'Jerop', 'Jerop@gmail.com', '2024-10-19', 'Color & Highlights', 3, 'Pending', 'Pending', '2024-10-19 15:16:37', 'Not Specified'),
(47, 3, 'Jerop', 'Jerop@gmail.com', '2024-10-19', 'Basic Facials', 15, 'Pending', 'Pending', '2024-10-19 15:33:54', 'Not Specified'),
(48, 6, 'Jerop', 'Jerop@gmail.com', '2024-10-19', 'Manicure', 13, 'Pending', 'Pending', '2024-10-19 15:36:59', 'Not Specified'),
(49, 5, 'Jerop', 'Jerop@gmail.com', '2024-10-19', 'Pedicure', 6, 'Pending', 'Pending', '2024-10-19 15:40:45', 'Not Specified'),
(50, 16, 'Jerop', 'Jerop@gmail.com', '2024-10-19', 'Eyebrow Shaping', 10, 'Pending', 'Pending', '2024-10-19 15:42:21', 'Not Specified'),
(51, 15, 'Jerop', 'Jerop@gmail.com', '2024-10-19', 'Eyelash Extension', 5, 'Pending', 'Pending', '2024-10-19 15:42:56', 'Not Specified'),
(52, 14, 'Jerop', 'Jerop@gmail.com', '2024-10-19', 'Eyebrow and Lash Tint', 4, 'Pending', 'Pending', '2024-10-19 15:52:50', 'Not Specified'),
(53, 13, 'Jerop', 'Jerop@gmail.com', '2024-10-19', 'Eyelash Perm', 4, 'Pending', 'Pending', '2024-10-19 15:55:31', 'Not Specified'),
(54, 12, 'Jerop', 'Jerop@gmail.com', '2024-10-19', 'Eye Rejuvenating Treatment', 5, 'Pending', 'Pending', '2024-10-19 15:56:39', 'Not Specified'),
(55, 10, 'Jerop', 'Jerop@gmail.com', '2024-10-19', 'Chair Massage', 7, 'Pending', 'Pending', '2024-10-19 16:03:33', '07:13'),
(56, 1, 'Smith', 'smith@gmail.com', '2024-10-20', 'Haircuts & Stylingf', 574077886, 'Pending', 'Pending', '2024-10-20 11:25:50', 'Not Specified'),
(57, 1, 'Jeliza', 'Jeliza@gmail.com', '2024-10-20', 'Haircuts & Stylingf', 574077886, 'Pending', 'Pending', '2024-10-20 11:43:12', 'Not Specified'),
(58, 2, 'Jeliza', 'Jeliza@gmail.com', '2024-10-20', 'Color & Highlights', 5223, 'Pending', 'Pending', '2024-10-20 12:57:14', 'Not Specified'),
(59, 5, 'Jeliza', 'Jeliza@gmail.com', '2024-10-20', 'Pedicure', 5223, 'Pending', 'Pending', '2024-10-20 12:57:26', 'Not Specified'),
(60, 9, 'Jeliza', 'Jeliza@gmail.com', '2024-10-20', 'Swedish Massage', 50782060, 'Pending', 'Pending', '2024-10-20 12:57:32', 'Not Specified'),
(61, 12, 'Jeliza', 'Jeliza@gmail.com', '2024-10-20', 'Eye Rejuvenating Treatment', 5223, 'Pending', 'Pending', '2024-10-20 13:05:39', 'Not Specified'),
(62, 2, 'Palm', 'Palm@gmail.com', '2024-10-20', 'Color & Highlights', 574077886, 'Pending', 'Pending', '2024-10-20 13:08:50', 'Not Specified'),
(63, 1, 'Palm', 'Palm@gmail.com', '2024-10-20', 'Haircuts & Stylingf', 50782060, 'Pending', 'Pending', '2024-10-20 13:09:03', 'Not Specified');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `user_id` varchar(20) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `two_fa_secret` varchar(255) DEFAULT NULL,
  `role` enum('customer','staff','admin') NOT NULL DEFAULT 'customer',
  `login_attempts` int(11) DEFAULT 0,
  `last_failed_login` timestamp NULL DEFAULT NULL,
  `lockout_until` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_id`, `user_name`, `password`, `email`, `two_fa_secret`, `role`, `login_attempts`, `last_failed_login`, `lockout_until`) VALUES
('112518257754100392', 'Zafriza', '$2y$10$twl6fnkf9k4u5QThPq96D.7cnuwT7bc0SB.ggZEQwEcWHrI6r.6RW', 'Zafriza@gmail.com', 'GP3ERUJZWY4BRRR3', 'customer', 0, NULL, NULL),
('17755222', 'men', 'eb65bf317c9d1ea1dd27931ef246441d', 'men@gmail', NULL, 'customer', 0, NULL, NULL),
('18393696446771862', 'army', '$2y$10$u9mmhtLQ23aYQ2eFYcamzu9d8yQqzsBG9cXZyxTkrSWtbQ70PrLjK', 'army@gmail.com', NULL, 'customer', 0, NULL, NULL),
('217235827956906689', 'Admin1', '$2y$10$0/ZnUIh3bwZ7WKKXuXBpauXdnLGAd6ba6o4HY/rI35B/STIcelYza', 'admin1@gmail', 'XQ6OYVYJ6BKCUUCV', 'admin', 0, NULL, '2024-10-13 16:22:00'),
('24776175059597606', 'Admin', '$2y$10$JQf3tUZTK/LKhRaemT/TpeixAjStgH.6SyZmESxSsVsaW/92PQxHy', 'admin@gmail.com', 'PFDKNQHKQWC3ARQU', 'admin', 0, NULL, NULL),
('2646599314471', 'antonio', '$2y$10$8ch6kKgQsuAaggdvpESK1OP00yFP32YOwEt4J1zbQU1OPsoev2GUi', 'antonio@gmail.com', 'BJKZJX65O6LKOOTN', 'customer', 0, NULL, NULL),
('278625', 'Palm', '$2y$10$rU7uOlrLxb8/TVsoogTwiemAQTXWDTeVuT7SDBY4Mii0hU7cMBV6G', 'Palm@gmail.com', 'NXEIYNXAWDVRJZUA', 'customer', 0, NULL, NULL),
('32566846', 'kc', '205458ce3f6489446ea6e8382517bf4d', 'kc@gmail.com', NULL, 'customer', 7, NULL, '2024-10-13 16:26:41'),
('3431679823', 'kiprono', 'e424384fcbf3204b38a8be1461abd788', 'kiprono@gmail.com', NULL, 'customer', 0, NULL, NULL),
('3653271943649229465', 'Duran', '$2y$10$KzoDmKUxHcfOp11AZHt8peApF/xrrnyH1wiGPVBVsrirWYFS9d0Ju', 'Duran@gmail.com', 'HMKMU2LYJYGUKMRI', 'customer', 0, NULL, NULL),
('3973721840021278', 'zalley', '$2y$10$O16kfn69OhaJOqiwlHWDa..hyxTjJbVptlGs2o.vOoxMoMDu3U9tm', 'zalley@gmail.com', NULL, 'customer', 0, NULL, NULL),
('459306213607', 'Jeliza', '$2y$10$c8bsfIO0JJmozJTtNGrPweV0fN/NJjkT3w48WZgChAm2F.nAiLz32', 'Jeliza@gmail.com', 'IWGOWP6F3I2BRLQV', 'customer', 0, NULL, NULL),
('46693315487449173', 'kip', '$2y$10$PiHqxBUj0qwEFVB8aF3RhutUp6lvuxZ8tUUWlKisUtAXq9K3RxEkK', 'kip1@gmail.com', 'Y3CL4JHU2K74PZTF', 'customer', 0, NULL, NULL),
('5005296944', 'Kevin', '$2y$10$ZXCPu9n/WqNzFOW/HslDiu/hSEJTGtMMtqNbNPGPWVn2UDQoTAYa6', 'kevin@gmai.com', '52TKUCVI2AIWSWAZ', 'staff', 0, NULL, NULL),
('50782060', 'zizah12', '$2y$10$FQ2vwJYMicmNlAtVaMNGdOcKogdug4DopkChcYy0c1ekiHxfe9m/u', 'davi@gmail', NULL, 'staff', 0, NULL, NULL),
('5223', 'Uzain', '$2y$10$UROFkW5fYdXxikJf.YhdVuVKI3Ts0t.KgrIYuxQ1pshQUEQQXBpuS', 'Uzain@gmail.com', '3RSAB6FFWWY7Q3CJ', 'staff', 0, NULL, NULL),
('574077886', 'Smith', '$2y$10$ZXvloE07nhh9HpgDi4gbP.FeiVSzlTLyO/uDiocKRxC7OYSzl9E9y', 'smith@gmail.com', 'WLVGMQGU36CRCQGR', 'staff', 0, NULL, NULL),
('6056254762920934', 'joy', '363b122c528f54df4a0446b6bab05515', 'j@gmail.com', NULL, 'staff', 0, NULL, NULL),
('62825770', 'ziza20', '$2y$10$HMa04IpWuE2DSHJipgh3..Qs0iy1CUxcQat5C6/Cie4UVQ5dvw9sW', 'zizah20@gmail.com', 'MH7OQBFGCMJW6MJQ', 'customer', 0, NULL, NULL),
('66397889', 'Otamendi', '$2y$10$big7aWXmA7yTXKYeE7m01eZ7GGHtgpFnd0QtRMHxlUfvZWetDah8C', 'o@gmail.com', 'NBX3XOQITXL3A2LD', 'customer', 10, NULL, '2024-10-13 16:41:39'),
('7084497757642', 'real', 'c4ca4238a0b923820dcc509a6f75849b', 'real@gmail.com', NULL, 'customer', 0, NULL, NULL),
('71185125967', 'kibet', '$2y$10$C01VjhhG3K.LO38z.Rs/bew73BMX08GqOEF8RSWmyLYhedDh/kc4G', 'kibet@gmail.com', 'O4KIUA3ZE2I2TYA4', 'customer', 0, NULL, NULL),
('769379683706638129', 'David', '$2y$10$rH86SjkcwSCXcmGVgBtBTOxJmtC.csFG7gKsOnHYu/0o2Chrg/V4K', 'david@gmail.com', NULL, 'customer', 0, NULL, NULL),
('776229730696', 'kiptoo', '$2y$10$zkN.Sn7JoO.U53M4kj1q2OjqLvZ7McwexplYICo.e1XLGNwFfrNa6', 'kiptoo@gmail.com', 'DH6KYHFLRZN5QZWB', 'customer', 0, NULL, NULL),
('8190', 'Jerop', '$2y$10$KZPkY3do2owqR7yes6NdHu0pd52dw4PE7G5pgCI/oC48HEKbnWKyC', 'Jerop@gmail.com', 'LAEBFTCRDWCXQU4V', 'admin', 0, NULL, NULL),
('83063783143167', 'zizah', 'fa749232b9b26cc89e2ad3d651c1f438', 'silateijc90@gmail.com', NULL, 'customer', 0, NULL, NULL),
('994299748802741594', 'Cheryl', '$2y$10$YmsQGbWx0LhTSoBX4bQiTuUMkjUBwvmZGjuCeq8SSrizgweeZjq9u', 'cheryl@gmail.com', NULL, 'staff', 0, NULL, NULL),
('admin123', 'admin_user', '$2y$10$OdPyA0sECN6vHK4jnZ84fep8JXd7W54kBDeOj2YvVwBhqhBjlxmau', 'admin@example.com', NULL, 'admin', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `expires_at`) VALUES
('Zaf@gmail.com', '01e036c246c35b9bb471db78ef3ef27f506cdc225008533a7dfb0be5b31f07ffa8de55303c3a6e40b7562b1ee2f8a932fdcb', '2024-10-06 13:46:51'),
('kc@gmail.com', '0673a7bbf513d28f0b9370be0958bca45e5454c6afa1505781532593efccf0bff3949e8e74c61459be90b99fd5ede54ea70d', '2024-10-04 00:13:41'),
('real@gmail.com', '37ff2147dead6f38e5d46caeb8c650f537aa1c71213c0125aedf8e5bc5f6c1388f22eab78420a156828f6962d426ef91f9e1', '2024-10-04 00:26:59'),
('real@gmail.com', '41a588510bbc82f9cdda2ee9feb0ad02c5ae93fbe68c74b784256583c6b952e19c8288cba6f1874174cac1dd10d7f2a824f4', '2024-10-04 00:19:18'),
('real@gmail.com', '44d795edf030ad0e1994a7e82abd2eb0992224e840ee81582c946bf7e09ed3847bb69bcb16b5c1abc2291281c4c43375a1c2', '2024-10-04 00:18:25'),
('Zaf@gmail.com', '5c64fdc4694e54039f4fe48fcb6613f71009f276d791b7abded1d134b3ac879d8a9906a4d4b6af14a638a9c98c3043a69886', '2024-10-06 13:47:43'),
('zalley@gmail.com', '6f882d86d7142e8186dd70cef0bcd572514788e75f4a4b8632f0e8d2972321482ad395082ba065aa7aa938566dff58bdd586', '2024-10-04 00:51:09'),
('hshw@gmail.com', '84a679531aa6ffedb75280cbe972f2ead45ab4bfcbe7cea53a6742bd3b61ae03cad36ea58a9e843d0e15d28b28ec31e0f241', '2024-10-17 12:00:42'),
('kc@gmail.com', '8a27df35511a206c56f42dc80fab4b0d57cde842149c993e42c4c19a20e73e4554195dcbc3f2a64cc7509a26030401665276', '2024-10-04 00:17:22'),
('men@gmail', '8e4c8f85a10c7e1092a649e1d65c4ef47b2bbf207b803aa942d9cd125cebb62936dbfd74a5f72a2328f4cc0480bf0b8edcb5', '2024-10-03 22:57:44'),
('kc@gmail.com', 'c310abc030dc419afc35c1968cc1259a60c3a44f1948eff83332b9da710a047a6011d964023a4c8f624e3416511fd1859282', '2024-10-03 23:09:56'),
('kc@gmail.com', 'c76b4a760c78747a6274a005254174de7f60d4d6cd44e681e75c710ff604545bc437af5d53ea68b2f34f5473773588fd334d', '2024-10-04 00:26:28'),
('kc@gmail.com', 'd07278d7cf90196bad7db0b174c8bd2b6419662e9ee17156603508c3775df1d8e927e0bcb5103bb3c3780bc1a4ccad5698c8', '2024-10-04 00:04:12'),
('kc@gmail.com', 'd28587f407478c603f130cc2f51e86fc298e425137bc2c8412adc143810ea0a1dedb4c1e920f730e74f64967b605b755f0ca', '2024-10-04 00:20:39'),
('army@gmail.com', 'd6708896727b19033b1977d2dd404bcb09a0ecb38f0d9824245d70d77f589d786de4b22e94c8a0d42a09c8299c806f562462', '2024-10-04 00:28:42'),
('cheryl@gmail.com', 'e89eef14b91cf0cf36b28d6e450fde4fa6ea29196fcc01f4e654a80260b157b13f744110a5f76c1c28e34fcbbcef716d6dc0', '2024-10-04 00:57:17'),
('real@gmail.com', 'ea55a0d1dcce3826d015cd4abc820f7e401e23bc314519e810a3828322697164c1a7a65f63c4683e86e4f80f121bd17776d0', '2024-10-04 00:30:44'),
('real@gmail.com', 'f4042f2c4db664de1dfb5a68560d446fb5cf96a037b89f73936923ba0d03eef8dc4bba9058e2baecae1fb403bda95e8db425', '2024-10-04 00:21:12'),
('o@gmail.com', 'f6a35d09d97b6d952e4b117533896cc1c36dbfdbf281643b24ba6b0ba9da314b1550baede658fc48902338bf02cc12b3bb3b', '2024-10-13 20:34:15'),
('Zaf@gmail.com', 'fbca91e497b4bc5821068e5573aadf8caee17cf7562a31272ef5171b39fc82769286b990bc8344f9e08efa0988b23de690d8', '2024-10-06 13:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('Pending','Completed','Failed') DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `session_slots` int(11) NOT NULL,
  `booked_slots` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `description`, `image`, `session_slots`, `booked_slots`, `price`, `duration`) VALUES
(1, 'Haircuts & Stylingf', 'Cutting hair using basic and advanced techniques, consulting customers about styles and colors and applying hair care products, like treatment oils and masks', 'https://i.pinimg.com/736x/02/10/1a/02101a84bede9f360281e364a7ccaaa3.jpg', 34, 24, 250.00, 0),
(2, 'Color & Highlights', 'Highlights are pieces lighter than your base color, and lowlights are darker than your base color', 'https://files.myglamm.com/site-images/original/Magenta-Mix.png', 100, 28, 600.00, 0),
(3, 'Basic Facials', 'A basic facial is a skincare procedure involving removing dead skin cells, pore cleaning, and using a specific mask to treat common skin issues', 'https://static-bebeautiful-in.unileverservices.com/things-to-never-do-after-getting-a-facial_mobilehome.jpg', 23, 18, 500.00, 0),
(4, 'Acne Treatments', 'Acne medications work by reducing oil production and swelling or by treating bacterial infection', 'https://www.illumiamedical.com/wp-content/uploads/2023/03/post-Acne-Scar-Treatments.png', 13, 4, 1000.00, 0),
(5, 'Pedicure', 'A simple treatment that includes foot soaking, foot scrubbing with a pumice stone or foot file, nail clipping, nail shaping, foot and calf massage, moisturizer and nail polishing', 'https://thumbs.dreamstime.com/b/pedicure-spa-salon-24495476.jpg', 50, 26, 300.00, 0),
(6, 'Manicure', 'A treatment for the care of the hands and fingernails', 'https://img.freepik.com/free-photo/manicurist-master-makes-manicure-woman-s-hands-spa-treatment-concept_186202-7769.jpg', 25, 15, 400.00, 0),
(7, 'Acrylic Nail', 'Acrylics are a combination of a liquid monomer and a powder polymer that form a paste which is bonded to the natural nail', 'https://www.tikli.in/wp-content/uploads/2022/05/Acrylic-Nail.jpg', 34, 15, 450.00, 0),
(8, 'Event Makeup', 'Based on what you plan to wear, your skin coloring, and your facial features, I create a custom makeup look that accentuates your natural beauty for your appearances at parties, galas, or other special events.', 'https://images.squarespace-cdn.com/content/v1/5a69048ee45a7c9ab95720a2/1569443355293-F582TMJFFOVSSBTOGTUX/wreg-768x432.jpg', 10, 8, 1500.00, 0),
(9, 'Swedish Massage', 'This type of massage involves actions like percussion, kneading, vibration, tapping and rolling. Massage oil or lotion is used to protect the skin from friction.', 'https://goodspaguide.co.uk/images/uploads/Stock/Features/balinese-massage.jpg', 15, 3, 2000.00, 0),
(10, 'Chair Massage', 'Chair massage is a form of massage therapy that is performed while the client is fully clothed and seated upright.', 'https://st3.depositphotos.com/7636828/31781/i/600/depositphotos_317811630-stock-photo-physiotherapist-giving-back-massage-to.jpg', 18, 6, 1500.00, 0),
(11, 'Foot Massage', 'A foot massage involves working on the feet with pressure, either manually or with mechanical aids to promote relaxation and health.', 'https://thumbs.dreamstime.com/b/foot-massage-close-up-female-hands-doing-51789230.jpg', 20, 20, 1000.00, 0),
(12, 'Eye Rejuvenating Treatment', 'The most common methods to reduce heavy, drooping brows and upper lids are Thermage, botox, lasers, or surgery', 'https://www.ozmedica.com.au/wp-content/uploads/2019/12/image2.jpg', 30, 17, 500.00, 0),
(13, 'Eyelash Perm', 'Eyelash perming is an innovative way to open up the look of the eye area and ditch the clumsy curlers for good', 'https://cdn1.treatwell.net/images/view/v2.i912378.w1472.h981.x81D92153.jpg', 25, 21, 800.00, 0),
(14, 'Eyebrow and Lash Tint', 'Eyebrow and eyelash tinting is a beauty procedure where semi-permanent dye is painted onto your eyebrows or eyelashes', 'https://www.cheshirelasers.co.uk/wp-content/uploads/2019/05/shutterstock_169734308-2-1024x1024.jpg', 38, 17, 1200.00, 0),
(15, 'Eyelash Extension', 'Eyelash extensions are a cosmetic enhancement that involves attaching synthetic or natural hair fibers to the natural eyelashes to create a fuller, more dramatic look', 'https://st.depositphotos.com/1441511/4328/i/950/depositphotos_43288021-stock-photo-woman-eye-with-long-eyelashes.jpg', 43, 36, 1450.00, 0),
(16, 'Eyebrow Shaping', 'Brow shaping involves waxing and tweezing along your brow\'s natural lines to ensure a perfect contour.', 'https://www.belmorecentre.co.uk/wp-content/uploads/2018/03/Eyebrow-Shaping.jpg', 50, 39, 750.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `phone`, `position`, `created_at`) VALUES
(1, 'John Smith', 'john.smith@example.com', '+254700111222', 'Manager', '2024-10-06 12:40:14'),
(2, 'Jane Doe', 'jane.doe@example.com', '+254700223344', 'Receptionist', '2024-10-06 12:40:14'),
(3, 'Alice Johnson', 'alice.johnson@example.com', '+254700334455', 'Stylist', '2024-10-06 12:40:14'),
(4, 'Bob Brown', 'bob.brown@example.com', '+254700445566', 'Technician', '2024-10-06 12:40:14'),
(5, 'Charlie Davis', 'charlie.davis@example.com', '+254700556677', 'Cleaner', '2024-10-06 12:40:14'),
(6, 'Daisy Wilson', 'daisy.wilson@example.com', '+254700667788', 'Stylist', '2024-10-06 12:40:14'),
(7, 'Eve Moore', 'eve.moore@example.com', '+254700778899', 'Receptionist', '2024-10-06 12:40:14'),
(8, 'Frank Miller', 'frank.miller@example.com', '+254700889900', 'Manager', '2024-10-06 12:40:14'),
(9, 'Grace Taylor', 'grace.taylor@example.com', '+254700990011', 'Technician', '2024-10-06 12:40:14'),
(10, 'Hannah White', 'hannah.white@example.com', '+254701001122', 'Cleaner', '2024-10-06 12:40:14'),
(11, 'Jane Johnson', 'jane.johnson@example.com', '+254737286864', 'Staff Member', '2024-10-06 12:40:20'),
(12, 'Daisy Miller', 'daisy.miller@example.com', '+254791279031', 'Staff Member', '2024-10-06 12:40:20'),
(13, 'Jane Moore', 'jane.moore@example.com', '+254754575670', 'Staff Member', '2024-10-06 12:40:20'),
(14, 'Jane Miller', 'jane.miller@demo.com', '+254729669244', 'Staff Member', '2024-10-06 12:40:21'),
(15, 'Daisy Williams', 'daisy.williams@test.com', '+254704360680', 'Staff Member', '2024-10-06 12:40:21'),
(16, 'Frank Smith', 'frank.smith@demo.com', '+254730785112', 'Staff Member', '2024-10-06 12:40:21'),
(17, 'Hannah Davis', 'hannah.davis@example.com', '+254760476212', 'Staff Member', '2024-10-06 12:40:21'),
(18, 'Jane Miller', 'jane.miller@example.com', '+254732694927', 'Staff Member', '2024-10-06 12:40:21'),
(19, 'Grace Smith', 'grace.smith@demo.com', '+254753248161', 'Staff Member', '2024-10-06 12:40:21'),
(20, 'Charlie Johnson', 'charlie.johnson@example.com', '+254742231818', 'Staff Member', '2024-10-06 12:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `staff_service`
--

CREATE TABLE `staff_service` (
  `staff_id` varchar(20) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_service`
--

INSERT INTO `staff_service` (`staff_id`, `service_id`) VALUES
('5005296944', 1),
('5005296944', 4),
('50782060', 1),
('50782060', 3),
('50782060', 6),
('50782060', 8),
('50782060', 9),
('50782060', 13),
('5223', 2),
('5223', 3),
('5223', 5),
('5223', 10),
('5223', 12),
('5223', 15),
('5223', 16),
('574077886', 2),
('6056254762920934', 1),
('6056254762920934', 5),
('6056254762920934', 7),
('6056254762920934', 8),
('6056254762920934', 11),
('6056254762920934', 14),
('6056254762920934', 15),
('994299748802741594', 4),
('994299748802741594', 6),
('994299748802741594', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `2fa_secret` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`,`service_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `staff_service`
--
ALTER TABLE `staff_service`
  ADD PRIMARY KEY (`staff_id`,`service_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`);

--
-- Constraints for table `staff_service`
--
ALTER TABLE `staff_service`
  ADD CONSTRAINT `staff_service_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `customer` (`user_id`),
  ADD CONSTRAINT `staff_service_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"parlour\",\"table\":\"staff_service\"},{\"db\":\"parlour\",\"table\":\"bookings\"},{\"db\":\"parlour\",\"table\":\"customer\"},{\"db\":\"parlour\",\"table\":\"parlour\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'parlour', 'customer', '{\"sorted_col\":\"`login_attempts` DESC\"}', '2024-10-13 16:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('phpmyadmin', '2024-09-11 14:14:46', '{\"Console\\/Mode\":\"collapse\"}'),
('root', '2024-10-21 11:46:23', '{\"Console\\/Mode\":\"show\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
