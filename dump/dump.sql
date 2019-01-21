-- --------------------------------------------------------
-- Host:                         192.168.99.100
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.5.0.5249
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for neueda_challenge
CREATE DATABASE IF NOT EXISTS `neueda_challenge` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `neueda_challenge`;

-- Dumping structure for table neueda_challenge.shrink
CREATE TABLE IF NOT EXISTS `shrink` (
  `shrink_id` int(11) NOT NULL AUTO_INCREMENT,
  `shrink_url` text NOT NULL,
  `shrink_code` varchar(90) NOT NULL,
  `shrink_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`shrink_id`),
  KEY `shrink_id` (`shrink_id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table neueda_challenge.shrink: ~33 rows (approximately)
/*!40000 ALTER TABLE `shrink` DISABLE KEYS */;
INSERT IGNORE INTO `shrink` (`shrink_id`, `shrink_url`, `shrink_code`, `shrink_title`) VALUES
	(31, 'https://www.google.com/search?source=hp&ei=IS1DXOTIB6HM5OUPjqOUOA&q=arduino+tutorials&btnK=Google+Search&oq=arduino+tutorials&gs_l=psy-ab.3..0l10.4070.7804..8691...0.0..0.150.1663.18j1......0....1..gws-wiz.....0.ggE9cSCZoQQ', '-7Ppe', NULL),
	(32, 'http://www.twitter.com', 'KG5fN', NULL),
	(33, 'http://www.twitter.com', '92TF7', NULL),
	(34, 'http://www.twitter.com', 'EpmKr', NULL),
	(35, 'https://www.scientificamerican.com/article/the-cerebellum-is-your-little-brain-and-it-does-some-pretty-big-things/', 'Q377X', NULL),
	(61, 'https://www.scientificamerican.com/article/the-cerebellum-is-your-little-brain-and-it-does-some-pretty-big-things/', 'eHQmW', NULL),
	(62, 'https://www.scientificamerican.com/article/robofossil-reveals-locomotion-of-beast-from-deep-time/', '9tsmQ', NULL),
	(66, 'https://www.scientificamerican.com/article/robofossil-reveals-locomotion-of-beast-from-deep-time/', 'k3Pw9', NULL),
	(67, 'http://mla-advogados.com.br/', 'D0EwD', NULL),
	(70, 'https://getbootstrap.com/docs/4.1/utilities/display/', 'Syet5', NULL),
	(73, 'https://bitly.com/pages/resources', 'wQYXg', NULL),
	(75, 'https://www.scientificamerican.com/article/bitter-reality-most-wild-coffee-species-risk-extinction-worldwide1/', 'jHas', NULL),
	(80, 'https://www.favicon-generator.org/', 'MYHh', NULL),
	(81, 'https://www.youtube.com/watch?v=PErqizZqLjI', 'Gd4jj', NULL),
	(82, 'https://www.youtube.com/watch?v=PErqizZqLjI', 'cs_1', NULL),
	(83, 'https://www.favicon-generator.org/', '8mntU', NULL),
	(84, 'https://brasil.elpais.com/brasil/2019/01/18/politica/1547766813_225819.html', 'qL6T_', NULL),
	(85, 'https://brasil.elpais.com/brasil/2019/01/18/politica/1547766813_225819.html', 'zons8', NULL),
	(86, 'https://brasil.elpais.com/brasil/2019/01/18/politica/1547766813_225819.html', 'yvufc', NULL),
	(88, 'https://www.scientificamerican.com/article/our-language-affects-what-we-see/', 'UshaN', NULL),
	(89, 'https://www.scientificamerican.com/article/our-language-affects-what-we-see/', 'DQSxf', NULL),
	(90, 'https://www.scientificamerican.com/article/our-language-affects-what-we-see/', '0PlhZ', NULL),
	(91, 'https://www.scientificamerican.com/article/our-language-affects-what-we-see/', 'hcXR9', NULL),
	(92, 'https://greenwichmeantime.com/time/to/gmt-pst/#!#convert', 'RqSzs', NULL),
	(93, 'https://www.scientificamerican.com/sustainability/', 'l2E5s', NULL),
	(94, 'https://www.scientificamerican.com/video/', 'aVor6', NULL),
	(95, 'https://oglobo.globo.com/sociedade/ciencia/cientistas-da-rede-publica-do-rio-curam-casos-neurologicos-graves-de-dengue-chicungunha-23383892', 'YbBPo', NULL),
	(96, 'https://www.vegascreativesoftware.com/us/newsletter/upgrade-vegas-pro/specifications/', 'Luv', NULL),
	(97, 'https://www.vegascreativesoftware.com/us/newsletter/upgrade-vegas-pro/specifications/?gclid=EAIaIQobChMIgJbh69f83wIVmcbjBx2F1wuEEAEYASAEEgIHPfD_BwE&_oB=vegas-pro&ef_id=EAIaIQobChMIgJbh69f83wIVmcbjBx2F1wuEEAEYASAEEgIHPfD_BwE:G:s&AffiliateID=145&phash=BBPtCllArZvjlyXI', 'wZYZk', NULL),
	(98, 'https://www.vegascreativesoftware.com/us/newsletter/upgrade-vegas-pro/specifications/?gclid=EAIaIQobChMIgJbh69f83wIVmcbjBx2F1wuEEAEYASAEEgIHPfD_BwE&_oB=vegas-pro&ef_id=EAIaIQobChMIgJbh69f83wIVmcbjBx2F1wuEEAEYASAEEgIHPfD_BwE:G:s&AffiliateID=145&phash=BBPtCllArZvjlyXI', 'KyC5y', NULL),
	(99, 'https://www.vegascreativesoftware.com/us/newsletter/upgrade-vegas-pro/specifications/?gclid=EAIaIQobChMIgJbh69f83wIVmcbjBx2F1wuEEAEYASAEEgIHPfD_BwE&_oB=vegas-pro&ef_id=EAIaIQobChMIgJbh69f83wIVmcbjBx2F1wuEEAEYASAEEgIHPfD_BwE:G:s&AffiliateID=145&phash=BBPtCllArZvjlyXI', 'NG', NULL),
	(127, 'https://www.smashingmagazine.com/2019/01/monthly-web-development-update-1-2019/', '0YAm2', 'Monthly Web Development Update 1/2019: Rethinking Habits And Finding Custom Solutions — Smashing Magazine   if (sessionStorage.foutFontsSt'),
	(128, 'https://answers.microsoft.com/en-us/windows/forum/windows_10-performance/windows-10-performance-and-install-integrity/75529fd4-fac7-4653-893a-dd8cd4b4db00', 'q-gVF', 'Windows 10 Performance and Install Integrity Checklist - Microsoft Community');
/*!40000 ALTER TABLE `shrink` ENABLE KEYS */;

-- Dumping structure for table neueda_challenge.shrink_views
CREATE TABLE IF NOT EXISTS `shrink_views` (
  `shrink_views_id` int(11) NOT NULL AUTO_INCREMENT,
  `shrink_id` int(11) NOT NULL,
  `country_id` tinyint(4) DEFAULT NULL,
  `when_viewed` datetime DEFAULT NULL,
  PRIMARY KEY (`shrink_views_id`),
  KEY `shrink_views_id` (`shrink_views_id`),
  KEY `FK_SHRINK_idx` (`shrink_id`),
  CONSTRAINT `FK_SHRINK` FOREIGN KEY (`shrink_id`) REFERENCES `shrink` (`shrink_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table neueda_challenge.shrink_views: ~24 rows (approximately)
/*!40000 ALTER TABLE `shrink_views` DISABLE KEYS */;
INSERT IGNORE INTO `shrink_views` (`shrink_views_id`, `shrink_id`, `country_id`, `when_viewed`) VALUES
	(16, 85, 0, '2019-01-20 12:51:40'),
	(17, 82, 0, '2019-01-20 12:57:42'),
	(18, 82, 0, '2019-01-20 12:57:49'),
	(19, 88, 0, '2019-01-20 13:17:47'),
	(20, 88, 0, '2019-01-20 13:17:50'),
	(21, 88, 0, '2019-01-20 13:17:53'),
	(22, 94, 0, '2019-01-20 13:34:18'),
	(23, 91, 0, '2019-01-20 13:34:32'),
	(24, 91, 0, '2019-01-20 13:34:35'),
	(25, 91, 0, '2019-01-20 13:34:38'),
	(26, 90, 0, '2019-01-20 13:34:40'),
	(27, 84, 0, '2019-01-20 13:34:42'),
	(28, 84, 0, '2019-01-20 13:35:02'),
	(29, 84, 0, '2019-01-20 13:35:11'),
	(30, 95, 0, '2019-01-20 13:36:30'),
	(31, 95, 0, '2019-01-20 13:36:32'),
	(32, 95, 0, '2019-01-20 14:07:02'),
	(33, 95, 0, '2019-01-20 14:09:43'),
	(34, 95, 0, '2019-01-20 14:11:36'),
	(35, 95, 0, '2019-01-20 14:14:19'),
	(36, 95, 0, '2019-01-20 14:17:32'),
	(37, 96, 0, '2019-01-20 14:29:13'),
	(40, 85, 0, '2019-01-20 16:46:16'),
	(41, 128, 0, '2019-01-20 22:26:08');
/*!40000 ALTER TABLE `shrink_views` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
