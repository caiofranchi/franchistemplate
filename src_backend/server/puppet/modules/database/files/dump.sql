-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2014 at 09:33 PM
-- Server version: 5.5.37
-- PHP Version: 5.5.12-2+deb.sury.org~precise+1

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
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nome`, `email`, `password`) VALUES
(1, 'Admin', 'admin@admin.com.br', '$2a$10$a8c46c1084b868b15d6e1uzd.mPtORvO63gNjXcTcLxyx48rq9c/C');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'GRUPO 1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_categorias`
--

CREATE TABLE IF NOT EXISTS `tb_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `ordem` int(11) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_contato`
--

CREATE TABLE IF NOT EXISTS `tb_contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mensagem` text NOT NULL,
  `curriculo` varchar(255) DEFAULT NULL,
  `ip` varchar(50) NOT NULL,
  `added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_fotos`
--

CREATE TABLE IF NOT EXISTS `tb_fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `portfolio_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_noticias`
--

CREATE TABLE IF NOT EXISTS `tb_noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `publicado` datetime DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `descricao` text NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_portfolio`
--

CREATE TABLE IF NOT EXISTS `tb_portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `localizacao` varchar(200) DEFAULT NULL,
  `ano` varchar(50) DEFAULT NULL,
  `metragem` varchar(50) DEFAULT NULL,
  `descricao` text,
  `added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `nascimento` date NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `groups_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groups_id` (`groups_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `descricao`, `nascimento`, `tipo`, `groups_id`) VALUES
(1, 'Teste Nome 1', 'Descricao 1', '2014-07-08', 'tal', 1),
(2, 'Nome 2', 'Descricao 2', '2014-07-18', 'tal', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
