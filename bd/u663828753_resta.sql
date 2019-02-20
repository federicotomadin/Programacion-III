-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2019 a las 16:06:05
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

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
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id_empleado` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id_empleado`, `calificacion`) VALUES
(3, 1),
(3, 5),
(4, 3),
(3, 2),
(3, 5),
(3, 5),
(12, 1),
(3, 2),
(4, 3),
(47, 1),
(2, 2),
(3, 2),
(3, 5),
(3, 1),
(47, 5),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `Id_cliente` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellido` varchar(20) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `Id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`Id_cliente`, `Nombre`, `Apellido`, `Usuario`, `clave`, `Id_rol`) VALUES
(1, 'Pedro', 'Mendoza', 'pmendoza', 'd41d8cd98f00b204e9800998ecf8427e', 6),
(2, 'Daiana', 'Ojeda', 'dojeda', 'd41d8cd98f00b204e9800998ecf8427e', 6);

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
(47, 'Martin', 'Reinoso', 'mreinoso', '1234', 4, 20000, 1);

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
(1, 'Pendiente'),
(2, 'Listo Para Servir'),
(3, 'Cancelado');

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

--
-- Volcado de datos para la tabla `lista_pedidos`
--

INSERT INTO `lista_pedidos` (`Id_pedido`, `Id_producto`, `Id_rol`, `Id_estadoPedido`, `CodigoMesa`, `Cantidad`, `Precio`) VALUES
(65, 3, 1, 2, 'abc11', 2, 200),
(65, 2, 2, 2, 'abc11', 1, 180);

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
(68, '2019-02-05 00:23:11', 1, 47),
(69, '2019-02-05 00:27:37', 3, 47),
(70, '2019-02-11 21:31:39', 1, 47),
(71, '2019-02-11 21:32:28', 1, 47),
(72, '2019-02-11 21:32:42', 2, 47),
(73, '2019-02-11 21:32:47', 3, 47),
(74, '2019-02-11 21:51:53', 3, 47),
(75, '2019-02-11 21:53:05', 3, 47),
(76, '2019-02-11 21:58:01', 3, 47),
(77, '2019-02-11 22:02:16', 3, 47),
(78, '2019-02-11 22:03:22', 3, 47),
(79, '2019-02-11 22:08:32', 3, 47),
(80, '2019-02-11 22:09:47', 3, 47),
(81, '2019-02-11 22:10:40', 3, 47),
(82, '2019-02-11 22:12:34', 3, 47),
(83, '2019-02-11 22:15:05', 3, 47),
(84, '2019-02-11 22:15:15', 1, 47),
(85, '2019-02-11 22:18:32', 3, 47),
(86, '2019-02-11 22:19:05', 3, 47),
(87, '2019-02-11 22:19:10', 1, 47),
(88, '2019-02-11 22:19:49', 3, 47),
(89, '2019-02-11 22:19:57', 2, 47),
(90, '2019-02-11 22:24:11', 3, 47),
(91, '2019-02-11 22:24:45', 3, 47),
(92, '2019-02-11 22:24:51', 1, 47),
(93, '2019-02-11 22:25:14', 1, 47),
(94, '2019-02-11 22:25:27', 3, 47),
(95, '2019-02-11 22:26:33', 3, 47),
(96, '2019-02-11 22:29:16', 3, 47),
(97, '2019-02-11 22:29:35', 3, 47),
(98, '2019-02-11 22:30:51', 3, 47),
(99, '2019-02-11 22:30:56', 1, 47),
(100, '2019-02-11 22:32:31', 3, 47),
(101, '2019-02-11 22:33:28', 3, 47),
(102, '2019-02-11 22:34:45', 3, 47),
(103, '2019-02-11 22:34:49', 1, 47),
(104, '2019-02-11 22:35:28', 3, 47),
(105, '2019-02-11 22:36:17', 1, 47),
(106, '2019-02-11 22:37:09', 3, 47),
(107, '2019-02-11 22:38:59', 3, 47),
(108, '2019-02-11 22:39:20', 1, 47),
(109, '2019-02-11 22:40:23', 1, 47),
(110, '2019-02-11 22:40:54', 1, 47),
(111, '2019-02-11 22:42:34', 1, 47),
(112, '2019-02-11 22:42:39', 1, 47),
(113, '2019-02-11 22:43:13', 3, 47),
(114, '2019-02-11 22:43:18', 1, 47),
(115, '2019-02-11 23:22:41', 1, 47),
(116, '2019-02-11 23:30:49', 3, 47),
(117, '2019-02-11 23:30:54', 1, 47),
(118, '2019-02-11 23:31:28', 1, 47),
(119, '2019-02-11 23:32:22', 3, 47),
(120, '2019-02-11 23:33:30', 1, 47),
(121, '2019-02-11 23:35:55', 1, 47),
(122, '2019-02-11 23:36:00', 1, 47),
(123, '2019-02-11 23:38:59', 3, 47),
(124, '2019-02-12 18:33:56', 2, 47),
(125, '2019-02-12 18:34:47', 1, 47),
(126, '2019-02-12 18:45:29', 1, 47),
(127, '2019-02-12 18:52:21', 1, 4),
(128, '2019-02-12 18:54:15', 1, 4),
(129, '2019-02-12 20:13:30', 3, 47),
(130, '2019-02-12 20:13:51', 2, 47),
(131, '2019-02-12 20:15:08', 3, 12),
(132, '2019-02-12 20:16:31', 2, 3),
(133, '2019-02-12 20:18:32', 3, 12),
(134, '2019-02-12 20:19:40', 2, 47),
(135, '2019-02-12 20:24:05', 2, 3),
(136, '2019-02-13 04:22:25', 3, 47),
(137, '2019-02-13 04:22:38', 2, 47),
(138, '2019-02-13 04:23:22', 2, 3),
(139, '2019-02-13 04:23:53', 3, 12),
(140, '2019-02-13 04:24:33', 3, 12),
(141, '2019-02-13 04:25:22', 2, 47),
(142, '2019-02-13 04:25:54', 2, 3),
(143, '2019-02-18 01:23:28', 1, 47),
(144, '2019-02-18 01:23:40', 2, 47),
(145, '2019-02-18 01:29:52', 2, 3),
(146, '2019-02-18 01:30:01', 2, 3),
(147, '2019-02-18 01:30:26', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `Id_pedido` int(11) NOT NULL,
  `Tiempo_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Tiempo_estimado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Tiempo_llegadaMesa` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `EstadoCuenta` varchar(20) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `CodigoMesa` varchar(5) DEFAULT NULL,
  `Importe` float DEFAULT NULL,
  `foto` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`Id_pedido`, `Tiempo_ingreso`, `Tiempo_estimado`, `Tiempo_llegadaMesa`, `EstadoCuenta`, `Usuario`, `CodigoMesa`, `Importe`, `foto`) VALUES
