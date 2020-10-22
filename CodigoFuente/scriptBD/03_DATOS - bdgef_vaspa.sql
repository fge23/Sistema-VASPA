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
(1, 0, 'Karim Omar', 'Hallar', 'khallar@uarg.unpa.edu.ar', 'cat1', 'pref1', 2),
(4, 0, 'Albert Anibal Osiris', 'Sofia', 'asofia@uarg.unpa.edu.ar', 'cat1', 'pref1', 2),
(5, 0, 'Sandra', 'Casas', 'scasas@uarg.unpa.edu.ar', 'cat1', 'pref1', 2),
(6, 0, 'Jorge', 'Climis', 'jclimis@uarg.unpa.edu.ar', 'cat2', 'pref2', 2),
(7, 0, 'Leonardo', 'González', 'lgonzalez@uarg.unpa.edu.ar', 'cat2', '', 2),
(8, 0, 'Claudio', 'Saldivia', 'csaldivia@uarg.unpa.edu.ar', 'cat1', NULL, 2),
(9, 0, 'Daniel', 'Laguia', 'dalaguia@uarg.unpa.edu.ar', 'cat1', 'pref1', 2),
(10, 0, 'Walter', 'Altamirano', 'waltamirano@uarg.unpa.edu.ar', 'cat1', 'p', 2),
(12, 0, 'Carlos Gustavo', 'Livacic', 'clivacic@uarg.unpa.edu.ar', 'cat1', NULL, 2),
(13, 0, 'Diego', 'Rodriguez Herleing', 'drodriguezherleing@uarg.unpa.edu.ar', 'cat2', NULL, 2),
(16, 0, 'Rúben', 'Zárate', 'rzarate@uarg.unpa.edu.ar', 'cat1', '', 1),
(17, 0, 'Yamile', 'Cárcamo', 'ycarcam@uarg.unpa.edu.ar', 'cat1', '', 1),
(18, 0, 'Carolina', 'Musci', 'cmusci@uarg.unpa.edu.ar', 'cat1', '', 1),
(19, 0, 'Andrea', 'Pac', 'apac@uarg.unpa.edu.ar', 'cat1', '', 1),
(20, 0, 'Jorge', 'Naguil', 'jnaguil@uarg.unpa.edu.ar', 'cat1', '', 2),
(21, 0, 'Luis', 'Burgos', 'lburgos@uarg.unpa.edu.ar', 'cat1', '', 2),
(22, 0, 'Laura', 'Ivanisevich', 'livanisevich@uarg.unpa.edu.ar', 'cat1', '', 2),
(23, 0, 'Carlos', 'Talay', 'ctalay@uarg.unpa.edu.ar', 'cat1', '', 2),
(24, 0, 'Luis', 'Dalla Costa', 'ldallacosta@uarg.unpa.edu.ar', 'cat1', '', 1),
(25, 0, 'Hector', 'Soto Perez', 'profesor.uarg@gmail.com', 'cat1', '', 2),
(26, 0, 'Claudia', 'Mansilla', 'cmansilla@uarg.unpa.edu.ar', 'cat1', '', 1),
(27, 0, 'Hector', 'Reinaga', 'hreinaga@uarg.unpa.edu.ar', 'cat1', '', 2),
(28, 0, 'Paula', 'Millado', 'pmillado@uarg.unpa.edu.ar', 'cat1', '', 2),
(29, 0, 'Esteban', 'Gesto', 'egesto@uarg.unpa.edu.ar', 'cat1', '', 2),
(30, 0, 'Eder', 'Dos Santos', 'edossantos@uarg.unpa.edu.ar', 'cat1', '', 2),
(31, 0, 'Carolina', 'Guidetti', 'cguidetti@uarg.unpa.edu.ar', 'cat1', '', 1),
(32, 0, 'Patricio', 'Triñanes', 'ptrinanes@uarg.unpa.edu.ar', 'cat1', '', 2),
(33, 0, 'Juan', 'Enriquez', 'jenriquez@uarg.unpa.edu.ar', 'cat1', '', 2),
(34, 0, 'Graciela', 'Vidal', 'gvidal@uarg.unpa.edu.ar', 'cat1', '', 2),
(35, 0, 'Daniel', 'Gonzalez', 'dgonzalez@uarg.unpa.edu.ar', 'cat1', '', 2),
(36, 0, 'Fernanda', 'Oyarzo', 'foyarzo@uarg.unpa.edu.ar', 'cat1', '', 2),
(37, 0, 'Franco', 'Herrera', 'fherrera@uarg.unpa.edu.ar', 'cat1', '', 2),
(38, 0, 'Mirtha Fabiana', 'Miranda', 'mmiranda@uarg.unpa.edu.ar', 'cat1', '', 2),
(39, 0, 'María Susana', 'Sandoval', 'msandoval@uarg.unpa.edu.ar', 'cat1', '', 2),
(40, 0, 'Alejandra', 'Álvarez', 'aalvarez@uarg.unpa.edu.ar', 'cat1', '', 2),
(41, 0, 'Luis', 'Sierpe', 'lsierpe@uarg.unpa.edu.ar', 'cat1', '', 2);


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
('001P2', 2005, '001', NULL),
('003P3', 2006, '003', NULL),
('004P2', 2008, '004', NULL),
('016P3', 2003, '016', 2006),
('016P4', 2007, '016', 2012),
('016P5', 2013, '016', NULL),
('023P1', 2007, '023', NULL),
('045P2', 2005, '045', NULL),
('049P3', 2008, '049', NULL),
('060P3', 2007, '060', NULL),
('061P1', 2009, '061', NULL),
('062P3', 2009, '062', NULL),
('064P3', 2010, '064', NULL),
('069P1', 2009, '069', NULL),
('072P1', 2007, '072', 2012),
('072P2', 2013, '072', NULL),
('074P3', 2010, '074', NULL),
('076P2', 2013, '076', NULL),
('912P6', 2016, '912', NULL),
('913P5', 2014, '913', NULL),
('914P3', 2014, '914', NULL),
('918P1', 2008, '918', NULL);


