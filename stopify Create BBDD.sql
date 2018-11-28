-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2018 a las 21:09:02
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `stopify`
--
CREATE DATABASE IF NOT EXISTS `stopify` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `stopify`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estructura de tabla para la tabla `cancion`
--

DROP TABLE IF EXISTS `cancion`;
CREATE TABLE IF NOT EXISTS `cancion` (
  `idSpotify` varchar(200) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `anio` date NOT NULL,
  `duracion` time NOT NULL,
  `popularity` int(3) NOT NULL,
  `preview_url` text NOT NULL,
  `image_url` text NOT NULL,
  PRIMARY KEY (`idSpotify`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cancion`
--

INSERT INTO `cancion` (`idSpotify`, `titulo`, `autor`, `anio`, `duracion`, `popularity`, `preview_url`, `image_url`) VALUES
('07bSG1eEqGKKeYAGsfX4SV', 'Hvis du går', 'Terje Tysland', '2011-10-21', '07:22:00', 24, 'https://p.scdn.co/mp3-preview/aa678f5184a7f2702964a41ef2e13aaf7adc3379?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/adbc74d61edb4a1d49e0386de7f96082c219189a'),
('08BXFggSQOyvvEwrNxFzwZ', 'Radio Ga Ga - Live', 'Queen', '2012-01-01', '06:11:00', 46, '', 'https://i.scdn.co/image/288e255f1e98039329e53e7a2dfa8d7406058244'),
('0ABDzNYFRcW6ltSQ3Bq2aQ', 'Black Magic', 'Little Mix', '2018-11-23', '03:30:00', 0, 'https://p.scdn.co/mp3-preview/4b91e711c19fa74fa45cd463e1723f284e4a4ee8?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/df5324d4575b200b4103639334e4ef3be61314c4'),
('0AiE8MOV9os9s7GH72CA77', 'Con Aires de Libertad', 'Garabatos', '2018-11-02', '04:11:00', 8, 'https://p.scdn.co/mp3-preview/727c5b34bc787a526eaa41842a0e21128fd51af0?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/05f606c0d05eb1d44433cab1efef635dbb225231'),
('0BKSmrw4dVFlUm1B5sFDqZ', 'Radio Ga Ga - Remastered', 'Queen', '1991-10-28', '05:43:00', 43, '', 'https://i.scdn.co/image/c7c4f852cb682b74dde8e15f2108fd63acf3c5ac'),
('0Czk8vbCX0F4nofdtOiY7p', 'A Volar', 'Luka Sinraza', '2016-03-14', '03:23:00', 7, 'https://p.scdn.co/mp3-preview/77d166b8bc4410d223834945a223992fdbc725d6?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/141823640fccab6e4d72e25296a33b7dafffa2dd'),
('0dnGFmPP7AjNfjlf22GqOK', 'Raggen Går', 'Rövballebandet', '2011-07-06', '05:06:00', 25, 'https://p.scdn.co/mp3-preview/e18d66ce2c6b01dfff3cfebb69f1710ac10ba688?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/48cf9ae29f05ecd0887b71ab50230efdd8d1fe29'),
('0ebLL7Y5Vq2YruWF5gT8nA', 'Garab', 'Rachid Taha', '0000-00-00', '08:19:00', 2, 'https://p.scdn.co/mp3-preview/f69b62527ba3eaf1d2babf58e0a9c5f7a3254549?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/b75ec3aa302ab660472b0f7c67724809236f026e'),
('0htoN1Awu7SQy0bDVpWMfH', 'Om Alt Går Til Helvete', 'Katastrofe', '2017-03-24', '03:00:00', 50, 'https://p.scdn.co/mp3-preview/0d0bd90817fbb0283dc6c0b3eeb9e2efb2af5191?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/cdd3c87b128ed9e9bb90818656a7a4b7dd0c7363'),
('0iAWD0ewh5Vtt2h29YzHzV', 'We Are Gara Gu', 'En Tol Sarmiento', '2017-04-27', '02:22:00', 27, 'https://p.scdn.co/mp3-preview/4d6e3e2b05c646a9716caa172a05ec39afb6db5e?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/26b0123a3ddd4f66417ac44fed9a9faeebc6faad'),
('0OWcIt2YsrhIl7NsdTE7SO', 'Die Fledermaus, Act I: Nein, nein, ich zweifle gar nicht mehr (Live)', 'Johann Strauss II', '2018-11-16', '03:42:00', 6, 'https://p.scdn.co/mp3-preview/44eac434902e43eb389afc79ba608f2c9bff66fe?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/e0635cf294cca5b2b247233fea2ce2b56fd4cae2'),
('0QIjsbm2fh1cJ45XO9eGqq', 'Wake Up in the Sky', 'Gucci Mane', '2018-09-14', '03:24:00', 91, 'https://p.scdn.co/mp3-preview/43ece6da1fe67dc3a5f44ca967fec62e918ce69d?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/e5bf363f034cc7f575311f2774bc688235659199'),
('0Rj2yNpEvXOl8yn9UOuIRs', 'Gyal You A Party Animal - Remix', 'Charly Black', '2016-10-07', '03:44:00', 71, '', 'https://i.scdn.co/image/f6573092100faf0815afb3551fde8396a1583ee8'),
('0uHO2sjpnBTXQwrW2VGhfO', 'Mi Vida', 'Luka Sinraza', '2016-03-14', '03:28:00', 5, 'https://p.scdn.co/mp3-preview/0f99d39c2372f61ad1bf6f6d2ec4729743d29f2c?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/141823640fccab6e4d72e25296a33b7dafffa2dd'),
('0UikZGlKZZpbM75TejbTHh', 'Lady Madrid', 'Pereza', '2013-07-23', '03:10:00', 35, 'https://p.scdn.co/mp3-preview/046fa6eb19710f1f8fbba24bf96fc839002bcc16?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/032047a300a45fb124bea88e98838eea4ad0b951'),
('0VORxEZQ2m4rHhhBWorFHH', 'Bidea gara', 'Betagarri', '2006-12-22', '03:17:00', 23, 'https://p.scdn.co/mp3-preview/ea206f6b16d30570a5d9313469c4b6f30be486c4?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/cfb5c3fc759f8372ee287656b735d1f28070b448'),
('0w5idzY7CL6ajMVC5OVUUt', 'No Hay Nadie Mas (Remix)', 'Dj Towa', '2018-02-17', '04:22:00', 48, 'https://p.scdn.co/mp3-preview/596fa2d78816cba29f4ded436a89ca69483a65a0?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/8b0967dc7bdd828a5925d8686c4133249314e35c'),
('0YwBZKT8JE4U5TwmYE9BV9', 'Radio Ga Ga - Live Aid', 'Queen', '2018-10-19', '04:05:00', 80, '', 'https://i.scdn.co/image/cdd50e6509015e057823e5468a9977550170fb47'),
('17DjxJJG1NHXg1VatxfFfU', 'The Underdog', 'Spoon', '2007-07-10', '03:42:00', 49, 'https://p.scdn.co/mp3-preview/3f2a9ed46baaa03c5ee39ffd6f95e8f1ca772f92?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/b73f20e11870c41bf3cbe48c6688b38242152326'),
('199yJpWCdPhon2nlmLslJI', 'Dure Dure', 'Jencarlos', '2017-07-28', '03:39:00', 56, '', 'https://i.scdn.co/image/597edc171199dca983787a6bf0567cf80f0bc717'),
('1DF7j0P9nGX7y0AtKyjXY1', 'Itsasoa Gara', 'Ken Zazpi', '2010-10-28', '04:52:00', 26, 'https://p.scdn.co/mp3-preview/37c00b698937d2dcb51c122f93eeb82fc849fb20?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/3eb92db999052f001acb55ad9d1c041f20bb2b01'),
('1EEVGdZPEiqnakrdmMavLH', 'Dagene Går', 'Innocent Blood', '0000-00-00', '03:03:00', 24, 'https://p.scdn.co/mp3-preview/710e4172f6c46835321028c25c8408eaf274fbd2?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/b5838ee72d82da4e18c6f438a92ac55dc15ba5ab'),
('1h9P5WJwyvK8OB7O2YiXgp', 'Ibiza', 'Ozuna', '2018-08-24', '03:20:00', 87, 'https://p.scdn.co/mp3-preview/857990797a3527a9b47307a5fca44ba2545957c0?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/1f1246ead99e881c5bff3e7f5da45fddc2db7a8d'),
('1haGLFDnwDC753qZN0nagY', 'Garabatos', 'Fito y Fitipaldis', '2017-11-10', '04:40:00', 37, 'https://p.scdn.co/mp3-preview/e3d3edbb715a877a5c36c51d38ea006d89ec8e78?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/b9fba9a841fe9f16feffda513f7eaf173f01c9ef'),
('1LbGorB0xOfpiXQJFKB2Nd', 'El Taxi', 'Pitbull', '2015-07-17', '04:09:00', 60, 'https://p.scdn.co/mp3-preview/64d8a8aee0e43b5fafe4917481050216b829e050?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/07232e1e8622f2698da4a2fc435db96c8c3ed3e3'),
('1nQRg9q9uwALGzouOX5OyQ', 'Radio Ga Ga - Remastered', 'Queen', '1984-02-27', '05:48:00', 75, '', 'https://i.scdn.co/image/73a4f1e99aae3a81beb4501a6c54624a8def6c30'),
('1Nx1iKJgDYadmh7IMliXj8', 'Lady Madrid', 'Pereza', '2017-12-15', '03:11:00', 33, 'https://p.scdn.co/mp3-preview/184db7e6a575762a5bd33929074f676747be5923?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/d845e678b988ac1bc88a268255f3c250f4cf0876'),
('1r5f3E5CSWDzgUO46dI4S0', 'Búscame', 'Luka Sinraza', '2016-03-14', '04:27:00', 7, 'https://p.scdn.co/mp3-preview/a6e1bc2565fd2d448c4317f3d2f3f8f2d61fb4ee?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/141823640fccab6e4d72e25296a33b7dafffa2dd'),
('1RTexe5T7D6GlBRq1KAQyn', 'Livet går videre', 'Rasmus Seebach', '2015-11-06', '04:07:00', 45, '', 'https://i.scdn.co/image/cedd9eeb195ec201919cc83f3ce1dd6847f1c061'),
('1s2B5cndbqK8rPJEIcKJRQ', 'Vaina Loca', 'Ozuna', '2018-06-28', '02:56:00', 90, '', 'https://i.scdn.co/image/508160a7eb980b113b3594084a902ea5299ab159'),
('1sKXAVkHNIN3hUPP3RhwdL', 'We Will Rock You - Live', 'Queen', '2007-10-29', '02:09:00', 35, '', 'https://i.scdn.co/image/cf1c12cd3f7351cc07207e23eeb11bce00862c7e'),
('20kruAYDWoxn7TIiYn21us', 'Radio Ga Ga - Remastered', 'Queen', '1984-02-27', '05:48:00', 48, '', 'https://i.scdn.co/image/73a4f1e99aae3a81beb4501a6c54624a8def6c30'),
('27sjxPz5diV8oRLQSEQnub', 'Sin Equipaje', 'Luka Sinraza', '2016-03-14', '04:45:00', 6, 'https://p.scdn.co/mp3-preview/ae418a4fa7c75777fe76a5c13600611477a7c233?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/141823640fccab6e4d72e25296a33b7dafffa2dd'),
('2bnCZL0BZMabinEXxNmfoY', 'Hibernazioa', 'Izaki Gardenak', '2015-11-04', '03:56:00', 27, 'https://p.scdn.co/mp3-preview/4050141fc92ac21564ec2cac2c12699d7269bec6?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/e3d00ca0b354c6e9ed41d30a953c81fee5a21fc7'),
('2EoOZnxNgtmZaD8uUmz2nD', 'Black Hole Sun', 'Soundgarden', '1994-03-09', '05:18:00', 76, '', 'https://i.scdn.co/image/a2e6040d4a8b2af2c33fb608bccd1c2790caed94'),
('2Eukc5LkoDOGFYxOJ38ZTX', 'Garabatos', 'Fito y Fitipaldis', '2014-10-28', '04:40:00', 47, 'https://p.scdn.co/mp3-preview/e3d3edbb715a877a5c36c51d38ea006d89ec8e78?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/fc0b91280f1d0e612b5619ec2120369ed76e65a6'),
('2FAzEiLPLW6gDYT5IZsc93', 'Ziklikak gara', 'Hesian', '2018-11-21', '03:03:00', 0, 'https://p.scdn.co/mp3-preview/3eea2f21b9317464c602e6ef45cde60a389c05d2?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/e5406fbbf43ca024b3747b9847a1ec2ff5a6ebd7'),
('2GHbe6X1EKiOKgY2lZNdqR', 'De Pronto', 'Luka Sinraza', '2016-03-14', '03:34:00', 6, 'https://p.scdn.co/mp3-preview/fa37d05b49cd929d6ddaaf393ae690a500d1da29?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/141823640fccab6e4d72e25296a33b7dafffa2dd'),
('2GQAdx8BO8u8A6mxJ7eMND', 'Euri tanta bakoitzean', 'Betagarri', '2006-12-22', '04:28:00', 33, 'https://p.scdn.co/mp3-preview/03f25e9f195f092828c63bd9b910e07356ca666d?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/cfb5c3fc759f8372ee287656b735d1f28070b448'),
('2GvlIZHqSDyXQgf5hWXsOd', 'Un buen castigo', 'Fito y Fitipaldis', '2003-09-01', '04:37:00', 47, 'https://p.scdn.co/mp3-preview/1164913824cb6d3cef91ec820894fd1f42d06f34?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/c7e075fac2c5e758f6f015a9b3b6446db4588012'),
('2j0V4xxBg92OotZ5pPKsGz', 'Radio Ga Ga - Remastered', 'Queen', '1991-10-28', '05:43:00', 47, '', 'https://i.scdn.co/image/c7c4f852cb682b74dde8e15f2108fd63acf3c5ac'),
('2KI7jwc4PaEMEclXcnI7nv', 'Five Little Ducks', 'Super Simple Songs', '2017-03-24', '02:32:00', 53, 'https://p.scdn.co/mp3-preview/46313d6fc197342fd299d33b0ed739a9634a42a2?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/1619692acec457073393d6eb372739011c87b9f9'),
('2LTbYeQpIl4mpZEiG8VPW1', 'Garab', 'Rachid Taha', '0000-00-00', '08:19:00', 3, 'https://p.scdn.co/mp3-preview/32426865bcbf0c9aeda1644cb5b0f1b480a9a822?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/a58be090ace11e58a618a1cba6371b692635e0aa'),
('2MZNVeNIPVFihRld500QL9', 'Radio Ga Ga - Live At Wembley Stadium / July 1986', 'Queen', '1992-05-26', '05:57:00', 53, '', 'https://i.scdn.co/image/613ddbafa93d565ece7f1535fc376ed485324c91'),
('2npQbyWMCXx10S1ebDFCD1', 'Vamo a da una Vuelta (feat. Quimico Ultra Mega, Secreto El Famoso Biberon, Black Jonas point & mark ', 'Bryant Myers', '2018-02-15', '04:50:00', 64, 'https://p.scdn.co/mp3-preview/64466bf0476f5f9d1f5425a4a1f3404734d89ca1?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/cb9456e52ecd4ea63269dbc3506e65542f7879e9'),
('2XWEKRbJ8lSvmDI3qfIsXc', 'Baby Shark', 'Pinkfong', '2017-12-13', '01:36:00', 57, 'https://p.scdn.co/mp3-preview/57d6ebcec48a0522b01482a5f2a5cbfe1cdb40b0?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/a0846d380a63dd3ab5891c8c20387042612f71d1'),
('319Ub9OA1mncAsdw5Fby38', 'Radio Ga Ga - Remastered', 'Queen', '2011-01-01', '05:43:00', 47, '', 'https://i.scdn.co/image/a036abc8473a8b5817ef23b5d803bb33544dafed'),
('34k5qbsEA3SHK8dESRmgUA', 'Sin ti', 'Betagarri', '2006-12-22', '03:04:00', 26, 'https://p.scdn.co/mp3-preview/e82fdda0f655556654f8e8c9781734f68a971ae3?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/cfb5c3fc759f8372ee287656b735d1f28070b448'),
('34yNvighQ5AVdC0XM0OUuG', 'Lady Madrid', 'Marina Damer', '2017-06-19', '03:06:00', 13, 'https://p.scdn.co/mp3-preview/e7a7770ecba9fa5288e647ee8ea6db0a7ce89f32?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/2427bbf84917d470a090b293dcaec080e938f2b2'),
('3ao3OVxHlb3C08vAaApUlm', 'Imposible', 'Luis Fonsi', '2018-10-19', '02:43:00', 87, '', 'https://i.scdn.co/image/661a379745bbb199f7105363f495aee41f715c32'),
('3H2f8emLft5UUADpjApesX', 'Lady Madrid', 'Pereza', '2010-03-08', '03:11:00', 8, 'https://p.scdn.co/mp3-preview/2b7691e986840d99d7e7d1f17f0aabcc53c36e50?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/f19ae0f99d50d525df04562771dd1b74fb32124e'),
('3lPr8ghNDBLc2uZovNyLs9', 'Supermassive Black Hole', 'Muse', '2006-06-19', '03:32:00', 72, 'https://p.scdn.co/mp3-preview/7ab3e38ce1671da3a185d8685981983a6f39b7bd?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/f1cad0d6974d6236abd07a59106e8450d85cae24'),
('3nxT5ZjvwgDyJ8dJdeWUNM', 'Itsasoa Gara', 'Ken Zazpi', '2013-11-05', '05:28:00', 23, 'https://p.scdn.co/mp3-preview/42736b6f1b63340939f637f610b48ff8a86d4ab0?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/d0663eb5d80b0eb448daf0569258cb32e2da6a7d'),
('3PMWSgTp655Fqgw0gSj7fR', 'Bugga för fan', 'Anti Kristerz', '2013-04-25', '03:24:00', 30, 'https://p.scdn.co/mp3-preview/2401bc53fd5f7552d1df3ef28d58b3f3b3f7ce98?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/391df208a5de0f6d59bdd12b8b0b187d064cf579'),
('3ULkqRMNEabAFBPgh3vbm1', 'Baby Shark', 'Pinkfong', '2018-05-28', '01:36:00', 45, 'https://p.scdn.co/mp3-preview/7fba543ccc085d6399714adf93517fc467086e2d?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/bc3a8fc7a46e060fc081f8349c1abfe68e9cc97a'),
('3UpS7kBnkVQYG13pDDFTC4', 'As Long as You Love Me', 'Backstreet Boys', '1997-08-12', '03:41:00', 70, 'https://p.scdn.co/mp3-preview/258d2f4a7fa7985ed85ed058a4cbed6725c9625d?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/1b4816528e17b7717a293df9e3da49dd4ac7f4c9'),
('3WUMProh2MZVfJujw9ViUW', 'Migas de Pan', 'Luka Sinraza', '2016-03-14', '03:05:00', 6, 'https://p.scdn.co/mp3-preview/4d2619377a46e5fde5139523727d83a329eff78b?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/141823640fccab6e4d72e25296a33b7dafffa2dd'),
('45tayNM9TxJ4ajXXt1t9GT', 'Kulning', 'Maria Hulthén Birkeland', '2016-06-30', '01:14:00', 32, 'https://p.scdn.co/mp3-preview/7debcabed304bbfee3372d1e2a347c9878d6a631?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/2880b9684919c3432cb8e024b485d4c0e7b00b9f'),
('4Dm8uLtWueisCg4MZGq2Ao', 'En apa går på Djurgårn', 'AIK Trubaduren', '0000-00-00', '03:05:00', 27, 'https://p.scdn.co/mp3-preview/e31ae6aa61ae52775547109dec34254b958ce4d2?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/5415d3a560d606dcaa1e3546552254e810a11eef'),
('4elzLo4AWNq85PDbsOJAQx', 'Lady Blue - Directo Madrid', 'Bunbury', '2014-11-25', '04:59:00', 31, 'https://p.scdn.co/mp3-preview/9ce979d7f06ec4e8658740646eeee7f98306cc5e?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/be3f0c15b2393d829076cf02ab7409eb0dd9257f'),
('4Gzvf7X8ze9zIhT6ZAEETS', 'En medio de la calle', 'D´Nash', '2011-03-25', '04:25:00', 14, 'https://p.scdn.co/mp3-preview/ae285e0c5209410355443d79f99c2ab16e6f5f3b?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/c2c4ada4af3ee4fffa6ae43f3eb4739f23710334'),
('4hUawT9yOAkGkBad76QGu8', 'Zu Zara, Gu Gara', 'Hesian', '2014-10-22', '03:32:00', 19, 'https://p.scdn.co/mp3-preview/acc24f1f287a3077024354af72a42430c3c2e1a6?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/4ce0251b19eef78b9ef24dc55c680729efa0630a'),
('4HUqrGAZ5f0gHRor7z9BFc', 'Black Eyes', 'Bradley Cooper', '2018-10-05', '03:03:00', 72, '', 'https://i.scdn.co/image/a4964b89670463b5d0ced3e77c6b80f82a413329'),
('4iw3rjf3m2fXwXjaEwcvpX', 'Un buen castigo - Directo 2004', 'Fito y Fitipaldis', '2004-11-22', '07:17:00', 26, 'https://p.scdn.co/mp3-preview/f9941d9c201b96ccc6e40c874295f6a2874f27a9?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/10fb4a3b1bb800044b372a8e425ab9d9a0ae13a5'),
('4nfXpE6ssDGJNdx8HR9nrF', 'Baby Shark', 'Super Simple Songs', '2017-03-24', '02:53:00', 58, 'https://p.scdn.co/mp3-preview/2727524c2bc1eb08ba8fb9f7dbe7121f7ec24bc5?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/1619692acec457073393d6eb372739011c87b9f9'),
('4QXp8ygOOfUhl6iWCllAwZ', 'Garabatos - Las Ventas 2015', 'Fito y Fitipaldis', '2015-11-20', '05:19:00', 26, 'https://p.scdn.co/mp3-preview/06ec223fecca6cebddd10e3f36f273e1a92f0a07?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/a66e2d88148cc4ccbcd9cec858911544ecb26130'),
('4U5FRwlNlKgXeze4LrTYst', 'Horma eta haizea', 'Izaki Gardenak', '2015-11-04', '03:58:00', 23, 'https://p.scdn.co/mp3-preview/0993f5c40684cbdd1f7968105c5f4912708d15f8?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/e3d00ca0b354c6e9ed41d30a953c81fee5a21fc7'),
('4w8niZpiMy6qz1mntFA5uM', 'Taki Taki (with Selena Gomez, Ozuna & Cardi B)', 'DJ Snake', '2018-09-28', '03:32:00', 99, '', 'https://i.scdn.co/image/413d80d826a9122a718d2e94898bd2c8e26b32da'),
('4WEJrZwPMwsAUks6GOhnsz', 'Dale Don Dale', 'Don Omar', '2004-06-20', '03:34:00', 65, 'https://p.scdn.co/mp3-preview/48a836f5d25c947369f164f34c540a4ce8d38c73?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/fa40d29c105e6e6288d7326e286d286fd7f8eb74'),
('54flyrjcdnQdco7300avMJ', 'We Will Rock You - Remastered', 'Queen', '1977-10-28', '02:02:00', 74, '', 'https://i.scdn.co/image/a491839ba2cecedb308ec5fbdeb93f7c69e7d4b2'),
('59uQyr0V9pmORCMHunlY3J', 'Same Ol\' S*%# (feat. Gar, Hakizzle, VL Mike, & Sniper)', 'B.G.', '2005-05-24', '05:26:00', 23, 'https://p.scdn.co/mp3-preview/e2491d104a21442d96502433e89e7db23752fcc8?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/eefbbdad65ac33349f7268914dbdb124c657fbc6'),
('5GGUa4ms6gjj9gvPl6kl3r', 'Lady Madrid', 'Pereza', '2010-12-21', '03:11:00', 27, 'https://p.scdn.co/mp3-preview/cd46952018881c439a4aa1b292f6fc963d01a379?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/4f063911cdea86eee8a3e5531282561267be0b91'),
('5NQw5WJwKRPaaSDHXD04Fs', 'Lady Madrid', 'Pereza', '2009-08-25', '03:11:00', 59, 'https://p.scdn.co/mp3-preview/cd46952018881c439a4aa1b292f6fc963d01a379?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/712e9e2ff7548d5a4316264c2c64375c91f8d334'),
('5r0svDKL0PmNpaGYeoihj7', 'Txikia naiz', 'Betagarri', '2006-12-22', '03:27:00', 28, 'https://p.scdn.co/mp3-preview/04ce37f91896cde63331eda75480119b0169320f?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/cfb5c3fc759f8372ee287656b735d1f28070b448'),
('5s90hbYzWfS2OdU97NHQ4r', 'Vem ska älska dig i vinter?', 'Larz-Kristerz', '2018-06-01', '03:00:00', 28, 'https://p.scdn.co/mp3-preview/5a3d8e0e69f3fe2b94fa59d6e3f4de1b61d506bc?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/70c2ef2d8e6dd44c18795bb6ddafc28d2fcaa063'),
('5VJOeEGEhphuvtGZH0gbW9', 'Lady Madrid', 'Pereza', '2010-10-26', '03:11:00', 44, 'https://p.scdn.co/mp3-preview/e0493a576703c89a8ccc9ad2d555fbdfb899b5e1?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/92f2e42644dbb852c044d3c4c64828928eeb5590'),
('5Y8h1e3WpkpXBz0dK2iU6J', 'N\'jarinu Garab', 'Cheikh Lô', '1999-01-01', '04:30:00', 16, 'https://p.scdn.co/mp3-preview/012524e6f66f05302a9e6222d4f46acf523173aa?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/24855ae6c9114eb168c9ccff329d60b13c45be9a'),
('5ygDXis42ncn6kYG14lEVG', 'Baby Shark', 'Pinkfong', '2017-07-27', '01:36:00', 77, 'https://p.scdn.co/mp3-preview/7fba543ccc085d6399714adf93517fc467086e2d?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/1b012512f1324c231b503a7117987b7be9ca8b35'),
('5Zhfhutlyq9v8Yns3ww2XD', 'Un Buen Castigo (Karaoke Version)', 'The Hit Crew', '2013-06-11', '04:30:00', 0, 'https://p.scdn.co/mp3-preview/5f5197d7194ea9ccf09a8e00cd5d71d88f84ae91?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/83149f9a04014c742795143aee18ffba1e05b1b3'),
('6B15F6WKtoKYT3uCr53oQ0', 'Garabatos', 'Fito y Fitipaldis', '2015-11-20', '04:40:00', 30, 'https://p.scdn.co/mp3-preview/e3d3edbb715a877a5c36c51d38ea006d89ec8e78?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/a66e2d88148cc4ccbcd9cec858911544ecb26130'),
('6DzdQ1HhYMbsVKUHsIStIV', 'Itsasoa gara', 'Ken Zazpi', '2010-10-28', '04:52:00', 37, 'https://p.scdn.co/mp3-preview/a5837a8ea7fb828693993c762df1471bfbf1a2d6?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/7c871ba3c75a4d51ba7581d5f8aae58e4a096136'),
('6kfU0pBwqJOYnHcGLTcSXc', 'We Carry On', 'Yonder Dale', '2018-02-02', '03:26:00', 61, 'https://p.scdn.co/mp3-preview/d8f1fdfa4562d02bbdf8bcc2c018c2425a2c59f1?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/d30fe6ca5d5c58d341f52c8f1b21f0c8cfa3d228'),
('6kr5QOMuGTtY6zkTbsy1Ij', 'Cada Vez Que Se Tropieza', 'Luka Sinraza', '2016-03-14', '03:13:00', 6, 'https://p.scdn.co/mp3-preview/8c2f2bf2a7b383bf2547100990eca9c0741d9527?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/141823640fccab6e4d72e25296a33b7dafffa2dd'),
('6nLvaCZFR1wEzW3sIKpsnr', 'Valerie - Live At BBC Radio 1 Live Lounge, London / 2007', 'Amy Winehouse', '0000-00-00', '03:53:00', 72, '', 'https://i.scdn.co/image/3e590c3baaf178ecf3be12c1d8f4a3214ac0f572'),
('6p3gJaNlwUMPcLYa9aIXYD', 'Lady Madrid', 'Pereza', '2018-08-10', '03:11:00', 20, 'https://p.scdn.co/mp3-preview/8532c07891384b588db3bcb5fbadeba5f9f353b7?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/3bfabb102a7d9af6ccf6c0153218dd72ac1bacb8'),
('6PUaOU8UCWvBlTYS6A3i88', 'Ame Ga Furu Kara Niji Ga Deru (Nanatsu No Taizai)', 'Miura Jam', '2018-05-19', '01:32:00', 44, 'https://p.scdn.co/mp3-preview/a507befce3f13ed435d0d5117a5dfcc873dd0c67?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/c706c9c02e835b5af18538ecc4e8d0d610c1c7be'),
('6xXTj2U0LUE27yTGhMnkFI', 'Lady Madrid', 'Pereza', '2018-01-19', '03:11:00', 19, 'https://p.scdn.co/mp3-preview/41c02a8182e42a2519053f216a6e3e6cc5d6b5f7?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/96147d00c1f59f088b2ad1495e0ef9d1d026b3dd'),
('734vYzX6YKgSDHzXuLQJmg', 'Dale Vieja Dale', 'Toño Rosario', '2017-06-08', '03:36:00', 54, 'https://p.scdn.co/mp3-preview/a45f733d35f693869f30756c6394bd940d818418?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/a3ca723a37edebef428ced2f0335c5ca3cfe0bae'),
('7C0otlTRIQAl5foism4l3K', 'Shoobie', 'Slightly Stoopid', '2008-07-01', '03:01:00', 34, 'https://p.scdn.co/mp3-preview/a8699a158ac9cc86cf328944ef1d5c67c0c8c076?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/0918287d75d92874e933d22b72b69b81597adcac'),
('7FTywuxqZm5nFhoZGP0xn2', 'Tefa Yemileyen', 'Sami Dan', '2016-05-01', '05:02:00', 27, 'https://p.scdn.co/mp3-preview/3b6822685f8045a1d153b80521dec10af0607561?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/8e404098ac3ff29e7509ab83cfba539d1064a65c'),
('7kblRzcOzphxRl0BdipkEN', 'Medley: Dia de Fiesta / Tengo una Muñeca / El Señor Don Gato / Como Me Pica la Nariz / Garabatos / E', 'Grupo Infantil Guarderia Pon', '2014-12-01', '12:16:00', 5, 'https://p.scdn.co/mp3-preview/4b73014bcd880e6aeaabca1ef082cf41a7d91170?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/fd2b095beade414488ce2771acc6044bd4751c0b'),
('7l1qvxWjxcKpB9PCtBuTbU', 'Count On Me', 'Bruno Mars', '2010-10-05', '03:17:00', 70, 'https://p.scdn.co/mp3-preview/84464b2b96398cae75e0924bdf693a44727338b8?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/3d279adc8126da0e4b6f2247a6e1dbfbc559e1ac'),
('7l3E7lcozEodtVsSTCkcaA', 'ZEZE (feat. Travis Scott & Offset)', 'Kodak Black', '2018-10-12', '03:48:00', 95, 'https://p.scdn.co/mp3-preview/c157518967f5b9e3680cf90acdc8b91505aef6da?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/eed35ab8ea1211c208a5ebc00c04096df8ca9d37'),
('7xgRU6IXWSXaOgMeufGtVa', 'Lo Que Yo Diga (Dema Ga Ge Gi Go Gu Remix)', 'El Alfa', '2018-03-09', '06:29:00', 61, 'https://p.scdn.co/mp3-preview/dcfe96615e79d7462a13b6ff3c62f009b15c868e?cid=772c11e4edb149afaf9ac73f9359576b', 'https://i.scdn.co/image/d2e3f98dbfa1eb805cbb8f9024a727b8fc5df719');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancion_favorita`
--

DROP TABLE IF EXISTS `cancion_favorita`;
CREATE TABLE IF NOT EXISTS `cancion_favorita` (
  `idSpotify` varchar(200) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idSpotify`,`idUsuario`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estructura de tabla para la tabla `lista`
--

DROP TABLE IF EXISTS `lista`;
CREATE TABLE IF NOT EXISTS `lista` (
  `idLista` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idLista`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `lista_cancion`
--

DROP TABLE IF EXISTS `lista_cancion`;
CREATE TABLE IF NOT EXISTS `lista_cancion` (
  `idSpotify` varchar(200) NOT NULL,
  `idLista` int(11) NOT NULL,
  PRIMARY KEY (`idSpotify`,`idLista`),
  KEY `idLista` (`idLista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `idSpotify` text,
  `usuario` varchar(100) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;



--
-- Filtros para la tabla `cancion_favorita`
--
ALTER TABLE `cancion_favorita`
  ADD CONSTRAINT `cancion_favorita_ibfk_1` FOREIGN KEY (`idSpotify`) REFERENCES `cancion` (`idSpotify`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cancion_favorita_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lista`
--
ALTER TABLE `lista`
  ADD CONSTRAINT `lista_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lista_cancion`
--
ALTER TABLE `lista_cancion`
  ADD CONSTRAINT `lista_cancion_ibfk_1` FOREIGN KEY (`idLista`) REFERENCES `lista` (`idLista`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lista_cancion_ibfk_2` FOREIGN KEY (`idSpotify`) REFERENCES `cancion` (`idSpotify`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