(65, '2019-02-18 01:55:15', '0000-00-00 00:00:00', '2019-02-18 01:30:26', 'Cerrada', 'mreinoso', 'abc11', 380, '../fotosPedidosCambiadas/1abc11.png');

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
(1, 'Asado de Tira', 'Asado de ternera ', 290, 3),
(3, 'Caipiroshka', 'Vodka - lima- azucar - hielo', 100, 1),
(2, 'Cerveza Red', 'Cerveza Tirada IBU 40% ALC 30%', 180, 2);

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
(284, 1, '12/07/2018 5:50 AM', NULL),
(285, 1, '12/29/2018 3:35 PM', '12/29/2018 5:08 PM'),
(286, 2, '12/29/2018 5:46 PM', '01/26/2019 8:43 PM'),
(287, 2, '01/27/2019 11:27 PM', NULL),
(288, 2, '01/27/2019 11:27 PM', NULL),
(289, 2, '01/27/2019 11:27 PM', NULL),
(290, 2, '01/27/2019 11:29 PM', NULL),
(291, 2, '01/27/2019 11:29 PM', NULL),
(292, 2, '01/27/2019 11:30 PM', NULL),
(293, 1, '01/27/2019 11:30 PM', NULL),
(294, 1, '01/27/2019 11:32 PM', NULL),
(295, 1, '01/27/2019 11:32 PM', NULL),
(296, 2, '01/27/2019 11:33 PM', NULL),
(297, 1, '01/27/2019 11:37 PM', NULL),
(298, 1, '01/27/2019 11:39 PM', NULL),
(299, 1, '01/27/2019 11:41 PM', NULL),
(300, 1, '01/27/2019 11:41 PM', NULL),
(301, 1, '01/27/2019 11:42 PM', NULL),
(302, 2, '01/27/2019 11:43 PM', NULL),
(303, 1, '01/27/2019 11:44 PM', NULL),
(304, 1, '01/27/2019 11:47 PM', NULL),
(305, 1, '01/27/2019 11:47 PM', NULL),
(306, 1, '01/27/2019 11:51 PM', NULL),
(307, 1, '01/27/2019 11:52 PM', NULL),
(308, 1, '01/27/2019 11:52 PM', NULL),
(309, 1, '01/27/2019 11:53 PM', NULL),
(310, 1, '01/27/2019 11:53 PM', NULL),
(311, 2, '01/27/2019 11:58 PM', NULL),
(312, 1, '01/27/2019 11:58 PM', '01/27/2019 11:59 PM'),
(313, 47, '02/01/2019 8:33 PM', '02/01/2019 8:33 PM'),
(314, 1, '02/02/2019 8:22 PM', '02/03/2019 4:47 PM'),
(315, 47, '02/03/2019 4:48 PM', NULL),
(316, 47, '02/04/2019 9:20 PM', '02/04/2019 9:27 PM'),
(317, 47, '02/04/2019 9:27 PM', NULL),
(318, 1, '02/04/2019 9:46 PM', '02/04/2019 9:46 PM'),
(319, 47, '02/04/2019 9:46 PM', NULL),
(320, 47, '02/11/2019 6:31 PM', '02/11/2019 6:51 PM'),
(321, 47, '02/11/2019 6:51 PM', '02/11/2019 8:37 PM'),
(322, 1, '02/11/2019 8:37 PM', '02/11/2019 8:37 PM'),
(323, 47, '02/11/2019 8:38 PM', '02/11/2019 8:40 PM'),
(324, 1, '02/11/2019 8:40 PM', '02/11/2019 8:41 PM'),
(325, 47, '02/11/2019 8:41 PM', '02/12/2019 3:33 PM'),
(326, 47, '02/12/2019 3:33 PM', '02/12/2019 3:45 PM'),
(327, 4, '02/12/2019 3:46 PM', NULL),
(328, 4, '02/12/2019 3:50 PM', '02/12/2019 3:51 PM'),
(329, 47, '02/12/2019 3:51 PM', '02/12/2019 3:52 PM'),
(330, 4, '02/12/2019 3:52 PM', '02/12/2019 3:52 PM'),
(331, 1, '02/12/2019 3:52 PM', '02/12/2019 3:52 PM'),
(332, 47, '02/12/2019 3:52 PM', '02/12/2019 3:53 PM'),
(333, 1, '02/12/2019 3:53 PM', '02/12/2019 3:54 PM'),
(334, 4, '02/12/2019 3:54 PM', '02/12/2019 3:54 PM'),
(335, 47, '02/12/2019 3:54 PM', '02/12/2019 3:55 PM'),
(336, 1, '02/12/2019 3:55 PM', NULL),
(337, 1, '02/12/2019 3:58 PM', '02/12/2019 4:01 PM'),
(338, 47, '02/12/2019 4:01 PM', '02/12/2019 4:03 PM'),
(339, 1, '02/12/2019 4:03 PM', '02/12/2019 4:11 PM'),
(340, 47, '02/12/2019 4:11 PM', '02/12/2019 4:14 PM'),
(341, 47, '02/12/2019 4:14 PM', '02/12/2019 4:15 PM'),
(342, 47, '02/12/2019 4:15 PM', '02/12/2019 4:18 PM'),
(343, 47, '02/12/2019 4:18 PM', '02/12/2019 4:18 PM'),
(344, 47, '02/12/2019 4:18 PM', '02/12/2019 4:22 PM'),
(345, 47, '02/12/2019 4:23 PM', '02/12/2019 4:24 PM'),
(346, 47, '02/12/2019 4:24 PM', '02/12/2019 4:25 PM'),
(347, 47, '02/12/2019 4:25 PM', '02/12/2019 5:14 PM'),
(348, 12, '02/12/2019 5:14 PM', '02/12/2019 5:15 PM'),
(349, 47, '02/12/2019 5:15 PM', '02/12/2019 5:16 PM'),
(350, 3, '02/12/2019 5:16 PM', '02/12/2019 5:16 PM'),
(351, 47, '02/12/2019 5:17 PM', '02/12/2019 5:17 PM'),
(352, 2, '02/12/2019 5:17 PM', '02/12/2019 5:18 PM'),
(353, 12, '02/12/2019 5:18 PM', '02/12/2019 5:18 PM'),
(354, 47, '02/12/2019 5:18 PM', '02/12/2019 5:20 PM'),
(355, 3, '02/12/2019 5:20 PM', '02/12/2019 5:24 PM'),
(356, 47, '02/12/2019 5:24 PM', '02/12/2019 5:26 PM'),
(357, 1, '02/12/2019 5:26 PM', NULL),
(358, 1, '02/12/2019 8:52 PM', NULL),
(359, 1, '02/13/2019 1:20 AM', '02/13/2019 1:22 AM'),
(360, 47, '02/13/2019 1:22 AM', '02/13/2019 1:23 AM'),
(361, 3, '02/13/2019 1:23 AM', '02/13/2019 1:23 AM'),
(362, 12, '02/13/2019 1:23 AM', '02/13/2019 1:24 AM'),
(363, 47, '02/13/2019 1:24 AM', '02/13/2019 1:25 AM'),
(364, 3, '02/13/2019 1:25 AM', '02/13/2019 1:26 AM'),
(365, 47, '02/13/2019 1:26 AM', '02/13/2019 1:27 AM'),
(366, 1, '02/13/2019 1:27 AM', '02/13/2019 11:29 PM'),
(367, 1, '02/13/2019 11:29 PM', '02/14/2019 10:01 PM'),
(368, 1, '02/14/2019 10:07 PM', '02/14/2019 10:07 PM'),
(369, 47, '02/14/2019 10:07 PM', NULL),
(370, 47, '02/14/2019 10:10 PM', '02/15/2019 12:06 AM'),
(371, 1, '02/15/2019 12:06 AM', '02/15/2019 12:17 AM'),
(372, 47, '02/15/2019 12:17 AM', '02/15/2019 12:17 AM'),
(373, 1, '02/15/2019 12:17 AM', '02/15/2019 12:21 AM'),
(374, 1, '02/15/2019 12:22 AM', '02/15/2019 2:02 PM'),
(375, 1, '02/15/2019 2:02 PM', '02/15/2019 2:02 PM'),
(376, 1, '02/15/2019 2:04 PM', NULL),
(377, 1, '02/15/2019 2:23 PM', '02/17/2019 5:51 PM'),
(378, 1, '02/17/2019 5:51 PM', '02/17/2019 5:51 PM'),
(379, 47, '02/17/2019 5:51 PM', '02/17/2019 6:01 PM'),
(380, 1, '02/17/2019 6:01 PM', '02/17/2019 10:14 PM'),
(381, 1, '02/17/2019 10:15 PM', '02/17/2019 10:16 PM'),
(382, 1, '02/17/2019 10:16 PM', '02/17/2019 10:17 PM'),
(383, 1, '02/17/2019 10:18 PM', '02/17/2019 10:19 PM'),
(384, 47, '02/17/2019 10:19 PM', '02/17/2019 10:29 PM'),
(385, 3, '02/17/2019 10:29 PM', '02/17/2019 10:30 PM'),
(386, 4, '02/17/2019 10:30 PM', '02/17/2019 10:30 PM'),
(387, 1, '02/17/2019 10:30 PM', '02/17/2019 10:32 PM'),
(388, 47, '02/17/2019 10:32 PM', '02/17/2019 10:33 PM'),
(389, 1, '02/17/2019 10:33 PM', NULL),
(390, 1, '02/17/2019 10:44 PM', '02/17/2019 10:54 PM'),
(391, 47, '02/17/2019 10:54 PM', '02/17/2019 10:55 PM'),
(392, 1, '02/17/2019 10:55 PM', '02/17/2019 10:55 PM');

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
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Id_cliente`);

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
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `Id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `IdEncuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estadopedidos`
--
ALTER TABLE `estadopedidos`
  MODIFY `Id_estadoPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estado_cuenta_pedidos`
--
ALTER TABLE `estado_cuenta_pedidos`
  MODIFY `Id_estadoCuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `IdOperacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `Id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

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
  MODIFY `IdSesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;

--
-- AUTO_INCREMENT de la tabla `zonas_mesas`
--
ALTER TABLE `zonas_mesas`
  MODIFY `Id_zonaMesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
