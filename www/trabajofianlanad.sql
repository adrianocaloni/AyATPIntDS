-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2021 a las 18:40:29
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trabajofianlanad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biblioteca`
--

CREATE TABLE `biblioteca` (
  `ID_Libro` int(10) NOT NULL,
  `Titulo` varchar(500) NOT NULL,
  `Genero` varchar(500) NOT NULL,
  `Stock` int(10) NOT NULL,
  `id_Usuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `biblioteca`
--

INSERT INTO `biblioteca` (`ID_Libro`, `Titulo`, `Genero`, `Stock`, `id_Usuario`) VALUES
(12, 'Acciòn', 'Thanos: The Infinity Relativity', 15, 1),
(13, 'Acctòn', 'Battle Against Ultron (Marvel Avengers)', 5, 1),
(14, 'Acciòn', 'Batman: Silencio', 8, 1),
(15, 'Acciòn', 'Superman: Legado', 3, 1),
(17, 'Acciòn', 'Extremis', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `nombre`, `apellido`) VALUES
(1, 'Adriano', '$2y$10$0zuTRFrMKVGbW0LLKEFfRO.nYY0kWUAt66dFzkW0qP.Lnp2y7xKYq', 'Adriano Jeremias', 'Caloni'),
(2, 'Antonella', '$2y$10$6VrKXbf5jIS.BihYMkBM.uc49jYXddieRufmqC96O5FL4oWiy3ckS', 'Antonella', 'Almeida');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD PRIMARY KEY (`ID_Libro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  MODIFY `ID_Libro` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
