-- phpMyAdmin SQL Dump
-- version 3.4.4
-- http://www.phpmyadmin.net
--
-- Servidor: mysql.webcindario.com
-- Tiempo de generación: 16-10-2019 a las 06:39:39
-- Versión del servidor: 5.6.39
-- Versión de PHP: 5.6.40-10+0~20190807.18+debian9~1.gbp5642bf

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `andreslobaton`
--
CREATE DATABASE `andreslobaton` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `andreslobaton`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Archivos`
--

CREATE TABLE IF NOT EXISTS `Archivos` (
  `id_archivo` int(100) NOT NULL AUTO_INCREMENT,
  `id_usuario_FK` int(11) DEFAULT NULL,
  `nombre_archivo` varchar(500) NOT NULL,
  PRIMARY KEY (`id_archivo`),
  KEY `id_usuario_FK` (`id_usuario_FK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

CREATE TABLE IF NOT EXISTS `notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` mediumtext,
  `fecha` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=138 ;

CREATE TABLE IF NOT EXISTS `usuario` (
  `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Usuario` varchar(200) NOT NULL,
  `Apellido_Usuario` varchar(200) NOT NULL,
  `Correo_Usuario` varchar(200) NOT NULL,
  `Clave_Usuario` varchar(200) NOT NULL,
  PRIMARY KEY (`Id_Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

ALTER TABLE `Archivos`
  ADD CONSTRAINT `Archivos_ibfk_1` FOREIGN KEY (`id_usuario_FK`) REFERENCES `usuario` (`Id_Usuario`),
  ADD CONSTRAINT `Archivos_ibfk_2` FOREIGN KEY (`id_usuario_FK`) REFERENCES `usuario` (`Id_Usuario`);
