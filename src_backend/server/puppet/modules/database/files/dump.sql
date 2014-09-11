-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 02, 2014 at 12:20 AM
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
-- Table structure for table `tb_categorias`
--

CREATE TABLE IF NOT EXISTS `tb_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `ordem` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_categorias`
--

INSERT INTO `tb_categorias` (`id`, `nome`, `slug`, `ordem`, `descricao`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hospitais', 'hospitais', 1, '', '2014-08-29 22:51:46', '2014-08-29 22:51:46', '0000-00-00 00:00:00'),
(2, 'Clínicas', 'clinicas', 2, '', '2014-08-29 22:51:54', '2014-08-29 22:51:54', '0000-00-00 00:00:00'),
(3, 'Unimed', 'unimed', 3, '', '2014-08-29 22:52:20', '2014-08-29 22:52:20', '0000-00-00 00:00:00'),
(4, 'Plano Diretor', 'plano-diretor', 4, '', '2014-08-29 22:52:31', '2014-08-29 22:52:39', '0000-00-00 00:00:00'),
(5, 'Retrofit', 'retrofit', 5, '', '2014-08-29 22:52:51', '2014-08-29 22:52:56', '0000-00-00 00:00:00'),
(6, 'Ambientação', 'ambientacao', 6, '', '2014-08-29 22:53:15', '2014-08-29 22:53:15', '0000-00-00 00:00:00');

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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
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
  `publicado` date DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `descricao` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tb_noticias`
--

INSERT INTO `tb_noticias` (`id`, `titulo`, `slug`, `tipo`, `publicado`, `video`, `descricao`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Emed arquitetura hospitalar completa 24 anos com grandiosos projetos', 'emed-arquitetura-hospitalar-completa-24-anos-com-grandiosos-projetos', 'Saúde Online', '2014-08-16', 'dRV4hiXfenU', 'descricao', '0000-00-00 00:00:00', '2014-09-01 23:23:51', '0000-00-00 00:00:00'),
(2, 'Titulo da Noticia', 'titulo-da-noticia', 'tipo dela', '2014-09-10', 'dRV4hiXfenU', 'descrição', '2014-08-19 07:30:44', '2014-09-01 23:24:06', '0000-00-00 00:00:00'),
(3, 'Emed arquitetura hospitalar completa 24 anos com grandiosos projetos', 'emed-arquitetura-hospitalar-completa-24-anos-com-grandiosos-projetos', 'Saúde Online', '2014-08-16', 'dRV4hiXfenU', 'descricao', '0000-00-00 00:00:00', '2014-09-01 23:23:54', '0000-00-00 00:00:00'),
(4, 'Emed arquitetura hospitalar completa 24 anos com grandiosos projetos', 'emed-arquitetura-hospitalar-completa-24-anos-com-grandiosos-projetos', 'Saúde Online', '2014-08-16', 'dRV4hiXfenU', 'descricao', '0000-00-00 00:00:00', '2014-09-01 23:23:56', '0000-00-00 00:00:00'),
(5, 'Emed arquitetura hospitalar completa 24 anos com grandiosos projetos', 'emed-arquitetura-hospitalar-completa-24-anos-com-grandiosos-projetos', 'Saúde Online', '2014-08-16', 'dRV4hiXfenU', 'descricao', '0000-00-00 00:00:00', '2014-09-01 23:23:59', '0000-00-00 00:00:00'),
(6, 'Emed arquitetura hospitalar completa 24 anos com grandiosos projetos', 'emed-arquitetura-hospitalar-completa-24-anos-com-grandiosos-projetos', 'Saúde Online', '2014-08-16', 'dRV4hiXfenU', 'descricao', '0000-00-00 00:00:00', '2014-09-01 23:24:01', '0000-00-00 00:00:00'),
(7, 'Emed arquitetura hospitalar completa 24 anos com grandiosos projetos', 'emed-arquitetura-hospitalar-completa-24-anos-com-grandiosos-projetos', 'Saúde Online', '2014-08-16', 'dRV4hiXfenU', 'descricao', '0000-00-00 00:00:00', '2014-09-01 23:24:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_photos`
--

CREATE TABLE IF NOT EXISTS `tb_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `connection_id` int(11) NOT NULL,
  `connection_type` varchar(50) NOT NULL,
  `path` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `tb_photos`
--

INSERT INTO `tb_photos` (`id`, `connection_id`, `connection_type`, `path`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Portfolio', 'emed-noticias-portfolio-teste-cadastro-1.jpg', 'desc noticia', '0000-00-00 00:00:00', '2014-08-29 22:56:32', '2014-08-29 22:56:32'),
(2, 2, 'Portfolio', 'emed-portfolio-portfolio-teste-cadastro-2.jpg', 'desc 2', '0000-00-00 00:00:00', '2014-08-29 22:56:26', '2014-08-29 22:56:26'),
(3, 2, 'Noticias', 'dsc_0274web.jpg', 'Teste este stest etsteste', '2014-08-23 18:33:31', '2014-08-29 22:56:30', '2014-08-29 22:56:30'),
(4, 2, 'Portfolio', 'emed-portfolio-portfolio-teste-cadastro-4.jpg', 'testeste', '2014-08-23 23:36:09', '2014-08-29 22:56:28', '2014-08-29 22:56:28'),
(5, 0, '', 'EMED-PALMAS-02.jpg', '', '2014-08-29 22:57:52', '2014-08-29 23:08:04', '2014-08-29 23:08:04'),
(6, 3, 'Portfolio', 'emed-portfolio-palmas-6.jpg', 'Descrição Foto', '2014-08-29 22:58:19', '2014-08-31 21:30:47', '0000-00-00 00:00:00'),
(7, 4, '', 'Intermédica Zona Sul.jpg', '', '2014-08-29 23:08:22', '2014-08-29 23:08:41', '2014-08-29 23:08:41'),
(8, 4, 'Portfolio', 'emed-portfolio-intermedica-zona-sul-8.jpg', '', '2014-08-29 23:08:36', '2014-08-31 21:28:47', '0000-00-00 00:00:00'),
(9, 5, 'Portfolio', 'emed-portfolio-hospital-municipal-dos-pimentas-bonsucesso-9.png', '', '2014-08-31 19:37:59', '2014-08-31 21:31:19', '0000-00-00 00:00:00'),
(10, 2, 'Portfolio', 'emed-portfolio-sao-camilo-10.jpg', '', '2014-08-31 19:45:42', '2014-08-31 21:31:08', '0000-00-00 00:00:00'),
(11, 6, 'Portfolio', 'emed-portfolio-unimed-anapolis-11.jpg', '', '2014-08-31 19:46:33', '2014-08-31 21:30:58', '0000-00-00 00:00:00'),
(12, 7, 'Portfolio', 'emed-portfolio-sos-cardio-servicos-hospitalares-ltda-12.jpg', '', '2014-08-31 19:47:34', '2014-08-31 21:30:03', '0000-00-00 00:00:00'),
(13, 8, 'Portfolio', 'emed-portfolio-unimed-tres-pontas-apto-duplo-13.jpg', '', '2014-08-31 20:01:30', '2014-08-31 20:01:30', '0000-00-00 00:00:00'),
(14, 9, 'Portfolio', 'emed-portfolio-unimed-tres-pontas-apto-simples-14.jpg', '', '2014-08-31 20:01:53', '2014-08-31 20:01:53', '0000-00-00 00:00:00'),
(15, 10, 'Portfolio', 'emed-portfolio-unimed-tres-pontas-cafe-15.jpg', '', '2014-08-31 20:02:14', '2014-08-31 20:02:14', '0000-00-00 00:00:00'),
(16, 11, 'Portfolio', 'emed-portfolio-unimed-tres-pontas-hr-16.jpg', '', '2014-08-31 20:02:33', '2014-08-31 20:02:33', '0000-00-00 00:00:00'),
(17, 12, 'Portfolio', 'emed-portfolio-unimed-paulista-17.jpg', '', '2014-08-31 20:03:18', '2014-08-31 20:03:18', '0000-00-00 00:00:00'),
(18, 13, 'Portfolio', 'emed-portfolio-unimed-uti-18.jpg', '', '2014-08-31 20:04:38', '2014-08-31 20:29:58', '0000-00-00 00:00:00'),
(19, 14, 'Portfolio', 'emed-portfolio-cassems-19.jpg', '', '2014-08-31 20:13:02', '2014-08-31 20:13:02', '0000-00-00 00:00:00'),
(20, 15, 'Portfolio', 'emed-portfolio-caratin-20.jpg', '', '2014-08-31 20:13:11', '2014-08-31 20:13:11', '0000-00-00 00:00:00'),
(21, 16, 'Portfolio', 'emed-portfolio-hnsn-21.jpg', '', '2014-08-31 20:13:24', '2014-08-31 20:13:24', '0000-00-00 00:00:00'),
(22, 17, 'Portfolio', 'emed-portfolio-hospital-sao-francisco-22.jpg', '', '2014-08-31 20:13:33', '2014-08-31 20:13:33', '0000-00-00 00:00:00'),
(23, 18, 'Portfolio', 'emed-portfolio-instituo-sao-francisco-23.jpg', '', '2014-08-31 20:13:43', '2014-08-31 20:13:43', '0000-00-00 00:00:00'),
(24, 19, 'Portfolio', 'emed-portfolio-unimed-costa-do-sol-24.jpg', '', '2014-08-31 20:13:57', '2014-08-31 20:13:57', '0000-00-00 00:00:00'),
(25, 20, 'Portfolio', 'emed-portfolio-hm-renas-25.jpg', '', '2014-08-31 20:16:30', '2014-08-31 20:16:30', '0000-00-00 00:00:00'),
(26, 21, 'Portfolio', 'emed-portfolio-santa-helena-26.jpg', '', '2014-08-31 20:16:42', '2014-08-31 20:16:42', '0000-00-00 00:00:00'),
(27, 22, 'Portfolio', 'emed-portfolio-fornecedores-de-cana-27.jpg', '', '2014-08-31 20:17:01', '2014-08-31 20:17:02', '0000-00-00 00:00:00'),
(28, 24, 'Portfolio', 'emed-portfolio-sem-nome-28.jpg', '', '2014-08-31 20:17:13', '2014-08-31 20:26:52', '2014-08-31 20:26:52'),
(29, 25, 'Portfolio', 'emed-portfolio-unimed-volta-redonda-29.jpg', '', '2014-08-31 20:17:27', '2014-08-31 20:17:27', '0000-00-00 00:00:00'),
(30, 26, 'Portfolio', 'emed-portfolio-nova-iguacu-30.jpg', '', '2014-08-31 20:22:41', '2014-09-02 00:19:58', '0000-00-00 00:00:00'),
(31, 27, 'Portfolio', 'emed-portfolio-governador-valadares-31.jpg', '', '2014-08-31 20:22:54', '2014-08-31 20:22:54', '0000-00-00 00:00:00'),
(32, 28, 'Portfolio', 'emed-portfolio-juiz-de-fora-32.jpg', '', '2014-08-31 20:23:03', '2014-08-31 20:23:03', '0000-00-00 00:00:00'),
(33, 29, 'Portfolio', 'emed-portfolio-marques-de-valenca-33.jpg', '', '2014-08-31 20:23:14', '2014-08-31 20:23:14', '0000-00-00 00:00:00'),
(34, 30, 'Portfolio', 'emed-portfolio-resende-34.jpg', '', '2014-08-31 20:23:28', '2014-08-31 20:23:28', '0000-00-00 00:00:00'),
(35, 31, 'Portfolio', 'emed-portfolio-sao-leopoldo-35.jpg', '', '2014-08-31 20:23:39', '2014-08-31 20:23:39', '0000-00-00 00:00:00'),
(36, 23, 'Portfolio', 'emed-portfolio-hospital-sao-rafael-36.jpg', '', '2014-08-31 20:24:52', '2014-08-31 20:24:52', '0000-00-00 00:00:00'),
(37, 24, 'Portfolio', 'emed-portfolio-sem-nome-37.jpg', '', '2014-08-31 20:25:15', '2014-08-31 20:26:34', '0000-00-00 00:00:00'),
(38, 32, 'Portfolio', 'emed-portfolio-cuiaba-olhos-38.jpg', '', '2014-08-31 20:33:22', '2014-08-31 20:33:22', '0000-00-00 00:00:00'),
(39, 33, 'Portfolio', 'emed-portfolio-dr-bongiovani-39.jpg', '', '2014-08-31 20:33:37', '2014-08-31 20:33:37', '0000-00-00 00:00:00'),
(40, 34, 'Portfolio', 'emed-portfolio-oncolinica-40.jpg', '', '2014-08-31 20:33:50', '2014-08-31 20:33:50', '0000-00-00 00:00:00'),
(41, 35, 'Portfolio', 'emed-portfolio-clinitrauma-41.jpg', '', '2014-08-31 20:34:00', '2014-08-31 20:34:00', '0000-00-00 00:00:00'),
(42, 36, 'Portfolio', 'emed-portfolio-fleury-alphaville-42.jpg', '', '2014-08-31 20:34:09', '2014-08-31 20:34:09', '0000-00-00 00:00:00'),
(43, 37, 'Portfolio', 'emed-portfolio-oncorad-43.jpg', '', '2014-08-31 20:34:19', '2014-08-31 20:34:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_portfolio`
--

CREATE TABLE IF NOT EXISTS `tb_portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `categoria_id` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(255) NOT NULL,
  `localizacao` varchar(200) DEFAULT NULL,
  `ano` varchar(50) DEFAULT NULL,
  `metragem` varchar(50) DEFAULT NULL,
  `descricao` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `tb_portfolio`
--

INSERT INTO `tb_portfolio` (`id`, `titulo`, `categoria_id`, `slug`, `localizacao`, `ano`, `metragem`, `descricao`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Portfolio 1', 16, 'portfolio-1', 'local', 'ano', 'metro', 'DESC', '0000-00-00 00:00:00', '2014-08-14 19:01:00', '2014-08-14 19:01:00'),
(2, 'São Camilo', 1, 'sao-camilo', 'local', 'ano', 'metro', 'desc', '2014-08-14 19:09:00', '2014-08-31 19:45:30', '0000-00-00 00:00:00'),
(3, 'Palmas', 1, 'palmas', 'Local', 'Ano', 'Metrage', 'Desc', '2014-08-29 22:56:19', '2014-08-29 22:56:19', '0000-00-00 00:00:00'),
(4, 'Intermédica Zona Sul', 1, 'intermedica-zona-sul', 'Local', 'Ano', 'Metragem', 'Descrição\r\ntest\r\n\r\nquebra de l\r\ninha', '2014-08-29 23:07:38', '2014-08-29 23:39:06', '0000-00-00 00:00:00'),
(5, 'Hospital Municipal dos Pimentas Bonsucesso', 1, 'hospital-municipal-dos-pimentas-bonsucesso', 'local', 'ano', 'metragem', '', '2014-08-31 19:37:45', '2014-08-31 19:37:45', '0000-00-00 00:00:00'),
(6, 'Unimed Anápolis', 1, 'unimed-anapolis', 'Local', 'Ano', 'Metro', '', '2014-08-31 19:46:17', '2014-08-31 19:46:17', '0000-00-00 00:00:00'),
(7, 'S.O.S. Cardio Serviços Hospitalares LTDA', 1, 'sos-cardio-servicos-hospitalares-ltda', 'local', 'ano', '2000', 'desc', '2014-08-31 19:47:24', '2014-08-31 19:47:24', '0000-00-00 00:00:00'),
(8, 'Unimed Três Pontas - Apto. Duplo', 6, 'unimed-tres-pontas-apto-duplo', 'Três Pontas', '2009', 'metros', 'desc', '2014-08-31 19:55:47', '2014-08-31 19:55:47', '0000-00-00 00:00:00'),
(9, 'Unimed Três Pontas - Apto. Simples', 6, 'unimed-tres-pontas-apto-simples', 'Três Pontas', '2009', 'metros', 'desc', '2014-08-31 19:56:10', '2014-08-31 20:05:24', '0000-00-00 00:00:00'),
(10, 'Unimed Três Pontas - Café', 6, 'unimed-tres-pontas-cafe', 'Três Pontas', '2009', '200', 'Desc', '2014-08-31 19:56:34', '2014-08-31 19:56:34', '0000-00-00 00:00:00'),
(11, 'Unimed Três Pontas - HR', 6, 'unimed-tres-pontas-hr', 'Três Pontas', '2009', 'Metro', 'desc', '2014-08-31 19:57:08', '2014-08-31 19:57:08', '0000-00-00 00:00:00'),
(12, 'Unimed Paulista', 6, 'unimed-paulista', 'São Paulo', '2005', '300', 'Desc', '2014-08-31 19:57:37', '2014-08-31 19:57:37', '0000-00-00 00:00:00'),
(13, 'Unimed UTI', 6, 'unimed-uti', 'Resende', '2000', '50', 'Desc', '2014-08-31 20:01:08', '2014-08-31 20:01:08', '0000-00-00 00:00:00'),
(14, 'Cassems', 4, 'cassems', 'Local', 'Ano', 'Metragem', 'Desc', '2014-08-31 20:08:42', '2014-08-31 20:08:42', '0000-00-00 00:00:00'),
(15, 'Caratin', 4, 'caratin', 'local', 'ano', 'metros', 'desc', '2014-08-31 20:09:01', '2014-08-31 20:09:01', '0000-00-00 00:00:00'),
(16, 'HNSN', 4, 'hnsn', 'local', 'ano', 'metros', 'desc', '2014-08-31 20:09:17', '2014-08-31 20:09:17', '0000-00-00 00:00:00'),
(17, 'Hospital São Francisco', 4, 'hospital-sao-francisco', 'Local', 'ano', 'metros', 'desc', '2014-08-31 20:09:31', '2014-08-31 20:09:31', '0000-00-00 00:00:00'),
(18, 'Instituo São Francisco', 4, 'instituo-sao-francisco', 'Local', 'Ano', 'Metragem', 'Desc', '2014-08-31 20:09:59', '2014-08-31 20:09:59', '0000-00-00 00:00:00'),
(19, 'Unimed Costa do Sol', 4, 'unimed-costa-do-sol', 'Macaé', '1999', 'Metros', 'Desc', '2014-08-31 20:10:24', '2014-08-31 20:10:24', '0000-00-00 00:00:00'),
(20, 'HM Renas', 5, 'hm-renas', 'local', '2001', '22', '', '2014-08-31 20:14:44', '2014-08-31 20:14:44', '0000-00-00 00:00:00'),
(21, 'Santa Helena', 5, 'santa-helena', 'local', '2002', 'metros', 'desc', '2014-08-31 20:15:02', '2014-08-31 20:15:02', '0000-00-00 00:00:00'),
(22, 'Fornecedores de Cana', 5, 'fornecedores-de-cana', 'local', 'ano', 'metros', 'desc', '2014-08-31 20:15:17', '2014-08-31 20:15:17', '0000-00-00 00:00:00'),
(23, 'Hospital São Rafael', 5, 'hospital-sao-rafael', 'São Paulo - SP', '2002', 'metros', 'desc', '2014-08-31 20:15:41', '2014-08-31 20:15:41', '0000-00-00 00:00:00'),
(24, 'Hospital Austa', 5, 'hospital-austa', 'local', 'ano', 'metros', '', '2014-08-31 20:15:56', '2014-08-31 20:27:19', '0000-00-00 00:00:00'),
(25, 'Unimed Volta Redonda', 5, 'unimed-volta-redonda', 'Volta Redonda', 'Ano', 'metros', 'desc', '2014-08-31 20:16:13', '2014-08-31 20:16:13', '0000-00-00 00:00:00'),
(26, 'Nova Iguaçu', 3, 'nova-iguacu', 'Local', 'Ano', 'Metragem', 'Desc', '2014-08-31 20:20:02', '2014-08-31 20:20:02', '0000-00-00 00:00:00'),
(27, 'Governador Valadares', 3, 'governador-valadares', 'Governador valadares', '2003', '11', '1', '2014-08-31 20:20:35', '2014-08-31 20:20:35', '0000-00-00 00:00:00'),
(28, 'Juiz de Fora', 3, 'juiz-de-fora', 'Juiz de Fora - MG', '2004', 'Metros', 'df', '2014-08-31 20:20:57', '2014-08-31 20:20:57', '0000-00-00 00:00:00'),
(29, 'Marques de Valença', 3, 'marques-de-valenca', 'local', '1999', 'metros', 'desc', '2014-08-31 20:21:17', '2014-08-31 20:21:17', '0000-00-00 00:00:00'),
(30, 'Resende', 3, 'resende', 'Resende - MG', '2001', '111', '', '2014-08-31 20:21:37', '2014-08-31 20:21:37', '0000-00-00 00:00:00'),
(31, 'São Leopoldo', 3, 'sao-leopoldo', 'Local', '1996', 'Metros', 'Desc', '2014-08-31 20:22:01', '2014-08-31 20:22:01', '0000-00-00 00:00:00'),
(32, 'Cuiabá Olhos', 2, 'cuiaba-olhos', 'Cuiabá', '2014', 'Metros', 'Desc', '2014-08-31 20:31:30', '2014-08-31 20:31:30', '0000-00-00 00:00:00'),
(33, 'Dr. Bongiovani', 2, 'dr-bongiovani', 'local', 'ano', 'metros', 'desc', '2014-08-31 20:31:49', '2014-08-31 20:31:49', '0000-00-00 00:00:00'),
(34, 'Onclínica', 2, 'onclinica', 'local', 'ano', 'metros', 'desc', '2014-08-31 20:32:03', '2014-08-31 20:34:50', '0000-00-00 00:00:00'),
(35, 'Clinitrauma', 2, 'clinitrauma', 'local', 'ano', 'metros', 'desc', '2014-08-31 20:32:23', '2014-08-31 20:32:23', '0000-00-00 00:00:00'),
(36, 'Fleury Alphaville', 2, 'fleury-alphaville', 'Alphaville - SP', 'ano', 'metros', 'desc', '2014-08-31 20:32:41', '2014-08-31 20:32:41', '0000-00-00 00:00:00'),
(37, 'Oncorad', 2, 'oncorad', 'Local', 'Ano', 'metros', 'desc', '2014-08-31 20:32:59', '2014-08-31 20:32:59', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
