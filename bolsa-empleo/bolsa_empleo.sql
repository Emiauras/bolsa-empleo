-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2025 a las 03:04:08
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
-- Base de datos: `bolsa_empleo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_adjuntos`
--

CREATE TABLE `documentos_adjuntos` (
  `id_documento` int(10) UNSIGNED NOT NULL,
  `id_postulante` int(10) UNSIGNED DEFAULT NULL,
  `id_emprendimiento` int(10) UNSIGNED DEFAULT NULL,
  `id_tipo_documento` tinyint(3) UNSIGNED NOT NULL,
  `nombre_archivo_original` varchar(255) NOT NULL,
  `nombre_archivo_sistema` varchar(255) NOT NULL,
  `ruta_archivo` varchar(255) NOT NULL,
  `mime_type` varchar(100) DEFAULT NULL,
  `tamano_bytes` bigint(20) DEFAULT NULL,
  `fecha_carga` datetime NOT NULL DEFAULT current_timestamp()
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emprendimientos`
--

CREATE TABLE `emprendimientos` (
  `id_emprendimiento` int(10) UNSIGNED NOT NULL,
  `id_postulante_emprendedor` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `id_rubro` int(10) UNSIGNED DEFAULT NULL,
  `id_estado_emprendimiento` tinyint(3) UNSIGNED DEFAULT NULL,
  `sitio_web` varchar(200) DEFAULT NULL,
  `redes_sociales` varchar(255) DEFAULT NULL,
  `necesidades` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(10) UNSIGNED NOT NULL,
  `razon_social` varchar(150) NOT NULL,
  `cuit` varchar(20) NOT NULL,
  `id_rubro` int(10) UNSIGNED DEFAULT NULL,
  `id_tamano_empresa` tinyint(3) UNSIGNED DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `email_contacto` varchar(100) DEFAULT NULL,
  `sitio_web` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_emprendimiento`
--

CREATE TABLE `estados_emprendimiento` (
  `id_estado_emprendimiento` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_oferta`
--

CREATE TABLE `estados_oferta` (
  `id_estado_oferta` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_postulacion`
--

CREATE TABLE `estados_postulacion` (
  `id_estado_postulacion` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_postulante`
--

CREATE TABLE `estados_postulante` (
  `id_estado_postulante` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados_postulante`
--

INSERT INTO `estados_postulante` (`id_estado_postulante`, `nombre`, `descripcion`) VALUES
(1, 'Activo', 'Postulante activo'),
(2, 'Inactivo', 'Postulante inactivo'),
(3, 'Suspendido', 'Postulante suspendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencias_laborales`
--

CREATE TABLE `experiencias_laborales` (
  `id_experiencia` int(10) UNSIGNED NOT NULL,
  `id_postulante` int(10) UNSIGNED NOT NULL,
  `empresa_nombre` varchar(150) NOT NULL,
  `puesto` varchar(150) NOT NULL,
  `fecha_desde` date DEFAULT NULL,
  `fecha_hasta` date DEFAULT NULL,
  `actualmente` tinyint(1) NOT NULL DEFAULT 0,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formaciones_academicas`
--

CREATE TABLE `formaciones_academicas` (
  `id_formacion` int(10) UNSIGNED NOT NULL,
  `id_postulante` int(10) UNSIGNED NOT NULL,
  `id_nivel_estudio` tinyint(3) UNSIGNED NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `institucion` varchar(150) NOT NULL,
  `anio_inicio` year(4) DEFAULT NULL,
  `anio_fin` year(4) DEFAULT NULL,
  `en_curso` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_estudio`
--

CREATE TABLE `niveles_estudio` (
  `id_nivel_estudio` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_laborales`
--

CREATE TABLE `ofertas_laborales` (
  `id_oferta` int(10) UNSIGNED NOT NULL,
  `id_empresa` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `id_rubro` int(10) UNSIGNED DEFAULT NULL,
  `id_tipo_postulante_objetivo` tinyint(3) UNSIGNED NOT NULL,
  `requisitos` text DEFAULT NULL,
  `id_tipo_contratacion` tinyint(3) UNSIGNED DEFAULT NULL,
  `id_tipo_jornada` tinyint(3) UNSIGNED DEFAULT NULL,
  `rango_salarial_desde` decimal(10,2) DEFAULT NULL,
  `rango_salarial_hasta` decimal(10,2) DEFAULT NULL,
  `fecha_publicacion` datetime NOT NULL DEFAULT current_timestamp(),
  `id_estado_oferta` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `email_contacto` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulaciones`
--

CREATE TABLE `postulaciones` (
  `id_postulacion` int(10) UNSIGNED NOT NULL,
  `id_oferta` int(10) UNSIGNED NOT NULL,
  `id_postulante` int(10) UNSIGNED NOT NULL,
  `fecha_postulacion` datetime NOT NULL DEFAULT current_timestamp(),
  `id_estado_postulacion` tinyint(3) UNSIGNED NOT NULL,
  `mensaje_postulante` text DEFAULT NULL,
  `calificacion_empresa` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulantes`
--

CREATE TABLE `postulantes` (
  `id_postulante` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_tipo_postulante` tinyint(3) UNSIGNED NOT NULL,
  `id_persona` int(10) UNSIGNED DEFAULT NULL,
  `id_empresa` int(10) UNSIGNED DEFAULT NULL,
  `id_estado_postulante` tinyint(3) UNSIGNED NOT NULL,
  `fecha_alta` datetime NOT NULL DEFAULT current_timestamp()
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales`
--

CREATE TABLE `profesionales` (
  `id_profesional` int(10) UNSIGNED NOT NULL,
  `id_postulante` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `institucion` varchar(150) NOT NULL,
  `matricula` varchar(50) DEFAULT NULL,
  `anio_graduacion` year(4) DEFAULT NULL,
  `descripcion_perfil` text DEFAULT NULL,
  `honorarios_referencia` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE `rubros` (
  `id_rubro` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamano_empresas`
--

CREATE TABLE `tamano_empresas` (
  `id_tamano_empresa` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_contratacion`
--

CREATE TABLE `tipos_contratacion` (
  `id_tipo_contratacion` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documento`
--

CREATE TABLE `tipos_documento` (
  `id_tipo_documento` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_jornada`
--

CREATE TABLE `tipos_jornada` (
  `id_tipo_jornada` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_postulante`
--

CREATE TABLE `tipos_postulante` (
  `id_tipo_postulante` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_postulante`
--

INSERT INTO `tipos_postulante` (`id_tipo_postulante`, `nombre`, `descripcion`) VALUES
(1, 'Persona', 'Persona que busca empleo en general'),
(2, 'Profesional', 'Profesional con título y matrícula'),
(3, 'Emprendedor', 'Persona que desarrolla un emprendimiento propio'),
(4, 'Empresa', 'Empresa que publica ofertas laborales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `fecha_alta` datetime NOT NULL DEFAULT current_timestamp(),
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `email`, `password_hash`, `fecha_alta`, `activo`) VALUES
(1, 'alu1', 'alu1@ej.com', '$2y$10$dyZ7o1nfFTNjAEU1RNkngeQcZx1lD.qHv7DiEa5Jn48a0Wo6K6Lj6', '2025-11-16 21:48:39', 1),
(2, 'emilia', 'Emiliaauras23@gmail.com', '$2y$10$PYamqXXk25mPHL9BL1sgUOG/0egPCb0lOPHNE58an6QYzqPi4E1Hu', '2025-11-17 12:46:30', 1),
(3, 'leonardo', 'leo@test.com', '$2y$10$pvrNKyj30x/lt2PMRG4FeeaEglEcEKt6YD.mvPNo47m/4x9qHo0ci', '2025-11-17 16:28:35', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `documentos_adjuntos`
--
ALTER TABLE `documentos_adjuntos`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `idx_documentos_postulante` (`id_postulante`),
  ADD KEY `idx_documentos_emprendimiento` (`id_emprendimiento`),
  ADD KEY `fk_documentos_tipo` (`id_tipo_documento`);

--
-- Indices de la tabla `emprendimientos`
--
ALTER TABLE `emprendimientos`
  ADD PRIMARY KEY (`id_emprendimiento`),
  ADD KEY `idx_emprendimientos_postulante` (`id_postulante_emprendedor`),
  ADD KEY `fk_emprendimientos_rubro` (`id_rubro`),
  ADD KEY `fk_emprendimientos_estado` (`id_estado_emprendimiento`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`),
  ADD UNIQUE KEY `uq_empresas_cuit` (`cuit`),
  ADD KEY `fk_empresas_rubros` (`id_rubro`),
  ADD KEY `fk_empresas_tamano` (`id_tamano_empresa`);

--
-- Indices de la tabla `estados_emprendimiento`
--
ALTER TABLE `estados_emprendimiento`
  ADD PRIMARY KEY (`id_estado_emprendimiento`);

--
-- Indices de la tabla `estados_oferta`
--
ALTER TABLE `estados_oferta`
  ADD PRIMARY KEY (`id_estado_oferta`);

--
-- Indices de la tabla `estados_postulacion`
--
ALTER TABLE `estados_postulacion`
  ADD PRIMARY KEY (`id_estado_postulacion`);

--
-- Indices de la tabla `estados_postulante`
--
ALTER TABLE `estados_postulante`
  ADD PRIMARY KEY (`id_estado_postulante`);

--
-- Indices de la tabla `experiencias_laborales`
--
ALTER TABLE `experiencias_laborales`
  ADD PRIMARY KEY (`id_experiencia`),
  ADD KEY `idx_experiencias_postulante` (`id_postulante`);

--
-- Indices de la tabla `formaciones_academicas`
--
ALTER TABLE `formaciones_academicas`
  ADD PRIMARY KEY (`id_formacion`),
  ADD KEY `idx_formaciones_postulante` (`id_postulante`),
  ADD KEY `fk_formaciones_nivel` (`id_nivel_estudio`);

--
-- Indices de la tabla `niveles_estudio`
--
ALTER TABLE `niveles_estudio`
  ADD PRIMARY KEY (`id_nivel_estudio`);

--
-- Indices de la tabla `ofertas_laborales`
--
ALTER TABLE `ofertas_laborales`
  ADD PRIMARY KEY (`id_oferta`),
  ADD KEY `idx_ofertas_empresa` (`id_empresa`),
  ADD KEY `idx_ofertas_rubro` (`id_rubro`),
  ADD KEY `fk_ofertas_tipo_postulante_obj` (`id_tipo_postulante_objetivo`),
  ADD KEY `fk_ofertas_tipo_contratacion` (`id_tipo_contratacion`),
  ADD KEY `fk_ofertas_tipo_jornada` (`id_tipo_jornada`),
  ADD KEY `fk_ofertas_estado` (`id_estado_oferta`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `uq_personas_dni` (`dni`);

--
-- Indices de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  ADD PRIMARY KEY (`id_postulacion`),
  ADD UNIQUE KEY `uq_postulaciones_oferta_postulante` (`id_oferta`,`id_postulante`),
  ADD KEY `idx_postulaciones_oferta` (`id_oferta`),
  ADD KEY `idx_postulaciones_postulante` (`id_postulante`),
  ADD KEY `fk_postulaciones_estado` (`id_estado_postulacion`);

--
-- Indices de la tabla `postulantes`
--
ALTER TABLE `postulantes`
  ADD PRIMARY KEY (`id_postulante`),
  ADD UNIQUE KEY `uq_postulantes_usuario` (`id_usuario`),
  ADD KEY `idx_postulantes_tipo` (`id_tipo_postulante`),
  ADD KEY `idx_postulantes_persona` (`id_persona`),
  ADD KEY `idx_postulantes_empresa` (`id_empresa`),
  ADD KEY `fk_postulantes_estado` (`id_estado_postulante`);

--
-- Indices de la tabla `profesionales`
--
ALTER TABLE `profesionales`
  ADD PRIMARY KEY (`id_profesional`),
  ADD UNIQUE KEY `uq_profesionales_postulante` (`id_postulante`);

--
-- Indices de la tabla `rubros`
--
ALTER TABLE `rubros`
  ADD PRIMARY KEY (`id_rubro`);

--
-- Indices de la tabla `tamano_empresas`
--
ALTER TABLE `tamano_empresas`
  ADD PRIMARY KEY (`id_tamano_empresa`);

--
-- Indices de la tabla `tipos_contratacion`
--
ALTER TABLE `tipos_contratacion`
  ADD PRIMARY KEY (`id_tipo_contratacion`);

--
-- Indices de la tabla `tipos_documento`
--
ALTER TABLE `tipos_documento`
  ADD PRIMARY KEY (`id_tipo_documento`);

--
-- Indices de la tabla `tipos_jornada`
--
ALTER TABLE `tipos_jornada`
  ADD PRIMARY KEY (`id_tipo_jornada`);

--
-- Indices de la tabla `tipos_postulante`
--
ALTER TABLE `tipos_postulante`
  ADD PRIMARY KEY (`id_tipo_postulante`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `uq_usuarios_username` (`username`),
  ADD UNIQUE KEY `uq_usuarios_email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `documentos_adjuntos`
--
ALTER TABLE `documentos_adjuntos`
  MODIFY `id_documento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `emprendimientos`
--
ALTER TABLE `emprendimientos`
  MODIFY `id_emprendimiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados_emprendimiento`
--
ALTER TABLE `estados_emprendimiento`
  MODIFY `id_estado_emprendimiento` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados_oferta`
--
ALTER TABLE `estados_oferta`
  MODIFY `id_estado_oferta` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados_postulacion`
--
ALTER TABLE `estados_postulacion`
  MODIFY `id_estado_postulacion` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados_postulante`
--
ALTER TABLE `estados_postulante`
  MODIFY `id_estado_postulante` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `experiencias_laborales`
--
ALTER TABLE `experiencias_laborales`
  MODIFY `id_experiencia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formaciones_academicas`
--
ALTER TABLE `formaciones_academicas`
  MODIFY `id_formacion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `niveles_estudio`
--
ALTER TABLE `niveles_estudio`
  MODIFY `id_nivel_estudio` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ofertas_laborales`
--
ALTER TABLE `ofertas_laborales`
  MODIFY `id_oferta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  MODIFY `id_postulacion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `postulantes`
--
ALTER TABLE `postulantes`
  MODIFY `id_postulante` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesionales`
--
ALTER TABLE `profesionales`
  MODIFY `id_profesional` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rubros`
--
ALTER TABLE `rubros`
  MODIFY `id_rubro` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tamano_empresas`
--
ALTER TABLE `tamano_empresas`
  MODIFY `id_tamano_empresa` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_contratacion`
--
ALTER TABLE `tipos_contratacion`
  MODIFY `id_tipo_contratacion` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_documento`
--
ALTER TABLE `tipos_documento`
  MODIFY `id_tipo_documento` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_jornada`
--
ALTER TABLE `tipos_jornada`
  MODIFY `id_tipo_jornada` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documentos_adjuntos`
--
ALTER TABLE `documentos_adjuntos`
  ADD CONSTRAINT `fk_documentos_emprendimiento` FOREIGN KEY (`id_emprendimiento`) REFERENCES `emprendimientos` (`id_emprendimiento`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_documentos_postulante` FOREIGN KEY (`id_postulante`) REFERENCES `postulantes` (`id_postulante`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_documentos_tipo` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipos_documento` (`id_tipo_documento`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `emprendimientos`
--
ALTER TABLE `emprendimientos`
  ADD CONSTRAINT `fk_emprendimientos_estado` FOREIGN KEY (`id_estado_emprendimiento`) REFERENCES `estados_emprendimiento` (`id_estado_emprendimiento`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_emprendimientos_postulante` FOREIGN KEY (`id_postulante_emprendedor`) REFERENCES `postulantes` (`id_postulante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_emprendimientos_rubro` FOREIGN KEY (`id_rubro`) REFERENCES `rubros` (`id_rubro`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `fk_empresas_rubros` FOREIGN KEY (`id_rubro`) REFERENCES `rubros` (`id_rubro`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_empresas_tamano` FOREIGN KEY (`id_tamano_empresa`) REFERENCES `tamano_empresas` (`id_tamano_empresa`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `experiencias_laborales`
--
ALTER TABLE `experiencias_laborales`
  ADD CONSTRAINT `fk_experiencias_postulante` FOREIGN KEY (`id_postulante`) REFERENCES `postulantes` (`id_postulante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `formaciones_academicas`
--
ALTER TABLE `formaciones_academicas`
  ADD CONSTRAINT `fk_formaciones_nivel` FOREIGN KEY (`id_nivel_estudio`) REFERENCES `niveles_estudio` (`id_nivel_estudio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_formaciones_postulante` FOREIGN KEY (`id_postulante`) REFERENCES `postulantes` (`id_postulante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas_laborales`
--
ALTER TABLE `ofertas_laborales`
  ADD CONSTRAINT `fk_ofertas_empresas` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ofertas_estado` FOREIGN KEY (`id_estado_oferta`) REFERENCES `estados_oferta` (`id_estado_oferta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ofertas_rubros` FOREIGN KEY (`id_rubro`) REFERENCES `rubros` (`id_rubro`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ofertas_tipo_contratacion` FOREIGN KEY (`id_tipo_contratacion`) REFERENCES `tipos_contratacion` (`id_tipo_contratacion`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ofertas_tipo_jornada` FOREIGN KEY (`id_tipo_jornada`) REFERENCES `tipos_jornada` (`id_tipo_jornada`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ofertas_tipo_postulante_obj` FOREIGN KEY (`id_tipo_postulante_objetivo`) REFERENCES `tipos_postulante` (`id_tipo_postulante`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  ADD CONSTRAINT `fk_postulaciones_estado` FOREIGN KEY (`id_estado_postulacion`) REFERENCES `estados_postulacion` (`id_estado_postulacion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_postulaciones_ofertas` FOREIGN KEY (`id_oferta`) REFERENCES `ofertas_laborales` (`id_oferta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_postulaciones_postulantes` FOREIGN KEY (`id_postulante`) REFERENCES `postulantes` (`id_postulante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `postulantes`
--
ALTER TABLE `postulantes`
  ADD CONSTRAINT `fk_postulantes_empresas` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_postulantes_estado` FOREIGN KEY (`id_estado_postulante`) REFERENCES `estados_postulante` (`id_estado_postulante`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_postulantes_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_postulantes_tipo` FOREIGN KEY (`id_tipo_postulante`) REFERENCES `tipos_postulante` (`id_tipo_postulante`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_postulantes_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesionales`
--
ALTER TABLE `profesionales`
  ADD CONSTRAINT `fk_profesionales_postulantes` FOREIGN KEY (`id_postulante`) REFERENCES `postulantes` (`id_postulante`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
