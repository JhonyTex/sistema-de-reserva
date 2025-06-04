-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2025 a las 21:55:08
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
(12, 'Arnol', 'Arnol@gmail.com', 2, 'hola', '2025-05-18 18:39:47', '2025-05-18 13:39:47'),
(13, 'Arnol', 'Arnol@gmail.com', 3, 'hola', '2025-05-18 18:45:02', '2025-05-18 13:45:02'),
(14, 'Arnol', 'Arnol@gmail.com', 1, 'ruido', '2025-05-18 18:45:39', '2025-05-18 13:45:39'),
(15, 'Arnol', 'Arnol@gmail.com', 3, 'Hola, me siento feliz', '2025-05-19 01:00:38', '2025-05-18 20:00:38');

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
(9, 16, '2025-05-19 01:00:00', 'Arnol', 'v', 'Arnol@gmail.com', '2025-05-18', '2025-05-23', 3, 'presidencial', 'confirmada', '3195378456', 'Hola', 'tarjeta_credito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_automaticas`
--

CREATE TABLE `respuestas_automaticas` (
  `id` int(11) NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `palabra_clave` varchar(255) NOT NULL,
  `respuesta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas_automaticas`
--

INSERT INTO `respuestas_automaticas` (`id`, `motivo`, `palabra_clave`, `respuesta`) VALUES
(1, 'consulta', 'hola', '¡Hola! ¿En qué podemos ayudarte hoy?'),
(2, 'consulta', 'buenos dias', '¡Buenos días! Estamos aquí para ayudarte.'),
(3, 'consulta', 'buenas tardes', '¡Buenas tardes! ¿Cómo podemos asistirte?'),
(4, 'consulta', 'buenas noches', '¡Buenas noches! Si necesitas algo, estamos disponibles.'),
(5, 'consulta', 'gracias', '¡Gracias a ti por contactarnos! Estamos para servirte.'),
(6, 'consulta', 'muchas gracias', 'Nos alegra poder ayudarte, ¡que tengas un excelente día!'),
(7, 'consulta', 'agradecido', 'Es un placer ayudarte, cualquier cosa aquí estamos.'),
(8, 'consulta', 'horario', 'Nuestro horario de atención es de 8am a 8pm todos los días.'),
(9, 'consulta', 'piscina', 'La piscina está abierta de 7am a 10pm.'),
(10, 'consulta', 'wifi', 'Ofrecemos wifi gratuito en todas las instalaciones.'),
(11, 'consulta', 'desayuno', 'El desayuno se sirve de 6am a 10am en el restaurante principal.'),
(12, 'consulta', 'estacionamiento', 'Contamos con parqueadero gratuito para huéspedes.'),
(13, 'consulta', 'spa', 'Nuestro spa ofrece servicios desde las 9am hasta las 8pm.'),
(14, 'consulta', 'cancelacion', 'Las cancelaciones deben realizarse con mínimo 24 horas de anticipación sin penalización.'),
(15, 'consulta', 'checkin', 'El check-in es a partir de las 2pm y el check-out hasta las 12pm.'),
(16, 'consulta', 'mascotas', 'Aceptamos mascotas pequeñas bajo solicitud previa y con costo adicional.'),
(17, 'queja', 'ruido', 'Lamentamos el ruido. Estamos trabajando para mejorar la tranquilidad en nuestras instalaciones.'),
(18, 'queja', 'limpieza', 'Lamentamos el inconveniente con la limpieza. Por favor, comunícate con recepción para resolverlo.'),
(19, 'queja', 'internet', 'Sentimos los problemas con el internet, nuestro equipo técnico ya está atendiendo el caso.'),
(20, 'queja', 'servicio', 'Nos disculpamos si el servicio no cumplió tus expectativas. Trabajaremos para mejorar.'),
(21, 'queja', 'habitacion', 'Lamentamos cualquier problema con la habitación. Por favor, notifícanos para ayudarte.'),
(22, 'reclamo', 'factura', 'Si tienes dudas sobre la factura, por favor contacta a nuestro departamento administrativo.'),
(23, 'reclamo', 'cargo', 'Para aclarar cargos en tu cuenta, por favor envíanos los detalles y los revisaremos.'),
(24, 'reclamo', 'reserva', 'Si hubo un problema con tu reserva, escríbenos y te ayudaremos a solucionarlo.'),
(25, 'felicitacion', 'servicio', '¡Gracias por tu felicitación! Nos alegra que hayas disfrutado nuestro servicio.'),
(26, 'felicitacion', 'personal', 'Agradecemos tus palabras sobre nuestro personal, las compartiremos con ellos.'),
(27, 'felicitacion', 'instalaciones', 'Gracias por valorar nuestras instalaciones, esperamos verte pronto de nuevo.');

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
(9, 15, 6, 'Hola, me da mucho gusto', '2025-05-18 20:01:37', NULL);

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
(16, 3, 'Arnol@gmail.com', '1025645', 'Arnol', 'Zack', '$2y$10$VDQVlxHkxeHl8IBr/oUVJek00Q/ffaUQiagAtN2ciw4dIN5C9Xx7S', '2025-05-17 18:44:01', '16_avatar1.jpg', 'Hola', '2025-05-18');

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
-- Indices de la tabla `respuestas_automaticas`
--
ALTER TABLE `respuestas_automaticas`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `respuestas_automaticas`
--
ALTER TABLE `respuestas_automaticas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `respuestas_contactos`
--
ALTER TABLE `respuestas_contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `respuestas_usuario`
--
ALTER TABLE `respuestas_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `respuestas_usuario_admin`
--
ALTER TABLE `respuestas_usuario_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
