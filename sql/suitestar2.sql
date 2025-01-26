-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2024 a las 02:05:51
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
(1, 'Juan Pérez', 'juan@example.com', 1, 'Tengo una consulta sobre la disponibilidad de habitaciones.', '2024-11-28 17:12:56', '2024-11-28 17:12:56');

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
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_type` varchar(100) DEFAULT NULL,
  `checkin_date` date DEFAULT NULL,
  `checkout_date` date DEFAULT NULL,
  `num_people` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_servicios`
--

CREATE TABLE `reservas_servicios` (
  `reserva_id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `descripcion`) VALUES
(2, 'Servicio de transporte'),
(3, 'Desayuno incluido'),
(4, 'Piscina'),
(5, 'Estacionamiento privado'),
(6, 'Gimnasio'),
(7, 'Recepción 24 horas'),
(8, 'Desayuno incluido'),
(9, 'Servicio de lavandería'),
(10, 'Spa y masajes'),
(11, 'Sala de conferencias'),
(12, 'Bar y restaurante'),
(13, 'Transporte al aeropuerto'),
(14, 'Actividades turísticas organizadas');

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
(6, 1, 'alejandrow7w@gmail.com', '102030', 'Jhony p', 'Vasquez', '$2y$10$IiAbTm54bjd7NnGjHgX7yumF1vfH7zePTzOG99yjs9ehPXmuPm3c6', '2024-11-28 17:12:56', '6_profile.jpg', 'hola', '2024-11-20');

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
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `reservas_servicios`
--
ALTER TABLE `reservas_servicios`
  ADD PRIMARY KEY (`reserva_id`,`servicio_id`),
  ADD KEY `servicio_id` (`servicio_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `reservas_servicios`
--
ALTER TABLE `reservas_servicios`
  ADD CONSTRAINT `reservas_servicios_ibfk_1` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id`),
  ADD CONSTRAINT `reservas_servicios_ibfk_2` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
