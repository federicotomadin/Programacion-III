-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2018 a las 09:53:58
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
(67, '2018-12-07 08:33:04', 1, 4);

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
(1, 'Asado de Tira', 'Asado de tira', 290, 3),
(3, 'Caipiroshka', 'Vodka - lima- azucar - hielo', 100, 1),
(2, 'Red', 'Cerveza Tirada', 180, 2);

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
(284, 1, '12/07/2018 5:50 AM', NULL);

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
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
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
  MODIFY `IdOperacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `Id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
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
  MODIFY `IdSesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;
--
-- AUTO_INCREMENT de la tabla `zonas_mesas`
--
ALTER TABLE `zonas_mesas`
  MODIFY `Id_zonaMesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
