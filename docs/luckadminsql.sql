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

-- Copiando estrutura para tabela luckadmin.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '0',
  `img` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela luckadmin.categorias: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `nome`, `img`) VALUES
	(1, 'Corrida', '0'),
	(2, 'Arcade', '0'),
	(3, 'Luta', '0'),
	(4, 'Simulação', '0');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Copiando estrutura para tabela luckadmin.desenvolvedor
CREATE TABLE IF NOT EXISTS `desenvolvedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela luckadmin.desenvolvedor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `desenvolvedor` DISABLE KEYS */;
INSERT INTO `desenvolvedor` (`id`, `nome`) VALUES
	(0, 'EA Black Box'),
	(1, 'Rockstar Games');
/*!40000 ALTER TABLE `desenvolvedor` ENABLE KEYS */;

-- Copiando estrutura para tabela luckadmin.jogomng
CREATE TABLE IF NOT EXISTS `jogomng` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jogo` int(11) NOT NULL DEFAULT '0',
  `regiao_jogo` varchar(50) NOT NULL DEFAULT '0',
  `id_linguagem` int(11) NOT NULL DEFAULT '0',
  `capa_url` varchar(255) NOT NULL DEFAULT '0',
  `fundo_url` varchar(255) NOT NULL DEFAULT '0',
  `ativo` int(11) NOT NULL DEFAULT '0',
  `link_url` varchar(255) NOT NULL DEFAULT '0',
  `cadastrado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_jogomng_jogos` (`id_jogo`),
  KEY `FK_jogomng_usuario` (`cadastrado_por`),
  CONSTRAINT `FK_jogomng_jogos` FOREIGN KEY (`id_jogo`) REFERENCES `jogos` (`id`),
  CONSTRAINT `FK_jogomng_usuario` FOREIGN KEY (`cadastrado_por`) REFERENCES `usuario` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela luckadmin.jogomng: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `jogomng` DISABLE KEYS */;
/*!40000 ALTER TABLE `jogomng` ENABLE KEYS */;

-- Copiando estrutura para tabela luckadmin.jogos
CREATE TABLE IF NOT EXISTS `jogos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `plataform_id` int(11) NOT NULL DEFAULT '0',
  `galeria_id` int(11) NOT NULL DEFAULT '0',
  `publisher_id` int(11) NOT NULL DEFAULT '0',
  `desenv_id` int(11) NOT NULL DEFAULT '0',
  `sinopse` varchar(50) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `cadastrado_por` int(11) DEFAULT NULL,
  `ano_lanc` date,
  PRIMARY KEY (`id`),
  KEY `FK_jogos_categorias` (`cat_id`),
  KEY `FK_jogos_plataformas` (`plataform_id`),
  KEY `FK_jogos_publisher` (`publisher_id`),
  KEY `FK_jogos_desenvolvedor` (`desenv_id`),
  CONSTRAINT `FK_jogos_categorias` FOREIGN KEY (`cat_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `FK_jogos_desenvolvedor` FOREIGN KEY (`desenv_id`) REFERENCES `desenvolvedor` (`id`),
  CONSTRAINT `FK_jogos_plataformas` FOREIGN KEY (`plataform_id`) REFERENCES `plataformas` (`id`),
  CONSTRAINT `FK_jogos_publisher` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela luckadmin.jogos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `jogos` DISABLE KEYS */;
INSERT INTO `jogos` (`id`, `nome`, `cat_id`, `plataform_id`, `galeria_id`, `publisher_id`, `desenv_id`, `sinopse`, `status`, `cadastrado_por`, `ano_lanc`) VALUES
	(2, 'Need For Speed Underground 1', 1, 2, 0, 1, 0, '0', 1, 1, '2002-11-08'),
	(4, 'Grand Theft Auto V', 4, 4, 0, 1, 1, '0', 1, NULL, NULL);
