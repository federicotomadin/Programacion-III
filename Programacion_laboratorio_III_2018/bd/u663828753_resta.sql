-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2018 a las 03:18:13
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u663828753_resta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Apellido` varchar(40) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `Clave` varchar(20) NOT NULL,
  `Id_rol` int(11) NOT NULL,
  `Sueldo` int(11) NOT NULL,
  `habilitado` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `Nombre`, `Apellido`, `Usuario`, `Clave`, `Id_rol`, `Sueldo`, `habilitado`) VALUES
(1, 'Federico ', 'Tomadin', 'ftomadin', '1234', 5, 0, 1),
(2, 'Alfredo', 'Remus', 'aremus', '1234', 4, 20000, 1),
(3, 'Dario', 'Daroli', 'ddaroli', '1234', 2, 20000, 1),
(4, 'Facundo', 'Saiegh', 'fsaiegh', '1234', 1, 20000, 1),
(12, 'Alberto', 'Tomadin', 'atomadin', '1234', 3, 20000, 1),
(61, 'Martin', 'Reinoso', 'mreinoso', '1234', 4, 20000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `IdEncuesta` int(11) NOT NULL,
  `Mesa` int(11) NOT NULL,
  `Restaurante` int(11) NOT NULL,
  `Mozo` int(11) NOT NULL,
  `Cocinero` int(11) NOT NULL,
  `Descripcion` varchar(66) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`IdEncuesta`, `Mesa`, `Restaurante`, `Mozo`, `Cocinero`, `Descripcion`) VALUES
(1, 6, 10, 9, 3, 'buena atencion'),
(2, 5, 2, 9, 9, 'muy buena atencion'),
(3, 1, 1, 1, 1, 'mala atencion'),
(4, 10, 10, 10, 10, 'excelente atencion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopedidos`
--

