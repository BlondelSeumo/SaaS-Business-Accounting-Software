-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2021 at 07:02 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accufy_21`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `hit` int(11) DEFAULT NULL,
  `is_home` int(11) NOT NULL DEFAULT 0,
  `is_featured` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `title` varchar(255) DEFAULT NULL,
  `biz_number` varchar(255) DEFAULT NULL,
  `vat_code` varchar(255) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `business_type` int(11) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `is_primary` int(11) DEFAULT NULL,
  `is_autoload_amount` int(11) NOT NULL,
  `enable_stock` int(11) DEFAULT 0,
  `template_style` int(11) NOT NULL DEFAULT 1,
  `color` varchar(255) NOT NULL DEFAULT '#546af1',
  `footer_note` text DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `business_category`
--

CREATE TABLE `business_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_category`
--

INSERT INTO `business_category` (`id`, `name`) VALUES
(1, 'Arts, crafts, and collectible'),
(2, 'Baby'),
(3, 'Beauty and fragrances'),
(4, 'Books and magazines'),
(5, 'Business to business'),
(6, 'Clothing, accessories, and shoes'),
(7, 'Web, Computers, accessories, and services'),
(8, 'Education'),
(9, 'Electronics and telecom'),
(10, 'Entertainment and media'),
(11, 'Financial services and products'),
(12, 'Food retail and service'),
(13, 'Gifts and flowers'),
(14, 'Government'),
(15, 'Health and personal care'),
(16, 'Home and garden'),
(17, 'Nonprofit'),
(18, 'Pets and animals'),
(19, 'Religion and spirituality (for profit)'),
(20, 'Retail (not elsewhere classified)'),
(21, 'Services - other'),
(22, 'Sports and outdoors'),
(23, 'Toys and hobbies'),
(24, 'Travel'),
(25, 'Vehicle sales'),
(26, 'Vehicle service and accessories');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` int(11) DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` varchar(2) NOT NULL,
  `dial_code` varchar(5) NOT NULL,
  `currency_name` varchar(20) NOT NULL,
  `currency_symbol` varchar(20) NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `user_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `code`, `dial_code`, `currency_name`, `currency_symbol`, `currency_code`, `user_id`) VALUES
(1, 'Andorra', 'AD', '+376', 'Euro', '€', 'EUR', 0),
(2, 'United Arab Emirates', 'AE', '+971', 'United Arab Emirates', 'د.إ', 'AED', 0),
(3, 'Afghanistan', 'AF', '+93', 'Afghan afghani', '؋', 'AFN', 0),
(4, 'Antigua and Barbuda', 'AG', '+1268', 'East Caribbean dolla', '$', 'XCD', 0),
(5, 'Anguilla', 'AI', '+1264', 'East Caribbean dolla', '$', 'XCD', 0),
(6, 'Albania', 'AL', '+355', 'Albanian lek', 'L', 'ALL', 0),
(7, 'Armenia', 'AM', '+374', 'Armenian dram', '', 'AMD', 0),
(8, 'Angola', 'AO', '+244', 'Angolan kwanza', 'Kz', 'AOA', 0),
(9, 'Argentina', 'AR', '+54', 'Argentine peso', '$', 'ARS', 0),
(10, 'Austria', 'AT', '+43', 'Euro', '€', 'EUR', 0),
(11, 'Australia', 'AU', '+61', 'Australian dollar', '$', 'AUD', 0),
(12, 'Aruba', 'AW', '+297', 'Aruban florin', 'ƒ', 'AWG', 0),
(13, 'Azerbaijan', 'AZ', '+994', 'Azerbaijani manat', '', 'AZN', 0),
(14, 'Barbados', 'BB', '+1246', 'Barbadian dollar', '$', 'BBD', 0),
(15, 'Bangladesh', 'BD', '+880', 'Bangladeshi taka', '৳', 'BDT', 0),
(16, 'Belgium', 'BE', '+32', 'Euro', '€', 'EUR', 0),
(17, 'Burkina Faso', 'BF', '+226', 'West African CFA fra', 'Fr', 'XOF', 0),
(18, 'Bulgaria', 'BG', '+359', 'Bulgarian lev', 'лв', 'BGN', 0),
(19, 'Bahrain', 'BH', '+973', 'Bahraini dinar', '.د.ب', 'BHD', 0),
(20, 'Burundi', 'BI', '+257', 'Burundian franc', 'Fr', 'BIF', 0),
(21, 'Benin', 'BJ', '+229', 'West African CFA fra', 'Fr', 'XOF', 0),
(22, 'Bermuda', 'BM', '+1441', 'Bermudian dollar', '$', 'BMD', 0),
(23, 'Brazil', 'BR', '+55', 'Brazilian real', 'R$', 'BRL', 0),
(24, 'Bhutan', 'BT', '+975', 'Bhutanese ngultrum', 'Nu.', 'BTN', 0),
(25, 'Botswana', 'BW', '+267', 'Botswana pula', 'P', 'BWP', 0),
(26, 'Belarus', 'BY', '+375', 'Belarusian ruble', 'Br', 'BYR', 0),
(27, 'Belize', 'BZ', '+501', 'Belize dollar', '$', 'BZD', 0),
(28, 'Canada', 'CA', '+1', 'Canadian dollar', '$', 'CAD', 0),
(29, 'Switzerland', 'CH', '+41', 'Swiss franc', 'Fr', 'CHF', 0),
(30, 'Cote d\'Ivoire', 'CI', '+225', 'West African CFA fra', 'Fr', 'XOF', 0),
(31, 'Cook Islands', 'CK', '+682', 'New Zealand dollar', '$', 'NZD', 0),
(32, 'Chile', 'CL', '+56', 'Chilean peso', '$', 'CLP', 0),
(33, 'Cameroon', 'CM', '+237', 'Central African CFA ', 'Fr', 'XAF', 0),
(34, 'China', 'CN', '+86', 'Chinese yuan', '¥ or 元', 'CNY', 0),
(35, 'Colombia', 'CO', '+57', 'Colombian peso', '$', 'COP', 0),
(36, 'Costa Rica', 'CR', '+506', 'Costa Rican colón', '₡', 'CRC', 0),
(37, 'Cuba', 'CU', '+53', 'Cuban convertible pe', '$', 'CUC', 0),
(38, 'Cape Verde', 'CV', '+238', 'Cape Verdean escudo', 'Esc or $', 'CVE', 0),
(39, 'Cyprus', 'CY', '+357', 'Euro', '€', 'EUR', 0),
(40, 'Czech Republic', 'CZ', '+420', 'Czech koruna', 'Kč', 'CZK', 0),
(41, 'Germany', 'DE', '+49', 'Euro', '€', 'EUR', 0),
(42, 'Djibouti', 'DJ', '+253', 'Djiboutian franc', 'Fr', 'DJF', 0),
(43, 'Denmark', 'DK', '+45', 'Danish krone', 'kr', 'DKK', 0),
(44, 'Dominica', 'DM', '+1767', 'East Caribbean dolla', '$', 'XCD', 0),
(45, 'Dominican Republic', 'DO', '+1849', 'Dominican peso', '$', 'DOP', 0),
(46, 'Algeria', 'DZ', '+213', 'Algerian dinar', 'د.ج', 'DZD', 0),
(47, 'Ecuador', 'EC', '+593', 'United States dollar', '$', 'USD', 0),
(48, 'Estonia', 'EE', '+372', 'Euro', '€', 'EUR', 0),
(49, 'Egypt', 'EG', '+20', 'Egyptian pound', '£ or ج.م', 'EGP', 0),
(50, 'Eritrea', 'ER', '+291', 'Eritrean nakfa', 'Nfk', 'ERN', 0),
(51, 'Spain', 'ES', '+34', 'Euro', '€', 'EUR', 0),
(52, 'Ethiopia', 'ET', '+251', 'Ethiopian birr', 'Br', 'ETB', 0),
(53, 'Finland', 'FI', '+358', 'Euro', '€', 'EUR', 0),
(54, 'Fiji', 'FJ', '+679', 'Fijian dollar', '$', 'FJD', 0),
(55, 'Faroe Islands', 'FO', '+298', 'Danish krone', 'kr', 'DKK', 0),
(56, 'France', 'FR', '+33', 'Euro', '€', 'EUR', 0),
(57, 'Gabon', 'GA', '+241', 'Central African CFA ', 'Fr', 'XAF', 0),
(58, 'United Kingdom', 'GB', '+44', 'British pound', '£', 'GBP', 0),
(59, 'Grenada', 'GD', '+1473', 'East Caribbean dolla', '$', 'XCD', 0),
(60, 'Georgia', 'GE', '+995', 'Georgian lari', 'ლ', 'GEL', 0),
(61, 'Guernsey', 'GG', '+44', 'British pound', '£', 'GBP', 0),
(62, 'Ghana', 'GH', '+233', 'Ghana cedi', '₵', 'GHS', 0),
(63, 'Gibraltar', 'GI', '+350', 'Gibraltar pound', '£', 'GIP', 0),
(64, 'Guinea', 'GN', '+224', 'Guinean franc', 'Fr', 'GNF', 0),
(65, 'Equatorial Guinea', 'GQ', '+240', 'Central African CFA ', 'Fr', 'XAF', 0),
(66, 'Greece', 'GR', '+30', 'Euro', '€', 'EUR', 0),
(67, 'Guatemala', 'GT', '+502', 'Guatemalan quetzal', 'Q', 'GTQ', 0),
(68, 'Guinea-Bissau', 'GW', '+245', 'West African CFA fra', 'Fr', 'XOF', 0),
(69, 'Guyana', 'GY', '+595', 'Guyanese dollar', '$', 'GYD', 0),
(70, 'Hong Kong', 'HK', '+852', 'Hong Kong dollar', '$', 'HKD', 0),
(71, 'Honduras', 'HN', '+504', 'Honduran lempira', 'L', 'HNL', 0),
(72, 'Croatia', 'HR', '+385', 'Croatian kuna', 'kn', 'HRK', 0),
(73, 'Haiti', 'HT', '+509', 'Haitian gourde', 'G', 'HTG', 0),
(74, 'Hungary', 'HU', '+36', 'Hungarian forint', 'Ft', 'HUF', 0),
(75, 'Indonesia', 'ID', '+62', 'Indonesian rupiah', 'Rp', 'IDR', 0),
(76, 'Ireland', 'IE', '+353', 'Euro', '€', 'EUR', 0),
(77, 'Israel', 'IL', '+972', 'Israeli new shekel', '₪', 'ILS', 0),
(78, 'Isle of Man', 'IM', '+44', 'British pound', '£', 'GBP', 0),
(79, 'India', 'IN', '+91', 'Indian rupee', '₹', 'INR', 0),
(80, 'Iraq', 'IQ', '+964', 'Iraqi dinar', 'ع.د', 'IQD', 0),
(81, 'Iceland', 'IS', '+354', 'Icelandic króna', 'kr', 'ISK', 0),
(82, 'Italy', 'IT', '+39', 'Euro', '€', 'EUR', 0),
(83, 'Jersey', 'JE', '+44', 'British pound', '£', 'GBP', 0),
(84, 'Jamaica', 'JM', '+1876', 'Jamaican dollar', '$', 'JMD', 0),
(85, 'Jordan', 'JO', '+962', 'Jordanian dinar', 'د.ا', 'JOD', 0),
(86, 'Japan', 'JP', '+81', 'Japanese yen', '¥', 'JPY', 0),
(87, 'Kenya', 'KE', '+254', 'Kenyan shilling', 'Sh', 'KES', 0),
(88, 'Kyrgyzstan', 'KG', '+996', 'Kyrgyzstani som', 'лв', 'KGS', 0),
(89, 'Cambodia', 'KH', '+855', 'Cambodian riel', '៛', 'KHR', 0),
(90, 'Kiribati', 'KI', '+686', 'Australian dollar', '$', 'AUD', 0),
(91, 'Comoros', 'KM', '+269', 'Comorian franc', 'Fr', 'KMF', 0),
(92, 'Kuwait', 'KW', '+965', 'Kuwaiti dinar', 'د.ك', 'KWD', 0),
(93, 'Cayman Islands', 'KY', '+ 345', 'Cayman Islands dolla', '$', 'KYD', 0),
(94, 'Kazakhstan', 'KZ', '+7 7', 'Kazakhstani tenge', '', 'KZT', 0),
(95, 'Laos', 'LA', '+856', 'Lao kip', '₭', 'LAK', 0),
(96, 'Lebanon', 'LB', '+961', 'Lebanese pound', 'ل.ل', 'LBP', 0),
(97, 'Saint Lucia', 'LC', '+1758', 'East Caribbean dolla', '$', 'XCD', 0),
(98, 'Liechtenstein', 'LI', '+423', 'Swiss franc', 'Fr', 'CHF', 0),
(99, 'Sri Lanka', 'LK', '+94', 'Sri Lankan rupee', 'Rs or රු', 'LKR', 0),
(100, 'Liberia', 'LR', '+231', 'Liberian dollar', '$', 'LRD', 0),
(101, 'Lesotho', 'LS', '+266', 'Lesotho loti', 'L', 'LSL', 0),
(102, 'Lithuania', 'LT', '+370', 'Euro', '€', 'EUR', 0),
(103, 'Luxembourg', 'LU', '+352', 'Euro', '€', 'EUR', 0),
(104, 'Latvia', 'LV', '+371', 'Euro', '€', 'EUR', 0),
(105, 'Morocco', 'MA', '+212', 'Moroccan dirham', 'د.م.', 'MAD', 0),
(106, 'Monaco', 'MC', '+377', 'Euro', '€', 'EUR', 0),
(107, 'Moldova', 'MD', '+373', 'Moldovan leu', 'L', 'MDL', 0),
(108, 'Montenegro', 'ME', '+382', 'Euro', '€', 'EUR', 0),
(109, 'Madagascar', 'MG', '+261', 'Malagasy ariary', 'Ar', 'MGA', 0),
(110, 'Marshall Islands', 'MH', '+692', 'United States dollar', '$', 'USD', 0),
(111, 'Mali', 'ML', '+223', 'West African CFA fra', 'Fr', 'XOF', 0),
(112, 'Myanmar', 'MM', '+95', 'Burmese kyat', 'Ks', 'MMK', 0),
(113, 'Mongolia', 'MN', '+976', 'Mongolian tögrög', '₮', 'MNT', 0),
(114, 'Mauritania', 'MR', '+222', 'Mauritanian ouguiya', 'UM', 'MRO', 0),
(115, 'Montserrat', 'MS', '+1664', 'East Caribbean dolla', '$', 'XCD', 0),
(116, 'Malta', 'MT', '+356', 'Euro', '€', 'EUR', 0),
(117, 'Mauritius', 'MU', '+230', 'Mauritian rupee', '₨', 'MUR', 0),
(118, 'Maldives', 'MV', '+960', 'Maldivian rufiyaa', '.ރ', 'MVR', 0),
(119, 'Malawi', 'MW', '+265', 'Malawian kwacha', 'MK', 'MWK', 0),
(120, 'Mexico', 'MX', '+52', 'Mexican peso', '$', 'MXN', 0),
(121, 'Malaysia', 'MY', '+60', 'Malaysian ringgit', 'RM', 'MYR', 0),
(122, 'Mozambique', 'MZ', '+258', 'Mozambican metical', 'MT', 'MZN', 0),
(123, 'Namibia', 'NA', '+264', 'Namibian dollar', '$', 'NAD', 0),
(124, 'New Caledonia', 'NC', '+687', 'CFP franc', 'Fr', 'XPF', 0),
(125, 'Niger', 'NE', '+227', 'West African CFA fra', 'Fr', 'XOF', 0),
(126, 'Nigeria', 'NG', '+234', 'Nigerian naira', '₦', 'NGN', 0),
(127, 'Nicaragua', 'NI', '+505', 'Nicaraguan córdoba', 'C$', 'NIO', 0),
(128, 'Netherlands', 'NL', '+31', 'Euro', '€', 'EUR', 0),
(129, 'Norway', 'NO', '+47', 'Norwegian krone', 'kr', 'NOK', 0),
(130, 'Nepal', 'NP', '+977', 'Nepalese rupee', '₨', 'NPR', 0),
(131, 'Nauru', 'NR', '+674', 'Australian dollar', '$', 'AUD', 0),
(132, 'Niue', 'NU', '+683', 'New Zealand dollar', '$', 'NZD', 0),
(133, 'New Zealand', 'NZ', '+64', 'New Zealand dollar', '$', 'NZD', 0),
(134, 'Oman', 'OM', '+968', 'Omani rial', 'ر.ع.', 'OMR', 0),
(135, 'Panama', 'PA', '+507', 'Panamanian balboa', 'B/.', 'PAB', 0),
(136, 'Peru', 'PE', '+51', 'Peruvian nuevo sol', 'S/.', 'PEN', 0),
(137, 'French Polynesia', 'PF', '+689', 'CFP franc', 'Fr', 'XPF', 0),
(138, 'Papua New Guinea', 'PG', '+675', 'Papua New Guinean ki', 'K', 'PGK', 0),
(139, 'Philippines', 'PH', '+63', 'Philippine peso', '₱', 'PHP', 0),
(140, 'Pakistan', 'PK', '+92', 'Pakistani rupee', '₨', 'PKR', 0),
(141, 'Poland', 'PL', '+48', 'Polish z?oty', 'zł', 'PLN', 0),
(142, 'Portugal', 'PT', '+351', 'Euro', '€', 'EUR', 0),
(143, 'Palau', 'PW', '+680', 'Palauan dollar', '$', '', 0),
(144, 'Paraguay', 'PY', '+595', 'Paraguayan guaraní', '₲', 'PYG', 0),
(145, 'Qatar', 'QA', '+974', 'Qatari riyal', 'ر.ق', 'QAR', 0),
(146, 'Romania', 'RO', '+40', 'Romanian leu', 'lei', 'RON', 0),
(147, 'Serbia', 'RS', '+381', 'Serbian dinar', 'дин. or din.', 'RSD', 0),
(148, 'Russia', 'RU', '+7', 'Russian ruble', '', 'RUB', 0),
(149, 'Rwanda', 'RW', '+250', 'Rwandan franc', 'Fr', 'RWF', 0),
(150, 'Saudi Arabia', 'SA', '+966', 'Saudi riyal', 'ر.س', 'SAR', 0),
(151, 'Solomon Islands', 'SB', '+677', 'Solomon Islands doll', '$', 'SBD', 0),
(152, 'Seychelles', 'SC', '+248', 'Seychellois rupee', '₨', 'SCR', 0),
(153, 'Sudan', 'SD', '+249', 'Sudanese pound', 'ج.س.', 'SDG', 0),
(154, 'Sweden', 'SE', '+46', 'Swedish krona', 'kr', 'SEK', 0),
(155, 'Singapore', 'SG', '+65', 'Brunei dollar', '$', 'BND', 0),
(156, 'Slovenia', 'SI', '+386', 'Euro', '€', 'EUR', 0),
(157, 'Slovakia', 'SK', '+421', 'Euro', '€', 'EUR', 0),
(158, 'Sierra Leone', 'SL', '+232', 'Sierra Leonean leone', 'Le', 'SLL', 0),
(159, 'San Marino', 'SM', '+378', 'Euro', '€', 'EUR', 0),
(160, 'Senegal', 'SN', '+221', 'West African CFA fra', 'Fr', 'XOF', 0),
(161, 'Somalia', 'SO', '+252', 'Somali shilling', 'Sh', 'SOS', 0),
(162, 'Suriname', 'SR', '+597', 'Surinamese dollar', '$', 'SRD', 0),
(163, 'El Salvador', 'SV', '+503', 'United States dollar', '$', 'USD', 0),
(164, 'Swaziland', 'SZ', '+268', 'Swazi lilangeni', 'L', 'SZL', 0),
(165, 'Chad', 'TD', '+235', 'Central African CFA ', 'Fr', 'XAF', 0),
(166, 'Togo', 'TG', '+228', 'West African CFA fra', 'Fr', 'XOF', 0),
(167, 'Thailand', 'TH', '+66', 'Thai baht', '฿', 'THB', 0),
(168, 'Tajikistan', 'TJ', '+992', 'Tajikistani somoni', 'ЅМ', 'TJS', 0),
(169, 'Turkmenistan', 'TM', '+993', 'Turkmenistan manat', 'm', 'TMT', 0),
(170, 'Tunisia', 'TN', '+216', 'Tunisian dinar', 'د.ت', 'TND', 0),
(171, 'Tonga', 'TO', '+676', 'Tongan pa?anga', 'T$', 'TOP', 0),
(172, 'Turkey', 'TR', '+90', 'Turkish lira', '', 'TRY', 0),
(173, 'Trinidad and Tobago', 'TT', '+1868', 'Trinidad and Tobago ', '$', 'TTD', 0),
(174, 'Tuvalu', 'TV', '+688', 'Australian dollar', '$', 'AUD', 0),
(175, 'Taiwan', 'TW', '+886', 'New Taiwan dollar', '$', 'TWD', 0),
(176, 'Ukraine', 'UA', '+380', 'Ukrainian hryvnia', '₴', 'UAH', 0),
(177, 'Uganda', 'UG', '+256', 'Ugandan shilling', 'Sh', 'UGX', 0),
(178, 'United States', 'US', '+1', 'United States dollar', '$', 'USD', 0),
(179, 'Uruguay', 'UY', '+598', 'Uruguayan peso', '$', 'UYU', 0),
(180, 'Uzbekistan', 'UZ', '+998', 'Uzbekistani som', '', 'UZS', 0),
(181, 'Vietnam', 'VN', '+84', 'Vietnamese ??ng', '₫', 'VND', 0),
(182, 'Vanuatu', 'VU', '+678', 'Vanuatu vatu', 'Vt', 'VUV', 0),
(183, 'Wallis and Futuna', 'WF', '+681', 'CFP franc', 'Fr', 'XPF', 0),
(184, 'Samoa', 'WS', '+685', 'Samoan t?l?', 'T', 'WST', 0),
(185, 'Yemen', 'YE', '+967', 'Yemeni rial', '﷼', 'YER', 0),
(186, 'South Africa', 'ZA', '+27', 'South African rand', 'R', 'ZAR', 0),
(187, 'Zambia', 'ZM', '+260', 'Zambian kwacha', 'ZK', 'ZMW', 0),
(188, 'Zimbabwe', 'ZW', '+263', 'Botswana pula', 'P', 'BWP', 0),
(189, 'Tanzania', 'TZ', '', 'Tanzanian Shilling', 'TZS', 'TSh', 5);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `cus_number` varchar(255) DEFAULT NULL,
  `vat_code` varchar(255) DEFAULT NULL,
  `city` varchar(11) DEFAULT NULL,
  `postal_code` varchar(11) DEFAULT NULL,
  `address1` mediumtext DEFAULT NULL,
  `address2` mediumtext DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `vendor` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `net_amount` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `details` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `is_home` int(11) DEFAULT 0,
  `orders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `google_fonts`
--

CREATE TABLE `google_fonts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT 1 COMMENT 'invoice = 1 & estimates = 2',
  `recurring` int(11) DEFAULT 0,
  `parent_id` int(11) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `poso_number` varchar(255) DEFAULT NULL,
  `customer` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `payment_due` date DEFAULT NULL,
  `expire_on` date DEFAULT NULL,
  `due_limit` int(11) DEFAULT NULL,
  `footer_note` mediumtext DEFAULT NULL,
  `sub_total` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  `convert_total` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `reject_reason` text DEFAULT NULL,
  `client_action_date` date DEFAULT NULL,
  `is_sent` int(11) DEFAULT 0,
  `is_completed` int(11) NOT NULL DEFAULT 0,
  `sent_date` datetime DEFAULT NULL,
  `recurring_start` date DEFAULT NULL,
  `recurring_end` date DEFAULT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `next_payment` date DEFAULT NULL,
  `frequency_count` int(11) NOT NULL DEFAULT 0,
  `is_view` int(11) DEFAULT NULL,
  `view_date` datetime DEFAULT NULL,
  `auto_send` int(11) DEFAULT 0,
  `send_myself` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `item` int(11) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payment_record`
--

CREATE TABLE `invoice_payment_record` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_taxes`
--

