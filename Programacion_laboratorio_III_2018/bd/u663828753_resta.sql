-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2018 a las 22:07:17
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
(12, 'Alberto', 'Tomadin', 'atomadin', '1234', 3, 20000, 1);

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
(1, 'esperandoPedido'),
(2, 'comiendo'),
(3, 'pagando'),
(4, 'cerrada'),
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
  `Precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `lista_pedidos`
--

INSERT INTO `lista_pedidos` (`Id_pedido`, `Id_producto`, `Id_rol`, `Id_estadoPedido`, `CodigoMesa`, `Precio`) VALUES
(44, 1, 3, 1, 'abc11', 230),
(45, 3, 1, 1, 'abc12', 100),
(46, 2, 2, 1, 'abc13', 90),
(47, 4, 2, 1, 'abc14', 120);

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
(4, '2018-07-28 23:42:00', 0, 10),
(5, '2018-07-28 23:42:00', 0, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `Id_pedido` int(11) NOT NULL,
  `Tiempo_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Tiempo_estimado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Tiempo_llegadaMesa` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `Id_estadoCuenta` int(11) NOT NULL,
  `Id_empleado` int(11) NOT NULL,
  `CodigoMesa` varchar(5) DEFAULT NULL,
  `Importe` float DEFAULT NULL,
  `foto` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`Id_pedido`, `Tiempo_ingreso`, `Tiempo_estimado`, `Tiempo_llegadaMesa`, `Id_estadoCuenta`, `Id_empleado`, `CodigoMesa`, `Importe`, `foto`) VALUES
(47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2, 'abc14', 0, '../fotosPedidosCambiadas/47abc14.png'),
(46, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2, 'abc13', 0, '../fotosPedidosCambiadas/46abc13.png'),
(44, '2018-10-16 17:46:53', '2018-10-16 18:16:53', '0000-00-00 00:00:00', 1, 2, 'abc11', 0, '../fotosPedidosCambiadas/1abc11.png'),
(45, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2, 'abc12', 0, '../fotosPedidosCambiadas/45abc12.png');

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
(1, 'Asado de Tira', 'Porcíon abudante, para 2 personas', 230, 3),
(2, 'LongShanks IPA 500ml', 'IBU 80 Alc 6,5%', 90, 2),
(3, 'Caipiroshka', 'Vodka - lima- azucar - hielo', 100, 1),
(4, 'Cerveza Scotish', 'Cerveza Tirada', 120, 2);

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
(5, 'Socio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `IdSesion` int(11) NOT NULL,
  `IdEmpleado` int(11) NOT NULL,
  `FechaIngreso` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `FechaSalida` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`IdSesion`, `IdEmpleado`, `FechaIngreso`, `FechaSalida`) VALUES
(1, 1, '0000-00-00 00:00:00', NULL),
(2, 1, '', NULL),
(3, 1, '', NULL),
(4, 1, '07/11/2018 12:26 AM', NULL),
(5, 2, '07/16/2018 8:50 PM', NULL),
(6, 2, '07/16/2018 8:50 PM', NULL),
(7, 2, '07/16/2018 8:50 PM', '07/16/2018 10:57 PM'),
(8, 1, '07/29/2018 1:29 PM', NULL),
(9, 1, '07/29/2018 8:22 PM', NULL),
(10, 2, '07/29/2018 9:27 PM', NULL),
(11, 2, '07/30/2018 12:53 AM', NULL),
(12, 2, '07/30/2018 7:41 PM', NULL),
(13, 2, '07/30/2018 9:26 PM', NULL),
(14, 2, '07/30/2018 11:58 PM', NULL),
(15, 2, '07/31/2018 1:01 PM', '07/31/2018 1:15 PM'),
(36, 3, '08/07/2018 7:34 PM', NULL),
(37, 4, '08/07/2018 8:10 PM', NULL),
(40, 3, '08/07/2018 8:21 PM', NULL),
(41, 4, '08/07/2018 9:14 PM', NULL),
(42, 4, '08/09/2018 8:13 PM', NULL),
(43, 3, '08/09/2018 8:15 PM', NULL),
(45, 12, '08/09/2018 8:41 PM', NULL),
(46, 3, '08/09/2018 9:14 PM', NULL),
(47, 2, '08/10/2018 12:22 AM', NULL),
(48, 12, '08/10/2018 1:13 AM', NULL),
(49, 2, '08/10/2018 1:14 AM', NULL),
(50, 3, '08/10/2018 1:18 AM', NULL),
(51, 1, '08/10/2018 10:03 AM', NULL),
(52, 3, '08/10/2018 10:14 AM', NULL),
(53, 12, '08/10/2018 10:15 AM', NULL),
(54, 2, '08/10/2018 10:31 AM', NULL),
(55, 1, '08/10/2018 10:40 AM', NULL),
(56, 2, '08/10/2018 12:47 PM', NULL),
(57, 12, '08/10/2018 5:37 PM', NULL),
(58, 2, '08/10/2018 5:37 PM', NULL),
(59, 12, '08/10/2018 5:52 PM', NULL),
(60, 1, '08/10/2018 5:54 PM', NULL),
(61, 1, '08/10/2018 7:20 PM', NULL),
(62, 2, '08/10/2018 7:23 PM', NULL),
(63, 12, '08/10/2018 7:34 PM', NULL),
(64, 3, '08/10/2018 7:37 PM', NULL),
(65, 1, '08/10/2018 7:39 PM', NULL),
(66, 12, '08/14/2018 10:29 PM', NULL),
(67, 2, '08/14/2018 11:59 PM', NULL),
(68, 1, '08/20/2018 1:54 PM', NULL),
(69, 1, '08/20/2018 1:55 PM', NULL),
(70, 1, '08/21/2018 11:11 PM', NULL),
(71, 1, '08/22/2018 12:04 AM', NULL),
(72, 1, '08/22/2018 12:05 AM', NULL),
(73, 1, '08/22/2018 12:08 AM', '08/27/2018 7:57 PM'),
(74, 1, '08/27/2018 8:06 PM', NULL),
(75, 1, '08/29/2018 11:25 PM', NULL),
(76, 1, '09/22/2018 7:59 PM', NULL),
(77, 1, '09/22/2018 8:16 PM', NULL),
(78, 1, '09/22/2018 8:42 PM', NULL),
(79, 1, '09/23/2018 12:34 AM', NULL),
(80, 1, '09/23/2018 1:37 AM', NULL),
(81, 1, '09/23/2018 1:37 AM', NULL),
(82, 1, '09/23/2018 1:39 AM', NULL),
(83, 1, '09/23/2018 1:40 AM', NULL),
(84, 1, '09/23/2018 12:55 PM', NULL),
(85, 1, '09/23/2018 12:56 PM', NULL),
(86, 1, '09/23/2018 12:59 PM', NULL),
(87, 1, '09/23/2018 12:59 PM', NULL),
(88, 1, '09/23/2018 1:00 PM', NULL),
(89, 2, '09/23/2018 1:01 PM', NULL),
(90, 1, '09/23/2018 1:06 PM', NULL),
(91, 1, '09/23/2018 1:12 PM', NULL),
(92, 1, '09/23/2018 1:36 PM', NULL),
(93, 1, '09/23/2018 2:10 PM', NULL),
(94, 1, '09/23/2018 2:17 PM', NULL),
(95, 12, '09/30/2018 4:12 PM', NULL),
(96, 2, '09/30/2018 5:57 PM', NULL),
(97, 12, '09/30/2018 6:45 PM', NULL),
(98, 1, '09/30/2018 6:55 PM', NULL),
(99, 4, '09/30/2018 7:15 PM', NULL),
(100, 2, '09/30/2018 7:17 PM', NULL),
(101, 4, '09/30/2018 7:22 PM', NULL),
(102, 3, '09/30/2018 10:55 PM', NULL),
(103, 2, '09/30/2018 11:01 PM', NULL),
(104, 2, '10/02/2018 12:18 AM', NULL),
(105, 2, '10/02/2018 12:25 AM', '10/03/2018 11:52 PM'),
(106, 1, '10/04/2018 12:40 AM', NULL),
(107, 1, '10/06/2018 12:49 PM', NULL),
(108, 1, '10/06/2018 2:36 PM', NULL),
(109, 2, '10/06/2018 8:49 PM', NULL),
(110, 2, '10/06/2018 8:49 PM', '10/06/2018 8:50 PM'),
(111, 1, '10/06/2018 8:51 PM', NULL),
(112, 1, '10/07/2018 2:53 PM', NULL),
(113, 1, '10/07/2018 3:24 PM', NULL),
(114, 2, '10/07/2018 5:34 PM', NULL),
(115, 2, '10/08/2018 8:39 PM', NULL),
(116, 1, '10/09/2018 11:14 PM', '10/10/2018 8:09 PM'),
(117, 1, '10/10/2018 8:09 PM', '10/10/2018 11:12 PM'),
(118, 1, '10/10/2018 11:13 PM', '10/10/2018 11:21 PM'),
(119, 1, '10/10/2018 11:21 PM', '10/10/2018 11:34 PM'),
(120, 1, '10/10/2018 11:34 PM', '10/10/2018 11:34 PM'),
(121, 1, '10/10/2018 11:34 PM', '10/10/2018 11:34 PM'),
(122, 1, '10/10/2018 11:34 PM', '10/10/2018 11:37 PM'),
(123, 1, '10/10/2018 11:37 PM', '10/10/2018 11:38 PM'),
(124, 1, '10/10/2018 11:38 PM', '10/10/2018 11:46 PM'),
(125, 1, '10/10/2018 11:46 PM', '10/10/2018 11:46 PM'),
(126, 1, '10/10/2018 11:46 PM', '10/11/2018 8:52 PM'),
(127, 2, '10/11/2018 8:52 PM', NULL),
(128, 2, '10/11/2018 9:17 PM', NULL),
(129, 2, '10/12/2018 12:22 AM', NULL),
(130, 2, '10/12/2018 12:39 AM', '10/13/2018 12:42 PM'),
(131, 2, '10/13/2018 12:42 PM', '10/13/2018 12:54 PM'),
(132, 2, '10/13/2018 12:55 PM', '10/13/2018 12:58 PM'),
(133, 2, '10/13/2018 12:58 PM', NULL),
(134, 2, '10/13/2018 12:58 PM', NULL),
(135, 2, '10/13/2018 12:58 PM', '10/13/2018 12:58 PM'),
(136, 2, '10/13/2018 12:59 PM', '10/13/2018 1:03 PM'),
(137, 2, '10/13/2018 1:03 PM', '10/13/2018 1:25 PM'),
(138, 2, '10/13/2018 1:25 PM', '10/13/2018 1:27 PM'),
(139, 2, '10/13/2018 1:27 PM', '10/13/2018 1:28 PM'),
(140, 2, '10/13/2018 1:28 PM', '10/13/2018 4:32 PM'),
(141, 2, '10/13/2018 6:06 PM', '10/14/2018 1:31 PM'),
(142, 1, '10/14/2018 1:31 PM', '10/14/2018 1:48 PM'),
(143, 1, '10/14/2018 1:50 PM', '10/14/2018 3:34 PM'),
(144, 2, '10/14/2018 3:34 PM', NULL),
(145, 1, '10/14/2018 3:38 PM', '10/14/2018 3:41 PM'),
(146, 2, '10/14/2018 3:43 PM', '10/14/2018 3:59 PM'),
(147, 2, '10/14/2018 3:59 PM', NULL),
(148, 2, '10/14/2018 6:47 PM', '10/14/2018 6:50 PM'),
(149, 2, '10/14/2018 6:50 PM', '10/15/2018 1:19 AM'),
(150, 1, '10/15/2018 1:19 AM', NULL),
(151, 1, '10/15/2018 2:15 AM', NULL),
(152, 2, '10/15/2018 10:09 AM', '10/15/2018 10:20 AM'),
(153, 1, '10/15/2018 10:20 AM', '10/15/2018 10:20 AM'),
(154, 2, '10/15/2018 10:20 AM', NULL),
(155, 3, '10/15/2018 11:19 AM', '10/15/2018 11:47 AM'),
(156, 3, '10/15/2018 11:47 AM', '10/15/2018 11:55 AM'),
(157, 3, '10/15/2018 11:55 AM', '10/15/2018 9:10 PM'),
(158, 3, '10/15/2018 9:10 PM', '10/15/2018 9:27 PM'),
(159, 3, '10/15/2018 9:46 PM', '10/15/2018 9:57 PM'),
(160, 12, '10/15/2018 9:58 PM', '10/15/2018 10:25 PM'),
(161, 4, '10/15/2018 10:25 PM', '10/15/2018 11:09 PM'),
(162, 1, '10/15/2018 11:09 PM', '10/15/2018 11:56 PM'),
(163, 2, '10/15/2018 11:56 PM', NULL),
(164, 2, '10/16/2018 1:41 AM', '10/16/2018 3:04 AM'),
(165, 1, '10/16/2018 3:04 AM', '10/16/2018 3:08 AM'),
(166, 2, '10/16/2018 3:08 AM', '10/16/2018 3:09 AM'),
(167, 4, '10/16/2018 3:10 AM', '10/16/2018 3:10 AM'),
(168, 12, '10/16/2018 3:10 AM', '10/16/2018 12:02 PM'),
(169, 2, '10/16/2018 12:03 PM', NULL),
(170, 2, '10/16/2018 12:24 PM', '10/16/2018 12:29 PM'),
(171, 1, '10/16/2018 12:29 PM', '10/16/2018 12:41 PM'),
(172, 2, '10/16/2018 12:41 PM', '10/16/2018 12:52 PM'),
(173, 1, '10/16/2018 12:52 PM', '10/16/2018 12:54 PM'),
(174, 12, '10/16/2018 12:54 PM', '10/16/2018 12:55 PM'),
(175, 1, '10/16/2018 12:55 PM', NULL),
(176, 1, '10/16/2018 1:14 PM', '10/16/2018 2:42 PM'),
(177, 2, '10/16/2018 2:43 PM', '10/16/2018 2:47 PM'),
(178, 1, '10/16/2018 2:47 PM', '10/16/2018 2:47 PM'),
(179, 2, '10/16/2018 2:47 PM', '10/16/2018 2:50 PM'),
(180, 1, '10/16/2018 2:51 PM', NULL),
(181, 1, '10/16/2018 3:23 PM', '10/16/2018 4:07 PM'),
(182, 1, '10/16/2018 4:07 PM', '10/16/2018 4:07 PM'),
(183, 1, '10/16/2018 4:07 PM', '10/16/2018 4:08 PM'),
(184, 1, '10/16/2018 4:08 PM', '10/16/2018 4:09 PM'),
(185, 1, '10/16/2018 4:09 PM', '10/16/2018 4:09 PM'),
(186, 1, '10/16/2018 4:10 PM', NULL),
(187, 1, '10/16/2018 4:15 PM', '10/16/2018 4:17 PM'),
(188, 1, '10/16/2018 4:17 PM', '10/16/2018 4:18 PM'),
(189, 1, '10/16/2018 4:18 PM', '10/16/2018 4:23 PM'),
(190, 1, '10/16/2018 4:24 PM', '10/16/2018 4:59 PM'),
(191, 1, '10/16/2018 4:59 PM', NULL);

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
  ADD KEY `Id_estadoCuenta` (`Id_estadoCuenta`),
  ADD KEY `Id_legajo` (`Id_empleado`);

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
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
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
  MODIFY `IdOperacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `Id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `Id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `IdSesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;
--
-- AUTO_INCREMENT de la tabla `zonas_mesas`
--
ALTER TABLE `zonas_mesas`
  MODIFY `Id_zonaMesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
