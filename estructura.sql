-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-09-2026 a las 15:27:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cuidapp_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuidadoras`
--

DROP TABLE IF EXISTS `cuidadoras`;
CREATE TABLE `cuidadoras` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `experiencia` tinyint(3) UNSIGNED DEFAULT 0,
  `verificada` tinyint(1) DEFAULT 0,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `zona` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio_hora` decimal(5,2) DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'disponible',
  `dias_disponibles` varchar(100) DEFAULT NULL,
  `radio_km` tinyint(3) UNSIGNED DEFAULT 5,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `precio_por_hora` decimal(5,2) DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuidadoras`
--

INSERT INTO `cuidadoras` (`id`, `nombre`, `email`, `password`, `ciudad`, `telefono`, `foto`, `experiencia`, `verificada`, `fecha_registro`, `zona`, `descripcion`, `precio_hora`, `estado`, `dias_disponibles`, `radio_km`, `hora_inicio`, `hora_fin`, `precio_por_hora`, `precio`) VALUES
(1, 'derek', 'cuidadora@gmail.com', '$2y$10$OQuEu6sFdDPBAJpZvTiBFeDWdXBZKLVrWRMvl62kG4dCizkRtmY5u', 'barcelona', '+34 565 565 565 ', NULL, 0, 0, '2026-05-25 13:54:28', NULL, NULL, NULL, 'disponible', NULL, 5, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_espera`
--

DROP TABLE IF EXISTS `lista_espera`;
CREATE TABLE `lista_espera` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `tipo` enum('padre','cuidadora') NOT NULL,
  `num_hijos` varchar(10) DEFAULT NULL,
  `edades_hijos` varchar(100) DEFAULT NULL,
  `necesidad` text DEFAULT NULL,
  `experiencia` varchar(10) DEFAULT NULL,
  `disponibilidad` varchar(50) DEFAULT NULL,
  `acepta_privacidad` tinyint(1) NOT NULL DEFAULT 0,
  `acepta_comunicaciones` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lista_espera`
--

INSERT INTO `lista_espera` (`id`, `nombre`, `apellidos`, `email`, `telefono`, `ciudad`, `tipo`, `num_hijos`, `edades_hijos`, `necesidad`, `experiencia`, `disponibilidad`, `acepta_privacidad`, `acepta_comunicaciones`, `fecha_registro`) VALUES
(1, 'nerea', 'garcia', 'nereagarcia@gmail.com', '666 555 444', 'girona', 'cuidadora', '', '', '', '', 'completa', 1, 1, '2026-05-26 13:52:21'),
(2, 'maria', 'mena', 'mariamena@gmail.com', '111222333', 'manresa', 'cuidadora', '', '', '', '', '', 1, 0, '2026-05-26 13:57:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

DROP TABLE IF EXISTS `registros`;
CREATE TABLE `registros` (
  `id` int(11) NOT NULL,
  `tipo` enum('padre','cuidadora') NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `email` varchar(180) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `num_hijos` tinyint(3) UNSIGNED DEFAULT NULL,
  `edades_hijos` varchar(100) DEFAULT NULL,
  `necesidad` varchar(255) DEFAULT NULL,
  `experiencia` tinyint(3) UNSIGNED DEFAULT NULL,
  `disponibilidad` enum('parcial','completa','fines_semana') DEFAULT NULL,
  `tiene_referencias` tinyint(1) DEFAULT NULL,
  `ip_registro` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id`, `tipo`, `nombre`, `apellidos`, `email`, `ciudad`, `telefono`, `fecha_registro`, `num_hijos`, `edades_hijos`, `necesidad`, `experiencia`, `disponibilidad`, `tiene_referencias`, `ip_registro`, `activo`) VALUES
(1, 'padre', 'ana', 'garcia lopez', 'ana@gmail.com', 'Barcelona', '646 646 646', '2026-05-25 15:26:53', 2, '3,5', 'tardes', NULL, NULL, NULL, '::1', 1),
(2, 'padre', 'jaime', 'garcia', 'jaime@gmail.com', 'girona', '444 555 555', '2026-05-25 15:31:18', 4, '5,6,7,2', 'tardes', NULL, NULL, NULL, '::1', 1),
(3, 'cuidadora', 'ana', 'mena', 'anamena@gmail.com', 'los angeles', '555 444 444', '2026-05-25 15:34:41', NULL, NULL, NULL, 5, 'parcial', 0, '::1', 1),
(4, 'cuidadora', 'natalia', 'mena', 'nataliamena@gmail.com', 'bilbao', '444 555 666', '2026-05-25 15:36:00', NULL, NULL, NULL, 4, 'parcial', 0, '::1', 1),
(5, 'padre', 'ana maria', 'garcia lopez', 'anamaria@gmail.com', 'barcelona', '544 555 666', '2026-05-26 13:38:51', 4, '1,2,3,4', 'mañanas', NULL, NULL, NULL, '::1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `ciudad`, `telefono`, `foto`, `fecha_registro`) VALUES
(1, 'derek', 'derekjob1991@gmail.com', '$2y$10$4VGpch3jVZNtn3GcAdSvAuB53IVytrRPsRwqJ2beONgj5ScRrsXZi', 'barcelona', NULL, NULL, '2026-05-25 13:52:22');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuidadoras`
--
ALTER TABLE `cuidadoras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `lista_espera`
--
ALTER TABLE `lista_espera`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuidadoras`
--
ALTER TABLE `cuidadoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lista_espera`
--
ALTER TABLE `lista_espera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
