-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2019 a las 20:43:17
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdgef_vaspa`
--
CREATE DATABASE IF NOT EXISTS `bdgef_vaspa` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bdgef_vaspa`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id` char(4) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `idDepartamento` int(10) UNSIGNED NOT NULL,
  `contenidosMinimos` text NOT NULL,
  `idProfesor` int(10) UNSIGNED NOT NULL,
  `horasSemanales` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipoDedicacion` varchar(45) NOT NULL,
  `tipoCargo` varchar(45) NOT NULL,
  `idProfesorcarg` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id` char(3) NOT NULL,
  `nombre` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativa_de`
--

CREATE TABLE `correlativa_de` (
  `id` int(11) NOT NULL,
  `requisito` enum('Regular','Aprobada') DEFAULT NULL,
  `idAsignatura` char(4) NOT NULL,
  `idAsignatura_Correlativa_Anterior` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecha`
--

CREATE TABLE `fecha` (
  `id` int(10) UNSIGNED NOT NULL,
  `orden` enum('1','2','3','4','5') NOT NULL,
  `fecha1` date NOT NULL,
  `fecha2` date DEFAULT NULL,
  `LLAMADO_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id` int(10) UNSIGNED NOT NULL,
  `referencia` varchar(20),
  `apellido` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `anioEdicion` year(4) NOT NULL,
  `titulo` text NOT NULL,
  `capitulo` varchar(45),
  `lugarEdicion` varchar(45),
  `editorial` varchar(45) NOT NULL,
  `unidad` varchar(30),
  `biblioteca` varchar(4),
  `siunpa` varchar(4),
  `otro` varchar(20),
  `tipoLibro` enum('O','C') NOT NULL,
  `idPrograma` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE `licencia` (
  `id` int(10) UNSIGNED NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `idProfesor` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llamado`
--

CREATE TABLE `llamado` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` enum('general','todotiempo','extraordinaria') NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llamado_mesa_examen`
--

CREATE TABLE `llamado_mesa_examen` (
  `idLlamado` int(10) UNSIGNED NOT NULL,
  `idMesa` int(10) UNSIGNED NOT NULL,
  `hora` time NOT NULL,
  `fechaUnica` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa_examen`
--

CREATE TABLE `mesa_examen` (
  `id` int(10) UNSIGNED NOT NULL,
  `idTribunal` int(10) UNSIGNED NOT NULL,
  `codAsignatura` char(4) NOT NULL,
  `orden` enum('1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa_examen_carrera`
--

CREATE TABLE `mesa_examen_carrera` (
  `codMesa` int(10) UNSIGNED NOT NULL,
  `codCarrera` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otro_material`
--

CREATE TABLE `otro_material` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` text NOT NULL,
  `idPrograma` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE `plan` (
  `id` varchar(10) NOT NULL,
  `anio_inicio` year(4) NOT NULL,
  `idCarrera` char(3) NOT NULL,
  `anio_fin` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_asignatura`
--

CREATE TABLE `plan_asignatura` (
  `idPlan` varchar(10) NOT NULL,
  `idAsignatura` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_pdf`
--

CREATE TABLE `plan_pdf` (
  `nombre` varchar(70) NOT NULL,
  `descripcion` text,
  `ruta` varchar(100) NOT NULL,
  `tamanio` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id` int(10) UNSIGNED NOT NULL,
  `dni` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `preferencias` varchar(45) DEFAULT NULL,
  `idDepartamento` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_asignatura`
--

CREATE TABLE `profesor_asignatura` (
  `idAsignatura` char(4) NOT NULL,
  `idProfesor` int(10) UNSIGNED NOT NULL,
  `rol` enum('teoria','practica') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `id` int(10) UNSIGNED NOT NULL,
  `anio` year(4) NOT NULL,
  `anioCarrera` enum('1','2','3','4','5') NOT NULL,
  `horasTeoria` time NOT NULL,
  `horasPractica` time NOT NULL,
  `horasOtros` time DEFAULT NULL,
  `regimenCursada` enum('A','1','2','O') NOT NULL,
  `observacionesHoras` text,
  `observacionesCursada` text,
  `fundamentacion` text NOT NULL,
  `objetivosGenerales` text NOT NULL,
  `organizacionContenidos` text NOT NULL,
  `criteriosEvaluacion` text NOT NULL,
  `metodologiaPresencial` text NOT NULL,
  `regularizacionPresencial` text NOT NULL,
  `aprobacionPresencial` text NOT NULL,
  `metodologiaSATEP` text NOT NULL,
  `regularizacionSATEP` text NOT NULL,
  `aprobacionSATEP` text NOT NULL,
  `metodologiaLibre` text NOT NULL,
  `aprobacionLibre` text NOT NULL,
  `ubicacion` enum('SA','DPTO') DEFAULT NULL,
  `idAsignatura` char(4) NOT NULL,
  `aprobadoSa` bit,
  `aprobadoDepto` bit,
  `fechaCarga` date NOT NULL,
  `vigencia` enum('1','2','3') NOT NULL,
  `comentarioSa` text,
  `comentarioDepto` text,
  `enRevision` bit
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_pdf`
--

CREATE TABLE `programa_pdf` (
  `nombre` varchar(70) NOT NULL,
  `anio` year(4) NOT NULL,
  `descripcion` text,
  `ruta` varchar(100) NOT NULL,
  `tamanio` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recurso`
--

CREATE TABLE `recurso` (
  `id` int(10) UNSIGNED NOT NULL,
  `apellido` varchar(45),
  `nombre` varchar(45),
  `titulo` text NOT NULL,
  `datosAdicionales` varchar(45),
  `disponibilidad` varchar(100) NOT NULL,
  `idPrograma` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_notificacion`
--

CREATE TABLE `registro_notificacion` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `observaciones` text,
  `idProfesor` int(10) UNSIGNED NOT NULL,
  `idAsignatura` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revista`
--

CREATE TABLE `revista` (
  `id` int(10) UNSIGNED NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tituloArticulo` text NOT NULL,
  `tituloRevista` text NOT NULL,
  `pagina` varchar(20),
  `fecha` date,
  `unidad` varchar(20),
  `biblioteca` varchar(4),
  `siunpa` varchar(4),
  `otro` varchar(20),
  `idPrograma` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_licencia`
--

CREATE TABLE `tipo_licencia` (
  `nombre` int(10) UNSIGNED NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `idLicencia` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tribunal`
--

CREATE TABLE `tribunal` (
  `id` int(10) UNSIGNED NOT NULL,
  `presidente` int(10) UNSIGNED NOT NULL,
  `vocal` int(10) UNSIGNED NOT NULL,
  `vocal1` int(10) UNSIGNED DEFAULT NULL,
  `suplente` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ASIGNATURA_PROFESOR_idx` (`idProfesor`),
  ADD KEY `fk_ASIGNATURA_DEPARTAMENTO1_idx` (`idDepartamento`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_CARGO_PROFESOR1_idx` (`idProfesorcarg`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `correlativa_de`
--
ALTER TABLE `correlativa_de`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_CORRELATIVA_DE_ASIGNATURA1_idx` (`idAsignatura`),
  ADD KEY `fk_CORRELATIVA_DE_ASIGNATURA2_idx` (`idAsignatura_Correlativa_Anterior`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fecha`
--
ALTER TABLE `fecha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_table1_LLAMADO_idx` (`LLAMADO_id`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPrograma_idx` (`idPrograma`);

--
-- Indices de la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_LICENCIA_PROFESOR_idx` (`idProfesor`);

--
-- Indices de la tabla `llamado`
--
ALTER TABLE `llamado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `llamado_mesa_examen`
--
ALTER TABLE `llamado_mesa_examen`
  ADD KEY `fk_LLAMADO_has_MESA_EXAMEN_MESA_EXAMEN1_idx` (`idMesa`),
  ADD KEY `fk_LLAMADO_has_MESA_EXAMEN_LLAMADO1_idx` (`idLlamado`);

--
-- Indices de la tabla `mesa_examen`
--
ALTER TABLE `mesa_examen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_MESA_EXAMEN_TRIBUNAL_idx` (`idTribunal`),
  ADD KEY `fk_MESA_EXAMEN_ASIGNATURA_idx` (`codAsignatura`);

--
-- Indices de la tabla `mesa_examen_carrera`
--
ALTER TABLE `mesa_examen_carrera`
  ADD KEY `fk_MESA_EXAMEN_has_CARRERA_CARRERA1_idx` (`codCarrera`),
  ADD KEY `fk_MESA_EXAMEN_has_CARRERA_MESA_EXAMEN1_idx` (`codMesa`);

--
-- Indices de la tabla `otro_material`
--
ALTER TABLE `otro_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_OTRO_MATERIAL_PROGRAMA1_idx` (`idPrograma`);

--
-- Indices de la tabla `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_PLAN_CARRERA_idx` (`idCarrera`);

--
-- Indices de la tabla `plan_asignatura`
--
ALTER TABLE `plan_asignatura`
  ADD KEY `fk_PLAN_ASIGNATURA_ASIGNATURA_idx` (`idAsignatura`),
  ADD KEY `fk_PLAN_ASIGNATURA_PLAN_idx` (`idPlan`);

--
-- Indices de la tabla `plan_pdf`
--
ALTER TABLE `plan_pdf`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_PROFESOR_DEPARTAMENTO_idx` (`idDepartamento`);

--
-- Indices de la tabla `profesor_asignatura`
--
ALTER TABLE `profesor_asignatura`
  ADD KEY `fk_PROFESOR_ASIGNATURA_ASIGNATURA1_idx` (`idAsignatura`),
  ADD KEY `fk_PROFESOR_ASIGNATURA_PROFESOR1_idx` (`idProfesor`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_PROGRAMA_ASIGNATURA_idx` (`idAsignatura`);

--
-- Indices de la tabla `programa_pdf`
--
ALTER TABLE `programa_pdf`
  ADD PRIMARY KEY (`nombre`,`anio`),
  ADD KEY `fk_PROGRAMA_PDF_ANIO1_idx` (`anio`);

--
-- Indices de la tabla `recurso`
--
ALTER TABLE `recurso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_RECURSO_PROGRAMA1_idx` (`idPrograma`);

--
-- Indices de la tabla `registro_notificacion`
--
ALTER TABLE `registro_notificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_REGISTRO_NOTIFICACION_PROFESOR_idx` (`idProfesor`),
  ADD KEY `fk_REGISTRO_NOTIFICACION_ASIGNATURA_idx` (`idAsignatura`);

--
-- Indices de la tabla `revista`
--
ALTER TABLE `revista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_REVISTA_PROGRAMA1_idx` (`idPrograma`);

--
-- Indices de la tabla `tipo_licencia`
--
ALTER TABLE `tipo_licencia`
  ADD KEY `fk_TIPO_LICENCIA_LICENCIA_idx` (`idLicencia`);

--
-- Indices de la tabla `tribunal`
--
ALTER TABLE `tribunal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_TRIBUNAL_PROFESOR1_idx` (`presidente`),
  ADD KEY `fk_TRIBUNAL_PROFESOR2_idx` (`vocal`),
  ADD KEY `fk_TRIBUNAL_PROFESOR3_idx` (`vocal1`),
  ADD KEY `fk_TRIBUNAL_PROFESOR4_idx` (`suplente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `correlativa_de`
--
ALTER TABLE `correlativa_de`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fecha`
--
ALTER TABLE `fecha`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `llamado`
--
ALTER TABLE `llamado`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa_examen`
--
ALTER TABLE `mesa_examen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `otro_material`
--
ALTER TABLE `otro_material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recurso`
--
ALTER TABLE `recurso`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro_notificacion`
--
ALTER TABLE `registro_notificacion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `revista`
--
ALTER TABLE `revista`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tribunal`
--
ALTER TABLE `tribunal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `fk_ASIGNATURA_DEPARTAMENTO1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ASIGNATURA_PROFESOR` FOREIGN KEY (`idProfesor`) REFERENCES `profesor` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD CONSTRAINT `fk_CARGO_PROFESOR1` FOREIGN KEY (`idProfesorcarg`) REFERENCES `profesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `correlativa_de`
--
ALTER TABLE `correlativa_de`
  ADD CONSTRAINT `fk_CORRELATIVA_DE_ASIGNATURA1` FOREIGN KEY (`idAsignatura`) REFERENCES `asignatura` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_CORRELATIVA_DE_ASIGNATURA2` FOREIGN KEY (`idAsignatura_Correlativa_Anterior`) REFERENCES `asignatura` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `fecha`
--
ALTER TABLE `fecha`
  ADD CONSTRAINT `fk_table1_LLAMADO` FOREIGN KEY (`LLAMADO_id`) REFERENCES `llamado` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `idPrograma` FOREIGN KEY (`idPrograma`) REFERENCES `programa` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD CONSTRAINT `fk_LICENCIA_PROFESOR` FOREIGN KEY (`idProfesor`) REFERENCES `profesor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `llamado_mesa_examen`
--
ALTER TABLE `llamado_mesa_examen`
  ADD CONSTRAINT `fk_LLAMADO_has_MESA_EXAMEN_LLAMADO1` FOREIGN KEY (`idLlamado`) REFERENCES `llamado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_LLAMADO_has_MESA_EXAMEN_MESA_EXAMEN1` FOREIGN KEY (`idMesa`) REFERENCES `mesa_examen` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa_examen`
--
ALTER TABLE `mesa_examen`
  ADD CONSTRAINT `fk_MESA_EXAMEN_ASIGNATURA` FOREIGN KEY (`codAsignatura`) REFERENCES `asignatura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_MESA_EXAMEN_TRIBUNAL` FOREIGN KEY (`idTribunal`) REFERENCES `tribunal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa_examen_carrera`
--
ALTER TABLE `mesa_examen_carrera`
  ADD CONSTRAINT `fk_MESA_EXAMEN_has_CARRERA_CARRERA1` FOREIGN KEY (`codCarrera`) REFERENCES `carrera` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_MESA_EXAMEN_has_CARRERA_MESA_EXAMEN1` FOREIGN KEY (`codMesa`) REFERENCES `mesa_examen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `otro_material`
--
ALTER TABLE `otro_material`
  ADD CONSTRAINT `fk_OTRO_MATERIAL_PROGRAMA1` FOREIGN KEY (`idPrograma`) REFERENCES `programa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `fk_PLAN_CARRERA` FOREIGN KEY (`idCarrera`) REFERENCES `carrera` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `plan_asignatura`
--
ALTER TABLE `plan_asignatura`
  ADD CONSTRAINT `fk_PLAN_ASIGNATURA` FOREIGN KEY (`idAsignatura`) REFERENCES `asignatura` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_PLAN_ASIGNATURA_PLAN` FOREIGN KEY (`idPlan`) REFERENCES `plan` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `fk_PROFESOR_DEPARTAMENTO` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesor_asignatura`
--
ALTER TABLE `profesor_asignatura`
  ADD CONSTRAINT `fk_PROFESOR_ASIGNATURA_ASIGNATURA1` FOREIGN KEY (`idAsignatura`) REFERENCES `asignatura` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PROFESOR_ASIGNATURA_PROFESOR1` FOREIGN KEY (`idProfesor`) REFERENCES `profesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `programa`
--
ALTER TABLE `programa`
  ADD CONSTRAINT `fk_PROGRAMA_ASIGNATURA` FOREIGN KEY (`idAsignatura`) REFERENCES `asignatura` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `recurso`
--
ALTER TABLE `recurso`
  ADD CONSTRAINT `fk_RECURSO_PROGRAMA1` FOREIGN KEY (`idPrograma`) REFERENCES `programa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registro_notificacion`
--
ALTER TABLE `registro_notificacion`
  ADD CONSTRAINT `fk_REGISTRO_NOTIFICACION_ASIGNATURA` FOREIGN KEY (`idAsignatura`) REFERENCES `asignatura` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_REGISTRO_NOTIFICACION_PROFESOR` FOREIGN KEY (`idProfesor`) REFERENCES `profesor` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `revista`
--
ALTER TABLE `revista`
  ADD CONSTRAINT `fk_REVISTA_PROGRAMA1` FOREIGN KEY (`idPrograma`) REFERENCES `programa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tipo_licencia`
--
ALTER TABLE `tipo_licencia`
  ADD CONSTRAINT `fk_TIPO_LICENCIA_LICENCIA` FOREIGN KEY (`idLicencia`) REFERENCES `licencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tribunal`
--
ALTER TABLE `tribunal`
  ADD CONSTRAINT `fk_TRIBUNAL_PROFESOR1` FOREIGN KEY (`presidente`) REFERENCES `profesor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_TRIBUNAL_PROFESOR2` FOREIGN KEY (`vocal`) REFERENCES `profesor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_TRIBUNAL_PROFESOR3` FOREIGN KEY (`vocal1`) REFERENCES `profesor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_TRIBUNAL_PROFESOR4` FOREIGN KEY (`suplente`) REFERENCES `profesor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