--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `nombre`, `idDepartamento`, `contenidosMinimos`, `idProfesor`, `horasSemanales`) VALUES
('0174', 'Programación I', 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', 5, 8),
('0175', 'Programación II', 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', 5, 8),
('0473', 'Ingeniería de Software', 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', 4, 6),
('0901', 'Análisis y Producción del Discurso', 1, 'Análisis y comprensión del discurso: nociones básicas de teoría de la Comunicación y de la Enunciación. Semántica. Pragmática.\r\nAnálisis y producción del discurso. Operaciones de planificación del texto como unidad semántica-pragmática. Del plan global a la puesta en texto, cohesión y coherencia. La arquitectura de la frase, párrafo y texto. Normativa: problemas de gramaticalidad, de adecuación y estilo.', 24, 2),
('1107', 'Introducción al Conocimiento Científico', 1, 'Filosofía, ciencia y epistemología. Clasificación de las ciencias. Estructura y validez de las teorías. Nuevas posturas sobre las ciencias.', 19, 4),
('1108', 'Ciencia, Universidad y Sociedad', 1, 'La ciencia como producción social. La universidad moderna como organización del conocimiento: modelos y sentidos. Relaciones entre Universidad, la Sociedad y el Estado. La Universidad desde una perspectiva histórica. Ciencia y proyecto universitario en la Región Patagónica.', 26, 4),
('1528', 'Álgebra', 2, 'Principio de inducción completa. Vectores, matrices, operaciones con vectores y matrices. Dependencia e independencia lineal. Rango de una matriz. Determinante. Matrices semejantes. Matrices simétricas. Sistemas de ecuaciones lineales, aplicaciones de la eliminación de Gauss en matrices de orden 2 y 3 y generalización. Espacios vectoriales. Transformaciones lineales y matrices. Producto escalar. Normas de matrices y vectores. Proyecciones ortogonales. Diagonalización de matrices, autovalores y autovectores. Aplicaciones. Cónicas y cuadráticas. Álgebra vectorial en el espacio tridimensional.', 20, 10),
('1530', 'Análisis Matemático I', 2, 'Números Reales. Funciones de una variable. Límite de Funciones. Límite y Continuidad. Derivadas. Aplicaciones. Integrales. Aplicaciones de la Integral Definida. Sucesiones Numéricas. Series numéricas.', 21, 10),
('1649', 'Resolución de Problemas y Algoritmos', 2, 'Problemas. Algoritmos. Operadores aritméticos y lógicos. Estructuras de control. Noción de modularización. Estructuras de datos lineales: Arreglos. Pilas. Colas. Algoritmos fundamentales: recorrido, búsqueda, ordenamiento, actualización. Recursividad.', 5, 6),
('1650', 'Matemática Discreta', 2, 'Grafos; multigrafos y multidígrafos. Retículos Distributivos. Estructuras Algebraicas: Álgebra de Boole. Presentación del Cálculo Proposicional. Nociones de Álgebra Universal. Teoría de estructuras discretas. Definiciones y pruebas estructurales. Elementos de lógica proposicional y de primer orden. Enfoque sintáctico y semántico. Técnicas de Prueba. Estructura de las pruebas formales.', 22, 6),
('1652', 'Programación Orientada a Objetos', 2, 'Objetos. Clases. Mensajes. Métodos y atributos. Relaciones entre clases. Herencia. Polimorfismo.', 5, 6),
('1654', 'Requerimientos de Software', 2, 'Fundamentos de requerimientos de software. Proceso de ingeniería de requerimientos. Análisis de requerimientos. Elicitación de requerimientos. Documentación y Especificación de requerimientos. Validación de requerimientos. Lenguajes de especificación y métodos formales.', 1, 4),
('1655', 'Aspectos Profesionales', 2, 'Historia de computación. responsabilidad y ética profesional. Impacto económico del software. Computación y sociedad. Propiedad intelectual, licenciamiento del software y contratos informáticos. Aspectos legales laborales y específicos. Patentamiento. Software Libre.', 25, 2),
('1656', 'Estructura de Datos', 2, 'Tipos abstractos de datos: Listas (aplicaciones e implementación). Estructuras de datos no lineales. Algoritmos avanzados de búsqueda y ordenamiento. Análisis de algoritmos. ', 27, 6),
('1657', 'Sistemas Operativos', 2, 'Servicios de Sistemas Operativos. Máquina Virtual. Planificación de CPU. Procesos Concurrentes. Concepto de Proceso. Planificación de Procesos. Interbloqueos. Administración de Memoria. Memoria Virtual. Sistema de Archivos. Protección.', 25, 5),
('1658', 'Análisis y Diseño de Software', 2, 'Fundamentos de Análisis y Diseño. Estrategias y métodos de diseño de software. Notaciones de diseño. Arquitectura de software. Patrones de diseño. Métodos formales. Diseño de interfaces de usuario. Técnicas de Garantía de Calidad.', 9, 6),
('1659', 'Bases de Datos', 2, 'Sistemas y Modelos de bases de datos. Componentes y funciones de un DBMS. Diseño de bases de datos. Lenguajes de manipulación de datos.', 10, 6),
('1660', 'Laboratorio de Programación', 2, 'Herramientas de programación.', 27, 6),
('1661', 'Redes y Telecomunicaciones', 2, 'Técnicas de transmisión de datos, modelos, topologías, redes locales, protocolos de red y algoritmos de ruteo de datos. Sistemas operativos de red. Seguridad en redes. Nociones de Criptografía. Sistemas Cliente/Servidor y sus variantes. El modelo computacional en Internet. Administración de redes. Computación orientada a redes.', 12, 6),
('1662', 'Fundamentos de Ciencias de la Computación', 2, 'Autómatas Finitos - Minimización de Autómatas - Lenguajes y Gramáticas Regulares - Lenguajes y Gramáticas Libres de Contexto - Autómatas a Pila - Lenguajes y Gramáticas Sensibles al Contexto. Máquinas de Turing - Gramáticas estructuradas por frases - Jerarquía de Chomsky - Relación entre lenguajes, gramáticas y autómatas - Computabilidad: Tesis de Turing-Church - Problema de la detención - Funciones Recursivas - Problemas Tratables e Intratables.', 4, 6),
('1663', 'Validación y Verificación de Software', 2, 'Fundamentos de Testing. Niveles de Testing. Métodos y Técnicas de Testing. Técnicas de Garantía de Calidad. Reportes y Análisis de resultados.', 9, 4),
('1664', 'Gestión de Organizaciones', 2, 'Teoría de Organizaciones. Teoría de la Administración. Gestión del Proceso de Planeamiento. Gestión de Organización y Aplicación de Recursos. Gestión de Recursos Humanos y Procesos de Dirección, liderazgo, motivación y comunicaciones. Control, herramientas internas y externas. La responsabilidad social de la empresa.', 40, 6),
('1665', 'Estadística I', 2, 'Conceptos básicos. Distribuciones de frecuencias. Gráficos. Medidas de tendencia central y posición. Medidas de dispersión. Introducción a la Probabilidad básica. Variables aleatorias y distribuciones de probabilidad. Distribuciones discretas y continuas.', 39, 4),
('1666', 'Sistemas Operativos Distribuidos', 2, 'Sistemas Operativos de tiempo real, embebidos, distribuidos. Comunicación. Sincronización. Manejo de recursos y Archivos de sistemas Distribuidos. Memoria compartida distribuida. Control de concurrencia en Sistemas Distribuidos. Transacciones Distribuidas. Seguiridad en Sistemas Distribuidos. Sistemas Colaborativos.', 25, 5),
('1668', 'Gestión de Proyectos de Software', 2, 'Conceptos de gestión, Planificación de proyectos. Métricas y estimación de costos, esfuerzo y tiempo. Riesgos. Organización y personal de proyecto. Control de proyecto. Gestión de configuraciones de software. Implantación y Evolución del software.', 4, 4),
('1671', 'Laboratorio de Redes', 2, 'Técnicas de transmisión de datos, modelos, topologías, protocolos de red y algoritmos de ruteo de datos. Sistemas operativos de red. Seguridad en redes. Administración de redes. Simulación de redes.', 12, 4),
('1673', 'Gestión de Calidad', 2, 'Gestión de Calidad. Gestión del cambio. Gestión de Proyectos. Gestión de Personal. Fundamentos de la planificación de los sistemas de información. Gestión de Riesgos. Mantenimiento. Ingeniería de Software en Sistemas de Tiempo Real.', 4, 4),
('1684', 'Procesos de Desarrollo De Software', 2, 'Cuerpo de conocimiento de ingeniería de software. El proceso de ingeniería de software. Modelos de ciclo de vida. Estándares de proceso de ciclo de vida. Procesos de software individual; procesos de equipo: modelo, definición, medición, análisis y mejora.', 9, 4),
('1987', 'Organización de las Computadoras', 2, 'Representación de los datos a nivel de máquina. Error. Computadoras digitales. Generaciones. Organización funcional. Circuitos lógicos combinatorios y secuenciales. Memorias internas y externas. Dispositivos de Entrada/Salida. Introducción a los sistemas operativos. Principios de la teoría de la información y la comunicación.', 23, 6),
('2137', 'Arquitecturas de Computadoras', 2, 'Estructura y desarrollo de los procesadores. Lenguaje de Máquina y programación en Assembler. Jerarquía de Memoria. Métodos de Entrada/Salida. Mejoras en rendimiento. Nociones de procesadores de alta prestación y máquinas no Von Neumann. Arquitecturas multiprocesadores. Conceptos de arquitecturas reconfigurables. ', 23, 6),
('2138', 'Laboratorio de Desarrollo de Software', 2, 'Herramientas de integración de desarrollo de software. Gestión de Configuraciones. Herramientas de Análisis y Diseño de software. Nociones de sistemas colaborativos.', 4, 6);

--
-- Volcado de datos para la tabla `plan_asignatura`
--

INSERT INTO `plan_asignatura` (`idPlan`, `idAsignatura`, `tieneCorrelativa`) VALUES
('072P2', '1649', 1),
('072P2', '1668', 1),
('072P2', '2138', 0),
('016P4', '0174', 0),
('016P4', '0175', 0),
('016P4', '0473', 0),
('072P2', '1654', 0),
('072P2', '1661', 1),
('016P3', '0174', 0),
('016P3', '0175', 0),
('072P2', '1655', 0),
('072P2', '1657', 1),
('072P2', '1666', 1),
('072P2', '1671', 1),
('001P2', '1108', 0),
('003P3', '1108', 0),
('004P2', '1108', 0),
('023P1', '1108', 0),
('045P2', '1108', 0),
('049P3', '1108', 0),
('060P3', '1108', 0),
('061P1', '1108', 0),
('062P3', '1108', 0),
('064P3', '1108', 0),
('069P1', '1108', 0),
('072P2', '1108', 0),
('074P3', '1108', 0),
('076P2', '1108', 0),
('912P6', '1108', 0),
('913P5', '1108', 0),
('914P3', '1108', 0),
('918P1', '1108', 0),
('016P5', '0901', 0),
('016P5', '1107', 0),
('016P5', '1108', 1),
('016P5', '1528', 1),
('016P5', '1530', 1),
('016P5', '1649', 1),
('016P5', '1650', 1),
('016P5', '1652', 1),
('016P5', '1654', 1),
('016P5', '1655', 0),
('016P5', '1656', 1),
('016P5', '1657', 1),
('016P5', '1658', 1),
('016P5', '1659', 1),
('016P5', '1660', 1),
('016P5', '1661', 1),
('016P5', '1662', 1),
('016P5', '1663', 1),
('016P5', '1664', 0),
('016P5', '1665', 0),
('016P5', '1666', 0),
('016P5', '1668', 0),
('016P5', '1684', 1),
('016P5', '1987', 1),
('016P5', '2137', 1),
('016P5', '2138', 0);

--
-- Volcado de datos para la tabla `profesor_asignatura`
--

INSERT INTO `profesor_asignatura` (`idAsignatura`, `idProfesor`, `rol`) VALUES
('1668', 7, 'practica'),
('1668', 6, 'practica'),
('1649', 8, 'practica'),
('1661', 13, 'practica'),
('1661', 12, 'practica'),
('1108', 17, 'teoria'),
('1108', 18, 'practica'),
('1654', 29, 'practica'),
('2138', 1, 'practica'),
('2138', 29, 'practica'),
('1655', 30, 'practica'),
('0901', 31, 'teoria'),
('0901', 31, 'practica'),
('1530', 32, 'practica'),
('1652', 37, 'practica'),
('1652', 8, 'practica'),
('1649', 8, 'teoria'),
('1649', 33, 'practica'),
('1649', 36, 'practica'),
('1649', 37, 'practica'),
('1649', 38, 'practica'),
('1656', 35, 'practica'),
('1660', 35, 'practica'),
('1650', 20, 'practica'),
('1662', 28, 'teoria'),
('1662', 6, 'practica'),
('1658', 7, 'practica'),
('1663', 28, 'practica'),
('1671', 13, 'practica'),
('1684', 1, 'practica'),
('1657', 41, 'practica'),
('1666', 41, 'practica'),
('1649', 34, 'practica'),
('1649', 34, 'teoria');

--
-- Volcado de datos para la tabla `correlativa_de`
--

INSERT INTO `correlativa_de` (`id`, `requisito`, `idAsignatura`, `idAsignatura_Correlativa_Anterior`, `idPlan`) VALUES
(3, 'Regular', '1668', '1663', '016P5'),
(4, 'Regular', '1673', '1668', '072P2'),
(8, 'Regular', '1661', '1657', '016P5'),
(10, 'Aprobada', '1671', '1661', '072P2'),
(11, 'Regular', '1671', '1666', '072P2'),
(12, 'Aprobada', '1668', '1658', '072P2'),
(13, 'Aprobada', '1668', '1659', '072P2'),
(14, 'Regular', '1668', '1663', '072P2'),
(15, 'Aprobada', '1661', '1649', '072P2'),
(16, 'Regular', '1666', '1661', '072P2'),
(17, 'Regular', '1661', '1657', '072P2'),
(18, 'Regular', '1657', '1649', '072P2'),
(19, 'Regular', '1664', '1108', '016P5'),
(20, 'Regular', '1650', '1528', '016P5'),
(21, 'Regular', '1665', '1530', '016P5'),
(26, 'Regular', '1659', '1654', '016P5'),
(27, 'Regular', '1656', '1650', '016P5'),
(28, 'Regular', '1656', '1652', '016P5'),
(29, 'Aprobada', '1657', '1649', '016P5'),
(32, 'Aprobada', '1659', '1649', '016P5'),
(33, 'Regular', '1663', '1659', '016P5'),
(34, 'Regular', '1660', '1659', '016P5'),
(35, 'Regular', '1658', '1654', '016P5'),
(36, 'Regular', '1658', '1652', '016P5'),
(37, 'Regular', '1663', '1658', '016P5'),
(38, 'Regular', '1660', '1658', '016P5'),
(39, 'Regular', '2138', '1660', '016P5'),
(40, 'Regular', '1666', '1661', '016P5'),
(41, 'Aprobada', '1662', '1650', '016P5'),
(42, 'Regular', '1662', '1652', '016P5'),
(43, 'Regular', '1652', '1649', '016P5'),
(44, 'Regular', '2138', '1663', '016P5'),
(45, 'Regular', '1654', '1684', '016P5'),
(46, 'Regular', '2137', '1987', '016P5'),
(47, 'Regular', '1657', '2137', '016P5');

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id`, `anio`, `anioCarrera`, `horasTeoria`, `horasPractica`, `horasOtros`, `regimenCursada`, `observacionesHoras`, `observacionesCursada`, `fundamentacion`, `objetivosGenerales`, `organizacionContenidos`, `criteriosEvaluacion`, `metodologiaPresencial`, `regularizacionPresencial`, `aprobacionPresencial`, `metodologiaSATEP`, `regularizacionSATEP`, `aprobacionSATEP`, `metodologiaLibre`, `aprobacionLibre`, `ubicacion`, `idAsignatura`, `aprobadoSa`, `aprobadoDepto`, `fechaCarga`, `vigencia`, `comentarioSa`, `comentarioDepto`, `enRevision`, `fueDesaprobado`) VALUES
(2, 2018, '3', '02:00:00', '02:00:00', NULL, '2', NULL, NULL, 'La ingeniería de Software es un campo de las ciencias de la Computación que basado en principios robustos y bajo un enfoque disciplinado y cuantificable, desarrolla y evoluciona productos de software de calidad.\r\nLa gestión de proyectos es un área ampliamente aplicada en otras disciplinas y la ingeniería de software no está exceptuada de ello, tanto en grandes como pequeños proyectos.', 'El objetivo principal es brindar fundamentos para que los alumnos distingan los elementos claves que deben manejar los participantes del Proceso de desarrollo en los proyectos de software. Promover la integración de conceptos, técnicas y herramientas necesarias para diseñar, implementar y controlar sistemas de información. Ser capaz de manejar elementos científicos, técnicas y metodologías necesarias para participar en tareas concernientes al proceso de desarrollo de Software de aplicación.', 'MODULO I  CONCEPTOS BASICOS DE INGENIERIA DE SOFTWARE\r\nSoftware - Conceptos - Evolución y Perspectivas. Objetivos del desarrollo de Software. Rol del Software - Áreas de aplicación. Crisis del Software - Problemas, Causas, y Mitos - Metodología, Técnicas y Herramientas. Paradigmas del desarrollo de Software.\r\n\r\nMODULO II  PLANIFICACION Y GESTION DE PROYECTOS DE SOFTWARE\r\nPlanificación de Proyectos. Métricas y Estimación. Control y Avance. Revisiones e Inspecciones. Evaluación de Factibilidad Técnica. Operativa y Económica. Análisis de Riesgo, Identificación, Evaluación. Gestión Ágil.', 'Con la finalidad de alcanzar los propósitos planteados establecidos para el desarrollo de la asignatura las siguientes estrategias:\r\n- Clases teórico-prácticas\r\n- Trabajos Prácticos\r\n- Lecturas', 'Clases Teórico-Prácticas: se abordan los contenidos detallados en el Programa de la Asignatura y se ejemplifica con casos prácticos.\r\nTrabajos Prácticos: se propone la resolución de ejercicios y casos sobre temas específicos, la lectura y discusión de artículos y la exposición de determinados temas. Los trabajos pueden ser grupales o individuales', '- Presentar y exponer el 100% de los trabajos (trabajos prácticos y lecturas) en las fechas establecidas por la cátedra, según el cronograma de actividades de la asignatura.\r\n- Aprobar los parciales o su respectivo recuperatorio integrador. Esto exámenes se aprobarán con un mínimo del 60% correcto del puntaje total.', 'Se evaluarán los conocimientos a través de un examen final, que podrá tener la modalidad oral o escrita.', 'Esta asignatura NO puede ser impartida en modalidad semiprensencial', '-', '-', 'Los alumnos que deseen rendir en esta modalidad deberán contactarse con el docente a osofia@uarg.unpa.edu.ar, expresando su deseo de rendir la asignatura. El docente coordinará con el alumno una reunión donde le explicará el objetivo y los contenidos de las prácticas propuestas. Además podrá consultar la totalidad del material bibliográfico propuesto.', 'Aprobación Final:\r\n- Presentación de la totalidad de las lecturas al menos 10 días antes del examen.\r\n- Presentación de la totalidad de los ejercicios prácticos propuestos por la cátedra al menos 10 días antes del examen.\r\n- Sección teórica o escrita\r\n- Sección práctica escrita', 'SA', '1668', NULL, NULL, '2018-02-15', '3', NULL, NULL, b'1', b'0'),
(3, 2007, '1', '02:00:00', '04:00:00', '01:00:00', 'A', 'Clases de consulta', '', 'El propósito es introducir a los alumnos en el análisis y abstracción de problemas, y diseño de algoritmos. Al finalizar esta asignatura el alumno deberá ser capaz de representar algorítmicamente la solución de problemas de complejidad intermedia. \r\nLa asignatura comienza con la resolución de problemas cotidianos que se pueden dividir en varios pasos; expresándose en forma narrativa. Luego se introducen expresiones algorítmicas (operaciones aritméticas, lógicas, estructuras de control, variables, etc.) en pseudocódigo; tipos de datos simples (Entero, Real, Caracter y Booleano) y compuestos (Arreglos, Pilas y Colas) que se aplican para el diseño y representación de algoritmos a problemas simples de carácter matemático (sumas, productos, promedios, números primos, amigos, perfectos, etc.) mediante una previa especificación del análisis de entradas y salidas. Se concluye con la técnica de recursión.\r\n', '- Conocer y entender los conceptos esenciales de la Programación.\r\n- Aprender y saber aplicar las Estructuras de Control. \r\n- Aprender y saber implementar los Arreglos, las Pilas y las Colas.\r\n- Entender y aprender la técnica de recursividad.\r\n- Entender y saber armar un Programa Modular aplicando OO básico. \r\n- Aprender a codificar en lenguaje Java.', 'UNIDAD I – Problemas y Algoritmos\r\nPrograma, Programador, Programación. Paradigmas de Programación. Lenguajes de Programación. Problema. Análisis del Problema. Algoritmo. Diseño del Algoritmo. Datos. Tipos de datos: Simples (Entero, Real, Caracter y Booleano) y Compuestos. Variables. Constantes. Identificadores. Operaciones primitivas. Asignación. Expresiones Aritméticas. Expresiones Lógicas. Lectura (entrada de datos) y Escritura (salida de datos). \r\n\r\nUNIDAD II - Estructuras de Control\r\nEstructuras de Control: Secuenciación, Selección (SI-SINO, ALTERNAR) e Iteración o bucle (MIENTRAS, HACER-MIENTRAS, PARA). Contadores. Acumuladores. Bucles controlados por contador y suceso. Invariante de bucle.\r\n\r\nUNIDAD III - Programa y Funciones\r\nPrograma (Principal). Estructura general de un Programa. Partes constitutivas de un Programa. Funciones. Declaración e invocación de funciones. Precondiciones y postcondiciones. Variables locales. Parámetros actuales y formales. Ámbitos de los identificadores.\r\n\r\nUNIDAD IV – Clases/Objetos\r\nClases. Objetos. Atributos. Métodos. Constructores. Mensajes. Ventajas: encapsulación, reuso, ocultamiento de la información.\r\n\r\nUNIDAD V - Arreglos\r\nArreglos Unidimensionales (Vectores) y Bidimensionales (Matrices). Manejo de Índices. Operaciones de: asignación, lectura y escritura de datos, recorrido, y actualización. Métodos de Búsqueda (Secuencial y Binaria). Método de Ordenación (Intercambio o Burbuja, Inserción y Selección).\r\n\r\nUNIDAD VI - Java y Laboratorio\r\nLenguaje Java. Pasaje a máquina (de pseudocódigo a Java). Clases y método Main. Referencias en java. Edición. Compilación. Puesta a punto de programas. Paquetes. Modificadores de Acceso. Sobrecarga. Operador This. Arreglos en Java. Clase Vector y Matriz. Clase String (Cadena). Clases estáticas. Clase Random.\r\n', 'La evaluación se plantea como un proceso natural por ello se planifica y diseña como una continuidad de las actividades realizadas. Además, la decisión de fijar 5 (cinco) exámenes y 1 (un) examen recuperatorio general, de carácter práctico, permite obtener rápidamente información acerca de la evolución en el proceso de aprendizaje y detectar a tiempo aquellos casos en los que falta un apuntalamiento, refuerzos y apoyo. Es necesario, contar con un 75% total de asistencia a las clases prácticas. Permite al alumno una mayor dedicación a la resolución de los ejercicios prácticos.', 'La materia consta de 1 (una) clase teórica y 2 (dos) clases prácticas, por semana. Cada unidad posee su teoría y trabajo práctico correspondiente. De acuerdo a la complejidad de los temas, las clases prácticas varían en cantidad de días. Los alumnos cuentan dos semanas antes del examen, con clases de consultas. La resolución de los ejercicios prácticos se realiza en papel (1º cuatrimestre) y en máquina (2º cuatrimestre). Como antes se ha mencionado existen evaluaciones parciales y durante las clases prácticas se toma asistencia, siendo ésta un complemento de evaluación.', '- Cumplir con el 75% de asistencia a las clases prácticas. \r\n- Aprobar todos los exámenes o el recuperatorio general.\r\n', '- Examen escrito (práctico)\r\n- Examen oral (teoría)', 'Los alumnos pueden acudir por asistencia en los días, horarios y lugares en los que la cátedra se dicta. Para mayor información ingresar a la página web del área: http://espanol.geocities.com/profeprog/', 'No aplica', '- Examen escrito (práctico)\r\n- Examen oral (teoría)', 'Podrán contar con el apunte de cátedra y los prácticos correspondientes. Se aceptan consultas. Para rendir el final, sólo tendrán que asistir al mismo habiendo practicado lo suficiente y conocer los conceptos teóricos que se encuentran en el apunte de cátedra, como para estar en condiciones de rendir. Para mayor información ingresar a la página web del área: http://espanol.geocities.com/profeprog/', '- Igual que los alumnos presenciales, solo que incorporando un ejercicio más', 'SA', '1649', b'1', b'1', '2007-02-13', '3', NULL, NULL, b'1', b'0'),
(99, 2019, '3', '09:00:00', '09:00:00', '02:00:00', '2', 'a', 'a', '<p><b>Negrita </b><i>Italic</i>&nbsp;<u>Underline</u></p><ul><li><u>aa</u></li><li><u>aa</u></li></ul><p><u>SS</u></p><ol><li style=\"text-align: center;\"><u>fcds</u></li><li style=\"text-align: center;\"><u>cfd</u></li><li style=\"text-align: center;\"><u><br></u></li></ol>', 'A', 'a', 'a', 'a', 'a', 'a', 'a', 'aa', 'a', 'a', 'a', 'SA', '1659', b'0', b'0', '2019-06-15', '3', NULL, NULL, b'1', b'1'),
(100, 2019, '3', '03:00:00', '03:00:00', '00:00:00', 'A', 'a', 'a', '<p><b>Negrita </b><i>Italic</i>&nbsp;<u>Underline</u></p><ul><li><u>aa</u></li><li><u>aa</u></li></ul><p><u>SS</u></p><ol><li style=\"text-align: center;\"><u>fcds</u></li><li style=\"text-align: center;\"><u>cfd</u></li><li style=\"text-align: center;\"><u><br></u></li></ol>', 'A', 'a', 'a', 'a', 'a', 'a', 'a', 'aa', 'a', 'a', 'a', 'SA', '1649', b'0', b'0', '2019-05-01', '3', NULL, NULL, b'1', b'1'),
(101, 2018, '4', '03:00:00', '03:00:00', NULL, '1', NULL, NULL, 'Desde la masificación de los sistemas informáticos las redes han tenido un cosntante desarrollo y han ido, paulatinamente, ampliado su espectro de servicios. Esta evolución ha posibilitado ...', '...', '...', '...', '...', '...', '...', '...', '...', '...', '...', '...', 'SA', '1661', b'0', b'0', '2018-02-01', '2', NULL, NULL, b'1', b'0'),
(102, 2019, '2', '02:30:00', '02:30:00', NULL, '2', NULL, NULL, 'Este programa tiene como objetivo que los alumnos adquieran conocimientos en los conceptos básicos y específicos sobre el diseño de software destinado a controlar los recursos propios de un computador. Para los profesionales de computación es indispensable dominar los conceptos básicos asociados al software que permite la administración eficiente de los recursos que ofrece un computador a los usuarios.\r\nLa asignatura se encuentra ubicada en el segundo cuatrimestre del segundo año de la carrera de Analista de Sistemas y Licenciatura en Sistemas. Se enfoca en formar al alumno en la isquion de conocimientos sobre los fundamentos de software de base, aplicar técnicas de programación, configuración y administración  de los recursos de un computador. De forma que, como futuro profesional adquiera los conocimientos sobre administración y gestión de los recursos de un computador.', 'Este programa tiene como objetivo que los alumnos adquieran conocimientos en los conceptos básicos y específicos sobre Sistemas Operativos. Las características de funcionamiento y diseño de los mismos. La capacidad de evaluar las ventajas y desventajas de cada uno de ellos.', 'Unidad I, Introducción\r\n\r\n1.1 Introducción a los Sistemas Operativos: El sistema operativo como una máquina extendida. El sistema operativo como controlador de recursos. Definiciones de SO.\r\n1.2 Sistema de Computo. Servicios del Sistema Operativo.\r\n1.3 Evolución histórica\r\n1.4 Conceptos y tecnología básica\r\n1.5 Estructura de los Sistemas Operativos\r\n\r\nUnidad II, Procesos\r\n\r\n2.1 Estados y transiciones\r\n2.2 Caracterización de procesos\r\n2.3 Secciones críticas\r\n2.4 Bloqueo mutuo (interbloqueo)\r\n2.5 Semáforos\r\n2.6 Comunicación entre procesos\r\n2.7 Problemas clásicos de sincronización de procesos\r\n\r\nUnidad III, Administración de la CPU\r\n\r\n3.1 Tipos de planificación\r\n3.2 Estrategias de planificación del procesador\r\n3.3 Planificación Linux\r\n\r\nUnidad IV, Administración de la memoria principal\r\n\r\n4.1 Esquemas antiguos\r\n4.2 Memoria virtual\r\n4.3 Segmentación\r\n4.4 Paginación\r\n\r\nUnidad V, sistema de Archivos\r\n\r\n5.1 Estructura física del disco\r\n5.2 Estructura lógica del disco\r\n5.3 Estrategias de planificación de cabezales.\r\n5.4 Organización del sistema de archivo (Unix, MS-DOS)\r\n5.5 Mecanismos de seguridad\r\n\r\nUnidad VI, Protección\r\n\r\n6.1 Entorno seguro\r\n6.2 Criptografía básica\r\n6.3 Autentificación de usuarios\r\n6.4 Ataques desde el interior del sistema\r\n6.5 Ataques desde el exterior del sistema\r\n6.6 Mecanismos de protección\r\n\r\nUnidad VII, Sistema Operativo: LINUX\r\n\r\n7.1 Conceptos de Shell y usuarios\r\n7.2 Organización de directorios\r\n7.3 Dispositivos tratados como archivos\r\n7.4 Procesos y \"demonios\"\r\n7.5 Comandos principales\r\n7.6 Programación Shell\r\n7.7 Comandos para administración del sistema\r\n7.8 El ambiente de programación Unix\r\n7.9 Proyecto final de la materia. Desarrollo de software de sistema utilizando herramientas disponibles en Linux', 'En lo general, se evaluarán los conocimientos teóricos y prácticos\r\nLa evaluación de la cursada como del final varia según la modalidad de la cursada (presencial, no presencial, libre) de acuerdo a lo estipulado en el reglamento de alumnos.', 'En la cátedra se realizaran actividades especificas de las clases teóricas, practicas y uso del laboratorio. En base a ello, los alumnos son guiados y asistidos en el desarrollo de los distintos temas que componen el programa de la materia.\r\n\r\nSe le brindará al alumno material de estudio como presentaciones, lecturas recomendadas, ejercitaciones. De esta manera se integraran conocimientos. En particular, cada tema cuenta con la bibliografia de lectura recomendada a fin de poder complementar y ampliar los conceptos vertidos en el aula.\r\n\r\nLas practicas se realizan en un laboratorio. En las mismas se desarrollan los contenidos relacionados al Sistema Operativo de estudio. El alumno afianza los conocimientos teóricos adquiridos y los relaciona con su implementacion practica. Durante el transcurso del cuatrimestre el alumno va desarrollando una serie de tareas en maquina que son evaluadas.\r\n\r\nEn forma opcional por parte de la cátedra, a mediados del cuatrimestre el alumno deberá prepara y desarrollar un proyecto de software practico de forma grupal, mediante el cual se utilizan las herramientas disponibles en el Sistema Operativo. El desarrollo del proyecto es realizada de forma asistida y guiada.', 'Aprobación de dos parciales escritos teóricos, con 60 de 100 puntos posibles en cada caso.\r\nSe darán dos exámenes recuperatorios, donde se puede recuperar uno de los parciales correspondientes.\r\nFinalizado el cuatrimestre se evaluara en la practica:\r\nDesarrollo y aprobación de una secuencia de tareas practicas propuestas.\r\nAsistencia mínima del 75% a las practicas.\r\nComo complemento a la evaluación de practica (opcionales de la cátedra)\r\nSe evaluara un proyecto de software practico de la materia, de carácter grupal (programa analítico 7.9).\r\nComo complemento a la evaluación teórica (opcionales de la cátedra)\r\nSe asignara un tema individual para desarrollar una monografia.', 'Examen escrito y oral', 'Instancia SATEP 0\r\nLos alumnos disponen de la posibilidad de evacuar las dudas teóricas o practicas mediante la consulta a los docentes vía email. se coordinaran encuentros presenciales para coordinar la realización de los trabajos prácticos y elaboración de los informes de los mismos. Ademas, se les proveerá de lecturas recomendadas que les posibiliten adquirir un ', 'Aprobar un parcial teórico-practico con 60/100 puntos.\r\nComplementario al final el alumno debe preparar previamente dos monografias. Una para ser entregada a mediados del cuatrimestre y la otra al final del cuatrimestre. Ambas serán asignadas previamente por el responsable de la cátedra.\r\nAprobar defensa de las monografias presentadas con anterioridad.\r\nAprobación de una secuencia de tareas practicas a designar, las cuales deberán ser defendidas oportunamente.', 'Aprobar defensa de tareas practicas designadas\r\nExamen practico en maquina\r\nExamen escrito aprobado con al menos 60/100 puntos\r\nExamen oral', 'Los alumnos libres pueden asistir a las clases teóricas, allí reciben los fundamentos teóricos. En caso de no, poder asistir pueden remitirse al equipo de cátedra para obtener el material de apoyo teórico y practico correspondiente.\r\nComplementario al final el alumno debe preparar previamente dos monografias:\r\nComo preparación del examen final, el alumno libre debe solicitar los temas correspondientes a dos monografias a desarrollar. Ambas seras asignadas previamente por el responsable de la cátedra. Ambas deberán haber sido presentadas formalmente 30 días antes del final.', 'Aprobar defensa oral y/o escritas de las monografias presentadas con anterioridad.\r\nAprobar examen practico en maquina.\r\nAprobar examen teórico escrito con 60/100 puntos.\r\nAprobar examen oral.', 'SA', '1657', NULL, NULL, '2019-04-12', '3', NULL, NULL, b'1', b'0'),
(103, 2020, '2', '01:00:00', '01:00:00', NULL, '1', NULL, NULL, 'La asignatura se propone brindar a los alumnos las herramientas y estrategias teóricas-metodológicas necesarias para el análisis y comprensión de aspectos que los ubiquen como futuros profesionales en el ejercicio especifico de su profesión dentro de la sociedad. Esta focalizada hacia la reflexión sobre los saberes necesarios para la práctica profesional basado en la ética y en una visión de mundo cimentada desde el rigor y la actitud critica. En esta instancia, los alumnos ya transitaron de manera gradual una aproximación a la ciencia de la computación, por ello se propone también generar las condiciones necesarias para que los alumnos de manera conciente y creativa puedan conocer los aspectos fundamentales de la profesión y de los aspectos éticos sociales y legales que la involucran. La profesionalidad del fututos Analistas de Sistemas tiene que tener como pilares básicos el buen juicio, en sentido critico y ético que sea capaz de apreciar que conviene hacer, que es posible y como hacerlo dentro de unas determinadas circunstancias.', 'Ubicar al profesional en los aspectos relacionados con el ejercicios de su profesión dentro de la sociedad.\r\nFavorecer el trabajo en equipo potenciando las capacidades de comunicación y coordinación.\r\nMotivar a la consulta de material bibliográfico actualizado, y otras fuentes, para la presentación de trabajos referidos a la disciplina.\r\n\r\nOBJETIVOS ESPECÍFICOS\r\nCapacitar para la reflexión sobre el impacto en la sociedad de la profesión de Analista de Sistemas\r\nCapacitar para la reflexión sobre la ética y la deontología profesional.\r\nConocer las normas legales aplicables al ejercicio profesional, con énfasis en la Ley de Protección de Datos y la Ley de Servicios de la Sociedad de la Información.\r\nConocer los principios fundamentales de historia de la computación.\r\nConocer los lineamientos legales establecidos para elaborar proyectos y desarrollos de software.\r\nPreparar a los alumnos en los adelantos principales en tratamiento computacional de la información.', 'Unidad 1: Historia de la Informática Antecedentes históricos de la informática y del cálculo artificial. El nacimiento de las computadoras. Las primeras computadoras. Los ordenadores de los años 50. Los años 60 y 70.  El software, evolución y crisis del Software. Conceptos de Ingeniería del Software.\r\nUnidad 2: Informática, Ética Profesional E Impacto Social (Informática y sociedad). Cambio tecnológico y cambio social. Viejos y nuevos servicios en la informática.\r\nUnidad 3: Aspectos Legales. Contrato Informático. Concepto. Ejemplos Propiedad Intelectual de los Desarrollos Informáticos. Titularidad. Transferencia de Titularidad. Protección Jurídica del software: Ley 11723, dec. 165/94 Delitos informáticos.\r\nUnidad 4: Pericias informáticas: Aspectos legales, Marco  tecnológico pericial.\r\nUnidad 5: Software Libre. Introducción al software libre. El concepto de libertad en el software. Consecuencias de la libertad del software. Evolución histórica del software libre. Licencias en el software libre. Implementación de sistemas de software libre. Ingeniería del software en entornos del software libre Utilidades y herramientas de software libre .\r\nUnidad 6: Impacto  Económico  del  Software.  Productividad  en  la  construcción  el  software.  Migración  a  software  libre  en  las organizaciones. Impacto en la economía de la piratería de software. TIC y cambios en la estructura económica y social. Las TIC y la nueva economía. TICs en las empresas, en la educación ,el software libre y agenda digital Argentina.', 'En lo general, se evaluarán los conocimientos teóricos y prácticos. Con la finalidad de alcanzar los propósitos planteados establecemos para el desarrollo de la asignatura las siguientes estrategias:\r\n- Clases Teórico-Prácticas: Se abordan los contenidos teóricos, y se muestran casos de ejemplos.\r\n- Trabajos Prácticos: Se propone, lectura y discusión de artículos y exposición de determinados temas. Los trabajos pueden ser grupales o individuales.\r\n- Trabajo de Campo: Se propone la resolución de un informe y/o presentación donde el alumno aplique contenidos teóricos de la asignatura.\r\nSe plantean los siguientes criterios de evaluación:\r\n- Comprensión lectora: capacidad de establecer relación entre conceptos, comparar.\r\n- Interpretación de consignas. \r\n- Uso de vocabulario especifico de la disciplina.\r\n- Manejo de conceptos claves de la disciplina.\r\n- Comunicación clara, (oral y escrita)\r\n- Presentación en tiempo y forma de los trabajos propuestos.\r\n- Análisis y resolución de situaciones problemáticas referidas a la asignatura. \r\nLa evaluación de la cursada como del final varia según la modalidad de la cursada (presencial, no presencial,libre) de acuerdo a lo\r\nestipulado en el reglamento de alumnos.', 'La metodología integrara la teoría y la práctica. El tratamiento didáctico consistirá en un seminario taller con trabajos individuales, grupales, con actividades de interpretación análisis y aplicación del marco teórico. La dinámica de trabajo girara en torno a la reflexión y conceptualización de los grandes temas de la historia de la computación, la ética, aspectos legales vinculados la profesión, impacto económico del software, tanto en el plano estrictamente teórico como así también en el plano de la práctica, utilizando bibliografía específica.', 'Para regularizar la materia se deben aprobar: Dos parciales teóricos-prácticos con un recuperatorio del parcial desaprobado. Aprobar el 80 % de los trabajos prácticos. Desaprobar alguna de las instancias ubica al alumno en la condición de libre. ', 'Para Aprobar la materia se debe aprobar un examen teórico-práctico.', 'Instancia SATEP 0\r\nLos alumnos disponen de la posibilidad de evacuar las dudas teóricas o prácticas mediante la consulta a los docentes vía email. ', 'Aprobar un parcial teórico-práctico con  60/100 puntos.\r\nComplementario al final el alumno debe preparar previamente dos  monografías. Una para ser entregada a mediados de cuatrimestre y la otra al final del cuatrimestre. Ambas serán asignadas previamente por el responsable de la cátedra. \r\nAprobar defensa de las monografías presentadas con anterioridad.', 'Para Aprobar la materia se debe aprobar un examen teórico-práctico.', 'Los alumnos libres pueden asistir a las clases teóricas, allí reciben los fundamentos teóricos. En caso de no, poder asistir pueden remitirse al equipo de cátedra para obtener el material de apoyo teórico y práctico correspondiente.  \r\nComplementario al final el alumno debe preparar un informe sobre alguna de las unidades del programa:\r\nEl informe deberá haber sido presentado formalmente 15 días antes del final. ', 'La presentación quince días antes del examen, de un informe sobre alguna de las unidades del programa.\r\nAprobar un examen teórico-práctico. ', 'SA', '1655', NULL, b'1', '2020-02-17', '3', NULL, NULL, b'1', b'0'),
(104, 2020, '3', '02:30:00', '02:30:00', NULL, '2', NULL, NULL, 'Este programa tiene como objetivo que los alumnos adquieran conocimientos en los conceptos básicos y específicos sobre el diseño de software  destinado a controlar  los recursos propios de un  ambiente de multiprogramación. La creciente importancia de las comunicaciones y su integración a los sistemas de computo modernos. Hacen indispensable para los profesionales de computación, el dominar los conceptos básicos asociados a los sistemas distribuidos.\r\nLa asignatura se encuentra ubicada en el segundo cuatrimestre del tercer año de la carrera de Analista de Sistemas y Licenciatura en Sistemas. Se enfoca en formar al alumno en la adquisición de conocimientos sobre los fundamentos para la aplicación  de  técnicas  diseño,  programación  y  administración  de  recursos  distribuidos.  De  forma   que,  como  futuro profesional adquiera los conocimientos  sobre  administración y gestión de  los recursos de un conjunto de computadores.', 'Este programa tiene como objetivo que los alumnos conozcan y apliquen conocimientos en las técnicas empleadas en el desarrollo  de  software  destinado  a  controlar  los  recursos  que  ofrece  un  computador  y  crear  un  ambiente  de  multiprogramación. El alumno conocerá, administrará y programará el sistema operativo Unix / Linux. Finalmente, el alumno comprenderá los principios básicos de diseño sistemas distribuidos.', 'Unidad I, Introducción\r\n1.1. Introducción a los Sistemas Operativos Distribuidos: Definición. Objetivos. Hardware. Software.\r\n1.2  Sistemas en tiempo  real, Embebidos y Colaborativos: definición y conceptos\r\n1.3. Tipos de Sistemas Distribuidos\r\n1.4. Arquitecturas:  Modelos. Arquitecturas. \r\n\r\nUnidad II, Procesos \r\n2.1. Hebras de control. Asignación de procesadores. Planificación.\r\n2.2. Agentes. Clientes. Servidores\r\n2.3. Migración de procesos. Virtualización\r\n\r\nUnidad III, Sincronización, estado \r\n3.1. Sincronización de relojes.\r\n3.2. Ordenamiento de eventos.\r\n3.3. Exclusión mutua.\r\n3.4. Elección de coordinador.\r\n\r\nUnidad IV, Comunicación\r\n4.1. Pasaje de mensajes.\r\n4.2. Modelo Cliente Servidor.\r\n4.3. Procedimientos remotos.\r\n4.4. Objetos distribuidos.\r\n4.5. Eventos distribuidos.\r\n\r\nUnidad V, Nombres (naming)\r\n5.1. Servicios de nombres.\r\n5.2. Directorios y servicio de directorio.\r\n\r\nUnidad VI, Consistencia y replicación\r\n6.1. Arquitecturas.\r\n6.2. Modelos de consistencia.\r\n\r\nUnidad VII, Archivos y memoria en sistemas distribuidos\r\n7.1.  Sistemas de archivos distribuidos: Arquitectura, Comunicaciones, Sincronización, consistencia y replicación, tolerancia a fallas y seguridad \r\n7.2.  Memoria en sistemas distribuidos: Introducción, cuestiones de diseño e implementación, Consistencia \r\n\r\nUnidad VIII, Seguridad en Sistemas Distribuidos\r\n8.1. Introducción a la seguridad\r\n8.2. Canales seguros\r\n8.3. Control de acceso\r\n8.4. Administración de la seguridad\r\n\r\nUnidad IX, Transacciones y control de concurrencia en sistemas distribuidos\r\n9.1. Transacciones\r\n9.2. Transacciones anidadas\r\n9.3. Bloqueos\r\n9.4. Control optimista de la concurrencia\r\n9.5. Ordenación por marcas de tiempo ', 'La evaluación de la cursada se realiza mediante la aprobación de dos parciales teóricos-prácticos, aprobación de una secuencia de tareas prácticas y del proyecto final de la materia. Se requiere una asistencia mínima de 75% a las prácticas. \r\nLa evaluación final es teórica  y práctica. La teoría es evaluada mediante preguntas (escritas y/o orales) y la práctica mediante la defensa del proyecto final desarrollado durante el cursado de la materia. Con ello se evalúa la claridad y capacidad del alumno para exponer un tema afín a los que se ven durante el cursado.', 'La cátedra formaliza, al principio del cuatrimestre, un detallado cronograma de actividades en donde se especifica cuando tendrán lugar las clases teóricas, prácticas (en laboratorio). En base a ello, los alumnos son guiados y asistidos en el desarrollo de los distintos temas que componen el programa de la materia.\r\nPara el desarrollo de la teoría el alumno cuenta con las presentaciones que el profesor proyecta. De esta manera puede hacer el seguimiento de la clase y realizar las anotaciones complementarias que crea conveniente. Así mismo, cada tema cuenta con la bibliografía de lectura recomendada a fin de poder complementar y ampliar los conceptos vertidos en el aula.\r\nLas prácticas se realizan  en un laboratorio.  En  las mismas se desarrollan los contenidos  relacionados  al  Sistema Operativo de estudio (Linux) y diversas tecnologías de soporte disponible para sistemas distribuidos. El alumno afianza los conocimientos teóricos adquiridos  y los relaciona  con su  implementación  práctica.  Durante el transcurso del cuatrimestre el alumno va desarrollando una serie de tareas en maquina que son evaluadas.', 'Aprobación de dos parciales escritos teóricos, con 60 de 100 puntos posibles en cada caso.\r\nExisten dos examen recuperatorio, donde se puede recuperar el parcial correspondiente.\r\nAprobación de una secuencia de tareas prácticas.\r\nAsistencia mínima del 75% a las prácticas.', 'Examen escrito y/o oral', 'nstancia SATEP 0\r\nLos alumnos disponen de la posibilidad de evacuar las dudas teóricas o prácticas mediante la consulta a los docentes de  la  cátedra.  Las  lecturas  recomendadas  les  posibilitan  adquirir  un  panorama  más  amplio  y  concreto  de  los conceptos.', 'Aprobar un parcial teórico-práctico con  60/100 puntos.\r\nComplementario al final el alumno debe preparar previamente dos  monografías. Una para ser entregada a mediados de cuatrimestre y la otra al final del cuatrimestre. Ambas serán asignadas previamente por el responsable de la cátedra. \r\nAprobar defensa de las monografías presentadas con anterioridad.\r\nAprobación de una secuencia de tareas prácticas a designar, las cuales deberán ser defendidas oportunamente. ', 'Aprobar examen práctico en máquina.\r\nAprobar examen teórico escrito con 40/100 puntos\r\nAprobar examen oral, sobre un tema asignado previamente.', 'Los alumnos libres pueden asistir a las clases teóricas, allí reciben los fundamentos teóricos. En caso de no, poder asistir pueden remitirse al equipo de cátedra para obtener el material de apoyo teórico y práctico correspondiente. ', 'Para los alumnos libres que opten por realizar las actividades de la modalidad presencial para la regularidad rendirán solo Examen escrito y/o oral. Aquellos que no,  complementario al final el alumno debe preparar previamente un informe sobre los contenidos de tres de las unidades del programa vigente de la materia. Para ser entregado 30 días antes del final.   \r\nAprobar defensa del informe presentado con anterioridad.\r\nAprobar examen práctico en máquina.\r\nAprobar examen teórico escrito con 40/100 puntos\r\nAprobar examen oral', 'SA', '1666', b'0', b'1', '2020-02-18', '3', 'ASD', NULL, b'1', b'0'),
(105, 2018, '1', '02:00:00', '02:00:00', '04:00:00', '2', 'Horarios de Consulta: cuatro encuentros semanales de una hora reloj cada uno, por cada Comisión.', NULL, 'aaa', 'aaa', '...', '...', '...', '....', '...', '..', '...', '......', '........', '.....', NULL, '1108', b'1', b'1', '2017-10-25', '3', NULL, NULL, NULL, b'0');
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
(1, 'Sanchez', 'Héctor', 'Recursividad y sus aplicaciones prácticas', 'Algoritmos de Programación', '10 - 30', '0000-00-00', '2 - 5', 'UARG', NULL, NULL, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
