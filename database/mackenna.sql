-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2024 a las 14:54:00
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
-- Base de datos: `mackenna`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorio_vehiculo`
--

CREATE TABLE `accesorio_vehiculo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `accesorio_vehiculo`
--

INSERT INTO `accesorio_vehiculo` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'grafico 14', '2024-08-02 20:33:17', '2024-08-02 20:33:17'),
(2, 'cadena', '2024-08-02 20:33:33', '2024-08-02 20:33:33'),
(3, 'cadena', '2024-08-02 20:33:48', '2024-08-02 20:33:48'),
(4, 'grafico 200000000', '2024-08-08 17:37:49', '2024-08-08 17:38:01'),
(5, 'Cadena', '2024-09-12 19:37:12', '2024-09-12 19:37:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('247a393975b875a887332c20a2e0c011', 'i:1;', 1722348783),
('247a393975b875a887332c20a2e0c011:timer', 'i:1722348783;', 1722348783),
('4efee42f810a26989a9a69a94bbc05ae', 'i:1;', 1722876892),
('4efee42f810a26989a9a69a94bbc05ae:timer', 'i:1722876892;', 1722876892),
('57d75013e9dfd88c4fb9cd54300991a2', 'i:1;', 1727707044),
('57d75013e9dfd88c4fb9cd54300991a2:timer', 'i:1727707044;', 1727707044),
('6a18c7c496046ee22a47b000a63c3fae', 'i:1;', 1728652282),
('6a18c7c496046ee22a47b000a63c3fae:timer', 'i:1728652282;', 1728652282),
('8a3806e84086c324f63869ba4b0f726a', 'i:1;', 1728651563),
('8a3806e84086c324f63869ba4b0f726a:timer', 'i:1728651563;', 1728651563),
('8d5c9deb6d9f6a8f95e53d6588c46b0d', 'i:1;', 1722627259),
('8d5c9deb6d9f6a8f95e53d6588c46b0d:timer', 'i:1722627259;', 1722627259),
('a56d94cdbe265a2348e86344cb40fb8d', 'i:4;', 1727529345),
('a56d94cdbe265a2348e86344cb40fb8d:timer', 'i:1727529345;', 1727529345),
('b111af360787bba6b35c5aabf7d927ae', 'i:1;', 1723821683),
('b111af360787bba6b35c5aabf7d927ae:timer', 'i:1723821683;', 1723821683),
('c3af8620b40ce6a08db02491c96039d3', 'i:1;', 1722349522),
('c3af8620b40ce6a08db02491c96039d3:timer', 'i:1722349522;', 1722349522),
('c9f34cda024bd3a086556971a9b55c7a', 'i:1;', 1727727000),
('c9f34cda024bd3a086556971a9b55c7a:timer', 'i:1727727000;', 1727727000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canal_venta`
--

CREATE TABLE `canal_venta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `pais_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `nombre`, `pais_id`, `created_at`, `updated_at`) VALUES
(1, 'Arica', '18', NULL, NULL),
(2, 'Camarones', '18', NULL, NULL),
(3, 'Putre', '18', NULL, NULL),
(4, 'General Lagos', '18', NULL, NULL),
(5, 'Iquique', '18', NULL, NULL),
(6, 'Alto Hospicio', '18', NULL, NULL),
(7, 'Pozo Almonte', '18', NULL, NULL),
(8, 'Camiña', '18', NULL, NULL),
(9, 'Colchane', '18', NULL, NULL),
(10, 'Huara', '18', NULL, NULL),
(11, 'Pica', '18', NULL, NULL),
(12, 'Antofagasta', '18', NULL, NULL),
(13, 'Mejillones', '18', NULL, NULL),
(14, 'Sierra Gorda', '18', NULL, NULL),
(15, 'Taltal', '18', NULL, NULL),
(16, 'Calama', '18', NULL, NULL),
(17, 'Ollagüe', '18', NULL, NULL),
(18, 'San Pedro de Atacama', '18', NULL, NULL),
(19, 'Tocopilla', '18', NULL, NULL),
(20, 'María Elena', '18', NULL, NULL),
(21, 'Copiapó', '18', NULL, NULL),
(22, 'Caldera', '18', NULL, NULL),
(23, 'Tierra Amarilla', '18', NULL, NULL),
(24, 'Chañaral', '18', NULL, NULL),
(25, 'Diego de Almagro', '18', NULL, NULL),
(26, 'Vallenar', '18', NULL, NULL),
(27, 'Alto del Carmen', '18', NULL, NULL),
(28, 'Freirina', '18', NULL, NULL),
(29, 'Huasco', '18', NULL, NULL),
(30, 'La Serena', '18', NULL, NULL),
(31, 'Coquimbo', '18', NULL, NULL),
(32, 'Andacollo', '18', NULL, NULL),
(33, 'La Higuera', '18', NULL, NULL),
(34, 'Paiguano', '18', NULL, NULL),
(35, 'Vicuña', '18', NULL, NULL),
(36, 'Illapel', '18', NULL, NULL),
(37, 'Canela', '18', NULL, NULL),
(38, 'Los Vilos', '18', NULL, NULL),
(39, 'Salamanca', '18', NULL, NULL),
(40, 'Ovalle', '18', NULL, NULL),
(41, 'Combarbalá', '18', NULL, NULL),
(42, 'Monte Patria', '18', NULL, NULL),
(43, 'Punitaqui', '18', NULL, NULL),
(44, 'Río Hurtado', '18', NULL, NULL),
(45, 'Valparaíso', '18', NULL, NULL),
(46, 'Casablanca', '18', NULL, NULL),
(47, 'Concón', '18', NULL, NULL),
(48, 'Juan Fernández', '18', NULL, NULL),
(49, 'Puchuncaví', '18', NULL, NULL),
(50, 'Quintero', '18', NULL, NULL),
(51, 'Viña del Mar', '18', NULL, NULL),
(52, 'Isla de Pascua', '18', NULL, NULL),
(53, 'Los Andes', '18', NULL, NULL),
(54, 'Calle Larga', '18', NULL, NULL),
(55, 'Rinconada', '18', NULL, NULL),
(56, 'San Esteban', '18', NULL, NULL),
(57, 'La Ligua', '18', NULL, NULL),
(58, 'Cabildo', '18', NULL, NULL),
(59, 'Papudo', '18', NULL, NULL),
(60, 'Petorca', '18', NULL, NULL),
(61, 'Zapallar', '18', NULL, NULL),
(62, 'Quillota', '18', NULL, NULL),
(63, 'Calera', '18', NULL, NULL),
(64, 'Hijuelas', '18', NULL, NULL),
(65, 'La Cruz', '18', NULL, NULL),
(66, 'Nogales', '18', NULL, NULL),
(67, 'San Antonio', '18', NULL, NULL),
(68, 'Algarrobo', '18', NULL, NULL),
(69, 'Cartagena', '18', NULL, NULL),
(70, 'El Quisco', '18', NULL, NULL),
(71, 'El Tabo', '18', NULL, NULL),
(72, 'Santo Domingo', '18', NULL, NULL),
(73, 'San Felipe', '18', NULL, NULL),
(74, 'Catemu', '18', NULL, NULL),
(75, 'Llaillay', '18', NULL, NULL),
(76, 'Panquehue', '18', NULL, NULL),
(77, 'Putaendo', '18', NULL, NULL),
(78, 'Santa María', '18', NULL, NULL),
(79, 'Quilpué', '18', NULL, NULL),
(80, 'Limache', '18', NULL, NULL),
(81, 'Olmué', '18', NULL, NULL),
(82, 'Villa Alemana', '18', NULL, NULL),
(83, 'Rancagua', '18', NULL, NULL),
(84, 'Codegua', '18', NULL, NULL),
(85, 'Coinco', '18', NULL, NULL),
(86, 'Coltauco', '18', NULL, NULL),
(87, 'Doñihue', '18', NULL, NULL),
(88, 'Graneros', '18', NULL, NULL),
(89, 'Las Cabras', '18', NULL, NULL),
(90, 'Machalí', '18', NULL, NULL),
(91, 'Malloa', '18', NULL, NULL),
(92, 'Mostazal', '18', NULL, NULL),
(93, 'Olivar', '18', NULL, NULL),
(94, 'Peumo', '18', NULL, NULL),
(95, 'Pichidegua', '18', NULL, NULL),
(96, 'Quinta de Tilcoco', '18', NULL, NULL),
(97, 'Rengo', '18', NULL, NULL),
(98, 'Requínoa', '18', NULL, NULL),
(99, 'San Vicente', '18', NULL, NULL),
(100, 'Pichilemu', '18', NULL, NULL),
(101, 'La Estrella', '18', NULL, NULL),
(102, 'Litueche', '18', NULL, NULL),
(103, 'Marchihue', '18', NULL, NULL),
(104, 'Navidad', '18', NULL, NULL),
(105, 'Paredones', '18', NULL, NULL),
(106, 'San Fernando', '18', NULL, NULL),
(107, 'Chépica', '18', NULL, NULL),
(108, 'Chimbarongo', '18', NULL, NULL),
(109, 'Lolol', '18', NULL, NULL),
(110, 'Nancagua', '18', NULL, NULL),
(111, 'Palmilla', '18', NULL, NULL),
(112, 'Peralillo', '18', NULL, NULL),
(113, 'Placilla', '18', NULL, NULL),
(114, 'Pumanque', '18', NULL, NULL),
(115, 'Santa Cruz', '18', NULL, NULL),
(116, 'Talca', '18', NULL, NULL),
(117, 'Constitución', '18', NULL, NULL),
(118, 'Curepto', '18', NULL, NULL),
(119, 'Empedrado', '18', NULL, NULL),
(120, 'Maule', '18', NULL, NULL),
(121, 'Pelarco', '18', NULL, NULL),
(122, 'Pencahue', '18', NULL, NULL),
(123, 'Río Claro', '18', NULL, NULL),
(124, 'San Clemente', '18', NULL, NULL),
(125, 'San Rafael', '18', NULL, NULL),
(126, 'Cauquenes', '18', NULL, NULL),
(127, 'Chanco', '18', NULL, NULL),
(128, 'Pelluhue', '18', NULL, NULL),
(129, 'Curicó', '18', NULL, NULL),
(130, 'Hualañé', '18', NULL, NULL),
(131, 'Licantén', '18', NULL, NULL),
(132, 'Molina', '18', NULL, NULL),
(133, 'Rauco', '18', NULL, NULL),
(134, 'Romeral', '18', NULL, NULL),
(135, 'Sagrada Familia', '18', NULL, NULL),
(136, 'Teno', '18', NULL, NULL),
(137, 'Vichuquén', '18', NULL, NULL),
(138, 'Linares', '18', NULL, NULL),
(139, 'Colbún', '18', NULL, NULL),
(140, 'Longaví', '18', NULL, NULL),
(141, 'Parral', '18', NULL, NULL),
(142, 'Retiro', '18', NULL, NULL),
(143, 'San Javier', '18', NULL, NULL),
(144, 'Villa Alegre', '18', NULL, NULL),
(145, 'Yerbas Buenas', '18', NULL, NULL),
(146, 'Concepción', '18', NULL, NULL),
(147, 'Coronel', '18', NULL, NULL),
(148, 'Chiguayante', '18', NULL, NULL),
(149, 'Florida', '18', NULL, NULL),
(150, 'Hualqui', '18', NULL, NULL),
(151, 'Lota', '18', NULL, NULL),
(152, 'Penco', '18', NULL, NULL),
(153, 'San Pedro de la Paz', '18', NULL, NULL),
(154, 'Santa Juana', '18', NULL, NULL),
(155, 'Talcahuano', '18', NULL, NULL),
(156, 'Tomé', '18', NULL, NULL),
(157, 'Hualpén', '18', NULL, NULL),
(158, 'Lebu', '18', NULL, NULL),
(159, 'Arauco', '18', NULL, NULL),
(160, 'Cañete', '18', NULL, NULL),
(161, 'Contulmo', '18', NULL, NULL),
(162, 'Curanilahue', '18', NULL, NULL),
(163, 'Los Álamos', '18', NULL, NULL),
(164, 'Tirúa', '18', NULL, NULL),
(165, 'Los Ángeles', '18', NULL, NULL),
(166, 'Antuco', '18', NULL, NULL),
(167, 'Cabrero', '18', NULL, NULL),
(168, 'Laja', '18', NULL, NULL),
(169, 'Mulchén', '18', NULL, NULL),
(170, 'Nacimiento', '18', NULL, NULL),
(171, 'Negrete', '18', NULL, NULL),
(172, 'Quilaco', '18', NULL, NULL),
(173, 'Quilleco', '18', NULL, NULL),
(174, 'San Rosendo', '18', NULL, NULL),
(175, 'Santa Bárbara', '18', NULL, NULL),
(176, 'Tucapel', '18', NULL, NULL),
(177, 'Yumbel', '18', NULL, NULL),
(178, 'Alto Biobío', '18', NULL, NULL),
(179, 'Chillán', '18', NULL, NULL),
(180, 'Bulnes', '18', NULL, NULL),
(181, 'Cobquecura', '18', NULL, NULL),
(182, 'Coelemu', '18', NULL, NULL),
(183, 'Coihueco', '18', NULL, NULL),
(184, 'Chillán Viejo', '18', NULL, NULL),
(185, 'El Carmen', '18', NULL, NULL),
(186, 'Ninhue', '18', NULL, NULL),
(187, 'Ñiquén', '18', NULL, NULL),
(188, 'Pemuco', '18', NULL, NULL),
(189, 'Pinto', '18', NULL, NULL),
(190, 'Portezuelo', '18', NULL, NULL),
(191, 'Quillón', '18', NULL, NULL),
(192, 'Quirihue', '18', NULL, NULL),
(193, 'Ránquil', '18', NULL, NULL),
(194, 'San Carlos', '18', NULL, NULL),
(195, 'San Fabián', '18', NULL, NULL),
(196, 'San Ignacio', '18', NULL, NULL),
(197, 'San Nicolás', '18', NULL, NULL),
(198, 'Treguaco', '18', NULL, NULL),
(199, 'Yungay', '18', NULL, NULL),
(200, 'Temuco', '18', NULL, NULL),
(201, 'Carahue', '18', NULL, NULL),
(202, 'Cunco', '18', NULL, NULL),
(203, 'Curarrehue', '18', NULL, NULL),
(204, 'Freire', '18', NULL, NULL),
(205, 'Galvarino', '18', NULL, NULL),
(206, 'Gorbea', '18', NULL, NULL),
(207, 'Lautaro', '18', NULL, NULL),
(208, 'Loncoche', '18', NULL, NULL),
(209, 'Melipeuco', '18', NULL, NULL),
(210, 'Nueva Imperial', '18', NULL, NULL),
(211, 'Padre las Casas', '18', NULL, NULL),
(212, 'Perquenco', '18', NULL, NULL),
(213, 'Pitrufquén', '18', NULL, NULL),
(214, 'Pucón', '18', NULL, NULL),
(215, 'Saavedra', '18', NULL, NULL),
(216, 'Teodoro Schmidt', '18', NULL, NULL),
(217, 'Toltén', '18', NULL, NULL),
(218, 'Vilcún', '18', NULL, NULL),
(219, 'Villarrica', '18', NULL, NULL),
(220, 'Cholchol', '18', NULL, NULL),
(221, 'Angol', '18', NULL, NULL),
(222, 'Collipulli', '18', NULL, NULL),
(223, 'Curacautín', '18', NULL, NULL),
(224, 'Ercilla', '18', NULL, NULL),
(225, 'Lonquimay', '18', NULL, NULL),
(226, 'Los Sauces', '18', NULL, NULL),
(227, 'Lumaco', '18', NULL, NULL),
(228, 'Purén', '18', NULL, NULL),
(229, 'Renaico', '18', NULL, NULL),
(230, 'Traiguén', '18', NULL, NULL),
(231, 'Victoria', '18', NULL, NULL),
(232, 'Valdivia', '18', NULL, NULL),
(233, 'Corral', '18', NULL, NULL),
(234, 'Lanco', '18', NULL, NULL),
(235, 'Los Lagos', '18', NULL, NULL),
(236, 'Máfil', '18', NULL, NULL),
(237, 'Mariquina', '18', NULL, NULL),
(238, 'Paillaco', '18', NULL, NULL),
(239, 'Panguipulli', '18', NULL, NULL),
(240, 'La Unión', '18', NULL, NULL),
(241, 'Futrono', '18', NULL, NULL),
(242, 'Lago Ranco', '18', NULL, NULL),
(243, 'Río Bueno', '18', NULL, NULL),
(244, 'Puerto Montt', '18', NULL, NULL),
(245, 'Calbuco', '18', NULL, NULL),
(246, 'Cochamó', '18', NULL, NULL),
(247, 'Fresia', '18', NULL, NULL),
(248, 'Frutillar', '18', NULL, NULL),
(249, 'Los Muermos', '18', NULL, NULL),
(250, 'Llanquihue', '18', NULL, NULL),
(251, 'Maullín', '18', NULL, NULL),
(252, 'Puerto Varas', '18', NULL, NULL),
(253, 'Castro', '18', NULL, NULL),
(254, 'Ancud', '18', NULL, NULL),
(255, 'Chonchi', '18', NULL, NULL),
(256, 'Curaco de Vélez', '18', NULL, NULL),
(257, 'Dalcahue', '18', NULL, NULL),
(258, 'Puqueldón', '18', NULL, NULL),
(259, 'Queilén', '18', NULL, NULL),
(260, 'Quellón', '18', NULL, NULL),
(261, 'Quemchi', '18', NULL, NULL),
(262, 'Quinchao', '18', NULL, NULL),
(263, 'Osorno', '18', NULL, NULL),
(264, 'Puerto Octay', '18', NULL, NULL),
(265, 'Purranque', '18', NULL, NULL),
(266, 'Puyehue', '18', NULL, NULL),
(267, 'Río Negro', '18', NULL, NULL),
(268, 'San Juan de la Costa', '18', NULL, NULL),
(269, 'San Pablo', '18', NULL, NULL),
(270, 'Chaitén', '18', NULL, NULL),
(271, 'Futaleufú', '18', NULL, NULL),
(272, 'Hualaihué', '18', NULL, NULL),
(273, 'Palena', '18', NULL, NULL),
(274, 'Coyhaique', '18', NULL, NULL),
(275, 'Lago Verde', '18', NULL, NULL),
(276, 'Aysén', '18', NULL, NULL),
(277, 'Cisnes', '18', NULL, NULL),
(278, 'Guaitecas', '18', NULL, NULL),
(279, 'Cochrane', '18', NULL, NULL),
(280, 'O’Higgins', '18', NULL, NULL),
(281, 'Tortel', '18', NULL, NULL),
(282, 'Chile Chico', '18', NULL, NULL),
(283, 'Río Ibáñez', '18', NULL, NULL),
(284, 'Punta Arenas', '18', NULL, NULL),
(285, 'Laguna Blanca', '18', NULL, NULL),
(286, 'Río Verde', '18', NULL, NULL),
(287, 'San Gregorio', '18', NULL, NULL),
(288, 'Cabo de Hornos', '18', NULL, NULL),
(289, 'Antártica', '18', NULL, NULL),
(290, 'Porvenir', '18', NULL, NULL),
(291, 'Primavera', '18', NULL, NULL),
(292, 'Timaukel', '18', NULL, NULL),
(293, 'Natales', '18', NULL, NULL),
(294, 'Torres del Paine', '18', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `tipo_cliente` varchar(255) DEFAULT NULL,
  `tipo_documento` int(11) DEFAULT NULL,
  `numero_documento` varchar(255) NOT NULL,
  `municipio` int(11) DEFAULT NULL,
  `paisn` int(11) DEFAULT NULL,
  `fachadoc` date DEFAULT NULL,
  `fachacadoc` date DEFAULT NULL,
  `numero_carnet` varchar(255) DEFAULT NULL,
  `ciudad_carnet` int(11) DEFAULT NULL,
  `pais_carnet` int(11) DEFAULT NULL,
  `fachacarnet` date DEFAULT NULL,
  `fachacacarnet` date DEFAULT NULL,
  `tipo_carnet` int(11) DEFAULT NULL,
  `ciudad_nacido` int(11) DEFAULT NULL,
  `pais_nacido` int(11) DEFAULT NULL,
  `fachanacido` date DEFAULT NULL,
  `incidencias` varchar(255) DEFAULT NULL,
  `numero_contacto` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `canal` int(11) DEFAULT NULL,
  `pais` int(11) DEFAULT NULL,
  `documentos2` longtext DEFAULT NULL,
  `direccionh` varchar(255) DEFAULT NULL,
  `codigo_postalh` int(11) DEFAULT NULL,
  `ciudadh` int(11) DEFAULT NULL,
  `pais_nacidoh` int(11) DEFAULT NULL,
  `direccionl` varchar(255) DEFAULT NULL,
  `codigo_postallocal` int(11) DEFAULT NULL,
  `ciudadl` int(11) DEFAULT NULL,
  `pais_nacidol` int(11) DEFAULT NULL,
  `clienteempresa` int(11) DEFAULT NULL,
  `incluir_mailing` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `medio_pago` varchar(255) DEFAULT NULL,
  `observaciones` varchar(255) DEFAULT NULL,
  `avisos` varchar(255) DEFAULT NULL,
  `canales_restringidos` varchar(500) DEFAULT NULL,
  `consentimiento` varchar(255) DEFAULT NULL,
  `fechas` varchar(255) DEFAULT NULL,
  `idiomas` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `cuenta_contable` int(11) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `consentimiento_fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `name`, `tipo_cliente`, `tipo_documento`, `numero_documento`, `municipio`, `paisn`, `fachadoc`, `fachacadoc`, `numero_carnet`, `ciudad_carnet`, `pais_carnet`, `fachacarnet`, `fachacacarnet`, `tipo_carnet`, `ciudad_nacido`, `pais_nacido`, `fachanacido`, `incidencias`, `numero_contacto`, `email`, `canal`, `pais`, `documentos2`, `direccionh`, `codigo_postalh`, `ciudadh`, `pais_nacidoh`, `direccionl`, `codigo_postallocal`, `ciudadl`, `pais_nacidol`, `clienteempresa`, `incluir_mailing`, `estado`, `medio_pago`, `observaciones`, `avisos`, `canales_restringidos`, `consentimiento`, `fechas`, `idiomas`, `created_at`, `cuenta_contable`, `apellido`, `genero`, `updated_at`, `consentimiento_fecha`) VALUES
(2, 'Aline England', '6', 3, '1006320237', 17, 22, '1972-02-27', '1986-11-25', '1006320237', 16, 18, '2008-04-04', '2022-04-05', 1, 19, 18, '2017-02-01', NULL, '3046405009', 'myvenak@mailinator.com', NULL, 18, '[]', 'Voluptatem eveniet nemo est iure volup', 762501, 20, 18, 'Voluptatem eveniet nemo est iure volup', 762502, 18, 18, 17, 1, 0, 'paypal', 'Mundo', 'Hola', '[\"\\u00bfPermite contactar v\\u00eda mailing?\",\"\\u00bfPermite contactar v\\u00eda email?\",\"\\u00bfPermite contactar v\\u00eda telefono?\",\"\\u00bfPermite contactar v\\u00eda SMS?\",\"\\u00bfPermite contactar v\\u00eda WhatsApp?\",\"\\u00bfPermite contactar v\\u00eda redes sociales?\"]', '[\"\\u00bfHa firmado un consentimiento?\",\"\\u00bfEl consentimiento est\\u00e1 impreso?\"]', '[\"2024-09-11\",\"2024-09-11\",\"2024-09-10\",\"2024-09-11\"]', 8, '2024-09-11 18:34:36', 412, 'Sunt porro architecto eu dolo', 'Femenino', '2024-09-12 00:34:17', '2017-02-01'),
(3, 'Elizabeth Gibbs', '6', 1, '6466271-6', 14, 17, '2011-10-22', '2011-10-29', '6466271-6', 16, 18, '1979-05-25', '2017-08-12', 2, 13, 18, '1995-05-12', NULL, '+3046405009', 'zyre@mailinator.com', NULL, 18, '[]', 'Dolor omnis dolores doloribus sed neque', 762501, 12, 18, 'Dolor omnis dolores doloribus sed neque', 762502, 13, 18, NULL, 1, 1, 'khipu', 'Mudno', 'print', '[\"\\u00bfPermite contactar v\\u00eda mailing?\",\"\\u00bfPermite contactar v\\u00eda email?\",\"\\u00bfPermite contactar v\\u00eda telefono?\",\"\\u00bfPermite contactar v\\u00eda SMS?\",\"\\u00bfPermite contactar v\\u00eda WhatsApp?\",\"\\u00bfPermite contactar v\\u00eda redes sociales?\"]', '[\"\\u00bfHa firmado un consentimiento?\"]', '[\"2024-09-10\",\"2024-09-11\",\"2024-09-11\",\"2024-09-11\"]', 1, '2024-09-11 23:41:33', 178, 'Qui exercitationem omnis dolor', 'Masculino', '2024-09-12 00:34:53', '2024-09-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_empresa`
--

CREATE TABLE `clientes_empresa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `tipo_cliente` varchar(255) DEFAULT NULL,
  `cuenta_contable` varchar(255) DEFAULT NULL,
  `razon_social` varchar(255) DEFAULT NULL,
  `sector_economico` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `codigo_postal` varchar(255) DEFAULT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `tipo_documento` varchar(255) DEFAULT NULL,
  `numero_documento` varchar(255) DEFAULT NULL,
  `pais_documento` varchar(255) DEFAULT NULL,
  `persona_contacto` varchar(255) DEFAULT NULL,
  `numero_contacto` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `sucursal` varchar(255) DEFAULT NULL,
  `idiomas` varchar(255) DEFAULT NULL,
  `observaciones` varchar(255) DEFAULT NULL,
  `medio_pago` varchar(255) DEFAULT NULL,
  `dias_credito` int(11) DEFAULT NULL,
  `canal` varchar(255) DEFAULT NULL,
  `vent_dia` varchar(255) DEFAULT NULL,
  `vehiculo_propio` varchar(255) DEFAULT NULL,
  `acuerdos` varchar(255) DEFAULT NULL,
  `opciones` varchar(255) DEFAULT NULL,
  `tarifas` varchar(2550) DEFAULT NULL,
  `documento` varchar(255) DEFAULT NULL,
  `documentos2` varchar(2550) DEFAULT NULL,
  `documento3` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado_cliente` varchar(45) DEFAULT 'Activo',
  `extras` varchar(2550) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes_empresa`
--

INSERT INTO `clientes_empresa` (`id`, `name`, `tipo_cliente`, `cuenta_contable`, `razon_social`, `sector_economico`, `direccion`, `codigo_postal`, `municipio`, `pais`, `provincia`, `tipo_documento`, `numero_documento`, `pais_documento`, `persona_contacto`, `numero_contacto`, `email`, `web`, `sucursal`, `idiomas`, `observaciones`, `medio_pago`, `dias_credito`, `canal`, `vent_dia`, `vehiculo_propio`, `acuerdos`, `opciones`, `tarifas`, `documento`, `documentos2`, `documento3`, `created_at`, `updated_at`, `estado_cliente`, `extras`) VALUES
(17, 'Carlos', NULL, 'dsgfgfgd', 'dsdgsgsfd', '1', 'Calle10', '762501', '5', '18', NULL, '1', '1006320237', '14', '[\"Alejandro\"]', '[\"304645009\"]', 'jorjecasanova@gmail.com', NULL, '3', '5', 'dsfgsg', 'tarjeta_credito', 90, '12', '100', '0', NULL, '[\"Es un arrendatario\",\"Incluir Importes a facturar en contrato\",\"Facturaci\\u00f3n Agrupada\",\"Facturaci\\u00f3n a mes anticipado\"]', '[\"6\"]', NULL, '[\"1725488693_deslizante.png\",\"1725543265_621d278fd2b54d75cc3c87ecf9b88c32.gif\"]', NULL, '2024-09-05 01:51:42', '2024-09-05 18:34:25', 'Activo', '[\"4\"]'),
(18, 'Jeremy Munoz', '4', 'Nam officia accusamu', 'Optio impedit est', '5', 'Soluta error aliquam impe', '9', '10', '18', NULL, '1', '11494249-9', '19', '[\"Alejandro\"]', '[\"+3046405009\"]', 'dido@mailinator.com', 'https://jqueryrut.sourceforge.net/generador-de-rut.html', '3', '1', NULL, NULL, NULL, NULL, NULL, '1', NULL, '[\"Es un arrendatario\",\"Incluir Importes a facturar en contrato\",\"Facturaci\\u00f3n a mes anticipado\"]', '[\"12\"]', NULL, '[]', NULL, '2024-09-09 19:51:08', '2024-09-10 23:08:51', 'Activo', '[\"4\"]'),
(19, 'Abbot Prices', '4', 'Perferendis odio nis', 'Dolorem ipsum deseru', '1', 'Mollitia tempora nisi qua', '762501', '4', '18', NULL, '1', '18714183-4', '18', '[\"Laborum qui dui\"]', '[\"+3046405009\"]', 'coqibos@mailinator.com', 'https://music.youtube.com/', '1', '1', NULL, NULL, NULL, NULL, NULL, '1', NULL, '[\"Es un arrendatario\",\"Incluir Importes a facturar en contrato\",\"Facturaci\\u00f3n a mes anticipado\"]', '[\"13\"]', NULL, '[]', NULL, '2024-09-10 18:43:58', '2024-09-12 00:37:39', 'Activo', '[\"4\"]'),
(20, 'Mikayla Morrow', '4', '23432545', 'Ut alias eos delectu', '4', 'Alias veniam rerum paria', '762501', '6', '18', NULL, '1', '14187909-k', '18', '[\"Nam mollit amet\"]', '[\"+573046405009\"]', 'lusevifiq@mailinator.com', 'https://www.youtube.com/', '1', '1', NULL, NULL, NULL, NULL, NULL, '0', NULL, '[\"Es un arrendatario\",\"Incluir Importes a facturar en contrato\",\"Facturaci\\u00f3n a mes anticipado\"]', '[\"18\",\"19\"]', NULL, '[\"1726433981_20220419_163739.jpg\"]', NULL, '2024-09-16 01:18:59', '2024-09-17 14:34:43', '1', '[\"4\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipamiento_vehiculo`
--

CREATE TABLE `equipamiento_vehiculo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `equipamiento_vehiculo`
--

INSERT INTO `equipamiento_vehiculo` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'equipamiento 1', '2024-08-02 18:47:30', '2024-08-02 18:47:30'),
(2, 'equipamiento 2', '2024-08-02 18:47:45', '2024-08-02 18:47:45'),
(3, 'equipamiento 3', '2024-08-02 18:47:57', '2024-08-02 18:47:57'),
(4, 'equipamiento 4', '2024-08-02 18:48:07', '2024-08-02 18:48:07'),
(5, 'equipamiento 5', '2024-08-02 18:48:20', '2024-08-02 18:48:20'),
(11, 'Equipamiento 8', '2024-08-02 21:42:40', '2024-08-02 21:42:40'),
(12, 'CardPlay', '2024-09-12 19:36:43', '2024-09-12 19:36:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_vehiculo`
--

CREATE TABLE `estado_vehiculo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extra_cliente`
--

CREATE TABLE `extra_cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `porcentaje` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `extra_cliente`
--

INSERT INTO `extra_cliente` (`id`, `nombre`, `porcentaje`, `updated_at`, `created_at`) VALUES
(3, 'Extra1', '2', '2024-09-10 17:34:44', '2024-08-21 18:19:16'),
(4, 'Extra2', '3', '2024-09-10 17:34:49', '2024-08-21 18:19:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grafico_vehiculo`
--

CREATE TABLE `grafico_vehiculo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ruta_archivo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grafico_vehiculo`
--

INSERT INTO `grafico_vehiculo` (`id`, `nombre`, `ruta_archivo`, `created_at`, `updated_at`) VALUES
(6, '4x4', '1725415962.jpg', '2024-09-04 07:12:42', '2024-09-04 07:12:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_vehiculo`
--

CREATE TABLE `grupo_vehiculo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo_vehiculo`
--

INSERT INTO `grupo_vehiculo` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(2, 'SUV', '2024-09-02 02:26:12', '2024-09-10 17:42:09'),
(3, 'Turismo', '2024-09-02 02:27:34', '2024-09-10 17:42:13'),
(6, 'Band', '2024-09-12 19:19:02', '2024-09-12 19:19:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomas`
--

CREATE TABLE `idiomas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `idiomas`
--

INSERT INTO `idiomas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Español', NULL, NULL),
(2, 'Inglés', NULL, NULL),
(3, 'Francés', NULL, NULL),
(4, 'Portugués', NULL, NULL),
(5, 'Alemán', NULL, NULL),
(6, 'Italiano', NULL, NULL),
(7, 'Chino', NULL, NULL),
(8, 'Japonés', NULL, NULL),
(9, 'Coreano', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llave_vehiculo`
--

CREATE TABLE `llave_vehiculo` (
  `id` int(11) NOT NULL,
  `placa` varchar(255) DEFAULT NULL,
  `llave` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `sucursal` varchar(255) DEFAULT NULL,
  `grupo` varchar(255) DEFAULT NULL,
  `tipo_combustible` varchar(255) DEFAULT NULL,
  `capacidad_combustible` varchar(255) DEFAULT NULL,
  `tipo_caja` varchar(255) DEFAULT NULL,
  `tipo_vehiculo` varchar(255) DEFAULT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `codigo_qr` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `chasis` varchar(255) DEFAULT NULL,
  `color` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `llave_vehiculo`
--

INSERT INTO `llave_vehiculo` (`id`, `placa`, `llave`, `modelo`, `sucursal`, `grupo`, `tipo_combustible`, `capacidad_combustible`, `tipo_caja`, `tipo_vehiculo`, `marca`, `codigo_qr`, `created_at`, `updated_at`, `chasis`, `color`) VALUES
(28, 'LXW017', 'A01', 'X4', 'Rac portales', 'B', 'Gasolina', '65', 'Automática', '3', 'BMW', 'graficos/28.png', '2024-10-10 16:55:53', '2024-10-10 16:55:54', '23454546', 'blanco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca_vehiculo`
--

CREATE TABLE `marca_vehiculo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marca_vehiculo`
--

INSERT INTO `marca_vehiculo` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'BMW', '2024-07-19 13:54:42', '2024-07-19 13:54:42'),
(2, 'Toyota', '2024-07-23 20:24:09', '2024-07-23 20:24:09'),
(5, 'SUZUKI', '2024-09-30 21:09:55', '2024-09-30 21:09:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(20, '0001_01_01_000000_create_users_table', 1),
(21, '0001_01_01_000001_create_cache_table', 1),
(22, '0001_01_01_000002_create_jobs_table', 1),
(23, '2024_07_17_184139_add_two_factor_columns_to_users_table', 1),
(24, '2024_07_17_184203_create_personal_access_tokens_table', 1),
(25, '2024_07_17_184410_add_fields_to_users_table', 1),
(26, '2024_07_17_192236_create_tipo_documento_table', 1),
(27, '2024_07_17_192247_create_user_groups_table', 1),
(28, '2024_07_17_192252_create_tipo_vehiculos_table', 1),
(29, '2024_07_17_192256_create_marca_vehiculo_table', 1),
(30, '2024_07_17_204011_create_permisos_table', 1),
(31, '2024_07_18_133646_create_equipamiento_vehiculo_table', 1),
(32, '2024_07_18_133712_create_accesorio_vehiculo_table', 1),
(33, '2024_07_18_133725_create_tipo_combustible_table', 1),
(34, '2024_07_18_133738_create_tipo_caja_table', 1),
(35, '2024_07_18_133815_create_tipo_itv_table', 1),
(36, '2024_07_18_133828_create_estado_vehiculo_table', 1),
(37, '2024_07_18_133847_create_grafico_vehiculo_table', 1),
(38, '2024_07_18_134437_create_modelo_vehiculo_table', 1),
(39, '2024_07_20_204839_create_tarifas_table', 2),
(40, '2024_07_20_232820_add_modulo_to_permisos_table', 2),
(41, '2024_07_24_162350_create_clientes_table', 3),
(42, '2024_07_24_163720_create_clientes_empresa_table', 3),
(43, '2024_07_25_184045_create_paises_table', 4),
(44, '2024_07_25_191854_create_idiomas_table', 4),
(45, '2024_07_25_193337_create_sector_comercial_table', 4),
(46, '2024_07_30_151650_create_sucursales_table', 5),
(47, '2024_07_30_152043_create_ciudades_table', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo_vehiculo`
--

CREATE TABLE `modelo_vehiculo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `tipo_combustible` varchar(255) DEFAULT NULL,
  `capacidad_combustible` varchar(255) DEFAULT NULL,
  `tipo_caja` varchar(255) DEFAULT NULL,
  `equipamiento_vehiculo` varchar(255) DEFAULT NULL,
  `accesorio_vehiculo` varchar(255) DEFAULT NULL,
  `tipo_itv` varchar(255) DEFAULT NULL,
  `grafico_vehiculo_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_vehiculo` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modelo_vehiculo`
--

INSERT INTO `modelo_vehiculo` (`id`, `nombre`, `tipo_combustible`, `capacidad_combustible`, `tipo_caja`, `equipamiento_vehiculo`, `accesorio_vehiculo`, `tipo_itv`, `grafico_vehiculo_id`, `created_at`, `updated_at`, `tipo_vehiculo`, `marca`, `grupo`) VALUES
(2, 'CX50', '1', '65', '2', '[\"1\",\"2\",\"4\"]', '[\"1\",\"2\",\"3\"]', '1', '6', '2024-08-05 01:34:57', '2024-09-14 20:22:00', '\"2\"', '2', 3),
(3, 'CX30', '1', '30', '1', '\"[\\\"1\\\"]\"', '\"[\\\"1\\\",\\\"2\\\",\\\"3\\\"]\"', '1', '1', '2024-08-05 01:35:21', '2024-08-05 13:42:01', '0', '2', 3),
(4, 'I3', '1', '20', '2', '\"[\\\"1\\\",\\\"2\\\"]\"', '\"[\\\"1\\\",\\\"2\\\",\\\"3\\\"]\"', '1', '1', '2024-08-05 04:13:02', '2024-08-05 13:41:36', '0', '1', 2),
(5, 'i5', '1', '60', '2', '\"[\\\"2\\\"]\"', '\"[\\\"1\\\",\\\"2\\\",\\\"3\\\"]\"', '1', '1', '2024-08-05 04:18:43', '2024-08-05 13:41:52', '0', '1', 2),
(6, 'tractor', '3', '8', '2', '[\"1\"]', '[\"1\",\"2\"]', '2', '1', '2024-08-07 20:00:57', '2024-08-16 13:22:44', '0', '2', 3),
(8, 'test', '2', '1', '2', '[]', '[\"2\"]', '2', '6', '2024-08-07 20:05:50', '2024-09-05 22:13:23', '\"3\"', '2', 3),
(10, 'URUS', '1', '120', '2', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"11\"]', '[\"1\",\"2\",\"3\",\"4\"]', '1', '5', '2024-09-02 02:44:43', '2024-09-02 02:50:26', '\"2\"', '1', 2),
(11, 'X4', '1', '65', '2', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"11\",\"12\"]', NULL, '1', '6', '2024-09-14 20:26:59', '2024-09-14 20:27:12', '\"3\"', '1', 3),
(12, 'SPRESSO', '1', '35', '1', '[\"1\"]', NULL, '1', '6', '2024-09-30 21:10:46', '2024-09-30 21:10:46', '\"3\"', '5', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Albania', NULL, NULL),
(2, 'Alemania', NULL, NULL),
(3, 'Andorra', NULL, NULL),
(4, 'Argentina', NULL, NULL),
(5, 'Armenia', NULL, NULL),
(6, 'Austria', NULL, NULL),
(7, 'Azerbaiyán', NULL, NULL),
(8, 'Bahamas', NULL, NULL),
(9, 'Barbados', NULL, NULL),
(10, 'Belice', NULL, NULL),
(11, 'Bélgica', NULL, NULL),
(12, 'Bielorrusia', NULL, NULL),
(13, 'Bolivia', NULL, NULL),
(14, 'Bosnia y Herzegovina', NULL, NULL),
(15, 'Brasil', NULL, NULL),
(16, 'Bulgaria', NULL, NULL),
(17, 'Canadá', NULL, NULL),
(18, 'Chile', NULL, NULL),
(19, 'Chipre', NULL, NULL),
(20, 'Colombia', NULL, NULL),
(21, 'Costa Rica', NULL, NULL),
(22, 'Croacia', NULL, NULL),
(23, 'Cuba', NULL, NULL),
(24, 'Dinamarca', NULL, NULL),
(25, 'Dominica', NULL, NULL),
(26, 'Ecuador', NULL, NULL),
(27, 'El Salvador', NULL, NULL),
(28, 'Eslovaquia', NULL, NULL),
(29, 'Eslovenia', NULL, NULL),
(30, 'España', NULL, NULL),
(31, 'Estados Unidos', NULL, NULL),
(32, 'Estonia', NULL, NULL),
(33, 'Finlandia', NULL, NULL),
(34, 'Francia', NULL, NULL),
(35, 'Georgia', NULL, NULL),
(36, 'Granada', NULL, NULL),
(37, 'Grecia', NULL, NULL),
(38, 'Guatemala', NULL, NULL),
(39, 'Guyana', NULL, NULL),
(40, 'Haití', NULL, NULL),
(41, 'Honduras', NULL, NULL),
(42, 'Hungría', NULL, NULL),
(43, 'Irlanda', NULL, NULL),
(44, 'Islandia', NULL, NULL),
(45, 'Italia', NULL, NULL),
(46, 'Jamaica', NULL, NULL),
(47, 'Kazajistán', NULL, NULL),
(48, 'Letonia', NULL, NULL),
(49, 'Liechtenstein', NULL, NULL),
(50, 'Lituania', NULL, NULL),
(51, 'Luxemburgo', NULL, NULL),
(52, 'Macedonia del Norte', NULL, NULL),
(53, 'Malta', NULL, NULL),
(54, 'México', NULL, NULL),
(55, 'Moldavia', NULL, NULL),
(56, 'Mónaco', NULL, NULL),
(57, 'Montenegro', NULL, NULL),
(58, 'Nicaragua', NULL, NULL),
(59, 'Noruega', NULL, NULL),
(60, 'Países Bajos', NULL, NULL),
(61, 'Panamá', NULL, NULL),
(62, 'Paraguay', NULL, NULL),
(63, 'Perú', NULL, NULL),
(64, 'Polonia', NULL, NULL),
(65, 'Portugal', NULL, NULL),
(66, 'Reino Unido', NULL, NULL),
(67, 'República Checa', NULL, NULL),
(68, 'República Dominicana', NULL, NULL),
(69, 'Rumania', NULL, NULL),
(70, 'Rusia', NULL, NULL),
(71, 'San Cristóbal y Nieves', NULL, NULL),
(72, 'San Marino', NULL, NULL),
(73, 'San Vicente y las Granadinas', NULL, NULL),
(74, 'Santa Lucía', NULL, NULL),
(75, 'Serbia', NULL, NULL),
(76, 'Suecia', NULL, NULL),
(77, 'Suiza', NULL, NULL),
(78, 'Surinam', NULL, NULL),
(79, 'Trinidad y Tobago', NULL, NULL),
(80, 'Ucrania', NULL, NULL),
(81, 'Uruguay', NULL, NULL),
(82, 'Vaticano', NULL, NULL),
(83, 'Venezuela', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('ale132402@hotmail.com', '$2y$12$pO6SVzcpNVQNiUB4kWGo7Of4iWWT/MXtrhxJRCF./61UN38Kt1z2a', '2024-07-23 19:07:18'),
('ale241302@gmail.com', '$2y$12$/Mt2uLbCxEjbjRZJfDIMEej/xFI/.ysiTDIZwpw2QvZ0va4bshjSW', '2024-09-30 15:10:57'),
('jorjecasanova@gmail.com', '$2y$12$gEnZ7GMbhNZ75hfvosA0zOSEyb/3b0jFGOCFnK0mDd1j2C2CY9xO6', '2024-09-30 14:15:43'),
('jose@gmail.com', '$2y$12$9vXYVW7n4ItpUbTCfjpYj.S3P2yFRctFbPLfhLnjPm.Nn3L0YAxC6', '2024-07-30 19:25:21'),
('lusevifiq@mailinator.com', '$2y$12$8ftKA2NkCZe6Wb.2YKMZSuOMHVNd7/OXIQZxq/Qv/SO.jUlXJ/Cai', '2024-09-16 01:19:00'),
('tomas.mogrovejo.acosta@gmail.com', '$2y$12$AsZjrQz3TC.E83aFWEPNvevHoHNMykA7Zk4R8F2PY2g1plZNUq.Pa', '2024-07-22 19:52:12'),
('zyre@mailinator.com', '$2y$12$WXQAsYRTxpPJElKimbOuW.P6jU3BX1DL3hBx539I1hsdtgl7wX9bK', '2024-09-11 23:41:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `modulo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`, `modulo`, `created_at`, `updated_at`) VALUES
(1, 'crear marca', 'vehículos', '2024-07-19 19:49:57', '2024-07-19 19:49:57'),
(2, 'ver marca', 'vehículos', '2024-07-19 19:49:57', '2024-07-19 19:49:57'),
(3, 'editar marca', 'vehículos', '2024-07-19 19:49:57', '2024-07-19 19:49:57'),
(4, 'eliminar marca', 'vehículos', '2024-07-19 19:49:57', '2024-07-19 19:49:57'),
(5, 'crear clase vehículo', 'vehículos', '2024-07-19 19:49:57', '2024-07-19 19:49:57'),
(6, 'editar clase vehículo', 'vehículos', '2024-07-19 19:49:57', '2024-07-19 19:49:57'),
(7, 'ver clase vehículo', 'vehículos', '2024-07-19 19:49:57', '2024-07-19 19:49:57'),
(8, 'eliminar clase vehículo', 'vehículos', '2024-07-19 19:49:57', '2024-07-19 19:49:57'),
(9, 'crear roles', 'usuario', '2024-07-19 19:49:57', '2024-07-19 19:49:57'),
(10, 'ver roles', 'usuario', '2024-07-19 19:49:57', '2024-07-19 19:49:57'),
(11, 'editar roles', 'usuario', '2024-07-19 19:49:57', '2024-07-19 19:49:57'),
(12, 'eliminar roles', 'usuario', '2024-07-19 19:49:57', '2024-07-19 19:49:57'),
(13, 'crear tarifa', 'tarifa', NULL, NULL),
(14, 'ver tarifa', 'tarifa', NULL, NULL),
(15, 'editar tarifa', 'tarifa', NULL, NULL),
(16, 'eliminar tarifa', 'tarifa', NULL, NULL),
(17, 'ver usuario', 'usuario', NULL, NULL),
(18, 'crear usuario', 'usuario', NULL, NULL),
(19, 'editar usuario', 'usuario', NULL, NULL),
(20, 'eliminar usuario', 'usuario', NULL, NULL),
(21, 'ver sucursal', 'sucursal', NULL, NULL),
(22, 'crear sucursal', 'sucursal', NULL, NULL),
(23, 'editar sucursal', 'sucursal', NULL, NULL),
(24, 'eliminar sucursal', 'sucursal', NULL, NULL),
(25, 'ver accesorios', 'vehículos', NULL, NULL),
(26, 'crear accesorios', 'vehículos', NULL, NULL),
(27, 'editar accesorios', 'vehículos', NULL, NULL),
(28, 'eliminar accesorios', 'vehículos', NULL, NULL),
(29, 'ver equipamientos', 'vehículos', NULL, NULL),
(30, 'crear equipamientos', 'vehículos', NULL, NULL),
(31, 'editar equipamientos', 'vehículos', NULL, NULL),
(32, 'eliminar equipamientos', 'vehículos', NULL, NULL),
(33, 'ver graficos', 'vehículos', NULL, NULL),
(34, 'crear graficos', 'vehículos', NULL, NULL),
(35, 'editar graficos', 'vehículos', NULL, NULL),
(36, 'eliminar graficos', 'vehículos', NULL, NULL),
(37, 'ver modelos', 'vehículos', NULL, NULL),
(38, 'crear modelos', 'vehículos', NULL, NULL),
(39, 'editar modelos', 'vehículos', NULL, NULL),
(40, 'eliminar modelos', 'vehículos', NULL, NULL),
(41, 'ver flota', 'vehículos', NULL, NULL),
(42, 'crear flota', 'vehículos', NULL, NULL),
(43, 'editar flota', 'vehículos', NULL, NULL),
(44, 'eliminar flota', 'vehículos', NULL, NULL),
(45, 'ver llavero', 'vehículos', NULL, NULL),
(46, 'crear llave', 'vehículos', NULL, NULL),
(47, 'eliminar llave', 'vehículos', NULL, NULL),
(48, 'Ver Tarifa Cliente', 'usuario', NULL, NULL),
(49, 'Crear Tarifa Cliente', 'usuario', NULL, NULL),
(50, 'Editar Tarifa Cliente', 'usuario', NULL, NULL),
(51, 'Eliminar Tarifa Cliente', 'usuario', NULL, NULL),
(52, 'Ver Extra Cliente', 'usuario', NULL, NULL),
(53, 'Crear Extra Cliente', 'usuario', NULL, NULL),
(54, 'Editar Extra Cliente', 'usuario', NULL, NULL),
(55, 'Eliminar Extra Cliente', 'usuario', NULL, NULL),
(56, 'ver tipo vehículo', 'vehículos', NULL, NULL),
(57, 'crear tipo vehículo', 'vehículos', NULL, NULL),
(58, 'editar tipo vehículo', 'vehículos', NULL, NULL),
(59, 'eliminar tipo vehículo', 'vehículos', NULL, NULL),
(60, 'Ver Cliente', 'Cliente Empresa', NULL, NULL),
(61, 'Crear Cliente', 'Cliente Empresa', NULL, NULL),
(62, 'Editar Cliente', 'Cliente Empresa', NULL, NULL),
(63, 'Eliminar Cliente', 'Cliente Empresa', NULL, NULL),
(64, 'Ver Carnet', 'usuario', NULL, NULL),
(65, 'Crear Carnet', 'usuario', NULL, NULL),
(66, 'Editar Carnet', 'usuario', NULL, NULL),
(67, 'Eliminar Carnet', 'usuario', NULL, NULL),
(68, 'Ver Proveedores', 'Proveedor', NULL, NULL),
(69, 'Crear Proveedores', 'Proveedor', NULL, NULL),
(70, 'Editar Proveedores', 'Proveedor', NULL, NULL),
(71, 'Eliminar Proveedores', 'Proveedor', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'authToken', '84eccdd2c855528516b1681b3ca839cc98a499634b37953b8399fcd0076ac982', '[\"*\"]', NULL, NULL, '2024-10-09 18:55:49', '2024-10-09 18:55:49'),
(2, 'App\\Models\\User', 2, 'authToken', 'f4945edc7bd7c41af4d042d6fe48e15467aa3dc2103f3544d3c85b22c282aa70', '[\"*\"]', NULL, NULL, '2024-10-09 19:23:51', '2024-10-09 19:23:51'),
(3, 'App\\Models\\User', 2, 'authToken', '34dcfc2d1d0a05cf9ae41c9beb55daf941db92caec8c135f9ab95409585a8663', '[\"*\"]', NULL, NULL, '2024-10-09 19:54:19', '2024-10-09 19:54:19'),
(4, 'App\\Models\\User', 2, 'authToken', 'ec86373cc15a1ef873e55c4af156cc1ca726845f498b8227e4cf9a21c6c27ae6', '[\"*\"]', NULL, NULL, '2024-10-09 19:55:18', '2024-10-09 19:55:18'),
(5, 'App\\Models\\User', 2, 'authToken', 'f945d6f2053f00cb73041f87ef7337477ebed7a1af90f3f534902739b910cf4f', '[\"*\"]', NULL, NULL, '2024-10-09 20:11:14', '2024-10-09 20:11:14'),
(6, 'App\\Models\\User', 2, 'authToken', '28cb349fd138c393aac81fae120ffb804f708468c35f56823840653d5389ef5e', '[\"*\"]', NULL, NULL, '2024-10-09 20:11:41', '2024-10-09 20:11:41'),
(7, 'App\\Models\\User', 2, 'authToken', '658148254e25e624362bfee3d512f8a4c0ab418a0b99a57e9696ea64b20bb5ea', '[\"*\"]', NULL, NULL, '2024-10-09 20:12:45', '2024-10-09 20:12:45'),
(8, 'App\\Models\\User', 2, 'authToken', 'caab33237736a092c8b77560dcd824931be1f52cb5d7d297726ed59bfe727508', '[\"*\"]', NULL, NULL, '2024-10-09 20:15:21', '2024-10-09 20:15:21'),
(9, 'App\\Models\\User', 2, 'authToken', 'be1387b70bc8cbc61a7a30e3408fe9d1dd2cf305774bf17938d0a48671e03cb9', '[\"*\"]', NULL, NULL, '2024-10-09 20:18:13', '2024-10-09 20:18:13'),
(10, 'App\\Models\\User', 2, 'authToken', '1b69343beef029c5573f91262624d4a5c46050e8f04de2a962c19376da9f4cc8', '[\"*\"]', NULL, NULL, '2024-10-09 20:20:55', '2024-10-09 20:20:55'),
(11, 'App\\Models\\User', 2, 'authToken', 'aba46fbf4865b7e3123717bfc72c36a14fb9920797905d3bf0470b995fb8082d', '[\"*\"]', NULL, NULL, '2024-10-09 20:21:50', '2024-10-09 20:21:50'),
(12, 'App\\Models\\User', 2, 'authToken', '351a3933aa1ebe5a7bd7e7fdc01e37ba87fe468047e33584db9a2e35b3d14d33', '[\"*\"]', NULL, NULL, '2024-10-09 20:24:33', '2024-10-09 20:24:33'),
(13, 'App\\Models\\User', 2, 'authToken', '705016135074da3f8d2d44d223bc7e53d0e99778817a98048a82fbff86d2131a', '[\"*\"]', NULL, NULL, '2024-10-09 20:24:46', '2024-10-09 20:24:46'),
(14, 'App\\Models\\User', 2, 'authToken', '73f0ce1f0b898fd599e657ca4a713cc9c3267a1150e174b7c5bd25cc455ca080', '[\"*\"]', NULL, NULL, '2024-10-09 20:27:43', '2024-10-09 20:27:43'),
(15, 'App\\Models\\User', 2, 'authToken', '33f4e723b60dc073568f58a747bb05ce83f6b5209993219f60c3f8c0d8876a51', '[\"*\"]', NULL, NULL, '2024-10-09 20:28:18', '2024-10-09 20:28:18'),
(16, 'App\\Models\\User', 2, 'authToken', '1d7d070741305be4289f7c112ad4ac9a93021edaac070bdd3ebe4a3d9e85a0fd', '[\"*\"]', NULL, NULL, '2024-10-09 20:28:45', '2024-10-09 20:28:45'),
(17, 'App\\Models\\User', 2, 'authToken', '6163a049623c27dcaf9a0a47963c64156d51f7d81bccfb03b3709ec3030f7efb', '[\"*\"]', NULL, NULL, '2024-10-09 20:30:19', '2024-10-09 20:30:19'),
(18, 'App\\Models\\User', 2, 'authToken', '356d5db9136be985d6d0d2493ca200b283a1bb4000bbf92c81d22fa5b7eaa26a', '[\"*\"]', NULL, NULL, '2024-10-09 20:33:21', '2024-10-09 20:33:21'),
(19, 'App\\Models\\User', 2, 'authToken', '749c0653e903f6224d17279d6559d99af1a90dc8bb834a415852135ee6b8cba8', '[\"*\"]', NULL, NULL, '2024-10-09 20:34:54', '2024-10-09 20:34:54'),
(20, 'App\\Models\\User', 2, 'authToken', '9b9ad406e84ee2f2046e145babc568b9f83127ce784e0a510035919442a56c33', '[\"*\"]', NULL, NULL, '2024-10-09 20:35:21', '2024-10-09 20:35:21'),
(21, 'App\\Models\\User', 2, 'authToken', 'bf63183d5dce04f34d154f24876681d4a426b6c7fa6a2e11a1b069e0b8538125', '[\"*\"]', NULL, NULL, '2024-10-11 18:13:51', '2024-10-11 18:13:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `tipo_cliente` varchar(255) DEFAULT NULL,
  `tipo_documento` int(11) DEFAULT NULL,
  `numero_documento` varchar(255) DEFAULT NULL,
  `municipio` int(11) DEFAULT NULL,
  `paisn` int(11) DEFAULT NULL,
  `fachadoc` date DEFAULT NULL,
  `fachacadoc` date DEFAULT NULL,
  `numero_carnet` varchar(255) DEFAULT NULL,
  `ciudad_carnet` int(11) DEFAULT NULL,
  `pais_carnet` int(11) DEFAULT NULL,
  `fachacarnet` date DEFAULT NULL,
  `fachacacarnet` date DEFAULT NULL,
  `tipo_carnet` int(11) DEFAULT NULL,
  `ciudad_nacido` int(11) DEFAULT NULL,
  `pais_nacido` int(11) DEFAULT NULL,
  `fachanacido` date DEFAULT NULL,
  `incidencias` varchar(255) DEFAULT NULL,
  `numero_contacto` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `canal` int(11) DEFAULT NULL,
  `pais` int(11) DEFAULT NULL,
  `documentos2` longtext DEFAULT NULL,
  `direccionh` varchar(255) DEFAULT NULL,
  `codigo_postalh` int(11) DEFAULT NULL,
  `ciudadh` int(11) DEFAULT NULL,
  `pais_nacidoh` int(11) DEFAULT NULL,
  `direccionl` varchar(255) DEFAULT NULL,
  `codigo_postallocal` int(11) DEFAULT NULL,
  `ciudadl` int(11) DEFAULT NULL,
  `pais_nacidol` int(11) DEFAULT NULL,
  `clienteempresa` int(11) DEFAULT NULL,
  `incluir_mailing` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `medio_pago` varchar(255) DEFAULT NULL,
  `observaciones` varchar(255) DEFAULT NULL,
  `avisos` varchar(255) DEFAULT NULL,
  `canales_restringidos` varchar(255) DEFAULT NULL,
  `consentimiento` varchar(255) DEFAULT NULL,
  `fechas` varchar(255) DEFAULT NULL,
  `idiomas` int(11) DEFAULT NULL,
  `cuenta_contable` int(11) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `consentimiento_fecha` date DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `name`, `tipo_cliente`, `tipo_documento`, `numero_documento`, `municipio`, `paisn`, `fachadoc`, `fachacadoc`, `numero_carnet`, `ciudad_carnet`, `pais_carnet`, `fachacarnet`, `fachacacarnet`, `tipo_carnet`, `ciudad_nacido`, `pais_nacido`, `fachanacido`, `incidencias`, `numero_contacto`, `email`, `canal`, `pais`, `documentos2`, `direccionh`, `codigo_postalh`, `ciudadh`, `pais_nacidoh`, `direccionl`, `codigo_postallocal`, `ciudadl`, `pais_nacidol`, `clienteempresa`, `incluir_mailing`, `estado`, `medio_pago`, `observaciones`, `avisos`, `canales_restringidos`, `consentimiento`, `fechas`, `idiomas`, `cuenta_contable`, `apellido`, `genero`, `consentimiento_fecha`, `cliente`, `updated_at`, `created_at`) VALUES
(1, 'Callum English', NULL, 1, '24699681-4', 3, 49, '2014-06-07', '2014-06-07', '24699681-4', 15, 18, '2020-06-03', '2020-06-03', 1, 5, 18, '2013-09-28', NULL, '+573046405009', 'meloxyp@mailinator.com', NULL, 18, '[\"1727195603_Checkout.pdf\"]', 'Voluptates sed necessitatibus vel eum qu', 96, 16, 18, 'Sint dolor nulla illo deleniti unde ut s', NULL, 17, 18, NULL, 1, 0, 'paypal', 'affdgdfg', 'ggfgfd', '[\"\\u00bfPermite contactar v\\u00eda mailing?\",\"\\u00bfPermite contactar v\\u00eda email?\"]', '[\"\\u00bfHa firmado un consentimiento?\",\"\\u00bfEl consentimiento est\\u00e1 impreso?\"]', '[\"2024-09-24\",\"2024-09-24\",\"2024-09-24\",\"2024-09-24\"]', 9, 93, 'Expedita et pariatur Iure eve', 'Masculino', '2024-09-24', 0, '2024-09-24', '2024-09-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_vehiculo`
--

CREATE TABLE `registro_vehiculo` (
  `id` int(20) UNSIGNED NOT NULL,
  `placa` varchar(255) NOT NULL,
  `chasis` varchar(255) NOT NULL,
  `llave` varchar(255) DEFAULT NULL,
  `kilometros` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `notas` varchar(500) DEFAULT NULL,
  `equipamiento_vehiculo` varchar(255) DEFAULT NULL,
  `accesorio_vehiculo` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `uso` varchar(255) DEFAULT NULL,
  `propietario` varchar(255) DEFAULT NULL,
  `sucursal` varchar(255) DEFAULT NULL,
  `aparcado` varchar(255) DEFAULT NULL,
  `deposito` varchar(255) DEFAULT NULL,
  `compania_seguro` varchar(255) DEFAULT NULL,
  `riesgo_seguro` varchar(255) DEFAULT NULL,
  `poliza_seguro` varchar(255) DEFAULT NULL,
  `aseguradora_seguro` varchar(255) DEFAULT NULL,
  `asistencia_seguro` varchar(255) DEFAULT NULL,
  `telefono_seguro` varchar(255) DEFAULT NULL,
  `aviso` varchar(500) DEFAULT NULL,
  `documentos` varchar(255) DEFAULT NULL,
  `documento_2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `grupo` varchar(255) DEFAULT NULL,
  `tipo_combustible` varchar(255) DEFAULT NULL,
  `capacidad_combustible` varchar(255) DEFAULT NULL,
  `tipo_caja` varchar(255) DEFAULT NULL,
  `tipo_vehiculo` varchar(255) DEFAULT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `sucursal_actual` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `registro_vehiculo`
--

INSERT INTO `registro_vehiculo` (`id`, `placa`, `chasis`, `llave`, `kilometros`, `fecha`, `color`, `modelo`, `codigo`, `notas`, `equipamiento_vehiculo`, `accesorio_vehiculo`, `estado`, `uso`, `propietario`, `sucursal`, `aparcado`, `deposito`, `compania_seguro`, `riesgo_seguro`, `poliza_seguro`, `aseguradora_seguro`, `asistencia_seguro`, `telefono_seguro`, `aviso`, `documentos`, `documento_2`, `created_at`, `updated_at`, `grupo`, `tipo_combustible`, `capacidad_combustible`, `tipo_caja`, `tipo_vehiculo`, `marca`, `sucursal_actual`) VALUES
(9, 'LXW017', '23454546', NULL, 100, '2024-09-13', 'blanco', '11', NULL, 'Full Equipo', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"11\"]', '[]', 'LIBRE', 'Alquiler', 'propipo', '1', NULL, 'no', NULL, NULL, NULL, NULL, NULL, NULL, 'Sin rayones', '[]', NULL, '2024-09-14 20:33:40', '2024-10-11 18:16:03', '3', '1', '65', '2', '3', '1', '1'),
(10, 'NAL695', '34565634', NULL, 1000, '2024-09-13', 'blanco', '10', NULL, NULL, '[\"1\",\"2\",\"3\",\"4\",\"5\"]', NULL, 'LIBRE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[\"1726330484_621d278fd2b54d75cc3c87ecf9b88c32.gif\"]', NULL, '2024-09-14 21:14:20', '2024-09-14 21:14:44', '2', '1', '120', '2', '2', '1', NULL),
(11, 'RLXW32', '5866892656', NULL, 35900, '2023-02-01', 'blanco', '12', NULL, 'PRUEBAAAA ALBERTO A.', '[\"1\"]', NULL, 'LIBRE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', NULL, '2024-09-30 21:11:51', '2024-09-30 21:11:51', '3', '1', '35', '1', '3', '5', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `vehiculoid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `fechar` date DEFAULT NULL,
  `sucursalid` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector_comercial`
--

CREATE TABLE `sector_comercial` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sector_comercial`
--

INSERT INTO `sector_comercial` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Retail (Venta al por menor)', NULL, NULL),
(2, 'Comercio Mayorista', NULL, NULL),
(3, 'Comercio Electrónico', NULL, NULL),
(4, 'Alimentación y Bebidas', NULL, NULL),
(5, 'Moda y Textiles', NULL, NULL),
(6, 'Franquicias', NULL, NULL),
(7, 'Servicios Comerciales', NULL, NULL),
(8, 'Comercio Internacional', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3ihR2dV8EgckPpSqyOsetGI4TDKyuIMn0X37B8Ff', NULL, '192.168.0.129', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibk0ySnBjcUhkNGh1eExCbTlWTjE4SkV6aXRiV2dXM1dDRGdhcUdzMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xOTIuMTY4LjAuMTI5OjgwMDAvbG9naW4iO319', 1728482120),
('gnb0WoS6tE6mANH1W9XEabYe2wE27wU1n3ydZIHX', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSlhlUTV0TXhXODUzOFRzYk8wR1lCOWt1cFlLOUwzcHdqZ0JoWXA1aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sbGF2ZXZlaGljdWxvL2V0aXF1ZXRhLzI4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiQxcXlpc0Z4NW9kUUlOanF3eXRmeS9lcFU4UjNTQ1NYVGtjUzBCZGV6a1J6bmtRSmF4OFZKdSI7fQ==', 1728563153),
('NqNQwwKFHmeFocuuYkn4pLJ3D4iL1iMMhjLyQ3Kd', 2, '192.168.0.129', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQlZhZ2xNM3M2SWY3UWtMTHU1UDd5bmlCbHpVQ1lnalRhOXU5b1hIQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xOTIuMTY4LjAuMTI5OjgwMDAvdXNlcmdyb3VwcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkMXF5aXNGeDVvZFFJTmpxd3l0ZnkvZXBVOFIzU0NTWFRrY1MwQmRlemtSem5rUUpheDhWSnUiO30=', 1728652305),
('ZEjqxsTLUrrVbsVNIdAlSlaJkgfYybWwiuTVXoEW', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoialROMHh3MHJITzByUGZ2NzlCbnpaTFBUeVVoRzFTRkRoNGxvTjByMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbGxhdmV2ZWhpY3Vsby9ldGlxdWV0YS8yOCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkMXF5aXNGeDVvZFFJTmpxd3l0ZnkvZXBVOFIzU0NTWFRrY1MwQmRlemtSem5rUUpheDhWSnUiO30=', 1728652223);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `tipo_sucursal` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `nombre`, `ciudad`, `direccion`, `tipo_sucursal`, `created_at`, `updated_at`) VALUES
(1, 'Rac portales', '263', 'Direccion 1', 'Sucursal', NULL, '2024-07-30 19:24:10'),
(3, 'taller blanco encalada', '263', 'Direccion 3', 'Taller', NULL, NULL),
(4, 'bodega Pilauco', '263', 'Direccion 4', 'Bodega', NULL, NULL),
(5, 'automotriz Freire', '263', 'Direccion 5', 'Sucursal', NULL, NULL),
(6, 'bodega automotriz Freire', '263', 'Direccion 6', 'Bodega', NULL, NULL),
(8, 'Rac aeropuerto Tepual', '244', 'Direccion 8', 'Sucursal', NULL, NULL),
(9, 'bodega aeropuerto tepual2', '234', 'Direccion 9', 'Taller', NULL, '2024-08-02 18:15:11'),
(13, 'Todas', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `incremento` longtext DEFAULT NULL,
  `tipo_vehiculo` longtext DEFAULT NULL,
  `precio_hora` longtext DEFAULT NULL,
  `precio_kms` longtext DEFAULT NULL,
  `precio_dia` longtext DEFAULT NULL,
  `incremento_kms2` longtext DEFAULT NULL,
  `incremento_dia` longtext DEFAULT NULL,
  `incremento_hora` longtext DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `precios_kms_fijo` int(11) DEFAULT NULL,
  `precios_kms_hora` int(11) DEFAULT NULL,
  `precios_kms_dia` int(11) DEFAULT NULL,
  `precios_kms` int(11) DEFAULT NULL,
  `incrementos_kms_fijo` int(11) DEFAULT NULL,
  `incrementos_kms_hora` int(11) DEFAULT NULL,
  `incrementos_kms_dia` int(11) DEFAULT NULL,
  `incrementos_kms` int(11) DEFAULT NULL,
  `sucursal` int(11) DEFAULT NULL,
  `recargo_fijo` int(11) DEFAULT NULL,
  `recargo_bimensual` int(11) DEFAULT NULL,
  `recargo_mensual` int(11) DEFAULT NULL,
  `recargo_semanal` int(11) DEFAULT NULL,
  `recargo_dia` int(11) DEFAULT NULL,
  `recargo_kms` int(11) DEFAULT NULL,
  `recargo_hora` int(11) DEFAULT NULL,
  `precio_bimensual` longtext DEFAULT NULL,
  `incremento_bimensual` longtext DEFAULT NULL,
  `precios_kms_bimensual` int(11) DEFAULT NULL,
  `incrementos_kms_bimensual` int(11) DEFAULT NULL,
  `precio_mensual` longtext DEFAULT NULL,
  `incremento_mensual` longtext DEFAULT NULL,
  `precios_kms_mensual` int(11) DEFAULT NULL,
  `incrementos_kms_mensual` int(11) DEFAULT NULL,
  `precio_semanal` longtext DEFAULT NULL,
  `incremento_semanal` longtext DEFAULT NULL,
  `precios_kms_semanal` int(11) DEFAULT NULL,
  `incrementos_kms_semanal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`id`, `nombre`, `precio`, `created_at`, `updated_at`, `incremento`, `tipo_vehiculo`, `precio_hora`, `precio_kms`, `precio_dia`, `incremento_kms2`, `incremento_dia`, `incremento_hora`, `codigo`, `precios_kms_fijo`, `precios_kms_hora`, `precios_kms_dia`, `precios_kms`, `incrementos_kms_fijo`, `incrementos_kms_hora`, `incrementos_kms_dia`, `incrementos_kms`, `sucursal`, `recargo_fijo`, `recargo_bimensual`, `recargo_mensual`, `recargo_semanal`, `recargo_dia`, `recargo_kms`, `recargo_hora`, `precio_bimensual`, `incremento_bimensual`, `precios_kms_bimensual`, `incrementos_kms_bimensual`, `precio_mensual`, `incremento_mensual`, `precios_kms_mensual`, `incrementos_kms_mensual`, `precio_semanal`, `incremento_semanal`, `precios_kms_semanal`, `incrementos_kms_semanal`) VALUES
(17, 'Pizarra2', '{\"2\":\"12.88\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '2024-09-15 03:01:30', '2024-09-15 05:12:54', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '\"[\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\"]\"', '{\"2\":\"1.18\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', '{\"2\":\"40.00\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"14.28\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', '{\"2\":\"40.00\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"14.28\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', '{\"2\":\"1.18\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', 'AUX001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 14, 101, 100, 100, 100, 100, 100, '{\"2\":\"201.00\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"201.00\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', NULL, NULL, '{\"2\":\"100.00\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', '{\"2\":\"100.00\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', NULL, NULL, '{\"2\":\"25.00\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', '{\"2\":\"25.00\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', NULL, NULL),
(18, 'Pizarra06', '{\"2\":\"103.50\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '2024-09-16 01:26:17', '2024-09-16 01:26:17', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '\"[\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\"]\"', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', 'AUX006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 15, NULL, NULL, NULL, NULL, NULL, NULL, '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', NULL, NULL, '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', NULL, NULL, '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', NULL, NULL),
(19, 'Auxilio Copago', '{\"2\":\"11.30\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '2024-09-17 14:30:07', '2024-09-17 14:30:07', '{\"2\":\"11.30\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '\"[\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\"]\"', '{\"2\":\"0.12\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', '{\"2\":\"11.30\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"2.60\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"0.00\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', '{\"2\":\"0.00\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', 'AUX003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 13, 13, NULL, 14, 13, 13, 13, '{\"2\":\"113.00\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', NULL, NULL, '{\"2\":\"56.50\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', '{\"2\":\"0.00\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', NULL, NULL, '{\"2\":\"16.11\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', '{\"2\":\"0.00\",\"3\":\"0.00\",\"4\":\"0.00\",\"6\":\"0.00\",\"8\":\"0.00\",\"9\":\"0.00\"}', NULL, NULL),
(20, 'PIZARRA', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '2024-09-30 21:13:04', '2024-09-30 21:13:04', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '\"[\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\"]\"', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '0021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', NULL, NULL, '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', NULL, NULL, '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', NULL, NULL),
(21, 'COLABORADORES', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '2024-09-30 21:14:30', '2024-09-30 21:14:30', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '\"[\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"6\\\",\\\"8\\\",\\\"9\\\"]\"', '{\"2\":\"3000\",\"3\":\"3000\",\"4\":\"0.000\",\"6\":\"3000\",\"8\":\"3000\",\"9\":\"3000\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"0.000\",\"3\":\"0.000\",\"4\":\"0.000\",\"6\":\"0.000\",\"8\":\"0.000\",\"9\":\"0.000\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"0.000\",\"3\":\"0.000\",\"4\":\"0.000\",\"6\":\"0.000\",\"8\":\"0.000\",\"9\":\"0.000\"}', '{\"2\":\"0.000\",\"3\":\"0.000\",\"4\":\"0.000\",\"6\":\"0.000\",\"8\":\"0.000\",\"9\":\"0.000\"}', '0025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 5, NULL, NULL, NULL, NULL, NULL, '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', '{\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\"}', NULL, NULL, '{\"2\":\"0.000\",\"3\":\"0.000\",\"4\":\"0.000\",\"6\":\"0.000\",\"8\":\"0.000\",\"9\":\"0.000\"}', '{\"2\":\"0.000\",\"3\":\"0.000\",\"4\":\"0.000\",\"6\":\"0.000\",\"8\":\"0.000\",\"9\":\"0.000\"}', NULL, NULL, '{\"2\":\"0.000\",\"3\":\"0.000\",\"4\":\"0.000\",\"6\":\"0.000\",\"8\":\"0.000\",\"9\":\"0.000\"}', '{\"2\":\"0.000\",\"3\":\"0.000\",\"4\":\"0.000\",\"6\":\"0.000\",\"8\":\"0.000\",\"9\":\"0.000\"}', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa_cliente`
--

CREATE TABLE `tarifa_cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `porcentaje` decimal(5,2) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarifa_cliente`
--

INSERT INTO `tarifa_cliente` (`id`, `nombre`, `porcentaje`, `updated_at`, `created_at`) VALUES
(7, 'Tarifa 4', 4.00, '2024-09-10 17:34:25', '2024-09-10 17:33:57'),
(8, 'Tarifa', 5.00, '2024-09-10 17:34:31', '2024-09-10 17:34:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa_combustible`
--

CREATE TABLE `tarifa_combustible` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `sucursal` int(11) DEFAULT NULL,
  `combustible` varchar(500) DEFAULT NULL,
  `coste` varchar(500) DEFAULT NULL,
  `pvp` varchar(500) DEFAULT NULL,
  `iva` varchar(500) DEFAULT NULL,
  `cantidad_existente` varchar(500) DEFAULT NULL,
  `cantidad_comprada` varchar(500) DEFAULT NULL,
  `capacidad` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarifa_combustible`
--

INSERT INTO `tarifa_combustible` (`id`, `nombre`, `sucursal`, `combustible`, `coste`, `pvp`, `iva`, `cantidad_existente`, `cantidad_comprada`, `capacidad`, `created_at`, `updated_at`, `proveedor`) VALUES
(3, 'Tarfia002', 1, '[\"1\",\"2\",\"3\",\"4\"]', '{\"1\":\"10.000\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\"}', '{\"1\":\"11.300\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\"}', '{\"1\":\"13\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\"}', '{\"1\":\"49.000\",\"2\":\"0.000\",\"3\":\"0.000\",\"4\":\"0.000\"}', '{\"1\":\"0\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\"}', '{\"1\":\"50.000\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\"}', '2024-09-16 22:10:28', '2024-09-16 20:12:06', NULL),
(4, 'TRC001', 5, '[\"1\",\"2\",\"3\",\"4\"]', '{\"1\":\"15.000\",\"2\":\"\",\"3\":\"\",\"4\":\"\"}', '{\"1\":\"16.950\",\"2\":\"\",\"3\":\"\",\"4\":\"\"}', '{\"1\":\"13\",\"2\":\"\",\"3\":\"\",\"4\":\"\"}', '{\"1\":\"15.000\",\"2\":\"\",\"3\":\"\",\"4\":\"\"}', '{\"1\":\"0\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\"}', '{\"1\":\"20.000\",\"2\":\"\",\"3\":\"\",\"4\":\"\"}', '2024-09-17 14:31:35', '2024-09-30 14:44:35', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_caja`
--

CREATE TABLE `tipo_caja` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_caja`
--

INSERT INTO `tipo_caja` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Manual', NULL, NULL),
(2, 'Automática', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_carnet`
--

CREATE TABLE `tipo_carnet` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_carnet`
--

INSERT INTO `tipo_carnet` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'A', NULL, NULL),
(2, 'B', NULL, NULL),
(3, 'C', NULL, NULL),
(4, 'D', NULL, NULL),
(5, 'E', NULL, '2024-09-10 17:50:14'),
(6, 'F', NULL, '2024-09-10 17:50:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_combustible`
--

CREATE TABLE `tipo_combustible` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_combustible`
--

INSERT INTO `tipo_combustible` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Gasolina', NULL, NULL),
(2, 'Diésel', NULL, NULL),
(3, 'Gas Licuado de Petróleo (GLP)', NULL, NULL),
(4, 'Gas Natural Comprimido (GNC)', NULL, NULL),
(5, 'Eléctrico', NULL, NULL),
(6, 'Híbrido', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'RUT', '2024-07-19 13:41:40', '2024-07-19 13:41:40'),
(2, 'Cédula de Extranjería', '2024-07-19 13:41:40', '2024-07-19 13:41:40'),
(3, 'Pasaporte', '2024-07-19 13:41:40', '2024-07-19 13:41:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_itv`
--

CREATE TABLE `tipo_itv` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_itv`
--

INSERT INTO `tipo_itv` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Inspección Técnica Anual', NULL, NULL),
(2, 'Inspección Técnica Preventiva', NULL, NULL),
(3, 'Inspección de Emisiones Contaminantes', NULL, NULL),
(4, 'Inspección de Frenos', NULL, NULL),
(5, 'Inspección de Seguridad Vehicular', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vehiculos`
--

CREATE TABLE `tipo_vehiculos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_vehiculos`
--

INSERT INTO `tipo_vehiculos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(2, 'A', '2024-07-22 20:33:56', '2024-07-23 20:17:53'),
(3, 'B', '2024-07-22 20:34:02', '2024-07-23 20:18:01'),
(4, 'C', '2024-07-23 19:57:17', '2024-07-23 20:18:08'),
(6, 'D', '2024-07-30 17:43:30', '2024-09-05 22:12:42'),
(8, 'Prueba', '2024-08-02 21:33:42', '2024-08-02 21:33:42'),
(9, 'E', '2024-09-12 19:05:13', '2024-09-12 19:05:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `tipo_documento` varchar(255) DEFAULT NULL,
  `numero_documento` varchar(255) DEFAULT NULL,
  `numero_telefonico` varchar(255) DEFAULT NULL,
  `tipo_usuario` varchar(255) DEFAULT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `apellido`, `tipo_documento`, `numero_documento`, `numero_telefonico`, `tipo_usuario`, `estado`) VALUES
(1, 'pruebas', 'pruebas@gmail.com', NULL, '$2y$12$gI5VLxsVXQOVbW1xt4r93uUMoUsp5LlC7NvXxiyPTGl/r6A6nh/Xu', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-19 13:42:59', '2024-07-19 13:42:59', 'pruebas', '1', '1006320237', '3046405009', '1', 'Activo'),
(2, 'Alejandro', 'jorjecasanova@gmail.com', NULL, '$2y$12$1qyisFx5odQINjqwytfy/epU8R3SCSXTkcS0BdezkRznkQJax8VJu', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-19 15:19:51', '2024-10-09 20:11:55', 'Casierra', '1', '14908749-4', '3046405009', '1', 'Activo'),
(4, 'Tomas', 'tomas.mogrovejo.acosta@gmail.com', NULL, '$2y$12$vOCuVE6ejj/X4TVIA71na.bnx1dBHg5K/kUTlHXIyISCq/Ay483.K', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-22 19:51:39', '2024-07-22 19:51:39', 'Mogrovejo', '1', '43997264', '963133889', '2', 'Activo'),
(7, 'Jose', 'JOSE@HOTMAIL.COM', NULL, '$2y$12$EwDDPG9FdUyO7QgjyrbMQ..bfydXrT0Pm0GlV1tksfTJYY7ZM/xOq', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-29 16:26:42', '2024-07-30 21:21:59', 'Jaramillo', '2', '1006320237', '3122057768', '1', 'Activo'),
(11, 'usuario1', 'crodriguez@unbcorp.cl', NULL, '$2y$12$8bEKT.bftYtNK55P5iW.NOTNhI3SnjBNHdBYJcYo.G1Y8Wnvpkco2', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-30 16:17:38', '2024-08-02 17:24:00', 'usua', '2', '1006320237', '3046405009', '1', 'Activo'),
(12, 'usuario', 'catheriner1106@gmail.com', NULL, '$2y$12$CBL0mPyS6ucYNfoKDHyJEuZ.hOIPItH13lU3XUHDWxQdcrpLTZXx.', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-30 16:23:16', '2024-07-30 21:21:32', 'usuario', '1', '1234567890', '3046405009', '1', 'Activo'),
(14, 'Elizabeth Gibbs', 'zyre@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-11 23:41:33', '2024-09-11 23:41:33', NULL, '1', '6466271-6', '+3046405009', '6', 'Activo'),
(16, 'Patricio', 'gerencia@rentacarmackenna.cl', NULL, '$2y$12$6hM7pJC1j2dkDBI66V7XBuZZdA5M9s25f1ojhG479gsKaRjQTbXNC', NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-30 14:55:38', '2024-09-30 15:15:34', 'Navarro', '1', '14187589-2', '9449993611', '1', 'Activo'),
(17, 'Alejo', 'ale241302@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-30 15:10:56', '2024-09-30 15:10:56', 'Casa', '1', '18171085-3', '3046405009', '1', 'Activo'),
(18, 'Alberto', 'aalvarez@rentacarmackenna.cl', NULL, '$2y$12$GMy73prw5ywkN1p7H9rjbuBsGtGKVZbMri/2d5wZPKbef1E1VtmyG', NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-30 15:37:35', '2024-09-30 15:39:25', 'Alvarez', '1', '20969308-9', '+56983332160', '1', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_groups`
--

CREATE TABLE `user_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `permisos` varchar(2550) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_groups`
--

INSERT INTO `user_groups` (`id`, `nombre`, `permisos`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"56\",\"57\",\"58\",\"59\",\"9\",\"10\",\"11\",\"12\",\"17\",\"18\",\"19\",\"20\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"64\",\"65\",\"66\",\"67\",\"13\",\"14\",\"15\",\"16\",\"21\",\"22\",\"23\",\"24\",\"60\",\"61\",\"62\",\"63\",\"68\",\"69\",\"70\",\"71\"]', '2024-07-19 13:43:25', '2024-09-24 18:54:54'),
(2, 'usuarios', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"9\",\"10\",\"11\",\"12\",\"17\",\"18\",\"19\",\"20\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"13\",\"14\",\"15\",\"16\",\"21\",\"22\",\"23\",\"24\"]', '2024-07-22 20:43:38', '2024-08-21 18:18:07'),
(4, 'Cliente Empresa', '[\"60\",\"61\",\"62\",\"63\"]', '2024-09-09 18:42:00', '2024-09-09 18:42:00'),
(6, 'Cliente Particular', '[]', '2024-09-10 02:10:24', '2024-09-10 02:10:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorio_vehiculo`
--
ALTER TABLE `accesorio_vehiculo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `canal_venta`
--
ALTER TABLE `canal_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes_empresa`
--
ALTER TABLE `clientes_empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipamiento_vehiculo`
--
ALTER TABLE `equipamiento_vehiculo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_vehiculo`
--
ALTER TABLE `estado_vehiculo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `extra_cliente`
--
ALTER TABLE `extra_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `grafico_vehiculo`
--
ALTER TABLE `grafico_vehiculo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo_vehiculo`
--
ALTER TABLE `grupo_vehiculo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `llave_vehiculo`
--
ALTER TABLE `llave_vehiculo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placa` (`placa`);

--
-- Indices de la tabla `marca_vehiculo`
--
ALTER TABLE `marca_vehiculo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelo_vehiculo`
--
ALTER TABLE `modelo_vehiculo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_vehiculo`
--
ALTER TABLE `registro_vehiculo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sector_comercial`
--
ALTER TABLE `sector_comercial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarifa_cliente`
--
ALTER TABLE `tarifa_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarifa_combustible`
--
ALTER TABLE `tarifa_combustible`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_caja`
--
ALTER TABLE `tipo_caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_carnet`
--
ALTER TABLE `tipo_carnet`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_combustible`
--
ALTER TABLE `tipo_combustible`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_itv`
--
ALTER TABLE `tipo_itv`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_vehiculos`
--
ALTER TABLE `tipo_vehiculos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesorio_vehiculo`
--
ALTER TABLE `accesorio_vehiculo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `canal_venta`
--
ALTER TABLE `canal_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes_empresa`
--
ALTER TABLE `clientes_empresa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `equipamiento_vehiculo`
--
ALTER TABLE `equipamiento_vehiculo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estado_vehiculo`
--
ALTER TABLE `estado_vehiculo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `extra_cliente`
--
ALTER TABLE `extra_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grafico_vehiculo`
--
ALTER TABLE `grafico_vehiculo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `grupo_vehiculo`
--
ALTER TABLE `grupo_vehiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `llave_vehiculo`
--
ALTER TABLE `llave_vehiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `marca_vehiculo`
--
ALTER TABLE `marca_vehiculo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `modelo_vehiculo`
--
ALTER TABLE `modelo_vehiculo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `registro_vehiculo`
--
ALTER TABLE `registro_vehiculo`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sector_comercial`
--
ALTER TABLE `sector_comercial`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tarifa_cliente`
--
ALTER TABLE `tarifa_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tarifa_combustible`
--
ALTER TABLE `tarifa_combustible`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_caja`
--
ALTER TABLE `tipo_caja`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_carnet`
--
ALTER TABLE `tipo_carnet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipo_combustible`
--
ALTER TABLE `tipo_combustible`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_itv`
--
ALTER TABLE `tipo_itv`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_vehiculos`
--
ALTER TABLE `tipo_vehiculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
