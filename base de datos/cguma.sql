-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2016 a las 16:36:10
-- Versión del servidor: 10.1.8-MariaDB
-- Versión de PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cguma`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id` int(10) UNSIGNED NOT NULL,
  `tema_id` int(10) UNSIGNED NOT NULL,
  `subtema_id` int(10) UNSIGNED DEFAULT NULL,
  `subsubtema_id` int(10) UNSIGNED DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `nombre_actividad` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `id` int(10) UNSIGNED NOT NULL,
  `tema_id` int(10) UNSIGNED NOT NULL,
  `subtema_id` int(10) UNSIGNED DEFAULT NULL,
  `subsubtema_id` int(10) UNSIGNED DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `tipo` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionario`
--

CREATE TABLE `cuestionario` (
  `id` int(10) UNSIGNED NOT NULL,
  `tema_id` int(10) UNSIGNED NOT NULL,
  `subtema_id` int(10) UNSIGNED DEFAULT NULL,
  `subsubtema_id` int(10) UNSIGNED DEFAULT NULL,
  `pregunta` varchar(100) DEFAULT NULL,
  `opciones` text,
  `respuestas` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `nrc` int(5) UNSIGNED DEFAULT NULL,
  `asesor` varchar(45) DEFAULT NULL,
  `asistente` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `nombre`, `nrc`, `asesor`, `asistente`, `descripcion`) VALUES
(9, 'Programación avanzada', 12345, NULL, NULL, 'curso de programacion avanzada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE `ejercicio` (
  `id` int(10) UNSIGNED NOT NULL,
  `tema_id` int(10) UNSIGNED NOT NULL,
  `subtema_id` int(10) UNSIGNED DEFAULT NULL,
  `subsubtema_id` int(10) UNSIGNED DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  `ejercicio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'administrador', ''),
(2, 'estudiante', ''),
(3, 'maestro', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) NOT NULL,
  `curso_id` int(10) UNSIGNED NOT NULL,
  `activo` int(10) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`id`, `users_id`, `curso_id`, `activo`) VALUES
