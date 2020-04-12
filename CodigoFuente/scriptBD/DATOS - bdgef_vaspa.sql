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
(1, 0, 'Karim Omar', 'Hallar', 'fabriciowgonzalez@gmail.com', 'cat1', 'pref1', 2),
(4, 0, 'Albert Anibal Osiris', 'Sofia', 'franciscoestrada2395@outlook.es', 'cat1', 'pref1', 2),
(5, 0, 'Sandra', 'Casas', 'ns_2510_96@hotmail.com', 'cat1', 'pref1', 2),
(6, 0, 'Jorge', 'Climis', 'jclimis@gmail.com', 'cat2', 'pref2', 2),
(7, 0, 'Leonardo', 'González', 'lgonzalez@uarg.unpa.edu.ar', 'cat2', '', 2),
(8, 0, 'Claudio', 'Saldivia', 'csaldiviaa@gmail.com', 'cat1', NULL, 2),
(9, 0, 'Daniel', 'Laguia', 'dalaguia@gmail.com', 'cat1', 'pref1', 2),
(10, 0, 'Walter', 'Altamirano', 'waaltamirano', 'cat1', 'p', 2),
(12, 0, 'Carlos Gustavo', 'Livacic', 'carlosgustavolivacic@gmail.com', 'cat1', NULL, 2),
(13, 0, 'Diego', 'Rodriguez Herleing', 'diegorohe@gmail.com', 'cat2', NULL, 2),
(14, 0, 'UARG', 'Profesor', 'profesor.uarg@gmail.com', 'cat1', NULL, 2);

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`) VALUES
('001', 'Profesorado en Letras'),
('003', 'Profesorado en Historia'),
('004', 'Profesorado en Geografía'),
('016', 'Analista de Sistemas'),
('023', 'Ingeniería en Recursos Naturales Renovables'),
('045', 'Licenciatura en Psicopedagogía'),
('049', 'Profesorado en Matemática'),
('060', 'Licenciatura en Letras'),
('061', 'Licenciatura en Turismo'),
('062', 'Tecnicatura Universitaria en Turismo'),
('064', 'Licenciatura en Geografía'),
('069', 'Ingeniería Química'),
('072', 'Licenciatura en Sistemas'),
('074', 'Licenciatura en Trabajo Social'),
('076', 'Tecnicatura Universitaria en Acompañamiento Terapéutico'),
('912', 'Tecnicatura Universitaria en Gestión de Organizaciones'),
('913', 'Licenciatura en Administración'),
('914', 'Profesorado en Economía y Gestión de Organizaciones'),
('918', 'Licenciatura en Comunicación Social');

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
('1655', 'Aspectos Profesionales', 2, 'Historia de computación. responsabilidad y ética profesional. Impacto económico del software. Computación y sociedad. Propiedad intelectual, licenciamiento del software y contratos informáticos. Aspectos legales laborales y específicos. Patentamiento. Software Libre.', 14, 2),
('1657', 'Sistemas Operativos', 2, 'Servicios de Sistemas Operativos. Máquina Virtual. Planificación de CPU. Procesos Concurrentes. Concepto de Proceso. Planificación de Procesos. Interbloqueos. Administración de Memoria. Memoria Virtual. Sistema de Archivos. Protección.', 14, 5),
('1658', 'Análisis y Diseño de Software', 2, 'daasasdsad', 9, 6),
('1659', 'Bases de Datos', 2, 'asdasdasdasd', 10, 6),
('1661', 'Redes y Telecomunicaciones', 2, 'tecnica de transmisión de datos, modelos, topologías ...', 12, 6),
('1663', 'Validación y Verificación de Software', 2, 'asdasdasdsd', 9, 4),
('1666', 'Sistemas Operativos Distribuidos', 2, 'Sistemas Operativos de tiempo real, embebidos, distribuidos. Comunicación. Sincronización. Manejo de recursos y Archivos de sistemas Distribuidos. Memoria compartida distribuida. Control de concurrencia en Sistemas Distribuidos. Transacciones Distribuidas. Seguiridad en Sistemas Distribuidos. Sistemas Colaborativos.', 14, 5),
('1668', 'Gestión de Proyectos de Software', 2, 'Conceptos de gestión, Planificación de proyectos. Métricas y estimación de costos, esfuerzo y tiempo. Riesgos. Organización y personal de proyecto. Control de proyecto. Gestión de configuraciones de software. Implantación y Evolución del software', 4, 6),
('1671', 'Laboratorio de Redes', 2, 'Técnicas de transmisión de datos, modelos, topologías, protocolos de red y algoritmos de ruteo de datos. Sistemas operativos de red. Seguridad en redes. Administración de redes. Simulación de redes.', 12, 4),
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
('072P2', '1654'),
('072P2', '1661'),
('016P3', '0174'),
('016P3', '0175'),
('016P5', '1655'),
('016P5', '1657'),
('016P5', '1666'),
('016P5', '1661'),
('072P2', '1655'),
('072P2', '1657'),
('072P2', '1666'),
('072P2', '1671');

--
-- Volcado de datos para la tabla `profesor_asignatura`
--

INSERT INTO `profesor_asignatura` (`idAsignatura`, `idProfesor`, `rol`) VALUES
('1668', 7, 'practica'),
('1668', 6, 'practica'),
('1649', 8, 'practica'),
('1661', 13, 'practica'),
('1661', 12, 'practica');

--
-- Volcado de datos para la tabla `correlativa_de`
--

INSERT INTO `correlativa_de` (`id`, `requisito`, `idAsignatura`, `idAsignatura_Correlativa_Anterior`) VALUES
(1, 'Aprobada', '1668', '1658'),
(2, 'Aprobada', '1668', '1659'),
(3, 'Regular', '1668', '1663'),
(4, 'Regular', '1673', '1668'),
(6, 'Aprobada', '1661', '1649'),
(7, 'Regular', '1666', '1661'),
(8, 'Regular', '1661', '1657'),
(9, 'Regular', '1657', '1649'),
(10, 'Aprobada', '1671', '1661'),
(11, 'Regular', '1671', '1666');

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id`, `anio`, `anioCarrera`, `horasTeoria`, `horasPractica`, `horasOtros`, `regimenCursada`, `observacionesHoras`, `observacionesCursada`, `fundamentacion`, `objetivosGenerales`, `organizacionContenidos`, `criteriosEvaluacion`, `metodologiaPresencial`, `regularizacionPresencial`, `aprobacionPresencial`, `metodologiaSATEP`, `regularizacionSATEP`, `aprobacionSATEP`, `metodologiaLibre`, `aprobacionLibre`, `ubicacion`, `idAsignatura`, `aprobadoSa`, `aprobadoDepto`, `fechaCarga`, `vigencia`, `comentarioSa`, `comentarioDepto`, `enRevision`) VALUES
(2, 2018, '3', '02:00:00', '02:00:00', NULL, '2', NULL, NULL, 'La ingeniería de Software es un campo de las ciencias de la Computación que basado en principios robustos y bajo un enfoque disciplinado y cuantificable, desarrolla y evoluciona productos de software de calidad.\r\nLa gestión de proyectos es un área ampliamente aplicada en otras disciplinas y la ingeniería de software no está exceptuada de ello, tanto en grandes como pequeños proyectos.', 'El objetivo principal es brindar fundamentos para que los alumnos distingan los elementos claves que deben manejar los participantes del Proceso de desarrollo en los proyectos de software. Promover la integración de conceptos, técnicas y herramientas necesarias para diseñar, implementar y controlar sistemas de información. Ser capaz de manejar elementos científicos, técnicas y metodologías necesarias para participar en tareas concernientes al proceso de desarrollo de Software de aplicación.', 'MODULO I  CONCEPTOS BASICOS DE INGENIERIA DE SOFTWARE\r\nSoftware - Conceptos - Evolución y Perspectivas. Objetivos del desarrollo de Software. Rol del Software - Áreas de aplicación. Crisis del Software - Problemas, Causas, y Mitos - Metodología, Técnicas y Herramientas. Paradigmas del desarrollo de Software.\r\n\r\nMODULO II  PLANIFICACION Y GESTION DE PROYECTOS DE SOFTWARE\r\nPlanificación de Proyectos. Métricas y Estimación. Control y Avance. Revisiones e Inspecciones. Evaluación de Factibilidad Técnica. Operativa y Económica. Análisis de Riesgo, Identificación, Evaluación. Gestión Ágil.', 'Con la finalidad de alcanzar los propósitos planteados establecidos para el desarrollo de la asignatura las siguientes estrategias:\r\n- Clases teórico-prácticas\r\n- Trabajos Prácticos\r\n- Lecturas', 'Clases Teórico-Prácticas: se abordan los contenidos detallados en el Programa de la Asignatura y se ejemplifica con casos prácticos.\r\nTrabajos Prácticos: se propone la resolución de ejercicios y casos sobre temas específicos, la lectura y discusión de artículos y la exposición de determinados temas. Los trabajos pueden ser grupales o individuales', '- Presentar y exponer el 100% de los trabajos (trabajos prácticos y lecturas) en las fechas establecidas por la cátedra, según el cronograma de actividades de la asignatura.\r\n- Aprobar los parciales o su respectivo recuperatorio integrador. Esto exámenes se aprobarán con un mínimo del 60% correcto del puntaje total.', 'Se evaluarán los conocimientos a través de un examen final, que podrá tener la modalidad oral o escrita.', 'Esta asignatura NO puede ser impartida en modalidad semiprensencial', '-', '-', 'Los alumnos que deseen rendir en esta modalidad deberán contactarse con el docente a osofia@uarg.unpa.edu.ar, expresando su deseo de rendir la asignatura. El docente coordinará con el alumno una reunión donde le explicará el objetivo y los contenidos de las prácticas propuestas. Además podrá consultar la totalidad del material bibliográfico propuesto.', 'Aprobación Final:\r\n- Presentación de la totalidad de las lecturas al menos 10 días antes del examen.\r\n- Presentación de la totalidad de los ejercicios prácticos propuestos por la cátedra al menos 10 días antes del examen.\r\n- Sección teórica o escrita\r\n- Sección práctica escrita', NULL, '1668', NULL, NULL, '0000-00-00', '3', NULL, NULL, 1),
(3, 2007, '1', '02:00:00', '04:00:00', '01:00:00', 'A', 'Clases de consulta', '', 'El propósito es introducir a los alumnos en el análisis y abstracción de problemas, y diseño de algoritmos. Al finalizar esta asignatura el alumno deberá ser capaz de representar algorítmicamente la solución de problemas de complejidad intermedia. \r\nLa asignatura comienza con la resolución de problemas cotidianos que se pueden dividir en varios pasos; expresándose en forma narrativa. Luego se introducen expresiones algorítmicas (operaciones aritméticas, lógicas, estructuras de control, variables, etc.) en pseudocódigo; tipos de datos simples (Entero, Real, Caracter y Booleano) y compuestos (Arreglos, Pilas y Colas) que se aplican para el diseño y representación de algoritmos a problemas simples de carácter matemático (sumas, productos, promedios, números primos, amigos, perfectos, etc.) mediante una previa especificación del análisis de entradas y salidas. Se concluye con la técnica de recursión.\r\n', '- Conocer y entender los conceptos esenciales de la Programación.\r\n- Aprender y saber aplicar las Estructuras de Control. \r\n- Aprender y saber implementar los Arreglos, las Pilas y las Colas.\r\n- Entender y aprender la técnica de recursividad.\r\n- Entender y saber armar un Programa Modular aplicando OO básico. \r\n- Aprender a codificar en lenguaje Java.', 'UNIDAD I – Problemas y Algoritmos\r\nPrograma, Programador, Programación. Paradigmas de Programación. Lenguajes de Programación. Problema. Análisis del Problema. Algoritmo. Diseño del Algoritmo. Datos. Tipos de datos: Simples (Entero, Real, Caracter y Booleano) y Compuestos. Variables. Constantes. Identificadores. Operaciones primitivas. Asignación. Expresiones Aritméticas. Expresiones Lógicas. Lectura (entrada de datos) y Escritura (salida de datos). \r\n\r\nUNIDAD II - Estructuras de Control\r\nEstructuras de Control: Secuenciación, Selección (SI-SINO, ALTERNAR) e Iteración o bucle (MIENTRAS, HACER-MIENTRAS, PARA). Contadores. Acumuladores. Bucles controlados por contador y suceso. Invariante de bucle.\r\n\r\nUNIDAD III - Programa y Funciones\r\nPrograma (Principal). Estructura general de un Programa. Partes constitutivas de un Programa. Funciones. Declaración e invocación de funciones. Precondiciones y postcondiciones. Variables locales. Parámetros actuales y formales. Ámbitos de los identificadores.\r\n\r\nUNIDAD IV – Clases/Objetos\r\nClases. Objetos. Atributos. Métodos. Constructores. Mensajes. Ventajas: encapsulación, reuso, ocultamiento de la información.\r\n\r\nUNIDAD V - Arreglos\r\nArreglos Unidimensionales (Vectores) y Bidimensionales (Matrices). Manejo de Índices. Operaciones de: asignación, lectura y escritura de datos, recorrido, y actualización. Métodos de Búsqueda (Secuencial y Binaria). Método de Ordenación (Intercambio o Burbuja, Inserción y Selección).\r\n\r\nUNIDAD VI - Java y Laboratorio\r\nLenguaje Java. Pasaje a máquina (de pseudocódigo a Java). Clases y método Main. Referencias en java. Edición. Compilación. Puesta a punto de programas. Paquetes. Modificadores de Acceso. Sobrecarga. Operador This. Arreglos en Java. Clase Vector y Matriz. Clase String (Cadena). Clases estáticas. Clase Random.\r\n', 'La evaluación se plantea como un proceso natural por ello se planifica y diseña como una continuidad de las actividades realizadas. Además, la decisión de fijar 5 (cinco) exámenes y 1 (un) examen recuperatorio general, de carácter práctico, permite obtener rápidamente información acerca de la evolución en el proceso de aprendizaje y detectar a tiempo aquellos casos en los que falta un apuntalamiento, refuerzos y apoyo. Es necesario, contar con un 75% total de asistencia a las clases prácticas. Permite al alumno una mayor dedicación a la resolución de los ejercicios prácticos.', 'La materia consta de 1 (una) clase teórica y 2 (dos) clases prácticas, por semana. Cada unidad posee su teoría y trabajo práctico correspondiente. De acuerdo a la complejidad de los temas, las clases prácticas varían en cantidad de días. Los alumnos cuentan dos semanas antes del examen, con clases de consultas. La resolución de los ejercicios prácticos se realiza en papel (1º cuatrimestre) y en máquina (2º cuatrimestre). Como antes se ha mencionado existen evaluaciones parciales y durante las clases prácticas se toma asistencia, siendo ésta un complemento de evaluación.', '- Cumplir con el 75% de asistencia a las clases prácticas. \r\n- Aprobar todos los exámenes o el recuperatorio general.\r\n', '- Examen escrito (práctico)\r\n- Examen oral (teoría)', 'Los alumnos pueden acudir por asistencia en los días, horarios y lugares en los que la cátedra se dicta. Para mayor información ingresar a la página web del área: http://espanol.geocities.com/profeprog/', 'No aplica', '- Examen escrito (práctico)\r\n- Examen oral (teoría)', 'Podrán contar con el apunte de cátedra y los prácticos correspondientes. Se aceptan consultas. Para rendir el final, sólo tendrán que asistir al mismo habiendo practicado lo suficiente y conocer los conceptos teóricos que se encuentran en el apunte de cátedra, como para estar en condiciones de rendir. Para mayor información ingresar a la página web del área: http://espanol.geocities.com/profeprog/', '- Igual que los alumnos presenciales, solo que incorporando un ejercicio más', NULL, '1649', 1, 1, '0000-00-00', '3', NULL, NULL, 1),
(99, 2019, '3', '09:00:00', '09:00:00', '02:00:00', '2', 'a', 'a', '<p><b>Negrita </b><i>Italic</i>&nbsp;<u>Underline</u></p><ul><li><u>aa</u></li><li><u>aa</u></li></ul><p><u>SS</u></p><ol><li style=\"text-align: center;\"><u>fcds</u></li><li style=\"text-align: center;\"><u>cfd</u></li><li style=\"text-align: center;\"><u><br></u></li></ol>', 'A', 'a', 'a', 'a', 'a', 'a', 'a', 'aa', 'a', 'a', 'a', 'SA', '1659', 0, 0, '2019-06-15', '3', NULL, NULL, 1),
(100, 2019, '3', '00:00:09', '00:00:09', '00:00:02', '2', 'a', 'a', '<p><b>Negrita </b><i>Italic</i>&nbsp;<u>Underline</u></p><ul><li><u>aa</u></li><li><u>aa</u></li></ul><p><u>SS</u></p><ol><li style=\"text-align: center;\"><u>fcds</u></li><li style=\"text-align: center;\"><u>cfd</u></li><li style=\"text-align: center;\"><u><br></u></li></ol>', 'A', 'a', 'a', 'a', 'a', 'a', 'a', 'aa', 'a', 'a', 'a', 'SA', '1649', 0, 0, '2019-05-01', '3', NULL, NULL, 1),
(101, 2018, '4', '03:00:00', '03:00:00', NULL, '1', NULL, NULL, 'Desde la masificación de los sistemas informáticos las redes han tenido un cosntante desarrollo y han ido, paulatinamente, ampliado su espectro de servicios. Esta evolución ha posibilitado ...', '...', '...', '...', '...', '...', '...', '...', '...', '...', '...', '...', NULL, '1661', 0, 0, '2018-02-01', '1', NULL, NULL, 1),
(102, 2019, '2', '02:30:00', '02:30:00', NULL, '2', NULL, NULL, 'Este programa tiene como objetivo que los alumnos adquieran conocimientos en los conceptos básicos y específicos sobre el diseño de software destinado a controlar los recursos propios de un computador. Para los profesionales de computación es indispensable dominar los conceptos básicos asociados al software que permite la administración eficiente de los recursos que ofrece un computador a los usuarios.\r\nLa asignatura se encuentra ubicada en el segundo cuatrimestre del segundo año de la carrera de Analista de Sistemas y Licenciatura en Sistemas. Se enfoca en formar al alumno en la isquion de conocimientos sobre los fundamentos de software de base, aplicar técnicas de programación, configuración y administración  de los recursos de un computador. De forma que, como futuro profesional adquiera los conocimientos sobre administración y gestión de los recursos de un computador.', 'Este programa tiene como objetivo que los alumnos adquieran conocimientos en los conceptos básicos y específicos sobre Sistemas Operativos. Las características de funcionamiento y diseño de los mismos. La capacidad de evaluar las ventajas y desventajas de cada uno de ellos.', 'Unidad I, Introducción\r\n\r\n1.1 Introducción a los Sistemas Operativos: El sistema operativo como una máquina extendida. El sistema operativo como controlador de recursos. Definiciones de SO.\r\n1.2 Sistema de Computo. Servicios del Sistema Operativo.\r\n1.3 Evolución histórica\r\n1.4 Conceptos y tecnología básica\r\n1.5 Estructura de los Sistemas Operativos\r\n\r\nUnidad II, Procesos\r\n\r\n2.1 Estados y transiciones\r\n2.2 Caracterización de procesos\r\n2.3 Secciones críticas\r\n2.4 Bloqueo mutuo (interbloqueo)\r\n2.5 Semáforos\r\n2.6 Comunicación entre procesos\r\n2.7 Problemas clásicos de sincronización de procesos\r\n\r\nUnidad III, Administración de la CPU\r\n\r\n3.1 Tipos de planificación\r\n3.2 Estrategias de planificación del procesador\r\n3.3 Planificación Linux\r\n\r\nUnidad IV, Administración de la memoria principal\r\n\r\n4.1 Esquemas antiguos\r\n4.2 Memoria virtual\r\n4.3 Segmentación\r\n4.4 Paginación\r\n\r\nUnidad V, sistema de Archivos\r\n\r\n5.1 Estructura física del disco\r\n5.2 Estructura lógica del disco\r\n5.3 Estrategias de planificación de cabezales.\r\n5.4 Organización del sistema de archivo (Unix, MS-DOS)\r\n5.5 Mecanismos de seguridad\r\n\r\nUnidad VI, Protección\r\n\r\n6.1 Entorno seguro\r\n6.2 Criptografía básica\r\n6.3 Autentificación de usuarios\r\n6.4 Ataques desde el interior del sistema\r\n6.5 Ataques desde el exterior del sistema\r\n6.6 Mecanismos de protección\r\n\r\nUnidad VII, Sistema Operativo: LINUX\r\n\r\n7.1 Conceptos de Shell y usuarios\r\n7.2 Organización de directorios\r\n7.3 Dispositivos tratados como archivos\r\n7.4 Procesos y \"demonios\"\r\n7.5 Comandos principales\r\n7.6 Programación Shell\r\n7.7 Comandos para administración del sistema\r\n7.8 El ambiente de programación Unix\r\n7.9 Proyecto final de la materia. Desarrollo de software de sistema utilizando herramientas disponibles en Linux', 'En lo general, se evaluarán los conocimientos teóricos y prácticos\r\nLa evaluación de la cursada como del final varia según la modalidad de la cursada (presencial, no presencial, libre) de acuerdo a lo estipulado en el reglamento de alumnos.', 'En la cátedra se realizaran actividades especificas de las clases teóricas, practicas y uso del laboratorio. En base a ello, los alumnos son guiados y asistidos en el desarrollo de los distintos temas que componen el programa de la materia.\r\n\r\nSe le brindará al alumno material de estudio como presentaciones, lecturas recomendadas, ejercitaciones. De esta manera se integraran conocimientos. En particular, cada tema cuenta con la bibliografia de lectura recomendada a fin de poder complementar y ampliar los conceptos vertidos en el aula.\r\n\r\nLas practicas se realizan en un laboratorio. En las mismas se desarrollan los contenidos relacionados al Sistema Operativo de estudio. El alumno afianza los conocimientos teóricos adquiridos y los relaciona con su implementacion practica. Durante el transcurso del cuatrimestre el alumno va desarrollando una serie de tareas en maquina que son evaluadas.\r\n\r\nEn forma opcional por parte de la cátedra, a mediados del cuatrimestre el alumno deberá prepara y desarrollar un proyecto de software practico de forma grupal, mediante el cual se utilizan las herramientas disponibles en el Sistema Operativo. El desarrollo del proyecto es realizada de forma asistida y guiada.', 'Aprobación de dos parciales escritos teóricos, con 60 de 100 puntos posibles en cada caso.\r\nSe darán dos exámenes recuperatorios, donde se puede recuperar uno de los parciales correspondientes.\r\nFinalizado el cuatrimestre se evaluara en la practica:\r\nDesarrollo y aprobación de una secuencia de tareas practicas propuestas.\r\nAsistencia mínima del 75% a las practicas.\r\nComo complemento a la evaluación de practica (opcionales de la cátedra)\r\nSe evaluara un proyecto de software practico de la materia, de carácter grupal (programa analítico 7.9).\r\nComo complemento a la evaluación teórica (opcionales de la cátedra)\r\nSe asignara un tema individual para desarrollar una monografia.', 'Examen escrito y oral', 'Instancia SATEP 0\r\nLos alumnos disponen de la posibilidad de evacuar las dudas teóricas o practicas mediante la consulta a los docentes vía email. se coordinaran encuentros presenciales para coordinar la realización de los trabajos prácticos y elaboración de los informes de los mismos. Ademas, se les proveerá de lecturas recomendadas que les posibiliten adquirir un ', 'Aprobar un parcial teórico-practico con 60/100 puntos.\r\nComplementario al final el alumno debe preparar previamente dos monografias. Una para ser entregada a mediados del cuatrimestre y la otra al final del cuatrimestre. Ambas serán asignadas previamente por el responsable de la cátedra.\r\nAprobar defensa de las monografias presentadas con anterioridad.\r\nAprobación de una secuencia de tareas practicas a designar, las cuales deberán ser defendidas oportunamente.', 'Aprobar defensa de tareas practicas designadas\r\nExamen practico en maquina\r\nExamen escrito aprobado con al menos 60/100 puntos\r\nExamen oral', 'Los alumnos libres pueden asistir a las clases teóricas, allí reciben los fundamentos teóricos. En caso de no, poder asistir pueden remitirse al equipo de cátedra para obtener el material de apoyo teórico y practico correspondiente.\r\nComplementario al final el alumno debe preparar previamente dos monografias:\r\nComo preparación del examen final, el alumno libre debe solicitar los temas correspondientes a dos monografias a desarrollar. Ambas seras asignadas previamente por el responsable de la cátedra. Ambas deberán haber sido presentadas formalmente 30 días antes del final.', 'Aprobar defensa oral y/o escritas de las monografias presentadas con anterioridad.\r\nAprobar examen practico en maquina.\r\nAprobar examen teórico escrito con 60/100 puntos.\r\nAprobar examen oral.', NULL, '1657', NULL, NULL, '2019-04-12', '3', NULL, NULL, NULL);

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
