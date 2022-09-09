-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table portfolio.doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table portfolio.doctrine_migration_versions: ~2 rows (approximately)
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20220908154032', '2022-09-08 15:40:56', 521),
	('DoctrineMigrations\\Version20220908163013', '2022-09-08 16:30:38', 113);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;

-- Dumping structure for table portfolio.exp
CREATE TABLE IF NOT EXISTS `exp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(4096) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6BE521B12469DE2` (`category_id`),
  CONSTRAINT `FK_6BE521B12469DE2` FOREIGN KEY (`category_id`) REFERENCES `experience_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portfolio.exp: ~0 rows (approximately)
/*!40000 ALTER TABLE `exp` DISABLE KEYS */;
INSERT INTO `exp` (`id`, `category_id`, `name`, `content`) VALUES
	(1, 1, 'Gaming Campus G.Tech', 'School');
/*!40000 ALTER TABLE `exp` ENABLE KEYS */;

-- Dumping structure for table portfolio.experience_category
CREATE TABLE IF NOT EXISTS `experience_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portfolio.experience_category: ~2 rows (approximately)
/*!40000 ALTER TABLE `experience_category` DISABLE KEYS */;
INSERT INTO `experience_category` (`id`, `name`) VALUES
	(1, 'Tuto'),
	(2, 'Main'),
	(3, 'Secondary');
/*!40000 ALTER TABLE `experience_category` ENABLE KEYS */;

-- Dumping structure for table portfolio.messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portfolio.messenger_messages: ~0 rows (approximately)
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;

-- Dumping structure for table portfolio.project
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(4096) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portfolio.project: ~0 rows (approximately)
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` (`id`, `name`, `image`, `content`, `date`) VALUES
	(1, 'A journey to Vepiter', ' ', 'A Game', '2022-04-08');
/*!40000 ALTER TABLE `project` ENABLE KEYS */;

-- Dumping structure for table portfolio.project_category
CREATE TABLE IF NOT EXISTS `project_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portfolio.project_category: ~4 rows (approximately)
/*!40000 ALTER TABLE `project_category` DISABLE KEYS */;
INSERT INTO `project_category` (`id`, `name`) VALUES
	(1, 'GameJam'),
	(2, 'School'),
	(3, 'Perso'),
	(4, 'Professional');
/*!40000 ALTER TABLE `project_category` ENABLE KEYS */;

-- Dumping structure for table portfolio.project_project_category
CREATE TABLE IF NOT EXISTS `project_project_category` (
  `project_id` int(11) NOT NULL,
  `project_category_id` int(11) NOT NULL,
  PRIMARY KEY (`project_id`,`project_category_id`),
  KEY `IDX_86875173166D1F9C` (`project_id`),
  KEY `IDX_86875173DA896A19` (`project_category_id`),
  CONSTRAINT `FK_86875173166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_86875173DA896A19` FOREIGN KEY (`project_category_id`) REFERENCES `project_category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portfolio.project_project_category: ~0 rows (approximately)
/*!40000 ALTER TABLE `project_project_category` DISABLE KEYS */;
INSERT INTO `project_project_category` (`project_id`, `project_category_id`) VALUES
	(1, 2);
/*!40000 ALTER TABLE `project_project_category` ENABLE KEYS */;

-- Dumping structure for table portfolio.project_skill
CREATE TABLE IF NOT EXISTS `project_skill` (
  `project_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  PRIMARY KEY (`project_id`,`skill_id`),
  KEY `IDX_4D68EDE9166D1F9C` (`project_id`),
  KEY `IDX_4D68EDE95585C142` (`skill_id`),
  CONSTRAINT `FK_4D68EDE9166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4D68EDE95585C142` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portfolio.project_skill: ~2 rows (approximately)
/*!40000 ALTER TABLE `project_skill` DISABLE KEYS */;
INSERT INTO `project_skill` (`project_id`, `skill_id`) VALUES
	(1, 1),
	(1, 3);
/*!40000 ALTER TABLE `project_skill` ENABLE KEYS */;

-- Dumping structure for table portfolio.skill
CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `is_passive` tinyint(1) NOT NULL,
  `is_base` tinyint(1) DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5E3DE477727ACA70` (`parent_id`),
  CONSTRAINT `FK_5E3DE477727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `skill` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portfolio.skill: ~9 rows (approximately)
/*!40000 ALTER TABLE `skill` DISABLE KEYS */;
INSERT INTO `skill` (`id`, `parent_id`, `name`, `level`, `is_passive`, `is_base`, `icon`) VALUES
	(1, NULL, 'C#', 4, 0, 1, 'c-sharp.png'),
	(2, 1, 'Monogame', 2, 0, 0, 'MonoGame.png'),
	(3, 1, 'Unity', 3, 0, 0, 'unity.png'),
	(4, NULL, 'C++', 3, 0, 1, 'c++.png'),
	(5, 4, 'Cocos2d', 3, 0, 0, 'cocos2d.jpg'),
	(6, 4, 'SDL2', 3, 0, 0, 'SDL.png'),
	(7, 4, 'Unreal Ungine', 1, 0, 0, 'unreal.png'),
	(8, NULL, 'Travail d\'équipe', 0, 1, 0, ''),
	(9, NULL, 'Autonomie', 0, 1, 0, '');
/*!40000 ALTER TABLE `skill` ENABLE KEYS */;

-- Dumping structure for table portfolio.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portfolio.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
