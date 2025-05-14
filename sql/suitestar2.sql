-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2025 a las 16:54:55
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
-- Base de datos: `suitestar2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletin`
--

CREATE TABLE `boletin` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `fecha_suscripcion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `boletin`
--

INSERT INTO `boletin` (`id`, `correo`, `fecha_suscripcion`) VALUES
(1, 'alejandrow7w@gmail.com', '2024-11-29 03:21:48'),
(2, 'alejandrw7w@gmail.com', '2024-11-29 03:24:33'),
(3, 'aljandrw7w@gmail.com', '2024-11-29 03:26:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `motivo_id` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_envio` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `nombre`, `correo`, `motivo_id`, `mensaje`, `fecha`, `fecha_envio`) VALUES
(1, 'Juan Pérez', 'juan@example.com', 1, 'Tengo una consulta sobre la disponibilidad de habitaciones.', '2024-11-28 17:12:56', '2024-11-28 17:12:56'),
(3, 'Abel', 'abelAngel@gmail.com', 3, 'Excelente servicios', '2025-04-24 01:22:13', '2025-04-23 20:22:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos`
--

CREATE TABLE `motivos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `motivos`
--

INSERT INTO `motivos` (`id`, `descripcion`) VALUES
(1, 'queja'),
(2, 'reclamo'),
(3, 'felicitacion'),
(4, 'consulta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacion_password`
--

CREATE TABLE `recuperacion_password` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expira` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recuperacion_password`
--

INSERT INTO `recuperacion_password` (`id`, `usuario_id`, `token`, `expira`) VALUES
(8, 6, '384c6f5c315fcb2d8cae46a881ea73b9', '2024-11-29 04:49:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(1, 'administrador'),
(2, 'recepcionista'),
(3, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `imagen_perfil` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `rol_id`, `correo`, `cedula`, `nombre`, `apellido`, `contrasena`, `fecha_registro`, `imagen_perfil`, `descripcion`, `fecha_nacimiento`) VALUES
(6, 1, 'alejandrow7w@gmail.com', '102030', 'Jhony p', 'Vasquez', '$2y$10$IiAbTm54bjd7NnGjHgX7yumF1vfH7zePTzOG99yjs9ehPXmuPm3c6', '2024-11-28 17:12:56', '6_profile.jpg', 'hola', '2024-11-20'),
(8, 1, 'angelVega@gmail.com', '10394', 'Angel', 'Vega', '$2y$10$kmb.EKsOhRzBwRL4mOU3..LRtxp0mWE72DR9K3F5d3hUHQJ1.he8S', '2025-04-24 01:23:09', NULL, NULL, NULL),
(9, 3, 'marcel23vega@gmail.com', '3048', 'marcel', 'vega', '$2y$10$z12kehuACeUg6LLzT8osWebH9TRETuprkDztovAo7wMCixBPoNRSi', '2025-04-24 02:59:36', NULL, NULL, NULL),
(10, 3, 'selenio@gmail.com', '1000890', 'Selenio', 'Selenium', '$2y$10$u3zDZmutvwjh/N83bNqfv.Z.hZlO12IsBeioDMvPQE4s7bUnSCs3y', '2025-04-24 16:47:57', NULL, NULL, NULL),
(12, 1, 'admin@gmail.com', '133', 'Admin', 'Ale', '$2y$10$yRk3ovjNcYCUzOcixd73ueOJ/XdY8XrirB7Yqw2/m.pHh2O/l5T5y', '2025-05-14 04:15:10', NULL, NULL, NULL),
(13, 1, 'ejemplo@gmail.com', '3445', 'Hola', 'V', '$2y$10$/n7ymxBfr9Kq5h3DMhuwTe9z8luA6Dcpsi4TO9rolleob2hIQVqTC', '2025-05-14 14:19:15', NULL, NULL, NULL),
(14, 1, 'a@gmail.com', '2344', 'J', 'A', '$2y$10$0gL6rHF5l1uddWjwYKWpzetNWmRhFljwYldSJ.KubKo/lG4Xc4jgy', '2025-05-14 14:24:17', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boletin`
--
ALTER TABLE `boletin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `motivo_id` (`motivo_id`);

--
-- Indices de la tabla `motivos`
--
ALTER TABLE `motivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recuperacion_password`
--
ALTER TABLE `recuperacion_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boletin`
--
ALTER TABLE `boletin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `motivos`
--
ALTER TABLE `motivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `recuperacion_password`
--
ALTER TABLE `recuperacion_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`motivo_id`) REFERENCES `motivos` (`id`);

--
-- Filtros para la tabla `recuperacion_password`
--
ALTER TABLE `recuperacion_password`
  ADD CONSTRAINT `recuperacion_password_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
