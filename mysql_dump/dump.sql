-- --------------------------------------------------------
-- Хост:                         172.20.0.89
-- Версия сервера:               5.5.44-cll-lve - MySQL Community Server (GPL) by Atomicorp
-- ОС Сервера:                   Linux
-- HeidiSQL Версия:              9.3.0.5009
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных test_task
CREATE DATABASE IF NOT EXISTS `test_task` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `test_task`;


-- Дамп структуры для таблица test_task.authors
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test_task.authors: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT IGNORE INTO `authors` (`id`, `firstname`, `lastname`) VALUES
	(1, 'Эдуард', 'Тополь'),
	(2, 'Дмитрий', 'Глухковский');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;


-- Дамп структуры для таблица test_task.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL,
  `preview` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test_task.books: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT IGNORE INTO `books` (`id`, `name`, `date_create`, `date_update`, `preview`, `date`, `author_id`) VALUES
	(1, 'Метро 2033', '2015-09-30 12:37:17', '2015-12-03 13:37:40', '@web/img/test_task/books/2033.jpg', '2005-11-25', 2),
	(2, 'Метро 2034', '2015-12-02 12:38:34', '2015-12-03 11:51:36', '@web/img/test_task/books/2034.jpg', '2009-11-30', 2),
	(3, 'Чужое лицо', '2015-12-01 12:38:55', '2015-12-03 13:37:22', '@web/img/test_task/books/chujoe_lico.jpg', '1964-09-25', 1),
	(4, 'Метро 2035', '2015-11-30 14:04:28', '2015-12-03 11:51:40', '@web/img/test_task/books/2035.jpg', '2015-11-20', 2);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
