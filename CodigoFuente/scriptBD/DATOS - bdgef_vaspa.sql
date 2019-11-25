-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2019 a las 20:23:21
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


--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `nombre`) VALUES
(1, 'Ciencias Sociales'),
(2, 'Ciencias Naturales y Exactas');

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id`, `dni`, `nombre`, `apellido`, `email`, `categoria`, `preferencias`, `idDepartamento`) VALUES
(1, 31323782, 'Karim Omar', 'Hallar', 'fabriciowgonzalez@gmail.com', 'cat1', 'pref1', 2),
(4, 20172723, 'Albert Anibal Osiris', 'Sofia', 'franciscoestrada2395@outlook.es', 'cat1', 'pref1', 2),
(5, 18273827, 'Sandra', 'Casas', 'ns_2510_96@hotmail.com', 'cat1', 'pref1', 2),
(6, 31382983, 'Jorge', 'Climis', 'jclimis@gmail.com', 'cat2', 'pref2', 2),
(7, 18732763, 'Leonardo', 'González', 'lgonzalez@uarg.unpa.edu.ar', 'cat2', '', 2),
(8, 24326223, 'Claudio', 'Saldivia', 'csaldiviaa@gmail.com', 'cat1', NULL, 2),
(9, 18273367, 'Daniel', 'Laguia', 'dalaguia@gmail.com', 'cat1', 'pref1', 2),
(10, 17262556, 'Walter', 'Altamirano', 'waaltamirano', 'cat1', 'p', 2),
(11, 35106899, 'Héctor', 'Muñoz', 'mh@uarg.unpa.edu.ar', 'cat1', '', 1);

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`) VALUES
('016', 'Analista de Sistemas'),
('049', 'Profesorado en Matemática'),
('069', 'Ingeniería Química'),
('072', 'Licenciatura en Sistemas');

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

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `nombre`, `idDepartamento`, `contenidosMinimos`, `idProfesor`, `horasSemanales`) VALUES
('0174', 'Programación I', 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', 5, 8),
('0175', 'Programación II', 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', 5, 8),
('0473', 'Ingeniería de Software', 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', 4, 6),
('1649', 'Resolución de Problemas y Algoritmos', 2, 'Problemas. Algoritmos. Operadores aritméticos y lógicos. Estructuras de control. Noción de modularización. Estructuras de datos lineales: Arreglos. Pilas. Colas. Algoritmos fundamentales: recorrido, búsqueda, ordenamiento, actualización. Recursividad.', 5, 8),
('1654', 'Requerimientos de Software', 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', 1, 6),
('1658', 'Análisis y Diseño de Software', 2, 'daasasdsad', 9, 6),
('1659', 'Bases de Datos', 2, 'asdasdasdasd', 10, 6),
('1663', 'Validación y Verificación de Software', 2, 'asdasdasdsd', 9, 4),
('1668', 'Gestión de Proyectos de Software', 2, 'Conceptos de gestión, Planificación de proyectos. Métricas y estimación de costos, esfuerzo y tiempo. Riesgos. Organización y personal de proyecto. Control de proyecto. Gestión de configuraciones de software. Implantación y Evolución del software', 4, 6),
('1673', 'Gestión de Calidad', 2, 'asdasdasdasd', 4, 4),
('2138', 'Laboratorio de Desarrollo de Software', 2, 'Herramientas de integración de desarrollo de software. Gestión de Configuraciones. Herramientas de Análisis y Diseño de software. Nociones de sistemas colaborativos.', 4, 6);

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

--
-- Volcado de datos para la tabla `profesor_asignatura`
--

INSERT INTO `profesor_asignatura` (`idAsignatura`, `idProfesor`, `rol`) VALUES
('1668', 7, 'practica'),
('1668', 6, 'practica'),
('1649', 8, 'practica');

--
-- Volcado de datos para la tabla `correlativa_de`
--

INSERT INTO `correlativa_de` (`id`, `requisito`, `idAsignatura`, `idAsignatura_Correlativa_Anterior`) VALUES
(1, 'Aprobada', '1668', '1658'),
(2, 'Aprobada', '1668', '1659'),
(3, 'Regular', '1668', '1663'),
(4, 'Regular', '1673', '1668');

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id`, `anio`, `anioCarrera`, `horasTeoria`, `horasPractica`, `horasOtros`, `regimenCursada`, `observacionesHoras`, `observacionesCursada`, `fundamentacion`, `objetivosGenerales`, `organizacionContenidos`, `criteriosEvaluacion`, `metodologiaPresencial`, `regularizacionPresencial`, `aprobacionPresencial`, `metodologiaSATEP`, `regularizacionSATEP`, `aprobacionSATEP`, `metodologiaLibre`, `aprobacionLibre`, `ubicacion`, `idAsignatura`, `aprobadoSa`, `aprobadoDepto`, `fechaCarga`, `vigencia`) VALUES
(2, 2018, '3', '02:00:00', '02:00:00', NULL, '2', NULL, NULL, 'La ingeniería de Software es un campo de las ciencias de la Computación que basado en principios robustos y bajo un enfoque disciplinado y cuantificable, desarrolla y evoluciona productos de software de calidad.\r\nLa gestión de proyectos es un área ampliamente aplicada en otras disciplinas y la ingeniería de software no está exceptuada de ello, tanto en grandes como pequeños proyectos.', 'El objetivo principal es brindar fundamentos para que los alumnos distingan los elementos claves que deben manejar los participantes del Proceso de desarrollo en los proyectos de software. Promover la integración de conceptos, técnicas y herramientas necesarias para diseñar, implementar y controlar sistemas de información. Ser capaz de manejar elementos científicos, técnicas y metodologías necesarias para participar en tareas concernientes al proceso de desarrollo de Software de aplicación.', 'MODULO I  CONCEPTOS BASICOS DE INGENIERIA DE SOFTWARE\r\nSoftware - Conceptos - Evolución y Perspectivas. Objetivos del desarrollo de Software. Rol del Software - Áreas de aplicación. Crisis del Software - Problemas, Causas, y Mitos - Metodología, Técnicas y Herramientas. Paradigmas del desarrollo de Software.\r\n\r\nMODULO II  PLANIFICACION Y GESTION DE PROYECTOS DE SOFTWARE\r\nPlanificación de Proyectos. Métricas y Estimación. Control y Avance. Revisiones e Inspecciones. Evaluación de Factibilidad Técnica. Operativa y Económica. Análisis de Riesgo, Identificación, Evaluación. Gestión Ágil.', 'Con la finalidad de alcanzar los propósitos planteados establecidos para el desarrollo de la asignatura las siguientes estrategias:\r\n- Clases teórico-prácticas\r\n- Trabajos Prácticos\r\n- Lecturas', 'Clases Teórico-Prácticas: se abordan los contenidos detallados en el Programa de la Asignatura y se ejemplifica con casos prácticos.\r\nTrabajos Prácticos: se propone la resolución de ejercicios y casos sobre temas específicos, la lectura y discusión de artículos y la exposición de determinados temas. Los trabajos pueden ser grupales o individuales', '- Presentar y exponer el 100% de los trabajos (trabajos prácticos y lecturas) en las fechas establecidas por la cátedra, según el cronograma de actividades de la asignatura.\r\n- Aprobar los parciales o su respectivo recuperatorio integrador. Esto exámenes se aprobarán con un mínimo del 60% correcto del puntaje total.', 'Se evaluarán los conocimientos a través de un examen final, que podrá tener la modalidad oral o escrita.', 'Esta asignatura NO puede ser impartida en modalidad semiprensencial', '-', '-', 'Los alumnos que deseen rendir en esta modalidad deberán contactarse con el docente a osofia@uarg.unpa.edu.ar, expresando su deseo de rendir la asignatura. El docente coordinará con el alumno una reunión donde le explicará el objetivo y los contenidos de las prácticas propuestas. Además podrá consultar la totalidad del material bibliográfico propuesto.', 'Aprobación Final:\r\n- Presentación de la totalidad de las lecturas al menos 10 días antes del examen.\r\n- Presentación de la totalidad de los ejercicios prácticos propuestos por la cátedra al menos 10 días antes del examen.\r\n- Sección teórica o escrita\r\n- Sección práctica escrita', NULL, '1668', 0, 0, '0000-00-00', '3'),
(3, 2007, '1', '02:00:00', '04:00:00', '01:00:00', 'A', 'Clases de consulta', '', 'El propósito es introducir a los alumnos en el análisis y abstracción de problemas, y diseño de algoritmos. Al finalizar esta asignatura el alumno deberá ser capaz de representar algorítmicamente la solución de problemas de complejidad intermedia. \r\nLa asignatura comienza con la resolución de problemas cotidianos que se pueden dividir en varios pasos; expresándose en forma narrativa. Luego se introducen expresiones algorítmicas (operaciones aritméticas, lógicas, estructuras de control, variables, etc.) en pseudocódigo; tipos de datos simples (Entero, Real, Caracter y Booleano) y compuestos (Arreglos, Pilas y Colas) que se aplican para el diseño y representación de algoritmos a problemas simples de carácter matemático (sumas, productos, promedios, números primos, amigos, perfectos, etc.) mediante una previa especificación del análisis de entradas y salidas. Se concluye con la técnica de recursión.\r\n', '- Conocer y entender los conceptos esenciales de la Programación.\r\n- Aprender y saber aplicar las Estructuras de Control. \r\n- Aprender y saber implementar los Arreglos, las Pilas y las Colas.\r\n- Entender y aprender la técnica de recursividad.\r\n- Entender y saber armar un Programa Modular aplicando OO básico. \r\n- Aprender a codificar en lenguaje Java.', 'UNIDAD I – Problemas y Algoritmos\r\nPrograma, Programador, Programación. Paradigmas de Programación. Lenguajes de Programación. Problema. Análisis del Problema. Algoritmo. Diseño del Algoritmo. Datos. Tipos de datos: Simples (Entero, Real, Caracter y Booleano) y Compuestos. Variables. Constantes. Identificadores. Operaciones primitivas. Asignación. Expresiones Aritméticas. Expresiones Lógicas. Lectura (entrada de datos) y Escritura (salida de datos). \r\n\r\nUNIDAD II - Estructuras de Control\r\nEstructuras de Control: Secuenciación, Selección (SI-SINO, ALTERNAR) e Iteración o bucle (MIENTRAS, HACER-MIENTRAS, PARA). Contadores. Acumuladores. Bucles controlados por contador y suceso. Invariante de bucle.\r\n\r\nUNIDAD III - Programa y Funciones\r\nPrograma (Principal). Estructura general de un Programa. Partes constitutivas de un Programa. Funciones. Declaración e invocación de funciones. Precondiciones y postcondiciones. Variables locales. Parámetros actuales y formales. Ámbitos de los identificadores.\r\n\r\nUNIDAD IV – Clases/Objetos\r\nClases. Objetos. Atributos. Métodos. Constructores. Mensajes. Ventajas: encapsulación, reuso, ocultamiento de la información.\r\n\r\nUNIDAD V - Arreglos\r\nArreglos Unidimensionales (Vectores) y Bidimensionales (Matrices). Manejo de Índices. Operaciones de: asignación, lectura y escritura de datos, recorrido, y actualización. Métodos de Búsqueda (Secuencial y Binaria). Método de Ordenación (Intercambio o Burbuja, Inserción y Selección).\r\n\r\nUNIDAD VI - Java y Laboratorio\r\nLenguaje Java. Pasaje a máquina (de pseudocódigo a Java). Clases y método Main. Referencias en java. Edición. Compilación. Puesta a punto de programas. Paquetes. Modificadores de Acceso. Sobrecarga. Operador This. Arreglos en Java. Clase Vector y Matriz. Clase String (Cadena). Clases estáticas. Clase Random.\r\n', 'La evaluación se plantea como un proceso natural por ello se planifica y diseña como una continuidad de las actividades realizadas. Además, la decisión de fijar 5 (cinco) exámenes y 1 (un) examen recuperatorio general, de carácter práctico, permite obtener rápidamente información acerca de la evolución en el proceso de aprendizaje y detectar a tiempo aquellos casos en los que falta un apuntalamiento, refuerzos y apoyo. Es necesario, contar con un 75% total de asistencia a las clases prácticas. Permite al alumno una mayor dedicación a la resolución de los ejercicios prácticos.', 'La materia consta de 1 (una) clase teórica y 2 (dos) clases prácticas, por semana. Cada unidad posee su teoría y trabajo práctico correspondiente. De acuerdo a la complejidad de los temas, las clases prácticas varían en cantidad de días. Los alumnos cuentan dos semanas antes del examen, con clases de consultas. La resolución de los ejercicios prácticos se realiza en papel (1º cuatrimestre) y en máquina (2º cuatrimestre). Como antes se ha mencionado existen evaluaciones parciales y durante las clases prácticas se toma asistencia, siendo ésta un complemento de evaluación.', '- Cumplir con el 75% de asistencia a las clases prácticas. \r\n- Aprobar todos los exámenes o el recuperatorio general.\r\n', '- Examen escrito (práctico)\r\n- Examen oral (teoría)', 'Los alumnos pueden acudir por asistencia en los días, horarios y lugares en los que la cátedra se dicta. Para mayor información ingresar a la página web del área: http://espanol.geocities.com/profeprog/', 'No aplica', '- Examen escrito (práctico)\r\n- Examen oral (teoría)', 'Podrán contar con el apunte de cátedra y los prácticos correspondientes. Se aceptan consultas. Para rendir el final, sólo tendrán que asistir al mismo habiendo practicado lo suficiente y conocer los conceptos teóricos que se encuentran en el apunte de cátedra, como para estar en condiciones de rendir. Para mayor información ingresar a la página web del área: http://espanol.geocities.com/profeprog/', '- Igual que los alumnos presenciales, solo que incorporando un ejercicio más', NULL, '1649', 0, 0, '0000-00-00', '3');

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `referencia`, `apellido`, `nombre`, `anioEdicion`, `titulo`, `capitulo`, `lugarEdicion`, `editorial`, `unidad`, `biblioteca`, `siunpa`, `otro`, `tipoLibro`, `idPrograma`) VALUES
(1, 'ANDA01', 'Anda', 'Bente', 2001, 'Estimating Software Development Effort based on Use Case - Experiencies from Industry. Lecture Notes in Computer Science [LNCS]', 'Vol. 2185 (2001) p. 487-488', 'New York (US)', 'Springer-Verlag Berlín Heidelberg', 'II', '-', '-', 'pdf', 'O', 2),
(2, 'BAHI12', 'Bahit', 'Eugenia', 2006, 'Scrum y eXtreme Programming para Programadores', 'Todo en general. Cap TDD - Test Driven Develo', 'Buenos Aires [AR]', 'Eugenia Bahit', 'I, IV', '-', '-', 'pdf', 'O', 2),
(3, 'COHN05', 'Cohn', 'Mike', 2005, 'Agile Estimating and Planning.', ' ', 'Upper Saddle River [US]', 'Prentice Hall PTR', 'II', 'UARG', ' - ', ' ', 'C', 2),
(4, 'BOEHM81', 'Boehm', 'Barry', 1981, 'Software engineering economics.', ' ', 'New Jersey [US]', 'Prentice Hall', 'II', 'UARG', ' - ', ' - ', 'C', 2);

--
-- Volcado de datos para la tabla `otro_material`
--

INSERT INTO `otro_material` (`id`, `descripcion`, `idPrograma`) VALUES
(1, 'Presentaciones realizadas por la cátedra disponibles en formato Power Point y Acrobat Reader en la dirección de internet indicada.', 2);

--
-- Volcado de datos para la tabla `recurso`
--

INSERT INTO `recurso` (`id`, `apellido`, `nombre`, `titulo`, `datosAdicionales`, `disponibilidad`, `idPrograma`) VALUES
(1, 'Sofia', 'Albert Osiris', 'Ingeniería de Software', NULL, 'http://sistemas.uarg.unpa.edu.ar/asignaturas/gps/', 2),
(2, 'IEEE', 'IEEE', 'IEEE', NULL, 'http://www.ieee.org/', 2);

--
-- Volcado de datos para la tabla `revista`
--

INSERT INTO `revista` (`id`, `apellido`, `nombre`, `tituloArticulo`, `tituloRevista`, `pagina`, `fecha`, `unidad`, `biblioteca`, `siunpa`, `otro`, `idPrograma`) VALUES
(1, 'sadasda', '1233wwqeqwe', 'wqeqwdsaqwerasd', 'ewaeawedasdad', 'e2312e', '0000-00-00', 'r2343rfe', 'gjgh', 'cvbc', 'bcvbc', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
