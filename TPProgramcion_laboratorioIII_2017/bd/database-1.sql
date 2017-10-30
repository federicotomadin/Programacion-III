-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2017 a las 15:06:34
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auto`
--

CREATE TABLE `auto` (
  `id` int(10) NOT NULL,
  `patente` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `color` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `auto`
--

INSERT INTO `auto` (`id`, `patente`, `marca`, `color`) VALUES
(1, 'AAA 111', 'Ford', 'Azul'),
(2, 'BBB 222', 'Fiat', 'Rojo'),
(3, 'CCC 333', 'Audi', 'Negro'),
(4, 'NBV 124', 'Audi', 'Azul'),
(5, 'NBM 241', 'Citroen', 'Rojo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo_empleado`
--

CREATE TABLE `cargo_empleado` (
  `id` int(10) NOT NULL,
  `cargo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cargo_empleado`
--

INSERT INTO `cargo_empleado` (`id`, `cargo`) VALUES
(1, 'Administrador'),
(2, 'Cajero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cochera`
--

CREATE TABLE `cochera` (
  `id` int(10) NOT NULL,
  `numero` int(10) NOT NULL,
  `piso` int(10) NOT NULL,
  `prioridad` bit(1) NOT NULL,
  `idAuto` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cochera`
--

INSERT INTO `cochera` (`id`, `numero`, `piso`, `prioridad`, `idAuto`) VALUES
(1, 1, 1, b'1', NULL),
(2, 2, 1, b'0', NULL),
(3, 3, 2, b'1', NULL),
(4, 4, 2, b'0', NULL),
(5, 5, 3, b'1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(10) NOT NULL,
  `legajo` int(10) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `mail` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `turno` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `cargo` int(10) NOT NULL,
  `habilitado` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `foto` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `legajo`, `nombre`, `apellido`, `mail`, `clave`, `turno`, `cargo`, `habilitado`, `foto`) VALUES
(1, 1, 'Ignacio', 'Sanabria', 'administrador@outlook.com', '1234', 'mañana', 1, 'si', '1IgnacioSanabria.jpg'),
(2, 2, 'Matias', 'Rodriguez', 'empleadouno@gmail.com', 'lala12', 'tarde', 2, 'si', '2MatiasRodriguez.jpg'),
(3, 3, 'Jorge', 'Garcia', 'jorgekpo@gmail.com', 'soyjorge12', 'noche', 2, 'si', '3JorgeGarcia.jpg'),
(4, 4, 'Bruno', 'Hernandez', 'empleadocuarto@outlook.com', 'lala23', 'mañana', 2, 'si', '4BrunoHernandez.jpg'),
(5, 7, 'Franco', 'Alvarez', 'francoempleado@gmail.com', '1234lala', 'noche', 2, 'si', 'Backup/5FrancoAlvarez.jpg'),
(7, 10, 'Ramon', 'Valdez', 'ramonvaldez@gmail.com', 'elchavodel8', 'tarde', 2, 'si', 'defecto.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operacion_entrada`
--

CREATE TABLE `operacion_entrada` (
  `id` int(10) NOT NULL,
  `fecha_ingreso` text COLLATE utf8_spanish2_ci NOT NULL,
  `idAuto` int(10) NOT NULL,
  `idCochera` int(10) NOT NULL,
  `idEmpleado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `operacion_entrada`
--

INSERT INTO `operacion_entrada` (`id`, `fecha_ingreso`, `idAuto`, `idCochera`, `idEmpleado`) VALUES
(23, '07/23/2017 12:58 PM', 1, 1, 1),
(28, '07/23/2017 4:30 PM', 1, 1, 1),
(29, '07/23/2017 4:00 PM', 1, 1, 1),
(30, '07/23/2017 6:47 PM', 1, 4, 1),
(31, '07/21/2017 9:15 AM', 4, 4, 1),
(32, '07/22/2017 10:00 PM', 5, 1, 2),
(33, '07/25/2017 12:33 PM', 1, 2, 1),
(34, '07/25/2017 1:33 PM', 2, 3, 1),
(35, '07/25/2017 10:33 AM', 3, 4, 1),
(36, '07/25/2017 1:34 PM', 4, 2, 1),
(37, '07/26/2017  4:27 PM', 2, 2, 1),
(39, '07/26/2017  7:49 PM', 3, 4, 1),
(40, '07/28/2017 5:00 PM', 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operacion_salida`
--

CREATE TABLE `operacion_salida` (
  `id` int(10) NOT NULL,
  `fecha_salida` text COLLATE utf8_spanish2_ci,
  `idOperacionEntrada` int(10) NOT NULL,
  `importe` int(10) NOT NULL,
  `idEmpleado` int(10) DEFAULT NULL,
  `idAuto` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `operacion_salida`
--

INSERT INTO `operacion_salida` (`id`, `fecha_salida`, `idOperacionEntrada`, `importe`, `idEmpleado`, `idAuto`) VALUES
(5, '07/23/2017 5:08 PM', 23, 40, 1, 1),
(10, '07/23/2017 5:58 PM', 28, 50, 1, 1),
(11, '07/23/2017 7:44 PM', 29, 30, 1, 1),
(12, '07/23/2017 7:49 PM', 30, 10, 1, 1),
(13, '07/24/2017 11:11 PM', 31, 493, 2, 4),
(14, '07/24/2017 11:12 PM', 32, 350, 2, 5),
(15, '07/25/2017 2:34 PM', 33, 20, 1, 1),
(16, '07/25/2017 2:34 PM', 34, 10, 1, 2),
(17, '07/25/2017 2:34 PM', 35, 40, 1, 3),
(18, '07/25/2017 2:35 PM', 36, 10, 1, 4),
(19, '07/26/2017 5:34 PM', 37, 10, 1, 2),
(21, '07/26/2017 8:56 PM', 39, 10, 1, 3),
(22, '07/28/2017 6:00 PM ', 40, 10, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `id` int(10) NOT NULL,
  `idEmpleado` int(10) NOT NULL,
  `fecha_ingreso` text COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_salida` text COLLATE utf8_spanish2_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`id`, `idEmpleado`, `fecha_ingreso`, `fecha_salida`) VALUES
(35, 1, '07/26/2017  10:07 AM', '07/26/2017  10:08 AM'),
(36, 2, '07/26/2017  10:09 AM', '07/26/2017  10:09 AM'),
(37, 1, '07/26/2017  10:10 AM', '07/26/2017  11:40 AM'),
(38, 1, '07/26/2017  12:15 PM', '07/26/2017  12:17 PM'),
(39, 1, '07/26/2017  12:21 PM', '07/26/2017  17:27 PM'),
(40, 1, '07/26/2017  17:28 PM', '07/26/2017  20:49 PM'),
(41, 1, '07/26/2017  20:50 PM', '07/27/2017  19:12 PM'),
(42, 1, '07/27/2017  19:13 PM', '07/27/2017  22:09 PM'),
(43, 1, '07/28/2017  19:08 PM', '07/29/2017  19:44 PM'),
(44, 1, '07/29/2017  19:47 PM', '07/29/2017  21:28 PM'),
(45, 1, '07/30/2017  12:13 PM', '07/30/2017  12:14 PM'),
(46, 1, '07/30/2017  12:21 PM', '07/30/2017  16:08 PM'),
(47, 1, '07/30/2017  16:42 PM', '07/30/2017  20:22 PM'),
(49, 1, '07/31/2017 10:19 PM', '07/31/2017 10:54 PM');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargo_empleado`
--
ALTER TABLE `cargo_empleado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cochera`
--
ALTER TABLE `cochera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAuto` (`idAuto`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargo` (`cargo`);

--
-- Indices de la tabla `operacion_entrada`
--
ALTER TABLE `operacion_entrada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAuto` (`idAuto`),
  ADD KEY `idCochera` (`idCochera`),
  ADD KEY `idEmpleado` (`idEmpleado`);

--
-- Indices de la tabla `operacion_salida`
--
ALTER TABLE `operacion_salida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idOperacionEntrada` (`idOperacionEntrada`),
  ADD KEY `idEmpleado` (`idEmpleado`),
  ADD KEY `idAuto` (`idAuto`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEmpleado` (`idEmpleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auto`
--
ALTER TABLE `auto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `cochera`
--
ALTER TABLE `cochera`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `operacion_entrada`
--
ALTER TABLE `operacion_entrada`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de la tabla `operacion_salida`
--
ALTER TABLE `operacion_salida`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cochera`
--
ALTER TABLE `cochera`
  ADD CONSTRAINT `cochera_ibfk_1` FOREIGN KEY (`idAuto`) REFERENCES `auto` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`cargo`) REFERENCES `cargo_empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `operacion_entrada`
--
ALTER TABLE `operacion_entrada`
  ADD CONSTRAINT `operacion_entrada_ibfk_3` FOREIGN KEY (`idCochera`) REFERENCES `cochera` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `operacion_entrada_ibfk_5` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `operacion_entrada_ibfk_6` FOREIGN KEY (`idAuto`) REFERENCES `auto` (`id`);

--
-- Filtros para la tabla `operacion_salida`
--
ALTER TABLE `operacion_salida`
  ADD CONSTRAINT `operacion_salida_ibfk_2` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `operacion_salida_ibfk_3` FOREIGN KEY (`idOperacionEntrada`) REFERENCES `operacion_entrada` (`id`);

--
-- Filtros para la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD CONSTRAINT `sesion_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
