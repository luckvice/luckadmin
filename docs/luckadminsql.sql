-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.34-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para luckadmin
CREATE DATABASE IF NOT EXISTS `luckadmin` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `luckadmin`;

-- Copiando estrutura para tabela luckadmin.log_atv
CREATE TABLE IF NOT EXISTS `log_atv` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(11) NOT NULL,
  `activity` text,
  `module` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`),
  UNIQUE KEY `log_id` (`log_id`),
  KEY `FK_activity_log_user_user_id` (`fk_user_id`),
  CONSTRAINT `FK_activity_log_user_user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `usuario` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461;

-- Copiando dados para a tabela luckadmin.log_atv: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `log_atv` DISABLE KEYS */;
INSERT INTO `log_atv` (`log_id`, `fk_user_id`, `activity`, `module`, `created_at`) VALUES
	(6, 1, 'update user lucasmarcelo93@gmail.com`s details (lucasmarcelo93@gmail.com to lucasmarcelo93@gmail.com, testes to testesddd,user to user)', 'Gerenciamento de usuario', '2019-04-22 20:50:33'),
	(7, 1, 'update user lucasmarcelo93@gmail.com`s details (lucasmarcelo93@gmail.com to lucasmarcelo93@gmail.com, testesddd to novoteste,user to user)', 'Gerenciamento de usuario', '2019-04-22 21:25:26'),
	(8, 1, 'update user admin@admin.com`s details (admin@admin.com to admin@admin.com, Admin to Adminsss,admin to admin)', 'Gerenciamento de usuario', '2019-04-22 21:31:43'),
	(9, 1, 'update user admin@admin.com`s details (admin@admin.com to admin@admin.com, Adminsss to teste,admin to admin)', 'Gerenciamento de usuario', '2019-04-22 21:31:49'),
	(10, 1, 'add new user fernandomngl@gmail.com', 'Gerenciamento de usuarios', '2019-04-22 21:32:16'),
	(11, 1, 'delete user fernandomngl@gmail.com', 'Gerenciamento de usuarios', '2019-04-22 21:33:29'),
	(12, 1, 'add new user aaa@aaaa.com', 'Gerenciamento de usuarios', '2019-04-22 21:36:27'),
	(13, 1, 'delete user aaa@aaaa.com', 'Gerenciamento de usuarios', '2019-04-22 21:37:40'),
	(14, 1, 'delete user lucasmarcelo93@gmail.com', 'Gerenciamento de usuarios', '2019-04-22 21:37:43'),
	(15, 1, 'add new user admin@admin2.com', 'Gerenciamento de usuarios', '2019-04-22 21:57:36'),
	(16, 1, 'add new user admin@admin23.com', 'Gerenciamento de usuarios', '2019-04-22 22:00:18'),
	(17, 1, 'add new user aaa@aaa.com', 'Gerenciamento de usuarios', '2019-04-22 22:03:17'),
	(18, 1, 'add new user admin@admin123.com', 'Gerenciamento de usuarios', '2019-04-22 22:10:43'),
	(19, 1, 'delete user admin@admin123.com', 'Gerenciamento de usuarios', '2019-04-22 22:14:27'),
	(20, 1, 'add new user admin@admine.com', 'Gerenciamento de usuarios', '2019-04-22 22:15:19'),
	(21, 1, 'add new user admin@admsin.com', 'Gerenciamento de usuarios', '2019-04-22 22:17:35');
/*!40000 ALTER TABLE `log_atv` ENABLE KEYS */;

-- Copiando estrutura para tabela luckadmin.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `grupo` varchar(25) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `url_img` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- Copiando dados para a tabela luckadmin.usuario: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`user_id`, `email`, `senha`, `nome`, `grupo`, `status`, `criado_em`, `atualizado_em`, `url_img`) VALUES
	(1, 'admin@admin.com', 'f6fdffe48c908deb0f4c3bd36c032e72', 'teste', 'admin', 1, '2017-01-12 12:07:57', '2019-04-22 16:31:49', 'https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png'),
	(12, 'admin@admine.com', '7fd738522fbcd853931af99c51f5b992', 'banana', 'admin', 1, '2019-04-22 22:15:16', NULL, NULL),
	(13, 'admin@admsin.com', '6fcd71f2cdb2446f929700ff1bef970b', 'dsadsad', 'admin', 1, '2019-04-22 22:17:31', NULL, NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
