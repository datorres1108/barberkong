-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-08-2020 a las 19:17:18
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `barberkong`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asig_citas`
--

CREATE TABLE `asig_citas` (
  `id` int(11) NOT NULL,
  `id_confcita` int(11) NOT NULL,
  `celular` varchar(12) DEFAULT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipo` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asig_citas`
--

INSERT INTO `asig_citas` (`id`, `id_confcita`, `celular`, `nombre`, `fecha`, `tipo`) VALUES
(5, 1, '', 'ROBERTO GOMEZ', '2020-08-14', 'Dia'),
(6, 5, '3138688256', 'DAVID ALEJANDRO TORRES PE', '2020-08-14', 'Dia'),
(7, 22, '3138688256', 'DAVID ALEJANDRO TORRES PE', '2020-08-18', 'Dia'),
(8, 5, NULL, 'PEDRO NAVAJAS', '2020-08-20', 'Pro'),
(10, 19, '', 'ALBERTO PLAZAS', '2020-08-19', 'Dia'),
(11, 21, '', 'RODRIGO CARMONA', '2020-08-19', 'Dia'),
(12, 8, '3138688256', 'DAVID ALEJANDRO TORRES PE', '2020-08-20', 'Dia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cod` int(11) NOT NULL,
  `id` varchar(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `celular` varchar(10) NOT NULL,
  `fcumpledia` int(11) NOT NULL,
  `fcumplemes` int(11) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `fecha_regi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cod`, `id`, `nombres`, `correo`, `celular`, `fcumpledia`, `fcumplemes`, `estado`, `fecha_regi`) VALUES
(1, '3138688256', 'DAVID ALEJANDRO TORRES PEREZ', 'datorres08@hotmail.com', '3138688256', 8, 11, 'A', '2020-07-27 17:15:59'),
(2, '3143336379', 'CAMILO ANDRES TORRES', 'camilo675@gmail.com', '3143336379', 13, 3, 'A', '2020-07-27 18:52:35'),
(3, '3167280178', 'JORGE MARIO PEREZ', 'jpmario@hotmail.com', '3167280178', 5, 5, 'A', '2020-07-28 11:09:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_citas`
--

CREATE TABLE `config_citas` (
  `id` int(11) NOT NULL,
  `descri` varchar(15) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `config_citas`
--

INSERT INTO `config_citas` (`id`, `descri`, `estado`) VALUES
(1, '08:00 ', 'disponible'),
(2, '08:30', 'disponible'),
(3, '09:00', 'disponible'),
(4, '09:30', 'disponible'),
(5, '10:00', 'asignado'),
(6, '10:30', 'disponible'),
(7, '11:00', 'disponible'),
(8, '11:30', 'disponible'),
(9, '12:00', 'disponible'),
(10, '12:30', 'disponible'),
(11, '13:00', 'disponible'),
(12, '13:30', 'disponible'),
(13, '14:00', 'disponible'),
(14, '14:30', 'disponible'),
(15, '15:00', 'disponible'),
(16, '15:30', 'disponible'),
(17, '16:00', 'disponible'),
(18, '16:30', 'disponible'),
(19, '17:00', 'disponible'),
(20, '17:30', 'disponible'),
(21, '18:00', 'disponible'),
(22, '18:30', 'asignado'),
(23, '19:00', 'disponible'),
(24, '19:30', 'disponible'),
(25, '20:00', 'disponible'),
(26, '20:30', 'disponible'),
(27, '21:00', 'disponible'),
(28, '21:30', 'disponible'),
(29, '22:00', 'disponible'),
(30, '22:30', 'disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_visitas`
--

CREATE TABLE `config_visitas` (
  `id` int(11) NOT NULL,
  `configuracion` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `config_visitas`
--

INSERT INTO `config_visitas` (`id`, `configuracion`) VALUES
(1, '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id` int(11) NOT NULL,
  `id_cliente` varchar(11) DEFAULT NULL,
  `visita` varchar(3) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id`, `id_cliente`, `visita`, `fecha`) VALUES
(1, '3138688256', '1', '2020-08-02'),
(2, '3138688256', '1', '2020-08-11'),
(3, '3167280178', '1', '2020-08-19'),
(6, '3138688256', '1', '2020-08-20'),
(7, '3138688256', '1', '2020-08-21'),
(8, '3167280178', '1', '2020-08-20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asig_citas`
--
ALTER TABLE `asig_citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cod`);

--
-- Indices de la tabla `config_citas`
--
ALTER TABLE `config_citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `config_visitas`
--
ALTER TABLE `config_visitas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asig_citas`
--
ALTER TABLE `asig_citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `config_citas`
--
ALTER TABLE `config_citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `config_visitas`
--
ALTER TABLE `config_visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