(25, 4, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id` int(10) UNSIGNED NOT NULL,
  `contenido_id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_actividad`
--

CREATE TABLE `reg_actividad` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) NOT NULL,
  `actividad_id` int(10) UNSIGNED NOT NULL,
  `inicio` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `avance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_contenido`
--

CREATE TABLE `reg_contenido` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) NOT NULL,
  `contenido_id` int(10) UNSIGNED NOT NULL,
  `inicio` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `comenzado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_cuestionario`
--

CREATE TABLE `reg_cuestionario` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) NOT NULL,
  `cuestionario_id` int(10) UNSIGNED NOT NULL,
  `inicio` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `avance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_ejercicio`
--

CREATE TABLE `reg_ejercicio` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) NOT NULL,
  `ejercicio_id` int(10) UNSIGNED NOT NULL,
  `inicio` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `avance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_sesion`
--

CREATE TABLE `reg_sesion` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) NOT NULL,
  `inicio` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reg_sesion`
--

INSERT INTO `reg_sesion` (`id`, `users_id`, `inicio`, `fin`) VALUES
(23, 4, '2015-11-09 19:40:26', '2016-02-24 14:44:32'),
(24, 4, '2015-11-09 19:42:57', '2016-02-24 14:44:32'),
(25, 4, '2015-11-09 20:06:27', '2016-02-24 14:44:32'),
(26, 4, '2015-11-09 20:12:13', '2016-02-24 14:44:32'),
(27, 4, '2015-11-09 20:24:46', '2016-02-24 14:44:32'),
(28, 4, '2015-11-09 20:49:03', '2016-02-24 14:44:32'),
(29, 4, '2015-11-09 20:51:53', '2016-02-24 14:44:32'),
(30, 4, '2015-11-09 20:56:47', '2016-02-24 14:44:32'),
(31, 4, '2015-11-09 21:15:02', '2016-02-24 14:44:32'),
(32, 4, '2015-11-10 23:59:29', '2016-02-24 14:44:32'),
(33, 4, '2015-11-11 23:08:45', '2016-02-24 14:44:32'),
(34, 4, '2015-11-12 05:36:48', '2016-02-24 14:44:32'),
(35, 4, '2015-11-13 07:03:28', '2016-02-24 14:44:32'),
(36, 4, '2015-11-13 07:03:29', '2016-02-24 14:44:32'),
(37, 4, '2015-12-07 18:28:57', '2016-02-24 14:44:32'),
(38, 4, '2015-12-07 20:21:33', '2016-02-24 14:44:32'),
(39, 4, '2015-12-07 20:36:02', '2016-02-24 14:44:32'),
(40, 4, '2015-12-11 23:56:36', '2016-02-24 14:44:32'),
(41, 4, '2015-12-12 02:03:20', '2016-02-24 14:44:32'),
(42, 4, '2015-12-14 22:09:57', '2016-02-24 14:44:32'),
(43, 4, '2015-12-14 23:51:24', '2016-02-24 14:44:32'),
(44, 4, '2015-12-14 23:57:48', '2016-02-24 14:44:32'),
(45, 4, '2015-12-15 00:10:55', '2016-02-24 14:44:32'),
(46, 4, '2015-12-15 04:29:41', '2016-02-24 14:44:32'),
(47, 4, '2015-12-30 19:29:30', '2016-02-24 14:44:32'),
(48, 4, '2015-12-30 22:31:31', '2016-02-24 14:44:32'),
(49, 4, '2015-12-30 22:55:59', '2016-02-24 14:44:32'),
(50, 4, '2015-12-31 16:34:28', '2016-02-24 14:44:32'),
(51, 4, '2016-01-20 19:16:48', '2016-02-24 14:44:32'),
(52, 4, '0000-00-00 00:00:00', '2016-02-24 14:44:32'),
(53, 4, '0000-00-00 00:00:00', '2016-02-24 14:44:32'),
(54, 4, '0000-00-00 00:00:00', '2016-02-24 14:44:32'),
(55, 4, '0000-00-00 00:00:00', '2016-02-24 14:44:32'),
(56, 4, '0000-00-00 00:00:00', '2016-02-24 14:44:32'),
(57, 4, '0000-00-00 00:00:00', '2016-02-24 14:44:32'),
(58, 4, '0000-00-00 00:00:00', '2016-02-24 14:44:32'),
(59, 4, '0000-00-00 00:00:00', '2016-02-24 14:44:32'),
(60, 4, '0000-00-00 00:00:00', '2016-02-24 14:44:32'),
(61, 4, '0000-00-00 00:00:00', '2016-02-24 14:44:32'),
(62, 4, '2016-02-20 21:00:00', '2016-02-24 14:44:32'),
(63, 4, '2016-02-20 22:00:00', '2016-02-24 14:44:32'),
(64, 4, '2016-02-24 14:00:00', '2016-02-24 14:44:32'),
(65, 4, '2016-02-24 14:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`id`, `ip_address`, `user_agent`, `timestamp`, `data`) VALUES
('082bd5c7e1e78aad25f8d89dc26e95088fef91b4', '::1', '', 1456323305, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332333032383b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231343530223b6e6f6d6272657c733a383a2269736964726f6f6d223b637572736f7c733a313a2239223b74656d617c733a313a2232223b73756274656d617c733a313a2231223b73756273756274656d617c733a313a2231223b),
('0d9cb9cda471c511f1e6d63984a6bea353abba77', '::1', '', 1456322976, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332323732323b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231343530223b6e6f6d6272657c733a383a2269736964726f6f6d223b637572736f7c733a313a2239223b74656d617c733a313a2231223b73756274656d617c733a313a2231223b73756273756274656d617c733a313a2231223b),
('158c71eccbe27983d5964c8cc6acaa03e940b5f8', '::1', '', 1456322688, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332323430343b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231343530223b6e6f6d6272657c733a383a2269736964726f6f6d223b637572736f7c733a313a2239223b74656d617c733a313a2231223b73756274656d617c733a313a2231223b),
('1a0b69d544d01e2f77d57c6129cb69d95342b89b', '::1', '', 1456326332, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332363036373b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231343530223b6e6f6d6272657c733a383a2269736964726f6f6d223b637572736f7c733a313a2239223b74656d617c733a313a2232223b73756274656d617c733a313a2231223b73756273756274656d617c733a313a2231223b),
('1a23e499281bff4cc3e4d76de1fdede916bdceae', '::1', '', 1456322393, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332323236373b6964656e746974797c733a32303a226d61657374726f2070726f6772616d6163696f6e223b757365726e616d657c733a32303a226d61657374726f2070726f6772616d6163696f6e223b656d61696c7c733a32323a226973686f6b6f67676664676d40676d61696c2e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231353736223b6e6f6d6272657c733a32303a226d61657374726f2070726f6772616d6163696f6e223b),
('1edbda2544cd1df9a68fd7afa57405c5b7fd7ac7', '::1', '', 1456328124, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332383132343b),
('23f499e0649ce591d2e05a7c5562077c9f17b910', '::1', '', 1456321475, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332313232303b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536303034333139223b6e6f6d6272657c733a383a2269736964726f6f6d223b),
('2529a539b08e4361a2d4fb0854a6045eba5eb84e', '::1', '', 1456325129, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332343833373b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231343530223b6e6f6d6272657c733a383a2269736964726f6f6d223b637572736f7c733a313a2239223b74656d617c733a313a2232223b73756274656d617c733a313a2231223b73756273756274656d617c733a313a2231223b),
('269cef127eb8a9b6a822b57727a31282bdd72303', '::1', '', 1456323834, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332333634383b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231343530223b6e6f6d6272657c733a383a2269736964726f6f6d223b637572736f7c733a313a2239223b74656d617c733a313a2232223b73756274656d617c733a313a2231223b73756273756274656d617c733a313a2231223b),
('275e30462664a9fe04150b0b907f23d240846142', '::1', '', 1456159152, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363135393135323b),
('3291cd965db0eac56c92a9483a7444193430702e', '::1', '', 1456321832, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332313636313b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231343530223b6e6f6d6272657c733a383a2269736964726f6f6d223b637572736f7c733a313a2239223b),
('37af169b9acc2ef0d7c24d714a84e3ca7946571b', '::1', '', 1456158704, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363135383433363b6964656e746974797c733a31333a2261646d696e6973747261746f72223b757365726e616d657c733a31333a2261646d696e6973747261746f72223b656d61696c7c733a32353a227369732e7361657363702e61646d6940676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536303037393039223b6e6f6d6272657c733a31333a2261646d696e6973747261646f72223b),
('3bcdca0f7a89cd4886ec97f9d35bccaefa1f9c0a', '::1', '', 1456322221, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332323034323b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231343530223b6e6f6d6272657c733a383a2269736964726f6f6d223b637572736f7c733a313a2239223b74656d617c733a313a2231223b),
('3f0c857028b68225fe0c05be42134b7db768e6a6', '::1', '', 1456326644, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332363431343b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231343530223b6e6f6d6272657c733a383a2269736964726f6f6d223b637572736f7c733a313a2239223b74656d617c733a313a2232223b73756274656d617c733a313a2231223b73756273756274656d617c733a313a2231223b),
('404e392a409c7ec1f6a742bd503c19d4a42ce98c', '::1', '', 1456323240, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332333233393b6964656e746974797c733a32303a226d61657374726f2070726f6772616d6163696f6e223b757365726e616d657c733a32303a226d61657374726f2070726f6772616d6163696f6e223b656d61696c7c733a32323a226973686f6b6f67676664676d40676d61696c2e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231353736223b6e6f6d6272657c733a32303a226d61657374726f2070726f6772616d6163696f6e223b),
('61b0cf0b21156fece43bcf8982fc57b2e7566eae', '::1', '', 1456324075, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332333937363b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231343530223b6e6f6d6272657c733a383a2269736964726f6f6d223b637572736f7c733a313a2239223b74656d617c733a313a2232223b73756274656d617c733a313a2231223b73756273756274656d617c733a313a2231223b),
('98c5f75fa0399d302232735180573c6a24d20a22', '::1', '', 1456153884, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363135333838303b),
('bac9439dac3fb5c92c5b03026c64a4ab823da493', '::1', '', 1456327274, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332373034343b6d6573736167657c733a3233383a223c64697620636c6173733d22746578742d2020616c65727420616c6572742d73756363657373223e3c6120636c6173733d222020636c6f736520202220646174612d6469736d6973733d22616c65727422203e583c2f613e3c6920636c6173733d22676c79706869636f6e20676c79706869636f6e2d696e666f2d7369676e223e3c2f693e266e6273703b266e6273703b266e6273703b3c64697620636c6173733d22746578742d63656e746572223e4e7565766120636f6e7472617365c3b16120656e766961646120706f7220636f7272656f20656c65637472c3b36e69636f2e3c2f6469763e3c2f6469763e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('d0f043be5bb5d09bb2612d356a61492a0218c083', '::1', '', 1456323646, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332333334313b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231343530223b6e6f6d6272657c733a383a2269736964726f6f6d223b637572736f7c733a313a2239223b74656d617c733a313a2232223b73756274656d617c733a313a2231223b73756273756274656d617c733a313a2231223b),
('e0712a1fd4daba6d8a47db0d9dd8025dae2020b7', '::1', '', 1456325421, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332353133393b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231343530223b6e6f6d6272657c733a383a2269736964726f6f6d223b637572736f7c733a313a2239223b74656d617c733a313a2232223b73756274656d617c733a313a2231223b73756273756274656d617c733a313a2231223b),
('e78b4c3f533f0715367cab28c53f3bcd6e47228a', '::1', '', 1456325699, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332353533323b6964656e746974797c733a393a22733039303131353539223b757365726e616d657c733a393a22733039303131353539223b656d61696c7c733a31373a226973686f6b6f6d40676d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231343530223b6e6f6d6272657c733a383a2269736964726f6f6d223b637572736f7c733a313a2239223b74656d617c733a313a2232223b73756274656d617c733a313a2231223b73756273756274656d617c733a313a2231223b),
('f74516f39d2228eabca5c02d1801911e636feb79', '::1', '', 1456322244, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435363332313932353b6964656e746974797c733a32303a226d61657374726f2070726f6772616d6163696f6e223b757365726e616d657c733a32303a226d61657374726f2070726f6772616d6163696f6e223b656d61696c7c733a32323a226973686f6b6f67676664676d40676d61696c2e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343536333231353736223b6e6f6d6272657c733a32303a226d61657374726f2070726f6772616d6163696f6e223b);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subsubtema`
--

CREATE TABLE `subsubtema` (
  `id` int(10) UNSIGNED NOT NULL,
  `subtema_id` int(10) UNSIGNED NOT NULL,
  `numero` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subsubtema`
--

INSERT INTO `subsubtema` (`id`, `subtema_id`, `numero`, `nombre`, `descripcion`) VALUES
(1, 1, 1, 'subusbtema 1', 'descripcion ejemplo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtema`
--

CREATE TABLE `subtema` (
  `id` int(10) UNSIGNED NOT NULL,
  `tema_id` int(10) UNSIGNED NOT NULL,
  `numero` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subtema`
--

INSERT INTO `subtema` (`id`, `tema_id`, `numero`, `nombre`, `descripcion`) VALUES
(1, 1, 1, 'algoritmo', 'definicion de algoritmo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `id` int(10) UNSIGNED NOT NULL,
  `curso_id` int(10) UNSIGNED NOT NULL,
  `numero` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`id`, `curso_id`, `numero`, `nombre`, `descripcion`) VALUES
(1, 9, 1, 'Conceptos basicos', 'Solo conceptos introductorios'),
(2, 9, 1, 'pasos para resolucion', 'pasoos,.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(60) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `last_login` int(11) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `activation_code` varchar(40) NOT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `nombre`, `active`, `password`, `email`, `last_login`, `salt`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`) VALUES
(1, '127.0.0.1', 'administrator', 'administrador', 1, '$2y$08$tNzVGAUS8TFs5gYpM8vzoOM9JQOR9KXUDzydUb0hgBfbvYir3Uhqu', 'sis.saescp.admi@gmail.com', 1456327859, '', '', 'isAiBlhv54wRTpVqFi9Siu1ce9024d99f51aaf64', 1456005491, NULL, 1268889823),
(4, '::1', 's09011559', 'isidroom', 1, '$2y$08$wKcca7un.rUJGZOJWu1pjOxBZ7OPvjwQv7qWwQMs4LJkVYh1Q0Bne', 'ishokom@gmail.com', 1456321673, NULL, '', 'nSbRLC36lgKYZoZ8cgOHqe6fae8f883249f178aa', 1456327271, 'TSBb8Vg0Y9RrwgR/HqT.n.', 1446764003),
(5, '::1', 'maestro programacion', 'maestro programacion', 1, '$2y$08$zVQkLsSkxS0MqpTNF/YYFeD6pZRpeuUMsxsDKjp.4ivy9l1TEqr7y', 'ishokoggfdgm@gmail.com', 1456327413, NULL, '', 'MDgwl3aBe73MjkVJHozuIOc3c79ed5e8e51d1231', 1448394297, NULL, 1446764213),
(6, '::1', 's00000000', 'isidro om', 0, '$2y$08$kTKLxexKCS0sJ6Vr187bnuNYhDXPuwF7hjY.5nJaVqOIpA.0c0Zii', 'ishokom@gmail.com', NULL, NULL, '', 'qKI2kMtk2GKS-.kMYm82Iu1731aa60cac8902524', 1449871963, NULL, 1446858085),
(7, '::1', 'stjfhfghfg', 'isidro om', 0, '$2y$08$5UsFUloiksYDFNTf442oE.s2.RzNc92Fj7Epbcyo5TxlnG23yIBau', 'ishokom@gmail.com', NULL, NULL, '', NULL, NULL, NULL, 1446858435),
(8, '::1', 'fgdgfdgfdgf', 'isidro om', 1, '$2y$08$HIwmUAyw.qPDipNN2pPaduUezX/r6APqHNtUb0VWF0xvCY5qlkN6u', 'ishokom@gmail.com', NULL, NULL, '', NULL, NULL, NULL, 1446859679),
(9, '::1', 's00000001', 'isidro om', 1, '$2y$08$yAXo5qa29v0HWIaggBAMOOkclap2VtLo7WnrY0f74X05tWXCqX21a', 'ishokom@gmail.comd', NULL, NULL, '', '0sQpfWmOMy2SeCFcIz504e099410e48a18b374db', 1448326418, NULL, 1446861007),
(11, '::1', 'vfdsfsdfdsdsfdsfdfsdsfsdsf', 'sfdsfsdfsdf', 0, '$2y$08$W7czRviGylqUILC2HEF3GOLNZ9Sl8OcnfbQHzeAOpO0qnXIeAk/IG', 'xcvcxvxc@sfsdf.sdfsd', NULL, NULL, '', 'QJxRc55HgF80eXXEyzbLeue1d9feda0f02b2e651', 1448326875, NULL, 1447020441),
(12, '::1', 's11111111', 'fgfgfhgfhfg', 0, '$2y$08$x96ZTaYI5jEfCLPgiusEk.430m/SGtiI1KxzqpzLTxn8LV.OePa1m', 'sdfdgfdg@sdfgdg.gfdgfd', NULL, NULL, '', NULL, NULL, NULL, 1447027324),
(14, '::1', 'sfsfsdffsdf', 'isidroo om', 0, '$2y$08$Z0qDD91kNULJcH85p9199eN91/YIetPZsIL913M6IVmIfTA6iEnHi', 'snfjdgfd@dfgfd.fdgfd', NULL, NULL, '', NULL, NULL, NULL, 1448319933),
(16, '::1', 'sdfdsfdsfdsf', 'fsdfsdfdsfds', 0, '$2y$08$v8xZREbAl5ckEDkL3eC0xO/5ZF4e/KyhXUaYHerxTIAvS4eD4.9g6', 'fdsfdsfds@dgfdg.fgfd', NULL, NULL, '', NULL, NULL, NULL, 1448334300),
(17, '::1', 'dfgfdgfdgfdg', '46fddfgdfgfdg546', 0, '$2y$08$WRWTfAIk1ghk/Vw18xrMf.Xj30MU2MbPCJCqxk8UjHfVK3pnkCK.O', 'gfdgfdgfd@sdfdgf.fdgfd', NULL, NULL, '', NULL, NULL, NULL, 1448334414),
(19, '::1', 's00000007', 'isidrooom', 1, '$2y$08$q1GrcWFBxay2ZGVnlo1QPO6nUCEvxw6QsVSYGYq50TFC/q3rako3q', 'mkmkmd@fdsfds.jgj', NULL, NULL, '', 'QKXgVJ0uQ7YdLk-TQb-Kpuf5d50723ca042e30d2', 1453481591, NULL, 1449871032),
(21, '::1', 's09011111', 'isidroom', 0, '$2y$08$lFBAgbKxJyIDYMXmC9/mNOQi0miQ6JSSu8KiWT70k4bk0h1LJAjJC', 'jemplo@dgdfg.fgfgffg', NULL, NULL, '', NULL, NULL, NULL, 1453311258),
(22, '::1', 's09111111', 'isidroom', 0, '$2y$08$ZFHrL1N0nsimiBTZ9OL4F.W4oI1SOCkn.5regHfFX0W6.y5u61PQy', 'jemplo@dgdfg.fgfgffg', NULL, NULL, '', NULL, NULL, NULL, 1453311340),
(23, '::1', 's09111101', 'isidroom', 0, '$2y$08$aA.O2G.uTW263vCT26UWk.AoOIPm6tQxJdb1SF8qmOoNTp5gDf5AW', 'jemplo@dgdfg.fgfgffg', NULL, NULL, '', NULL, NULL, NULL, 1453311378),
(24, '::1', 'hfghgfhgfhgfh', 'hgfhgfhgfh', 0, '$2y$08$FRTW5r8pOJyj58pDAXAP9.PKbLWpjzlXvlemKXBbJsn/6/5374idC', 'hhgfhg@ff.sdk', NULL, NULL, '', NULL, NULL, NULL, 1453411920),
(25, '::1', 'gfdgfdgfd', 'fdgfdgfdg', 0, '$2y$08$nNmH2zqe3H.7kKPVYoF12u6egtOcy.h5J1UgI66kWKe/z.WFRjJXG', 'fdgfdgdf@fhgfh.hhrd', NULL, NULL, '', NULL, NULL, NULL, 1455050158),
(26, '::1', 'nkjjknjnjn', 'jknjknjnjnjnj', 0, '$2y$08$XnE.ccZ7H/r98J16IOX.R.dm81VMcEw2OX.EIMwnHL18bYP3KY4o6', 'dfdgfdg@fggfd.dfgd', NULL, NULL, '', NULL, NULL, NULL, 1456005044),
(27, '::1', 's00090000', 'jknjknjnjnjnj', 0, '$2y$08$JUvQWnjGhYTlxgrPGA1ZLuah3H6X5k/nMXYIktRU.UqHwck72WTZe', 'dfdgfdg@fggfd.dfgd', NULL, NULL, '', NULL, NULL, NULL, 1456005069),
(28, '::1', ' jknjnjknjnj', 'kjsdnjfndfndk', 0, '$2y$08$oie0vL6/JTsrWud0exyqjeIoVyU3XCqGdVn72YkUV86mlno.EsuM2', 'fjdkvnjfd@ndsnjkf.ddgfd', NULL, NULL, '', NULL, NULL, NULL, 1456005606),
(29, '::1', ' jknjnjinjnj', 'kjsdnjfndfndk', 0, '$2y$08$uvltEhRd28uEZuQ9kpH5fe4tQn3KZt0cdnPOl4p2u554WriwCxWl6', 'fjdkvnjfd@ndsnjkf.ddgfd', NULL, NULL, '', NULL, NULL, NULL, 1456005678);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `groups_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` (`id`, `users_id`, `groups_id`) VALUES
(12, 7, 3),
(14, 9, 2),
(16, 11, 3),
(20, 12, 2),
(22, 6, 2),
(23, 14, 3),
(25, 16, 3),
(26, 17, 3),
(31, 8, 3),
(33, 19, 2),
(35, 1, 1),
(38, 21, 2),
(39, 22, 2),
(40, 23, 2),
(41, 24, 3),
(45, 4, 2),
(47, 26, 3),
(48, 27, 2),
(49, 28, 3),
(50, 29, 3),
(53, 5, 3),
(54, 25, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subtema_id` (`subtema_id`),
  ADD KEY `subsubtema_id` (`subsubtema_id`),
  ADD KEY `tema_id` (`tema_id`);

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subtema_id` (`subtema_id`),
  ADD KEY `subsubtema_id` (`subsubtema_id`),
  ADD KEY `tema_id` (`tema_id`);

--
-- Indices de la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subsubtema_id` (`subsubtema_id`),
  ADD KEY `subtema_id` (`subtema_id`),
  ADD KEY `tema_id` (`tema_id`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subtema_id` (`subtema_id`),
  ADD KEY `subsubtema_id` (`subsubtema_id`),
  ADD KEY `tema_id` (`tema_id`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id`,`users_id`,`curso_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contenido_id` (`contenido_id`);

--
-- Indices de la tabla `reg_actividad`
--
ALTER TABLE `reg_actividad`
  ADD PRIMARY KEY (`id`,`users_id`,`actividad_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `actividad_id` (`actividad_id`);

--
-- Indices de la tabla `reg_contenido`
--
ALTER TABLE `reg_contenido`
  ADD PRIMARY KEY (`id`,`users_id`,`contenido_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `contenido_id` (`contenido_id`);

--
-- Indices de la tabla `reg_cuestionario`
--
ALTER TABLE `reg_cuestionario`
  ADD PRIMARY KEY (`id`,`users_id`,`cuestionario_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `cuestionario_id` (`cuestionario_id`);

--
-- Indices de la tabla `reg_ejercicio`
--
ALTER TABLE `reg_ejercicio`
  ADD PRIMARY KEY (`id`,`users_id`,`ejercicio_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `ejercicio_id` (`ejercicio_id`);

--
-- Indices de la tabla `reg_sesion`
--
ALTER TABLE `reg_sesion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subsubtema`
--
ALTER TABLE `subsubtema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subtema_id` (`subtema_id`);

--
-- Indices de la tabla `subtema`
--
ALTER TABLE `subtema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tema_id` (`tema_id`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`,`users_id`,`groups_id`),
  ADD KEY `groups_id` (`groups_id`),
  ADD KEY `users_groups_ibfk_1` (`users_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reg_actividad`
--
ALTER TABLE `reg_actividad`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reg_contenido`
--
ALTER TABLE `reg_contenido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reg_cuestionario`
--
ALTER TABLE `reg_cuestionario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reg_ejercicio`
--
ALTER TABLE `reg_ejercicio`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reg_sesion`
--
ALTER TABLE `reg_sesion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT de la tabla `subsubtema`
--
ALTER TABLE `subsubtema`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `subtema`
--
ALTER TABLE `subtema`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`subtema_id`) REFERENCES `subtema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `actividad_ibfk_2` FOREIGN KEY (`subsubtema_id`) REFERENCES `subsubtema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `actividad_ibfk_3` FOREIGN KEY (`tema_id`) REFERENCES `tema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD CONSTRAINT `contenido_ibfk_1` FOREIGN KEY (`subtema_id`) REFERENCES `subtema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `contenido_ibfk_2` FOREIGN KEY (`subsubtema_id`) REFERENCES `subsubtema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `contenido_ibfk_3` FOREIGN KEY (`tema_id`) REFERENCES `tema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  ADD CONSTRAINT `cuestionario_ibfk_1` FOREIGN KEY (`subsubtema_id`) REFERENCES `subsubtema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cuestionario_ibfk_2` FOREIGN KEY (`subtema_id`) REFERENCES `subtema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cuestionario_ibfk_3` FOREIGN KEY (`tema_id`) REFERENCES `tema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD CONSTRAINT `ejercicio_ibfk_1` FOREIGN KEY (`subtema_id`) REFERENCES `subtema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ejercicio_ibfk_2` FOREIGN KEY (`subsubtema_id`) REFERENCES `subsubtema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ejercicio_ibfk_3` FOREIGN KEY (`tema_id`) REFERENCES `tema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD CONSTRAINT `recursos_ibfk_1` FOREIGN KEY (`contenido_id`) REFERENCES `contenido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reg_actividad`
--
ALTER TABLE `reg_actividad`
  ADD CONSTRAINT `reg_actividad_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reg_actividad_ibfk_2` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reg_contenido`
--
ALTER TABLE `reg_contenido`
  ADD CONSTRAINT `reg_contenido_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reg_contenido_ibfk_2` FOREIGN KEY (`contenido_id`) REFERENCES `contenido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reg_cuestionario`
--
ALTER TABLE `reg_cuestionario`
  ADD CONSTRAINT `reg_cuestionario_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reg_cuestionario_ibfk_2` FOREIGN KEY (`cuestionario_id`) REFERENCES `cuestionario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reg_ejercicio`
--
ALTER TABLE `reg_ejercicio`
  ADD CONSTRAINT `reg_ejercicio_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reg_ejercicio_ibfk_2` FOREIGN KEY (`ejercicio_id`) REFERENCES `ejercicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reg_sesion`
--
ALTER TABLE `reg_sesion`
  ADD CONSTRAINT `reg_sesion_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subsubtema`
--
ALTER TABLE `subsubtema`
  ADD CONSTRAINT `subsubtema_ibfk_1` FOREIGN KEY (`subtema_id`) REFERENCES `subtema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subtema`
--
ALTER TABLE `subtema`
  ADD CONSTRAINT `subtema_ibfk_1` FOREIGN KEY (`tema_id`) REFERENCES `tema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `tema_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `users_groups_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_groups_ibfk_2` FOREIGN KEY (`groups_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
