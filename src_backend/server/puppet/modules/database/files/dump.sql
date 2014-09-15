-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 15, 2014 at 11:34 PM
-- Server version: 5.5.38
-- PHP Version: 5.5.16-1+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vagrant_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `contato`
--

CREATE TABLE IF NOT EXISTS `contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `mensagem` text CHARACTER SET latin1 NOT NULL,
  `ip` varchar(30) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `estrutura`
--

CREATE TABLE IF NOT EXISTS `estrutura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `icone` varchar(100) CHARACTER SET latin1 NOT NULL,
  `descricao` text CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `etapas`
--

CREATE TABLE IF NOT EXISTS `etapas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET latin1 NOT NULL,
  `slug` varchar(255) CHARACTER SET latin1 NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime NOT NULL,
  `localizacao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `retirada` varchar(100) CHARACTER SET latin1 NOT NULL,
  `regulamento_arquivo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `regulamento` text CHARACTER SET latin1 NOT NULL,
  `manual` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cor` varchar(7) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `etapas_estrutura`
--

CREATE TABLE IF NOT EXISTS `etapas_estrutura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etapas_id` int(11) NOT NULL,
  `estrutura_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `etapas_id` (`etapas_id`,`estrutura_id`),
  KEY `estrutura_id` (`estrutura_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `etapas_fotos`
--

CREATE TABLE IF NOT EXISTS `etapas_fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etapas_id` int(11) NOT NULL,
  `fotos_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `etapas_id` (`etapas_id`,`fotos_id`),
  KEY `fotos_id` (`fotos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fotos`
--

CREATE TABLE IF NOT EXISTS `fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caminho` varchar(255) CHARACTER SET latin1 NOT NULL,
  `titulo` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `descricao` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `imprensa`
--

CREATE TABLE IF NOT EXISTS `imprensa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `descricao` text CHARACTER SET latin1 NOT NULL,
  `thumb` varchar(255) CHARACTER SET latin1 NOT NULL,
  `arquivo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `imprensa`
--

INSERT INTO `imprensa` (`id`, `titulo`, `descricao`, `thumb`, `arquivo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'nome', 'teste', 'asdas', 'asdas', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `etapas_estrutura`
--
ALTER TABLE `etapas_estrutura`
  ADD CONSTRAINT `etapas_estrutura_ibfk_2` FOREIGN KEY (`estrutura_id`) REFERENCES `estrutura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `etapas_estrutura_ibfk_1` FOREIGN KEY (`etapas_id`) REFERENCES `etapas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `etapas_fotos`
--
ALTER TABLE `etapas_fotos`
  ADD CONSTRAINT `etapas_fotos_ibfk_2` FOREIGN KEY (`fotos_id`) REFERENCES `fotos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `etapas_fotos_ibfk_1` FOREIGN KEY (`etapas_id`) REFERENCES `etapas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
