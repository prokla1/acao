-- phpMyAdmin SQL Dump
-- version 4.0.0-dev
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2013 at 07:05 PM
-- Server version: 5.1.66-0ubuntu0.11.10.3
-- PHP Version: 5.3.14

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aa`
--

-- --------------------------------------------------------

--
-- Table structure for table `atividades`
--

DROP TABLE IF EXISTS `atividades`;
CREATE TABLE IF NOT EXISTS `atividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `ativo` enum('0','1') NOT NULL DEFAULT '0',
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `atividades`
--

INSERT INTO `atividades` (`id`, `nome`, `ativo`, `hora`) VALUES
(1, 'Cinema', '1', '2012-06-05 20:00:12'),
(2, 'Teatro', '1', '2012-06-05 20:00:12'),
(3, 'Bar', '1', '2012-06-05 20:00:22'),
(4, 'Restaurante', '1', '2012-06-05 20:00:22'),
(5, 'Casa Noturna', '1', '2012-06-05 20:01:17'),
(6, 'Festa', '1', '2012-06-05 20:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `conversao`
--

DROP TABLE IF EXISTS `conversao`;
CREATE TABLE IF NOT EXISTS `conversao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cortesia` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `pontos` int(11) NOT NULL,
  `reais` decimal(9,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cortesia` (`id_cortesia`),
  KEY `id_evento` (`id_evento`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `cortesias`
--

DROP TABLE IF EXISTS `cortesias`;
CREATE TABLE IF NOT EXISTS `cortesias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evento` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` longtext NOT NULL,
  `valor` decimal(9,2) NOT NULL,
  `qtd` int(11) NOT NULL,
  `disponivel` int(11) NOT NULL,
  `termino` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_evento` (`id_evento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parceiro` int(11) NOT NULL,
  `id_endereco` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `capa` varchar(255) NOT NULL DEFAULT 'null.jpg',
  `ativo` enum('0','1') NOT NULL DEFAULT '0',
  `destaque` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 -> NAO // 1 -> SIM',
  `realizacao` date NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_parceiro` (`id_parceiro`),
  KEY `id_endereco` (`id_endereco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`id`, `id_parceiro`, `id_endereco`, `nome`, `descricao`, `capa`, `ativo`, `destaque`, `realizacao`, `hora`) VALUES
(3, 2, 2, 'Sertanejo Universitário', 'Atrações:<br />\r\n<ul>\r\n<li>Chico Santos e Banda</li>\r\n</ul>', 'null.jpg', '1', '1', '2012-06-21', '2013-01-08 20:10:31'),
(4, 3, 4, 'Candy Box ', 'Atrações:<br>\r\nCandy Box\r\n<p>Desde os anos 70 até os dias de hoje! É assim que a CandyBox vem munida, e muito bem munida. Versões pesadas de Tina Turner, Donna Summer, Depeche Mode, New Order, Cardigans, Madonna, Lady Gaga, Katy Perry e um set Rock n Roll com Nirvana, Blondie, Stones, Acdc (entre muitos outros), serão apresentados pelos ex integrantes da extinta banda Funkzilla e prometem chacoalhar os palcos carentes de novidades na linha pop/rock/disco.\r\n</p>\r\n<p>\r\nA banda é formada por Michelle Oliveira no vocal, Beto Fonseca na bateria, Adriano Baboo no baixo, Willian Rita nos teclados e Thomas Costello na guitarra. E quinta-feira é noite de Ladies Free no John Bull Floripa e até a meia noite as mulheres não pagam entrada.\r\n</p>', 'null.jpg', '1', '1', '2012-06-21', '2013-01-08 20:10:31'),
(5, 4, 3, 'Pop Rock Original', 'Pop Rock Original Cervejaria Original \r\n<p>\r\n<b>Atrações:</b>\r\nBanda Gandaya', 'null.jpg', '1', '0', '2012-06-21', '2013-01-08 20:10:31'),
(10, 2, 1, 'teste 22', 'teste 22', 'null.jpg', '1', '0', '2012-06-22', '2013-01-08 20:10:31'),
(11, 2, 2, 'teste 23', 'teste 23', 'null.jpg', '1', '0', '2012-06-23', '2013-01-08 20:10:31'),
(33, 3, 3, 'parceiro 3', 'teste de evento com parceiro 3', 'null.jpg', '1', '0', '2012-12-04', '2013-01-08 20:10:31'),
(34, 4, 4, 'parc 4', 'teste de evento com parceiro 4', 'null.jpg', '1', '0', '2012-12-04', '2013-01-08 20:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `eventos_fotos`
--

DROP TABLE IF EXISTS `eventos_fotos`;
CREATE TABLE IF NOT EXISTS `eventos_fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evento` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_evento` (`id_evento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `eventos_fotos`
--

INSERT INTO `eventos_fotos` (`id`, `id_evento`, `url`) VALUES
(3, 4, '02.png'),
(4, 4, '05.png'),
(5, 34, '02.jpg'),
(6, 34, '05.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `local_cidades`
--

DROP TABLE IF EXISTS `local_cidades`;
CREATE TABLE IF NOT EXISTS `local_cidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `ativo` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `local_cidades`
--

INSERT INTO `local_cidades` (`id`, `nome`, `id_estado`, `ativo`) VALUES
(1, 'Florianópolis', 1, '1'),
(2, 'São José', 1, '1'),
(3, 'Curitiba', 2, '1'),
(4, 'Biguaçu', 1, '0'),
(5, 'Apucarana', 2, '1'),
(6, 'São Sebastião', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `local_enderecos`
--

DROP TABLE IF EXISTS `local_enderecos`;
CREATE TABLE IF NOT EXISTS `local_enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cidade` int(11) NOT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cidade` (`id_cidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `local_enderecos`
--

INSERT INTO `local_enderecos` (`id`, `id_cidade`, `rua`, `numero`, `complemento`) VALUES
(1, 2, 'Shopping Center Itaguaçu. Rua Gerôncio Thives', '1079', 'Barreiros'),
(2, 1, 'Rua da prefeitura', 'salas tal', 'Terra Firme'),
(3, 2, 'rua em frente ao shopping beira mar', NULL, 'no centro'),
(4, 1, 'rua da prefeitura', '5', 'edificio terra firme');

-- --------------------------------------------------------

--
-- Table structure for table `local_estados`
--

DROP TABLE IF EXISTS `local_estados`;
CREATE TABLE IF NOT EXISTS `local_estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(2) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `ativo` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_pais` (`id_pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `local_estados`
--

INSERT INTO `local_estados` (`id`, `sigla`, `nome`, `id_pais`, `ativo`) VALUES
(1, 'SC', 'Santa Catarina', 1, '1'),
(2, 'PR', 'Paraná', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `local_pais`
--

DROP TABLE IF EXISTS `local_pais`;
CREATE TABLE IF NOT EXISTS `local_pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(2) NOT NULL,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `local_pais`
--

INSERT INTO `local_pais` (`id`, `sigla`, `nome`) VALUES
(1, 'BR', 'Brasil');

-- --------------------------------------------------------

--
-- Table structure for table `parceiros`
--

DROP TABLE IF EXISTS `parceiros`;
CREATE TABLE IF NOT EXISTS `parceiros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_amigavel` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL COMMENT 'responsável pelo estabelecimento é um USUARIO',
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'null.jpg',
  `ativo` enum('0','1') NOT NULL DEFAULT '0',
  `id_endereco` int(11) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_endereco` (`id_endereco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `parceiros`
--

INSERT INTO `parceiros` (`id`, `url_amigavel`, `id_usuario`, `nome`, `descricao`, `foto`, `ativo`, `id_endereco`, `hora`) VALUES
(2, 'quiosque', 1, 'Quiosque Chopp Brahma', 'Chopp da Brahma geladinho.', 'quiosque.png', '1', 1, '2013-01-07 18:27:44'),
(3, 'cervejaria-original-sao-jose', 2, 'Cervejaria Original (São José)', 'Petiscos e cerveja geladinha', 'null.jpg', '1', 2, '2013-01-07 18:27:58'),
(4, 'cervejaria-original-florianopolis', 2, 'Cervejaria Original (Florianópolis)	', 'Happy Hour no coração da cidade', '04.jpg', '1', 3, '2013-01-07 18:28:04'),
(5, 'kabutz', 2, 'Kabutz', 'Sua balada nas alturas', 'kabutz.jpg', '1', 4, '2013-01-07 18:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `rel_atividade_parceiro`
--

DROP TABLE IF EXISTS `rel_atividade_parceiro`;
CREATE TABLE IF NOT EXISTS `rel_atividade_parceiro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parceiro` int(11) NOT NULL,
  `id_atividade` int(11) NOT NULL,
  `ativo` enum('0','1') NOT NULL DEFAULT '0',
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_parceiro` (`id_parceiro`),
  KEY `id_atividade` (`id_atividade`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rel_atividade_parceiro`
--

INSERT INTO `rel_atividade_parceiro` (`id`, `id_parceiro`, `id_atividade`, `ativo`, `hora`) VALUES
(1, 2, 3, '1', '2012-06-05 20:35:33'),
(2, 2, 4, '1', '2012-06-05 20:35:33'),
(3, 3, 4, '1', '2012-06-05 20:35:45'),
(4, 3, 5, '1', '2012-06-05 20:35:45'),
(5, 4, 5, '1', '2012-06-23 14:31:51'),
(6, 2, 5, '1', '2012-06-23 14:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `rel_local_parceiro`
--

DROP TABLE IF EXISTS `rel_local_parceiro`;
CREATE TABLE IF NOT EXISTS `rel_local_parceiro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parceiro` int(11) NOT NULL,
  `id_local` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_local` (`id_local`),
  KEY `id_parceiro` (`id_parceiro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rel_local_parceiro`
--

INSERT INTO `rel_local_parceiro` (`id`, `id_parceiro`, `id_local`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rel_local_usuario`
--

DROP TABLE IF EXISTS `rel_local_usuario`;
CREATE TABLE IF NOT EXISTS `rel_local_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_local` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_local` (`id_local`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rel_local_usuario`
--

INSERT INTO `rel_local_usuario` (`id`, `id_usuario`, `id_local`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_facebook` varchar(20) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `sexo` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0-> Pendente / 1->Masculino / 2->Feminino',
  `nascimento` date NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'null.jpg',
  `ativo` enum('0','1') NOT NULL DEFAULT '0',
  `email_verificado` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 -> NAO // 1 -> SIM',
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `array_face` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_facebook`, `nome`, `email`, `senha`, `sexo`, `nascimento`, `foto`, `ativo`, `email_verificado`, `hora`, `array_face`) VALUES
(1, '', 'Juscelino Iene Cordeiro da Silva', 'jus@jus.com', '202cb962ac59075b964b07152d234b70', '0', '0000-00-00', 'null.jpg', '1', '0', '2012-06-05 20:31:07', ''),
(2, '', 'Elias Augusto de Oliveira', 'elias@elias.com', '202cb962ac59075b964b07152d234b70', '0', '0000-00-00', 'null.jpg', '1', '0', '2012-06-05 20:32:39', ''),
(10, '100001551508566x', 'Juscelino Iene', 'ju.impossivel@gmail.comx', '100001551508566', '1', '1982-11-21', 'null.jpg', '0', '0', '2012-06-11 20:00:37', '{"id":"100001551508566","name":"Juscelino Iene","first_name":"Juscelino","last_name":"Iene","link":"http:\\/\\/www.facebook.com\\/juscelino.iene","username":"juscelino.iene","birthday":"11\\/21\\/1982","location":{"id":"106339232734991","name":"Florian\\u00f3polis, Santa Catarina"},"gender":"male","email":"ju.impossivel@gmail.com","timezone":-3,"locale":"pt_BR","verified":true,"updated_time":"2012-06-11T19:43:17+0000"}'),
(12, '100001551508566', 'Juscelino Iene', 'ju.impossivel@gmail.com', 'Facebook', '1', '1982-11-21', 'null.jpg', '0', '0', '2012-06-11 23:00:46', '{"id":"100001551508566","name":"Juscelino Iene","first_name":"Juscelino","last_name":"Iene","link":"http:\\/\\/www.facebook.com\\/juscelino.iene","username":"juscelino.iene","birthday":"11\\/21\\/1982","location":{"id":"106339232734991","name":"Florian\\u00f3polis, Santa Catarina"},"gender":"male","email":"ju.impossivel@gmail.com","timezone":-3,"locale":"pt_BR","verified":true,"updated_time":"2012-06-11T22:58:59+0000"}'),
(13, NULL, 'nomezinho', 'email com 8 caracteres', '56229de5376d8c55313a62b3d1215315', '0', '0000-00-00', 'null.jpg', '0', '0', '2012-06-12 14:12:40', ''),
(14, NULL, ' fsadf sad', 'sd fsd fas fas', '670efc94e8bbaae2c2416b27004b7dbc', '0', '0000-00-00', 'null.jpg', '0', '0', '2012-06-12 17:42:10', ''),
(15, NULL, 'asdfasdfsadf das', 'dfsdaf sadf sa', '52c396e4949a2a8f5f342f25c49ee3a4', '0', '0000-00-00', 'null.jpg', '1', '0', '2012-06-12 17:47:30', ''),
(16, NULL, 'ewrtewrtewr', 't ewr tewrt ewr', '0ea01dc9fa83eedc15ca2625fcd3b397', '0', '0000-00-00', 'null.jpg', '1', '0', '2012-06-12 17:48:12', ''),
(17, NULL, 'João da Silvãozé', 'josesilvao@gmail.com', '698dc19d489c4e4db73e28a713eab07b', '0', '0000-00-00', 'null.jpg', '1', '0', '2012-06-12 19:01:34', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversao`
--
ALTER TABLE `conversao`
  ADD CONSTRAINT `conversao_ibfk_1` FOREIGN KEY (`id_cortesia`) REFERENCES `cortesias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversao_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversao_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cortesias`
--
ALTER TABLE `cortesias`
  ADD CONSTRAINT `cortesias_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`id_endereco`) REFERENCES `local_enderecos` (`id`),
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_parceiro`) REFERENCES `parceiros` (`id`);

--
-- Constraints for table `eventos_fotos`
--
ALTER TABLE `eventos_fotos`
  ADD CONSTRAINT `eventos_fotos_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`);

--
-- Constraints for table `local_cidades`
--
ALTER TABLE `local_cidades`
  ADD CONSTRAINT `local_cidades_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `local_estados` (`id`);

--
-- Constraints for table `local_enderecos`
--
ALTER TABLE `local_enderecos`
  ADD CONSTRAINT `local_enderecos_ibfk_1` FOREIGN KEY (`id_cidade`) REFERENCES `local_cidades` (`id`);

--
-- Constraints for table `local_estados`
--
ALTER TABLE `local_estados`
  ADD CONSTRAINT `local_estados_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `local_pais` (`id`);

--
-- Constraints for table `parceiros`
--
ALTER TABLE `parceiros`
  ADD CONSTRAINT `parceiros_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `parceiros_ibfk_2` FOREIGN KEY (`id_endereco`) REFERENCES `local_enderecos` (`id`);

--
-- Constraints for table `rel_atividade_parceiro`
--
ALTER TABLE `rel_atividade_parceiro`
  ADD CONSTRAINT `rel_atividade_parceiro_ibfk_1` FOREIGN KEY (`id_parceiro`) REFERENCES `parceiros` (`id`),
  ADD CONSTRAINT `rel_atividade_parceiro_ibfk_2` FOREIGN KEY (`id_atividade`) REFERENCES `atividades` (`id`);

--
-- Constraints for table `rel_local_parceiro`
--
ALTER TABLE `rel_local_parceiro`
  ADD CONSTRAINT `rel_local_parceiro_ibfk_2` FOREIGN KEY (`id_parceiro`) REFERENCES `parceiros` (`id`),
  ADD CONSTRAINT `rel_local_parceiro_ibfk_3` FOREIGN KEY (`id_local`) REFERENCES `local_enderecos` (`id`);

--
-- Constraints for table `rel_local_usuario`
--
ALTER TABLE `rel_local_usuario`
  ADD CONSTRAINT `rel_local_usuario_ibfk_1` FOREIGN KEY (`id_local`) REFERENCES `local_enderecos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rel_local_usuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