/*!40000 ALTER TABLE `jogos` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461;

-- Copiando dados para a tabela luckadmin.log_atv: ~31 rows (aproximadamente)
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
	(21, 1, 'add new user admin@admsin.com', 'Gerenciamento de usuarios', '2019-04-22 22:17:35'),
	(22, 1, 'add new user admin@admi2n.com', 'Gerenciamento de usuarios', '2019-04-22 22:39:28'),
	(23, 1, 'delete user admin@admi2n.com', 'Gerenciamento de usuarios', '2019-04-22 22:40:05'),
	(24, 1, 'add new user lucasmarcelo93@gmail.com', 'Gerenciamento de usuarios', '2019-04-22 22:40:29'),
	(25, 1, 'delete user lucasmarcelo93@gmail.com', 'Gerenciamento de usuarios', '2019-04-22 22:42:01'),
	(26, 1, 'add new user lucasmarcelo93@gmail.com', 'Gerenciamento de usuarios', '2019-04-22 22:43:43'),
	(27, 1, 'update user admin@admin.com`s details (admin@admin.com to admin@admin.com, teste to Lucas,admin to admin)', 'Gerenciamento de usuario', '2019-04-22 23:05:45'),
	(28, 1, 'update user admin@admin.com`s details (admin@admin.com to admin@admin.com, Lucas to Lucass,admin to admin)', 'Gerenciamento de usuario', '2019-04-23 15:24:07'),
	(29, 1, 'update user lucasmarcelo93@gmail.com`s details (lucasmarcelo93@gmail.com to lucasmarcelo193@gmail.com, lucas soares to lucas soares,admin to admin)', 'Gerenciamento de usuario', '2019-04-23 15:27:35'),
	(30, 1, 'update user lucasmarcelo193@gmail.com`s details (lucasmarcelo193@gmail.com to lucasmarcelo193@gmail.com, lucas soares to lucas soares XXXX,admin to admin)', 'Gerenciamento de usuario', '2019-04-23 17:57:47'),
	(31, 1, 'delete user lucasmarcelo93@gmail.com', 'Gerenciamento de usuarios', '2019-04-23 17:58:47'),
	(32, 1, 'delete user adm22in@admin.com', 'Gerenciamento de usuarios', '2019-04-23 17:58:50'),
	(33, 1, 'delete user lucasmarcelo193@gmail.com', 'Gerenciamento de usuarios', '2019-04-23 17:58:54'),
	(34, 1, 'delete user lucasmarcelo93@gmail.com', 'Gerenciamento de usuarios', '2019-04-23 18:02:54'),
	(35, 1, 'delete user lucasmarcelo93@gmail.com', 'Gerenciamento de usuarios', '2019-04-23 18:04:11'),
	(36, 1, 'add new user lucasmarcelo93@gmail.com', 'Gerenciamento de usuarios', '2019-04-23 18:04:25'),
	(37, 1, 'delete user lucasmarcelo93@gmail.com', 'Gerenciamento de usuarios', '2019-05-13 22:42:19'),
	(38, 1, 'delete game ', 'Gerenciamento de jogos', '2019-05-13 22:47:49'),
	(39, 1, 'delete game ', 'Gerenciamento de jogos', '2019-05-13 22:47:57'),
	(40, 1, 'delete game Grand%20Theft%20Auto%20V', 'Gerenciamento de jogos', '2019-05-13 22:48:24');
/*!40000 ALTER TABLE `log_atv` ENABLE KEYS */;

-- Copiando estrutura para tabela luckadmin.plataformas
CREATE TABLE IF NOT EXISTS `plataformas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '0',
  `img_url` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela luckadmin.plataformas: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `plataformas` DISABLE KEYS */;
INSERT INTO `plataformas` (`id`, `nome`, `img_url`) VALUES
	(1, 'Playstation', '0'),
	(2, 'Playstation 2', '0'),
	(3, 'Playstation 3', '0'),
	(4, 'Playstation 4', '0'),
	(5, 'PSP', '0'),
	(6, 'PSVITA', '0');
/*!40000 ALTER TABLE `plataformas` ENABLE KEYS */;

-- Copiando estrutura para tabela luckadmin.publishers
CREATE TABLE IF NOT EXISTS `publishers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela luckadmin.publishers: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `publishers` DISABLE KEYS */;
INSERT INTO `publishers` (`id`, `nome`) VALUES
	(1, 'Electronic Arts');
/*!40000 ALTER TABLE `publishers` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- Copiando dados para a tabela luckadmin.usuario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`user_id`, `email`, `senha`, `nome`, `grupo`, `status`, `criado_em`, `atualizado_em`, `url_img`) VALUES
	(1, 'admin@admin.com', 'f6fdffe48c908deb0f4c3bd36c032e72', 'Lucass', 'admin', 1, '2017-01-12 12:07:57', '2019-05-13 17:45:21', 'https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png'),
	(16, 'lucasmarcelo193@gmail.com', 'f6fdffe48c908deb0f4c3bd36c032e72', 'lucas soares XXXX', 'user', 1, '2019-04-22 22:43:40', '2019-05-13 17:43:45', 'https://avatarfiles.alphacoders.com/623/62373.jpg');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
