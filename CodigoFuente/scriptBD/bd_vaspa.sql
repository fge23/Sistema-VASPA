-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2019 a las 14:43:38
-- Versión del servidor: 10.3.15-MariaDB
-- Versión de PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
SET NAMES utf8;
--
-- Base de datos: `bdgef_vaspa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id` char(4) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `idDepartamento` int(10) UNSIGNED NOT NULL,
  `contenidosMinimos` text NOT NULL,
  `idProfesor` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `nombre`, `idDepartamento`, `contenidosMinimos`, `idProfesor`) VALUES
('0174', 'ProgramaciÃ³n I', 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', 5),
('0175', 'ProgramaciÃ³n II', 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', 5),
('0473', 'IngenierÃ­a de Software', 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', 4),
('1649', 'ResoluciÃ³n de Problemas y Algoritmos', 2, 'Problemas. Algoritmos. Operadores aritmï¿½ticos y lï¿½gicos. Estructuras de control. Nociï¿½n de modularizaciï¿½n. Estructuras de datos lineales: Arreglos. Pilas. Colas. Algoritmos fundamentales: recorrido, bï¿½squeda, ordenamiento, actualizaciï¿½n. Recursividad.', 5),
('1654', 'Requerimientos de Software', 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', 1),
('1658', 'AnÃ¡lisis y DiseÃ±o de Software', 2, 'daasasdsad', 9),
('1659', 'Bases de Datos', 2, 'asdasdasdasd', 10),
('1663', 'ValidaciÃ³n y VerificaciÃ³n de Software', 2, 'asdasdasdsd', 9),
('1668', 'GestiÃ³n de Proyectos de Software', 2, 'Conceptos de gestiÃ³n, PlanificaciÃ³n de proyectos. MÃ©tricas y estimaciÃ³n de costos, esfuerzo y tiempo. Riesgos. OrganizaciÃ³n y personal de proyecto. Control de proyecto. GestiÃ³n de configuraciones de software. ImplantaciÃ³n y EvoluciÃ³n del software', 4),
('1673', 'GestiÃ³n de Calidad', 2, 'asdasdasdasd', 4),
('2138', 'Laboratorio de Desarrollo de Software', 2, 'Herramientas de integración de desarrollo de software. Gestión de Configuraciones. Herramientas de Análisis y Diseño de software. Nociones de sistemas colaborativos.', 4);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id` char(3) NOT NULL,
  `nombre` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`) VALUES
('016', 'Analista de Sistemas'),
('049', 'Profesorado en MatemÃ¡tica'),
('069', 'IngenierÃ­a QuÃ­mica'),
('072', 'Licenciatura en Sistemas');

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

--
-- Volcado de datos para la tabla `correlativa_de`
--

INSERT INTO `correlativa_de` (`id`, `requisito`, `idAsignatura`, `idAsignatura_Correlativa_Anterior`) VALUES
(1, 'Aprobada', '1668', '1658'),
(2, 'Aprobada', '1668', '1659'),
(3, 'Regular', '1668', '1663'),
(4, 'Regular', '1673', '1668');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `nombre`) VALUES
(1, 'Ciencias Sociales'),
(2, 'Ciencias Naturales y Exactas');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id` int(10) UNSIGNED NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `anioEdicion` year(4) NOT NULL,
  `titulo` text NOT NULL,
  `capitulo` varchar(45) NOT NULL,
  `lugarEdicion` varchar(45) NOT NULL,
  `editorial` varchar(45) NOT NULL,
  `unidad` varchar(30) NOT NULL,
  `biblioteca` varchar(4) DEFAULT NULL,
  `siunpa` varchar(4) DEFAULT NULL,
  `otro` varchar(20) DEFAULT NULL,
  `tipoLibro` enum('O','C') NOT NULL,
  `idPrograma` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `referencia`, `apellido`, `nombre`, `anioEdicion`, `titulo`, `capitulo`, `lugarEdicion`, `editorial`, `unidad`, `biblioteca`, `siunpa`, `otro`, `tipoLibro`, `idPrograma`) VALUES
(1, 'ANDA01', 'Anda', 'Bente', 2001, 'Estimating Software Development Effort based on Use Case - Experiencies from Industry. Lecture Notes in Computer Science [LNCS]', 'Vol. 2185 (2001) p. 487-488', 'New York (US)', 'Springer-Verlag Berlín Heidelberg', 'II', '-', '-', 'pdf', 'O', 2),
(2, 'BAHI12', 'Bahit', 'Eugenia', 2006, 'Scrum y eXtreme Programming para Programadores', 'Todo en general. Cap TDD - Test Driven Develo', 'Buenos Aires [AR]', 'Eugenia Bahit', 'I, IV', '-', '-', 'pdf', 'O', 2),
(3, 'COHN05', 'Cohn', 'Mike', 2005, 'Agile Estimating and Planning.', ' ', 'Upper Saddle River [US]', 'Prentice Hall PTR', 'II', 'UARG', ' - ', ' ', 'C', 2),
(4, 'BOEHM81', 'Boehm', 'Barry', 1981, 'Software engineering economics.', ' ', 'New Jersey [US]', 'Prentice Hall', 'II', 'UARG', ' - ', ' - ', 'C', 2);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otro_material`
--

CREATE TABLE `otro_material` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` text NOT NULL,
  `idPrograma` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `otro_material`
--

INSERT INTO `otro_material` (`id`, `descripcion`, `idPrograma`) VALUES
(1, 'Presentaciones realizadas por la cátedra disponibles en formato Power Point y Acrobat Reader en la dirección de internet indicada.', 2);

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

--
-- Volcado de datos para la tabla `plan`
--

INSERT INTO `plan` (`id`, `anio_inicio`, `idCarrera`, `anio_fin`) VALUES
('016P3', 2003, '016', 2006),
('016P4', 2007, '016', 2012),
('016P5', 2013, '016', NULL),
('069P1', 2009, '069', NULL),
('072P1', 2007, '072', 2012),
('072P2', 2013, '072', NULL);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_pdf`
--

CREATE TABLE `plan_pdf` (
  `nombre` varchar(250) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `ruta` varchar(500) NOT NULL,
  `tamanio` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_asignatura`
--

CREATE TABLE `plan_asignatura` (
  `idPlan` varchar(10) NOT NULL,
  `idAsignatura` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `plan_asignatura`
--

INSERT INTO `plan_asignatura` (`idPlan`, `idAsignatura`) VALUES
('016P5', '1649'),
('016P5', '1668'),
('016P5', '2138'),
('072P2', '1649'),
('072P2', '1668'),
('072P2', '2138'),
('016P4', '0174'),
('016P4', '0175'),
('016P4', '0473'),
('016P5', '1654'),
('072P2', '1654');

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
  `idDepartamento` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id`, `dni`, `nombre`, `apellido`, `email`, `idDepartamento`) VALUES
(1, 31323782, 'Karim Omar', 'Hallar', 'fabriciowgonzalez@gmail.com', 2),
(4, 20172723, 'Albert Anibal Osiris', 'Sofia', 'franciscoestrada2395@outlook.es', 2),
(5, 18273827, 'Sandra', 'Casas', 'ns_2510_96@hotmail.com', 2),
(6, 31382983, 'Jorge', 'Climis', 'jclimis@gmail.com', 2),
(7, 18732763, 'Leonardo', 'GonzÃ¡lez', 'lgonzalez@uarg.unpa.edu.ar', 2),
(8, 24326223, 'Claudio', 'Saldivia', 'csaldiviaa@gmail.com', 2),
(9, 18273367, 'Daniel', 'Laguia', 'dalaguiaa@gmail.com', 2),
(10, 17262556, 'Walter', 'Altamirano', 'waaltamirano', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_asignatura`
--

CREATE TABLE `profesor_asignatura` (
  `idAsignatura` char(4) NOT NULL,
  `idProfesor` int(10) UNSIGNED NOT NULL,
  `rol` enum('teoria','practica') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesor_asignatura`
--

INSERT INTO `profesor_asignatura` (`idAsignatura`, `idProfesor`, `rol`) VALUES
('1668', 7, 'practica'),
('1668', 6, 'practica'),
('1649', 8, 'practica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `id` int(10) UNSIGNED NOT NULL,
  `anio` year(4) NOT NULL,
  `anioCarrera` enum('1','2','3','4','5') NOT NULL,
  `horasTeoria` tinyint(4) NOT NULL,
  `horasPractica` tinyint(4) NOT NULL,
  `horasOtros` tinyint(4) DEFAULT NULL,
  `regimenCursada` enum('A','1','2','O') NOT NULL,
  `observacionesHoras` text DEFAULT NULL,
  `observacionesCursada` text DEFAULT NULL,
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
  `aprobadoSa` tinyint(1) NOT NULL,
  `aprobadoDepto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id`, `anio`, `anioCarrera`, `horasTeoria`, `horasPractica`, `horasOtros`, `regimenCursada`, `observacionesHoras`, `observacionesCursada`, `fundamentacion`, `objetivosGenerales`, `organizacionContenidos`, `criteriosEvaluacion`, `metodologiaPresencial`, `regularizacionPresencial`, `aprobacionPresencial`, `metodologiaSATEP`, `regularizacionSATEP`, `aprobacionSATEP`, `metodologiaLibre`, `aprobacionLibre`, `ubicacion`, `idAsignatura`, `aprobadoSa`, `aprobadoDepto`) VALUES
(2, 2018, '3', 2, 2, NULL, '2', NULL, NULL, 'La ingeniería de Software es un campo de las ciencias de la Computación que basado en principios robustos y bajo un enfoque disciplinado y cuantificable, desarrolla y evoluciona productos de software de calidad.\r\nLa gestión de proyectos es un área ampliamente aplicada en otras disciplinas y la ingeniería de software no está exceptuada de ello, tanto en grandes como pequeños proyectos.', 'El objetivo principal es brindar fundamentos para que los alumnos distingan los elementos claves que deben manejar los participantes del Proceso de desarrollo en los proyectos de software. Promover la integración de conceptos, técnicas y herramientas necesarias para diseñar, implementar y controlar sistemas de información. Ser capaz de manejar elementos científicos, técnicas y metodologías necesarias para participar en tareas concernientes al proceso de desarrollo de Software de aplicación.', 'MODULO I  CONCEPTOS BASICOS DE INGENIERIA DE SOFTWARE\r\nSoftware - Conceptos - Evolución y Perspectivas. Objetivos del desarrollo de Software. Rol del Software - Áreas de aplicación. Crisis del Software - Problemas, Causas, y Mitos - Metodología, Técnicas y Herramientas. Paradigmas del desarrollo de Software.\r\n\r\nMODULO II  PLANIFICACION Y GESTION DE PROYECTOS DE SOFTWARE\r\nPlanificación de Proyectos. Métricas y Estimación. Control y Avance. Revisiones e Inspecciones. Evaluación de Factibilidad Técnica. Operativa y Económica. Análisis de Riesgo, Identificación, Evaluación. Gestión Ágil.', 'Con la finalidad de alcanzar los propósitos planteados establecidos para el desarrollo de la asignatura las siguientes estrategias:\r\n- Clases teórico-prácticas\r\n- Trabajos Prácticos\r\n- Lecturas', 'Clases Teórico-Prácticas: se abordan los contenidos detallados en el Programa de la Asignatura y se ejemplifica con casos prácticos.\r\nTrabajos Prácticos: se propone la resolución de ejercicios y casos sobre temas específicos, la lectura y discusión de artículos y la exposición de determinados temas. Los trabajos pueden ser grupales o individuales', '- Presentar y exponer el 100% de los trabajos (trabajos prácticos y lecturas) en las fechas establecidas por la cátedra, según el cronograma de actividades de la asignatura.\r\n- Aprobar los parciales o su respectivo recuperatorio integrador. Esto exámenes se aprobarán con un mínimo del 60% correcto del puntaje total.', 'Se evaluarán los conocimientos a través de un examen final, que podrá tener la modalidad oral o escrita.', 'Esta asignatura NO puede ser impartida en modalidad semiprensencial', '-', '-', 'Los alumnos que deseen rendir en esta modalidad deberán contactarse con el docente a osofia@uarg.unpa.edu.ar, expresando su deseo de rendir la asignatura. El docente coordinará con el alumno una reunión donde le explicará el objetivo y los contenidos de las prácticas propuestas. Además podrá consultar la totalidad del material bibliográfico propuesto.', 'Aprobación Final:\r\n- Presentación de la totalidad de las lecturas al menos 10 días antes del examen.\r\n- Presentación de la totalidad de los ejercicios prácticos propuestos por la cátedra al menos 10 días antes del examen.\r\n- Sección teórica o escrita\r\n- Sección práctica escrita', NULL, '1668', 0, 0),
(3, 2007, '1', 2, 4, 1, 'A', 'Clases de consulta', '', 'El propósito es introducir a los alumnos en el análisis y abstracción de problemas, y diseño de algoritmos. Al finalizar esta asignatura el alumno deberá ser capaz de representar algorítmicamente la solución de problemas de complejidad intermedia. \r\nLa asignatura comienza con la resolución de problemas cotidianos que se pueden dividir en varios pasos; expresándose en forma narrativa. Luego se introducen expresiones algorítmicas (operaciones aritméticas, lógicas, estructuras de control, variables, etc.) en pseudocódigo; tipos de datos simples (Entero, Real, Caracter y Booleano) y compuestos (Arreglos, Pilas y Colas) que se aplican para el diseño y representación de algoritmos a problemas simples de carácter matemático (sumas, productos, promedios, números primos, amigos, perfectos, etc.) mediante una previa especificación del análisis de entradas y salidas. Se concluye con la técnica de recursión.\r\n', '- Conocer y entender los conceptos esenciales de la Programación.\r\n- Aprender y saber aplicar las Estructuras de Control. \r\n- Aprender y saber implementar los Arreglos, las Pilas y las Colas.\r\n- Entender y aprender la técnica de recursividad.\r\n- Entender y saber armar un Programa Modular aplicando OO básico. \r\n- Aprender a codificar en lenguaje Java.', 'UNIDAD I – Problemas y Algoritmos\r\nPrograma, Programador, Programación. Paradigmas de Programación. Lenguajes de Programación. Problema. Análisis del Problema. Algoritmo. Diseño del Algoritmo. Datos. Tipos de datos: Simples (Entero, Real, Caracter y Booleano) y Compuestos. Variables. Constantes. Identificadores. Operaciones primitivas. Asignación. Expresiones Aritméticas. Expresiones Lógicas. Lectura (entrada de datos) y Escritura (salida de datos). \r\n\r\nUNIDAD II - Estructuras de Control\r\nEstructuras de Control: Secuenciación, Selección (SI-SINO, ALTERNAR) e Iteración o bucle (MIENTRAS, HACER-MIENTRAS, PARA). Contadores. Acumuladores. Bucles controlados por contador y suceso. Invariante de bucle.\r\n\r\nUNIDAD III - Programa y Funciones\r\nPrograma (Principal). Estructura general de un Programa. Partes constitutivas de un Programa. Funciones. Declaración e invocación de funciones. Precondiciones y postcondiciones. Variables locales. Parámetros actuales y formales. Ámbitos de los identificadores.\r\n\r\nUNIDAD IV – Clases/Objetos\r\nClases. Objetos. Atributos. Métodos. Constructores. Mensajes. Ventajas: encapsulación, reuso, ocultamiento de la información.\r\n\r\nUNIDAD V - Arreglos\r\nArreglos Unidimensionales (Vectores) y Bidimensionales (Matrices). Manejo de Índices. Operaciones de: asignación, lectura y escritura de datos, recorrido, y actualización. Métodos de Búsqueda (Secuencial y Binaria). Método de Ordenación (Intercambio o Burbuja, Inserción y Selección).\r\n\r\nUNIDAD VI - Java y Laboratorio\r\nLenguaje Java. Pasaje a máquina (de pseudocódigo a Java). Clases y método Main. Referencias en java. Edición. Compilación. Puesta a punto de programas. Paquetes. Modificadores de Acceso. Sobrecarga. Operador This. Arreglos en Java. Clase Vector y Matriz. Clase String (Cadena). Clases estáticas. Clase Random.\r\n', 'La evaluación se plantea como un proceso natural por ello se planifica y diseña como una continuidad de las actividades realizadas. Además, la decisión de fijar 5 (cinco) exámenes y 1 (un) examen recuperatorio general, de carácter práctico, permite obtener rápidamente información acerca de la evolución en el proceso de aprendizaje y detectar a tiempo aquellos casos en los que falta un apuntalamiento, refuerzos y apoyo. Es necesario, contar con un 75% total de asistencia a las clases prácticas. Permite al alumno una mayor dedicación a la resolución de los ejercicios prácticos.', 'La materia consta de 1 (una) clase teórica y 2 (dos) clases prácticas, por semana. Cada unidad posee su teoría y trabajo práctico correspondiente. De acuerdo a la complejidad de los temas, las clases prácticas varían en cantidad de días. Los alumnos cuentan dos semanas antes del examen, con clases de consultas. La resolución de los ejercicios prácticos se realiza en papel (1º cuatrimestre) y en máquina (2º cuatrimestre). Como antes se ha mencionado existen evaluaciones parciales y durante las clases prácticas se toma asistencia, siendo ésta un complemento de evaluación.', '- Cumplir con el 75% de asistencia a las clases prácticas. \r\n- Aprobar todos los exámenes o el recuperatorio general.\r\n', '- Examen escrito (práctico)\r\n- Examen oral (teoría)', 'Los alumnos pueden acudir por asistencia en los días, horarios y lugares en los que la cátedra se dicta. Para mayor información ingresar a la página web del área: http://espanol.geocities.com/profeprog/', 'No aplica', '- Examen escrito (práctico)\r\n- Examen oral (teoría)', 'Podrán contar con el apunte de cátedra y los prácticos correspondientes. Se aceptan consultas. Para rendir el final, sólo tendrán que asistir al mismo habiendo practicado lo suficiente y conocer los conceptos teóricos que se encuentran en el apunte de cátedra, como para estar en condiciones de rendir. Para mayor información ingresar a la página web del área: http://espanol.geocities.com/profeprog/', '- Igual que los alumnos presenciales, solo que incorporando un ejercicio más', NULL, '1649', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_pdf`
--

CREATE TABLE `programa_pdf` (
  `nombre` varchar(70) NOT NULL,
  `anio` year(4) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `ruta` varchar(100) NOT NULL,
  `tamanio` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recurso`
--

CREATE TABLE `recurso` (
  `id` int(10) UNSIGNED NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `titulo` text NOT NULL,
  `datosAdicionales` varchar(45) DEFAULT NULL,
  `disponibilidad` varchar(100) NOT NULL,
  `idPrograma` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recurso`
--

INSERT INTO `recurso` (`id`, `apellido`, `nombre`, `titulo`, `datosAdicionales`, `disponibilidad`, `idPrograma`) VALUES
(1, 'Sofia', 'Albert Osiris', 'Ingeniería de Software', NULL, 'http://sistemas.uarg.unpa.edu.ar/asignaturas/gps/', 2),
(2, 'IEEE', 'IEE', 'IEEE', NULL, 'http://www.ieee.org/', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_notificacion`
--

CREATE TABLE `registro_notificacion` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `observaciones` text DEFAULT NULL,
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
  `pagina` varchar(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `unidad` varchar(20) DEFAULT NULL,
  `biblioteca` varchar(4) DEFAULT NULL,
  `siunpa` varchar(4) DEFAULT NULL,
  `otro` varchar(20) DEFAULT NULL,
  `idPrograma` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `revista`
--

INSERT INTO `revista` (`id`, `apellido`, `nombre`, `tituloArticulo`, `tituloRevista`, `pagina`, `fecha`, `unidad`, `biblioteca`, `siunpa`, `otro`, `idPrograma`) VALUES
(1, 'sadasda', '1233wwqeqwe', 'wqeqwdsaqwerasd', 'ewaeawedasdad', 'e2312e', '0000-00-00', 'r2343rfe', 'gjgh', 'cvbc', 'bcvbc', 3);


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
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPrograma_idx` (`idPrograma`);

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
-- Indices de la tabla `plan_pdf`
--
ALTER TABLE `plan_pdf`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `plan_asignatura`
--
ALTER TABLE `plan_asignatura`
  ADD KEY `fk_PLAN_ASIGNATURA_ASIGNATURA_idx` (`idAsignatura`),
  ADD KEY `fk_PLAN_ASIGNATURA_PLAN_idx` (`idPlan`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`),
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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `correlativa_de`
--
ALTER TABLE `correlativa_de`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `otro_material`
--
ALTER TABLE `otro_material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `recurso`
--
ALTER TABLE `recurso`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `registro_notificacion`
--
ALTER TABLE `registro_notificacion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `revista`
--
ALTER TABLE `revista`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Filtros para la tabla `correlativa_de`
--
ALTER TABLE `correlativa_de`
  ADD CONSTRAINT `fk_CORRELATIVA_DE_ASIGNATURA1` FOREIGN KEY (`idAsignatura`) REFERENCES `asignatura` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_CORRELATIVA_DE_ASIGNATURA2` FOREIGN KEY (`idAsignatura_Correlativa_Anterior`) REFERENCES `asignatura` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `idPrograma` FOREIGN KEY (`idPrograma`) REFERENCES `programa` (`id`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_REGISTRO_NOTIFICACION_PROFESOR` FOREIGN KEY (`idProfesor`) REFERENCES `profesor` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_REGISTRO_NOTIFICACION_ASIGNATURA` FOREIGN KEY (`idAsignatura`) REFERENCES `asignatura` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `revista`
--
ALTER TABLE `revista`
  ADD CONSTRAINT `fk_REVISTA_PROGRAMA1` FOREIGN KEY (`idPrograma`) REFERENCES `programa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


  
--
-- Base de datos: `bdusuarios`
--

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
(12, 'Ingresar');

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
(7, 'Usuario Comun'),
(8, 'Administrador');

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
(7, 7),
(7, 11),
(8, 7),
(8, 8),
(8, 9),
(8, 11);

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
(28, 'Claudio', 'Claudio@gmail.com'),
(27, 'sagsagdh', 'dsadsadad@gmail.com'),
(23, 'Eder dos Santos', 'esantos@uarg.unpa.edu.ar'),
(24, 'Francisco Estrada', 'franciscoestrada2395@gmail.com'),
(26, 'Gabriel', 'gabriel@gmail.com'),
(25, 'Pablo', 'pablo@gmail.com');

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
(25, 7),
(28, 7);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
