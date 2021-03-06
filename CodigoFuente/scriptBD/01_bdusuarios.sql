-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-03-2020 a las 21:56:54
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
-- Base de datos: `bdusuarios`
--
DROP DATABASE IF EXISTS `bdusuarios`;
CREATE DATABASE IF NOT EXISTS `bdusuarios` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bdusuarios`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `nombre`) VALUES
(7, 'Usuarios'),
(8, 'Roles'),
(9, 'Permisos'),
(11, 'Salir'),
(12, 'Ingresar'),
(13, 'Carreras'),
(14, 'Planes'),
(15, 'Asignaturas'),
(16, 'Profesores'),
(17, 'Generar Programa PDF'),
(18, 'Subir Programa Firmado'),
(19, 'Subir Plan'),
(20, 'Gestionar Programa'),
(21, 'Gestionar Bibliografia'),
(22, 'Seguir Programa'),
(23, 'Enviar Notificacion'),
(24, 'Revisar Programa'),
(25, 'Carga Masiva Programas'),
(26, 'Generar Informe Gerencial'),
(27, 'Ver Vigencia de Programas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(8, 'Administrador'),
(9, 'Profesor'),
(10, 'Director de Departamento'),
(11, 'Secretaría Académica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE `rol_permiso` (
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol_permiso`
--

INSERT INTO `rol_permiso` (`id_rol`, `id_permiso`) VALUES
(8, 7),
(8, 8),
(8, 9),
(8, 11),
(9, 11),
(9, 17),
(9, 20),
(9, 21),
(10, 11),
(10, 24),
(11, 11),
(11, 13),
(11, 14),
(11, 15),
(11, 16),
(11, 17),
(11, 18),
(11, 19),
(11, 22),
(11, 23),
(11, 24),
(11, 25),
(11, 26),
(11, 27);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`) VALUES
(44, 'aalvarez', 'aalvarez@uarg.unpa.edu.ar'),
(34, 'apac', 'apac@uarg.unpa.edu.ar'),
(50, 'asofia', 'asofia@uarg.unpa.edu.ar'),
(49, 'clivacic', 'clivacic@uarg.unpa.edu.ar'),
(41, 'cmansilla', 'cmansilla@uarg.unpa.edu.ar'),
(38, 'ctalay', 'ctalay@uarg.unpa.edu.ar'),
(48, 'dlaguia', 'dalaguia@uarg.unpa.edu.ar'),
(29, 'Director Departamento Cs. Naturales y Exactas', 'dcienciasnaturalesyexactas@gmail.com'),
(28, 'Directora Departamento Cs. Sociales', 'dcienciasociales@gmail.com'),
(23, 'Eder dos Santos', 'esantos@uarg.unpa.edu.ar'),
(32, 'Fabricio Gonzalez', 'fabriciowgonzalez@gmail.com'),
(24, 'Francisco Estrada', 'franciscoestrada2395@gmail.com'),
(42, 'hreinaga', 'hreinaga@uarg.unpa.edu.ar'),
(35, 'jnaguil', 'jnaguil@uarg.unpa.edu.ar'),
(47, 'khallar', 'khallar@uarg.unpa.edu.ar'),
(36, 'lburgos', 'lburgos@uarg.unpa.edu.ar'),
(39, 'ldallacosta', 'ldallacosta@uarg.unpa.edu.ar'),
(37, 'livanisevich', 'livanisevich@uarg.unpa.edu.ar'),
(43, 'msandoval', 'msandoval@uarg.unpa.edu.ar'),
(33, 'Nicolás Sartini', 'nsartini66@gmail.com'),
(40, 'hsotoperez', 'profesor.uarg@gmail.com'),
(46, 'scasas', 'scasas@uarg.unpa.edu.ar'),
(31, 'Secretaría Académica', 'secretariaacademicauniv@gmail.com'),
(45, 'waltamirano', 'waltamirano@uarg.unpa.edu.ar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`id_usuario`, `id_rol`) VALUES
(23, 8),
(24, 8),
(28, 10),
(29, 10),
(31, 11),
(32, 8),
(33, 8),
(34, 9),
(35, 9),
(36, 9),
(37, 9),
(38, 9),
(39, 9),
(40, 9),
(41, 9),
(42, 9),
(43, 9),
(44, 9),
(45, 9),
(46, 9),
(47, 9),
(48, 9),
(49, 9),
(50, 9);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID_PERMISO_IND` (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID_ROL_IND` (`id`);

--
-- Indices de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD PRIMARY KEY (`id_rol`,`id_permiso`),
  ADD UNIQUE KEY `ID_ROL_PERMISO_IND` (`id_permiso`,`id_rol`),
  ADD KEY `FKASO_ROL_IND` (`id_rol`),
  ADD KEY `FKASO_PER_idx` (`id_permiso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UN_USUARIO` (`email`,`nombre`),
  ADD UNIQUE KEY `ID_USUARIO_IND` (`id`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id_usuario`,`id_rol`),
  ADD UNIQUE KEY `ID_USUARIO_ROL_IND` (`id_rol`,`id_usuario`),
  ADD KEY `FKVIN_USU_IND` (`id_usuario`),
  ADD KEY `FKVIN_ROL_idx` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD CONSTRAINT `fk_rol_permiso_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rol_permiso_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `fk_usuario_rol_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_rol_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
