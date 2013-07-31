-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2013 at 10:56 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lms`
--
CREATE DATABASE IF NOT EXISTS `lms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lms`;

-- --------------------------------------------------------

--
-- Table structure for table `accion`
--

CREATE TABLE IF NOT EXISTS `accion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controlador_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8DAEE6828CCE72A9` (`controlador_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `accion`
--

INSERT INTO `accion` (`id`, `controlador_id`, `nombre`) VALUES
(1, 1, 'index');

-- --------------------------------------------------------

--
-- Table structure for table `acciones_usuarios`
--

CREATE TABLE IF NOT EXISTS `acciones_usuarios` (
  `rol_id` int(11) NOT NULL,
  `accion_id` int(11) NOT NULL,
  PRIMARY KEY (`rol_id`,`accion_id`),
  KEY `IDX_4ECF69D64BAB96C` (`rol_id`),
  KEY `IDX_4ECF69D63F4B5275` (`accion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acciones_usuarios`
--

INSERT INTO `acciones_usuarios` (`rol_id`, `accion_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `controlador`
--

CREATE TABLE IF NOT EXISTS `controlador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `controlador`
--

INSERT INTO `controlador` (`id`, `nombre`) VALUES
(1, 'Application\\Controller\\Index');

-- --------------------------------------------------------

--
-- Table structure for table `controladores_usuarios`
--

CREATE TABLE IF NOT EXISTS `controladores_usuarios` (
  `rol_id` int(11) NOT NULL,
  `controlador_id` int(11) NOT NULL,
  PRIMARY KEY (`rol_id`,`controlador_id`),
  KEY `IDX_C9DAC4B64BAB96C` (`rol_id`),
  KEY `IDX_C9DAC4B68CCE72A9` (`controlador_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `controladores_usuarios`
--

INSERT INTO `controladores_usuarios` (`rol_id`, `controlador_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_361879D73D8E604F` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `parent`, `nombre`) VALUES
(1, NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`) VALUES
(2, 'gabo', '$2y$14$dmxBemoyMGcyZTcueDhzMu5qpRy9i3McLpccXTbTSU2K.20dLI9f6');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_roles`
--

CREATE TABLE IF NOT EXISTS `usuario_roles` (
  `usuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`,`rol_id`),
  KEY `IDX_ABE044D9DB38439E` (`usuario_id`),
  KEY `IDX_ABE044D94BAB96C` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuario_roles`
--

INSERT INTO `usuario_roles` (`usuario_id`, `rol_id`) VALUES
(2, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accion`
--
ALTER TABLE `accion`
  ADD CONSTRAINT `FK_8DAEE6828CCE72A9` FOREIGN KEY (`controlador_id`) REFERENCES `controlador` (`id`);

--
-- Constraints for table `acciones_usuarios`
--
ALTER TABLE `acciones_usuarios`
  ADD CONSTRAINT `FK_4ECF69D63F4B5275` FOREIGN KEY (`accion_id`) REFERENCES `accion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4ECF69D64BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `controladores_usuarios`
--
ALTER TABLE `controladores_usuarios`
  ADD CONSTRAINT `FK_C9DAC4B64BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C9DAC4B68CCE72A9` FOREIGN KEY (`controlador_id`) REFERENCES `controlador` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rol`
--
ALTER TABLE `rol`
  ADD CONSTRAINT `FK_361879D73D8E604F` FOREIGN KEY (`parent`) REFERENCES `rol` (`id`);

--
-- Constraints for table `usuario_roles`
--
ALTER TABLE `usuario_roles`
  ADD CONSTRAINT `FK_ABE044D94BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ABE044D9DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
