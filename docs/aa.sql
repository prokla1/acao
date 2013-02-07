-- phpMyAdmin SQL Dump
-- version 4.0.0-dev
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2013 at 10:13 PM
-- Server version: 5.1.67-0ubuntu0.11.10.1
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
  `qtd` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT 'qtd de ingressos convertidos',
  `pontos` int(11) NOT NULL DEFAULT '0' COMMENT 'pontos utilizados para a conversao',
  `reais` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT 'valor pago para a conversao',
  `concretizado` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->NAO // 1->SIM',
  `visivel` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0-> NAO // 1-> SIM',
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_cortesia` (`id_cortesia`),
  KEY `id_evento` (`id_evento`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `valor_original` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT 'valor original para venda no local',
  `valor` double(9,2) NOT NULL DEFAULT '0.00' COMMENT 'valor para ser convertido',
  `qtd` int(11) NOT NULL COMMENT 'qtd total de convites deste tipo para o evento',
  `disponivel` int(11) NOT NULL COMMENT 'qtd ainda disponivel deste tipo de convite',
  `max_converter` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT 'qtos convites cada usuario pode converter',
  `sexo` enum('3','1','2') NOT NULL DEFAULT '3' COMMENT '3-> Todos / 1->Masculino / 2->Feminino',
  `termino` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_evento` (`id_evento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_amigavel` text NOT NULL,
  `id_parceiro` int(11) NOT NULL,
  `id_endereco` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `local_cidades`
--

INSERT INTO `local_cidades` (`id`, `nome`, `id_estado`, `ativo`) VALUES
(9, 'Apucarana', 1, '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `local_estados`
--

INSERT INTO `local_estados` (`id`, `sigla`, `nome`, `id_pais`, `ativo`) VALUES
(1, 'PR', 'Paraná', 1, '1');

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
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cidade` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_cidade` (`id_cidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `id_cidade`, `email`, `hora`) VALUES
(1, 9, 'ju.imposisvel@gmail.com', '2013-02-06 23:31:51'),
(2, 9, 'ju.imposisvel@gmail.com', '2013-02-06 23:34:35'),
(3, 9, 'ju.imposisvel@gmail.com', '2013-02-06 23:34:53'),
(4, 9, 'ju.imposisvel@gmail.com', '2013-02-06 23:39:58'),
(5, 9, 'representante@controleestudantil.com.br', '2013-02-07 00:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `parceiros`
--

DROP TABLE IF EXISTS `parceiros`;
CREATE TABLE IF NOT EXISTS `parceiros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_amigavel` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL COMMENT 'responsável pelo estabelecimento é um USUARIO',
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'null.jpg',
  `ativo` enum('0','1') NOT NULL DEFAULT '0',
  `id_endereco` int(11) NOT NULL,
  `funcionamento` text,
  `pagamento` text,
  `telefone` varchar(15) DEFAULT NULL,
  `num_votos` int(10) unsigned NOT NULL DEFAULT '0',
  `total_pontos` int(10) unsigned NOT NULL DEFAULT '0',
  `rating` decimal(8,2) NOT NULL DEFAULT '0.00',
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_endereco` (`id_endereco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `parceiros_fotos`
--

DROP TABLE IF EXISTS `parceiros_fotos`;
CREATE TABLE IF NOT EXISTS `parceiros_fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parceiro` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_parceiro` (`id_parceiro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_facebook` varchar(20) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` bigint(11) unsigned zerofill DEFAULT '00000000000',
  `email` varchar(50) NOT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `sexo` enum('0','1','2') DEFAULT '0' COMMENT '0-> Pendente / 1->Masculino / 2->Feminino',
  `nascimento` date NOT NULL,
  `foto` varchar(255) DEFAULT 'null.jpg',
  `ativo` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 -> NAO // 1 -> SIM',
  `email_verificado` enum('0','1') DEFAULT '0' COMMENT '0 -> NAO // 1 -> SIM',
  `id_endereco` int(11) DEFAULT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `array_face` text,
  `admin` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-> NAO || 1-> SIM',
  PRIMARY KEY (`id`),
  KEY `id_endereco` (`id_endereco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_facebook`, `nome`, `cpf`, `email`, `senha`, `sexo`, `nascimento`, `foto`, `ativo`, `email_verificado`, `id_endereco`, `hora`, `array_face`, `admin`) VALUES
(1, '', 'Juscelino Iene Cordeiro da Silva', 00000000000, 'jus@jus.com', '202cb962ac59075b964b07152d234b70', '0', '0000-00-00', 'null.jpg', '1', '0', NULL, '2012-06-05 20:31:07', '', '0'),
(2, '', 'Elias Augusto de Oliveira', 00000000000, 'elias@elias.com', '202cb962ac59075b964b07152d234b70', '0', '0000-00-00', 'null.jpg', '1', '0', NULL, '2012-06-05 20:32:39', '', '0'),
(18, NULL, 'teste', 00000000001, 'teste@teste.com', '698dc19d489c4e4db73e28a713eab07b', '1', '1982-11-21', 'null.jpg', '0', '0', NULL, '2013-01-15 20:53:40', '', '1'),
(27, '100001551508566', 'Juscelino Iene', NULL, 'ju.impossivel@gmail.com', NULL, '1', '1982-11-21', NULL, '1', '1', NULL, '2013-01-25 14:04:36', '{"id":"100001551508566","name":"Juscelino Iene","first_name":"Juscelino","last_name":"Iene","link":"http:\\/\\/www.facebook.com\\/juscelino.iene","username":"juscelino.iene","birthday":"11\\/21\\/1982","hometown":{"id":"107664652596260","name":"Apucarana"},"location":{"id":"106339232734991","name":"Florian\\u00f3polis, Santa Catarina"},"sports":[{"id":"160899230620548","name":"Levantamento de copo","description":"Movimento repetitivo prolongado."}],"favorite_teams":[{"id":"204073162943401","name":"Clube de Regatas do Flamengo"}],"gender":"male","email":"ju.impossivel@gmail.com","timezone":-2,"locale":"pt_BR","languages":[{"id":"108083115891989","name":"Portugu\\u00eas"},{"id":"450169151702580","name":"Portuguese"}],"verified":true,"updated_time":"2013-01-25T03:20:05+0000"}', '0'),
(28, '100004671760264', 'Juscelino NetChefs', NULL, 'juscelino@netchefs.com.br', NULL, '1', '1982-11-21', NULL, '1', '1', NULL, '2013-02-02 22:27:20', '{"id":"100004671760264","name":"Juscelino NetChefs","first_name":"Juscelino","last_name":"NetChefs","link":"http:\\/\\/www.facebook.com\\/juscelino.netchefs","username":"juscelino.netchefs","birthday":"11\\/21\\/1982","hometown":{"id":"106339232734991","name":"Florian\\u00f3polis, Santa Catarina"},"location":{"id":"106339232734991","name":"Florian\\u00f3polis, Santa Catarina"},"work":[{"employer":{"id":"417145488333485","name":"NetChefs (Delivery Online)"},"location":{"id":"106339232734991","name":"Florian\\u00f3polis, Santa Catarina"},"position":{"id":"103148596409273","name":"Socio"},"description":"Delivery Online - NetChefs \\u00e9 uma pra\\u00e7a de alimenta\\u00e7\\u00e3o virtual.\\nMaior comodidade e vantagens para o consumidor fazer seu pedido delivery","start_date":"0000-00"}],"education":[{"school":{"id":"177300002318530","name":"Senai Santa Catarina"},"type":"College"}],"gender":"male","email":"juscelino@netchefs.com.br","timezone":-2,"locale":"pt_BR","verified":true,"updated_time":"2013-01-14T22:00:37+0000"}', '0');

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
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_parceiro`) REFERENCES `parceiros` (`id`),
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`id_endereco`) REFERENCES `local_enderecos` (`id`);

--
-- Constraints for table `eventos_fotos`
--
ALTER TABLE `eventos_fotos`
  ADD CONSTRAINT `eventos_fotos_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_cidades`
--
ALTER TABLE `local_cidades`
  ADD CONSTRAINT `local_cidades_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `local_estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_enderecos`
--
ALTER TABLE `local_enderecos`
  ADD CONSTRAINT `local_enderecos_ibfk_2` FOREIGN KEY (`id_cidade`) REFERENCES `local_cidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `local_estados`
--
ALTER TABLE `local_estados`
  ADD CONSTRAINT `local_estados_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `local_pais` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`id_cidade`) REFERENCES `local_cidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parceiros`
--
ALTER TABLE `parceiros`
  ADD CONSTRAINT `parceiros_ibfk_3` FOREIGN KEY (`id_endereco`) REFERENCES `local_enderecos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parceiros_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `parceiros_fotos`
--
ALTER TABLE `parceiros_fotos`
  ADD CONSTRAINT `parceiros_fotos_ibfk_2` FOREIGN KEY (`id_parceiro`) REFERENCES `parceiros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rel_atividade_parceiro`
--
ALTER TABLE `rel_atividade_parceiro`
  ADD CONSTRAINT `rel_atividade_parceiro_ibfk_1` FOREIGN KEY (`id_parceiro`) REFERENCES `parceiros` (`id`),
  ADD CONSTRAINT `rel_atividade_parceiro_ibfk_2` FOREIGN KEY (`id_atividade`) REFERENCES `atividades` (`id`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_endereco`) REFERENCES `local_enderecos` (`id`);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