CREATE TABLE `estadopedidos` (
  `Id_estadoPedido` int(11) NOT NULL,
  `Descripcion` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estadopedidos`
--

INSERT INTO `estadopedidos` (`Id_estadoPedido`, `Descripcion`) VALUES
(1, 'En Preparacion'),
(2, 'Listo Para Servir'),
(3, 'Cancelado'),
(4, 'Sin Tiempo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_cuenta_pedidos`
--

CREATE TABLE `estado_cuenta_pedidos` (
  `Id_estadoCuenta` int(11) NOT NULL,
  `Descripcion` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_cuenta_pedidos`
--

INSERT INTO `estado_cuenta_pedidos` (`Id_estadoCuenta`, `Descripcion`) VALUES
(1, 'Esperando Pedido'),
(2, 'Comiendo'),
(3, 'Esperando Cierre'),
(4, 'Cerrada'),
(5, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_pedidos`
--

CREATE TABLE `lista_pedidos` (
  `Id_pedido` int(11) DEFAULT NULL,
  `Id_producto` int(11) NOT NULL,
  `Id_rol` int(11) NOT NULL,
  `Id_estadoPedido` int(11) NOT NULL,
  `CodigoMesa` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `Id_mesa` int(11) NOT NULL,
  `CantidadSillas` int(11) NOT NULL,
  `id_zona_mesa` int(11) NOT NULL,
  `CodigoMesa` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`Id_mesa`, `CantidadSillas`, `id_zona_mesa`, `CodigoMesa`) VALUES
(1, 2, 1, 'abc11'),
(2, 2, 1, 'abc12'),
(3, 6, 3, 'abc13'),
(4, 4, 2, 'abc14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE `operaciones` (
  `IdOperacion` int(11) NOT NULL,
  `FechaOperacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Id_rol` int(11) NOT NULL,
  `Id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`IdOperacion`, `FechaOperacion`, `Id_rol`, `Id_empleado`) VALUES
(1, '2018-07-03 04:39:49', 5, 1),
(2, '2018-07-03 04:39:49', 2, 2),
(3, '2018-07-03 04:39:49', 5, 1),
(6, '2018-10-18 23:52:19', 0, 4),
(7, '2018-10-18 23:53:10', 1, 4),
(9, '2018-10-19 00:15:42', 3, 12),
(10, '2018-12-06 22:11:47', 1, 4),
(11, '2018-12-06 22:58:06', 4, 2),
(12, '2018-12-06 22:58:41', 4, 2),
(13, '2018-12-06 22:59:14', 4, 2),
(14, '2018-12-06 23:03:52', 4, 2),
(15, '2018-12-06 23:05:49', 4, 2),
(16, '2018-12-06 23:07:10', 4, 2),
(17, '2018-12-07 01:52:34', 4, 2),
(18, '2018-12-07 03:29:11', 3, 12),
(19, '2018-12-07 03:29:22', 3, 12),
(20, '2018-12-07 03:39:58', 3, 12),
(21, '2018-12-07 03:42:40', 4, 2),
(22, '2018-12-07 04:01:27', 3, 12),
(23, '2018-12-07 04:06:39', 3, 12),
(24, '2018-12-07 04:20:25', 3, 12),
(25, '2018-12-07 04:52:25', 3, 12),
(26, '2018-12-07 04:55:44', 3, 12),
(27, '2018-12-07 04:56:18', 3, 12),
(28, '2018-12-07 04:58:10', 3, 12),
(29, '2018-12-07 04:58:23', 3, 12),
(30, '2018-12-07 04:58:37', 4, 2),
(31, '2018-12-07 04:59:08', 4, 2),
(32, '2018-12-07 04:59:46', 4, 2),
(33, '2018-12-07 05:05:56', 4, 2),
(34, '2018-12-07 05:07:16', 4, 2),
(35, '2018-12-07 05:11:15', 1, 4),
(36, '2018-12-07 05:11:35', 1, 4),
(37, '2018-12-07 05:14:18', 1, 4),
(38, '2018-12-07 05:14:54', 1, 4),
(39, '2018-12-07 05:14:58', 4, 2),
(40, '2018-12-07 05:15:52', 1, 4),
(41, '2018-12-07 05:33:03', 4, 2),
(42, '2018-12-07 05:41:07', 3, 12),
(43, '2018-12-07 05:43:44', 3, 12),
(44, '2018-12-07 05:46:14', 3, 12),
(45, '2018-12-07 05:48:21', 3, 12),
(46, '2018-12-07 05:49:17', 3, 12),
(47, '2018-12-07 05:50:02', 3, 12),
(48, '2018-12-07 05:51:36', 3, 12),
(49, '2018-12-07 05:54:50', 3, 12),
(50, '2018-12-07 05:55:50', 3, 12),
(51, '2018-12-07 05:56:17', 3, 12),
(52, '2018-12-07 05:58:34', 3, 12),
(53, '2018-12-07 06:10:31', 1, 2),
(54, '2018-12-07 07:03:42', 0, 2),
(55, '2018-12-07 07:04:39', 0, 2),
(56, '2018-12-07 07:05:48', 0, 2),
(57, '2018-12-07 07:06:31', 3, 2),
(58, '2018-12-07 07:07:12', 3, 2),
(59, '2018-12-07 07:12:42', 3, 12),
(60, '2018-12-07 07:20:46', 3, 2),
(61, '2018-12-07 07:38:06', 3, 2),
(62, '2018-12-07 07:55:19', 3, 12),
(63, '2018-12-07 07:55:54', 1, 2),
(64, '2018-12-07 07:59:49', 1, 2),
(65, '2018-12-07 08:06:02', 3, 2),
(66, '2018-12-07 08:07:21', 3, 2),
(67, '2018-12-07 08:33:04', 1, 4),
(68, '2018-12-07 08:59:41', 3, 2),
(69, '2018-12-07 09:00:27', 3, 12),
(70, '2018-12-09 14:49:23', 3, 2),
(71, '2018-12-09 14:53:24', 3, 12),
(72, '2018-12-09 14:54:38', 3, 12),
(73, '2018-12-09 14:55:48', 3, 12),
(74, '2018-12-09 14:57:34', 3, 12),
(75, '2018-12-09 15:30:59', 3, 12),
(76, '2018-12-09 15:32:10', 3, 12),
(77, '2018-12-09 15:33:33', 3, 12),
(78, '2018-12-09 15:40:28', 3, 12),
(79, '2018-12-09 15:42:03', 3, 12),
(80, '2018-12-09 15:46:20', 3, 12),
(81, '2018-12-09 15:49:20', 3, 12),
(82, '2018-12-09 15:51:46', 3, 12),
(83, '2018-12-09 16:01:37', 3, 12),
(84, '2018-12-09 16:01:55', 3, 12),
(85, '2018-12-09 16:02:59', 3, 12),
(86, '2018-12-09 16:05:32', 3, 12),
(87, '2018-12-09 16:06:09', 3, 12),
(88, '2018-12-09 16:47:03', 3, 12),
(89, '2018-12-09 16:49:58', 3, 12),
(90, '2018-12-09 17:15:50', 3, 12),
(91, '2018-12-09 17:16:42', 3, 12),
(92, '2018-12-09 17:19:05', 3, 2),
(93, '2018-12-09 17:29:18', 3, 12),
(94, '2018-12-09 17:30:36', 3, 2),
(95, '2018-12-09 17:32:30', 3, 2),
(96, '2018-12-09 18:00:45', 3, 12),
(97, '2018-12-09 18:05:50', 3, 2),
(98, '2018-12-09 18:09:07', 3, 2),
(99, '2018-12-09 18:12:00', 3, 2),
(100, '2018-12-09 18:20:39', 3, 12),
(101, '2018-12-09 18:22:20', 3, 2),
(102, '2018-12-09 19:31:59', 3, 2),
(103, '2018-12-09 19:42:07', 3, 2),
(104, '2018-12-09 19:48:25', 3, 2),
(105, '2018-12-09 20:27:46', 3, 12),
(106, '2018-12-09 20:29:16', 3, 2),
(107, '2018-12-09 20:30:19', 3, 12),
(108, '2018-12-09 20:36:26', 3, 2),
(109, '2018-12-09 20:37:08', 3, 12),
(110, '2018-12-09 20:41:16', 3, 2),
(111, '2018-12-09 20:41:49', 3, 12),
(112, '2018-12-09 20:44:32', 3, 12),
(113, '2018-12-09 20:55:53', 3, 2),
(114, '2018-12-09 20:57:38', 3, 12),
(115, '2018-12-09 20:58:18', 3, 12),
(116, '2018-12-09 21:59:28', 1, 2),
(117, '2018-12-09 22:00:47', 1, 4),
(118, '2018-12-09 22:01:34', 1, 4),
(119, '2018-12-09 22:07:40', 3, 12),
(120, '2018-12-10 00:26:39', 2, 2),
(121, '2018-12-10 00:33:24', 2, 2),
(122, '2018-12-10 00:43:24', 2, 2),
(123, '2018-12-10 00:44:20', 1, 2),
(124, '2018-12-10 00:45:50', 1, 4),
(125, '2018-12-10 00:46:37', 1, 4),
(126, '2018-12-10 01:48:04', 2, 2),
(127, '2018-12-10 01:48:41', 2, 3),
(128, '2018-12-10 01:54:03', 2, 2),
(129, '2018-12-10 01:55:00', 2, 3),
(130, '2018-12-10 01:55:34', 2, 3),
(131, '2018-12-11 23:54:11', 1, 2),
(132, '2018-12-11 23:55:36', 1, 2),
(133, '2018-12-12 00:32:44', 1, 2),
(134, '2018-12-12 00:34:33', 3, 2),
(135, '2018-12-12 00:51:26', 3, 2),
(136, '2018-12-12 00:52:01', 1, 2),
(137, '2018-12-12 00:53:26', 3, 12),
(138, '2018-12-12 02:05:58', 1, 4),
(139, '2018-12-12 03:48:06', 1, 2),
(140, '2018-12-12 03:51:39', 1, 4),
(141, '2018-12-12 04:00:28', 1, 2),
(142, '2018-12-12 04:04:44', 1, 4),
(143, '2018-12-12 04:32:17', 2, 2),
(144, '2018-12-12 04:32:48', 2, 3),
(145, '2018-12-12 04:33:00', 2, 3),
(146, '2018-12-12 04:43:16', 2, 2),
(147, '2018-12-12 04:43:45', 2, 3),
(148, '2018-12-12 04:43:53', 2, 3),
(149, '2018-12-12 04:52:26', 3, 2),
(150, '2018-12-12 04:52:59', 2, 2),
(151, '2018-12-12 04:56:22', 2, 2),
(152, '2018-12-12 04:58:49', 2, 2),
(153, '2018-12-12 05:00:00', 2, 3),
(154, '2018-12-12 05:00:35', 2, 3),
(155, '2018-12-12 23:24:09', 1, 2),
(156, '2018-12-12 23:26:51', 1, 4),
(157, '2018-12-12 23:27:32', 1, 4),
(158, '2018-12-12 23:35:47', 1, 2),
(159, '2018-12-12 23:36:21', 1, 4),
(160, '2018-12-12 23:36:29', 1, 4),
(161, '2018-12-13 00:20:13', 2, 61),
(162, '2018-12-13 00:22:04', 1, 2),
(163, '2018-12-13 00:22:11', 2, 2),
(164, '2018-12-13 00:22:17', 3, 2),
(165, '2018-12-13 00:52:32', 2, 3),
(166, '2018-12-13 01:59:25', 3, 12),
(167, '2018-12-13 02:03:55', 2, 3),
(168, '2018-12-13 02:04:16', 3, 12),
(169, '2018-12-13 02:05:17', 1, 4),
(170, '2018-12-13 02:05:35', 2, 3),
(171, '2018-12-13 02:06:34', 1, 4),
(172, '2018-12-13 02:06:56', 3, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `Id_pedido` int(11) NOT NULL,
  `Tiempo_ingreso` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Tiempo_estimado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Tiempo_llegadaMesa` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `EstadoCuenta` varchar(20) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `CodigoMesa` varchar(5) DEFAULT NULL,
  `Importe` float DEFAULT NULL,
  `foto` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Precio` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `Nombre`, `Descripcion`, `Precio`, `id_rol`) VALUES
(1, 'Asado de Tira', 'Asado de tira', 300, 3),
(3, 'Caipiroshka', 'Vodka - lima- azucar - hielo', 100, 1),
(2, 'Cerveza Red', 'Cerveza Tirada', 180, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `Id_rol` int(11) NOT NULL,
  `descripcion` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`Id_rol`, `descripcion`) VALUES
(1, 'Bartender'),
(2, 'Cervecero'),
(3, 'Cocinero'),
(4, 'Mozo'),
(5, 'Socio'),
(6, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `IdSesion` int(11) NOT NULL,
  `IdEmpleado` int(11) NOT NULL,
  `FechaIngreso` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `FechaSalida` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`IdSesion`, `IdEmpleado`, `FechaIngreso`, `FechaSalida`) VALUES
(238, 12, '12/06/2018 6:58 PM', '12/06/2018 7:02 PM'),
(239, 2, '12/06/2018 7:02 PM', NULL),
(240, 4, '12/06/2018 7:11 PM', '12/06/2018 7:25 PM'),
(241, 3, '12/06/2018 7:25 PM', '12/06/2018 7:30 PM'),
(242, 12, '12/06/2018 7:30 PM', '12/06/2018 7:30 PM'),
(243, 2, '12/06/2018 7:31 PM', '12/06/2018 7:32 PM'),
(244, 2, '12/06/2018 7:41 PM', '12/06/2018 7:43 PM'),
(245, 12, '12/06/2018 7:43 PM', '12/06/2018 7:43 PM'),
(246, 2, '12/06/2018 7:44 PM', '12/06/2018 7:58 PM'),
(247, 2, '12/06/2018 7:59 PM', '12/06/2018 7:59 PM'),
(248, 1, '12/06/2018 8:00 PM', '12/06/2018 8:06 PM'),
(249, 2, '12/06/2018 8:06 PM', '12/06/2018 11:00 PM'),
(250, 12, '12/06/2018 11:00 PM', '12/06/2018 11:07 PM'),
(251, 2, '12/06/2018 11:07 PM', '12/06/2018 11:30 PM'),
(252, 1, '12/06/2018 11:30 PM', '12/06/2018 11:32 PM'),
(253, 1, '12/06/2018 11:32 PM', '12/06/2018 11:38 PM'),
(254, 2, '12/06/2018 11:38 PM', NULL),
(255, 1, '12/07/2018 12:11 AM', '12/07/2018 12:27 AM'),
(256, 1, '12/07/2018 12:27 AM', '12/07/2018 12:28 AM'),
(257, 12, '12/07/2018 12:28 AM', '12/07/2018 12:34 AM'),
(258, 2, '12/07/2018 12:34 AM', '12/07/2018 12:38 AM'),
(259, 12, '12/07/2018 12:38 AM', '12/07/2018 12:40 AM'),
(260, 2, '12/07/2018 12:42 AM', '12/07/2018 2:08 AM'),
(261, 2, '12/07/2018 2:09 AM', '12/07/2018 2:10 AM'),
(262, 4, '12/07/2018 2:11 AM', NULL),
(263, 4, '12/07/2018 2:11 AM', '12/07/2018 2:40 AM'),
(264, 2, '12/07/2018 2:40 AM', '12/07/2018 2:40 AM'),
(265, 12, '12/07/2018 2:40 AM', '12/07/2018 2:49 AM'),
(266, 2, '12/07/2018 2:49 AM', '12/07/2018 2:49 AM'),
(267, 12, '12/07/2018 2:49 AM', '12/07/2018 2:52 AM'),
(268, 12, '12/07/2018 2:54 AM', '12/07/2018 2:59 AM'),
(269, 1, '12/07/2018 3:00 AM', '12/07/2018 3:05 AM'),
(270, 2, '12/07/2018 3:07 AM', '12/07/2018 4:12 AM'),
(271, 12, '12/07/2018 4:12 AM', '12/07/2018 4:12 AM'),
(272, 2, '12/07/2018 4:12 AM', '12/07/2018 4:13 AM'),
(273, 1, '12/07/2018 4:13 AM', '12/07/2018 4:20 AM'),
(274, 2, '12/07/2018 4:20 AM', '12/07/2018 4:37 AM'),
(275, 2, '12/07/2018 4:37 AM', '12/07/2018 4:40 AM'),
(276, 12, '12/07/2018 4:40 AM', '12/07/2018 4:43 AM'),
(277, 2, '12/07/2018 4:43 AM', '12/07/2018 4:55 AM'),
(278, 12, '12/07/2018 4:55 AM', '12/07/2018 4:55 AM'),
(279, 2, '12/07/2018 4:55 AM', '12/07/2018 5:32 AM'),
(280, 4, '12/07/2018 5:32 AM', '12/07/2018 5:33 AM'),
(281, 2, '12/07/2018 5:33 AM', '12/07/2018 5:33 AM'),
(282, 1, '12/07/2018 5:33 AM', NULL),
(283, 1, '12/07/2018 5:35 AM', '12/07/2018 5:50 AM'),
(284, 1, '12/07/2018 5:50 AM', '12/07/2018 5:59 AM'),
(285, 2, '12/07/2018 5:59 AM', '12/07/2018 6:00 AM'),
(286, 12, '12/07/2018 6:00 AM', '12/07/2018 6:00 AM'),
(287, 2, '12/07/2018 6:00 AM', '12/07/2018 6:01 AM'),
(288, 1, '12/07/2018 6:01 AM', '12/08/2018 4:09 PM'),
(289, 1, '12/08/2018 4:09 PM', '12/08/2018 4:09 PM'),
(290, 2, '12/08/2018 4:09 PM', '12/08/2018 5:44 PM'),
(291, 12, '12/08/2018 5:44 PM', '12/09/2018 10:39 AM'),
(292, 2, '12/09/2018 10:39 AM', '12/09/2018 10:44 AM'),
(293, 12, '12/09/2018 10:44 AM', '12/09/2018 11:44 AM'),
(294, 2, '12/09/2018 11:44 AM', '12/09/2018 11:50 AM'),
(295, 12, '12/09/2018 11:50 AM', NULL),
(296, 12, '12/09/2018 11:53 AM', '12/09/2018 2:18 PM'),
(297, 2, '12/09/2018 2:18 PM', '12/09/2018 2:19 PM'),
(298, 2, '12/09/2018 2:19 PM', '12/09/2018 2:19 PM'),
(299, 12, '12/09/2018 2:20 PM', '12/09/2018 2:20 PM'),
(300, 2, '12/09/2018 2:20 PM', '12/09/2018 2:21 PM'),
(301, 12, '12/09/2018 2:21 PM', NULL),
(302, 2, '12/09/2018 2:25 PM', NULL),
(303, 12, '12/09/2018 2:27 PM', '12/09/2018 2:29 PM'),
(304, 2, '12/09/2018 2:29 PM', '12/09/2018 2:30 PM'),
(305, 2, '12/09/2018 2:30 PM', '12/09/2018 2:32 PM'),
(306, 12, '12/09/2018 2:32 PM', NULL),
(307, 12, '12/09/2018 2:41 PM', '12/09/2018 3:05 PM'),
(308, 2, '12/09/2018 3:05 PM', '12/09/2018 3:06 PM'),
(309, 2, '12/09/2018 3:06 PM', '12/09/2018 3:17 PM'),
(310, 12, '12/09/2018 3:17 PM', '12/09/2018 3:17 PM'),
(311, 2, '12/09/2018 3:17 PM', '12/09/2018 3:18 PM'),
(312, 12, '12/09/2018 3:18 PM', '12/09/2018 3:22 PM'),
(313, 2, '12/09/2018 3:22 PM', '12/09/2018 3:23 PM'),
(314, 12, '12/09/2018 3:23 PM', '12/09/2018 4:16 PM'),
(315, 12, '12/09/2018 4:16 PM', '12/09/2018 4:18 PM'),
(316, 2, '12/09/2018 4:18 PM', '12/09/2018 4:29 PM'),
(317, 12, '12/09/2018 4:29 PM', '12/09/2018 4:30 PM'),
(318, 2, '12/09/2018 4:30 PM', '12/09/2018 4:32 PM'),
(319, 12, '12/09/2018 4:32 PM', '12/09/2018 4:41 PM'),
(320, 2, '12/09/2018 4:42 PM', '12/09/2018 4:59 PM'),
(321, 12, '12/09/2018 4:59 PM', NULL),
(322, 12, '12/09/2018 5:21 PM', '12/09/2018 5:29 PM'),
(323, 2, '12/09/2018 5:29 PM', '12/09/2018 5:29 PM'),
(324, 12, '12/09/2018 5:29 PM', '12/09/2018 5:36 PM'),
(325, 2, '12/09/2018 5:36 PM', '12/09/2018 5:36 PM'),
(326, 12, '12/09/2018 5:36 PM', '12/09/2018 5:38 PM'),
(327, 2, '12/09/2018 5:38 PM', '12/09/2018 5:41 PM'),
(328, 12, '12/09/2018 5:41 PM', '12/09/2018 5:44 PM'),
(329, 2, '12/09/2018 5:44 PM', '12/09/2018 5:44 PM'),
(330, 12, '12/09/2018 5:44 PM', '12/09/2018 5:44 PM'),
(331, 2, '12/09/2018 5:44 PM', '12/09/2018 5:57 PM'),
(332, 12, '12/09/2018 5:57 PM', '12/09/2018 5:58 PM'),
(333, 2, '12/09/2018 5:58 PM', '12/09/2018 6:30 PM'),
(334, 1, '12/09/2018 6:30 PM', '12/09/2018 6:59 PM'),
(335, 2, '12/09/2018 6:59 PM', '12/09/2018 7:00 PM'),
(336, 4, '12/09/2018 7:00 PM', '12/09/2018 7:01 PM'),
(337, 2, '12/09/2018 7:01 PM', '12/09/2018 7:03 PM'),
(338, 1, '12/09/2018 7:03 PM', NULL),
(339, 1, '12/09/2018 8:43 PM', '12/09/2018 8:52 PM'),
(340, 4, '12/09/2018 8:52 PM', '12/09/2018 8:59 PM'),
(341, 12, '12/09/2018 8:59 PM', '12/09/2018 9:07 PM'),
(342, 4, '12/09/2018 9:07 PM', '12/09/2018 9:07 PM'),
(343, 3, '12/09/2018 9:07 PM', '12/09/2018 9:09 PM'),
(344, 3, '12/09/2018 9:09 PM', '12/09/2018 9:15 PM'),
(345, 4, '12/09/2018 9:17 PM', '12/09/2018 9:20 PM'),
(346, 4, '12/09/2018 9:20 PM', '12/09/2018 9:21 PM'),
(347, 4, '12/09/2018 9:21 PM', '12/09/2018 9:25 PM'),
(348, 2, '12/09/2018 9:25 PM', '12/09/2018 9:28 PM'),
(349, 4, '12/09/2018 9:28 PM', '12/09/2018 9:29 PM'),
(350, 3, '12/09/2018 9:29 PM', NULL),
(351, 3, '12/09/2018 9:31 PM', '12/09/2018 9:33 PM'),
(352, 2, '12/09/2018 9:33 PM', '12/09/2018 9:34 PM'),
(353, 3, '12/09/2018 9:34 PM', '12/09/2018 9:35 PM'),
(354, 4, '12/09/2018 9:35 PM', '12/09/2018 9:41 PM'),
(355, 2, '12/09/2018 9:43 PM', '12/09/2018 9:43 PM'),
(356, 3, '12/09/2018 9:43 PM', '12/09/2018 9:44 PM'),
(357, 2, '12/09/2018 9:44 PM', '12/09/2018 9:45 PM'),
(358, 4, '12/09/2018 9:45 PM', '12/09/2018 9:46 PM'),
(359, 2, '12/09/2018 9:46 PM', '12/09/2018 9:46 PM'),
(360, 4, '12/09/2018 9:46 PM', '12/09/2018 9:46 PM'),
(361, 2, '12/09/2018 9:46 PM', '12/09/2018 9:47 PM'),
(362, 4, '12/09/2018 9:47 PM', '12/09/2018 10:47 PM'),
(363, 2, '12/09/2018 10:47 PM', '12/09/2018 10:48 PM'),
(364, 3, '12/09/2018 10:48 PM', '12/09/2018 10:48 PM'),
(365, 2, '12/09/2018 10:48 PM', '12/09/2018 10:54 PM'),
(366, 3, '12/09/2018 10:54 PM', '12/09/2018 10:55 PM'),
(367, 2, '12/09/2018 10:55 PM', '12/09/2018 10:55 PM'),
(368, 3, '12/09/2018 10:55 PM', '12/09/2018 10:55 PM'),
(369, 2, '12/09/2018 10:55 PM', '12/09/2018 10:55 PM'),
(370, 1, '12/09/2018 10:56 PM', '12/11/2018 8:26 PM'),
(371, 1, '12/11/2018 8:26 PM', '12/11/2018 8:26 PM'),
(372, 2, '12/11/2018 8:26 PM', NULL),
(373, 2, '12/11/2018 8:48 PM', '12/11/2018 9:37 PM'),
(374, 1, '12/11/2018 9:37 PM', '12/11/2018 9:39 PM'),
(375, 1, '12/11/2018 9:39 PM', '12/11/2018 9:39 PM'),
(376, 2, '12/11/2018 9:39 PM', '12/11/2018 9:40 PM'),
(377, 1, '12/11/2018 9:40 PM', '12/11/2018 9:50 PM'),
(378, 2, '12/11/2018 9:50 PM', '12/11/2018 9:53 PM'),
(379, 12, '12/11/2018 9:53 PM', '12/11/2018 9:53 PM'),
(380, 4, '12/11/2018 9:53 PM', NULL),
(381, 4, '12/11/2018 9:56 PM', '12/11/2018 11:04 PM'),
(382, 12, '12/11/2018 11:04 PM', '12/11/2018 11:05 PM'),
(383, 4, '12/11/2018 11:05 PM', '12/11/2018 11:06 PM'),
(384, 12, '12/11/2018 11:06 PM', '12/11/2018 11:09 PM'),
(385, 1, '12/11/2018 11:09 PM', '12/11/2018 11:09 PM'),
(386, 2, '12/11/2018 11:10 PM', '12/11/2018 11:14 PM'),
(387, 1, '12/11/2018 11:14 PM', '12/12/2018 12:45 AM'),
(388, 2, '12/12/2018 12:45 AM', '12/12/2018 12:48 AM'),
(389, 4, '12/12/2018 12:48 AM', '12/12/2018 12:51 AM'),
(390, 2, '12/12/2018 12:52 AM', '12/12/2018 12:53 AM'),
(391, 4, '12/12/2018 12:53 AM', '12/12/2018 12:55 AM'),
(392, 2, '12/12/2018 12:55 AM', '12/12/2018 1:01 AM'),
(393, 4, '12/12/2018 1:01 AM', '12/12/2018 1:04 AM'),
(394, 2, '12/12/2018 1:04 AM', '12/12/2018 1:05 AM'),
(395, 1, '12/12/2018 1:05 AM', NULL),
(396, 1, '12/12/2018 1:17 AM', '12/12/2018 1:32 AM'),
(397, 2, '12/12/2018 1:32 AM', '12/12/2018 1:32 AM'),
(398, 3, '12/12/2018 1:32 AM', '12/12/2018 1:33 AM'),
(399, 2, '12/12/2018 1:33 AM', '12/12/2018 1:43 AM'),
(400, 3, '12/12/2018 1:43 AM', '12/12/2018 1:43 AM'),
(401, 2, '12/12/2018 1:44 AM', '12/12/2018 1:56 AM'),
(402, 2, '12/12/2018 1:56 AM', '12/12/2018 1:56 AM'),
(403, 3, '12/12/2018 1:56 AM', '12/12/2018 1:57 AM'),
(404, 4, '12/12/2018 1:57 AM', '12/12/2018 1:57 AM'),
(405, 3, '12/12/2018 1:57 AM', '12/12/2018 1:58 AM'),
(406, 2, '12/12/2018 1:58 AM', '12/12/2018 1:59 AM'),
(407, 3, '12/12/2018 1:59 AM', '12/12/2018 2:00 AM'),
(408, 2, '12/12/2018 2:00 AM', '12/12/2018 2:00 AM'),
(409, 3, '12/12/2018 2:00 AM', '12/12/2018 2:00 AM'),
(410, 2, '12/12/2018 2:00 AM', '12/12/2018 8:23 PM'),
(411, 2, '12/12/2018 8:23 PM', '12/12/2018 8:26 PM'),
(412, 4, '12/12/2018 8:26 PM', '12/12/2018 8:26 PM'),
(413, 2, '12/12/2018 8:26 PM', '12/12/2018 8:27 PM'),
(414, 4, '12/12/2018 8:27 PM', '12/12/2018 8:27 PM'),
(415, 2, '12/12/2018 8:27 PM', '12/12/2018 8:36 PM'),
(416, 4, '12/12/2018 8:36 PM', '12/12/2018 8:36 PM'),
(417, 2, '12/12/2018 8:36 PM', '12/12/2018 8:37 PM'),
(418, 1, '12/12/2018 8:37 PM', '12/12/2018 8:38 PM'),
(419, 1, '12/12/2018 8:38 PM', '12/12/2018 8:40 PM'),
(420, 1, '12/12/2018 9:19 PM', '12/12/2018 9:19 PM'),
(421, 61, '12/12/2018 9:19 PM', '12/12/2018 9:20 PM'),
(422, 2, '12/12/2018 9:21 PM', '12/12/2018 9:22 PM'),
(423, 12, '12/12/2018 9:22 PM', '12/12/2018 9:23 PM'),
(424, 3, '12/12/2018 9:23 PM', NULL),
(425, 3, '12/12/2018 9:26 PM', '12/12/2018 9:52 PM'),
(426, 4, '12/12/2018 9:52 PM', NULL),
(427, 3, '12/12/2018 10:16 PM', NULL),
(428, 3, '12/12/2018 10:18 PM', '12/12/2018 10:57 PM'),
(429, 3, '12/12/2018 10:57 PM', '12/12/2018 10:57 PM'),
(430, 12, '12/12/2018 10:57 PM', '12/12/2018 10:59 PM'),
(431, 3, '12/12/2018 11:00 PM', '12/12/2018 11:04 PM'),
(432, 12, '12/12/2018 11:04 PM', '12/12/2018 11:04 PM'),
(433, 2, '12/12/2018 11:04 PM', '12/12/2018 11:04 PM'),
(434, 4, '12/12/2018 11:05 PM', '12/12/2018 11:05 PM'),
(435, 3, '12/12/2018 11:05 PM', '12/12/2018 11:05 PM'),
(436, 2, '12/12/2018 11:05 PM', '12/12/2018 11:06 PM'),
(437, 4, '12/12/2018 11:06 PM', '12/12/2018 11:06 PM'),
(438, 12, '12/12/2018 11:06 PM', '12/12/2018 11:07 PM'),
(439, 2, '12/12/2018 11:07 PM', '12/12/2018 11:08 PM'),
(440, 1, '12/12/2018 11:08 PM', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas_mesas`
--

CREATE TABLE `zonas_mesas` (
  `Id_zonaMesa` int(11) NOT NULL,
  `Descripcion` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `zonas_mesas`
--

INSERT INTO `zonas_mesas` (`Id_zonaMesa`, `Descripcion`) VALUES
(1, 'Entrada'),
(2, 'Patio Trasero'),
(3, 'Piso Principal');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `Id_rol` (`Id_rol`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`IdEncuesta`);

--
-- Indices de la tabla `estadopedidos`
--
ALTER TABLE `estadopedidos`
  ADD PRIMARY KEY (`Id_estadoPedido`);

--
-- Indices de la tabla `estado_cuenta_pedidos`
--
ALTER TABLE `estado_cuenta_pedidos`
  ADD PRIMARY KEY (`Id_estadoCuenta`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`Id_mesa`);

--
-- Indices de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD PRIMARY KEY (`IdOperacion`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`Id_pedido`),
  ADD KEY `Id_estadoCuenta` (`EstadoCuenta`),
  ADD KEY `Id_legajo` (`Usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_rol_empleado` (`id_rol`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id_rol`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`IdSesion`);

--
-- Indices de la tabla `zonas_mesas`
--
ALTER TABLE `zonas_mesas`
  ADD PRIMARY KEY (`Id_zonaMesa`),
  ADD KEY `Id_zonaMesa` (`Id_zonaMesa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `IdEncuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `estadopedidos`
--
ALTER TABLE `estadopedidos`
  MODIFY `Id_estadoPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `estado_cuenta_pedidos`
--
ALTER TABLE `estado_cuenta_pedidos`
  MODIFY `Id_estadoCuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `IdOperacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `Id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `Id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `IdSesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=441;
--
-- AUTO_INCREMENT de la tabla `zonas_mesas`
--
ALTER TABLE `zonas_mesas`
  MODIFY `Id_zonaMesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
