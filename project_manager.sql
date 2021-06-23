-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-06-2021 a las 20:35:07
-- Versión del servidor: 8.0.25
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `project_manager`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `idactividad` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `responsable` int NOT NULL,
  `fecha` date NOT NULL,
  `lugar` varchar(200) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `indicador_idindicador` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexo`
--

CREATE TABLE `anexo` (
  `idanexo` int NOT NULL,
  `evidencia_idevidencia` int NOT NULL,
  `ruta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `nombre` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evidencia`
--

CREATE TABLE `evidencia` (
  `idevidencia` int NOT NULL,
  `observaciones` text NOT NULL,
  `actividad_idactividad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador`
--

CREATE TABLE `indicador` (
  `idindicador` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `responsable` int NOT NULL,
  `estado` varchar(30) NOT NULL,
  `proyecto_idproyecto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `etiqueta` varchar(255) NOT NULL,
  `controlador` varchar(255) NOT NULL,
  `icono` varchar(255) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'activo',
  `cod_padre` int NOT NULL DEFAULT '0',
  `orden` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `nombre`, `etiqueta`, `controlador`, `icono`, `estado`, `cod_padre`, `orden`) VALUES
(1, 'modulo_perfil', 'Perfiles', 'Cperfil', 'fa-users', 'activo', 0, 1),
(2, 'modulo_usuario', 'Usuarios', 'Cusuario', 'fa-user-alt', 'activo', 0, 2),
(3, 'modulo_programa', 'Programas', '', 'fa-tasks', 'activo', 0, 3),
(4, 'modulo_lista_programas', 'Lista', 'Cprograma', 'fa-clipboard-list', 'activo', 3, 1),
(5, 'modulo_mis_programas', 'Mis Programas', 'Cprograma/filtro_responsable', 'fa-clipboard-list', 'activo', 3, 2),
(6, 'modulo_proyecto', 'Proyectos', '', 'fa-project-diagram', 'activo', 0, 4),
(7, 'modulo_lista_proyectos', 'Lista', 'Cproyecto', 'fa-clipboard-list', 'activo', 6, 1),
(8, 'modulo_mis_proyectos', 'Mis Proyectos', 'Cproyecto/filtro_responsable', 'fa-clipboard-list', 'activo', 6, 2),
(9, 'modulo_indicadores', 'Indicadores', '', 'fa-chart-line', 'activo', 0, 5),
(10, 'modulo_lista_indicadores', 'Lista', 'Cindicador', 'fa-clipboard-list', 'activo', 9, 1),
(11, 'modulo_mis_indicadores', 'Mis Indicadores', 'Cindicador/filtro_responsable', 'fa-clipboard-list', 'activo', 9, 2),
(12, 'modulo_actividades', 'Actividades', '', 'fa-file-signature', 'activo', 0, 6),
(13, 'modulo_lista_actividades', 'Lista', 'Cactividad', 'fa-clipboard-list', 'activo', 12, 1),
(14, 'modulo_mis_actividades', 'Mis Actividades', 'Cactividad/filtro_responsable', 'fa-clipboard-list', 'activo', 12, 2),
(15, 'modulo_inscribir_actividades', 'Inscribirse', 'Cactividad/inscribirse', 'fa-clipboard-list', 'activo', 12, 3),
(16, 'modulo_actividades_participando', 'Participando', 'Cactividad/participando', 'fa-clipboard-list', 'activo', 12, 4),
(17, 'modulo_reportes', 'Reportes y Gráficos', '', 'fa-chart-bar', 'activo', 0, 7),
(18, 'modulo_reporte_programas', 'Programas', 'Cprograma/reporte', 'fa-clipboard-list', 'activo', 17, 1),
(19, 'modulo_reporte_proyectos', 'Proyectos', 'Cproyecto/reporte', 'fa-clipboard-list', 'activo', 17, 2),
(20, 'modulo_reporte_indicadores', 'Indicadores', 'Cindicador/reporte', 'fa-clipboard-list', 'activo', 17, 3),
(21, 'modulo_reporte_actividades', 'Actividades', 'Cactividad/reporte', 'fa-clipboard-list', 'activo', 17, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

CREATE TABLE `participante` (
  `idparticipante` int NOT NULL,
  `usuario_idusuario` int NOT NULL,
  `actividad_idactividad` int NOT NULL,
  `estado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `idperfil` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idperfil`, `nombre`, `estado`) VALUES
(1, 'Administrador', 'activo'),
(2, 'Empleado', 'activo'),
(3, 'Cliente', 'inactivo'),
(4, 'Participante', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int NOT NULL,
  `perfil_idperfil` int NOT NULL,
  `modulo_idmodulo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `perfil_idperfil`, `modulo_idmodulo`) VALUES
(22, 1, 1),
(74, 1, 2),
(75, 1, 3),
(76, 1, 4),
(77, 1, 5),
(78, 1, 6),
(79, 1, 7),
(80, 1, 8),
(81, 1, 9),
(82, 1, 10),
(83, 1, 11),
(84, 1, 12),
(85, 1, 13),
(86, 1, 14),
(87, 1, 15),
(88, 1, 16),
(89, 1, 17),
(90, 1, 18),
(91, 1, 19),
(92, 1, 20),
(93, 1, 21),
(94, 2, 3),
(95, 2, 5),
(96, 2, 6),
(97, 2, 8),
(98, 2, 9),
(99, 2, 11),
(100, 2, 12),
(101, 2, 14),
(102, 2, 15),
(103, 2, 16),
(104, 2, 17),
(105, 2, 18),
(106, 2, 19),
(107, 2, 20),
(108, 2, 21),
(109, 4, 12),
(110, 4, 15),
(111, 4, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `idprograma` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text,
  `responsable` int NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`idprograma`, `nombre`, `descripcion`, `responsable`, `estado`) VALUES
(1, 'Programa 1', 'Pruebas', 1, 'activo'),
(2, 'Programa 2', 'Prueba 2', 6, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `idproyecto` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  `responsable` int NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado` varchar(30) NOT NULL,
  `programa_idprograma` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_identificacion`
--

CREATE TABLE `tipo_identificacion` (
  `idtipo_identificacion` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_identificacion`
--

INSERT INTO `tipo_identificacion` (`idtipo_identificacion`, `nombre`, `estado`) VALUES
(1, 'CÉDULA DE CIUDADANÍA', 'activo'),
(2, 'CÉDULA DE EXTRANJERÍA', 'activo'),
(3, 'NIT', 'activo'),
(4, 'PASAPORTE', 'activo'),
(5, 'REGISTRO CIVIL', 'activo'),
(6, 'TARJETA DE EXTRANJERÍA', 'activo'),
(7, 'TARJETA DE IDENTIDAD', 'activo'),
(8, 'TIPO DE DOCUMENTO EXTRANJERO', 'activo'),
(9, 'OTROS', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int NOT NULL,
  `identificacion` varchar(30) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `direccion` varchar(60) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'activo',
  `tipo_identificacion_idtipo_identificacion` int NOT NULL,
  `perfil_idperfil` int NOT NULL,
  `token` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `identificacion`, `nombres`, `apellidos`, `correo`, `telefono`, `direccion`, `fecha_nacimiento`, `password`, `estado`, `tipo_identificacion_idtipo_identificacion`, `perfil_idperfil`, `token`) VALUES
(1, '1093226956', 'Jheison', 'Vargas Vargas', 'jheison.vargas@unisarc.edu.co', '3104461256', 'CR 15B 20-31', '1996-08-09', '4f07343be927786fd841b4ab582cf0e9bced6ef97b799bc6354c7ec6d3cbb305', 'activo', 1, 1, ''),
(5, '1093226957', 'Carlos', 'Gomez', 'carlos@gmail.com', '3104461257', 'CR 15B 20-32', '1996-08-09', 'd7f1a1f6e7e30054b0d132d60c12eea42e5cc7761c9950e0fd3f56cf6d4f3560', 'activo', 1, 1, NULL),
(6, '1093226958', 'Andres', 'Farfan', 'andres@email.com', '3104461258', 'CR 15B 20-33', '1998-06-16', 'a9f4e06b3d7682eae4b86805cd223b004f7dc370984153a6b135e68c0eb5576a', 'activo', 1, 2, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`idactividad`);

--
-- Indices de la tabla `anexo`
--
ALTER TABLE `anexo`
  ADD PRIMARY KEY (`idanexo`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `evidencia`
--
ALTER TABLE `evidencia`
  ADD PRIMARY KEY (`idevidencia`);

--
-- Indices de la tabla `indicador`
--
ALTER TABLE `indicador`
  ADD PRIMARY KEY (`idindicador`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`idparticipante`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idperfil`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`,`perfil_idperfil`,`modulo_idmodulo`),
  ADD KEY `fk_permiso_perfil1_idx` (`perfil_idperfil`),
  ADD KEY `fk_permiso_modulo1_idx` (`modulo_idmodulo`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`idprograma`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`idproyecto`);

--
-- Indices de la tabla `tipo_identificacion`
--
ALTER TABLE `tipo_identificacion`
  ADD PRIMARY KEY (`idtipo_identificacion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`,`tipo_identificacion_idtipo_identificacion`,`perfil_idperfil`),
  ADD UNIQUE KEY `identificacion_UNIQUE` (`identificacion`),
  ADD KEY `fk_usuario_tipo_identificacion_idx` (`tipo_identificacion_idtipo_identificacion`),
  ADD KEY `fk_usuario_perfil1_idx` (`perfil_idperfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `idactividad` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anexo`
--
ALTER TABLE `anexo`
  MODIFY `idanexo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evidencia`
--
ALTER TABLE `evidencia`
  MODIFY `idevidencia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `indicador`
--
ALTER TABLE `indicador`
  MODIFY `idindicador` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `participante`
--
ALTER TABLE `participante`
  MODIFY `idparticipante` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idperfil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `idprograma` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `idproyecto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_identificacion`
--
ALTER TABLE `tipo_identificacion`
  MODIFY `idtipo_identificacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`perfil_idperfil`) REFERENCES `perfil` (`idperfil`),
  ADD CONSTRAINT `fk_usuario_tipo_identificacion` FOREIGN KEY (`tipo_identificacion_idtipo_identificacion`) REFERENCES `tipo_identificacion` (`idtipo_identificacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
