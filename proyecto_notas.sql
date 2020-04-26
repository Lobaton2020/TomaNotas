

create database proyecto_notas;
use proyecto_notas;

CREATE TABLE   Usuario (
  Id_Usuario INT(11) NOT NULL AUTO_INCREMENT,
  Nombre_Usuario VARCHAR(50) DEFAULT NULL,
  Apellido_Usuario VARCHAR(50) DEFAULT NULL,
  Correo_Usuario VARCHAR(100) NOT NULL,
  Clave_Usuario VARCHAR(100) DEFAULT NULL,
  Fecha_Creacion_Usuario VARCHAR(50) DEFAULT NULL,
 PRIMARY KEY (Id_Usuario)
);

CREATE TABLE Notas (
  Id_Notas INT(11) NOT NULL AUTO_INCREMENT,
  Id_Usuario_FK INT(40) DEFAULT NULL,
  Descripcion_Notas VARCHAR(1000) DEFAULT NULL,
  Fecha_Notas VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (Id_Notas),
  FOREIGN KEY (Id_Usuario_FK) REFERENCES Usuario (Id_Usuario)
);


-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2019 a las 19:09:27
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_notas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `Id_Notas` INT(11) NOT NULL,
  `Id_Usuario_FK` INT(40) DEFAULT NULL,
  `Descripcion_Notas` VARCHAR(1000) DEFAULT NULL,
  `Fecha_Notas` VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_Usuario` INT(11) NOT NULL,
  `Nombre_Usuario` VARCHAR(50) DEFAULT NULL,
  `Apellido_Usuario` VARCHAR(50) DEFAULT NULL,
  `Correo_Usuario` VARCHAR(100) NOT NULL,
  `Clave_Usuario` VARCHAR(100) DEFAULT NULL,
  `Fecha_Creacion_Usuario` VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`Id_Notas`),
  ADD KEY `Id_Usuario_FK` (`Id_Usuario_FK`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `Id_Notas` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_Usuario` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`Id_Usuario_FK`) REFERENCES `usuario` (`Id_Usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
