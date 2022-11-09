-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2022 a las 20:04:56
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_holidays`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boat`
--

CREATE TABLE `boat` (
  `boat_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `capacity` int(11) NOT NULL,
  `model` varchar(30) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `boat`
--

INSERT INTO `boat` (`boat_id`, `name`, `capacity`, `model`, `image`) VALUES
(25, 'Ocean', 12, 'Lagoon 230', 'boat1.jpg'),
(34, 'Sea Paradaise', 10, 'Triton 58', 'boat2.jpg'),
(35, 'Second Wind', 8, 'H20', 'boat3.jpg'),
(38, 'Dream Weaver', 9, 'Plenamar 30', 'boat4.jpg'),
(39, 'Deep Blue', 12, 'Lagoo 230', 'boat5.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experience`
--

CREATE TABLE `experience` (
  `exp_id` int(11) NOT NULL,
  `place` varchar(30) NOT NULL,
  `days` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `boat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `experience`
--

INSERT INTO `experience` (`exp_id`, `place`, `days`, `price`, `description`, `boat_id`) VALUES
(52, 'Maldives', 15, 900, 'Book Your Next Surf Trip from our Range of Hand Picked Maldives Surf Resorts and Charters. Awave Travel has the Best Selection of Surf Resorts and Charters in the Maldives.', 25),
(61, 'Argentina', 16, 500, 'Enjoy and adventure of incredible days!!  Lots of activities, bar service, celebrations, entertainment, gaiming, kids programs, sports in land', 25),
(62, 'Salomon Island', 10, 970, 'Lots of activities, bar service, celebrations, entertainment, gaiming, kids programs, sports in land', 38),
(65, 'Florianopolis', 10, 850, 'Best price guarantee! Book soon for biggest savings!', 35),
(67, 'Canaries', 18, 950, 'Procida, Napoli, Capri, Ischia, Amalfi, Positano. A wonderful Holiday on a sailboat in the most beautiful bays of the Mediterranean.', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pss` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `email`, `pss`) VALUES
(1, 'admin@admin.com', '$2a$12$2kk62kuAN5X35y8gKOt5VO4GCO50R7xhZRnV45coXZnVE/VUuQNv6');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boat`
--
ALTER TABLE `boat`
  ADD PRIMARY KEY (`boat_id`);

--
-- Indices de la tabla `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`exp_id`),
  ADD KEY `FK_boat_id` (`boat_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boat`
--
ALTER TABLE `boat`
  MODIFY `boat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `experience`
--
ALTER TABLE `experience`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`boat_id`) REFERENCES `boat` (`boat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
