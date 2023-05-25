-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2023 a las 04:37:14
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendacomponentes`
--

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `categoria`
CREATE TABLE `categoria` (
  `categoria_id` varchar(5) NOT NULL,
  `tipo_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `categoria`
INSERT INTO `categoria` (`categoria_id`, `tipo_categoria`) VALUES
('CAT01', 'Tarjetas de video'),
('CAT02', 'Audio'),
('CAT03', 'Interfaces'),
('CAT04', 'Procesador'),
('CAT05', 'Gabinete'),
('CAT06', 'Tarjeta madre'),
('CAT07', 'Periferico'),
('CAT08', 'Memorias Ram'),
('CAT09', 'Almacenamiento'),
('CAT10', 'Fuente de poder');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `direccion`
CREATE TABLE `direccion` (
  `direccion_id` varchar(5) NOT NULL,
  `estado_id` varchar(3) NOT NULL,
  `alcaldia` varchar(50) NOT NULL,
  `colonia` varchar(50) NOT NULL,
  `cod_post` varchar(10) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `num_ext` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `direccion`
INSERT INTO `direccion` (`direccion_id`, `estado_id`, `alcaldia`, `colonia`, `cod_post`, `calle`, `num_ext`) VALUES
('D0001', 'E01', 'Benito Juárez', 'Gral Anaya', '3340', 'Golondrinas', '16'),
('D0002', 'E01', 'Coyoacán', 'Del Carmen', '4100', 'Gómez Farias', '85'),
('D0003', 'E01', 'Coyoacán', 'Del Carmen', '4100', 'Av. México', '93'),
('D0004', 'E01', 'Tlalpan', 'Isidro Fabela', '14030', 'C. 4 Pte.', '44'),
('D0005', 'E01', 'Iztapalapa', 'El Retoño', '9440', 'Calz. de la Viga', '79'),
('D0006', 'E01', 'Iztapalapa', 'El Triunfo', '9430', 'Sta. María la Purísima', '74'),
('D0007', 'E02', 'Del Fresno', 'Isidro Fabela', '44900', 'Limón', '39'),
('D0008', 'E03', 'Balderrama', 'Lomas Tor', '83180', '14 de Abril', '56'),
('D0009', 'E03', 'C. Juan de Dios Bojórquez', 'Sahuaro', '83170', 'Saturnino Campoy', '13'),
('D0010', 'E02', 'Morelos', 'San Isidro', '44910', 'Pichón', '46'),
('D0011', 'E05', 'Centro', 'Cankun', '64000', 'Av. Francisco I. Madero', '31'),
('D0012', 'E05', 'Martínez', 'Chicharo', '64550', 'C. Pablo A. de La Garza', '22'),
('D0013', 'E04', 'S.L', 'Paris', '44790', 'Av. Francisco Javier Mina', '74'),
('D0014', 'E04', 'Insurgentes', 'Francisco Sarabia', '44820', 'C. Federico Medrano', '1'),
('D0015', 'E03', 'Unión de Ladrilleros', 'La Roma', '83179', 'Ramón Valdez Ramírez', '4'),
('D0016', 'E02', 'Centro', 'Toltercas', '49000', 'Del Carro', '27'),
('D0017', 'E02', 'Revolución', 'Estrella del Sur', '49050', 'C. José Vasconcelos', '83'),
('D0018', 'E03', 'Solidaridad', 'Del Carmen', '83116', 'Bolsón de Mapimí', '45'),
('D0019', 'E02', 'Cd Guzmán Centro', 'Trineos', '49000', 'C. Miguel Hidalgo Y Costilla', '59'),
('D0020', 'E02', 'Teocalli', 'Isidro Fabela', '49000', 'C. Fernando Calderón Beltrán', '80'),
('D0021', 'E02', 'Cd Guzmán Centro', 'Gómez Farias', '49000', 'Calle Lic Ignacio Mariscal LB', '45'),
('D0022', 'E05', 'Centro', 'Trinidad', '64000', 'Av. Benito Juárez', '93'),
('D0023', 'E04', 'Tetlán', 'Cerro del agua', '44790', 'C. Dionisio Rodríguez', '68'),
('D0024', 'E04', 'Insurgentes de La Presa', 'Adolfo Lopez', '44820', 'Victoria Navarro', '23'),
('D0025', 'E01', 'Tlalpan', 'Jardines en la Montaña', '14210', 'Av. Paseo del Pedregal', '52'),
('D0026', 'E04', 'Talpita', 'Esteban Alatorre', '44719', 'C. Juan de Dios Robledo', '97'),
('D0027', 'E02', 'Cd Guzmán Centro', 'Nueva Castilla', '49000', 'C. Federico del Toro', '49'),
('D0028', 'E05', 'Centro', 'Del Carro', '64000', 'C. Isaac Garza', '51'),
('D0029', 'E05', 'Del Nte.', 'Gómez Farias', '54520', 'Moderna, Av. Félix U. Gómez', '1'),
('D0030', 'E05', 'Jardines de La Moderna', 'Magdalena', '64530', 'C. Magnolia', '70'),
('D0031', 'E03', 'Unión de Ladrilleros', 'San Lazaro', '83179', 'Roberto Mejía Serna', '90'),
('D0032', 'E05', 'Moderna', 'Del Carro', '64530', 'C. Peral', '60'),
('D0033', 'E02', 'Cd Guzmán Centro', 'Del Carro', '49032', 'Calle Mariano Abasolo', '37'),
('D0034', 'E01', 'Tlalpan', 'Toriello Guerra', '14050', 'Cuitláhuac', '1'),
('D0035', 'E01', 'Tlalpan', 'Cantera Puente de Piedra', '14050', 'Del Río', '1'),
('D0036', 'E02', '16 de Septiembre', 'Miguel Hidalgo', '49050', 'Calz Madero y Carranza', '42'),
('D0037', 'E01', 'Coyoacán', 'Del Carmen', '4100', 'Priv. Corina', '18'),
('D0038', 'E03', 'Nueva Castilla', 'Esteban Alatorre', '83178', 'Av. Mariano Jiménez', '8'),
('D0039', 'E01', 'Iztapalapa', 'Amp el Santuario', '9829', 'Catedral Metropolitana', '18'),
('D0040', 'E04', 'Santa María', 'San Juan de Aragon', '44719', 'C. Rita Pérez de Moreno', '37'),
('D0041', 'E04', 'San Andrés', 'Isidro Fabela', '44810', 'C. Gigantes', '77'),
('D0042', 'E04', 'Libertad', 'Tunas', '44750', 'C. Esteban Alatorre', '15'),
('D0043', 'E01', 'Miguel Hidalgo', 'Daniel Garza al Poniente', '11840', 'Gobernador José Ceballos', '41'),
('D0044', 'E01', 'Polanco', 'Polanco III Secc, M.H', '11540', 'Av. Pdte. Masaryk', '3'),
('D0045', 'E01', 'Miguel Hidalgo', 'Daniel Garza al Poniente', '11830', 'Gral Mariano Monterde', '45'),
('D0046', 'E04', 'Blanco y Cuéllar', 'Francisco Sarabia', '44730', 'C. Francisco Sarabia', '83'),
('D0047', 'E01', 'Miguel Hidalgo', 'Daniel Garza al Poniente', '11830', 'Coronel Amado Camacho', '10'),
('D0048', 'E01', 'Miguel Hidalgo', 'América', '11810', 'C. Sur 128', '58'),
('D0049', 'E04', 'San Isidro Oblatos', 'Francisco Sarabia', '44700', 'C. José María Narváez', '45'),
('D0050', 'E01', 'Iztapalapa', 'Estrella del Sur', '9820', 'Loc D esquina Xochipilli', '38'),
('D0051', 'E05', 'Centro', 'Isidro Fabela', '64000', 'Av. Francisco I. Madero', '90'),
('D0052', 'E04', 'La Penal', 'Estrella del Sur', '44730', 'C. Juan de Dios Robledo', '30'),
('D0053', 'E02', 'La Lagunita', 'Estrella del Sur', '49340', 'Zaragoza', '5');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `envio`
CREATE TABLE `envio` (
  `envio_id` varchar(5) NOT NULL,
  `tipo_envio` varchar(20) NOT NULL,
  `costo_envio` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `envio`
INSERT INTO `envio` (`envio_id`, `tipo_envio`, `costo_envio`) VALUES
('E01', 'FEDEX', '100.00'),
('E02', 'ESTAFETA', '70.00');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `estado`
CREATE TABLE `estado` (
  `edo_id` varchar(3) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `estado`
INSERT INTO `estado` (`edo_id`, `estado`) VALUES
('E01', 'CDMX'),
('E02', 'JALISCO'),
('E03', 'SONORA'),
('E04', 'GUANAJUATO'),
('E05', 'MONTERREY');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `fabricante`
CREATE TABLE `fabricante` (
  `fabricante_id` varchar(5) NOT NULL,
  `nombre_fabricante` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `fabricante`
INSERT INTO `fabricante` (`fabricante_id`, `nombre_fabricante`) VALUES
('F0001', 'GIGABYTE'),
('F0002', 'INTEL'),
('F0003', 'AMD'),
('F0004', 'ASUS'),
('F0005', 'NZXT'),
('F0006', 'SAMSUNG'),
('F0007', 'LOGITECH'),
('F0008', 'MSI'),
('F0009', 'AEROCOOL'),
('F0010', 'THERMALTAKE'),
('F0011', 'G.SKILL');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `metodo_pago`
CREATE TABLE `metodo_pago` (
  `metodo_pago_id` varchar(3) NOT NULL,
  `metodo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `metodo_pago`
INSERT INTO `metodo_pago` (`metodo_pago_id`, `metodo`) VALUES
('M1', 'TARJETA DEBITO'),
('M2', 'TARJETA CREDITO'),
('M3', 'EFECTIVO');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `productos`
CREATE TABLE `productos` (
  `producto_id` varchar(5) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `categoria_id` varchar(5) NOT NULL,
  `precio` varchar(6) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `especificaciones` varchar(150) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `fabricante_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `productos`
INSERT INTO `productos` (`producto_id`, `nombre_producto`, `categoria_id`, `precio`, `descripcion`, `especificaciones`, `anio`, `fabricante_id`) VALUES
('P0001', 'Tarjeta de Video GeForce RTX 2060', 'CAT01', '10050', 'Tarjeta de video con tecnologia de trazado de rayos', 'Sexta genaracion de tarjetas de video con 6 GB 192-bit GDDR6', '2018', 'F0001'),
('P0002', 'Tarjeta de Video GeForce RTX 3060', 'CAT01', '9000', 'Tarjeta de video con tecnologia de trazado de rayos', 'Sexta genaracion de tarjetas de video con 12 GB 192-bit GDDR6', '2018', 'F0001'),
('P0003', 'Tarjeta de Video GeForce RTX 3060 Ti Gaming', 'CAT01', '11500', 'Tarjeta de video con tecnologia de trazado de rayos ideal para juegos', 'Octava genaracion de tarjetas de video con 8 GB 256-bit GDDR6', '2018', 'F0001'),
('P0004', 'Tarjeta de Video GeForce RTX 3070 Ti vision', 'CAT01', '18000', 'Tarjeta de video con tecnologia de trazado de rayos ideal para juegos', 'Octava genaracion de tarjetas de video con 8 GB 256-bit GDDR6X', '2018', 'F0001'),
('P0005', 'Tarjeta de Video GeForce RTX 3070 Ti Trinity', 'CAT01', '14800', 'Tarjeta de video con tecnologia de trazado de rayos ideal para juegos', 'Tarjeta de video con 8 GB 256-bit GDDR6X', '2018', 'F0001'),
('P0006', 'Tarjeta de Video Zotac GeForce RTX 3080 Ti Trinity', 'CAT01', '27500', 'Tarjeta de video con tecnologia de trazado de rayos ideal para juegos', 'Tarjeta de video con 12 GB 384-bit GDDR6X', '2018', 'F0001'),
('P0007', 'Tarjeta de Video Zotac GeForce RTX 3080 Trinity Gaming LHR', 'CAT01', '21500', 'Tarjeta de video con tecnologia de trazado de rayos ideal para juegos', 'Tarjeta de video con 12 GB 384-bit GDDR6X', '2018', 'F0001'),
('P0008', 'Fuente de Poder NZXT C650 80 PLUS Gold, 24-pin ATX, 650W', 'CAT10', '21000', 'Fuente de poder con certificación 80 Plus Gold capaz de soportar cualquier componentes actuales en el mercado', '24-pin ATX 80 Plus Gold', '2022', 'F0010'),
('P0009', 'Fuente de Poder Gigabyte P450B 80 PLUS Bronze, 20+4 pin ATX, 120mm, 450W', 'CAT10', '10000', 'Fuenta de poder que cuenta con todo lo necesario para una pc de gamma de entrada', '24-pin ATX 80 Plus Bronze', '2020', 'F0001'),
('P0010', 'Fuente de Poder MSI MPG A850GF 80 PLUS Gold, 24-pin ATX, 140mm, 850W', 'CAT10', '25000', 'Fuente de poder con nuevo sistema de enfriamiento y cero ruido durante su uso cotidiano', '24-pin ATX 80 Plus Gold', '2022', 'F0008'),
('P0011', 'Fuente de Poder ASUS ROG Strix 750W 80 PLUS Gold, 20+4 pin ATX, 150mm, 750W', 'CAT10', '27500', 'Fuente de poder con configuracion de ilumincación RGB', '24-pin ATX 80 Plus Gold', '2021', 'F0004'),
('P0012', 'Fuente de Poder Aerocool Cylon 600W 80 PLUS, 20+4 pin ATX, 120mm, 600W', 'CAT10', '1000', 'Fuente de poder con iluminacion rgb compatible con gabinetes de la marca', '24-pin ATX 80 Plus', '2020', 'F0009'),
('P0013', 'Fuente de Poder Thermaltake Toughpower GX2 80 PLUS Gold, 24-pines ATX, 140mm, 600W', 'CAT10', '1300', 'La fuente de poder perfecta para esos setups sencillos y sutiles', '24-pin ATX 80 Plus Gold', '2019', 'F0010'),
('P0014', 'Tarjeta Madre ASUS Micro ATX PRIME A520M-A II CSM, S-AM4, A520, HDMI, 128GB DDR4 para AMD', 'CAT06', '2000', 'Tarje madre de gamma de entrada con sincronizacion aura sync y compatibilidad con M.2', 'AMD A520 Socket AM4 Memoria interna Max 128GB  DDR4-SDRAM', '2020', 'F0004'),
('P0015', 'Tarjeta Madre ASUS ATX ROG Strix B550-F GAMING WIFI II, S-AM4, AMD B550, HDMI, 128GB DDR4 para AMD', 'CAT06', '4000', 'Tarjeta madre con chasis integrado, ilumincacion RGB configurable', 'AMD B550 Socket AM4 Memoria Interna MAX 128GB DDR4-SDRAM', '2022', 'F0004'),
('P0016', 'Tarjeta Madre Gigabyte Micro ATX H410M H V3, S-1200, Intel H510 Express, HDMI, 64GB DDR4 para Intel', 'CAT06', '13000', 'No es compatible con procesadores de generacion 11', 'Intel H510 Socket LGA 1200 Memoria Interna Max 64 GB DDR4-SDRAM', '2019', 'F0010'),
('P0017', 'Tarjeta Madre Gigabyte ATX Z690 AORUS ULTRA, S-1700, Intel Z690 Express, 128GB DDR5 para Intel', 'CAT06', '9300', 'La tarjeta madre de maxima gamma en el mercado', 'Intel Z690 Express Socket LGA 1700 Memoria Interna Max 128 GB DDR5-SDRAM', '2022', 'F0010'),
('P0018', 'Tarjeta Madre NZXT ATX N7 Z490, S-1200, Intel Z490, HDMI, 128GB DDR4 para Intel', 'CAT06', '4100', 'Requiere actualizacion de BIOS para Procesadores Intel 11va Generacion', 'Intel Z490 Socket LGA 1200 Memoria Interna Max 128 GB DDR4-SDRAM', '2020', 'F0010'),
('P0019', 'Tarjeta Madre NZXT ATX N7 Z690 White, S-1700, Intel Z690, HDMI, 128GB DDR4 para Intel', 'CAT06', '27500', 'Conexion Bluetooth y hermosa para esos ensambles color blanco', 'Intel Z690 Socket LGA 1700 Memoria Interna Maxima 128 GB DDR4-SDRAM', '2022', 'F0010'),
('P0020', 'Tarjeta Madre MSI ATX MEG Z690 UNIFY, S-1700, Intel Z690, HDMI, 128GB DDR5 para Intel', 'CAT06', '10100', 'Tarjeta madre equipada con el wifi 6E y incorporada con el nuevo Gen 5 PCI-E', 'Intel Z690 Socket LGA 1700 Memoria Interna Max 128 GB DDR5-SDRAM', '2022', 'F0008');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `tipo_usuario`
CREATE TABLE `tipo_usuario` (
  `tipo_usr_id` varchar(3) NOT NULL,
  `tipo_usr` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `tipo_usuario`
INSERT INTO `tipo_usuario` (`tipo_usr_id`, `tipo_usr`) VALUES
('TU1', 'ADMINISTRADOR_1'),
('TU2', 'ADMINISTRADOR_2'),
('TU3', 'CLIENTE');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `usuarios`
CREATE TABLE `usuarios` (
  `usuario_id` varchar(5) NOT NULL,
  `tipo_usr_id` varchar(3) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `apellido_pat` varchar(50) NOT NULL,
  `apellido_mat` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasenia` varchar(50) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `edad` varchar(5) DEFAULT NULL,
  `direccion_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `usuarios`
INSERT INTO `usuarios` (`usuario_id`, `tipo_usr_id`, `usuario`, `nombre_usuario`, `apellido_pat`, `apellido_mat`, `correo`, `contrasenia`, `telefono`, `edad`, `direccion_id`) VALUES
('U0001', 'TU1', 'DANIELT', 'Daniel', 'Tellez', 'Pineda', 'danielt@gmail.com', 'daniel1234', '5522331122', '21', 'D0004'),
('U0002', 'TU2', 'AGUSTINMART', 'Agustin', 'Martinez', 'Hernandez', 'agustinmartinez@gmail.com', 'AGUSTINMART', '5564231558', '30', 'D0005'),
('U0003', 'TU2', 'PEDROMONTOYA', 'Pedro', 'Hernandez', 'Montoya', 'hernandezpedro81@hotmail.com', 'PEDROMONTOYA', '5548978625', '37', 'D0006'),
('U0004', 'TU1', 'YARETH', 'Yareth', 'Nuñez', 'Gonzales', 'yayis123@gmail.com', 'yareth1234', '5544668899', '21', 'D0007'),
('U0005', 'TU3', 'FELISAMV', 'Felisa', 'Morales', 'Villalonga', 'felisina_villalonga9@gmail.com', 'Felisinita544', '5576610264', '23', 'D0033'),
('U0006', 'TU3', 'RICHARDFLOW', 'Ricardo', 'Flores', 'Ramirez', 'richardflores245@yahoo.com', 'RICHARDFLOW', '5588447535', '27', 'D0009'),
('U0007', 'TU3', 'TANIASANCHEZ', 'Tania', 'Sanchez', 'Perez', 'littletania@hotmail.com', 'TANIASANCHEZ', '5664094073', '35', 'D0010'),
('U0008', 'TU3', 'ROBERTPLATA', 'Roberto', 'Hernandez', 'Plata', 'robertoelturcas@hotmail.com', 'ROBERTPLATA', '5523116458', '60', 'D0011'),
('U0009', 'TU3', 'JULIETAMARTINEZ', 'Julieta', 'Macial', 'Sanchez', 'julietitamarcial11@gmail.com', 'JULIETAMARTINEZ', '5594320125', '25', 'D0012'),
('U0010', 'TU3', 'PANCHOPEREZ', 'Francisco', 'Perez', 'Rodriguez', 'panchopantera@hotmail.com', 'PANCHOPEREZ', '5524912068', '34', 'D0013'),
('U0011', 'TU3', 'ESAVALERY', 'Valeria', 'Fernandez', 'Tovar', 'ezzavaleryxoxo@yahoo.com', 'ESAVALERY', '5589010607', '25', 'D0014'),
('U0012', 'TU3', 'RAQCT', 'Raquel', 'Cases', 'Torres', 'raquelcases23@gmail.com', 'RaqCT', '5581230607', '34', 'D0015'),
('U0013', 'TU3', 'TALAVER', 'Guiomar', 'Talavera', 'Llabrés', 'Talavera21233@yahoo.com', 'Talaver32', '5590696319', '62', 'D0016'),
('U0014', 'TU3', 'ROSENDACV', 'Rosenda', 'Carvajal', 'Valdés', 'RosendaCarVa@gmail.com', 'Ros3nda', '5562932931', '27', 'D0017'),
('U0015', 'TU3', 'GUILLERTOV', 'Guillermo', 'Tovar', 'Arjona', 'GuilleArj0na@hotmail.com', 'Arj0n4Gui', '5579561984', '26', 'D0018'),
('U0016', 'TU3', 'LUPEFAB', 'Lupe', 'Fabregat', 'Palau', 'Palaupe@hotmail.com', 'Palaupe', '5523952012', '24', 'D0019'),
('U0017', 'TU3', 'PILARLL', 'Pilar', 'Llorens', 'Landa', 'pilarllorensllanda@gmail.com', 'Pilar2', '5553679963', '21', 'D0020'),
('U0018', 'TU3', 'CARLOCT', 'Carlito Octavio', 'Morera', 'Torre', 'octavioMoreraT@hotmai.com', 'Carlito0', '5546893624', '31', 'D0021'),
('U0019', 'TU3', 'CARLAVAL', 'Carla', 'Valentin', 'Aguilo', 'carlitaAg@yahoo.com', 'CarlaAguilo', '5599961267', '28', 'D0022'),
('U0020', 'TU3', 'JAVIERJSM', 'Javier Jose', 'Soto', 'Maldonado', 'JJmadlonado@gmail.com', 'Maldonad0', '5569734091', '36', 'D0023'),
('U0021', 'TU3', 'CAMILOOV', 'Camilo', 'Orozco', 'Vall', 'CvallOrozco@gmail.com', 'CVall', '5598414149', '40', 'D0024'),
('U0022', 'TU3', 'BENITOF', 'Benito', 'Francisco', 'Angel', 'benito_angel@gmail.com', 'Benis', '5578717614', '24', 'D0025'),
('U0023', 'TU3', 'TONIP', 'Toni', 'Pineiro', 'Amo', 'pineiro@yahoo.com', 'Tonimo', '5530697560', '23', 'D0026'),
('U0024', 'TU3', 'HERACLIOC', 'Heraclio', 'Canellas', 'Rivera', 'Heracliorivera_12@outlook.com', 'Canell4s', '5570289121', '22', 'D0027'),
('U0025', 'TU3', 'AMERICAP', 'America', 'Pujol', 'Andres', 'pujol_ame@outlook.com', 'AmericaPA', '5535593365', '54', 'D0028'),
('U0026', 'TU3', 'DIONSIO', 'Dionisio', 'Bru', 'Padilla', 'bru@outlook.com', 'Bru6546', '5536610679', '43', 'D0029'),
('U0027', 'TU3', 'VICTORV', 'Victor', 'Vigil', 'Parra', 'parra12323_vigil@outlook.com', 'VickParra', '5535443571', '26', 'D0030'),
('U0028', 'TU3', 'NATIVIDADPT', 'Natividad', 'Pujol', 'Tovar', 't0v4rnatividad@gmail.com', 'TovarNa', '5584647197', '30', 'D0031'),
('U0029', 'TU3', 'MARCIAHOZ', 'Marcia', 'Hoz', 'Anglada', 'hoz_marciaAnglada1@gmail.com', 'Hoz56456', '5533056618', '62', 'D0032');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `usuarios2`
CREATE TABLE `usuarios2` (
  `usuario_id` varchar(5) NOT NULL,
  `tipo_usr_id` varchar(3) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `apellido_pat` varchar(50) NOT NULL,
  `apellido_mat` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasenia` varchar(50) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `edad` varchar(5) DEFAULT NULL,
  `direccion_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `usuarios2`
INSERT INTO `usuarios2` (`usuario_id`, `tipo_usr_id`, `usuario`, `nombre_usuario`, `apellido_pat`, `apellido_mat`, `correo`, `contrasenia`, `telefono`, `edad`, `direccion_id`) VALUES
('U0001', 'TU1', 'DANIELT', 'Daniel', 'Tellez', 'Pineda', 'danielt@gmail.com', 'daniel1234', '5522331122', '21', 'D0004'),
('U0002', 'TU2', 'AGUSTINMART', 'Agustin', 'Martinez', 'Hernandez', 'agustinmartinez@gmail.com', 'AGUSTINMART', '5564231558', '30', 'D0005'),
('U0003', 'TU2', 'PEDROMONTOYA', 'Pedro', 'Hernandez', 'Montoya', 'hernandezpedro81@hotmail.com', 'PEDROMONTOYA', '5548978625', '37', 'D0006'),
('U0004', 'TU1', 'YARETH', 'Yareth', 'Nuñez', 'Gonzales', 'yayis123@gmail.com', 'yareth1234', '5544668899', '21', 'D0007'),
('U0005', 'TU3', 'FELISAMV', 'Felisa', 'Morales', 'Villalonga', 'felisina_villalonga9@gmail.com', 'Felisinita544', '5576610264', '23', 'D0033'),
('U0006', 'TU3', 'RICHARDFLOW', 'Ricardo', 'Flores', 'Ramirez', 'richardflores245@yahoo.com', 'RICHARDFLOW', '5588447535', '27', 'D0009'),
('U0007', 'TU3', 'TANIASANCHEZ', 'Tania', 'Sanchez', 'Perez', 'littletania@hotmail.com', 'TANIASANCHEZ', '5664094073', '35', 'D0010'),
('U0008', 'TU3', 'ROBERTPLATA', 'Roberto', 'Hernandez', 'Plata', 'robertoelturcas@hotmail.com', 'ROBERTPLATA', '5523116458', '60', 'D0011'),
('U0009', 'TU3', 'JULIETAMARTINEZ', 'Julieta', 'Macial', 'Sanchez', 'julietitamarcial11@gmail.com', 'JULIETAMARTINEZ', '5594320125', '25', 'D0012'),
('U0010', 'TU3', 'PANCHOPEREZ', 'Francisco', 'Perez', 'Rodriguez', 'panchopantera@hotmail.com', 'PANCHOPEREZ', '5524912068', '34', 'D0013'),
('U0011', 'TU3', 'ESAVALERY', 'Valeria', 'Fernandez', 'Tovar', 'ezzavaleryxoxo@yahoo.com', 'ESAVALERY', '5589010607', '25', 'D0014'),
('U0012', 'TU3', 'RAQCT', 'Raquel', 'Cases', 'Torres', 'raquelcases23@gmail.com', 'RaqCT', '5581230607', '34', 'D0015'),
('U0013', 'TU3', 'TALAVER', 'Guiomar', 'Talavera', 'Llabrés', 'Talavera21233@yahoo.com', 'Talaver32', '5590696319', '62', 'D0016'),
('U0014', 'TU3', 'ROSENDACV', 'Rosenda', 'Carvajal', 'Valdés', 'RosendaCarVa@gmail.com', 'Ros3nda', '5562932931', '27', 'D0017'),
('U0015', 'TU3', 'GUILLERTOV', 'Guillermo', 'Tovar', 'Arjona', 'GuilleArj0na@hotmail.com', 'Arj0n4Gui', '5579561984', '26', 'D0018'),
('U0016', 'TU3', 'LUPEFAB', 'Lupe', 'Fabregat', 'Palau', 'Palaupe@hotmail.com', 'Palaupe', '5523952012', '24', 'D0019'),
('U0017', 'TU3', 'PILARLL', 'Pilar', 'Llorens', 'Landa', 'pilarllorensllanda@gmail.com', 'Pilar2', '5553679963', '21', 'D0020'),
('U0018', 'TU3', 'CARLOCT', 'Carlito Octavio', 'Morera', 'Torre', 'octavioMoreraT@hotmai.com', 'Carlito0', '5546893624', '31', 'D0021'),
('U0019', 'TU3', 'CARLAVAL', 'Carla', 'Valentin', 'Aguilo', 'carlitaAg@yahoo.com', 'CarlaAguilo', '5599961267', '28', 'D0022'),
('U0020', 'TU3', 'JAVIERJSM', 'Javier Jose', 'Soto', 'Maldonado', 'JJmadlonado@gmail.com', 'Maldonad0', '5569734091', '36', 'D0023'),
('U0021', 'TU3', 'CAMILOOV', 'Camilo', 'Orozco', 'Vall', 'CvallOrozco@gmail.com', 'CVall', '5598414149', '40', 'D0024'),
('U0022', 'TU3', 'BENITOF', 'Benito', 'Francisco', 'Angel', 'benito_angel@gmail.com', 'Benis', '5578717614', '24', 'D0025'),
('U0023', 'TU3', 'TONIP', 'Toni', 'Pineiro', 'Amo', 'pineiro@yahoo.com', 'Tonimo', '5530697560', '23', 'D0026'),
('U0024', 'TU3', 'HERACLIOC', 'Heraclio', 'Canellas', 'Rivera', 'Heracliorivera_12@outlook.com', 'Canell4s', '5570289121', '22', 'D0027'),
('U0025', 'TU3', 'AMERICAP', 'America', 'Pujol', 'Andres', 'pujol_ame@outlook.com', 'AmericaPA', '5535593365', '54', 'D0028'),
('U0026', 'TU3', 'DIONSIO', 'Dionisio', 'Bru', 'Padilla', 'bru@outlook.com', 'Bru6546', '5536610679', '43', 'D0029'),
('U0027', 'TU3', 'VICTORV', 'Victor', 'Vigil', 'Parra', 'parra12323_vigil@outlook.com', 'VickParra', '5535443571', '26', 'D0030'),
('U0028', 'TU3', 'NATIVIDADPT', 'Natividad', 'Pujol', 'Tovar', 't0v4rnatividad@gmail.com', 'TovarNa', '5584647197', '30', 'D0031'),
('U0029', 'TU3', 'MARCIAHOZ', 'Marcia', 'Hoz', 'Anglada', 'hoz_marciaAnglada1@gmail.com', 'Hoz56456', '5533056618', '62', 'D0032');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `venta`
CREATE TABLE `venta` (
  `venta_id` varchar(7) NOT NULL,
  `usuario_id` varchar(5) NOT NULL,
  `producto_id` varchar(5) NOT NULL,
  `fecha_venta` date NOT NULL,
  `metodo_pago_id` varchar(3) DEFAULT NULL,
  `envio_id` varchar(5) DEFAULT NULL,
  `precio_total` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `venta`
INSERT INTO `venta` (`venta_id`, `usuario_id`, `producto_id`, `fecha_venta`, `metodo_pago_id`, `envio_id`, `precio_total`) VALUES
('2201001', 'U0006', 'P0001', '2029-10-22', 'M2', 'E01', '101'),
('2201002', 'U0007', 'P0002', '2001-11-22', 'M2', 'E02', '907'),
('2201003', 'U0007', 'P0003', '2002-11-22', 'M2', 'E01', '910'),
('2201004', 'U0008', 'P0004', '2016-12-22', 'M2', 'E01', '115'),
('2201005', 'U0008', 'P0005', '2002-01-23', 'M2', 'E01', '180'),
('2201006', 'U0009', 'P0006', '2003-01-23', 'M3', 'E01', '148'),
('2201007', 'U0010', 'P0007', '2005-02-23', 'M3', 'E01', '275'),
('2201008', 'U0011', 'P0008', '2006-02-23', 'M3', 'E01', '215'),
('2201009', 'U0012', 'P0009', '2007-02-23', 'M3', 'E01', '210'),
('2201010', 'U0013', 'P0010', '2015-02-23', 'M3', 'E02', '100'),
('2201011', 'U0014', 'P0012', '2020-02-23', 'M3', 'E02', '250'),
('2202001', 'U0015', 'P0013', '2022-02-23', 'M1', 'E02', '275'),
('2202002', 'U0016', 'P0014', '2024-02-23', 'M1', 'E01', '100'),
('2202003', 'U0017', 'P0015', '2003-03-23', 'M1', 'E02', '130'),
('2203001', 'U0018', 'P0016', '2006-03-23', 'M1', 'E02', '410'),
('2203002', 'U0019', 'P0017', '2016-03-23', 'M1', 'E02', '275'),
('2203003', 'U0020', 'P0018', '2017-03-23', 'M2', 'E02', '101'),
('2203004', 'U0021', 'P0019', '2020-03-23', 'M2', 'E02', '130');

--
-- Índices para tablas volcadas
--

-- Indices de la tabla `categoria`
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

-- Indices de la tabla `direccion`
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`direccion_id`),
  ADD KEY `estado_id` (`estado_id`);

-- Indices de la tabla `envio`
ALTER TABLE `envio`
  ADD PRIMARY KEY (`envio_id`);

-- Indices de la tabla `estado`
ALTER TABLE `estado`
  ADD PRIMARY KEY (`edo_id`);

-- Indices de la tabla `fabricante`
ALTER TABLE `fabricante`
  ADD PRIMARY KEY (`fabricante_id`);

-- Indices de la tabla `metodo_pago`
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`metodo_pago_id`);

-- Indices de la tabla `productos`
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `fabricante_id` (`fabricante_id`);

-- Indices de la tabla `tipo_usuario`
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`tipo_usr_id`);

-- Indices de la tabla `usuarios`
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `direccion_id` (`direccion_id`),
  ADD KEY `tipo_usr_id` (`tipo_usr_id`);

-- Indices de la tabla `usuarios2`
ALTER TABLE `usuarios2`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `direccion_id` (`direccion_id`),
  ADD KEY `tipo_usr_id` (`tipo_usr_id`);

-- Indices de la tabla `venta`
ALTER TABLE `venta`
  ADD PRIMARY KEY (`venta_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `metodo_pago_id` (`metodo_pago_id`),
  ADD KEY `envio_id` (`envio_id`);

--
-- Restricciones para tablas volcadas
--

-- Filtros para la tabla `direccion`
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`edo_id`);

-- Filtros para la tabla `productos`
ALTER TABLE `productos`
  ADD CONSTRAINT `categoria_id` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  ADD CONSTRAINT `fabricante_id` FOREIGN KEY (`fabricante_id`) REFERENCES `fabricante` (`fabricante_id`);

-- Filtros para la tabla `usuarios`
ALTER TABLE `usuarios`
  ADD CONSTRAINT `direccion_id` FOREIGN KEY (`direccion_id`) REFERENCES `direccion` (`direccion_id`),
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipo_usr_id`) REFERENCES `tipo_usuario` (`tipo_usr_id`);

-- Filtros para la tabla `usuarios2`
ALTER TABLE `usuarios2`
  ADD CONSTRAINT `usuarios2_ibfk_1` FOREIGN KEY (`tipo_usr_id`) REFERENCES `tipo_usuario` (`tipo_usr_id`);

-- Filtros para la tabla `venta`
ALTER TABLE `venta`
  ADD CONSTRAINT `envio_id` FOREIGN KEY (`envio_id`) REFERENCES `envio` (`envio_id`),
  ADD CONSTRAINT `metodo_pago_id` FOREIGN KEY (`metodo_pago_id`) REFERENCES `metodo_pago` (`metodo_pago_id`),
  ADD CONSTRAINT `producto_id` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`),
  ADD CONSTRAINT `usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);
COMMIT;