CREATE TABLE `invoice_taxes` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `text_direction` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `slug`, `short_name`, `code`, `text_direction`, `status`) VALUES
(1, 'English', 'english', 'en', '', 'ltr', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lang_values`
--

CREATE TABLE `lang_values` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `english` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lang_values`
--

INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES
(1, 'user', 'Dashboard', 'dashboard', 'Dashboard'),
(2, 'user', 'Settings', 'settings', 'Settings'),
(3, 'user', 'Customers', 'customers', 'Customers'),
(4, 'user', 'Categories', 'categories', 'Categories'),
(5, 'user', 'Tax', 'tax', 'Tax'),
(6, 'user', 'Products', 'products', 'Products'),
(7, 'user', 'Estimates', 'estimates', 'Estimates'),
(8, 'user', 'Invoices', 'invoices', 'Invoices'),
(9, 'user', 'Recurring Invoice', 'recurring-invoice', 'Recurring Invoice'),
(10, 'user', 'Vendors', 'vendors', 'Vendors'),
(11, 'user', 'Expense', 'expense', 'Expense'),
(12, 'user', 'Subscription', 'subscription', 'Subscription'),
(13, 'user', 'Reports', 'reports', 'Reports'),
(14, 'user', 'Change Password', 'change-password', 'Change Password'),
(15, 'user', 'logout', 'logout', 'logout'),
(16, 'user', 'Upgrade', 'upgrade', 'Upgrade'),
(17, 'user', 'Income & Expenses ', 'income-expenses', 'Income & Expenses '),
(18, 'user', 'Net Income', 'net-income', 'Net Income'),
(19, 'user', 'Fiscal year ', 'fiscal-year', 'Fiscal year '),
(20, 'user', 'Overdue Invoices', 'overdue-invoices', 'Overdue Invoices'),
(21, 'user', ' Customer', 'customer', ' Customer'),
(22, 'user', 'Amount', 'amount', 'Amount'),
(23, 'user', 'All Customer', 'all-customer', 'All Customer'),
(24, 'user', 'All status', 'all-status', 'All status'),
(25, 'user', 'From ', 'from', 'From '),
(26, 'user', 'To ', 'to', 'To '),
(27, 'user', 'Status', 'status', 'Status'),
(28, 'user', 'Date', 'date', 'Date'),
(29, 'user', 'Number', 'number', 'Number'),
(30, 'user', 'Total', 'total', 'Total'),
(31, 'user', 'Amount Due', 'amount-due', 'Amount Due'),
(32, 'user', 'Actions', 'actions', 'Actions'),
(33, 'user', 'Record a payment', 'record-a-payment', 'Record a payment'),
(34, 'user', 'More', 'more', 'More'),
(35, 'user', 'Record a payment for this invoice', 'record-a-payment-for-this-invoice', 'Record a payment for this invoice'),
(36, 'user', 'Record a payment you’ve already received, such as cash, cheque, or bank payment.', 'record-payment-info', 'Record a payment you’ve already received, such as cash, cheque, or bank payment.'),
(37, 'user', 'Payment date', 'payment-date', 'Payment date'),
(38, 'user', 'Payment due date', 'payment-due-date', 'Payment due date'),
(39, 'user', 'Payment method', 'payment-method', 'Payment method'),
(40, 'user', 'Memo / Notes', 'memo-notes', 'Memo / Notes'),
(41, 'user', 'Add Payment', 'add-payment', 'Add Payment'),
(42, 'user', 'Create New Invoices', 'create-new-invoices', 'Create New Invoice'),
(43, 'user', 'Add Vendor', 'add-vendor', 'Add Vendor'),
(44, 'user', 'Add Product', 'add-product', 'Add Product'),
(45, 'user', 'Add Customer ', 'add-customer', 'Add Customer '),
(46, 'user', 'Create new Bill', 'create-new-bill', 'Create new Bill'),
(47, 'user', 'Create new Estimate', 'create-new-estimate', 'Create new Estimate'),
(48, 'user', 'Create new Invoice', 'create-new-invoice', 'Create new Invoice'),
(49, 'user', 'Recurring', 'recurring', 'Recurring'),
(50, 'user', 'Draft', 'draft', 'Draft'),
(51, 'user', 'Invoice', 'invoice', 'Invoice'),
(52, 'user', 'Edit', 'edit', 'Edit'),
(53, 'user', 'More Actions', 'more-actions', 'More Actions'),
(54, 'user', 'Created', 'created', 'Created'),
(55, 'user', 'Send invoice', 'send-invoice', 'Send invoice'),
(56, 'user', 'Invoice To', 'invoice-to', 'Invoice To'),
(57, 'user', 'Subject', 'subject', 'Subject'),
(58, 'user', 'Message', 'message', 'Message'),
(59, 'user', 'Close', 'close', 'Close'),
(60, 'user', 'Send', 'send', 'Send'),
(61, 'user', 'Items', 'items', 'Items'),
(62, 'user', 'Price', 'price', 'Price'),
(63, 'user', 'Quantity', 'quantity', 'Quantity'),
(64, 'user', 'New Invoice', 'new-invoice', 'New Invoice'),
(65, 'user', 'Last sent', 'last-sent', 'Last sent'),
(66, 'user', 'General Settings', 'general-settings', 'General Settings'),
(67, 'user', 'Business', 'business', 'Business'),
(68, 'user', 'Invoice Customization', 'invoice-customization', 'Invoice Customization'),
(69, 'user', 'Choose invoice templates', 'choose-invoice-templates', 'Choose invoice templates'),
(70, 'user', 'Accent color', 'accent-color', 'Accent color'),
(71, 'user', 'Personal Information', 'personal-information', 'Personal Information'),
(72, 'user', 'Name', 'name', 'Name'),
(73, 'user', 'Country', 'country', 'Country'),
(74, 'user', 'City', 'city', 'City'),
(75, 'user', 'State', 'state', 'State'),
(76, 'user', 'Postcode', 'postcode', 'Postcode'),
(77, 'user', 'Adderss', 'adderss', 'Adderss'),
(78, 'user', 'Old Password', 'old-password', 'Old Password'),
(79, 'user', 'New Password', 'new-password', 'New Password'),
(80, 'user', 'Confirm New Password', 'confirm-new-password', 'Confirm New Password'),
(81, 'user', 'Change', 'change', 'Change'),
(82, 'user', 'Logo', 'logo', 'Logo'),
(83, 'user', 'Information', 'information', 'Information'),
(84, 'user', 'Action', 'action', 'Action'),
(85, 'user', 'Add New business', 'add-new-business', 'Add New business'),
(86, 'user', 'Back', 'back', 'Back'),
(87, 'user', 'Name *', 'name-', 'Name *'),
(88, 'user', 'Title', 'title', 'Title'),
(89, 'user', 'Address', 'address', 'Address'),
(90, 'user', 'This is your reporting currency and cannot be changed. You can still send invoices, track expenses and enter transactions in any currency and an exchange rate is applied for you.', 'currency-notice', 'This is your reporting currency and cannot be changed. You can still send invoices, track expenses and enter transactions in any currency and an exchange rate is applied for you.'),
(91, 'user', 'Save business', 'save-business', 'Save business'),
(92, 'user', 'Upload Business logo', 'upload-business-logo', 'Upload Business logo'),
(93, 'user', 'Default', 'default', 'Default'),
(94, 'user', 'Sat Default', 'sat-default', 'Sat Default'),
(95, 'user', 'All customers', 'all-customers', 'All customers'),
(96, 'user', 'Show entries', 'show-entries', 'Show entries'),
(97, 'user', 'Email', 'email', 'Email'),
(98, 'user', 'Info', 'info', 'Info'),
(99, 'user', 'Phone', 'phone', 'Phone'),
(100, 'user', 'Added', 'added', 'Added'),
(101, 'user', 'Edit customer', 'edit-customer', 'Edit customer'),
(102, 'user', 'Customer Name', 'customer-name', 'Customer Name'),
(103, 'user', 'Billing Information', 'billing-information', 'Billing Information'),
(104, 'user', 'Currency', 'currency', 'Currency'),
(105, 'user', 'Postal / Zip code', 'postal-zip-code', 'Postal / Zip code'),
(106, 'user', 'Address 1', 'address-1', 'Address 1'),
(107, 'user', 'Address 2', 'address-2', 'Address 2'),
(108, 'user', 'Previous', 'previous', 'Previous'),
(109, 'user', 'Next', 'next', 'Next'),
(110, 'user', 'Search', 'search', 'Search'),
(111, 'user', 'Showing ', 'showing', 'Showing '),
(112, 'user', 'entries', 'entries', 'entries'),
(113, 'user', 'Type', 'type', 'Type'),
(114, 'user', 'Edit Category', 'edit-category', 'Edit Category'),
(115, 'user', 'Category Name', 'category-name', 'Category Name'),
(116, 'user', 'Add new category', 'add-new-category', 'Add new category'),
(117, 'user', 'All tax', 'all-tax', 'All tax'),
(118, 'user', 'Rate', 'rate', 'Rate'),
(119, 'user', 'Add new tax', 'add-new-tax', 'Add new tax'),
(120, 'user', 'Tax Name', 'tax-name', 'Tax Name'),
(121, 'user', 'Tax Rate ', 'tax-rate', 'Tax Rate '),
(122, 'user', 'Tax rate should be a number only, without a percent sign', 'tax-rate-info', 'Tax rate should be a number only, without a percent sign'),
(123, 'user', 'Tax Number / ID', 'tax-number-id', 'Tax Number / ID'),
(124, 'user', 'Details', 'details', 'Details'),
(125, 'user', 'Save tax ', 'save-tax', 'Save tax '),
(126, 'user', 'Show the tax Number on invoices', 'show-the-tax-number-on-invoices', 'Show the tax name on invoices'),
(127, 'user', 'Products & Services', 'products-services', 'Products & Services'),
(128, 'user', 'New Estimates', 'new-estimates', 'New Estimate'),
(129, 'user', 'All Estimate', 'all-estimate', 'All Estimate'),
(130, 'user', ' Iconic', 'iconic', ' Iconic'),
(131, 'user', ' United States', 'united-states', ' United States'),
(132, 'user', 'Estimate to', 'estimate-to', 'Estimate to'),
(133, 'user', 'Estimate number', 'estimate-number', 'Estimate number'),
(134, 'user', 'P.O./S.O. number', 'p.o.s.o.-number', 'P.O./S.O. number'),
(135, 'user', 'Estimate date', 'estimate-date', 'Estimate date'),
(136, 'user', 'Expires on', 'expires-on', 'Expires on'),
(137, 'user', 'Item', 'item', 'Item'),
(138, 'user', 'Add am customers', 'add-am-customers', 'Add am customers'),
(139, 'user', 'Add an item', 'add-an-item', 'Add an item'),
(140, 'user', 'Sub Total', 'sub-total', 'Sub Total'),
(141, 'user', 'Discount', 'discount', 'Discount'),
(142, 'user', 'Grand Total', 'grand-total', 'Grand Total'),
(143, 'user', 'Footer', 'footer', 'Footer'),
(144, 'user', 'Save Estimate', 'save-estimate', 'Save Estimate'),
(145, 'user', 'More Action ', 'more-action', 'More Action '),
(146, 'user', 'Your subscription', 'your-subscription', 'Your subscription'),
(147, 'user', 'Premium Plan', 'premium-plan', 'Premium Plan'),
(148, 'user', 'Billing Frequency', 'billing-frequency', 'Billing Frequency'),
(149, 'user', 'Last Billing', 'last-billing', 'Last Billing'),
(150, 'user', 'Next Billing', 'next-billing', 'Next Billing'),
(151, 'user', 'Upgrade Plan', 'upgrade-plan', 'Upgrade Plan'),
(152, 'user', 'Basic', 'basic', 'Basic'),
(153, 'user', 'Standard', 'standard', 'Standard'),
(154, 'user', 'Premium', 'premium', 'Premium'),
(155, 'user', 'Downgrade', 'downgrade', 'Downgrade'),
(156, 'user', 'Add new vendor', 'add-new-vendor', 'Add new vendor'),
(157, 'user', 'Vendor Name', 'vendor-name', 'Vendor Name'),
(158, 'user', 'Save vendor', 'save-vendor', 'Save vendor'),
(159, 'user', 'Add New Expenses', 'add-new-expenses', 'Add New Expenses'),
(160, 'user', 'Category', 'category', 'Category'),
(161, 'user', 'Client', 'client', 'Client'),
(162, 'user', 'Notes', 'notes', 'Notes'),
(163, 'user', 'Yearly', 'yearly', 'Yearly'),
(164, 'user', 'Monthly ', 'monthly', 'Monthly '),
(165, 'user', 'Sign in', 'sign-in', 'Sign in'),
(166, 'admin', 'Packages by Users', 'packages-by-users', 'Packages by Users'),
(167, 'admin', 'Basic Package', 'basic-package', 'Basic Package'),
(168, 'admin', 'Standard Package', 'standard-package', 'Standard Package'),
(169, 'admin', 'Premium Package', 'premium-package', 'Premium Package'),
(170, 'admin', 'Recently joined Users', 'recently-joined-users', 'Recently joined Users'),
(171, 'admin', 'Last 12 months Income', 'last-12-months-income', 'Last 12 months Income'),
(172, 'admin', 'Avatar', 'avatar', 'Avatar'),
(173, 'admin', 'All Users', 'all-users', 'All Users'),
(174, 'admin', 'Package', 'package', 'Package'),
(175, 'admin', 'Payment status', 'payment-status', 'Payment status'),
(176, 'admin', 'Join', 'join', 'Join'),
(177, 'admin', 'Expire', 'expire', 'Expire'),
(178, 'admin', '-1 days left', '-1-days-left', '-1 days left'),
(179, 'admin', 'pending', 'pending', 'pending'),
(180, 'admin', '2 weeks ago', '2-weeks-ago', '2 weeks ago'),
(181, 'admin', 'Email Settings  ', 'email-settings', 'Email Settings  '),
(182, 'admin', 'Social Settings', 'social-settings', 'Social Settings'),
(183, 'admin', ' Payment Settings', 'payment-settings', ' Payment Settings'),
(184, 'admin', 'Recapture Settings ', 'recaptcha-settings', 'reCaptcha Settings'),
(185, 'admin', 'Update Settings', 'update-settings', 'Update Settings'),
(186, 'admin', 'Captcha Site key', 'captcha-site-key', 'Captcha Site key'),
(187, 'admin', 'Captcha Secret key', 'captcha-secret-key', 'Captcha Secret key'),
(188, 'admin', 'Preferences', 'preferences', 'Preferences'),
(189, 'admin', 'Google reCaptcha', 'google-recaptcha', 'Google reCaptcha'),
(190, 'admin', 'Registration System', 'registration-system', 'Registration System'),
(191, 'admin', 'Email Verification', 'email-verification', 'Email Verification'),
(192, 'admin', 'Paypal payment', 'paypal-payment', 'Paypal payment'),
(193, 'admin', 'Disable', 'disable', 'Disable'),
(194, 'admin', 'Enable', 'enable', 'Enable'),
(195, 'admin', 'Application Name', 'application-name', 'Application Name'),
(196, 'admin', 'Application Title', 'application-title', 'Application Title'),
(197, 'admin', 'Keywords', 'keywords', 'Keywords'),
(198, 'admin', 'Description', 'description', 'Description'),
(199, 'admin', 'Footer About', 'footer-about', 'Footer About'),
(200, 'admin', 'Admin Email', 'admin-email', 'Admin Email'),
(201, 'admin', 'Copyright', 'copyright', 'Copyright'),
(202, 'admin', 'Update Faction ', 'update-faction', 'Update Faction '),
(203, 'admin', 'Update Logo', 'update-logo', 'Update Logo'),
(204, 'admin', ' Gmail Smtp', 'gmail-smtp', ' Gmail Smtp'),
(205, 'admin', 'Gmail host', 'gmail-host', 'Gmail host'),
(206, 'admin', 'Gmail port', 'gmail-port', 'Gmail port'),
(207, 'admin', 'Mail Protocol', 'mail-protocol', 'Mail Protocol'),
(208, 'admin', 'Mail title', 'mail-title', 'Mail title'),
(209, 'admin', 'Mail host', 'mail-host', 'Mail host'),
(210, 'admin', 'Mail port', 'mail-port', 'Mail port'),
(211, 'admin', 'Mail username', 'mail-username', 'Mail username'),
(212, 'admin', 'Mail password', 'mail-password', 'Mail password'),
(213, 'admin', 'Paypal Mode', 'paypal-mode', 'Paypal Mode'),
(214, 'admin', 'Paypal Merchant Account', 'paypal-merchant-account', 'Paypal Merchant Account'),
(215, 'admin', 'Facebook', 'facebook', 'Facebook'),
(216, 'admin', 'Twitter', 'twitter', 'Twitter'),
(217, 'admin', 'Instagram', 'instagram', 'Instagram'),
(218, 'admin', 'Linkedin', 'linkedin', 'Linkedin'),
(219, 'admin', 'Google Analytics', 'google-analytics', 'Google Analytics'),
(220, 'admin', 'Manage Packages', 'manage-packages', 'Manage Packages'),
(221, 'admin', 'Update Package - Basic', 'update-package-basic', 'Update Package - Basic'),
(222, 'admin', 'Monthly Price', 'monthly-price', 'Monthly Price'),
(223, 'admin', 'Yearly Price', 'yearly-price', 'Yearly Price'),
(224, 'admin', 'Update Package - Standard', 'update-package-standard', 'Update Package - Standard'),
(225, 'admin', 'Update Package - Premium', 'update-package-premium', 'Update Package - Premium'),
(226, 'admin', 'Is popular Packages', 'is-popular-packages', 'Is popular Packages'),
(227, 'admin', 'Features', 'features', 'Features'),
(228, 'admin', 'Thumb', 'thumb', 'Thumb'),
(229, 'admin', 'Edit Feature', 'edit-feature', 'Edit Feature'),
(230, 'admin', 'Every invoice paid is positive incoming revenue for your business. Accufy enables you to easily create and send professional invoices, with advanced features like recurring billing. asd', 'every-invoice-paid-is-positive-incoming-revenue-for-your-business.-accufy-enables-you-to-easily-create-and-send-professional-invoices-with-advanced-features-like-recurring-billing.-asd', 'Every invoice paid is positive incoming revenue for your business. Accufy enables you to easily create and send professional invoices, with advanced features like recurring billing. asd'),
(231, 'admin', 'Upload Image ', 'upload-image', 'Upload Image '),
(232, 'admin', 'Add New Feature', 'add-new-feature', 'Add New Feature'),
(233, 'admin', 'Save ', 'save', 'Save '),
(234, 'admin', 'Size ', 'size', 'Size '),
(235, 'admin', 'Foment ', 'foment', 'Foment '),
(236, 'admin', 'Font ', 'font', 'Font '),
(237, 'admin', 'Styles', 'styles', 'Styles'),
(238, 'admin', 'Edit Package ', 'edit-package', 'Edit Package '),
(239, 'admin', 'Edit Features', 'edit-features', 'Edit Features'),
(240, 'admin', 'Add New Page', 'add-new-page', 'Add New Page'),
(241, 'admin', 'Pages', 'pages', 'Pages'),
(242, 'admin', 'Edit page', 'edit-page', 'Edit page'),
(243, 'admin', 'Page title', 'page-title', 'Page title'),
(244, 'admin', 'Page slug', 'page-slug', 'Page slug'),
(245, 'admin', 'Page description', 'page-description', 'Page description'),
(246, 'admin', 'erfref', 'erfref', 'erfref'),
(247, 'admin', ' Aloha', 'aloha', ' Aloha'),
(248, 'admin', 'Faqs', 'faqs', 'Faqs'),
(249, 'admin', 'All Faqs', 'all-faqs', 'All Faqs'),
(250, 'admin', 'Add New testimonial', 'add-new-testimonial', 'Add New testimonial'),
(251, 'admin', 'Client Name', 'client-name', 'Client Name'),
(252, 'admin', 'Designation', 'designation', 'Designation'),
(253, 'admin', 'Feedback ', 'feedback', 'Feedback '),
(254, 'admin', 'Upload Client Avatar ', 'upload-client-avatar', 'Upload Client Avatar '),
(255, 'admin', 'Blog', 'blog', 'Blog'),
(256, 'admin', 'Add category', 'add-category', 'Add category'),
(257, 'admin', 'Bolg posts ', 'bolg-posts', 'Bolg posts '),
(258, 'admin', 'All Blog posts', 'all-blog-posts', 'All Blog posts'),
(259, 'admin', 'Add New Blog Post', 'addblog-post', 'Add New Blog Post'),
(260, 'admin', 'Add Blog Post', 'add-blog-post', 'Add Blog Post'),
(261, 'admin', 'Add New Blog Post', 'add-new-blog-post', 'Add New Blog Post'),
(262, 'admin', 'Slug', 'slug', 'Slug'),
(263, 'admin', 'Tags', 'tags', 'Tags'),
(264, 'admin', 'Post description', 'post-description', 'Post description'),
(265, 'admin', 'Save Post ', 'save-post', 'Save Post '),
(266, 'admin', 'Active', 'active', 'Active'),
(267, 'admin', 'inactive', 'inactive', 'inactive'),
(268, 'admin', 'Users', 'users', 'Users'),
(269, 'user', 'Pricing Package', 'pricing-package', 'Pricing Package'),
(270, 'admin', 'Testimonial', 'testimonial', 'Testimonial'),
(271, 'admin', 'Language', 'language', 'Language'),
(272, 'admin', 'No data founds', 'no-data-founds', 'No data founds'),
(273, 'user', 'See all overdue invoices', 'see-all-overdue-invoices', 'See all overdue invoices'),
(274, 'user', 'Recently Paid Invoices', 'recently-paid-invoices', 'Recently Paid Invoices'),
(275, 'user', 'See all paid invoices', 'see-all-paid-invoices', 'See all paid invoices'),
(276, 'user', 'Select', 'select', 'Select'),
(277, 'admin', 'Save Changes', 'save-changes', 'Save Changes'),
(278, 'user', 'Edit business', 'edit-business', 'Edit business'),
(279, 'user', 'Informations', 'informations', 'Informations'),
(280, 'user', 'Select country', 'select-country', 'Select country'),
(281, 'user', 'Select business category', 'select-business-category', 'Select business category'),
(282, 'user', 'Update', 'update', 'Update'),
(283, 'user', 'Template', 'template', 'Template'),
(284, 'user', 'Add New Customer', 'add-new-customer', 'Add New Customer'),
(285, 'user', 'Edit tax', 'edit-tax', 'Edit tax'),
(286, 'user', 'Edit product', 'edit-product', 'Edit product'),
(287, 'user', 'Product Name', 'product-name', 'Product Name'),
(288, 'user', 'Sell this', 'sell-this', 'Sell this'),
(289, 'user', 'Allow this product or service to be added to Invoices', 'allow-this-product', 'Allow this product or service to be added to Invoices'),
(290, 'user', 'Income Category', 'income-category', 'Income Category'),
(291, 'user', 'Buy this', 'buy-this', 'Buy this'),
(292, 'user', 'Allow this product or service to be added to Bills.', 'allow-this-product-to-bills', 'Allow this product or service to be added to Bills.'),
(293, 'user', 'Product Details', 'product-details', 'Product Details'),
(294, 'user', 'Expense Category', 'expense-category', 'Expense Category'),
(295, 'user', 'Preview as a customer', 'preview-as-a-customer', 'Preview as a customer'),
(296, 'user', 'Export as PDF', 'export-as-pdf', 'Export as PDF'),
(297, 'user', 'Send estimate', 'send-estimate', 'Send estimate'),
(298, 'user', 'Send a copy to myself at', 'send-a-copy-to-myself-at', 'Send a copy to myself at'),
(299, 'user', 'Finish Setup', 'finish-setup', 'Finish Setup'),
(300, 'user', 'You haven\'t finished your setup yet. We recommend you to finish your setup before send your invoice.', 'setup-alert-msg', 'You haven\'t finished your setup yet. We recommend you to finish your setup before send your invoice.'),
(301, 'user', 'Finish Setup Now', 'finish-setup-now', 'Finish Setup Now'),
(302, 'user', 'You have reached your limit', 'reached-limit', 'You have reached your limit'),
(303, 'user', 'You already created', 'you-already-created', 'You already created'),
(304, 'user', 'Please upgrade your package to unlock the features.', 'package-limit-msg', 'Please upgrade your package to unlock the features.'),
(305, 'user', 'Upgrade your plan', 'upgrade-your-plan', 'Upgrade your plan'),
(306, 'user', 'All Estimates', 'all-estimates', 'All Estimates'),
(307, 'user', 'Oops! There was an issue with your Estimate. Please try again', 'invoice-create-error', 'Oops! There was an issue with your Estimate. Please try again'),
(308, 'user', 'Business address and contact details, title, summary, and logo', 'invoice-heading-title', 'Business address and contact details, title, summary, and logo'),
(309, 'user', 'Summary example: project name, description of estimate', 'summery-placeholder', 'Summary example: project name, description of estimate'),
(310, 'user', 'Add a customer', 'add-a-customer', 'Add a customer'),
(311, 'user', 'Select tax', 'select-tax', 'Select tax'),
(312, 'user', 'Enter a footer for this invoice (e.g. tax information, thank you note)', 'invoice-footer-placeholder', 'Enter a footer for this invoice (e.g. tax information, thank you note)'),
(313, 'user', 'Preview mode', 'preview-mode', 'Preview mode'),
(314, 'user', 'You are previewing how your customer will see the web version of your estimate', 'preview-mode-msg', 'You are previewing how your customer will see the web version of your'),
(315, 'user', 'Print', 'print', 'Print'),
(316, 'user', 'Download Pdf', 'download-pdf', 'Download Pdf'),
(317, 'user', 'Convert to invoice', 'convert-to-invoice', 'Convert to invoice'),
(318, 'user', 'Select payment method', 'select-payment-method', 'Select payment method'),
(319, 'user', 'Unpaid', 'unpaid', 'Unpaid'),
(320, 'user', 'Paid', 'paid', 'Paid'),
(321, 'user', 'Sent', 'sent', 'Sent'),
(322, 'user', 'All Invoices', 'all-invoices', 'All Invoices'),
(323, 'user', 'Add new product', 'add-new-product', 'Add new product'),
(324, 'user', 'This is a preview of your invoice. Switch back to Edit if you need to make changes.', 'preview-invoice-info', 'This is a preview of your invoice. Switch back to Edit if you need to make changes.'),
(325, 'user', 'Due on', 'due-on', 'Due on'),
(326, 'user', 'You created this invoice, but you have not approved it', 'approve-info', 'You created this invoice, but you have not approved it'),
(327, 'user', 'Your customer has paid this invoice in full.', 'paid-info', 'Your customer has paid this invoice in full.'),
(328, 'user', 'Your customer has not paid the full invoice amount on time.', 'unpaid-info', 'Your customer has not paid the full invoice amount on time.'),
(329, 'user', 'Draft Invoice', 'draft-invoice', 'Draft Invoice'),
(330, 'user', 'This is a DRAFT invoice. You can take further actions once you approve it', 'draft-inv-info', 'This is a DRAFT invoice. You can take further actions once you approve it'),
(331, 'user', 'Your invoice is awaiting payment', 'awaiting-payment', 'Your invoice is awaiting payment'),
(332, 'user', 'Your invoice is paid in full', 'paid-in-full', 'Your invoice is paid in full'),
(333, 'user', 'Payments received', 'payments-received', 'Payments received'),
(334, 'user', ' A payment for', 'a-payment-for', ' A payment for'),
(335, 'user', 'Send Again', 'send-again', 'Send Again'),
(336, 'user', 'Payment terms', 'payment-terms', 'Payment terms'),
(337, 'user', 'On Receipt', 'on-receipt', 'On Receipt'),
(338, 'user', 'Within', 'within', 'Within'),
(339, 'user', 'Days', 'days', 'Days'),
(340, 'user', 'Invoice Schedule', 'invoice-schedule', 'Invoice Schedule'),
(341, 'user', 'Recurring start', 'recurring-start', 'Recurring start'),
(342, 'user', 'Recurring end', 'recurring-end', 'Recurring end'),
(343, 'user', 'Repeat invoice', 'repeat-invoice', 'Repeat invoice'),
(344, 'user', 'Set schedule', 'set-schedule', 'Set schedule'),
(345, 'user', 'Start date', 'start-date', 'Start date'),
(346, 'user', 'Repeat this invoice', 'repeat-this-invoice', 'Repeat this invoice'),
(347, 'user', 'Weekly', 'weekly', 'Weekly'),
(348, 'user', 'Weeks', 'weeks', 'Weeks'),
(349, 'user', 'Months', 'months', 'Months'),
(350, 'user', 'Years', 'years', 'Years'),
(351, 'user', 'End date', 'end-date', 'End date'),
(352, 'user', 'Auto send invoice by e-mail', 'auto-send-invoice-by-e-mail', 'Auto send invoice by e-mail'),
(353, 'user', 'Email a copy of each invoice to myself', 'email-a-copy', 'Email a copy of each invoice to myself'),
(354, 'user', 'Bill to', 'bill-to', 'Bill to'),
(355, 'user', 'You have not added a customer', 'empty-customer', 'You have not added a customer'),
(356, 'user', 'Invoice number', 'invoice-number', 'Invoice number'),
(357, 'user', 'Invoice date', 'invoice-date', 'Invoice date'),
(358, 'user', 'Due date', 'due-date', 'Due date'),
(359, 'user', 'You have not added any items', 'empty-items', 'You have not added any items'),
(360, 'user', 'Package Plan', 'package-plan', 'Package Plan'),
(361, 'user', 'PAY NOW', 'pay-now', 'PAY NOW'),
(362, 'user', 'Your payment has be completed successfully !', 'payment-success-msg', 'Your payment has be completed successfully !'),
(363, 'user', 'Your payment has be failed ! Please try again', 'payment-error-msg', 'Your payment has be failed ! Please try again'),
(364, 'user', 'Continue', 'continue', 'Continue'),
(365, 'user', 'Failed', 'failed', 'Failed'),
(366, 'user', 'Try again', 'try-again', 'Try again'),
(367, 'user', 'Show Report', 'show-report', 'Show Report'),
(368, 'user', 'Plan', 'plan', 'Plan'),
(369, 'user', 'Days left', 'days-left', 'Days left'),
(370, 'user', 'per year', 'per-year', 'per year'),
(371, 'user', 'per month', 'per-month', 'per month'),
(372, 'user', 'Unlimited', 'unlimited', 'Unlimited'),
(373, 'user', 'Edit vendor', 'edit-vendor', 'Edit vendor'),
(374, 'user', 'Edit Expense', 'edit-expense', 'Edit Expense'),
(375, 'user', 'Expenses', 'expenses', 'Expenses'),
(376, 'user', 'Expense Amount', 'expense-amount', 'Expense Amount'),
(377, 'user', 'Save and continue', 'save-and-continue', 'Save and continue'),
(378, 'user', 'Preview', 'preview', 'Preview'),
(379, 'user', 'Manage business', 'manage-business', 'Manage business'),
(380, 'user', 'Manage profile', 'manage-profile', 'Manage profile'),
(381, 'user', 'Sign out', 'sign-out', 'Sign out'),
(382, 'user', 'accounts', 'accounts', 'accounts'),
(383, 'user', 'No users found', 'no-users-found', 'No users found'),
(384, 'user', 'Edit Faq', 'edit-faq', 'Edit Faq'),
(385, 'user', 'Add New Faq', 'add-new-faq', 'Add New Faq'),
(386, 'user', 'Upload favicon', 'upload-favicon', 'Upload favicon'),
(387, 'user', 'Upload logo', 'upload-logo', 'Upload logo'),
(388, 'user', 'Not found', 'not-found', 'Not found'),
(389, 'user', 'Update Package features for', 'update-package-features-for', 'Update Package features for'),
(390, 'user', 'Basic Limit', 'basic-limit', 'Basic Limit'),
(391, 'user', 'Standared Limit', 'standared-limit', 'Standared Limit'),
(392, 'user', 'Premium Limit', 'premium-limit', 'Premium Limit'),
(393, 'user', 'Update Package', 'update-package', 'Update Package'),
(394, 'user', 'Yes', 'yes', 'Yes'),
(395, 'user', 'No', 'no', 'No'),
(396, 'user', 'Edit testimonial', 'edit-testimonial', 'Edit testimonial'),
(397, 'user', 'Edit Blog Post', 'edit-blog-post', 'Edit Blog Post'),
(398, 'front', 'Pricing', 'pricing', 'Pricing'),
(399, 'front', 'Home', 'home', 'Home'),
(400, 'front', 'Blogs', 'blogs', 'Blogs'),
(401, 'front', 'Contact', 'contact', 'Contact'),
(402, 'front', 'Create Account', 'create-account', 'Create Account'),
(403, 'front', 'Get Started', 'get-started', 'Get Started'),
(404, 'front', 'The better way to make, move and manage your money', 'home-feature-title', 'The better way to keep track & manage your money'),
(405, 'front', 'Workflow', 'workflow', 'Workflow'),
(406, 'front', 'Look at a glance how our app works', 'how-app-works', 'Look at a glance how our app works'),
(407, 'front', 'Choose Plan', 'choose-plan', 'Choose Plan'),
(408, 'front', 'Choose your comfortable plan', 'choose-your-comfortable-plan', 'Choose your comfortable plan'),
(409, 'front', 'Get Paid', 'get-paid', 'Get Paid'),
(410, 'front', 'Paid via paypal payment method', 'paid-via-paypal-payment-method', 'Paid via paypal payment method'),
(411, 'front', 'Start Working', 'start-working', 'Start Working'),
(412, 'front', 'Start Using and explore the featuers', 'start-using-and-explore-the-featuers', 'Start Using and explore the features'),
(413, 'front', 'Clients Say', 'clients-say', 'Clients Say'),
(414, 'front', 'Learn more, Build skills & Empower yourself', 'learn-more-build-skills-empower-yourself', 'Learn more, Build skills & Empower yourself'),
(415, 'front', 'Get in touch', 'get-in-touch', 'Get in touch'),
(416, 'front', '404 Not Found', '404-not-found', '404 Not Found'),
(417, 'front', 'The resource requested could not be found on this site!', '404-msg', 'The resource requested could not be found on this site!'),
(418, 'front', 'Back to Home', 'back-to-home', 'Back to Home'),
(419, 'front', 'Full name', 'full-name', 'Full name'),
(420, 'front', 'Write your Message', 'write-your-message', 'Write your Message'),
(421, 'front', 'Forgot password?', 'forgot-password', 'Forgot password?'),
(422, 'front', 'Recover password', 'recover-password', 'Recover password'),
(423, 'front', 'SUBMIT', 'submit', 'SUBMIT'),
(424, 'front', 'Login', 'login', 'Login'),
(425, 'front', 'Enter your email', 'enter-your-email', 'Enter your email'),
(426, 'front', 'Small Business—friendly Pricing', 'price-title', 'Small Business—friendly Pricing'),
(427, 'front', 'We\'re offering a generous Free Plan and affordable premium pricing plans that grow with your business', 'price-desc', 'We\'re offering a generous Free Plan and affordable premium pricing plans that grow with your business'),
(428, 'front', 'Done', 'done', 'Done'),
(429, 'front', 'Error', 'error', 'Error'),
(430, 'front', 'Please complete your payment by clicking the PAY NOW button', 'complete-your-payment', 'Please complete your payment by clicking the PAY NOW button'),
(431, 'front', 'Registration system is disabled', 'registration-system-is-disabled', 'Registration system is disabled'),
(432, 'front', 'helps Entrepreneurs to manage their business & finances', 'register-info', 'helps Entrepreneurs to manage their business & finances'),
(433, 'front', 'Sign Up', 'sign-up', 'Sign Up'),
(434, 'front', 'I agree with Terms of Services', 'agree-info', 'I agree with Terms of Services'),
(435, 'front', 'Setup your first Business', 'setup-your-first-business', 'Setup your first Business'),
(436, 'front', 'Select Business Type', 'select-business-type', 'Select Business Type'),
(437, 'front', 'You are almost done', 'you-are-almost-done', 'You are almost done'),
(438, 'front', 'Post comment', 'post-comment', 'Post comment'),
(439, 'front', 'Related Posts', 'related-posts', 'Related Posts'),
(440, 'front', 'Comments', 'comments', 'Comments'),
(441, 'front', 'Verify Account', 'verify-account', 'Verify Account'),
(442, 'front', 'We have sent a link to your registered email address, please click this link to verify your account', 'verify-acc-msg', 'We have sent a link to your registered email address, please click this link to verify your account'),
(443, 'front', 'Email verification failed!', 'verify-failed', 'Email verification failed!'),
(444, 'front', 'Congratulation\'s', 'congratulations', 'Congratulation\'s'),
(445, 'front', 'Your account successfully verified', 'verify-success', 'Your account successfully verified'),
(446, 'admin', 'Inserted Successfully', 'msg-inserted', 'Inserted Successfully'),
(447, 'admin\n', 'Updated Successfully', 'msg-updated', 'Updated Successfully'),
(448, 'front', 'Activate Successfully', 'msg-activated', 'Activate Successfully'),
(449, 'front', 'Deactivate Successfully', 'msg-deactivated', 'Deactivate Successfully'),
(450, 'front', 'Recaptcha is required', 'recaptcha-is-required', 'Recaptcha is required'),
(451, 'front', 'Message send Successfully', 'message-send-successfully', 'Message send Successfully'),
(452, 'front', 'Create', 'create', 'Create'),
(453, 'user', 'Approve', 'approve', 'Approve'),
(454, 'admin', 'Contacts', 'contacts', 'Contacts'),
(455, 'admin', 'Select User', 'select-user', 'Select User'),
(456, 'admin', 'Select Package', 'select-package', 'Select Package'),
(457, 'admin', 'Offline Payment', 'offline-payment', 'Offline Payment'),
(458, 'admin', 'Add Offline Payment', 'add-offline-payment', 'Add Offline Payment'),
(459, 'admin', 'Subscription Type', 'subscription-type', 'Subscription Type'),
(460, 'admin', 'Payment added successfully', 'payment-added-successfully', 'Payment added successfully'),
(461, 'admin', 'Enter your tags', 'enter-your-tags', 'Enter your tags'),
(462, 'user', 'Created on', 'created-on', 'Created on'),
(463, 'user', 'View', 'view', 'View'),
(464, 'user', 'Approved', 'approved', 'Approved'),
(465, 'front', 'Free trial of', 'free-trial-of', 'Free trial of'),
(466, 'admin', 'Edit frontend values', 'edit-frontend-values', 'Frontend values'),
(467, 'admin', 'Edit admin values', 'edit-admin-values', 'Admin values'),
(468, 'admin', 'Edit user values', 'edit-user-values', 'User values'),
(469, 'admin', 'Update language for', 'update-language-for', 'Update language for'),
(470, 'admin', 'Frontend', 'frontend', 'Frontend'),
(471, 'admin', 'Admin', 'admin', 'Admin'),
(472, 'admin', 'User', 'user', 'User'),
(473, 'admin', 'Add New Language ', 'add-new-language', 'Add New Language '),
(474, 'admin', 'Manage Language', 'manage-language', 'Manage Language'),
(475, 'admin', 'Update values', 'update-values', 'Update values'),
(476, 'admin', 'Your Password has been changed Successfully', 'password-reset-success-msg', 'Your Password has been changed Successfully'),
(477, 'admin', 'Oops', 'oops', 'Oops'),
(478, 'admin', 'Your Confirm Password doesn\'t Match', 'confirm-pass-not-match-msg', 'Your Confirm Password doesn\'t Match'),
(479, 'admin', 'Your Old Password doesn\'t Match', 'old-password-doesnt-match', 'Your Old Password doesn\'t Match'),
(480, 'admin', 'Sorry', 'sorry', 'Sorry!'),
(481, 'admin', 'Something wrong', 'something-wrong', 'Something wrong'),
(482, 'admin', 'Success', 'success', 'Success!'),
(483, 'admin', 'Setup successfully', 'setup-successfully', 'Setup successfully'),
(484, 'admin', 'Send successfully', 'send-successfully', 'Send successfully'),
(485, 'admin', 'Are you sure', 'are-you-sure', 'Are you sure?'),
(486, 'admin', 'Convert this estimate to a draft invoice?', 'convert-estimate-to-draft-invoice', 'Convert this estimate to a draft invoice?'),
(487, 'admin', 'Convert', 'convert', 'Convert'),
(488, 'admin', 'Converted successfully', 'converted-successfully', 'Converted successfully'),
(489, 'admin', 'Data limit has been over', 'data-limit-over', 'Data limit has been over'),
(490, 'admin', 'Sending failed', 'sending-failed', 'Sending failed'),
(491, 'admin', 'Approved Successfully', 'approved-successfully', 'Approved Successfully'),
(492, 'admin', 'You will not be able to recover this file', 'not-recover-file', 'You will not be able to recover this file'),
(493, 'admin', 'Deleted successfully', 'deleted-successfully', 'Deleted successfully'),
(494, 'admin', 'Approve this invoice', 'approve-this-invoice', 'Approve this invoice'),
(495, 'admin', 'Set as your primary business', 'set-as-your-primary-business', 'Set as your primary business'),
(496, 'admin', 'Want to set', 'want-to-set', 'Want to set'),
(497, 'admin', 'as your default business?', 'as-your-default-business', 'as your default business?'),
(498, 'admin', 'You have made some changes and it\'s not saved?', 'made-changes-not-saved', 'You have made some changes and it\'s not saved?'),
(499, 'admin', 'Your account has been suspended', 'account-suspend-msg', 'Your account has been suspended!'),
(500, 'front', 'This email already exist, try another one', 'email-exist', 'This email already exist, try another one'),
(501, 'front', 'Your account is not active', 'account-not-active', 'Your account is not active'),
(502, 'front', 'Sorry your username or password is not correct!', 'wrong-username-password', 'Sorry your username or password is not correct!'),
(503, 'front', 'Your email is not verified, Please verify your email', 'email-not-verified', 'Your email is not verified, Please verify your email'),
(504, 'front', 'We\'ve sent a password to your email address. Please check your inbox', 'password-sent-to-email', 'We\'ve sent a password to your email address. Please check your inbox'),
(505, 'front', 'Password Reset Successfully !', 'password-reset-successfully', 'Password Reset Successfully !'),
(506, 'front', 'You are not a valid user', 'not-a-valid-user', 'You are not a valid user'),
(507, 'admin', 'Set default language', 'set-default-language', 'Set default language'),
(508, 'admin', 'Short Form', 'short-form', 'Short Form'),
(509, 'admin', 'Text direction', 'text-direction', 'Text direction'),
(510, 'admin', 'Oops! There was an issue with your invoice. Please try again', 'invoice-error-create', 'Oops! There was an issue with your invoice. Please try again'),
(511, 'user', 'Business address and contact details, title, summary, and logo', 'invoice-title', 'Business address and contact details, title, summary, and logo'),
(512, 'user', 'Add new item', 'add-new-item', 'Add new item'),
(513, 'user', 'Summary example: project name, description of invoice', 'invoice-title-placeholder', 'Summary example: project name, description of invoice'),
(514, 'user', 'Select Customer', 'select-customer', 'Select Customer'),
(515, 'admin', 'Set Trial Days', 'set-trial-days', 'Set trial days'),
(516, 'front', 'Start', 'start', 'Start'),
(517, 'front', 'days trial', 'days-trial', 'days trial'),
(518, 'admin', 'Delete', 'delete', 'Delete'),
(519, 'admin', 'Activate', 'activate', 'Activate'),
(520, 'admin', 'Deactivate', 'deactivate', 'Deactivate'),
(521, 'admin', 'Verified', 'verified', 'Verified'),
(522, 'user', 'Estimate', 'estimate', 'Estimate'),
(523, 'front', 'Explore our features', 'explore-our-features', 'Explore our features'),
(524, 'front', 'Frequently Asked Questions', 'frequently-asked-questions', 'Frequently Asked Questions'),
(525, 'admin', 'Income', 'income', 'Income'),
(526, 'front', 'Password', 'password', 'Password'),
(527, 'front', 'Username or email', 'username-or-email', 'Username or email'),
(528, 'user', 'Currency conversion', 'currency-conversion', 'Currency conversion'),
(529, 'user', 'Add a customer to this invoice', 'add-customer-error-msg', 'Add a customer to this invoice'),
(530, 'user', 'Set default footer note for invoice', 'set-default-footer-note', 'Set default footer note for invoice'),
(531, 'admin', 'Multilingual System', 'enable-multilingual', 'Multilingual System'),
(532, 'user', 'Completed', 'completed', 'Completed'),
(533, 'user', 'Stop Recurring', 'stop-recurring', 'Stop Recurring'),
(534, 'user', 'Stop this recurring invoice', 'stop-this-recurring-invoice', 'Stop this recurring invoice'),
(535, 'user', 'Applied Successfully', 'applied-successfully', 'Applied Successfully'),
(536, 'user', 'Cancel', 'cancel', 'Cancel'),
(537, 'front', 'This website uses cookies. By using this website you consent to our use of these cookies.', 'accept-cookies', 'This website uses cookies. By using this website you consent to our use of these cookies.'),
(538, 'front', 'Accept', 'accept', 'Accept'),
(539, 'user', 'You created this invoice, but you have not approved it.', 'draft-tooltip', 'You created this invoice, but you have not approved it.'),
(540, 'user', 'Your customer has paid this invoice in full.', 'paid-tooltip', 'Your customer has paid this invoice in full.'),
(541, 'user', 'Your customer has not paid the full invoice amount on time.', 'unpaid-tooltip', 'Your customer has not paid the full invoice amount on time.'),
(542, 'user', 'This recurring invoice has been completed', 'complete-tooltip', 'This recurring invoice has been completed'),
(543, 'user', 'Your customer has paid this invoice in full.', 'active-tooltip', 'Your customer has paid this invoice in full.'),
(544, 'user', 'Your estimate is expire now', 'expire-estimate', 'Your estimate is expire now'),
(545, 'user', 'our estimate is saved', 'saved-estimate', 'our estimate is saved'),
(546, 'user', 'Reset Filter', 'reset-filter', 'Reset Filter'),
(547, 'user', 'Report Types', 'report-types', 'Report Types'),
(548, 'user', 'Tax Info', 'tax-info', 'Tax Info'),
(549, 'user', 'Including Tax', 'with-tax', 'Including Tax'),
(550, 'user', 'Excluding Tax', 'without-tax', 'Excluding Tax'),
(551, 'user', 'All', 'all', 'All'),
(552, 'user', 'Net Amount', 'net-amount', 'Net Amount'),
(553, 'user', 'Version', 'version', 'Version'),
(554, 'user', 'Your customer has paid partial payment of this invoice.', 'paid-partial', 'Your customer has paid partial payment of this invoice.'),
(555, 'user', 'Next Payment', 'next-payment', 'Next Payment'),
(556, 'user', 'Upcomming', 'upcomming', 'Upcomming'),
(557, 'user', 'Upcomming Recurring Payments', 'upcomming-recurring-payments', 'Upcomming Recurring Payments'),
(558, 'admin', 'Coupons', 'coupons', 'Coupons'),
(559, 'admin', 'Coupon', 'coupon', 'Coupon'),
(560, 'admin', 'Edit Coupon', 'edit-coupon', 'Edit Coupon'),
(561, 'admin', 'Add New Coupon', 'add-new-coupon', 'Add New Coupon'),
(562, 'admin', 'Usages limit', 'usages-limit', 'Usages limit'),
(563, 'admin', 'Usages Count', 'usages-count', 'Usages Count'),
(564, 'admin', 'Auto generate coupon code', 'auto-generate-code', 'Auto generate coupon code'),
(565, 'admin', 'Ccoupon Code', 'coupon-code', 'Ccoupon Code'),
(566, 'admin', 'Expire Date', 'expire-date', 'Expire Date'),
(567, 'admin', 'Billing Type', 'bill-type', 'Billing Type'),
(568, 'front', 'Off', 'off', 'Off'),
(569, 'front', 'Terms of service', 'terms-of-service', 'Terms of service'),
(570, 'front', 'I agree with', 'agree-with', 'I agree with'),
(571, 'front', 'Save up to', 'save-upto', 'Save up to'),
(572, 'admin', 'Enable Payment', 'enable-payment', 'Enable Payment'),
(573, 'admin', 'Stripe Payment', 'stripe-payment', 'Stripe Payment'),
(574, 'admin', 'Publish Key', 'publish-key', 'Publish Key'),
(575, 'admin', 'Secret Key', 'secret-key', 'Secret Key'),
(576, 'user', 'Name on Card', 'name-on-card', 'Name on Card'),
(577, 'user', 'Card Number', 'card-number', 'Card Number'),
(578, 'user', 'Expiration', 'expiration', 'Expiration'),
(579, 'user', 'Payment', 'payment', 'Payment'),
(580, 'user', 'If you leave this field, your invoice end date will be set unlimited', 'recurring-end-info', 'If you leave this field, your invoice end date will be set unlimited'),
(581, 'user', 'Add new GST', 'add-new-gst', 'Add new GST'),
(582, 'user', 'Edit GST', 'edit-gst', 'Edit GST'),
(583, 'admin', 'Order', 'order', 'Order'),
(584, 'user', 'Convert to Recurring Invoice', 'convert-recurring', 'Convert to Recurring'),
(585, 'user', 'Start date must be lower then the current date', 'recurring-date-msg', 'Start date must be lower then the current date'),
(586, 'user', 'Convert this to a recurring invoice', 'convert-recurring-msg', 'Convert this to a recurring invoice'),
(587, 'user', 'Pay Online', 'pay-online', 'Pay Online'),
(588, 'user', 'Receive payment currency', 'payment-currency', 'Receive payment currency'),
(589, 'user', 'Get shareable link', 'share-link', 'Get shareable link'),
(590, 'user', 'Rejected', 'rejected', 'Rejected'),
(591, 'user', 'Reject Reason', 'reject-reason', 'Reject Reason'),
(592, 'user', 'Describe reject reason', 'describe-reject-reason', 'Describe reject reason'),
(593, 'user', 'Product Stock Quantity', 'stock-quantity', 'Product Stock Quantity'),
(594, 'user', 'Enable product stock', 'enable-stock', 'Enable product stock'),
(595, 'user', 'Enable this feature you will be able to manage your products stock in invoices. ', 'enable-sotck-help', 'Enable this feature you will be able to manage your products stock in invoices. '),
(596, 'user', 'Accent color', 'accent-color', 'Accent color'),
(597, 'admin', 'Send Test Mail', 'test-mail', 'Send Test Mail'),
(598, 'admin', 'Mail Encryption', 'mail-encryption', 'Mail Encryption'),
(599, 'admin', 'If you are using gmail smtp please make sure you have set below settings before sending mail', 'mail-help-info', 'If you are using gmail smtp please make sure you have set below settings before sending mail'),
(600, 'admin', '\'SSL\' is used for port 465/25, \'TLS\' is used for port 587', 'mail-help-info-2', '\'SSL\' is used for port 465/25, \'TLS\' is used for port 587'),
(601, 'admin', 'Set 0 days to hide trial option in website', 'trial-disable', 'Set 0 days to hide trial option in website'),
(602, 'user', 'Bills', 'bills', 'Bills'),
(603, 'user', 'Create New Bill', 'create-new-bill', 'Create New Bill'),
(604, 'user', 'Edit Bill', 'edit-bill', 'Edit Bill'),
(605, 'user', 'Save Bill', 'save-bill', 'Save Bill'),
(606, 'user', 'Bill', 'bill', 'Bill'),
(607, 'user', 'Record a payment for this bill', 'record-payment-bill', 'Record a payment for this bill'),
(608, 'user', 'Sales', 'sales', 'Sales'),
(609, 'user', 'Purchases', 'purchases', 'Purchases'),
(610, 'user', 'Partial', 'partial', 'Partial'),
(611, 'user', 'Income by Customer', 'income-by-customer', 'Income by Customer'),
(612, 'user', 'Purchases by Vendor', 'purchases-by-Vendor', 'Purchases by Vendor'),
(613, 'user', 'Purchase', 'purchase', 'Purchase'),
(614, 'user', 'Profit & Loss', 'profit-loss', 'Profit & Loss'),
(615, 'user', 'Paid & Unpaid', 'paid-unpaid', 'Paid & Unpaid'),
(616, 'user', 'Including paid & unpaid invoices and bills', 'paid-unpaid-inv-bill', 'Including paid & unpaid invoices and bills'),
(617, 'user', 'Including only paid invoices and bills', 'paid-inv-bill', 'Including only paid invoices and bills'),
(618, 'user', 'Net Profit', 'net-profit', 'Net Profit'),
(619, 'user', 'Sales Tax Report', 'sales-tax-report', 'Sales Tax Report'),
(620, 'user', 'Sales Product to tax', 'sales-product-tax', 'Sales Product to tax'),
(621, 'user', 'Tax Amount on Sales', 'tax-amount-sale', 'Tax Amount on Sales'),
(622, 'user', 'Purchases Subject to Tax', 'purchase-subject', 'Purchases Subject to Tax'),
(623, 'user', 'Tax Amount on Purchases', 'tax-amount-purchase', 'Tax Amount on Purchases'),
(624, 'user', 'Net Tax Owing', 'tax-owing', 'Net Tax Owing'),
(625, 'front', 'Signing in ...', 'signing-in', 'Signing in ...'),
(626, 'user', 'Select Vendor', 'select-Vendor', 'Select Vendor'),
(627, 'user', 'General', 'general', 'General'),
(628, 'user', 'Purchase from', 'purchase-from', 'Purchase from'),
(629, 'user', 'Bill Number', 'bill-number', 'Bill Number'),
(630, 'front', 'Frontend Website', 'enable-frontend', 'Frontend Website'),
(631, 'admin', 'Search by name or email', 'search-by-name-email', 'Search by name or email'),
(632, 'admin', 'All Packages', 'all-package', 'All Packages'),
(633, 'admin', 'Website Settings', 'website-settings', 'Website Settings'),
(634, 'user', 'Your customer has paid some partial payment for this invoice.', 'partial-payment', 'Your customer has paid some partial payment for this invoice.'),
(635, 'admin', 'Set -2 for Unlimited, -1 for Yes & 0 for No', 'limit-suggestions', 'Set -2 for Unlimited, -1 for Yes & 0 for No'),
(636, 'admin', 'Enable access to show your frontend website.', 'enable-frontend-info', 'Enable access to show your frontend website.'),
(637, 'admin', 'Enable access to active multilingual system.', 'enable-multilingual-info', 'Enable access to active multilingual system.'),
(638, 'admin', 'Enable to active reCaptcha for all public forms (Sign up, contacts).', 'enable-captcha-info', 'Enable to active reCaptcha for all public forms (Sign up, contacts).'),
(639, 'admin', 'Enable to allow sign up users to your site.', 'registration-system-info', 'Enable to allow sign up users to your site.'),
(640, 'admin', 'Enable to allow email verification for registered users.', 'email-verification-info', 'Enable to allow email verification for registered users.'),
(641, 'admin', 'Enable Payment = Your users need to complete their payment for access all features <br> Disable Payment = Your users will access all features without completing payments.', 'enable-payment-info', 'Enable Payment = Your users need to complete their payment for access all features <br> Disable Payment = Your users will access all features without completing payments.'),
(642, 'admin', 'Enable to allow delete invoice in user business.', 'delete-invoice-info', 'Enable to allow delete invoice in user business.'),
(643, 'admin', 'Enable to active discount system', 'discount-info', 'Enable to active discount system'),
(644, 'admin', 'Enable to show blogs option in frontend', 'blogs-info', 'Enable to show blogs option in frontend'),
(645, 'admin', 'Enable to show FAQs option in frontend', 'faqs-info', 'Enable to show FAQs option in frontend'),
(646, 'user', 'Enter item description', 'item-description', 'Enter item description'),
(647, 'user', 'Send Bills', 'send-bills', 'Send Bills'),
(648, 'user', 'Invoice title', 'invoice-titles', 'Invoice title'),
(649, 'user', 'Estimate title', 'estimate-title', 'Estimate title'),
(650, 'user', 'Bill title', 'bill-title', 'Bill title'),
(651, 'user', 'View Invoices', 'view-invoice', 'View Invoices'),
(652, 'user', 'Payment on', 'payment-on', 'Payment on'),
(653, 'user', 'Using', 'using', 'Using'),
(654, 'user', 'Pending Invoices', 'pending-invoices', 'Pending Invoices'),
(655, 'user', 'Set Default', 'set-default', 'Set Default'),
(656, 'user', 'Set as a default business', 'default-business', 'Set as a default business'),
(657, 'user', 'Convert to credit note', 'convert-credit', 'Convert to credit note'),
(658, 'user', 'Convert to invoice', 'convert-invoice', 'Convert to invoice'),
(659, 'user', 'Revert to Invoice', 'revert-invoice', 'Revert to Invoice'),
(660, 'user', 'Credit Notes', 'credit-notes', 'Credit Notes'),
(661, 'user', 'Credit Note', 'credit-note', 'Credit Note'),
(662, 'admin', 'Appearance', 'appearance', 'Appearance'),
(663, 'admin', 'Set Theme', 'set-theme', 'Set Theme'),
(664, 'user', 'Position at the business', 'position-at-the-business', 'Position at the business'),
(665, 'user', 'User Role', 'user-role', 'User Role'),
(666, 'user', 'Role', 'role', 'Role'),
(667, 'user', 'Editor', 'editor', 'Editor'),
(668, 'user', 'Viewer/Assesor', 'viewerassesor', 'Viewer/Assesor'),
(669, 'user', 'Viewer', 'viewer', 'Viewer'),
(670, 'user', 'Admin Permissions', 'admin-permissions', 'Admin Permissions'),
(671, 'user', 'Best for a business partner, family member, or trusted accountant manager', 'admin-permissions-info', 'Best for a business partner, family member, or trusted accountant manager'),
(672, 'user', 'View Only', 'view-only', 'View Only'),
(673, 'user', 'Full access', 'full-access', 'Full access'),
(674, 'user', 'No Access', 'no-access', 'No Access'),
(675, 'user', 'Editor Permissions', 'editor-permissions', 'Editor Permissions'),
(676, 'user', 'Best for a bookkeeper or accountant manager', 'editor-permissions-info', 'Best for a bookkeeper or accountant manager'),
(677, 'user', 'Viewer Permissions', 'viewer-permissions', 'Viewer Permissions'),
(678, 'user', 'Best for anyone who needs view-only access', 'viewer-permissions-info', 'Best for anyone who needs view-only access'),
(679, 'user', 'Permissions', 'permissions', 'Permissions'),
(680, 'user', 'Owner', 'owner', 'Owner'),
(681, 'user', 'Joined', 'joined', 'Joined'),
(682, 'user', 'Assign Role Permissions', 'assign-role-permissions', 'Assign Role Permissions'),
(683, 'user', 'Role Management', 'role-management', 'Role Management');
INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES
(684, 'user', 'Oops! Invalid invitation', 'oops-invalid-invitation', 'Oops! Invalid invitation'),
(685, 'user', 'This invitation to collaborate in ', 'this-invitation-to-collaborate-in', 'This invitation to collaborate in '),
(686, 'user', 'is expired or has been already used.', 'is-expired-or-has-been-already-used', 'is expired or has been already used.'),
(687, 'user', 'Accept Invitation', 'accept-invitation', 'Accept Invitation'),
(688, 'user', 'Setup your password to collaborate in', 'setup-your-password-to-collaborate', 'Setup your password to collaborate in'),
(689, 'user', 'Add new user', 'add-new-user', 'Add new user'),
(690, 'admin', 'Create New', 'create-new', 'Create New'),
(691, 'admin', 'Countries', 'countries', 'Countries'),
(692, 'admin', 'Country', 'country', 'Country'),
(693, 'admni', 'Country Code', 'country-code', 'Country Code'),
(694, 'admin', 'Currency Name', 'currency-name', 'Currency Name'),
(695, 'admin', 'Currency Code', 'currency-code', 'Currency Code'),
(696, 'admin', 'Currency Symbol', 'currency-symbol', 'Currency Symbol'),
(698, 'admin', 'Delete Confirmation', 'delete-confirmation', 'Delete Confirmation'),
(699, 'admin', 'Are you sure want to delete this business', 'sure-delete-business', 'Are you sure want to delete this business'),
(700, 'admin', 'permanently', 'permanently', 'permanently'),
(701, 'admin', 'This may affect your reports, customers, invoices, estimates, bills', 'affect-business', 'This may affect your reports, customers, invoices, estimates, bills'),
(702, 'admin', 'Role Permissions', 'role-permissions', 'Role Permissions'),
(703, 'front', 'Not Viewed Yet', 'not-viewed', 'Not Viewed Yet'),
(704, 'admin', ' Add Product for both type (Sales & Purchases)', 'product-both', ' Add Product for both type (Sales & Purchases)'),
(705, 'user', 'Payment Records', 'payment-records', 'Payment Records'),
(706, 'user', 'Edit Payment', 'edit-payment', 'Edit Payment'),
(707, 'admin', 'Manage Users', 'manage-users', 'Manage Users'),
(708, 'front', 'Invoice templates', 'invoice_template', 'Invoice templates'),
(709, 'front', 'Get Invoice Payment via Paypal/stripe', 'invoice-payments', 'Get Invoice Payment via Paypal/stripe'),
(710, 'front', 'Multi User Roles', 'user-roles', 'Multi User Roles'),
(711, 'admin', 'Key Id', 'key-id', 'Key Id'),
(712, 'admin', 'Key Secret', 'key-secret', 'Key Secret'),
(713, 'admin', 'Addons', 'addons', 'Addons'),
(714, 'admin', 'Addon', 'addon', 'Addon');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `monthly_price` decimal(10,2) DEFAULT NULL,
  `bill_type` varchar(255) DEFAULT NULL,
  `dis_month` int(11) NOT NULL DEFAULT 0,
  `dis_year` int(11) NOT NULL DEFAULT 0,
  `is_special` int(11) NOT NULL DEFAULT 0,
  `is_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `name`, `slug`, `price`, `monthly_price`, `bill_type`, `dis_month`, `dis_year`, `is_special`, `is_active`) VALUES
(1, 'Basic', 'basic', '20.00', '0.00', 'year', 10, 0, 0, 1),
(2, 'Standard', 'standared', '35.00', '15.00', 'year', 20, 0, 1, 1),
(3, 'Premium', 'premium', '1000.00', '30.00', 'year', 50, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_features`
--

CREATE TABLE `package_features` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `basic` varchar(255) DEFAULT NULL,
  `standared` varchar(255) DEFAULT NULL,
  `premium` varchar(255) DEFAULT NULL,
  `year_basic` int(11) DEFAULT NULL,
  `year_standared` int(11) DEFAULT NULL,
  `year_premium` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package_features`
--

INSERT INTO `package_features` (`id`, `name`, `slug`, `basic`, `standared`, `premium`, `year_basic`, `year_standared`, `year_premium`, `type`, `text`) VALUES
(1, 'Invoices', 'invoice', '-2', '-2', '-2', -2, -2, -2, '', NULL),
(2, 'Estimates', 'estimate', '2', '40', '100', 100, 200, 2, '', NULL),
(3, 'Customers', 'customer', '2', '20', '50', 20, 70, 2, '', NULL),
(4, 'Business', 'business', '1', '5', '10', 10, 25, 50, '', ''),
(5, 'Invoice templates', 'invoice_template', '-2', '6', '6', 6, 6, 6, '', 'Set value 1-6'),
(6, 'Get Invoice Payment via Paypal/stripe', 'invoice-payments', '-1', '-1', '-1', 0, -1, -1, '', 'Set -1 for Yes & 0 for No'),
(7, 'Multi User Roles', 'user-roles', '4', '4', '12', 10, 20, 30, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `puid` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package` varchar(255) DEFAULT NULL,
  `billing_type` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `expire_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_advance`
--

CREATE TABLE `payment_advance` (
  `id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_records`
--

CREATE TABLE `payment_records` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `business_id` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `convert_amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date NOT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `note` mediumtext DEFAULT NULL,
  `type` varchar(255) DEFAULT 'income',
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `details` text DEFAULT NULL,
  `is_sell` int(11) DEFAULT NULL,
  `is_buy` int(11) DEFAULT NULL,
  `income_category` int(11) DEFAULT NULL,
  `expense_category` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_services`
--

CREATE TABLE `product_services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_tax`
--

CREATE TABLE `product_tax` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `code`, `rate`, `date`) VALUES
(1, 'AED', '3.6732', '2020-06-14'),
(2, 'AFN', '77.59138', '2020-06-14'),
(3, 'ALL', '110.8155', '2020-06-14'),
(4, 'AMD', '481.814', '2020-06-14'),
(5, 'AOA', '600.099', '2020-06-14'),
(6, 'ARS', '69.38714', '2020-06-14'),
(7, 'AUD', '1.45934', '2020-06-14'),
(8, 'AWG', '1.8', '2020-06-14'),
(9, 'AZN', '1.7', '2020-06-14'),
(10, 'BBD', '2.01949', '2020-06-14'),
(11, 'BDT', '84.95716', '2020-06-14'),
(12, 'BGN', '1.73798', '2020-06-14'),
(13, 'BHD', '0.37708', '2020-06-14'),
(14, 'BIF', '1910.1', '2020-06-14'),
(15, 'BMD', '1', '2020-06-14'),
(16, 'BND', '1.39063', '2020-06-14'),
(17, 'BRL', '5.04955', '2020-06-14'),
(18, 'BTN', '', '2020-06-14'),
(19, 'BWP', '11.6776', '2020-06-14'),
(20, 'BYR', '', '2020-06-14'),
(21, 'BZD', '2.01612', '2020-06-14'),
(22, 'CAD', '1.3587', '2020-06-14'),
(23, 'CHF', '0.95193', '2020-06-14'),
(24, 'CLP', '791.83', '2020-06-14'),
(25, 'CNY', '7.0733', '2020-06-14'),
(26, 'COP', '3776.69', '2020-06-14'),
(27, 'CRC', '579.11026', '2020-06-14'),
(28, 'CUC', '1', '2020-06-14'),
(29, 'CVE', '98.405', '2020-06-14'),
(30, 'CZK', '23.75794', '2020-06-14'),
(31, 'DJF', '177.729', '2020-06-14'),
(32, 'DKK', '6.6203', '2020-06-14'),
(33, 'DOP', '58.405', '2020-06-14'),
(34, 'DZD', '128.51363', '2020-06-14'),
(35, 'EGP', '16.18149', '2020-06-14'),
(36, 'ERN', '', '2020-06-14'),
(37, 'ETB', '34.4', '2020-06-14'),
(38, 'EUR', '0.88851', '2020-06-14'),
(39, 'FJD', '2.1951', '2020-06-14'),
(40, 'GBP', '0.7972', '2020-06-14'),
(41, 'GEL', '3.05', '2020-06-14'),
(42, 'GHS', '5.7805', '2020-06-14'),
(43, 'GIP', '0.7972', '2020-06-14'),
(44, 'GNF', '9460.45', '2020-06-14'),
(45, 'GTQ', '7.69408', '2020-06-14'),
(46, 'GYD', '209.43027', '2020-06-14'),
(47, 'HKD', '7.7498', '2020-06-14'),
(48, 'HNL', '24.941', '2020-06-14'),
(49, 'HRK', '6.72254', '2020-06-14'),
(50, 'HTG', '107.76859', '2020-06-14'),
(51, 'HUF', '307.54', '2020-06-14'),
(52, 'IDR', '14217.361', '2020-06-14'),
(53, 'ILS', '3.4619', '2020-06-14'),
(54, 'INR', '75.9608', '2020-06-14'),
(55, 'IQD', '1190.05', '2020-06-14'),
(56, 'ISK', '135.127', '2020-06-14'),
(57, 'JMD', '140.52593', '2020-06-14'),
(58, 'JOD', '0.70905', '2020-06-14'),
(59, 'JPY', '107.349', '2020-06-14'),
(60, 'KES', '106.46093', '2020-06-14'),
(61, 'KGS', '74.78584', '2020-06-14'),
(62, 'KHR', '4091.2', '2020-06-14'),
(63, 'KMF', '437.872', '2020-06-14'),
(64, 'KWD', '0.30797', '2020-06-14'),
(65, 'KYD', '0.83348', '2020-06-14'),
(66, 'KZT', '404.31862', '2020-06-14'),
(67, 'LAK', '9010.45', '2020-06-14'),
(68, 'LBP', '1511.43755', '2020-06-14'),
(69, 'LKR', '185.37567', '2020-06-14'),
(70, 'LRD', '199.26', '2020-06-14'),
(71, 'LSL', '17.1', '2020-06-14'),
(72, 'MAD', '9.6755', '2020-06-14'),
(73, 'MDL', '17.17804', '2020-06-14'),
(74, 'MGA', '', '2020-06-14'),
(75, 'MMK', '1400.194', '2020-06-14'),
(76, 'MNT', '', '2020-06-14'),
(77, 'MRO', '', '2020-06-14'),
(78, 'MUR', '39.70737', '2020-06-14'),
(79, 'MVR', '15.5', '2020-06-14'),
(80, 'MWK', '740.05', '2020-06-14'),
(81, 'MXN', '22.2003', '2020-06-14'),
(82, 'MYR', '4.27072', '2020-06-14'),
(83, 'MZN', '69.6835', '2020-06-14'),
(84, 'NAD', '17.121', '2020-06-14'),
(85, 'NGN', '387.52', '2020-06-14'),
(86, 'NIO', '34.3', '2020-06-14'),
(87, 'NOK', '9.6223', '2020-06-14'),
(88, 'NPR', '121.40247', '2020-06-14'),
(89, 'NZD', '1.55107', '2020-06-14'),
(90, 'OMR', '0.38503', '2020-06-14'),
(91, 'PAB', '1.00019', '2020-06-14'),
(92, 'PEN', '3.46515', '2020-06-14'),
(93, 'PGK', '3.45', '2020-06-14'),
(94, 'PHP', '50.2806', '2020-06-14'),
(95, 'PKR', '164.51', '2020-06-14'),
(96, 'PLN', '3.9426', '2020-06-14'),
(97, 'PYG', '6691.42155', '2020-06-14'),
(98, 'QAR', '3.64143', '2020-06-14'),
(99, 'RON', '4.29532', '2020-06-14'),
(100, 'RSD', '104.4402', '2020-06-14'),
(101, 'RUB', '69.8931', '2020-06-14'),
(102, 'RWF', '950.05', '2020-06-14'),
(103, 'SAR', '3.75399', '2020-06-14'),
(104, 'SBD', '8.32912', '2020-06-14'),
(105, 'SCR', '17.59155', '2020-06-14'),
(106, 'SDG', '55.305', '2020-06-14'),
(107, 'SEK', '9.3155', '2020-06-14'),
(108, 'SLL', '9755.5', '2020-06-14'),
(109, 'SOS', '583.05', '2020-06-14'),
(110, 'SRD', '7.45835', '2020-06-14'),
(111, 'SZL', '17.121', '2020-06-14'),
(112, 'THB', '30.9815', '2020-06-14'),
(113, 'TJS', '10.28185', '2020-06-14'),
(114, 'TMT', '3.5', '2020-06-14'),
(115, 'TND', '2.85065', '2020-06-14'),
(116, 'TOP', '2.2711', '2020-06-14'),
(117, 'TRY', '6.8106', '2020-06-14'),
(118, 'TTD', '6.75027', '2020-06-14'),
(119, 'TWD', '29.64478', '2020-06-14'),
(120, 'UAH', '26.73694', '2020-06-14'),
(121, 'UGX', '3720.74805', '2020-06-14'),
(122, 'USD', '1', '2020-06-14'),
(123, 'UYU', '42.84096', '2020-06-14'),
(124, 'UZS', '10160.5', '2020-06-14'),
(125, 'VND', '23266.665', '2020-06-14'),
(126, 'VUV', '', '2020-06-14'),
(127, 'WST', '', '2020-06-14'),
(128, 'XAF', '580.42432', '2020-06-14'),
(129, 'XCD', '2.70269', '2020-06-14'),
(130, 'XOF', '580.53', '2020-06-14'),
(131, 'XPF', '', '2020-06-14'),
(132, 'YER', '250.3625', '2020-06-14'),
(133, 'ZAR', '17.0361', '2020-06-14'),
(134, 'ZMW', '18.33854', '2020-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `hero_img` varchar(255) DEFAULT 'assets/front/img/hside.jpg',
  `keywords` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `terms_service` longtext DEFAULT NULL,
  `footer_about` text DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `pagination_limit` int(11) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `google_analytics` longtext DEFAULT NULL,
  `site_color` varchar(255) DEFAULT NULL,
  `site_font` varchar(255) DEFAULT NULL,
  `layout` int(11) DEFAULT NULL,
  `site_info` int(11) NOT NULL DEFAULT 1,
  `about_info` mediumtext DEFAULT NULL,
  `ind_code` varchar(255) DEFAULT NULL,
  `purchase_code` varchar(255) DEFAULT NULL,
  `enable_captcha` int(11) DEFAULT 0,
  `enable_registration` int(11) DEFAULT 1,
  `enable_email_verify` int(11) DEFAULT 0,
  `enable_paypal` int(11) NOT NULL DEFAULT 0,
  `enable_delete_invoice` int(11) NOT NULL DEFAULT 1,
  `enable_multilingual` int(11) NOT NULL DEFAULT 1,
  `enable_discount` int(11) DEFAULT 0,
  `enable_blog` int(11) NOT NULL DEFAULT 0,
  `enable_faq` int(11) NOT NULL DEFAULT 0,
  `enable_frontend` int(11) DEFAULT 1,
  `captcha_site_key` varchar(255) DEFAULT NULL,
  `captcha_secret_key` varchar(255) DEFAULT NULL,
  `paypal_email` varchar(255) DEFAULT NULL,
  `paypal_mode` varchar(255) DEFAULT 'sandbox',
  `paypal_payment` int(11) NOT NULL DEFAULT 0,
  `stripe_payment` int(11) NOT NULL DEFAULT 0,
  `publish_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `razorpay_payment` int(11) DEFAULT 0,
  `razorpay_key_id` varchar(255) DEFAULT NULL,
  `razorpay_key_secret` varchar(255) DEFAULT NULL,
  `mail_protocol` varchar(255) DEFAULT NULL,
  `mail_title` varchar(255) DEFAULT NULL,
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT NULL,
  `mail_encryption` varchar(255) DEFAULT 'ssl',
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'USD',
  `country` int(11) DEFAULT 178,
  `trial_days` varchar(255) DEFAULT '15',
  `lang` int(11) DEFAULT 1,
  `theme` int(11) NOT NULL DEFAULT 1,
  `time_zone` int(11) DEFAULT 51,
  `rpa_enable` varchar(155) DEFAULT NULL,
  `version` varchar(255) NOT NULL DEFAULT 'v1.0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_title`, `favicon`, `logo`, `hero_img`, `keywords`, `description`, `terms_service`, `footer_about`, `admin_email`, `mobile`, `copyright`, `pagination_limit`, `facebook`, `instagram`, `twitter`, `linkedin`, `google_analytics`, `site_color`, `site_font`, `layout`, `site_info`, `about_info`, `ind_code`, `purchase_code`, `enable_captcha`, `enable_registration`, `enable_email_verify`, `enable_paypal`, `enable_delete_invoice`, `enable_multilingual`, `enable_discount`, `enable_blog`, `enable_faq`, `enable_frontend`, `captcha_site_key`, `captcha_secret_key`, `paypal_email`, `paypal_mode`, `paypal_payment`, `stripe_payment`, `publish_key`, `secret_key`, `razorpay_payment`, `razorpay_key_id`, `razorpay_key_secret`, `mail_protocol`, `mail_title`, `mail_host`, `mail_port`, `mail_encryption`, `mail_username`, `mail_password`, `currency`, `country`, `trial_days`, `lang`, `theme`, `time_zone`, `rpa_enable`, `version`) VALUES
(1, 'Accufy', 'SaaS Business & Accounting Software', 'uploads/thumbnail/clou_logo_medium-137x99_thumb-100x72.png', 'uploads/medium/bac_medium-300x100.png', 'uploads/big/hero-img_big-500x500.png', 'saas,finincial software,accounting software,facturation', 'Simplifies invoices and expense tracking, helping you save time and money. Create your first invoice in less than 60 seconds.', '<h2><strong>Terms of service and the law</strong></h2>\r\n\r\n<p>A business organization needs a terms of service agreement on its site while making sure it is also included within customer contracts. It\'s important to make this link and show it to customers so that they understand everything clearly.</p>\r\n\r\n<p>It is also very important to include an additional step where customers can confirm that they\'ve read and that they agree with your terms of service.</p>\r\n\r\n<p>Additionally, for all organizations that offer services or products online, no matter where they are located, it\'s important that their terms of service are compliant with E-commerce Regulations and Consumer Information Regulations.</p>\r\n\r\n<p>On top of that, you should make sure to check the Sale of Goods and Supply of Services Act of 1980 to avoid any legal difficulties and ensure the safety of your business.</p>\r\n\r\n<p>When it comes to Australia, for example, websites are not allowed to misrepresent themselves. The information located on a site should not be deceptive or misleading in any way when talking about services or products. This is how a website can comply with consumer law in Australia.</p>\r\n\r\n<p>There have been a few cases where the law sided with the customers because the terms of service page was simply too large and the court decided that it was very unlikely that anyone would have the time or patience to read the whole thing.</p>\r\n\r\n<p>A different case where terms of service were questioned is where a major retailer didn\'t put them in a visible spot. This is also very important to keep in mind when placing a terms of service section.</p>\r\n', 'Simplifies invoices and expense tracking, helping you save time and money. Create your first invoice in less than 60 seconds.', 'admin@gmail.com', '', '© 2019 All rights reserved.', 0, 'facebook.com', 'facebook.com', '', 'linkedin', '', '', '', 0, 1, 'SW52YWxpZCBMaWNlbnNlIEtleQ==', '6943ffb83a7c95499a40f8b38c1ebbb4a5486475', '44f1ea46-e8e4-44fc-ba2f-8e89c5c0545c', 0, 1, 0, 1, 1, 0, 0, 1, 1, 1, '6Ld0SpcUAAAAAFpKkQaTwbENLukNG_hMpPpykHt9', '', '', 'sandbox', 1, 1, '', '', 0, '', '', 'smtp', '', 'smtp.gmail.com', '465', 'ssl', '', '', 'USD', 178, '14', 1, 2, 49, '0', '2.1');

-- --------------------------------------------------------

--
-- Table structure for table `site_contacts`
--

CREATE TABLE `site_contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `tag_slug` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `rate` decimal(10,1) DEFAULT 0.0,
  `number` varchar(255) DEFAULT NULL,
  `details` mediumtext DEFAULT NULL,
  `is_invoices` int(11) DEFAULT NULL,
  `is_recoverable` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tax_type`
--

CREATE TABLE `tax_type` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `time_zone`
--

CREATE TABLE `time_zone` (
  `id` int(10) NOT NULL,
  `name` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `time_zone`
--

INSERT INTO `time_zone` (`id`, `name`) VALUES
(1, 'Europe/Andorra'),
(2, 'Asia/Dubai'),
(3, 'Asia/Kabul'),
(4, 'America/Antigua'),
(5, 'America/Anguilla'),
(6, 'Europe/Tirane'),
(7, 'Asia/Yerevan'),
(8, 'Africa/Luanda'),
(9, 'Antarctica/McMurdo'),
(10, 'Antarctica/Casey'),
(11, 'Antarctica/Davis'),
(12, 'Antarctica/DumontDUrville'),
(13, 'Antarctica/Mawson'),
(14, 'Antarctica/Palmer'),
(15, 'Antarctica/Rothera'),
(16, 'Antarctica/Syowa'),
(17, 'Antarctica/Troll'),
(18, 'Antarctica/Vostok'),
(19, 'America/Argentina/Buenos_Aires'),
(20, 'America/Argentina/Cordoba'),
(21, 'America/Argentina/Salta'),
(22, 'America/Argentina/Jujuy'),
(23, 'America/Argentina/Tucuman'),
(24, 'America/Argentina/Catamarca'),
(25, 'America/Argentina/La_Rioja'),
(26, 'America/Argentina/San_Juan'),
(27, 'America/Argentina/Mendoza'),
(28, 'America/Argentina/San_Luis'),
(29, 'America/Argentina/Rio_Gallegos'),
(30, 'America/Argentina/Ushuaia'),
(31, 'Pacific/Pago_Pago'),
(32, 'Europe/Vienna'),
(33, 'Australia/Lord_Howe'),
(34, 'Antarctica/Macquarie'),
(35, 'Australia/Hobart'),
(36, 'Australia/Currie'),
(37, 'Australia/Melbourne'),
(38, 'Australia/Sydney'),
(39, 'Australia/Broken_Hill'),
(40, 'Australia/Brisbane'),
(41, 'Australia/Lindeman'),
(42, 'Australia/Adelaide'),
(43, 'Australia/Darwin'),
(44, 'Australia/Perth'),
(45, 'Australia/Eucla'),
(46, 'America/Aruba'),
(47, 'Europe/Mariehamn'),
(48, 'Asia/Baku'),
(49, 'Europe/Sarajevo'),
(50, 'America/Barbados'),
(51, 'Asia/Dhaka'),
(52, 'Europe/Brussels'),
(53, 'Africa/Ouagadougou'),
(54, 'Europe/Sofia'),
(55, 'Asia/Bahrain'),
(56, 'Africa/Bujumbura'),
(57, 'Africa/Porto-Novo'),
(58, 'America/St_Barthelemy'),
(59, 'Atlantic/Bermuda'),
(60, 'Asia/Brunei'),
(61, 'America/La_Paz'),
(62, 'America/Kralendijk'),
(63, 'America/Noronha'),
(64, 'America/Belem'),
(65, 'America/Fortaleza'),
(66, 'America/Recife'),
(67, 'America/Araguaina'),
(68, 'America/Maceio'),
(69, 'America/Bahia'),
(70, 'America/Sao_Paulo'),
(71, 'America/Campo_Grande'),
(72, 'America/Cuiaba'),
(73, 'America/Santarem'),
(74, 'America/Porto_Velho'),
(75, 'America/Boa_Vista'),
(76, 'America/Manaus'),
(77, 'America/Eirunepe'),
(78, 'America/Rio_Branco'),
(79, 'America/Nassau'),
(80, 'Asia/Thimphu'),
(81, 'Africa/Gaborone'),
(82, 'Europe/Minsk'),
(83, 'America/Belize'),
(84, 'America/St_Johns'),
(85, 'America/Halifax'),
(86, 'America/Glace_Bay'),
(87, 'America/Moncton'),
(88, 'America/Goose_Bay'),
(89, 'America/Blanc-Sablon'),
(90, 'America/Toronto'),
(91, 'America/Nipigon'),
(92, 'America/Thunder_Bay'),
(93, 'America/Iqaluit'),
(94, 'America/Pangnirtung'),
(95, 'America/Atikokan'),
(96, 'America/Winnipeg'),
(97, 'America/Rainy_River'),
(98, 'America/Resolute'),
(99, 'America/Rankin_Inlet'),
(100, 'America/Regina'),
(101, 'America/Swift_Current'),
(102, 'America/Edmonton'),
(103, 'America/Cambridge_Bay'),
(104, 'America/Yellowknife'),
(105, 'America/Inuvik'),
(106, 'America/Creston'),
(107, 'America/Dawson_Creek'),
(108, 'America/Fort_Nelson'),
(109, 'America/Vancouver'),
(110, 'America/Whitehorse'),
(111, 'America/Dawson'),
(112, 'Indian/Cocos'),
(113, 'Africa/Kinshasa'),
(114, 'Africa/Lubumbashi'),
(115, 'Africa/Bangui'),
(116, 'Africa/Brazzaville'),
(117, 'Europe/Zurich'),
(118, 'Africa/Abidjan'),
(119, 'Pacific/Rarotonga'),
(120, 'America/Santiago'),
(121, 'America/Punta_Arenas'),
(122, 'Pacific/Easter'),
(123, 'Africa/Douala'),
(124, 'Asia/Shanghai'),
(125, 'Asia/Urumqi'),
(126, 'America/Bogota'),
(127, 'America/Costa_Rica'),
(128, 'America/Havana'),
(129, 'Atlantic/Cape_Verde'),
(130, 'America/Curacao'),
(131, 'Indian/Christmas'),
(132, 'Asia/Nicosia'),
(133, 'Asia/Famagusta'),
(134, 'Europe/Prague'),
(135, 'Europe/Berlin'),
(136, 'Europe/Busingen'),
(137, 'Africa/Djibouti'),
(138, 'Europe/Copenhagen'),
(139, 'America/Dominica'),
(140, 'America/Santo_Domingo'),
(141, 'Africa/Algiers'),
(142, 'America/Guayaquil'),
(143, 'Pacific/Galapagos'),
(144, 'Europe/Tallinn'),
(145, 'Africa/Cairo'),
(146, 'Africa/El_Aaiun'),
(147, 'Africa/Asmara'),
(148, 'Europe/Madrid'),
(149, 'Africa/Ceuta'),
(150, 'Atlantic/Canary'),
(151, 'Africa/Addis_Ababa'),
(152, 'Europe/Helsinki'),
(153, 'Pacific/Fiji'),
(154, 'Atlantic/Stanley'),
(155, 'Pacific/Chuuk'),
(156, 'Pacific/Pohnpei'),
(157, 'Pacific/Kosrae'),
(158, 'Atlantic/Faroe'),
(159, 'Europe/Paris'),
(160, 'Africa/Libreville'),
(161, 'Europe/London'),
(162, 'America/Grenada'),
(163, 'Asia/Tbilisi'),
(164, 'America/Cayenne'),
(165, 'Europe/Guernsey'),
(166, 'Africa/Accra'),
(167, 'Europe/Gibraltar'),
(168, 'America/Nuuk'),
(169, 'America/Danmarkshavn'),
(170, 'America/Scoresbysund'),
(171, 'America/Thule'),
(172, 'Africa/Banjul'),
(173, 'Africa/Conakry'),
(174, 'America/Guadeloupe'),
(175, 'Africa/Malabo'),
(176, 'Europe/Athens'),
(177, 'Atlantic/South_Georgia'),
(178, 'America/Guatemala'),
(179, 'Pacific/Guam'),
(180, 'Africa/Bissau'),
(181, 'America/Guyana'),
(182, 'Asia/Hong_Kong'),
(183, 'America/Tegucigalpa'),
(184, 'Europe/Zagreb'),
(185, 'America/Port-au-Prince'),
(186, 'Europe/Budapest'),
(187, 'Asia/Jakarta'),
(188, 'Asia/Pontianak'),
(189, 'Asia/Makassar'),
(190, 'Asia/Jayapura'),
(191, 'Europe/Dublin'),
(192, 'Asia/Jerusalem'),
(193, 'Europe/Isle_of_Man'),
(194, 'Asia/Kolkata'),
(195, 'Indian/Chagos'),
(196, 'Asia/Baghdad'),
(197, 'Asia/Tehran'),
(198, 'Atlantic/Reykjavik'),
(199, 'Europe/Rome'),
(200, 'Europe/Jersey'),
(201, 'America/Jamaica'),
(202, 'Asia/Amman'),
(203, 'Asia/Tokyo'),
(204, 'Africa/Nairobi'),
(205, 'Asia/Bishkek'),
(206, 'Asia/Phnom_Penh'),
(207, 'Pacific/Tarawa'),
(208, 'Pacific/Enderbury'),
(209, 'Pacific/Kiritimati'),
(210, 'Indian/Comoro'),
(211, 'America/St_Kitts'),
(212, 'Asia/Pyongyang'),
(213, 'Asia/Seoul'),
(214, 'Asia/Kuwait'),
(215, 'America/Cayman'),
(216, 'Asia/Almaty'),
(217, 'Asia/Qyzylorda'),
(218, 'Asia/Qostanay'),
(219, 'Asia/Aqtobe'),
(220, 'Asia/Aqtau'),
(221, 'Asia/Atyrau'),
(222, 'Asia/Oral'),
(223, 'Asia/Vientiane'),
(224, 'Asia/Beirut'),
(225, 'America/St_Lucia'),
(226, 'Europe/Vaduz'),
(227, 'Asia/Colombo'),
(228, 'Africa/Monrovia'),
(229, 'Africa/Maseru'),
(230, 'Europe/Vilnius'),
(231, 'Europe/Luxembourg'),
(232, 'Europe/Riga'),
(233, 'Africa/Tripoli'),
(234, 'Africa/Casablanca'),
(235, 'Europe/Monaco'),
(236, 'Europe/Chisinau'),
(237, 'Europe/Podgorica'),
(238, 'America/Marigot'),
(239, 'Indian/Antananarivo'),
(240, 'Pacific/Majuro'),
(241, 'Pacific/Kwajalein'),
(242, 'Europe/Skopje'),
(243, 'Africa/Bamako'),
(244, 'Asia/Yangon'),
(245, 'Asia/Ulaanbaatar'),
(246, 'Asia/Hovd'),
(247, 'Asia/Choibalsan'),
(248, 'Asia/Macau'),
(249, 'Pacific/Saipan'),
(250, 'America/Martinique'),
(251, 'Africa/Nouakchott'),
(252, 'America/Montserrat'),
(253, 'Europe/Malta'),
(254, 'Indian/Mauritius'),
(255, 'Indian/Maldives'),
(256, 'Africa/Blantyre'),
(257, 'America/Mexico_City'),
(258, 'America/Cancun'),
(259, 'America/Merida'),
(260, 'America/Monterrey'),
(261, 'America/Matamoros'),
(262, 'America/Mazatlan'),
(263, 'America/Chihuahua'),
(264, 'America/Ojinaga'),
(265, 'America/Hermosillo'),
(266, 'America/Tijuana'),
(267, 'America/Bahia_Banderas'),
(268, 'Asia/Kuala_Lumpur'),
(269, 'Asia/Kuching'),
(270, 'Africa/Maputo'),
(271, 'Africa/Windhoek'),
(272, 'Pacific/Noumea'),
(273, 'Africa/Niamey'),
(274, 'Pacific/Norfolk'),
(275, 'Africa/Lagos'),
(276, 'America/Managua'),
(277, 'Europe/Amsterdam'),
(278, 'Europe/Oslo'),
(279, 'Asia/Kathmandu'),
(280, 'Pacific/Nauru'),
(281, 'Pacific/Niue'),
(282, 'Pacific/Auckland'),
(283, 'Pacific/Chatham'),
(284, 'Asia/Muscat'),
(285, 'America/Panama'),
(286, 'America/Lima'),
(287, 'Pacific/Tahiti'),
(288, 'Pacific/Marquesas'),
(289, 'Pacific/Gambier'),
(290, 'Pacific/Port_Moresby'),
(291, 'Pacific/Bougainville'),
(292, 'Asia/Manila'),
(293, 'Asia/Karachi'),
(294, 'Europe/Warsaw'),
(295, 'America/Miquelon'),
(296, 'Pacific/Pitcairn'),
(297, 'America/Puerto_Rico'),
(298, 'Asia/Gaza'),
(299, 'Asia/Hebron'),
(300, 'Europe/Lisbon'),
(301, 'Atlantic/Madeira'),
(302, 'Atlantic/Azores'),
(303, 'Pacific/Palau'),
(304, 'America/Asuncion'),
(305, 'Asia/Qatar'),
(306, 'Indian/Reunion'),
(307, 'Europe/Bucharest'),
(308, 'Europe/Belgrade'),
(309, 'Europe/Kaliningrad'),
(310, 'Europe/Moscow'),
(311, 'Europe/Simferopol'),
(312, 'Europe/Kirov'),
(313, 'Europe/Astrakhan'),
(314, 'Europe/Volgograd'),
(315, 'Europe/Saratov'),
(316, 'Europe/Ulyanovsk'),
(317, 'Europe/Samara'),
(318, 'Asia/Yekaterinburg'),
(319, 'Asia/Omsk'),
(320, 'Asia/Novosibirsk'),
(321, 'Asia/Barnaul'),
(322, 'Asia/Tomsk'),
(323, 'Asia/Novokuznetsk'),
(324, 'Asia/Krasnoyarsk'),
(325, 'Asia/Irkutsk'),
(326, 'Asia/Chita'),
(327, 'Asia/Yakutsk'),
(328, 'Asia/Khandyga'),
(329, 'Asia/Vladivostok'),
(330, 'Asia/Ust-Nera'),
(331, 'Asia/Magadan'),
(332, 'Asia/Sakhalin'),
(333, 'Asia/Srednekolymsk'),
(334, 'Asia/Kamchatka'),
(335, 'Asia/Anadyr'),
(336, 'Africa/Kigali'),
(337, 'Asia/Riyadh'),
(338, 'Pacific/Guadalcanal'),
(339, 'Indian/Mahe'),
(340, 'Africa/Khartoum'),
(341, 'Europe/Stockholm'),
(342, 'Asia/Singapore'),
(343, 'Atlantic/St_Helena'),
(344, 'Europe/Ljubljana'),
(345, 'Arctic/Longyearbyen'),
(346, 'Europe/Bratislava'),
(347, 'Africa/Freetown'),
(348, 'Europe/San_Marino'),
(349, 'Africa/Dakar'),
(350, 'Africa/Mogadishu'),
(351, 'America/Paramaribo'),
(352, 'Africa/Juba'),
(353, 'Africa/Sao_Tome'),
(354, 'America/El_Salvador'),
(355, 'America/Lower_Princes'),
(356, 'Asia/Damascus'),
(357, 'Africa/Mbabane'),
(358, 'America/Grand_Turk'),
(359, 'Africa/Ndjamena'),
(360, 'Indian/Kerguelen'),
(361, 'Africa/Lome'),
(362, 'Asia/Bangkok'),
(363, 'Asia/Dushanbe'),
(364, 'Pacific/Fakaofo'),
(365, 'Asia/Dili'),
(366, 'Asia/Ashgabat'),
(367, 'Africa/Tunis'),
(368, 'Pacific/Tongatapu'),
(369, 'Europe/Istanbul'),
(370, 'America/Port_of_Spain'),
(371, 'Pacific/Funafuti'),
(372, 'Asia/Taipei'),
(373, 'Africa/Dar_es_Salaam'),
(374, 'Europe/Kiev'),
(375, 'Europe/Uzhgorod'),
(376, 'Europe/Zaporozhye'),
(377, 'Africa/Kampala'),
(378, 'Pacific/Midway'),
(379, 'Pacific/Wake'),
(380, 'America/New_York'),
(381, 'America/Detroit'),
(382, 'America/Kentucky/Louisville'),
(383, 'America/Kentucky/Monticello'),
(384, 'America/Indiana/Indianapolis'),
(385, 'America/Indiana/Vincennes'),
(386, 'America/Indiana/Winamac'),
(387, 'America/Indiana/Marengo'),
(388, 'America/Indiana/Petersburg'),
(389, 'America/Indiana/Vevay'),
(390, 'America/Chicago'),
(391, 'America/Indiana/Tell_City'),
(392, 'America/Indiana/Knox'),
(393, 'America/Menominee'),
(394, 'America/North_Dakota/Center'),
(395, 'America/North_Dakota/New_Salem'),
(396, 'America/North_Dakota/Beulah'),
(397, 'America/Denver'),
(398, 'America/Boise'),
(399, 'America/Phoenix'),
(400, 'America/Los_Angeles'),
(401, 'America/Anchorage'),
(402, 'America/Juneau'),
(403, 'America/Sitka'),
(404, 'America/Metlakatla'),
(405, 'America/Yakutat'),
(406, 'America/Nome'),
(407, 'America/Adak'),
(408, 'Pacific/Honolulu'),
(409, 'America/Montevideo'),
(410, 'Asia/Samarkand'),
(411, 'Asia/Tashkent'),
(412, 'Europe/Vatican'),
(413, 'America/St_Vincent'),
(414, 'America/Caracas'),
(415, 'America/Tortola'),
(416, 'America/St_Thomas'),
(417, 'Asia/Ho_Chi_Minh'),
(418, 'Pacific/Efate'),
(419, 'Pacific/Wallis'),
(420, 'Pacific/Apia'),
(421, 'Asia/Aden'),
(422, 'Indian/Mayotte'),
(423, 'Africa/Johannesburg'),
(424, 'Africa/Lusaka'),
(425, 'Africa/Harare');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT 'user',
  `account_type` varchar(255) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT 'registered',
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `layouts` varchar(255) NOT NULL DEFAULT 'style1',
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `paypal_payment` int(11) DEFAULT 1,
  `stripe_payment` int(11) DEFAULT 1,
  `paypal_email` varchar(255) DEFAULT NULL,
  `publish_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `razorpay_payment` int(11) DEFAULT 0,
  `razorpay_key_id` varchar(255) DEFAULT NULL,
  `razorpay_key_secret` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `email_verified` int(11) DEFAULT NULL,
  `verify_code` varchar(255) DEFAULT NULL,
  `hit` int(11) DEFAULT 0,
  `trial_expire` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `is_send_invoice` varchar(255) DEFAULT NULL,
  `approve` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_role_feature`
--

CREATE TABLE `users_role_feature` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_role_feature`
--

INSERT INTO `users_role_feature` (`id`, `name`, `slug`) VALUES
(1, 'Customers', 'customers'),
(2, 'Products', 'products'),
(3, 'Estimates', 'estimates'),
(4, 'Invoices', 'invoices'),
(5, 'Expenses', 'expenses'),
(6, 'Bills', 'bills'),
(7, 'Reports', 'reports');

-- --------------------------------------------------------

--
-- Table structure for table `users_role_feature_assign`
--

CREATE TABLE `users_role_feature_assign` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `business_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `feature_slug` varchar(255) DEFAULT NULL,
  `view_only` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_category`
--
ALTER TABLE `business_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `google_fonts`
--
ALTER TABLE `google_fonts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_payment_record`
--
ALTER TABLE `invoice_payment_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_taxes`
--
ALTER TABLE `invoice_taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lang_values`
--
ALTER TABLE `lang_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_features`
--
ALTER TABLE `package_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_advance`
--
ALTER TABLE `payment_advance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_records`
--
ALTER TABLE `payment_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_services`
--
ALTER TABLE `product_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tax`
--
ALTER TABLE `product_tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_contacts`
--
ALTER TABLE `site_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_type`
--
ALTER TABLE `tax_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_zone`
--
ALTER TABLE `time_zone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_zone_name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_role_feature`
--
ALTER TABLE `users_role_feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_role_feature_assign`
--
ALTER TABLE `users_role_feature_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_category`
--
ALTER TABLE `business_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `google_fonts`
--
ALTER TABLE `google_fonts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_payment_record`
--
ALTER TABLE `invoice_payment_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_taxes`
--
ALTER TABLE `invoice_taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lang_values`
--
ALTER TABLE `lang_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=715;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package_features`
--
ALTER TABLE `package_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_advance`
--
ALTER TABLE `payment_advance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_records`
--
ALTER TABLE `payment_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_services`
--
ALTER TABLE `product_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tax`
--
ALTER TABLE `product_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_contacts`
--
ALTER TABLE `site_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax_type`
--
ALTER TABLE `tax_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_zone`
--
ALTER TABLE `time_zone`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_role_feature`
--
ALTER TABLE `users_role_feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_role_feature_assign`
--
ALTER TABLE `users_role_feature_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
