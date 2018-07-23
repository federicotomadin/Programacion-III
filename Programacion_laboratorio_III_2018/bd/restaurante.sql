-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2018 a las 05:19:13
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
-- Base de datos: `restaurante`
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
  `habilitado` int(1) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `Nombre`, `Apellido`, `Usuario`, `Clave`, `Id_rol`, `Sueldo`, `habilitado`, `foto`) VALUES
(1, 'Federico ', 'Tomadin', 'ftomadin', '1234', 5, 0, 0, ''),
(2, 'Alfredo', 'Remus', 'aremus', '1234', 4, 20000, 1, ''),
(3, 'Dario', 'Daroli', 'ddaroli', '1234', 5, 20000, 1, ''),
(4, 'Facundo', 'Saiegh', 'fsaiegh', '1234', 5, 20000, 1, '');

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
(4, 'pagando'),
(7, 'cerrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_pedidos`
--

CREATE TABLE `lista_pedidos` (
  `Id_pedido` int(11) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(1, 2, 1, 'abc12'),
(2, 2, 1, 'abc13'),
(3, 6, 3, 'abc14'),
(4, 4, 2, 'abc15');

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
(1, '2018-07-03 04:39:49', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `Id_pedido` int(11) NOT NULL,
  `Tiempo_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Tiempo_estimado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Tiempo_llegadaMesa` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Id_cliente` int(11) NOT NULL,
  `Id_mesa` int(11) NOT NULL,
  `Id_estadoCuenta` int(11) NOT NULL,
  `Id_empleado` int(11) NOT NULL,
  `codigo` varchar(5) DEFAULT NULL,
  `Id_estadoPedido` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`Id_pedido`, `Tiempo_ingreso`, `Tiempo_estimado`, `Tiempo_llegadaMesa`, `Id_cliente`, `Id_mesa`, `Id_estadoCuenta`, `Id_empleado`, `codigo`, `Id_estadoPedido`) VALUES
(1, '2018-07-03 22:56:18', '2018-06-10 03:00:00', '2018-06-10 03:00:00', 1, 1, 1, 4, 'abc12', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Precio` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `habilitado` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `Nombre`, `Descripcion`, `Precio`, `id_rol`, `habilitado`) VALUES
(1, 'Asado de Tira', 'Porcíon abudante, para 2 personas', 230, 3, 1),
(2, 'LongShanks IPA 500ml', 'IBU 80 Alc 6,5%', 90, 2, 1);

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
  `FechaIngreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FechaSalida` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indices de la tabla `lista_pedidos`
--
ALTER TABLE `lista_pedidos`
  ADD KEY `Id_pedido` (`Id_pedido`),
  ADD KEY `Id_producto` (`Id_producto`);

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
  ADD KEY `Id_clienteVisita` (`Id_cliente`),
  ADD KEY `Id_estadoCuenta` (`Id_estadoCuenta`),
  ADD KEY `Id_legajo` (`Id_empleado`),
  ADD KEY `Id_estadoPedido` (`Id_estadoPedido`);

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
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `IdEncuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `estadopedidos`
--
ALTER TABLE `estadopedidos`
  MODIFY `Id_estadoPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `estado_cuenta_pedidos`
--
ALTER TABLE `estado_cuenta_pedidos`
  MODIFY `Id_estadoCuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `IdOperacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `Id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `IdSesion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `zonas_mesas`
--
ALTER TABLE `zonas_mesas`
  MODIFY `Id_zonaMesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
