-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2025 a las 00:56:46
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
(4, 'Arnol', 'Arnol@gmail.com', 4, '¿Puedo cancelar una reserva?', '2025-05-17 22:07:17', '2025-05-17 17:07:17'),
(5, 'Arnol', 'Arnol@gmail.com', 4, 'Necesito ayuda', '2025-05-17 22:21:31', '2025-05-17 17:21:31');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_reserva` timestamp NOT NULL DEFAULT current_timestamp(),
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `cantidad_personas` int(3) NOT NULL,
  `tipo_habitacion` varchar(50) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'pendiente',
  `telefono` varchar(20) NOT NULL,
  `preferencias_especiales` text DEFAULT NULL,
  `metodo_pago` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `usuario_id`, `fecha_reserva`, `nombre`, `apellido`, `correo`, `fecha_ingreso`, `fecha_salida`, `cantidad_personas`, `tipo_habitacion`, `estado`, `telefono`, `preferencias_especiales`, `metodo_pago`) VALUES
(1, 16, '2025-05-17 22:03:39', 'Arnol', 'v', 'Arnol@gmail.com', '2025-05-17', '2025-05-20', 3, 'estandar', 'pendiente', '3195378456', 'Hola', 'tarjeta_credito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_contactos`
--

CREATE TABLE `respuestas_contactos` (
  `id` int(11) NOT NULL,
  `contacto_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `respuesta` text NOT NULL,
  `fecha_respuesta` datetime NOT NULL DEFAULT current_timestamp(),
  `calificacion_usuario` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas_contactos`
--

INSERT INTO `respuestas_contactos` (`id`, `contacto_id`, `admin_id`, `respuesta`, `fecha_respuesta`, `calificacion_usuario`) VALUES
(2, 4, 6, 'Si, señor. Digame si la desea cancelar, le puedo colaborar', '2025-05-17 17:08:23', NULL),
(3, 5, 6, 'Cuenteme señor que le ocurre', '2025-05-17 17:48:53', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_usuario`
--

CREATE TABLE `respuestas_usuario` (
  `id` int(11) NOT NULL,
  `contacto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `respuesta` text NOT NULL,
  `fecha_respuesta` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas_usuario`
--

INSERT INTO `respuestas_usuario` (`id`, `contacto_id`, `usuario_id`, `respuesta`, `fecha_respuesta`) VALUES
(1, 5, 16, 'Hola', '2025-05-17 17:39:00'),
(2, 5, 16, 'Hola, no me responde', '2025-05-17 17:45:17'),
(3, 5, 16, 'holaaaa', '2025-05-17 17:55:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_usuario_admin`
--

CREATE TABLE `respuestas_usuario_admin` (
  `id` int(11) NOT NULL,
  `respuesta_usuario_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `respuesta` text NOT NULL,
  `fecha_respuesta` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas_usuario_admin`
--

INSERT INTO `respuestas_usuario_admin` (`id`, `respuesta_usuario_id`, `admin_id`, `respuesta`, `fecha_respuesta`) VALUES
(1, 1, 6, 'Hola, cuenteme', '2025-05-17 17:44:27'),
(2, 2, 6, 'Hola si', '2025-05-17 17:45:39'),
(3, 2, 6, 'Si, hola', '2025-05-17 17:48:43'),
(4, 1, 6, 'Hola, esta es la prueba 1', '2025-05-17 17:50:33'),
(5, 1, 6, 'Si, hola prueba 2', '2025-05-17 17:54:07'),
(6, 3, 6, 'hola, si', '2025-05-17 17:55:31');

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
(6, 1, 'admin1@gmail.com', '102030', 'Admin', '1', '$2y$10$QdwVR0W8dncYVnY41WJua.yJ.4h5mrNpn0l1XH1pjOYja2O2kMnyy', '2024-11-28 17:12:56', '6_admin1.png', 'Administrador principal', '2000-11-20'),
(16, 3, 'Arnol@gmail.com', '1025645', 'Arnol', 'Zack', '$2y$10$VDQVlxHkxeHl8IBr/oUVJek00Q/ffaUQiagAtN2ciw4dIN5C9Xx7S', '2025-05-17 18:44:01', '16_avatar1.jpg', NULL, NULL);

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
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `respuestas_contactos`
--
ALTER TABLE `respuestas_contactos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacto_id` (`contacto_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indices de la tabla `respuestas_usuario`
--
ALTER TABLE `respuestas_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacto_id` (`contacto_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `respuestas_usuario_admin`
--
ALTER TABLE `respuestas_usuario_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respuesta_usuario_id` (`respuesta_usuario_id`),
  ADD KEY `admin_id` (`admin_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `motivos`
--
ALTER TABLE `motivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `recuperacion_password`
--
ALTER TABLE `recuperacion_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `respuestas_contactos`
--
ALTER TABLE `respuestas_contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `respuestas_usuario`
--
ALTER TABLE `respuestas_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `respuestas_usuario_admin`
--
ALTER TABLE `respuestas_usuario_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `respuestas_contactos`
--
ALTER TABLE `respuestas_contactos`
  ADD CONSTRAINT `respuestas_contactos_ibfk_1` FOREIGN KEY (`contacto_id`) REFERENCES `contactos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respuestas_contactos_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `respuestas_usuario`
--
ALTER TABLE `respuestas_usuario`
  ADD CONSTRAINT `respuestas_usuario_ibfk_1` FOREIGN KEY (`contacto_id`) REFERENCES `contactos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respuestas_usuario_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `respuestas_usuario_admin`
--
ALTER TABLE `respuestas_usuario_admin`
  ADD CONSTRAINT `respuestas_usuario_admin_ibfk_1` FOREIGN KEY (`respuesta_usuario_id`) REFERENCES `respuestas_usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respuestas_usuario_admin_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
