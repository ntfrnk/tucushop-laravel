-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-04-2020 a las 13:13:17
-- Versión del servidor: 5.7.29
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tucushop_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_alerts`
--

CREATE TABLE `pow_alerts` (
  `Id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `storeID` int(11) NOT NULL,
  `message` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `readed` int(1) NOT NULL,
  `checked` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_alerts`
--

INSERT INTO `pow_alerts` (`Id`, `userID`, `storeID`, `message`, `tipo`, `readed`, `checked`) VALUES
(1, 0, 20, '<strong>¡Felicidades!</strong> Tu pago se acreditó correctamente y ya puedes disfrutar de los beneficios del plan que elegiste.', 'success', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_areas`
--

CREATE TABLE `pow_areas` (
  `Id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `public` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_areas`
--

INSERT INTO `pow_areas` (`Id`, `name`, `public`) VALUES
(1, 'San Miguel de Tucumán', 1),
(2, 'Banda del Río Salí / Alderetes', 1),
(3, 'Yerba Buena / San Pablo / Lules', 1),
(4, 'Las Talitas / Lomas de Tafí / Tafí Viejo', 1),
(5, 'Concepción / Aguilares', 1),
(6, 'Monteros / Famaillá', 1),
(7, 'Alberdi / La Cocha', 1),
(8, 'Bella Vista / Leales', 1),
(9, 'Tafí del Valle / El Mollar', 1),
(10, 'Trancas / Vipos / Choromoro / B. Paz', 1),
(11, 'Los Ralos / Florida / D. Gallo / Ranchillos', 1),
(12, 'El Chañar / El Naranjo', 1),
(13, 'La Ramada / El Rodeo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_categorias`
--

CREATE TABLE `pow_categorias` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `publicado` int(1) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_categorias`
--

INSERT INTO `pow_categorias` (`Id`, `nombre`, `descripcion`, `created`, `modified`, `publicado`, `userID`) VALUES
(1, 'Contenidos estáticos', '', '2016-10-17 14:07:33', '2016-10-17 16:07:33', 1, 1),
(2, 'Blog', '', '2018-05-12 14:33:08', '2018-05-12 17:33:08', 1, 1),
(3, 'Información y Ayuda', 'Bienvenido al centro de información y ayuda de «TUCUMODA.com». A continuación, por favor selecciona la temática de la información que buscas.', '2019-01-02 21:45:20', '2019-01-02 23:45:32', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_denuncias`
--

CREATE TABLE `pow_denuncias` (
  `Id` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `reason` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `sent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_denuncias`
--

INSERT INTO `pow_denuncias` (`Id`, `itemID`, `userID`, `reason`, `detail`, `sent`) VALUES
(12, 1, 9, 'Otra razón', 'El vendedor no contesta.', '2019-04-29 11:24:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_front_users`
--

CREATE TABLE `pow_front_users` (
  `Id` int(11) NOT NULL,
  `facebookID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_front_users`
--

INSERT INTO `pow_front_users` (`Id`, `facebookID`, `user`, `pass`, `email`, `created`, `active`) VALUES
(9, '', 'Netfrank', 'f1e5c64fca3e3217702be0837b2b64ec', 'netfrank777@gmail.com', '2018-05-19 14:34:01', 1),
(12, '', 'martita', 'd959caadac9b13dcb3e609440135cf54', 'mmartaocaranza@hotmail.com', '2018-05-20 01:02:16', 1),
(14, '', 'Anahi7', 'a74298e4a259759687e3a5acb2e7ae12', 'antetugracia@gmail.com', '2018-06-21 13:07:17', 1),
(15, '', 'tommyoca', 'f1e5c64fca3e3217702be0837b2b64ec', 'tommy.oca@gmail.com', '2018-06-21 15:58:38', 1),
(17, '', 'marmota', 'f1e5c64fca3e3217702be0837b2b64ec', 'marmo@gmail.com', '2018-11-07 21:57:35', 1),
(18, '', 'veroaragon', 'f1e5c64fca3e3217702be0837b2b64ec', 'veroaragon@hotmail.com', '2019-01-02 02:24:24', 1),
(19, '', 'fdocaranza', 'f1e5c64fca3e3217702be0837b2b64ec', 'franco@fdocaranza.org', '2019-01-02 22:02:04', 1),
(20, '', 'otheruser', '9dbb300e28bc21c8dab41b01883918eb', 'usuario@servidor.com', '2019-01-02 23:57:05', 1),
(21, '', 'marymunilla', 'f1e5c64fca3e3217702be0837b2b64ec', 'marymunilla@hotmail.com', '2019-01-06 20:40:50', 1),
(22, '', 'armando', 'f1e5c64fca3e3217702be0837b2b64ec', 'armando@fdocaranza.org', '2019-01-08 12:29:26', 1),
(23, '', 'demodemo', '0f93fb746da07e9b217a88567679c277', 'demo@demodemo.com', '2019-03-15 23:08:37', 1),
(24, '', 'PaulaCarrizo', 'e71d8121c982eea841f5d4566fcac783', 'carrizo_paula@hotmail.com', '2019-04-20 18:50:41', 1),
(25, '', 'Netfranco', 'f1e5c64fca3e3217702be0837b2b64ec', 'netfranco@hotmail.com', '2019-04-20 18:59:58', 1),
(26, '', 'CiaraTeffy', 'f1e5c64fca3e3217702be0837b2b64ec', 'ciarateffy@fdocaranza.org', '2019-04-24 10:41:47', 1),
(27, '', 'chocolatada', 'f1e5c64fca3e3217702be0837b2b64ec', 'juliamariapjuarez@gmail.com', '2019-09-29 08:38:13', 1),
(28, '', 'teffyoca', 'f1e5c64fca3e3217702be0837b2b64ec', 'teffyoca@gmail.com', '2019-10-09 15:01:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_front_users_addresses`
--

CREATE TABLE `pow_front_users_addresses` (
  `userID` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `dni` int(8) NOT NULL,
  `address` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `areaID` int(11) NOT NULL,
  `postalcode` int(5) NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `cellphone` varchar(14) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_front_users_addresses`
--

INSERT INTO `pow_front_users_addresses` (`userID`, `name`, `lastname`, `dni`, `address`, `areaID`, `postalcode`, `phone`, `cellphone`) VALUES
(9, '', '', 0, '', 1, 0, '', ''),
(12, '', '', 0, '', 0, 0, '', ''),
(14, '', '', 0, '', 0, 0, '', ''),
(15, '', '', 0, '', 0, 0, '', ''),
(17, '', '', 0, '', 0, 0, '', ''),
(18, '', '', 0, '', 0, 0, '', ''),
(19, '', '', 0, '', 0, 0, '', ''),
(20, '', '', 0, '', 0, 0, '', ''),
(21, '', '', 0, '', 0, 0, '', ''),
(22, '', '', 0, '', 0, 0, '', ''),
(23, '', '', 0, '', 0, 0, '', ''),
(25, '', '', 0, '', 0, 0, '', ''),
(24, '', '', 0, '', 0, 0, '', ''),
(26, '', '', 0, '', 0, 0, '', ''),
(27, '', '', 0, '', 0, 0, '', ''),
(28, '', '', 0, '', 0, 0, '', ''),
(28, '', '', 0, '', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_front_users_preferences`
--

CREATE TABLE `pow_front_users_preferences` (
  `Id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `keyword` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_front_users_preferences`
--

INSERT INTO `pow_front_users_preferences` (`Id`, `userID`, `keyword`) VALUES
(5, 0, 'botas'),
(6, 0, 'pollera'),
(7, 0, 'rosa'),
(8, 0, 'vintage'),
(9, 0, 'blusa'),
(10, 0, 'perfumes'),
(18, 0, 'camisa'),
(19, 0, 'zapatilla'),
(20, 0, 'jean'),
(21, 0, 'pantalon'),
(22, 0, 'saco'),
(23, 0, 'traje'),
(24, 0, 'remera'),
(26, 0, 'chomba'),
(27, 0, 'zapato'),
(28, 0, 'medias'),
(32, 0, 'corbata'),
(33, 0, 'chaleco'),
(34, 0, 'campera'),
(35, 0, 'buzo'),
(42, 0, 'frio'),
(44, 0, 'calor'),
(45, 0, 'tarde'),
(46, 0, 'noche'),
(47, 0, 'vestido'),
(48, 0, 'capelina'),
(49, 0, 'sandalias'),
(51, 0, 'torerita'),
(52, 0, 'torera'),
(53, 0, 'calza'),
(54, 0, 'peluquería'),
(55, 0, 'coifeur'),
(56, 0, 'zapateria'),
(57, 0, 'pedicura'),
(58, 0, 'manicura'),
(59, 0, 'spa'),
(60, 0, 'gym'),
(61, 0, 'gimnasio'),
(62, 0, 'zumba'),
(63, 0, 'uñas'),
(64, 0, 'makeup'),
(65, 0, 'maquillaje'),
(66, 0, 'peinados'),
(67, 0, 'peinado'),
(68, 0, 'masajes'),
(69, 0, 'masajista'),
(70, 0, 'collar'),
(71, 0, 'anillo'),
(72, 0, 'pulsera'),
(73, 0, 'muñequera'),
(74, 0, 'pañuelo'),
(75, 0, 'chal'),
(76, 0, 'rubor'),
(77, 0, 'rimmel'),
(78, 0, 'rimel'),
(79, 0, 'labial'),
(80, 0, 'crema'),
(81, 0, 'manicure'),
(82, 0, 'pedicure'),
(83, 0, 'depilacion'),
(84, 0, 'depiladora'),
(85, 0, 'planchita'),
(86, 0, 'buclera'),
(87, 0, 'secador'),
(111, 9, 'jean'),
(112, 9, 'pantalon'),
(113, 9, 'remera'),
(117, 23, 'sandalias'),
(118, 23, 'calza'),
(119, 23, 'jean'),
(120, 23, 'makeup'),
(121, 23, 'maquillaje'),
(122, 9, 'zapato'),
(123, 9, 'Corbata'),
(124, 9, 'saco'),
(125, 21, 'perfumes'),
(126, 21, 'jean'),
(128, 21, 'torerita'),
(129, 24, 'Carteras'),
(130, 24, 'zapato'),
(131, 24, 'campera'),
(132, 24, 'Chalecos'),
(133, 9, 'Ambo'),
(134, 26, 'peinados'),
(135, 26, 'depilacion'),
(136, 26, 'makeup'),
(137, 26, 'jean'),
(138, 26, 'peluquería'),
(139, 26, 'perfumes'),
(140, 26, 'vestido'),
(141, 26, 'Zapatos'),
(142, 9, 'traje'),
(143, 9, 'zapatilla'),
(144, 27, 'zapatilla'),
(145, 27, 'botas'),
(146, 27, 'zapato'),
(147, 27, 'zapateria'),
(148, 27, 'sandalias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_front_users_profile`
--

CREATE TABLE `pow_front_users_profile` (
  `userID` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `dni` int(8) NOT NULL,
  `birthday` date NOT NULL,
  `genre` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `areaID` int(11) NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `cellphone` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_front_users_profile`
--

INSERT INTO `pow_front_users_profile` (`userID`, `name`, `lastname`, `dni`, `birthday`, `genre`, `address`, `areaID`, `phone`, `cellphone`, `photo`) VALUES
(9, 'Franco D.', 'Ocaranza', 31842369, '1985-12-04', 'male', 'Bº SOEME M.7 C.27', 4, '', '+5493816307673', '0000009_1564544743.jpg'),
(12, 'Maria Marta ', 'Carrizo', 12869126, '1957-03-12', 'female', 'BºSOEME- MZA. 7 CASA 27', 55, '', '3814023966', ''),
(14, 'Anahi', 'ocaranza', 34192036, '1991-06-14', 'female', 'soeme manzana 7 casa 27', 55, '', '3814023966', ''),
(15, 'Tomás Daniel', 'Ocaranza', 52225228, '2019-02-23', 'male', 'Bº Lomas de Tafí - Zona 17 - Manzana 2 -', 101, '', '--', '0000015_1568053627.jpg'),
(17, 'Paula', 'Carrizo', 37555441, '1990-06-16', 'female', 'San Martín 221', 71, '', '+5493863562365', '0000017_1548763325.jpg'),
(18, 'Verónica', 'Aragón', 31842369, '1991-03-03', 'female', 'Vero y Aragón 223', 86, '', '3516656583', ''),
(19, 'Franco Daniel', 'Ocaranza', 31842369, '1985-12-04', 'male', 'SOEME 7 27', 55, '', '+5493815652833', ''),
(20, 'Usuario', 'Ejemplo', 11111111, '2000-01-01', 'female', 'Av. Siempre Viva 222', 86, '', '+549381111111', ''),
(21, 'María Alcira', 'Aguirre', 33399826, '1987-09-21', 'female', 'Bº AMP. ELENA WHITE', 86, '', '3813524950', '0000021_1555637179.jpg'),
(22, 'José Armando', 'Ocaranza', 11254256, '1954-05-05', 'male', 'Bº SOEME M7 C27', 7, '', '+5493815465542', ''),
(23, 'Demodemo', 'Demo', 11111111, '2000-01-01', 'male', 'Demo demo 123', 86, '', '+5493815111111', ''),
(25, 'Franco', 'Ocaranza', 0, '0000-00-00', 'male', '', 55, '', '', ''),
(24, 'Paula', 'Carrizo', 0, '0000-00-00', 'female', '', 71, '', '', '0000024_1555798717.jpg'),
(26, 'Ciara Stefanía', 'Ocaranza', 42858357, '2004-08-22', 'female', '', 101, '', '', '0000026_1556113606.jpg'),
(27, 'Julia', 'Juarez', 34201151, '1986-06-30', 'female', 'Pje. O\'Higgins 951', 1, '', '3815168351', '0000027_1569757469.jpg'),
(28, 'Ciara Stefanía', 'Ocaranza', 53005271, '2005-08-18', 'female', '', 4, '', '', '0000028_1570645012.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_front_users_regalos`
--

CREATE TABLE `pow_front_users_regalos` (
  `Id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `regaloID` int(11) NOT NULL,
  `used` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_front_users_regalos`
--

INSERT INTO `pow_front_users_regalos` (`Id`, `userID`, `regaloID`, `used`) VALUES
(1, 27, 1, 1),
(2, 28, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_front_users_searches`
--

CREATE TABLE `pow_front_users_searches` (
  `Id` int(11) NOT NULL,
  `keyword` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_front_users_searches`
--

INSERT INTO `pow_front_users_searches` (`Id`, `keyword`, `userID`, `datetime`) VALUES
(199, 'hombre', 15, '2019-09-09 18:28:33'),
(209, 'calzados', 27, '2019-10-04 01:23:46'),
(210, 'zapa', 27, '2019-10-04 01:24:03'),
(211, 'calzado', 27, '2019-10-04 05:27:11'),
(212, 'cabello', 28, '2019-10-09 21:02:21'),
(213, 'peinado', 28, '2019-10-09 21:10:02'),
(214, 'acondicionador', 28, '2019-10-10 03:49:50'),
(215, 'vestido', 27, '2019-11-04 02:09:40'),
(216, 'vestido', 9, '2019-11-10 05:19:33'),
(217, 'vestido-rosa', 9, '2019-11-10 05:19:50'),
(218, 'camisa', 9, '2019-11-10 05:26:48'),
(219, 'zapatilla', 9, '2019-11-11 06:59:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_front_users_wishlist`
--

CREATE TABLE `pow_front_users_wishlist` (
  `Id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `storeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_front_users_wishlist`
--

INSERT INTO `pow_front_users_wishlist` (`Id`, `userID`, `itemID`, `storeID`) VALUES
(58, 23, 1, 5),
(59, 23, 2, 5),
(60, 23, 13, 5),
(61, 23, 7, 6),
(62, 23, 16, 8),
(63, 23, 8, 6),
(65, 9, 1, 5),
(71, 9, 2, 5),
(72, 26, 2, 5),
(73, 26, 4, 1),
(74, 26, 1, 5),
(75, 26, 20, 12),
(76, 26, 16, 8),
(77, 26, 3, 6),
(81, 26, 6, 6),
(92, 9, 18, 0),
(93, 9, 13, 0),
(95, 9, 29, 0),
(96, 9, 7, 0),
(97, 9, 36, 0),
(99, 15, 11, 0),
(100, 15, 24, 0),
(101, 15, 27, 0),
(102, 15, 35, 0),
(106, 27, 11, 0),
(109, 9, 42, 0),
(111, 9, 46, 0),
(114, 9, 49, 0),
(116, 27, 14, 0),
(118, 27, 50, 0),
(163, 27, 44, 0),
(164, 27, 40, 0),
(165, 27, 45, 0),
(167, 27, 39, 0),
(168, 27, 35, 0),
(175, 27, 27, 0),
(179, 27, 29, 0),
(182, 27, 5, 0),
(183, 27, 1, 0),
(184, 27, 7, 0),
(186, 9, 44, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_localidades`
--

CREATE TABLE `pow_localidades` (
  `Id` int(11) NOT NULL,
  `provinciaID` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_localidades`
--

INSERT INTO `pow_localidades` (`Id`, `provinciaID`, `nombre`) VALUES
(1, 24, 'Acheral'),
(2, 24, 'Agua Dulce y La Soledad'),
(3, 24, 'Aguilares'),
(4, 24, 'Alderetes'),
(5, 24, 'Alpachiri y El Molino'),
(6, 24, 'Alto Verde y Los Gucheas'),
(7, 24, 'Amaicha del Valle'),
(8, 24, 'Amberes'),
(9, 24, 'Anca Juli'),
(10, 24, 'Arcadia'),
(11, 24, 'Atahona'),
(12, 24, 'Banda del Río Salí'),
(13, 24, 'Bella Vista'),
(14, 24, 'Buena Vista'),
(15, 24, 'Burruyacú'),
(16, 24, 'Capitan Cáceres'),
(17, 24, 'Cevil Redondo'),
(18, 24, 'Choromoro'),
(19, 24, 'Ciudacita'),
(20, 24, 'Colalao del Valle'),
(21, 24, 'Colombres'),
(22, 24, 'Concepción'),
(23, 24, 'Delfín Gallo'),
(24, 24, 'El Bracho y El Cevilar'),
(25, 24, 'El Cadillal'),
(26, 24, 'El Cercado'),
(27, 24, 'El Chañar'),
(28, 24, 'El Manantial'),
(29, 24, 'El Mojón'),
(30, 24, 'El Mollar'),
(31, 24, 'El Naranjito'),
(32, 24, 'El Naranjo y El Sunchal'),
(33, 24, 'El Polear'),
(34, 24, 'El Puestito'),
(35, 24, 'El Sacrificio'),
(36, 24, 'El Timbó'),
(37, 24, 'Escaba'),
(38, 24, 'Esquina y Mancopa'),
(39, 24, 'Estación Araoz y Tacanas'),
(40, 24, 'Famaillá'),
(41, 24, 'Gastona y Belicha'),
(42, 24, 'Gobernador Garmendia'),
(43, 24, 'Gobernador Piedrabuena'),
(44, 24, 'Graneros'),
(45, 24, 'Huasa Pampa'),
(46, 24, 'Juan Bautista Alberdi'),
(47, 24, 'La Cocha'),
(48, 24, 'La Esperanza'),
(49, 24, 'La Florida y Luisiana'),
(50, 24, 'La Ramada y La Cruz'),
(51, 24, 'La Trinidad'),
(52, 24, 'Lamadrid'),
(53, 24, 'Las Cejas'),
(54, 24, 'Las Talas'),
(55, 24, 'Las Talitas'),
(56, 24, 'Los Bulacio y Los Villagra'),
(57, 24, 'Los Gómez'),
(58, 24, 'Los Nogales'),
(59, 24, 'Los Pereyras'),
(60, 24, 'Los Pérez'),
(61, 24, 'Los Puestos'),
(62, 24, 'Los Ralos'),
(63, 24, 'Los Sarmientos y La Tipa'),
(64, 24, 'Los Sosas'),
(65, 24, 'Lules'),
(66, 24, 'Manuel García Fernández'),
(67, 24, 'Manuela Pedraza'),
(68, 24, 'Medinas'),
(69, 24, 'Monte Bello'),
(70, 24, 'Monteagudo'),
(71, 24, 'Monteros'),
(72, 24, 'Padre Monti'),
(73, 24, 'Pampa Mayo'),
(74, 24, 'Quilmes y Los Sueldos'),
(75, 24, 'Raco'),
(76, 24, 'Ranchillos y San Miguel'),
(77, 24, 'Río Chico y Nueva Trinidad'),
(78, 24, 'Río Colorado'),
(79, 24, 'Río Seco'),
(80, 24, 'Rumi Punco'),
(81, 24, 'San Andrés'),
(82, 24, 'San Felipe y Santa Bárbara'),
(83, 24, 'San Ignacio'),
(84, 24, 'San Javier'),
(85, 24, 'San José de La Cocha'),
(86, 24, 'San Miguel de Tucumán'),
(87, 24, 'San Pablo y Villa Nougués'),
(88, 24, 'San Pedro de Colalao'),
(89, 24, 'San Pedro y San Antonio'),
(90, 24, 'Santa Ana'),
(91, 24, 'Santa Cruz y La Tuna'),
(92, 24, 'Santa Lucía'),
(93, 24, 'Santa Rosa de Leales'),
(94, 24, 'Santa Rosa y Los Rojo'),
(95, 24, 'Sargento Moya'),
(96, 24, 'Siete de Abril'),
(97, 24, 'Simoca'),
(98, 24, 'Soldado Maldonado'),
(99, 24, 'Taco Ralo'),
(100, 24, 'Tafí del Valle'),
(101, 24, 'Tafí Viejo'),
(102, 24, 'Tapia'),
(103, 24, 'Teniente Berdina'),
(104, 24, 'Trancas'),
(105, 24, 'Villa Belgrano'),
(106, 24, 'Villa Benjamín Araoz'),
(107, 24, 'Villa Chigligasta'),
(108, 24, 'Villa de Leales'),
(109, 24, 'Villa Quinteros'),
(110, 24, 'Yánima'),
(111, 24, 'Yerba Buena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_menu`
--

CREATE TABLE `pow_menu` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` text COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `orden` int(2) NOT NULL,
  `publicado` int(1) NOT NULL,
  `instalado` int(1) NOT NULL,
  `paginado` int(2) NOT NULL,
  `sortby` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_menu`
--

INSERT INTO `pow_menu` (`Id`, `nombre`, `label`, `detalle`, `icon`, `created`, `modified`, `orden`, `publicado`, `instalado`, `paginado`, `sortby`, `userID`) VALUES
(1, 'Portada', 'Portada', 'Módulo de administración de items en portada. Contenidos divididos por posiciones o secciones dentro del espacio principal del sitio web.', 'home', '2015-07-28 13:43:59', '2015-10-15 14:05:27', 10, 1, 0, 0, '', 1),
(2, 'Editorial', 'Gestión editorial', 'Módulo de gestión de notas, secciones y categorías. Herramientas de creación, edición y segmentación de contenidos.', 'edit', '2015-07-28 13:44:11', '2015-10-15 14:05:27', 30, 1, 0, 0, '', 1),
(8, 'Seguridad', 'Seguridad', 'Gestión completa de usuarios y administradores del sitio web, con rangos y permisos especiales.', 'lock', '2015-11-01 18:21:18', '2015-11-12 01:55:32', 70, 1, 0, 0, '', 1),
(4, 'Catalogo', 'Catálogo digital', 'Herramientas de administración de rubros, subrubros y productos con su respectivo gestor de contenidos multimedia.', 'star', '2015-09-08 21:31:33', '2015-10-15 14:05:27', 50, 1, 1, 0, '', 1),
(5, 'navegacion', 'Navegación', 'Este módulo permite administrar las opciones de navegación tanto del panel de control como del sitio web. ', 'th-list', '2015-09-10 12:19:58', '2015-10-15 14:05:27', 20, 1, 0, 0, '', 1),
(9, 'aplicaciones', 'Aplicaciones', '', 'star', '2017-12-28 16:54:38', '2017-12-28 18:57:30', 60, 1, 1, 20, 'Id,asc', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_newsletter_list`
--

CREATE TABLE `pow_newsletter_list` (
  `Id` int(11) NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_newsletter_list`
--

INSERT INTO `pow_newsletter_list` (`Id`, `email`, `activo`) VALUES
(4, 'contacto@fdocaranza.org', 1),
(5, 'franco@xtofactory.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_notas`
--

CREATE TABLE `pow_notas` (
  `Id` int(11) NOT NULL,
  `categoriaID` int(11) NOT NULL,
  `subcategoriaID` int(11) NOT NULL,
  `antetitulo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `bajada` text COLLATE utf8_unicode_ci NOT NULL,
  `texto` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comentarios` int(1) NOT NULL,
  `publicado` int(1) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_notas`
--

INSERT INTO `pow_notas` (`Id`, `categoriaID`, `subcategoriaID`, `antetitulo`, `titulo`, `bajada`, `texto`, `created`, `modified`, `comentarios`, `publicado`, `userID`) VALUES
(45, 3, 9, '', 'Guardar un producto en mi lista de deseos', '', '', '2019-01-02 22:41:50', '2019-01-03 00:41:54', 0, 1, 1),
(46, 3, 9, '', 'Ver información ampliada de un producto', '', '', '2019-01-02 22:42:34', '2019-01-03 00:42:34', 0, 1, 1),
(31, 3, 8, '', 'Ordenar las fotos de un producto', '', '', '2019-01-02 22:17:37', '2019-01-03 00:17:37', 0, 1, 1),
(32, 3, 8, '', 'Deshabilitar temporalmente un producto', '', '', '2019-01-02 22:17:58', '2019-01-03 00:17:58', 0, 1, 1),
(33, 3, 8, '', 'Eliminar definitivamente un producto', '', '', '2019-01-02 22:18:13', '2019-01-03 00:18:13', 0, 1, 1),
(34, 3, 8, '', 'Agregar administradores a mi negocio', '', '', '2019-01-02 22:18:43', '2019-01-03 00:18:43', 0, 1, 1),
(35, 3, 8, '', 'Habilitar / Deshabilitar un administrador', '', '', '2019-01-02 22:19:36', '2019-01-03 00:19:36', 0, 1, 1),
(36, 3, 8, '', 'Asignar funciones a un administrador', '', '', '2019-01-02 22:20:09', '2019-01-03 00:20:09', 0, 1, 0),
(37, 3, 8, '', 'Eliminar un administrador de mi negocio', '', '', '2019-01-02 22:20:27', '2019-01-03 00:20:27', 0, 1, 1),
(38, 3, 8, '', 'Deshabilitar / Habilitar alguno de mis negocios', '', '', '2019-01-02 22:21:32', '2019-01-03 00:21:32', 0, 1, 1),
(39, 3, 8, '', 'Eliminar definitivamente un negocio', '', '', '2019-01-02 22:21:53', '2019-01-03 00:21:53', 0, 1, 1),
(40, 3, 10, '', 'Mantener la sesión en mi dispositivo', '', '', '2019-01-02 22:22:21', '2019-03-10 22:05:13', 0, 0, 1),
(41, 3, 11, '', 'Ingresar al sistema de puntos y premios', '', '', '2019-01-02 22:23:00', '2019-01-03 00:23:00', 0, 1, 1),
(42, 3, 12, '', 'Políticas de privacidad', '', '', '2019-01-02 22:24:16', '2019-01-03 00:24:16', 0, 1, 1),
(43, 3, 12, '', 'Términos y condiciones de esta página', '', '', '2019-01-02 22:25:13', '2019-01-03 00:25:13', 0, 1, 1),
(44, 3, 9, '', 'Realizar una consulta sobre un producto', '', '', '2019-01-02 22:41:31', '2019-01-03 00:41:31', 0, 1, 1),
(6, 3, 10, '', 'Recuperar la contraseña de mi cuenta', 'contraseña password recuperar cuenta olvidé olvido recuerdo recordar', '<p>El proceso de recuperaci&oacute;n de contrase&ntilde;a es sencillo, pero a la vez est&aacute; dise&ntilde;ado para mantener la seguridad de tu cuenta protegiendo tus datos. Para acceder a &eacute;l tienes que ir a la opci&oacute;n &quot;Ingresar&quot;, en la esquina superior derecha de tu pantalla (<a href=\"upload/images/crop-md/3d72ff4f0c7ed03644f71cbb701fd563.jpg\">Ver figura #1</a>).</p>\r\n\r\n<p>A continuaci&oacute;n, en la pantalla de inicio de sesi&oacute;n, deber&aacute;s hacer click en la opci&oacute;n &quot;<em>&iquest;Olvidaste tu contrase&ntilde;a?</em>&quot; que se encuentra debajo del bot&oacute;n de acceso (<a href=\"upload/images/crop-md/2b3f50996ef74f73cff2e0e04a15d51e.jpg\">Ver figura #2</a>).</p>\r\n\r\n<p>Ya en este paso deber&aacute;s proporcionar la direcci&oacute;n de correo electr&oacute;nico con la que te registraste en el sitio web, de manera que el sistema pueda enviarte un e-mail con un c&oacute;digo de recuperaci&oacute;n (<a href=\"upload/images/crop-md/99d4264c76cdd196e30d20f0fca5fdda.jpg\">Ver figura #3</a>).</p>\r\n\r\n<p>(El correo que te enviaremos tiene una apariencia similar a la captura que te indicamos en la <a href=\"upload/images/crop-md/06ef6f67df2bdcaf03d1aaae2fb785d0.jpg\">figura #4</a>)</p>\r\n\r\n<p>El siguiente paso consiste en copiar el c&oacute;digo que te enviamos por correo, pegarlo en el formulario que te lo solicita (<a href=\"upload/images/crop-md/c08faa8f9d1300d883196abe7c91d1f4.jpg\">Ver figura #5</a>), y hacer click en el bot&oacute;n &quot;recuperar&quot;.</p>\r\n\r\n<p>Finalmente, el sistema te pedir&aacute; ingresar una nueva contrase&ntilde;a (<a href=\"upload/images/crop-md/2fb7426c0727c198e1a57aafeda8025d.jpg\">Ver figura #6</a>), y luego de haberlo hecho podr&aacute;s ingresar con la nueva clave configurada (<a href=\"upload/images/crop-md/9f49092e765d002270b7df2d39e05937.jpg\">Ver figura #7</a>).</p>\r\n', '2019-01-02 21:51:59', '2019-03-20 04:55:18', 0, 1, 1),
(7, 3, 10, '', 'Olvidé mi nombre de usuario', 'usuario user olvide olvido recuperar recordar recuerdo conocer', '', '2019-01-02 21:52:36', '2019-03-16 22:21:28', 0, 0, 1),
(8, 3, 10, '', 'No puedo iniciar sesión', 'olvide error olvido recordar recuerdo contraseña usuario password user email mail correo entrar ingresar iniciar sesion', '<p>La imposibilidad de iniciar sesi&oacute;n (<a href=\"upload/images/crop-md/94248ecb1d26e8ebd36c7a90335e0a1f.jpg\">Ver figura #1</a>) puede deberse a dos causas probables.</p>\r\n\r\n<ol>\r\n	<li>Que el nombre de usuario sea incorrecto o est&eacute; mal escrito.</li>\r\n	<li>Que la contrase&ntilde;a sea incorrecta o est&eacute; mal escrita.</li>\r\n</ol>\r\n\r\n<p>En cualquiera de estos dos casos, s&oacute;lamente deber&aacute;s revisar la ortograf&iacute;a de los datos ingresados, y tener en cuenta de que el sistema reconoce la diferencia entre may&uacute;sculas y min&uacute;sculas, por lo que tambi&eacute;n ser&aacute; necesario que prestes atenci&oacute;n a este detalle no menor.</p>\r\n\r\n<p>En el caso de haber olvidado la contrase&ntilde;a, te recomendamos el siguiente art&iacute;culo relacionado a este inconveniente.</p>\r\n\r\n<blockquote>\r\n<p><a href=\"help/recuperar-la-contrasea-de-mi-cuenta_0006/\">Recuperar la contrase&ntilde;a de mi cuenta</a></p>\r\n</blockquote>\r\n', '2019-01-02 21:53:38', '2019-03-20 01:52:04', 0, 1, 1),
(9, 3, 10, '', 'No recuerdo mis datos de acceso', 'datos acceso ingresar iniciar sesion acceder entrar usuario contraseña user password mail email correo', '', '2019-01-02 21:53:57', '2019-01-03 21:56:59', 0, 1, 1),
(10, 3, 10, '', 'No me llega el correo de recuperación de datos', 'correo email mail recuperar recuperacion contraseña usuario user password olvide olvido', '<p>El sistema de recuperaci&oacute;n de contrase&ntilde;a es autom&aacute;tico y trabaja directamente con el correo electr&oacute;nico brindado por el usuario al momento del registro, salvo que hubiese sido modificado posteriormente, en cuyo caso lo har&aacute; con la &uacute;ltima direcci&oacute;n de correo electr&oacute;nico especificada.</p>\r\n\r\n<p>Cuando el usuario olvida su contrase&ntilde;a, el sistema est&aacute; preparado para asistirlo en la recuperaci&oacute;n de su acceso a la cuenta enviando via e-mail un c&oacute;digo de seguridad, que el usuario deber&aacute; ingresar cuando el sistema se lo solicite.</p>\r\n', '2019-01-02 21:54:41', '2019-03-10 22:13:31', 0, 1, 1),
(11, 3, 10, '', 'No puedo registrarme correctamente', '', '', '2019-01-02 22:02:48', '2019-03-20 16:47:34', 0, 1, 1),
(12, 3, 7, '', 'Quiero cambiar mi contraseña', '', '', '2019-01-02 22:05:05', '2019-01-03 00:05:05', 0, 1, 1),
(13, 3, 7, '', 'Quiero modificar mis datos personales', '', '', '2019-01-02 22:05:24', '2019-01-03 21:48:27', 0, 1, 1),
(14, 3, 7, '', '¿Para qué sirven los datos de envío?', '', '', '2019-01-02 22:05:59', '2019-01-03 00:05:59', 0, 1, 1),
(15, 3, 7, '', 'Quiero modificar mis datos de envío', '', '', '2019-01-02 22:06:15', '2019-01-03 21:48:39', 0, 1, 1),
(16, 3, 7, '', '¿Dónde busco los productos que voy guardando?', '', '', '2019-01-02 22:06:54', '2019-01-03 00:06:54', 0, 1, 1),
(17, 3, 7, '', 'Uno de los productos que guardé ya no aparece en mi lista', '', '', '2019-01-02 22:08:08', '2019-01-03 00:08:08', 0, 1, 1),
(18, 3, 7, '', 'Eliminar un producto de mi lista de deseos', '', '', '2019-01-02 22:08:40', '2019-01-03 00:08:40', 0, 1, 1),
(19, 3, 7, '', '¿Cómo puedo personalizar mi portada?', '', '', '2019-01-02 22:10:20', '2019-01-03 00:10:20', 0, 1, 1),
(20, 3, 8, '', 'Comenzar a gestionar un negocio', '', '', '2019-01-02 22:10:45', '2019-01-03 00:10:45', 0, 1, 1),
(21, 3, 8, '', 'Cargar o modificar los datos de mi negocio', '', '', '2019-01-02 22:11:32', '2019-01-03 00:11:32', 0, 1, 0),
(22, 3, 8, '', 'No funciona el token que me enviaron', '', '<p>Cuando un usuario te env&iacute;a un token, lo que est&aacute; haciendo es invitarte a ser parte de su negocio, colaborando en su administraci&oacute;n.</p>\r\n\r\n<p>Si no sabes c&oacute;mo utilizarlo, te sugerimos revisar la siguiente informaci&oacute;n:</p>\r\n\r\n<blockquote>\r\n<ul>\r\n	<li><a href=\"help/me-enviaron-un-token-que-debo-hacer_0024/\">Me enviaron un token: &iquest;Qu&eacute; debo hacer?</a></li>\r\n</ul>\r\n</blockquote>\r\n\r\n<p>Si realizaste todos los pasos indicados por el art&iacute;culo que te recomendamos, y a&uacute;n as&iacute; no puedes acceder a la administraci&oacute;n del negocio, puedes tener en cuenta la informaci&oacute;n siguiente.</p>\r\n\r\n<p>Existen tres razones por las que no est&aacute;s pudiendo utilizar tu token para administrar un negocio:</p>\r\n\r\n<h3>1. El token ya fue utilizado previamente.</h3>\r\n\r\n<p>Lo que puede ocurrir en este caso es que est&eacute;s intentando utilizar un token de un negocio que ya est&aacute;s administrando. En alg&uacute;n momento te lo enviaron, accediste a la administraci&oacute;n de ese negocio, y el sistema est&aacute; devolviendo un error como el siguiente:</p>\r\n\r\n<p>[img#bad19ec8cd8fc0f1022c9aefe4412735.jpg*]</p>\r\n', '2019-01-02 22:13:02', '2019-01-03 21:48:04', 0, 1, 1),
(23, 3, 8, '', 'Agregar un nuevo negocio', '', '', '2019-01-02 22:13:25', '2019-01-03 00:13:25', 0, 1, 1),
(24, 3, 8, '', 'Me enviaron un token: ¿Qué debo hacer?', '', '<p>El token es un c&oacute;digo &uacute;nico de identificaci&oacute;n que recibe cada negocio en &laquo;TUCU<strong>MODA</strong>.com&raquo;. Cuando un usuario te env&iacute;a este c&oacute;digo significa te invita a unirte a un negocio para colaborar en su administraci&oacute;n.</p>\r\n\r\n<p>Para utilizar un token debes dirigirte a <a href=\"store/token/\" target=\"_blank\">esta p&aacute;gina</a> (debes tener tu sesi&oacute;n iniciada), e ingresar el c&oacute;digo que recibiste, de la siguiente manera:</p>\r\n\r\n<p>[img#ebd4981994febd5efa61f35fc30d55e5.jpg*]</p>\r\n\r\n<p>Una vez ingresado y confirmado el token, el sistema le avisar&aacute; al due&ntilde;o del negocio para que habilite tu participaci&oacute;n. Mientras esto no ocurra seguir&aacute;s visualizando una pantalla que indica que a&uacute;n no tienes negocios para administrar, de la siguiente manera:</p>\r\n\r\n<p>[img#2b524274a804f5614ae430adcaab9d76.jpg*]</p>\r\n\r\n<p>Sin embargo, cuando el due&ntilde;o del negocio te habilite como administrador, comenzar&aacute;s a ver una pantalla en la que ya aparece el negocio agregado, de la siguiente forma:</p>\r\n\r\n<p>[img#6b7f72249a0aaa1f06b325424da019a7.jpg*]</p>\r\n\r\n<p>A partir de este momento podr&aacute;s acceder a la informaci&oacute;n que se te permita ver y modificar del negocio, seg&uacute;n los permisos asignados por el due&ntilde;o; y por cada negocio que administres aparecer&aacute; un nuevo cuadro en tu listado, siendo capaz de administrar m&uacute;ltiples negocios.</p>\r\n', '2019-01-02 22:14:23', '2019-01-03 22:23:57', 0, 1, 1),
(25, 3, 8, '', 'Cargar un nuevo producto', '', '', '2019-01-02 22:15:15', '2019-01-03 00:15:15', 0, 1, 1),
(26, 3, 8, '', 'Modificar la información de un producto', '', '', '2019-01-02 22:15:34', '2019-01-03 00:15:34', 0, 1, 1),
(27, 3, 8, '', 'Gestionar las fotos de un producto', '', '', '2019-01-02 22:16:11', '2019-01-03 00:16:11', 0, 1, 1),
(28, 3, 8, '', 'Subir una foto de producto', '', '', '2019-01-02 22:16:32', '2019-01-03 00:16:32', 0, 1, 1),
(29, 3, 8, '', 'Recortar las fotos de mis productos', '', '', '2019-01-02 22:16:53', '2019-01-03 00:16:53', 0, 1, 1),
(30, 3, 8, '', 'Eliminar las fotos de un producto', '', '', '2019-01-02 22:17:19', '2019-01-03 00:17:19', 0, 1, 1),
(47, 3, 12, '', '¿Por qué no encuentro mi tienda favorita?', '', '<p>Existen al menos cuatro motivos probables, por los que no est&aacute;s pudiendo acceder a la tienda que buscas. Dichas razones pueden ser las siguientes.</p>\r\n\r\n<h3>1. La cuenta cambi&oacute; de usuario</h3>\r\n\r\n<p>Todas las tiendas alojadas en Tucumoda.com tienen asignado un nombre de usuario y una direcci&oacute;n personalizada para acceder directamente a ella. Por ejemplo, si tuvi&eacute;ramos una tienda que se llame Flor de Liz, el nombre de usuario podr&iacute;a ser @flordeliz, y a su vez, en base a este dato, la direcci&oacute;n ser&iacute;a: http://www.tucumoda.com/flordeliz/.</p>\r\n\r\n<p>Por el motivo que fuese, en cualquier momento el due&ntilde;o de la tienda puede cambiar el nombre de usuario de la misma, y a su vez este cambio tambi&eacute;n afectar&aacute; la forma en que se accede a ella. Vamos a suponer que la tienda &laquo;Flor de Liz&raquo; ahora modific&oacute; su usuario, que ya no ser&aacute; m&aacute;s @flordeliz, sino @flor_de_liz. Como consecuencia de esta modificaci&oacute;n, la direcci&oacute;n de acceso de la tienda no ser&aacute; m&aacute;s &laquo;http://www.tucumoda.com/flordeliz/&raquo;, sino &laquo;http://www.tucumoda.com/flor_de_liz/&raquo;.</p>\r\n\r\n<h3>2. La cuenta fue desactivada</h3>\r\n\r\n<p>Los due&ntilde;os y administradores de las tiendas alojadas en Tucumoda.com disponen de una opci&oacute;n para deshabilitar temporalmente el negocio y volver a habilitarlo cuando les resulte conveniente. Durante el tiempo en que estas cuentas permanecen inactivas, todos sus productos, servicios, y datos en general; no podr&aacute;n ser accedidos por los usuarios del sitio web.</p>\r\n\r\n<p>Una vez que el due&ntilde;o o los administradores de la tienda decidan rehabilitarla, todo el contenido mencionado anteriormente volver&aacute; a estar disponible para los usuarios del sitio.</p>\r\n\r\n<h3>3. La cuenta fue suspendida</h3>\r\n\r\n<p>Cuando una tienda o alguno de los productos publicados en ella reciben reiteradas denuncias y/o quejas, la administraci&oacute;n de Tucumoda.com puede llegar (previa evaluaci&oacute;n del caso) a suspender el acceso a la misma. Durante el tiempo en que el negocio permanezca suspendido, tanto los productos, servicios, como sus datos en general no podr&aacute;n ser accedidos por los usuarios del sitio web.</p>\r\n\r\n<p>Tal como en el caso de las desactivaciones, si en alg&uacute;n momento la cuenta suspendida fuera rehabilitada, todo el contenido mencionado anteriormente volver&aacute; a estar disponible para los usuarios del sitio.</p>\r\n\r\n<h3>4. La tienda fue eliminada definitivamente</h3>\r\n\r\n<p>Tal como ocurre con las deshabilitaciones, el due&ntilde;o de una tienda tambi&eacute;n dispone de una opci&oacute;n especial que le permite eliminar definitivamente tanto el negocio como todos sus productos, servicios y datos en general. Si este es el caso, la cuenta no podr&aacute; ser accedida nuevamente a trav&eacute;s de la direcci&oacute;n ni el &uacute;ltimo nombre de usuario que se haya utilizado mientras la misma estaba en funcionamiento, dado que el sistema bloquear&aacute; estos datos, impidiendo que vuelvan a ser utilizados por alg&uacute;n otro usuario del sitio web.</p>\r\n', '2019-01-28 02:38:48', '2019-01-28 04:41:52', 0, 1, 1),
(48, 3, 8, '', 'Gestionar uno o más negocios', '', '<p>Para gestionar negocios esta es la info.</p>\r\n', '2019-09-29 08:54:10', '2019-09-29 11:54:10', 0, 0, 0),
(49, 3, 8, '', '¿Es seguro pagar por este medio?', '', '', '2019-09-30 17:22:52', '2019-09-30 20:22:52', 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_notas_adjuntos`
--

CREATE TABLE `pow_notas_adjuntos` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `archivo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(8) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `orden` int(2) NOT NULL,
  `notaID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_notas_adjuntos`
--

INSERT INTO `pow_notas_adjuntos` (`Id`, `nombre`, `descripcion`, `archivo`, `type`, `size`, `created`, `modified`, `orden`, `notaID`, `userID`) VALUES
(6, '', '', 'ebd4981994febd5efa61f35fc30d55e5.jpg', 'image/jpeg', 157796, '2019-01-03 13:59:39', '2019-01-03 15:59:39', 0, 24, 1),
(3, '', '', '9a3962348da88bc57683e0dc4620887c.jpg', 'image/jpeg', 181429, '2018-06-28 16:42:45', '2018-06-28 19:42:45', 0, 4, 1),
(7, '', '', '2b524274a804f5614ae430adcaab9d76.jpg', 'image/jpeg', 166416, '2019-01-03 14:25:20', '2019-01-03 16:25:20', 0, 24, 1),
(8, '', '', '6b7f72249a0aaa1f06b325424da019a7.jpg', 'image/jpeg', 128618, '2019-01-03 14:25:36', '2019-01-03 16:25:36', 0, 24, 1),
(9, '', '', 'bad19ec8cd8fc0f1022c9aefe4412735.jpg', 'image/jpeg', 123552, '2019-01-03 18:44:13', '2019-01-03 20:44:13', 0, 22, 1),
(11, '', '', '3d72ff4f0c7ed03644f71cbb701fd563.jpg', 'image/jpeg', 484513, '2019-03-16 18:30:39', '2019-03-16 21:30:39', 0, 6, 1),
(12, '', '', '2b3f50996ef74f73cff2e0e04a15d51e.jpg', 'image/jpeg', 102595, '2019-03-16 18:40:05', '2019-03-16 21:40:05', 0, 6, 1),
(13, '', '', '99d4264c76cdd196e30d20f0fca5fdda.jpg', 'image/jpeg', 140731, '2019-03-16 18:43:25', '2019-03-16 21:43:25', 0, 6, 1),
(14, '', '', '06ef6f67df2bdcaf03d1aaae2fb785d0.jpg', 'image/jpeg', 143956, '2019-03-16 18:45:48', '2019-03-16 21:45:48', 0, 6, 1),
(15, '', '', 'c08faa8f9d1300d883196abe7c91d1f4.jpg', 'image/jpeg', 143780, '2019-03-16 19:06:41', '2019-03-16 22:06:41', 0, 6, 1),
(16, '', '', '2fb7426c0727c198e1a57aafeda8025d.jpg', 'image/jpeg', 110902, '2019-03-16 19:07:14', '2019-03-16 22:07:14', 0, 6, 1),
(17, '', '', '9f49092e765d002270b7df2d39e05937.jpg', 'image/jpeg', 94679, '2019-03-16 19:07:36', '2019-03-16 22:07:36', 0, 6, 1),
(18, '', '', '94248ecb1d26e8ebd36c7a90335e0a1f.jpg', 'image/jpeg', 105626, '2019-03-16 19:22:41', '2019-03-16 22:22:41', 0, 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_planes`
--

CREATE TABLE `pow_planes` (
  `Id` int(11) NOT NULL,
  `plan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `precio` int(6) NOT NULL,
  `eshop` int(1) NOT NULL,
  `info` int(1) NOT NULL,
  `maxitems` int(4) NOT NULL,
  `maxoffers` int(2) NOT NULL,
  `maxphotos` int(1) NOT NULL,
  `maxadmins` int(2) NOT NULL,
  `maxemail` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_planes`
--

INSERT INTO `pow_planes` (`Id`, `plan`, `nombre`, `descripcion`, `precio`, `eshop`, `info`, `maxitems`, `maxoffers`, `maxphotos`, `maxadmins`, `maxemail`) VALUES
(1, 'trial', 'Plan básico', 'Comienza a vender tus productos y servicios, y evalúa el potencial de tu negocio en Internet.', 0, 0, 0, 8, 2, 2, 1, 0),
(2, 'init', 'Plan Emprendedor', 'Experimenta un crecimiento en tus ventas y mayor visibilidad de tus productos en la red.', 299, 0, 0, 16, 4, 2, 1, 0),
(3, 'medium', 'Plan Boutique', 'Un salto en calidad para tu negocio con la posibilidad de tener tu propia tienda en Internet.', 549, 1, 0, 32, 8, 3, 2, 1),
(4, 'advanced', 'Plan Comercio', 'A tu tienda se suma la posibilidad de tener un contacto más fluido y directo con tus clientes.', 799, 1, 1, 48, 12, 4, 3, 2),
(5, 'pro', 'Plan Gran Tienda', 'Sé el dueño de una gran tienda virtual con una gran capacidad de venta y contacto con sus clientes.', 999, 1, 1, 72, 18, 5, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_rangos`
--

CREATE TABLE `pow_rangos` (
  `Id` int(11) NOT NULL,
  `rango` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nivel` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `publicado` int(1) NOT NULL,
  `userID` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_rangos`
--

INSERT INTO `pow_rangos` (`Id`, `rango`, `nivel`, `created`, `modified`, `publicado`, `userID`) VALUES
(2, 'Super Administrador', 1, '2015-11-12 00:55:11', '2015-11-12 02:55:11', 1, 0),
(3, 'Administrador', 2, '2015-11-12 21:44:31', '2016-10-09 19:41:16', 1, 0),
(4, 'Moderador', 3, '2015-11-12 21:44:46', '2015-11-12 23:44:46', 1, 0),
(5, 'Editor', 4, '2015-11-12 21:45:01', '2015-11-12 23:45:01', 1, 0),
(6, 'Colaborador', 5, '2015-11-12 21:45:16', '2015-11-12 23:45:16', 1, 0),
(7, 'Usuario', 6, '2015-11-12 21:45:37', '2015-11-12 23:45:37', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_recover_pass`
--

CREATE TABLE `pow_recover_pass` (
  `userID` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(6) NOT NULL,
  `state` int(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_recover_pass`
--

INSERT INTO `pow_recover_pass` (`userID`, `email`, `code`, `state`, `created`) VALUES
(9, 'contacto@fdocaranza.org', 232073, 1, '2019-03-31 01:20:31'),
(9, 'contacto@fdocaranza.org', 893958, 1, '2019-03-31 01:20:40'),
(9, 'contacto@fdocaranza.org', 861521, 1, '2019-03-31 01:24:13'),
(9, 'contacto@fdocaranza.org', 238717, 1, '2019-03-31 01:24:28'),
(9, 'contacto@fdocaranza.org', 136187, 1, '2019-03-31 01:29:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_regalos`
--

CREATE TABLE `pow_regalos` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_regalos`
--

INSERT INTO `pow_regalos` (`Id`, `nombre`, `descripcion`, `codigo`) VALUES
(1, 'Mes de prueba gratis', 'Un mes gratis para probar el servicio comercial de Tucumoda.com.', 'MTSHOP1M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_reportes`
--

CREATE TABLE `pow_reportes` (
  `Id` int(11) NOT NULL,
  `link` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `sent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_reportes`
--

INSERT INTO `pow_reportes` (`Id`, `link`, `detail`, `sent`) VALUES
(3, '/tucumoda.com/product/remera-algodon-varios-motivos_0013/', 'asd asd asd', '2019-01-14 00:05:12'),
(4, '/tucumoda.com/product/remera-algodon-varios-motivos_0013/', 'asda sd', '2019-01-14 00:05:29'),
(5, 'Error funcional', 'No se pudo agregar un item a la lista de deseos.', '2019-04-21 12:32:54'),
(6, 'Error funcional', 'No se pudo agregar un item a la lista de deseos.', '2019-04-21 12:35:07'),
(7, 'Error funcional', 'No se pudo agregar un item a la lista de deseos.', '2019-04-21 12:35:11'),
(8, 'Error funcional', 'Error al guardar un servicio.', '2019-04-27 09:00:09'),
(9, 'Error funcional', 'Error al agregar un servicio a vidriera.', '2019-04-27 09:59:26'),
(10, 'Error funcional', 'Error al agregar un servicio a vidriera.', '2019-04-27 09:59:32'),
(11, 'Error funcional', 'No se pudo agregar un item a la lista de deseos.', '2019-04-27 13:57:16'),
(12, 'Error funcional', 'No se pudo agregar un item a la lista de deseos.', '2019-04-27 14:15:35'),
(13, 'Error funcional', 'No se pudo agregar un item a la lista de deseos.', '2019-04-27 14:15:38'),
(14, 'Error funcional', 'Error al enviar una consulta en tienda.', '2019-04-27 15:06:12'),
(15, 'Error funcional', 'Error al enviar una consulta en tienda.', '2019-04-27 15:20:29'),
(16, 'Error funcional', 'Error al quitar un producto de la lista de deseos.', '2019-04-29 12:07:13'),
(17, 'Error funcional', 'Error al quitar un producto de la lista de deseos.', '2019-04-29 12:08:58'),
(18, 'Error funcional', 'Error al quitar un producto de la lista de deseos.', '2019-04-29 12:09:07'),
(19, 'Error funcional', 'Error al quitar un item de la lista de deseos.', '2019-04-29 12:11:56'),
(20, 'Error funcional', 'Error al quitar un item de la lista de deseos.', '2019-04-29 12:12:23'),
(21, 'Error funcional', 'No se pudo agregar un item a la lista de deseos.', '2019-06-04 15:02:50'),
(22, 'Error funcional', 'No se pudo agregar un item a la lista de deseos.', '2019-06-04 15:03:00'),
(23, 'Error funcional', 'No se pudo agregar un item a la lista de deseos.', '2019-06-04 15:03:26'),
(24, 'Error funcional', 'No se pudo agregar un item a la lista de deseos.', '2019-06-04 15:03:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_rubros`
--

CREATE TABLE `pow_rubros` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `orden` int(2) NOT NULL,
  `publicado` int(1) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_rubros`
--

INSERT INTO `pow_rubros` (`Id`, `nombre`, `descripcion`, `created`, `modified`, `orden`, `publicado`, `userID`) VALUES
(8, 'Productos', '', '2018-05-10 14:04:46', '2019-02-07 03:08:58', 0, 1, 1),
(11, 'Servicios', '', '2019-02-07 01:09:02', '2019-02-07 03:09:02', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_series`
--

CREATE TABLE `pow_series` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `publicado` int(1) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_series_notas`
--

CREATE TABLE `pow_series_notas` (
  `Id` int(11) NOT NULL,
  `serieID` int(11) NOT NULL,
  `notaID` int(11) NOT NULL,
  `orden` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores`
--

CREATE TABLE `pow_stores` (
  `Id` int(11) NOT NULL,
  `token` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `planID` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `trial` int(1) NOT NULL,
  `trialdate` datetime NOT NULL,
  `type` int(1) NOT NULL,
  `public` int(1) NOT NULL,
  `deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores`
--

INSERT INTO `pow_stores` (`Id`, `token`, `user`, `name`, `description`, `created`, `modified`, `planID`, `status`, `trial`, `trialdate`, `type`, `public`, `deleted`) VALUES
(1, '1d1b2e19e7c0a903b9af9220df6d81a9d85ce470', 'dabar.tucuman', 'Dabar Tucumán', 'Sastrería. Venta y alquiler de trajes y zapatos para fiestas, graduaciones, eventos sociales, etc.', '0000-00-00 00:00:00', '2019-11-03 04:14:57', 1, 2, 1, '2019-11-03 02:14:57', 1, 1, 0),
(5, '2a9a028162dc905446051699a92d8eca108c94f2', 'happy.forever', 'Happy Forever Tucumán', 'Indumentaria y calzado infantil de primeras marcas.', '2018-05-26 00:18:36', '2019-10-04 01:30:23', 3, 2, 1, '2019-09-10 02:20:51', 3, 1, 0),
(6, '5699214f920ac359e6772520a3e0a2e9b0ef4514', 'cinzel.tucson', 'Cinzel Bags', 'Zapatería. Calzados en general.', '2018-06-18 01:06:23', '2019-10-04 01:30:23', 2, 2, 1, '2019-08-29 20:54:10', 3, 1, 0),
(7, 'a7495a1645db8d67c6505cd63bd8351f99c8cd33', 'lachiri', 'lachiripiorca', 'la chiripiorca es un almacen de carteras destinado a la mujer, donde encontrara su estilo unico en el diseño de cada una de ellas.', '2018-06-21 13:12:07', '2019-01-17 09:47:58', 0, 0, 0, '0000-00-00 00:00:00', 0, 1, 0),
(8, '6e1876b1740cb01fdfda31b73b33e909a12886ba', 'marmo', 'Marmota\'s', 'Tienda multimarca. Ropa, calzados, accesorios, bijou, y todas las novedades.', '2018-11-07 22:12:25', '2019-01-17 09:47:58', 0, 0, 0, '0000-00-00 00:00:00', 0, 1, 0),
(11, '547b30eea00a2aa09a8644181050fb9a4eedfa6a', 'mundomoda', 'Mundo moda', 'Venta y confección de indumentaria para hombres, mujeres y niños.', '2019-02-07 00:56:02', '2019-09-30 20:34:04', 3, 0, 0, '0000-00-00 00:00:00', 3, 1, 0),
(12, '94e8a4617cd7a78683f2bec1b3b4f7a48b434943', 'bellezza.tuc', 'Bellezza', 'Somos diseñadores de moda. No sólo vendemos ropa, sino que también te brindamos el mejor asesoramiento para que encuentres tu estilo propio.', '2019-03-16 01:57:02', '2019-03-16 06:20:28', 0, 0, 0, '0000-00-00 00:00:00', 1, 1, 0),
(20, '22bcda0ee6dae48f40119ef5c88f597b7b1b906e', 'ciarateffy', 'Ciara Teffy', 'Peluquería y centro de belleza.', '2019-10-09 15:31:12', '2019-11-03 07:03:04', 2, 2, 1, '2019-10-09 15:31:20', 3, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_admins`
--

CREATE TABLE `pow_stores_admins` (
  `userID` int(11) NOT NULL,
  `storeID` int(11) NOT NULL,
  `levelID` int(1) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_admins`
--

INSERT INTO `pow_stores_admins` (`userID`, `storeID`, `levelID`, `active`) VALUES
(9, 5, 10, 1),
(9, 1, 10, 1),
(12, 6, 10, 1),
(9, 6, 1, 1),
(14, 7, 10, 1),
(17, 8, 10, 1),
(20, 10, 1, 1),
(22, 5, 1, 1),
(9, 8, 1, 1),
(9, 11, 10, 1),
(23, 12, 10, 1),
(20, 12, 1, 1),
(23, 13, 10, 1),
(28, 1, 1, 1),
(28, 20, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_info`
--

CREATE TABLE `pow_stores_info` (
  `storeID` int(11) NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `instagram` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `pinterest` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_info`
--

INSERT INTO `pow_stores_info` (`storeID`, `email`, `website`, `telefono`, `celular`, `facebook`, `twitter`, `instagram`, `pinterest`) VALUES
(1, 'info@dabartucuman.com.ar', 'http://www.dabartucuman.com.ar/', '0381 437-6874', '', 'dabar.tucuman', '', 'dabar.tucuman', ''),
(5, 'happyforever@gmail.com', 'http://happyforever.com/ar/', '(0381) 437-6874', '', 'happyforever.tucson', '', 'happyforever.tucson', ''),
(6, '', '', '', '', 'cinzel.bags', '', 'cinzel.bags', ''),
(7, '', '', '', '', '', '', '', ''),
(8, '', '', '', '', '', '', '', ''),
(9, '', '', '', '', '', '', '', ''),
(10, '', '', '', '', '', '', '', ''),
(11, 'info@mundomoda.com', 'www.mundomoda.com', '0381 438-2020', '', 'mundomoda', '', 'mundomoda', ''),
(12, 'info@bellezza.com', 'www.bellezza.com', '0381 455-5555', '', 'bellezza.tuc', '', 'bellezza.tuc', ''),
(13, '', '', '', '', '', '', '', ''),
(20, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_items`
--

CREATE TABLE `pow_stores_items` (
  `Id` int(11) NOT NULL,
  `storeID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `genre` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `edad` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `color` text COLLATE utf8_unicode_ci NOT NULL,
  `marca` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `talle` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `precio` decimal(7,2) NOT NULL,
  `tags` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `public` int(1) NOT NULL,
  `deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_items`
--

INSERT INTO `pow_stores_items` (`Id`, `storeID`, `categoryID`, `name`, `detail`, `genre`, `edad`, `color`, `marca`, `talle`, `tipo`, `precio`, `tags`, `public`, `deleted`) VALUES
(1, 5, 46, 'Vestido rosa fiesta', 'Vestidos de fiesta largo simétrico. Muy atractivo. Se vera muy encantadora y elegante. Ideal para baile de graduación, fiesta, cóctel, etc.\nLa tela es elastizada y cede hasta 10cm más de lo que indica su respectivo talle. Varios colores.', 'f', 'a', 'Natural, Beige, Rosa, Verde Agua', 'Dolce & Gabana', 'SM, S, L, XL', 'p', '1250.00', 'pollera, fiesta, vestido', 1, 0),
(2, 5, 49, 'Vestido de fiesta negro', 'La fragancia que se puede percibir en el ambiente es la misma Presencia de Dios habitando en ese lugar.', 'f', 'a', 'Jean, Blanca', 'Chevy', '22, 24, 26, 28, 30', 'p', '220.00', 'camisa, flores, sport, dia', 1, 0),
(4, 1, 49, 'Lápiz labial varios colores', 'Ambo de alpaca grueso. Varios colores y talles. Ideal para casamientos, fiestas formales e informales, despedidas, bautismos, etc. Camisa y corbata de regalo.', 'f', 'a', 'Negro, Gris, Azul', 'Macowens', '46, 48, 50, 52, 54, 56', 'p', '2200.00', 'saco, pantalon, camisa, ambo, smoking, fiesta, corbata, hombre', 1, 1),
(5, 6, 49, 'Mochila Spinner', 'Zapatilla Nike Highest Jump. ¡Las zapatillas que usa Cristiano Ronaldo para llegar a lo alto de su carrera!', 'u', 'i', 'Negro, azul claro, azul oscuro, rojo, verde', 'Nike', '34 al 44', 'p', '950.00', 'calzados, zapatillas, nike, deportes', 1, 0),
(6, 6, 49, 'Juegos de anillos chic', 'Botas bucaneras de 30 Cm. Altura de la rodilla. Tacos de 7,5\'\' y doble hebilla de cobre.', 'f', 'i', 'Negro, marrón', 'La Zarzuela', '35 al 38', 'p', '1850.00', 'botas, bucaneras, calzados, zapatos, invierno', 1, 0),
(7, 6, 49, 'Conjuntos deportivos niños', 'Zapatos escolares niño en varios colores.', 'u', 'n', 'negro, marron, natural, azul', 'Rigazzio', '35 al 42', 'p', '700.00', 'zapato, escuela, niño, escolar, calzado', 1, 0),
(8, 6, 49, 'Vestido beige', 'Zapatillas Nike elegante sport. Ideales para usar con traje, o ropa informal.', 'f', 'a', 'blanco,negro , azul ,natural', 'Nike', '34 al 43', 'p', '1550.00', 'zapatilla, nike, elegante, sport, fiesta, traje, informal, calzado', 1, 0),
(11, 5, 49, 'Zapatillas Skater', 'Collar de plata 925 con dije de corazón. 28 Cm con broche retráctil.', 'm', 'a', 'plateado mate', 'Topper', '36 al 45', 'p', '1185.00', 'collar, plata, dije, corazon, bijou', 1, 0),
(13, 5, 49, 'Remera algodón varios motivos', 'Perfume imitación de 212 Carolina Herrera. ', 'f', 'a', '--', 'Millanel', '--', 'p', '220.00', 'Perfume, 212, dos doce, CH, carolina herrera, millanel', 1, 0),
(14, 6, 49, 'Cartera Cuero Ecológico Rojo', '', 'f', '', '', '', '', 'p', '550.00', 'fiesta, cartera, rojo, cuero', 1, 0),
(15, 6, 49, 'Cartera de cuero', 'Cartera informal con tres compartimentos para anteojos, lapiceras, anotador, monedero y celular. Tira larga ajustable.', 'f', 'a', 'Negro, marrón', 'Gucci', '', 'p', '350.00', 'cartera, bolso, cuero, rojo, fiesta', 1, 0),
(18, 6, 49, 'Zapatos con moño', 'Zapatos en cuero, color natural, detalle de moño en mismo material. Taco 8 cm.', 'f', 'a', 'natural, blanco, beige, marrón claro', 'Hush Puppies', '34, 35, 36, 37, 38', 'p', '1450.00', 'zapato, taco, calzado, moño, natural, cuero, fiesta', 1, 0),
(19, 11, 49, 'Vestido rosa nena', 'Vestido rosa para nenas de entre 5 y 9 años con vuelos y detalles en blanco y gris. Ideal para fiestas infantiles y ocasiones sociales.', 'f', 'n', 'rosa, rosita, pink, pinky', 'Cheeky', '20 al 28', 'p', '790.00', 'vestido, niña, pink, pinky, rosa, rosita, fiesta, cumpleaños', 1, 0),
(20, 12, 46, 'Blusa Wesley verde agua', 'Blusa Wesley verde agua. Muy flexible, excelente confección. No se encoge ni decolora con lavado. 80% algodón 20% poliester. Varios talles y colores.', 'f', '', 'verde agua, celeste, rosa, blanco, natural', 'Gucci', 'S, M, L', 'p', '475.00', 'blusa, wesley, verde, remera, chomba, dama, mujer', 1, 0),
(21, 12, 46, 'Blusa bordada con estampado', 'Blusa bordada con estampado. 100% algodón.', 'f', '', 'negro', 'Gucci', 'S, M, L', 'p', '480.00', 'blusa, bordada, estampado, verano, tarde', 1, 0),
(22, 12, 49, 'Blusa campesina con boleros', 'Blusa campesina con boleros en las mangas.', 'f', '', 'negro, gris, azul', 'Gucci', 'M, L, XL', 'p', '520.00', 'blusa', 1, 0),
(23, 12, 46, 'Blusa de chifón plisada', 'Blusa de chifón plisada con cuello alto Rojo.', 'f', '', 'rojo, negro', 'Gucci', '22-30', 'p', '400.00', 'blusa, rojo', 1, 0),
(24, 11, 50, 'Corte de cabello caballero', 'Corte de cabello caballeros desde los 12 años.', 'm', 'a', '', '', '', 's', '150.00', 'corte, cabello, caballeros, hombres, barbería, barba', 1, 0),
(25, 11, 51, 'Corte de cabello niño', 'Corte de cabello niños menores de 12 años.', 'm', 'n', '', '', '', 's', '120.00', 'corte, cabello, niño, nene', 1, 0),
(26, 6, 53, 'Maquillaje para fiestas', 'Sesión de maquillaje para fiestas y ocasiones especiales. Incluye previo tratamiento de piel de cutis y ojos.', 'f', 'i', '', '', '', 's', '280.00', 'maquillaje, makeup, make up, fiesta, sociales, cutis, ojos', 1, 0),
(27, 11, 50, 'Servicio de barbería en general', 'Corte, recorte y mantenimiento de barba. Técnica con navaja, tijera y máquina. Atención personalizada. Catálogo de opciones.', 'm', 'a', '', '', '', 's', '120.00', 'barbería, barba, barbero, recorte, navaja, bigote', 1, 0),
(29, 11, 49, 'Vestido de fiesta rojo', 'Vestido de fiesta rojo con tiras.', 'f', 'a', 'rojo', 'Gucci', 'sm,m,l', 'p', '2200.00', 'vestido, dress, rojo, fiesta, tiritas', 1, 0),
(30, 6, 48, 'Collar con dije de corazón', 'Collar enchapado con dije de corazón púrpura. Piedra sintética color azul oscuro. Oro 14 kilates. Broche con seguro.', 'f', 'a', 'Azul, Púrpura', 'Mica Bonnie', '', 'p', '325.00', 'collar, cadena, cadenita, dije, colgante, joyas', 0, 0),
(31, 6, 45, 'Perfume Ciel Azul Original', 'Perfume Ciel Azul Original en caja cerrada. Fragancia persistente hasta por 10 horas.', 'f', 'a', '', 'Ciel', '', 'p', '2850.00', 'Perfume, ciel, fragancia, perfumería', 1, 0),
(34, 8, 47, 'Zapatilla Adidas N° 223', 'Zapatilla Adidas N° 223 unisex. Varios talles y colores.', 'u', 'a', 'Negro, blanco, rosa, azul', 'Adidas', '34 al 45', 'p', '3225.00', 'Zapatilla, adidas, 223', 1, 0),
(35, 8, 46, 'Camisa slim fit hombre', 'Camisa slim fit hombre. Lisa y a cuadros. Varios talles y colores.', 'm', 'a', 'Rojo, azul, verde, negro', 'Chevy', '38 al 50', 'p', '780.00', 'Camisa, cuadros, slim fit', 1, 0),
(36, 5, 53, 'Maquillaje profesional', 'Maquillaje profesional para fiestas y eventos sociales.', 'f', 'i', '', '', '', 's', '350.00', 'maquillaje, makeup, pinturas', 1, 0),
(38, 1, 47, 'Zapatillas dama', 'Zapatillas dama todos los talles, colores y modelos.', 'f', 'i', 'Rojo, azul, rosa, negro, blanco', 'Nike', '34 al 40', 'p', '1540.00', 'zapatillas, zapas, zapatos, calzados', 1, 0),
(39, 20, 50, 'Corte de cabello', 'Corte de cabello + baño de crema y peinado.', 'f', 'a', '', '', '', 's', '275.00', 'corte, cabello, baño, crema, peniado, brushing', 1, 0),
(40, 20, 50, 'Brushing & Alisado', 'Brushing, alisado y baño de crema.', 'f', 'a', '', '', '', 's', '250.00', 'brushing, alisado, planchita, keratina, shock', 1, 0),
(41, 20, 50, 'Shock de Keratina', 'Shock de keratina + baño de crema.', 'f', 'a', '', '', '', 's', '250.00', 'keratina, alisado, shock', 1, 0),
(42, 20, 50, 'Lavado y nutrición', 'Lavado de cabeza especial, con productos naturales y nutrientes para el cabello.', 'f', 'a', '', '', '', 's', '200.00', 'lavado, nutrición, cabello', 1, 0),
(43, 20, 50, 'Tintura completa', 'Tintura + Raiz + Alisado + keratina.', 'f', 'a', '', '', '', 's', '1050.00', 'tintura, coloración, alisado, keratina', 1, 0),
(44, 20, 50, 'Decoloración completa', 'Decoloración completa + baño de crema.', 'f', 'a', '', '', '', 's', '1200.00', 'decoloración, tintura, coloración', 1, 0),
(45, 20, 50, 'Reflejos', 'Reflejos + keratina + baño de crema', 'f', 'a', '', '', '', 's', '1600.00', 'reflejos, keratina, peluquería, corte, cabello', 1, 0),
(46, 20, 50, 'Máscara de keratina', 'Máscara de keratina + modelado + baño de crema.', 'f', 'a', '', '', '', 's', '600.00', 'keratina, modelado, corte, cabello, peluquería', 1, 0),
(48, 20, 45, 'Acondicionador especial', 'Acondicionador especial Elvive 600 ml.', 'f', 'a', '', 'Elvive', '', 'p', '145.00', 'acondicionador, cabello', 1, 0),
(49, 20, 45, 'Acondicionador Pantene', 'Acondicionador Pantene Pro-V 355 ml. Curl Perfection - Frizz calming complex.', 'f', 'a', '', 'Pantene', '', 'p', '265.00', 'pantene, acondicionador, cabello', 1, 0),
(50, 1, 46, 'Pollera Hippie floreada', 'Pollera hippie floreada.', 'f', 'a', 'floreada', 'Gucci', 'talle único', 'p', '780.00', 'pollera, falda, hippie, flores, floreada, primavera, verano', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_items_media`
--

CREATE TABLE `pow_stores_items_media` (
  `Id` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `link` varchar(23) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(2) NOT NULL,
  `tipo` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_items_media`
--

INSERT INTO `pow_stores_items_media` (`Id`, `itemID`, `link`, `orden`, `tipo`) VALUES
(62, 10, '00010_1529522091.jpg', 1, 'p'),
(63, 10, '00010_1529522217.jpg', 0, 'p'),
(64, 10, '00010_1529522305.jpg', 2, 'p'),
(70, 5, '00005_1529595836.jpg', 0, 'p'),
(72, 7, '00007_1529596143.jpg', 1, 'p'),
(75, 6, '00006_1529613374.jpg', 1, 'p'),
(92, 15, '00015_1531274550.jpg', 0, 'p'),
(100, 2, '00002_1546479303.jpg', 2, 'p'),
(101, 13, '00013_1546479387.jpg', 0, 'p'),
(102, 4, '00004_1546479455.jpg', 0, 'p'),
(104, 14, '00014_1546479682.jpg', 3, 'p'),
(106, 17, '00017_1546564530.jpg', 0, 'p'),
(107, 6, '00006_1547011659.jpg', 0, 'p'),
(120, 18, '00018_1548675650.jpg', 0, 'p'),
(121, 19, '00019_1549508393.jpg', 0, 'p'),
(123, 11, '00011_1551852089.jpg', 2, 'p'),
(124, 16, '00016_1552703543.jpg', 0, 'p'),
(125, 1, '00001_1552703916.jpg', 0, 'p'),
(126, 8, '00008_1552704020.jpg', 0, 'p'),
(128, 20, '00020_1552714501.jpg', 0, 'p'),
(129, 20, '00020_1552714620.jpg', 1, 'p'),
(131, 20, '00020_1552714501_52.jpg', 2, 'p'),
(132, 21, '00021_1552715449.jpg', 0, 'p'),
(133, 22, '00022_1552715655.jpg', 0, 'p'),
(134, 22, '00022_1552715655_21.jpg', 1, 'p'),
(135, 22, '00022_1552715655_87.jpg', 1, 'p'),
(136, 23, '00023_1552715922.jpg', 0, 'p'),
(137, 23, '00023_1552715922_25.jpg', 2, 'p'),
(138, 23, '00023_1552715922_34.jpg', 1, 'p'),
(140, 2, '00002_1553576053.jpg', 0, 'p'),
(144, 16, '00016_1552703543_12.jpg', 1, 'p'),
(145, 19, '00019_1553828278.jpg', 0, 'p'),
(146, 1, '00001_1552703916_53.jpg', 1, 'p'),
(150, 11, '00011_1551852089_70.jpg', 3, 'p'),
(155, 24, '00001_1552011783.jpg', 0, 's'),
(156, 25, '00002_1549513470.jpg', 0, 's'),
(157, 26, '00003_1552704093.jpg', 0, 's'),
(166, 27, '00027_1556369537.jpg', 0, ''),
(168, 29, '00029_1556375152.jpg', 0, ''),
(172, 9, '00009_1556383233.jpg', 0, ''),
(175, 14, '00014_1561379156.jpg', 1, ''),
(176, 14, '00014_1561379221.jpg', 0, ''),
(177, 14, '00014_1561379249.jpg', 2, ''),
(179, 31, '00031_1561474747.jpg', 0, ''),
(182, 1, '00001_1552703916_55.jpg', 2, ''),
(186, 32, '00032_1562200138.jpg', 2, ''),
(187, 32, '00032_1562200325.jpg', 3, ''),
(188, 32, '00032_1562200353.jpg', 1, ''),
(189, 32, '00032_1562200433.jpg', 0, ''),
(190, 33, '00033_1562200677.jpg', 0, ''),
(191, 33, '00033_1562200700.jpg', 2, ''),
(192, 33, '00033_1562200717.jpg', 1, ''),
(194, 11, '00011_1562267848.jpg', 1, ''),
(198, 31, '00031_1561474747_23.jpg', 1, ''),
(199, 34, '00034_1562821497.jpg', 2, ''),
(200, 34, '00034_1562821524.jpg', 0, ''),
(201, 34, '00034_1562821553.jpg', 1, ''),
(202, 35, '00035_1562822056.jpg', 2, ''),
(204, 35, '00035_1562822099.jpg', 0, ''),
(206, 35, '00035_1562822137.jpg', 1, ''),
(207, 35, '00035_1562822161.jpg', 3, ''),
(208, 7, '00007_1529596143_29.jpg', 1, ''),
(210, 36, '00036_1564545317.jpg', 0, ''),
(211, 37, '00037_1569758985.jpg', 0, ''),
(212, 38, '00038_1570152174.jpg', 1, ''),
(216, 39, '00039_1570654037.jpg', 1, ''),
(217, 39, '00039_1570654546.jpg', 0, ''),
(218, 40, '00040_1570654589.jpg', 0, ''),
(219, 40, '00040_1570654599.jpg', 1, ''),
(220, 41, '00041_1570654619.jpg', 0, ''),
(221, 42, '00042_1570654635.jpg', 0, ''),
(222, 43, '00043_1570654659.jpg', 0, ''),
(223, 44, '00044_1570654724.jpg', 0, ''),
(224, 45, '00045_1570654780.jpg', 0, ''),
(225, 45, '00045_1570654800.jpg', 0, ''),
(226, 46, '00046_1570654891.jpg', 0, ''),
(227, 46, '00046_1570654903.jpg', 0, ''),
(228, 48, '00048_1570679153.jpg', 0, ''),
(229, 49, '00049_1570679336.jpg', 0, ''),
(230, 50, '00050_1572754810.jpg', 0, ''),
(232, 50, '00050_1572754810_24.jpg', 1, ''),
(234, 38, '00038_1572764590.jpg', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_items_offers`
--

CREATE TABLE `pow_stores_items_offers` (
  `Id` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `storeID` int(11) NOT NULL,
  `newprice` decimal(10,2) NOT NULL,
  `percent` int(2) NOT NULL,
  `deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_items_offers`
--

INSERT INTO `pow_stores_items_offers` (`Id`, `itemID`, `storeID`, `newprice`, `percent`, `deadline`) VALUES
(70, 42, 20, '180.00', 10, '2019-11-01'),
(72, 43, 20, '892.00', 15, '2019-12-01'),
(73, 41, 20, '200.00', 20, '2019-12-01'),
(74, 48, 20, '130.50', 10, '2019-12-01'),
(75, 38, 18, '1386.00', 10, '2019-12-01'),
(76, 29, 11, '1980.00', 10, '2019-12-01'),
(77, 1, 5, '1125.00', 10, '2020-04-01'),
(78, 2, 5, '176.00', 20, '2020-05-01'),
(79, 11, 5, '1007.25', 15, '2020-05-01'),
(80, 11, 5, '1007.25', 15, '2020-05-01'),
(81, 11, 5, '1007.25', 15, '2020-05-01'),
(82, 11, 5, '1007.25', 15, '2020-05-01'),
(83, 11, 5, '1007.25', 15, '2020-06-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_items_rate`
--

CREATE TABLE `pow_stores_items_rate` (
  `itemID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `rate` int(1) NOT NULL,
  `tipo` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_items_rate`
--

INSERT INTO `pow_stores_items_rate` (`itemID`, `userID`, `rate`, `tipo`) VALUES
(2, 23, 4, 'p'),
(2, 22, 2, 'p'),
(2, 9, 5, 'p'),
(1, 9, 2, 'p'),
(11, 9, 1, 'p'),
(16, 9, 4, 'p'),
(6, 9, 1, 'p'),
(4, 17, 4, 'p'),
(8, 17, 5, 'p'),
(2, 17, 2, 'p'),
(7, 17, 4, 'p'),
(11, 17, 3, 'p'),
(4, 9, 2, 'p'),
(13, 9, 2, 'p'),
(19, 9, 4, 'p'),
(1, 23, 4, 'p'),
(20, 9, 5, 'p'),
(24, 9, 4, 's'),
(25, 9, 2, 's'),
(26, 9, 2, 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_levels`
--

CREATE TABLE `pow_stores_levels` (
  `Id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_levels`
--

INSERT INTO `pow_stores_levels` (`Id`, `name`, `detail`, `level`) VALUES
(1, 'Encargado', 'Acceso total a todas las opciones, salvo administradores.', 1),
(2, 'Data entry', 'Acceso a gestión de productos.', 2),
(3, 'Community Manager', 'Acceso a mensajes.', 3),
(4, 'Auditor', 'Acceso a estadísticas de ventas y lectura de mensajes.', 4),
(10, 'Administrador general', 'Acceso a todo.', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_locations`
--

CREATE TABLE `pow_stores_locations` (
  `Id` int(11) NOT NULL,
  `storeID` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `areaID` int(11) NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cellphone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_locations`
--

INSERT INTO `pow_stores_locations` (`Id`, `storeID`, `name`, `address`, `areaID`, `phone`, `cellphone`, `email`) VALUES
(1, 5, 'Local Centro', '25 de Mayo 223', 86, '03814224458', '3815656363', 'centro@happyforever.com'),
(3, 5, 'Local Barrio Sur', 'Lavalle 851', 86, '0381 425-0212', '+5493813556898', 'tucbarriosur@happyforever.com'),
(4, 5, 'Yerba Buena', 'Pringles 25', 111, '4602032', '+5493815552526', 'tucyerbabuena@happyforever.com'),
(5, 6, 'Villa Urquiza', 'Av. República del Líbano 1035', 86, '(0381) 433-2915', '--', 'urquiza@etvez.com.ar'),
(6, 6, 'Roca', 'Av. Nestor Kirchner 2425', 86, '(0381) 425-2669', '--', 'roca@stvez.com.ar'),
(7, 1, 'Tucumán - Sur', 'Pringles 223', 22, '437-6874', '+54 9 3865 565-0252', 'concepcion@dabartucuman.com'),
(8, 1, 'Tucumán - Este', 'Marmotella 2833', 4, '(0381) 499-3565', '+54 9 381 654-5', 'alderetes@dabartucuman.com'),
(9, 12, 'Casa central', 'Av. Central Sur 2230', 111, '0381 455-5555', '+54 9 381 511-1111', 'central@bellezza.com'),
(10, 12, 'Sucursal Sur', 'Muñecas 12345', 22, '', '', ''),
(11, 11, 'Centro Norte', '25 de Mayo 450', 86, '(0381) 422-5454', '+54 9 381 355-6535', 'centron@mundomoda.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_messages`
--

CREATE TABLE `pow_stores_messages` (
  `Id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `storeID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `subject` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `sent` datetime NOT NULL,
  `readed` int(1) NOT NULL,
  `closed` int(1) NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_messages`
--

INSERT INTO `pow_stores_messages` (`Id`, `userID`, `storeID`, `itemID`, `subject`, `message`, `sent`, `readed`, `closed`, `updated`) VALUES
(3, 9, 6, 8, 'Consulta', 'Qué onda con este vestido?', '2019-05-22 03:52:14', 1, 1, '2019-06-08 01:26:19'),
(4, 9, 12, 20, 'Consulta', 'Tenes stock?', '2019-05-31 22:42:49', 1, 1, '0000-00-00 00:00:00'),
(5, 9, 6, 6, 'Consulta', 'Tenés algún anillo para compromiso con piedras?', '2019-06-05 07:48:05', 1, 1, '2019-06-08 03:14:12'),
(6, 9, 6, 18, 'Consulta', 'Tenés este mismo zapato, pero sin el moño?', '2019-06-05 07:49:01', 1, 1, '0000-00-00 00:00:00'),
(7, 9, 6, 7, 'Consulta', 'Hasta qué talles tenés estos conjuntitos?', '2019-06-05 08:00:51', 1, 1, '2019-06-08 01:36:00'),
(8, 9, 11, 27, 'Consulta', 'Hacés estilo free?', '2019-06-05 08:01:20', 1, 1, '2019-06-08 12:51:02'),
(9, 9, 1, 9, 'Consulta', 'Tenés en color verde militar?', '2019-06-05 08:02:17', 1, 1, '2019-06-23 01:51:23'),
(10, 9, 11, 29, 'Consulta', 'La chica viene con el vestido?', '2019-06-08 12:55:14', 1, 1, '2019-06-08 12:57:03'),
(11, 9, 5, 1, 'Consulta', 'Qué lindo vestido!! Cuánto?', '2019-06-29 19:24:25', 1, 1, '0000-00-00 00:00:00'),
(12, 9, 5, 2, 'Consulta', 'Qué buena está la chica!!', '2019-06-29 19:24:37', 1, 1, '2019-08-22 10:38:26'),
(13, 9, 5, 11, 'Consulta', 'Qué linda la pendeja!', '2019-06-29 19:24:49', 1, 1, '2019-06-30 12:14:31'),
(14, 9, 5, 1, 'Consulta', 'Qué tal es este vestido?', '2019-07-31 00:44:45', 1, 1, '0000-00-00 00:00:00'),
(15, 9, 11, 29, 'Consulta', 'En qué talles está disponible este vestido? Tenés stock ahora?', '2019-09-22 19:21:27', 1, 0, '2019-09-22 19:23:37'),
(16, 27, 11, 29, 'Consulta', 'A cuánto lo tenés a este vestido?', '2019-09-29 08:41:41', 1, 0, '2019-09-29 08:45:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_messages_answers`
--

CREATE TABLE `pow_stores_messages_answers` (
  `Id` int(11) NOT NULL,
  `messageID` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `sent` datetime NOT NULL,
  `readed` int(1) NOT NULL,
  `sender` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_messages_answers`
--

INSERT INTO `pow_stores_messages_answers` (`Id`, `messageID`, `message`, `sent`, `readed`, `sender`) VALUES
(1, 1, 'Es de gaza, con partes en encaje blanco.', '2019-05-01 18:47:26', 1, 2),
(2, 1, 'Ok!! Muchas gracias!!', '2019-05-01 18:49:09', 1, 1),
(3, 3, 'Toda la onda! Te lo super recomendamos!!', '2019-06-05 07:09:41', 1, 2),
(4, 3, 'Genial!! Es el único color?', '2019-06-08 01:10:37', 1, 1),
(5, 3, 'No, también lo tenemos en color caca..', '2019-06-08 01:11:08', 1, 2),
(6, 3, 'Ah, sos vivo..', '2019-06-08 01:25:13', 1, 1),
(7, 3, 'Ahora por vivo no te compro nada..', '2019-06-08 01:26:19', 1, 2),
(8, 7, 'Hola Franco! Tenemos desde el XXS hasta el M.', '2019-06-08 01:35:39', 1, 2),
(9, 7, 'Muchas gracias!!', '2019-06-08 01:35:55', 1, 1),
(10, 7, '', '2019-06-08 01:36:00', 1, 1),
(11, 5, 'Sí!! Tenemos una gran variedad en cintillos!!', '2019-06-08 03:12:36', 1, 2),
(12, 5, 'Perfecto!! Por dónde puedo pasar a verlos?', '2019-06-08 03:13:15', 1, 1),
(13, 5, 'Estamos en la 25 de Mayo 456. ¡Te esperamos!', '2019-06-08 03:14:11', 1, 2),
(14, 8, 'Sí, free of infection.', '2019-06-08 12:50:34', 1, 2),
(15, 8, 'Genial!! Gracias!!', '2019-06-08 12:51:02', 1, 1),
(16, 10, 'No, la chica se vende por aparte..', '2019-06-08 12:55:49', 1, 2),
(17, 10, 'Ah, bueno.. gracias igual!', '2019-06-08 12:56:32', 1, 1),
(18, 10, 'A vos!!', '2019-06-08 12:57:03', 1, 2),
(19, 9, 'Hola Franco!! Sí, tenemos!!', '2019-06-14 01:06:49', 1, 2),
(20, 9, 'Genial!! Muchas gracias!!', '2019-06-14 01:07:21', 1, 1),
(21, 9, 'Gracias a vos!!', '2019-06-23 01:51:23', 1, 2),
(22, 13, 'See, ta para atendela..', '2019-06-30 12:14:31', 1, 2),
(23, 12, '', '2019-08-22 10:38:26', 1, 2),
(24, 15, 'Hola Franco!! Cómo estás? Sí, tenemos este vestido en todos los talles. Esperamos tu visita!!', '2019-09-22 19:23:12', 1, 2),
(25, 15, 'Muchas gracias!!', '2019-09-22 19:23:37', 1, 1),
(26, 16, 'Hola Julia!! El precio es el publicado, aunque a vos te lo regalo. Sos bella y te amo muchisimo!!', '2019-09-29 08:45:56', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_rate`
--

CREATE TABLE `pow_stores_rate` (
  `storeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `rate` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_rate`
--

INSERT INTO `pow_stores_rate` (`storeID`, `userID`, `rate`) VALUES
(6, 9, 4),
(0, 9, 0),
(8, 9, 5),
(0, 9, 0),
(5, 9, 2),
(5, 9, 0),
(1, 9, 4),
(1, 9, 0),
(8, 17, 2),
(8, 17, 2),
(6, 17, 2),
(6, 17, 2),
(5, 17, 4),
(5, 17, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_schedules`
--

CREATE TABLE `pow_stores_schedules` (
  `Id` int(11) NOT NULL,
  `locationID` int(11) NOT NULL,
  `day` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `mopen` time NOT NULL,
  `mclose` time NOT NULL,
  `topen` time NOT NULL,
  `tclose` time NOT NULL,
  `turn` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_schedules`
--

INSERT INTO `pow_stores_schedules` (`Id`, `locationID`, `day`, `mopen`, `mclose`, `topen`, `tclose`, `turn`) VALUES
(1, 8, 'Lunes a viernes', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 2),
(2, 8, 'Sábados', '09:00:00', '14:00:00', '17:00:00', '21:00:00', 1),
(5, 7, 'Lunes a viernes', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 2),
(6, 7, 'Sábados', '09:00:00', '13:00:00', '09:00:00', '09:00:00', 1),
(7, 8, 'Domingos', '17:00:00', '21:00:00', '17:00:00', '21:00:00', 1),
(8, 3, 'Lunes a viernes', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 2),
(11, 1, 'Lunes a viernes', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 2),
(12, 1, 'Sábados', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 2),
(13, 4, 'Lunes a viernes', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 2),
(14, 4, 'Sábados', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 1),
(15, 9, 'Lunes a viernes', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 2),
(16, 9, 'Sábados', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 1),
(17, 11, 'Lunes a viernes', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 2),
(18, 11, 'Sábados', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 1),
(31, 3, 'Sábados', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 1),
(32, 15, 'Lunes a viernes', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 2),
(36, 15, 'Sábados', '09:00:00', '13:00:00', '17:00:00', '21:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_shower`
--

CREATE TABLE `pow_stores_shower` (
  `Id` int(11) NOT NULL,
  `storeID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `orden` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_shower`
--

INSERT INTO `pow_stores_shower` (`Id`, `storeID`, `itemID`, `orden`) VALUES
(9, 11, 19, 1),
(11, 6, 5, 1),
(13, 6, 7, 3),
(14, 6, 8, 3),
(21, 6, 15, 4),
(23, 12, 20, 0),
(25, 12, 22, 0),
(26, 12, 21, 0),
(27, 12, 23, 0),
(30, 11, 27, 2),
(31, 11, 24, 3),
(33, 11, 29, 0),
(35, 1, 9, 0),
(36, 6, 6, 0),
(37, 6, 14, 0),
(55, 5, 1, 0),
(56, 5, 11, 1),
(57, 5, 36, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_stores_tienda`
--

CREATE TABLE `pow_stores_tienda` (
  `storeID` int(11) NOT NULL,
  `vidriera` int(1) NOT NULL,
  `header` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `opacityheader` int(3) NOT NULL,
  `ordering` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tabhome` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_stores_tienda`
--

INSERT INTO `pow_stores_tienda` (`storeID`, `vidriera`, `header`, `logo`, `opacityheader`, `ordering`, `tabhome`) VALUES
(5, 1, '00005_1551850973.jpg', '00005_1548781601.jpg', 50, 'precio,desc', 'items'),
(1, 1, '00001_1548591540.jpg', '00001_1548632662.jpg', 50, '', 'shower'),
(6, 1, '00006_1548646060.jpg', '00006_1548633361.jpg', 25, 'Id,asc', 'items'),
(7, 1, '', '', 0, '', ''),
(8, 1, '00008_1548764199.jpg', '00008_1548764255.jpg', 32, '', 'items'),
(9, 1, '', '', 0, '', ''),
(10, 0, '', '', 0, '', ''),
(11, 0, '00011_1552276376.jpg', '00011_1552276402.jpg', 40, 'Id,desc', 'shower'),
(12, 0, '00012_1552713191.jpg', '00012_1552712955.jpg', 20, '', 'items'),
(13, 0, '', '', 0, '', ''),
(20, 0, '00020_1570680119.jpg', '00020_1570680054.jpg', 13, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_subcategorias`
--

CREATE TABLE `pow_subcategorias` (
  `Id` int(11) NOT NULL,
  `categoriaID` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `orden` int(2) NOT NULL,
  `publicado` int(1) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_subcategorias`
--

INSERT INTO `pow_subcategorias` (`Id`, `categoriaID`, `nombre`, `descripcion`, `created`, `modified`, `orden`, `publicado`, `userID`) VALUES
(1, 1, 'Info general', '', '2016-10-17 14:07:55', '2016-10-17 16:07:55', 0, 1, 0),
(2, 2, 'Novedades', '', '2018-05-12 14:33:15', '2018-05-12 17:37:49', 1, 1, 0),
(3, 2, 'Salud', '', '2018-05-12 14:33:20', '2018-05-12 17:34:13', 2, 1, 0),
(4, 2, 'Tendencias', '', '2018-05-12 14:33:25', '2018-05-12 17:34:13', 3, 1, 0),
(5, 2, 'Alimentación', '', '2018-05-12 14:33:54', '2018-05-12 17:34:13', 4, 1, 0),
(6, 2, 'Celebrities', '', '2018-05-12 14:37:59', '2018-05-12 17:37:59', 0, 1, 0),
(7, 3, 'Cuentas de usuario', '', '2019-01-02 21:45:49', '2019-01-03 00:38:50', 2, 1, 0),
(8, 3, 'Gestión de negocios', '', '2019-01-02 21:46:03', '2019-01-03 00:38:50', 3, 1, 0),
(9, 3, 'Compras y consultas', '', '2019-01-02 21:46:11', '2019-01-03 15:36:03', 4, 1, 0),
(10, 3, 'Registro e Inicio de sesión', '', '2019-01-02 21:46:23', '2019-01-03 00:38:50', 1, 1, 0),
(11, 3, 'Sistema de puntos', '', '2019-01-02 21:46:44', '2019-01-30 13:18:31', 5, 0, 0),
(12, 3, 'Otros temas', '', '2019-01-02 21:46:52', '2019-01-03 00:38:50', 6, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_submenues`
--

CREATE TABLE `pow_submenues` (
  `Id` int(11) NOT NULL,
  `menuID` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `orden` int(2) NOT NULL,
  `publicado` int(1) NOT NULL,
  `instalado` int(1) NOT NULL,
  `paginado` int(2) NOT NULL,
  `sortby` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_submenues`
--

INSERT INTO `pow_submenues` (`Id`, `menuID`, `nombre`, `label`, `created`, `modified`, `orden`, `publicado`, `instalado`, `paginado`, `sortby`, `userID`) VALUES
(1, 1, 'ediciones', 'Ediciones', '2015-07-28 15:13:13', '2015-08-16 20:57:03', 10, 1, 1, 10, 'fecha_inicio,asc', 1),
(2, 1, 'posiciones', 'Posiciones', '2015-07-28 15:13:29', '2015-08-16 21:22:06', 20, 1, 1, 10, 'nombre,asc', 1),
(5, 2, 'categorias', 'Categorías', '2015-07-28 15:14:29', '2015-10-24 15:46:36', 1, 1, 1, 10, 'nombre,asc', 1),
(6, 2, 'notas', 'Notas', '2015-07-28 15:14:45', '2016-05-03 05:06:07', 2, 1, 1, 20, 'Id,asc', 1),
(15, 2, 'series', 'Series', '2015-10-24 00:59:30', '2015-11-01 18:11:50', 3, 1, 1, 10, 'Id,desc', 1),
(10, 4, 'productos', 'Productos ofrecidos', '2015-09-08 21:32:47', '2017-09-20 02:42:16', 1, 1, 1, 20, 'Id,desc', 1),
(11, 4, 'rubros', 'Rubros y sub-rubros', '2015-09-09 12:36:01', '2018-01-03 00:03:07', 2, 1, 1, 10, 'nombre,asc', 1),
(12, 5, 'menu', 'Panel de control', '2015-09-10 13:24:05', '2015-09-15 17:21:07', 1, 1, 1, 10, 'orden,asc', 1),
(13, 5, 'sitio_menues', 'Sitio web', '2015-09-10 13:38:39', '2015-09-21 18:15:25', 2, 1, 1, 10, 'orden,asc', 1),
(17, 8, 'users', 'Administradores', '2015-11-01 18:24:05', '2016-10-07 20:16:39', 1, 1, 1, 10, 'Id,asc', 0),
(18, 8, 'rangos', 'Rangos', '2015-11-01 18:26:09', '2015-11-01 20:26:37', 2, 1, 1, 10, 'Id,asc', 1),
(20, 9, 'preguntas', 'Encuestas', '2017-12-28 16:55:30', '2017-12-28 19:01:20', 1, 1, 0, 20, 'Id,desc', 0),
(23, 9, 'tests', 'Tests', '2018-01-02 19:35:15', '2018-01-02 21:35:20', 2, 1, 0, 20, 'Id,desc', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_subrubros`
--

CREATE TABLE `pow_subrubros` (
  `Id` int(11) NOT NULL,
  `rubroID` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `orden` int(2) NOT NULL,
  `publicado` int(1) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_subrubros`
--

INSERT INTO `pow_subrubros` (`Id`, `rubroID`, `nombre`, `descripcion`, `created`, `modified`, `orden`, `publicado`, `userID`) VALUES
(54, 11, 'Otros', '', '2019-03-07 11:28:00', '2019-03-07 14:28:11', 0, 1, 0),
(53, 11, 'Maquillaje', '', '2019-02-07 01:11:56', '2019-02-07 03:11:56', 0, 1, 0),
(52, 11, 'Manicura & pedicura', '', '2019-02-07 01:11:43', '2019-02-07 03:11:43', 0, 1, 0),
(51, 11, 'Gym & Spa', '', '2019-02-07 01:10:39', '2019-02-07 03:10:49', 0, 1, 0),
(50, 11, 'Peluquería & Barbería', '', '2019-02-07 01:10:34', '2019-02-07 03:12:29', 0, 1, 0),
(49, 8, 'Accesorios', '', '2019-02-07 01:09:57', '2019-02-07 03:09:57', 0, 1, 0),
(48, 8, 'Bijouterie', '', '2019-02-07 01:09:52', '2019-02-07 03:09:52', 0, 1, 0),
(47, 8, 'Calzados', '', '2019-02-07 01:09:19', '2019-02-07 03:09:22', 0, 1, 0),
(46, 8, 'Indumentaria', '', '2019-02-07 01:09:16', '2019-02-07 03:09:16', 0, 1, 0),
(45, 8, 'Perfumería', '', '2019-02-07 01:09:11', '2019-02-07 03:09:11', 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_users`
--

CREATE TABLE `pow_users` (
  `Id` int(11) NOT NULL,
  `user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `activo` int(1) NOT NULL,
  `rango` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_users`
--

INSERT INTO `pow_users` (`Id`, `user`, `pass`, `activo`, `rango`, `created`, `modified`, `userID`) VALUES
(1, 'Netfrank', '0a9c3ea1c55ba974f337ddfdd6db5df3', 1, 2, '0000-00-00 00:00:00', '2019-01-02 23:45:04', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_users_perfil`
--

CREATE TABLE `pow_users_perfil` (
  `Id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `imagen` varchar(36) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_users_perfil`
--

INSERT INTO `pow_users_perfil` (`Id`, `userID`, `nombre`, `apellido`, `email`, `celular`, `imagen`) VALUES
(1, 1, 'Franco D.', 'Ocaranza', 'franco@developow.net', '+5493815652833', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pow_users_permisos`
--

CREATE TABLE `pow_users_permisos` (
  `rangoID` int(11) NOT NULL,
  `menuID` int(11) NOT NULL,
  `submenuID` int(11) NOT NULL,
  `permiso` int(1) NOT NULL,
  `registros_ajenos` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pow_users_permisos`
--

INSERT INTO `pow_users_permisos` (`rangoID`, `menuID`, `submenuID`, `permiso`, `registros_ajenos`) VALUES
(3, 1, 0, 3, 0),
(3, 5, 0, 3, 0),
(3, 2, 0, 3, 0),
(3, 8, 0, 3, 0),
(3, 0, 1, 3, 0),
(3, 0, 2, 3, 0),
(3, 0, 12, 3, 0),
(3, 0, 13, 3, 0),
(3, 0, 5, 3, 0),
(3, 0, 6, 3, 0),
(3, 0, 15, 3, 0),
(3, 0, 10, 1, 0),
(3, 0, 11, 1, 0),
(3, 0, 17, 3, 0),
(3, 0, 18, 3, 0),
(5, 1, 0, 3, 0),
(5, 5, 0, 3, 0),
(5, 2, 0, 3, 0),
(5, 4, 0, 3, 0),
(5, 8, 0, 3, 0),
(5, 0, 1, 3, 0),
(5, 0, 2, 3, 0),
(5, 0, 12, 1, 0),
(5, 0, 13, 3, 0),
(5, 0, 5, 3, 0),
(5, 0, 6, 3, 0),
(5, 0, 15, 3, 0),
(5, 0, 10, 1, 0),
(5, 0, 11, 1, 0),
(5, 0, 17, 1, 0),
(5, 0, 18, 2, 0),
(7, 2, 0, 3, 0),
(7, 0, 1, 1, 0),
(7, 0, 2, 1, 0),
(7, 0, 12, 1, 0),
(7, 0, 13, 1, 0),
(7, 0, 5, 1, 0),
(7, 0, 6, 3, 0),
(7, 0, 15, 1, 0),
(7, 0, 10, 1, 0),
(7, 0, 11, 1, 0),
(7, 0, 17, 1, 0),
(7, 0, 18, 1, 0),
(6, 2, 0, 3, 0),
(6, 0, 1, 1, 0),
(6, 0, 2, 1, 0),
(6, 0, 12, 1, 0),
(6, 0, 13, 1, 0),
(6, 0, 5, 2, 0),
(6, 0, 6, 3, 0),
(6, 0, 15, 3, 0),
(6, 0, 10, 1, 0),
(6, 0, 11, 1, 0),
(6, 0, 17, 1, 0),
(6, 0, 18, 1, 0),
(8, 1, 0, 3, 0),
(8, 5, 0, 3, 0),
(8, 2, 0, 3, 0),
(8, 4, 0, 3, 0),
(8, 8, 0, 3, 0),
(8, 0, 1, 2, 1),
(8, 0, 2, 2, 1),
(8, 0, 12, 2, 1),
(8, 0, 13, 2, 1),
(8, 0, 5, 4, 0),
(8, 0, 6, 3, 1),
(8, 0, 15, 3, 1),
(8, 0, 10, 2, 1),
(8, 0, 11, 2, 1),
(8, 0, 17, 2, 1),
(8, 0, 18, 2, 1),
(4, 1, 0, 3, 0),
(4, 2, 0, 3, 0),
(4, 0, 1, 2, 1),
(4, 0, 2, 2, 1),
(4, 0, 12, 1, 0),
(4, 0, 13, 1, 0),
(4, 0, 5, 4, 1),
(4, 0, 6, 4, 1),
(4, 0, 15, 4, 1),
(4, 0, 10, 1, 0),
(4, 0, 11, 1, 0),
(4, 0, 17, 1, 0),
(4, 0, 18, 1, 0),
(2, 1, 0, 3, 0),
(2, 5, 0, 3, 0),
(2, 2, 0, 3, 0),
(2, 4, 0, 3, 0),
(2, 8, 0, 3, 0),
(2, 0, 1, 4, 1),
(2, 0, 2, 4, 1),
(2, 0, 12, 4, 1),
(2, 0, 13, 4, 1),
(2, 0, 5, 4, 1),
(2, 0, 6, 4, 1),
(2, 0, 15, 4, 1),
(2, 0, 19, 4, 1),
(2, 0, 10, 4, 1),
(2, 0, 11, 4, 1),
(2, 0, 17, 4, 1),
(2, 0, 18, 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pow_alerts`
--
ALTER TABLE `pow_alerts`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_areas`
--
ALTER TABLE `pow_areas`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_categorias`
--
ALTER TABLE `pow_categorias`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_denuncias`
--
ALTER TABLE `pow_denuncias`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_front_users`
--
ALTER TABLE `pow_front_users`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_front_users_preferences`
--
ALTER TABLE `pow_front_users_preferences`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_front_users_regalos`
--
ALTER TABLE `pow_front_users_regalos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_front_users_searches`
--
ALTER TABLE `pow_front_users_searches`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_front_users_wishlist`
--
ALTER TABLE `pow_front_users_wishlist`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_localidades`
--
ALTER TABLE `pow_localidades`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_menu`
--
ALTER TABLE `pow_menu`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_newsletter_list`
--
ALTER TABLE `pow_newsletter_list`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_notas`
--
ALTER TABLE `pow_notas`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_notas_adjuntos`
--
ALTER TABLE `pow_notas_adjuntos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_planes`
--
ALTER TABLE `pow_planes`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_rangos`
--
ALTER TABLE `pow_rangos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_regalos`
--
ALTER TABLE `pow_regalos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_reportes`
--
ALTER TABLE `pow_reportes`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_rubros`
--
ALTER TABLE `pow_rubros`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_series`
--
ALTER TABLE `pow_series`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_series_notas`
--
ALTER TABLE `pow_series_notas`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_stores`
--
ALTER TABLE `pow_stores`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_stores_items`
--
ALTER TABLE `pow_stores_items`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_stores_items_media`
--
ALTER TABLE `pow_stores_items_media`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_stores_items_offers`
--
ALTER TABLE `pow_stores_items_offers`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_stores_levels`
--
ALTER TABLE `pow_stores_levels`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_stores_locations`
--
ALTER TABLE `pow_stores_locations`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_stores_messages`
--
ALTER TABLE `pow_stores_messages`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_stores_messages_answers`
--
ALTER TABLE `pow_stores_messages_answers`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_stores_schedules`
--
ALTER TABLE `pow_stores_schedules`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_stores_shower`
--
ALTER TABLE `pow_stores_shower`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_subcategorias`
--
ALTER TABLE `pow_subcategorias`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_submenues`
--
ALTER TABLE `pow_submenues`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_subrubros`
--
ALTER TABLE `pow_subrubros`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_users`
--
ALTER TABLE `pow_users`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pow_users_perfil`
--
ALTER TABLE `pow_users_perfil`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pow_alerts`
--
ALTER TABLE `pow_alerts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pow_areas`
--
ALTER TABLE `pow_areas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pow_categorias`
--
ALTER TABLE `pow_categorias`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pow_denuncias`
--
ALTER TABLE `pow_denuncias`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pow_front_users`
--
ALTER TABLE `pow_front_users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `pow_front_users_preferences`
--
ALTER TABLE `pow_front_users_preferences`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT de la tabla `pow_front_users_regalos`
--
ALTER TABLE `pow_front_users_regalos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pow_front_users_searches`
--
ALTER TABLE `pow_front_users_searches`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT de la tabla `pow_front_users_wishlist`
--
ALTER TABLE `pow_front_users_wishlist`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT de la tabla `pow_localidades`
--
ALTER TABLE `pow_localidades`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `pow_menu`
--
ALTER TABLE `pow_menu`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pow_newsletter_list`
--
ALTER TABLE `pow_newsletter_list`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pow_notas`
--
ALTER TABLE `pow_notas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `pow_notas_adjuntos`
--
ALTER TABLE `pow_notas_adjuntos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `pow_planes`
--
ALTER TABLE `pow_planes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pow_rangos`
--
ALTER TABLE `pow_rangos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pow_regalos`
--
ALTER TABLE `pow_regalos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pow_reportes`
--
ALTER TABLE `pow_reportes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `pow_rubros`
--
ALTER TABLE `pow_rubros`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pow_series`
--
ALTER TABLE `pow_series`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pow_series_notas`
--
ALTER TABLE `pow_series_notas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pow_stores`
--
ALTER TABLE `pow_stores`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pow_stores_items`
--
ALTER TABLE `pow_stores_items`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `pow_stores_items_media`
--
ALTER TABLE `pow_stores_items_media`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT de la tabla `pow_stores_items_offers`
--
ALTER TABLE `pow_stores_items_offers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `pow_stores_levels`
--
ALTER TABLE `pow_stores_levels`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pow_stores_locations`
--
ALTER TABLE `pow_stores_locations`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pow_stores_messages`
--
ALTER TABLE `pow_stores_messages`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pow_stores_messages_answers`
--
ALTER TABLE `pow_stores_messages_answers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `pow_stores_schedules`
--
ALTER TABLE `pow_stores_schedules`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `pow_stores_shower`
--
ALTER TABLE `pow_stores_shower`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `pow_subcategorias`
--
ALTER TABLE `pow_subcategorias`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pow_submenues`
--
ALTER TABLE `pow_submenues`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `pow_subrubros`
--
ALTER TABLE `pow_subrubros`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `pow_users`
--
ALTER TABLE `pow_users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pow_users_perfil`
--
ALTER TABLE `pow_users_perfil`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
