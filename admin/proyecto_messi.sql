-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-04-2024 a las 17:33:44
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
-- Base de datos: `proyecto_messi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipos` int(11) NOT NULL,
  `nombre_equipo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `img_equipos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipos`, `nombre_equipo`, `descripcion`, `img_equipos`) VALUES
(18, 'Barcelona', 'El mago del futbol, dejó una huella imborrable en el Camp Nou con su genialidad inigualable.', 'imagenes/messi-barcelona.png'),
(19, 'Selección Argentina', 'Messi, el símbolo del fútbol argentino, cautivó al mundo con su talento y liderazgo en la Albiceleste.', 'imagenes/messi-argentina.png'),
(20, 'Paris Saint Germain', 'En París, Messi llevó su elegancia futbolística a nuevas alturas, iluminando el Parc des Princes con su genio.', 'imagenes/messienparis.png'),
(22, 'Inter Miami', 'En Miami, Messi escribirá un nuevo capítulo en su legado, llevando su pasión por el juego a las playas de Florida.', 'imagenes/messi-intermiami.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas`
--

CREATE TABLE `estadisticas` (
  `id` int(11) NOT NULL,
  `partidos` int(10) NOT NULL,
  `goles` int(10) NOT NULL,
  `asistencias` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticas`
--

INSERT INTO `estadisticas` (`id`, `partidos`, `goles`, `asistencias`, `fecha`) VALUES
(1, 1055, 832, 367, '2024-04-30 01:03:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palmares`
--

CREATE TABLE `palmares` (
  `id_palmares` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `img_titulo` varchar(255) NOT NULL,
  `id_equipos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `palmares`
--

INSERT INTO `palmares` (`id_palmares`, `titulo`, `cantidad`, `img_titulo`, `id_equipos`) VALUES
(3, 'La Liga', 10, 'imagenes/laliga-c.png.png', 18),
(5, 'Copa del Rey', 7, 'imagenes/copadelrey-c.png (1).png', 18),
(6, 'Mundial de Clubes', 3, 'imagenes/mundialdc.png', 18),
(7, 'Supercopa de Europa', 3, 'imagenes/supercopaeuropa-c.png.png', 18),
(8, 'Supercopa de España', 8, 'imagenes/supercopaespaña.png.png', 18),
(9, 'Ligue 1', 2, 'imagenes/klipartz.com.png.png', 20),
(10, 'Supercopa de Francia', 1, 'imagenes/super-francia.png.png', 20),
(11, 'League Cup', 1, 'imagenes/leaguescup-c.png.png', 22),
(12, 'Copa America', 1, 'imagenes/Copa_Atlansia_Trofeo.png.png', 19),
(13, 'Mundial sub 20 ', 1, 'imagenes/sub-20.png.png', 19),
(14, 'Juegos Olimpicos', 1, 'imagenes/pngwing.com.png.png', 19),
(15, 'Copa Mundial', 1, 'imagenes/Copa del mundo.png.png', 19),
(16, 'Finalissima', 1, 'imagenes/finalissima-c.png.png', 19),
(17, 'Champions League', 4, 'imagenes/champions-f.png.png', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `nombre_apellido` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `contrasena` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `nombre_apellido`, `username`, `contrasena`) VALUES
(4, 'Administrador', 'admin', 'admin'),
(5, 'user name', 'user', 'user'),
(7, 'user', 'user_2', 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `equipo_rival` varchar(50) DEFAULT NULL,
  `url_video` varchar(255) DEFAULT NULL,
  `equipo` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`id`, `titulo`, `equipo_rival`, `url_video`, `equipo`) VALUES
(35, 'Gol maradoneano a Getafe', 'Getafe', 'https://www.youtube.com/watch?v=i8TBwuN2zj4', 18),
(36, 'Gol a Real Madrid Semi-Final 20211', 'Real Madrid', 'https://www.youtube.com/watch?v=2pWt_vG9_Ug', 18),
(37, 'Picadita a Betis', 'Betis', 'https://www.youtube.com/watch?v=RhIcN8YlCi8', 18),
(38, 'Gol de tiro Liverpool UCL 2019', 'Liverpool', 'https://www.youtube.com/watch?v=BEENL2t1Qzs', 18),
(41, 'Mexico Qatar 2022', 'Mexico', 'https://www.youtube.com/watch?v=IcdWtp_YUFU', 19),
(42, 'Golazo de messi a Brasil (Amistoso)', 'Brasil', 'https://www.youtube.com/watch?v=upc7nDmLUBU', 19),
(43, 'Gol de messi a bosnia', 'Bosnia', 'https://www.youtube.com/watch?v=K4Xx3aNOh5g', 19),
(44, 'Eliminatorias 2014', 'Chile', 'https://www.youtube.com/watch?v=KUxfMWvwdLo', 19),
(45, 'Gol a Lille de tiro libre', 'Lille', 'https://www.youtube.com/watch?v=XQhg5NUQ6rU', 20),
(46, 'Gol a marsella', 'Marsella', 'https://www.youtube.com/watch?v=htrK6pHCdFs', 20),
(47, 'Gol al city por Champions', 'Manchester City', 'https://www.youtube.com/watch?v=B0GMRKPmCBE', 20),
(51, 'Gol Nashville CONCACAF', 'Nashville', 'https://www.youtube.com/watch?v=e5qdExHo4Ao', 22);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipos`);

--
-- Indices de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `palmares`
--
ALTER TABLE `palmares`
  ADD PRIMARY KEY (`id_palmares`),
  ADD KEY `id_equipos` (`id_equipos`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_equipo` (`equipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `palmares`
--
ALTER TABLE `palmares`
  MODIFY `id_palmares` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `palmares`
--
ALTER TABLE `palmares`
  ADD CONSTRAINT `palmares_ibfk_1` FOREIGN KEY (`id_equipos`) REFERENCES `equipos` (`id_equipos`);

--
-- Filtros para la tabla `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `fk_equipo` FOREIGN KEY (`equipo`) REFERENCES `equipos` (`id_equipos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
