-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-09-2023 a las 23:38:00
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `expenseman`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `budget`
--

CREATE TABLE `budget` (
  `ID` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Budget` decimal(25,2) NOT NULL,
  `RDATE` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `budget`
--

INSERT INTO `budget` (`ID`, `UserId`, `Budget`, `RDATE`) VALUES
(4, 3, '2069.00', '2023-09-08 18:33:45'),
(5, 4, '2070.00', '2023-09-08 19:20:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contributions`
--

CREATE TABLE `contributions` (
  `ContributionId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Amount` decimal(25,2) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expense`
--

CREATE TABLE `expense` (
  `UserId` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `Item` varchar(255) NOT NULL,
  `Cost` decimal(25,2) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `expense`
--

INSERT INTO `expense` (`UserId`, `ID`, `Item`, `Cost`, `Date`) VALUES
(4, 7, 'Compras Instacart', '100.00', '2023-08-01 21:31:00'),
(4, 8, 'RIB Fest', '20.00', '2023-08-01 21:32:00'),
(4, 9, 'Pago Luz', '53.34', '2023-08-01 21:33:00'),
(4, 10, 'Compras Dollarama ', '45.25', '2023-08-01 21:33:00'),
(4, 11, 'Pago Internet', '55.86', '2023-08-01 21:33:00'),
(4, 12, 'Pago Arriendo', '1375.00', '2023-08-01 21:34:00'),
(4, 13, 'Compras Instacart', '118.30', '2023-08-19 21:34:00'),
(4, 14, 'Comida Leonidas', '46.32', '2023-08-17 21:34:00'),
(4, 15, 'Mias Cousine', '30.00', '2023-08-25 21:35:00'),
(4, 16, 'Compras Real Canadian', '159.54', '2023-08-29 21:35:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `Full_Name` varchar(40) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`Full_Name`, `Email`, `Username`, `UserId`, `Password`, `Photo`, `RegDate`) VALUES
('Moshe Yosev Brito del Pino', 'lhackersito@gmail.com', 'Admin', 3, '42750187c3abf148af23b916411dec35', '../static/images/userlogo.png', '2023-09-09 00:19:46'),
('Marivel Cristina Bravo Castillo', 'maryb4507@gmail.com', 'Mary', 4, '42750187c3abf148af23b916411dec35', '../static/images/userlogo.png', '2023-09-09 01:19:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`ContributionId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indices de la tabla `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `budget`
--
ALTER TABLE `budget`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `contributions`
--
ALTER TABLE `contributions`
  MODIFY `ContributionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `expense`
--
ALTER TABLE `expense`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contributions`
--
ALTER TABLE `contributions`
  ADD CONSTRAINT `contributions_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
