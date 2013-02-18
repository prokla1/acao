-- phpMyAdmin SQL Dump
-- version 4.0.0-dev
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2013 at 11:21 AM
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
  `url` varchar(100) NOT NULL,
  `ativo` enum('0','1') NOT NULL DEFAULT '0',
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `atividades`
--

INSERT INTO `atividades` (`id`, `nome`, `url`, `ativo`, `hora`) VALUES
(1, 'Cinema', 'cinema', '1', '2013-02-14 14:24:47'),
(2, 'Teatro', 'teatro', '1', '2013-02-14 14:24:47'),
(3, 'Bar', 'bar', '1', '2013-02-14 14:24:47'),
(4, 'Restaurante', 'restaurante', '1', '2013-02-14 14:24:47'),
(5, 'Casa Noturna', 'casa-noturna', '1', '2013-02-14 14:24:47'),
(6, 'Festa', 'festa', '1', '2013-02-14 14:24:47');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`id`, `url_amigavel`, `id_parceiro`, `id_endereco`, `nome`, `descricao`, `capa`, `ativo`, `destaque`, `realizacao`, `hora`) VALUES
(1, 'jean-e-julio-show-nacional', 4, 1, 'JEAN E JULIO', 'SÁBADO | 16.02 – SHOW NACIONAL\r\nJEAN E JULIO', 'evento_5113f3ada3436.jpg', '1', '0', '2013-02-18', '2013-02-07 18:34:22'),
(2, 'generos', 4, 1, 'Generos do Evento:', 'Ação\r\nRock\r\nSertanejo\r\nTerror', 'evento_5114ed91b76ec.jpg', '1', '0', '2013-02-18', '2013-02-08 12:20:33'),
(3, 'generos2', 4, 1, 'Generos do Evento:', 'Generos do Evento:\r\nAção\r\nRock\r\nSertanejo\r\nTerror', 'evento_5114ee1d5c46b.png', '1', '0', '2013-02-18', '2013-02-08 12:22:53'),
(4, 'inatividade-paranormal', 10, 2, 'INATIVIDADE PARANORMAL (D)', '<div class="infos_capa_filme">\r\n\r\n            <span class="loja_destaque_branco">INATIVIDADE PARANORMAL (D)</span><br><br>\r\n\r\n            <span style="font-weight:bold;">Gênero:</span> Comédia<br>\r\n\r\n            <span style="font-weight:bold;">Duração:</span> 87 min<br>\r\n\r\n            <span style="font-weight:bold;">Direção:</span> Michael Tiddes<br>\r\n\r\n            <span style="font-weight:bold;">Informações Gerais:</span> Dublado - Playarte<br>\r\n\r\n            <span style="font-weight:bold;">Classificação Indicativa:</span> 12 anos<br>\r\n\r\n            <span style="font-weight:bold;">Horário de exibição:</span> <br>\r\n	    <br>\r\n	    <strong>Arcoplex Itaguaçu 4</strong><br>Hoje  às 14:00, 15:50, 17:40 e 19:30<br>Dia 16/02/2013 às 14:00, 15:50, 17:40 e 19:30<br>Dia 17/02/2013 às 14:00, 15:50, 17:40 e 19:30<br>Dia 18/02/2013 às 14:00, 15:50, 17:40 e 19:30<br>Dia 19/02/2013 às 14:00, 15:50, 17:40 e 19:30<br>Dia 20/02/2013 às 14:00, 15:50, 17:40 e 19:30<br>Dia 21/02/2013 às 14:00, 15:50, 17:40 e 19:30<br><br><br>\r\n\r\n            <span style="font-weight:bold;">Elenco:</span> Marlon Wayans, Essence Atkins, Cedric The Entertainer<br>\r\n            <br>\r\n            <span style="font-weight:bold;">Sinopse:</span> Esta comédia pretende parodiar os filmes de terror em estilo "found-footage", ou seja, aqueles que usam imagens supostamente reais, com estilo amador, para criar impressão de realidade. A saga Atividade Paranormal é o principal filme parodiado, mas Filha do Mal, O Último Exorcismo e outros também são citados. <br>\r\n\r\n        </div>', 'evento_511e4699a3ed7.jpg', '1', '0', '2013-02-18', '2013-02-15 14:30:49'),
(5, 'joao-e-maria+cacadores-de-bruxa', 10, 2, 'JOÃO E MARIA: CAÇADORES DE BRUXAS - 3D (D)', '<div class="infos_capa_filme">\r\n\r\n            <span class="loja_destaque_branco">JOÃO E MARIA: CAÇADORES DE BRUXAS - 3D (D)</span><br><br>\r\n\r\n            <span style="font-weight:bold;">Gênero:</span> Ação<br>\r\n\r\n            <span style="font-weight:bold;">Duração:</span> 85 min<br>\r\n\r\n            <span style="font-weight:bold;">Direção:</span> Tommy Wirkola<br>\r\n\r\n            <span style="font-weight:bold;">Informações Gerais:</span> Dublado - Paramount<br>\r\n\r\n            <span style="font-weight:bold;">Classificação Indicativa:</span> 14 anos<br>\r\n\r\n            <span style="font-weight:bold;">Horário de exibição:</span> <br>\r\n	    <br>\r\n	    <strong>Arcoplex Itaguaçu 1</strong><br>Hoje  às  19:30<br>Dia 16/02/2013 às  19:30<br>Dia 17/02/2013 às  19:30<br>Dia 18/02/2013 às  19:30<br>Dia 19/02/2013 às  19:30<br>Dia 20/02/2013 às  19:30<br>Dia 21/02/2013 às  19:30<br><br><br>\r\n\r\n            <span style="font-weight:bold;">Elenco:</span> Jeremy Renner, Gemma Arterton, Famke Janssen<br>\r\n            <br>\r\n            <span style="font-weight:bold;">Sinopse:</span> A história segue os passos dos personagens que ficaram conhecidos no Brasil como João e Maria. 15 anos após o traumático incidente envolvendo uma casa feita de doces, Hansel e Gretel (nomes originais) formam uma dupla de impecáveis caçadores de bruxas, que migram pelo mundo procurando e matando tais seres malignos. Estrelado por Jeremy Renner, Gemma Arterton e Famke Janssen. <br>\r\n\r\n        </div>', 'evento_511e46fc2d0fe.jpg', '1', '0', '2013-02-18', '2013-02-15 14:32:28'),
(6, 'joao-e-maria+cacadores-de-bruxas', 11, 3, 'João e Maria: Caçadores de Bruxas', '<p>Depois de pegarem um gostinho por sangue quando crianças, João e Maria se tornaram vigilantes extremos, determinados a defender seu povo . Agora, sem que eles saibam, João e Maria passaram a ser a caça e têm que enfrentar um mal muito maior do que as bruxas: seu passado.</p>\r\n\r\n<p><b>Elenco: </b>Jeremy Renner, Gemma Arterton, Peter Stormare, Famke Janssen, Zoe Bell <br><b>Direção: </b>Tommy Wirkola<br><b>Gênero: </b>Terror<br><b>Duração: </b>88 min.<br><b>Distribuidora: </b>Paramount<br><b>Classificação: </b>14 Anos<br></p>', 'evento_511e49f1dae0f.jpg', '1', '0', '2013-02-18', '2013-02-15 14:45:06'),
(7, 'o-jardim-do-inimigo', 12, 4, 'O Jardim do Inimigo', '<p style="text-align: justify;">Trata-se de um jardim sinistro, com personagens reais que levam o espectador a ver-se em um espelho do cotidiano. <br>O texto é narrado pelo proprietário do Jardim, O Acusador, interpretado pelo autor e diretor do espetáculo, Caíque Oliveira; que no decorrer da trama, persegue suas vítimas através da mente. <br>Com linguagem simplificada; cenário, iluminação, sonoplastia, maquiagem e figurinos inovadores o espetáculo torna-se atraente e, muitas pessoas são levadas a se identificar com algumas das personagens e, também conseguem compreender de forma divertida a realidade vivida.<br>O Jardim do Inimigo é um espetáculo imperdível!</p>', 'evento_511e568deda1c.jpg', '1', '0', '2013-02-18', '2013-02-15 15:38:54'),
(8, 'lucas-e-renam+chico-santos', 13, 5, 'Lucas e Renan Chico Santos', '<div>\r\n								<p class="principal" style="font-size: 26px;">Lucas e Renan</p>\r\n								<p style="font-size: 18px; margin-top: 20px;">Chico Santos</p>\r\n							</div>\r\n\r\n\r\n<div>\r\n							<p>Envie seu nome para a Lista Especial e garanta desconto no ingresso:</p>\r\n<p>R$ 30,00 feminino e R$ 50,00 masculino (com nome na lista)</p>\r\n<p>Coloque seu nome pelo site www.fieldsfloripa.com.br/lista</p>						</div>', 'evento_511e58de97d84.jpg', '1', '0', '2013-02-18', '2013-02-15 15:48:46'),
(9, 'funk-in-house-15-02', 14, 6, 'FUNK IN HOUSE - Sex 15/02', '<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">\r\n                <tbody><tr>\r\n                    <td width="10" align="center" class="titulo_agenda"><img src="http://www.eldivinobrasil.com.br/images/agenda/bullet_arrow.gif"></td>\r\n                    <td width="1306" class="titulo_agenda" style="">&nbsp;FUNK IN HOUSE - Sex&nbsp;15/02</td>\r\n                </tr>\r\n                <tr>\r\n                    <td colspan="2" class="fonte_agenda text_align"><span><p style="margin-bottom: 12pt" class="section1"><font color="#000"><strong><span style="font-size: 10pt">Main Floor: </span></strong><span style="font-size: 10pt">Dj’s Robson Castanho e Bruno Oliveira</span></font><font color="#000">  </font></p><p style="margin: 0cm 0cm 0.0001pt" class="section1"><font color="#000"><strong><span style="font-size: 10pt">Warm Up (pátio):</span></strong><span style="font-size: 10pt"> DJ Beto Aragon (Never Ends)</span><strong><span style="font-size: 10pt"><br> <br> Ingressos&nbsp;Antecipados:</span></strong><span style="font-size: 10pt"> 1° lote: Feminino R$ 30,00 e Masculino R$ 50,00<br> <br> <strong>Ingressos consumação:</strong><br> Feminino R$ 100,00 de consumação mínima;<br> Masculino R$ 200,00 de consumação mínima.<br> <br> <strong>Pontos de venda de ingressos antecipados:</strong><br> Florianópolis: no Escritório El Divino, no P12, nas Lojas Multisom (Felipe Schmidt, Shoppings Floripa, Beiramar, Iguatemi), nas lojas Cheia de Graça (Centro, Lagoa da Conceição e Ingleses), na loja Osklen do Open Shopping (Jurerê Internacional) e </span><span style="font-size: 10pt">Quiosque da Blue Ticket no Shopping Beiramar</span><span style="font-size: 10pt"><br> São José: na loja Multisom (Shopping Itaguaçu e Kobrasol);<br> Palhoça: na loja Multisom (Shopping Via&nbsp; Catarina);<br> </span><span style="font-size: 10pt">Joinville: na loja Multisom (Shopping Mueller);</span><span style="font-size: 10pt"><br> Jaraguá do Sul: na loja Multisom (Shopping Breithaupt);<br> Balneário Camboriu: nas lojas Multisom (Centro e Balneário Shopping)<br> Itajaí: nas lojas Multisom (Itajaí Shopping e no Calçadão)<br> E no site </span><a href="http://www.blueticket.com.br/" target="_blank"><span style="font-size: 10pt">www.blueticket.com.br</span></a><span style="font-size: 10pt"><br> <br> <strong>Informações: <br> </strong>Valores acima estão sujeitos a alterações sem aviso prévio<br> Bônus de descontos com promoters&nbsp;autorizados <br> Cliente Vip Card tem acesso free com direito a acompanhante.<br> Sócios&nbsp;Clube do Assinante têm 20% de desconto na &nbsp;compra &nbsp;de ingresso antecipado para &nbsp;titular e &nbsp;&nbsp;acompanhante<br> <br> <strong>Patrocínio:</strong> Satoru - a única concessionária Honda na grande Florianópolis, Ecco! Fruit Energy, Devassa e Absolut Vodka - beba com moderação<br> <strong>Apoio:</strong> Grupo CR <br> <strong>Promoção:</strong>&nbsp;Jovem Pan<br> <strong>Realização: </strong>Grupo Novo Brasil - 15 anos</span></font>\r\n                    </p></span></td>\r\n                </tr>\r\n            </tbody></table>', 'evento_511e5b1536c34.jpg', '1', '0', '2013-02-18', '2013-02-15 16:04:20');

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
-- Table structure for table `generos`
--

DROP TABLE IF EXISTS `generos`;
CREATE TABLE IF NOT EXISTS `generos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `ativo` enum('0','1') NOT NULL DEFAULT '0',
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `generos`
--

INSERT INTO `generos` (`id`, `nome`, `ativo`, `hora`) VALUES
(1, 'Sertanejo', '1', '2013-02-08 11:57:44'),
(2, 'Rock', '1', '2013-02-08 11:57:44'),
(3, 'Ação', '1', '2013-02-08 11:58:03'),
(4, 'Terror', '1', '2013-02-08 11:58:03'),
(5, 'Comédia', '1', '2013-02-15 14:28:04'),
(6, 'Animação', '1', '2013-02-15 14:28:04'),
(7, 'Cultural', '1', '2013-02-15 15:37:35'),
(8, 'Funk', '1', '2013-02-15 15:55:41'),
(9, 'Pop', '1', '2013-02-15 15:55:41');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `local_cidades`
--

INSERT INTO `local_cidades` (`id`, `nome`, `id_estado`, `ativo`) VALUES
(9, 'Apucarana', 1, '1'),
(10, 'São José', 2, '1'),
(11, 'Palhoça', 2, '1'),
(12, 'Florianópolis', 2, '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `local_enderecos`
--

INSERT INTO `local_enderecos` (`id`, `id_cidade`, `rua`, `numero`, `complemento`) VALUES
(1, 11, 'RUA: CAETANO SILVEIRA DE MATTOS', '2463', 'Centro'),
(2, 10, 'Rua Gerôncio Thives', '1079', 'Shopping Itaguaçu'),
(3, 12, 'Rodovia SC-401', '3116', 'Saco Grande'),
(4, 12, 'Rod. SC 401, Km 5', '4600', 'Saco Grande'),
(5, 12, 'Av. Paulo Fontes', '1250', 'Centro'),
(6, 12, 'R. Alm. Lamego', '1147', 'Centro');

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
(1, 'PR', 'Paraná', 1, '1'),
(2, 'SC', 'Santa Catarina', 1, '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `id_cidade`, `email`, `hora`) VALUES
(1, 9, 'ju.imposisvel@gmail.com', '2013-02-06 23:31:51'),
(2, 9, 'ju.imposisvel@gmail.com', '2013-02-06 23:34:35'),
(3, 9, 'ju.imposisvel@gmail.com', '2013-02-06 23:34:53'),
(4, 9, 'ju.imposisvel@gmail.com', '2013-02-06 23:39:58'),
(5, 9, 'representante@controleestudantil.com.br', '2013-02-07 00:11:11'),
(6, 9, 'teste@teste.com', '2013-02-07 11:57:36'),
(7, 9, 'teste@teste.com', '2013-02-08 14:25:59'),
(8, 9, 'acao@acaoamiga.com.br', '2013-02-16 12:59:09');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `parceiros`
--

INSERT INTO `parceiros` (`id`, `url_amigavel`, `id_usuario`, `nome`, `descricao`, `foto`, `ativo`, `id_endereco`, `funcionamento`, `pagamento`, `telefone`, `num_votos`, `total_pontos`, `rating`, `hora`) VALUES
(4, 'idem-bar', NULL, 'Idem Bar', 'PROMOÇÃO PARA ANIVERSARIANTES NA IDEM BAR\r\nA Idem está com uma promoção especial para aniversariantes.\r\nAgora você pode convidar os seus amigos para comemorar seu aniversário em grande estilo na melhor casa de música sertaneja da Grande Florianópolis e ainda ter várias vantagens!\r\nSão três diferentes pacotes, um deles com certeza se encaixa com a sua necessidade.\r\nÉ só reunir a galera e comemorar!\r\n\r\nANIVERSÁRIO PARA 3 A 6 CONVIDADOS\r\nTrês ingressos femininos FREE\r\nConsumação masculina R$ 70,00\r\nUma espumante cortesia\r\n\r\n7 À 12 CONVIDADOS\r\nUm lounge no camarote\r\nR$ 800 com R$ 700 revertidos em consumo\r\nQuatro ingressos cortesias (unissex)\r\n12 pulseiras do camarote\r\nUma espumantes cortesia\r\n\r\n15 À 35 PESSOAS\r\nDois lounges no camarote (juntos)\r\nR$ 1500 revertidos integralmente em consumo\r\n35 pulseiras do camarote\r\nTodas as mulheres FREE\r\nConsumação masculina de R$ 70,00 – essa quantia já entra automaticamente para a cota de R$ 1500 de consumo', 'idem-bar.png', '1', 1, 'Conforme agenda', 'Todos cartões', '[48] 3242. 7055', 11, 39, '3.55', '2013-02-07 18:32:53'),
(8, 'sfasfas', NULL, 'teste', 'sdf sadf', 'sfasfas.jpg', '1', 1, 'sd fsa', 'sd fsad f', '4884659923', 0, 0, '0.00', '2013-02-07 20:51:47'),
(9, 'Restaurante', NULL, 'Restaurante', 'sdf sadf', 'Restaurante.png', '1', 1, 'sd fsa', 'sd fsad f', '4884659923', 0, 0, '0.00', '2013-02-07 20:56:02'),
(10, 'arcoplex-itaguacu', NULL, 'ARCOPLEX ITAGUACU', '<div class="infos_cine">\r\n	   <p><span style="color: #7c0000"><span style="font-size: larger"><strong>Assine a Newsletter</strong></span></span></p>\r\n<p><span style="color: #c0c0c0">Receba a programação de cinema antecipadamente por e-mail,&nbsp;</span><span style="color: #c0c0c0"><a href="http://www.shoppingitaguacu.com.br/news/form"><span style="color: #c0c0c0">assine o News</span></a></span></p>\r\n<p><span style="color: #7c0000"><span style="font-size: larger"><strong>Sessões 2D</strong></span></span></p>\r\n<p><strong><span style="color: #c0c0c0">Sexta, Sabado, Domingo e Feriados</span></strong><span style="color: #c0c0c0"><br>\r\nIngresso: R$ 16,00<br>\r\nMeia-entrada: R$ 8,00 <br>\r\n<br>\r\n<strong>Segunda, Terça e Quinta</strong><br>\r\nIngresso: R$ 14,00<br>\r\nMeia-entrada: R$ 7,00 <br>\r\n<br>\r\n<strong>Quarta-feira Promocional*</strong><br>\r\nIngresso: R$ 7,00<br>\r\nMeia-entrada: R$ 3,50 <br>\r\n<br>\r\n<strong>Sábado Maluco</strong><br>\r\nMeia-entrada: Ingresso: R$ 7,00&nbsp;</span></p>\r\n<p><span style="color: #7c0000"><span style="font-size: larger"><strong>Sessões 3D</strong></span></span></p>\r\n<p><strong><span style="color: #c0c0c0">Sexta, Sábado, Domingo e Feriados</span></strong><span style="color: #c0c0c0"><br>\r\nIngresso: R$ 22,00<br>\r\nMeia-entrada: R$ 11,00 <br>\r\n<br>\r\n<strong>Segunda, Terça e Quinta</strong><br>\r\nIngresso: R$ 18,00<br>\r\nMeia-entrada: R$ 9,00 <br>\r\n<br>\r\n<strong>Quarta-feira Promocional*</strong><br>\r\nIngresso: R$ 10,00<br>\r\nMeia-entrada: R$ 5,00 <br>\r\n<br>\r\n<strong>Sábado Maluco</strong><br>\r\nIngresso: R$ 10,00&nbsp;</span></p>\r\n<p><span style="color: #7c0000"><span style="font-size: larger"><strong>Capacidade das Salas</strong></span></span></p>\r\n<p><span style="color: #c0c0c0">Arcoplex Itaguaçu 1: 370 lugares <br>\r\n</span><span style="color: #c0c0c0">Arcoplex Itaguaçu 2: 302 lugares <br>\r\n</span><span style="color: #c0c0c0">Arcoplex Itaguaçu 3: 181 lugares <br>\r\n</span><span style="color: #c0c0c0">Arcoplex Itaguaçu 4: 181 lugares <br>\r\n</span><span style="color: #c0c0c0">Arcoplex Itaguaçu 5: 181 lugares </span></p>\r\n<p><span style="color: #7c0000"><span style="font-size: larger"><strong>Observações</strong></span></span>&nbsp;</p>\r\n<ul>\r\n    <li><span style="color: rgb(192, 192, 192);">A programação de cinema é fornecida semanalmente por </span><a target="_blank" href="http://www.arcoiriscinemas.com.br"><span style="color: #c0c0c0">Arcoiris Cinemas</span></a> <span style="color: #c0c0c0"> e podem ocorrer alteraç<span style="color: rgb(192, 192, 192);">ões sem av</span>iso prévio</span>.</li>\r\n    <li><span style="color: rgb(192, 192, 192);">Informações adicionais podem ser obtidas no site da </span><a target="_blank" href="http://www.arcoiriscinemas.com.br"><span style="color: #c0c0c0">Arcoiris Cinemas</span></a>.</li>\r\n</ul>\r\n<p>&nbsp;</p>        </div>', 'arcoplex-itaguacu.png', '1', 2, 'Conforme sessões', '<ul>\r\n<li>Visa</li>\r\n<li>Master</li>\r\n<li>Dinheiro</li>\r\n</ul>', '(48) 4001-3100', 1, 3, '3.00', '2013-02-15 14:26:38'),
(11, 'floripa-shopping', NULL, 'FLORIPA SHOPPING', '<div id="box2" style="display: block;">\r\n			<img src="http://www.floripashopping.com.br/assets/images/institucional/i-fachada-2.jpg" width="610" height="239">\r\n			<ul>\r\n			<li style="padding: 10px 0;\r\nlist-style-image: url(http://www.floripashopping.com.br/imagens/verde-listas-seta.png);\r\nline-height: 22px;\r\ntext-align: justify">\r\n\r\nAberto ao público em <strong>9 de novembro de 2006</strong>, o Floripa Shopping possui localização privilegiada, arquitetura moderna e o melhor mix de lojas da região. Às margens da SC 401 – rodovia que liga o Centro ao Norte da Ilha de Santa Catarina, o empreendimento está na rota de desenvolvimento da cidade, no principal acesso às praias como Jurerê Internacional, Praia Brava, Canasvieiras, Ingleses e Costão do Santinho. Na SC 401, próximo ao Floripa Shopping estão o Centro Administrativo do Governo do Estado de Santa Catarina, o Teatro Pedro Ivo, Universidades e grandes complexos comerciais como o Corporate Park, o Parque Tecnópolis e o Grupo RBS, além da Tok&amp;Stok e das principais lojas de decoração de Florianópolis.</li>\r\n							<li style="padding: 10px 0;\r\nlist-style-image: url(http://www.floripashopping.com.br/imagens/verde-listas-seta.png);\r\nline-height: 22px;\r\ntext-align: justify">Pensado e construído para ser uma homenagem às características da Capital catarinense, o Floripa Shopping é um centro de compras, gastronomia, lazer e entretenimento, com lojas inéditas e marcas exclusivas em Santa Catarina. </li>\r\n							<li style="padding: 10px 0;\r\nlist-style-image: url(http://www.floripashopping.com.br/imagens/verde-listas-seta.png);\r\nline-height: 22px;\r\ntext-align: justify">O Floripa Shopping recebe um fluxo de 450.000 visitantes mensalmente e ainda circulam por esta rodovia cerca de 70 mil veículos diariamente.</li>\r\n							<li style="padding: 10px 0;\r\nlist-style-image: url(http://www.floripashopping.com.br/imagens/verde-listas-seta.png);\r\nline-height: 22px;\r\ntext-align: justify">Os principais diferenciais do Floripa Shopping são, além de sua arquitetura, com iluminação natural e lounges concebidos para o conforto dos clientes, a inovação e o pioneirismo em eventos. Por fomentar e desenvolver atividades para a conservação das riquezas existentes e por entender que as pessoas são o bem mais precioso, o Floripa Shopping foi o primeiro shopping da Capital a desenvolver uma Política socioambiental através de um sistema de Gestão Ambiental – o Preserva Floripa.</li>\r\n							<li style="padding: 10px 0;\r\nlist-style-image: url(http://www.floripashopping.com.br/imagens/verde-listas-seta.png);\r\nline-height: 22px;\r\ntext-align: justify">Foi vencedor do prêmio Empresa Cidadã da ADVB/SC em 2008 e do Prêmio Newton Rique de Responsabilidade Sócio Ambiental da ABRASCE em 2010. É o primeiro shopping do Sul do Brasil com excelência em sustentabilidade a conquistar a certificação ambiental ISO 14001. Em 2011 ganhou o Prêmio Expressão de Ecologia na categoria Gestão Ambiental com o projeto Preserva Floripa: O Olhar Ambiental do Floripa Shopping.</li>\r\n			</ul>\r\n		</div>\r\n\r\n\r\n\r\n<div>\r\n			  <ul>\r\n					<li>2 andares de lojas (140 lojas)</li>\r\n					<li>Área bruta locável: 28.779,17 m2</li>\r\n					<li>Área total construída: 79.194,83 m²</li>\r\n					<li>Praça de Alimentação: 615 lugares</li>\r\n					<li>Vagas de estacionamento: 1.126</li>\r\n					<li>Fluxo de público: 450 mil pessoas/mês</li>\r\n				</ul>\r\n				<ul>				\r\n					<li>7 salas de cinema com  1.400 lugares e Playland</li>\r\n					<li>6 elevadores, 14 escadas rolantes.</li>\r\n					<li>1.500 empregos diretos e 3.000 indiretos.</li>\r\n					<li>Fluxo de veículos de segunda a sexta-feira: cerca de 3 mil veículos / dia</li>\r\n					<li>Fluxo de veículos sábados e domingos: 5 mil veículos / dia</li>\r\n					\r\n				</ul>\r\n				<ul>\r\n					\r\n					\r\n				</ul>\r\n				<br clear="all">\r\n			</div>', 'floripa-shopping.png', '1', 3, '<ul>\r\n<li>2ª a Sáb.: das 10h às 22h</li>\r\n<li>Dom. e Feriados: das 11h às 21h</li>\r\n<li>Lojas das 15h às 21h</li>\r\n</ul>', 'Cartões', '(48) 3331.7000', 2, 6, '3.00', '2013-02-15 14:42:03'),
(12, 'teatro-governador-pedro-ivo', NULL, 'Teatro Governador Pedro Ivo', '<div class="content">\r\n	\r\n	<p style="text-align: justify;">Mais novo entre os teatros administrados pelo Estado, o Teatro Governador Pedro Ivo abriu suas portas para receber o público pela primeira vez em 21 de novembro de 2008, após três anos de obras. O espaço, junto ao Centro Administrativo do Governo do Estado de Santa Catarina, na rodovia SC-401, conta com área de 2,6 mil metros quadrados nos quais foram investidos R$ 5,9 milhões com recursos do Fundosocial e dos fundos de Cultura, Esporte e Turismo.</p>\r\n<p style="text-align: justify;">O teatro tem capacidade para 706 lugares e conta com um moderno sistema de iluminação, composto por 210 refletores com capacidade de 265 mil watts de potência. O espaço conta ainda com três camarins individuais e dois coletivos, além de um elevador elétrico que deslocará a orquestra do fosso até o palco, dinamizando os espetáculos.</p>\r\n<p style="text-align: justify;">O palco tem uma área de 450 metros quadrados e uma boca de cena de 7 x 14 metros, o que representa um dos diferenciais do teatro, em função da proximidade do palco, de grandes dimensões, com a plateia.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p> \r\n	</div>', 'teatro-governador-pedro-ivo.png', '1', 4, 'Conforme eventos', '<p><strong>TEATRO GOVERNADOR PEDRO IVO</strong> (apenas em dinheiro)<br>De segunda a domingo das 14:00 às 20:00 horas,<br>até a hora de início, para o espetáculo do dia.<br>Fone - (48) 3665-1630</p>', '(48) 3665-1630', 1, 3, '3.00', '2013-02-15 15:34:53'),
(13, 'fields-floripa', NULL, 'FIELDS Floripa', '<div class="home-col-left" style="line-height: 24px;">\r\n				\r\n						<div class="informacoes_texto">\r\n\r\n							\r\n\r\n												\r\n							<div class="clearBoth"></div>\r\n							<br>\r\n						\r\n							<h1>Florianópolis recebe um local premium de música sertaneja</h1>\r\n						\r\n							FIELDS Floripa a primeira casa de luxo voltada para sertanejo, ritmo que domina o Brasil em alta velocidade e agora contagia a Ilha de Santa Catarina. Projetada para um público exigente, com um espaço amplo, confortável, com pé direito de oito metros e dois ambientes. Pista e Mezanino VIP, área composta por nove camarotes estrategicamente posicionados de frente para o palco e 53 mesas bistrô garantindo excelência em serviços e no atendimento. \r\n							No palco shows com atrações de qualidade e duplas consagradas.\r\n							Se você ainda não conhece venha conhecer!!!\r\n\r\n							<br><br>\r\n							<h1>Localização</h1>\r\n\r\n							O ritmo que domina o Brasil já tem endereço certo na capital catarinense. A FIELDS estará localizada em pleno centro de Florianópolis, na Avenida Paulo Fontes, 1250 (prédio do Floripa Music Hall) e funcionará todas as quartas, sextas e sábados.  \r\n\r\n							\r\n						</div>	\r\n							\r\n						<br><br><br>\r\n					\r\n						<h1>Observações e Informações importantes</h1>\r\n					\r\n						<p>» Obrigatório apresentação de documento original, oficial com foto atualizada.</p>\r\n						<p>» Proibida a entrada de menores de 18 anos mesmo acompanhados ou emancipados.</p>\r\n						<p>» Não aceitamos cheques.</p>\r\n						<p>» Cobramos 10% de taxa de serviços.</p>\r\n						<p>» Não aceitamos cartões Diners, Amex. Não aceitamos cartões corporativos. Não aceitamos cartões de terceiros, mesmo que de grau parentesco próximos.</p>\r\n						<p>» Proibida a entrada de clientes usando chapéu (sem ser estilo country), boné, gorros, tocas, correntes, bermudas, regatas, chinelos e camisetas de times.</p>\r\n						<p>» Estacionamento com vagas limitadas e serviço de vallet: R$ 25,00 por veículo.</p>\r\n						<p>» A reserva ou nome na lista não garante a entrada, todos estão sujeito a lotação da casa. (Cheguem cedo)</p>\r\n						<p>» As reservas de mesas e camarotes são validas até as 00h30.</p>\r\n						<p>» Depósito antecipado na reservas de camarotes.</p>\r\n						<p>» A venda das pulseiras individuais é limitada.</p>\r\n						<p>» Possuímos área de fumantes.</p>\r\n						<p>» Trabalhamos também com eventos fechado consulte.</p>\r\n						<p>» Valores diferenciados para eventos especiais consulte.</p>\r\n						\r\n							\r\n							\r\n					\r\n					</div>', 'fields-floripa.png', '1', 5, '<h1>HORÁRIO DE FUNCIONAMENTO</h1>\r\n<p>Quarta, Sexta e Sábado, a partir das 22:30h.</p>', 'Todos cartões', '(48) 3025-6646', 1, 4, '4.00', '2013-02-15 15:46:13'),
(14, 'el-divino-lounge', NULL, 'El Divino Lounge', 'Inspirados nas baladas da ilha de Ibiza, o Grupo EL DIVINO BRASIL possui as melhores casas de Florianópolis. O El Divino, Parador 12 e Donna Dinning Club.', 'el-divino-lounge.png', '1', 6, 'Conforme eventos', 'Todos Cartões', '(48) 3225-1266', 1, 2, '2.00', '2013-02-15 15:54:05');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `id_parceiro` int(11) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `ip`, `id_parceiro`, `hora`) VALUES
(12, '127.0.0.1', 4, '2013-02-08 22:07:13'),
(13, '127.0.0.1', 4, '2013-02-08 22:09:36'),
(14, '127.0.0.1', 4, '2013-02-08 22:09:40'),
(15, '127.0.0.1', 4, '2013-02-08 22:09:41'),
(16, '127.0.0.1', 4, '2013-02-13 17:03:03'),
(17, '127.0.0.1', 11, '2013-02-15 14:42:20'),
(18, '127.0.0.1', 10, '2013-02-15 15:28:17'),
(19, '127.0.0.1', 12, '2013-02-15 15:35:46'),
(20, '127.0.0.1', 13, '2013-02-15 22:54:17'),
(21, '127.0.0.1', 14, '2013-02-15 23:04:44'),
(22, '127.0.0.1', 11, '2013-02-18 13:51:37');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `rel_atividade_parceiro`
--

INSERT INTO `rel_atividade_parceiro` (`id`, `id_parceiro`, `id_atividade`, `ativo`, `hora`) VALUES
(1, 4, 3, '0', '2013-02-07 18:42:39'),
(2, 4, 4, '0', '2013-02-07 18:43:26'),
(3, 4, 5, '0', '2013-02-07 18:43:26'),
(4, 4, 6, '0', '2013-02-07 18:43:32'),
(5, 8, 3, '0', '2013-02-07 20:51:47'),
(6, 8, 5, '0', '2013-02-07 20:51:47'),
(7, 8, 1, '0', '2013-02-07 20:51:47'),
(8, 8, 6, '0', '2013-02-07 20:51:47'),
(9, 8, 4, '0', '2013-02-07 20:51:47'),
(10, 8, 2, '0', '2013-02-07 20:51:47'),
(11, 9, 4, '0', '2013-02-07 20:56:02'),
(12, 10, 1, '0', '2013-02-15 14:26:38'),
(13, 11, 1, '0', '2013-02-15 14:42:03'),
(14, 11, 4, '0', '2013-02-15 14:42:03'),
(15, 12, 2, '0', '2013-02-15 15:34:53'),
(16, 13, 5, '0', '2013-02-15 15:46:13'),
(17, 13, 6, '0', '2013-02-15 15:46:13'),
(18, 14, 3, '0', '2013-02-15 15:54:05'),
(19, 14, 5, '0', '2013-02-15 15:54:05'),
(20, 14, 6, '0', '2013-02-15 15:54:05'),
(21, 14, 4, '0', '2013-02-15 15:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `rel_genero_evento`
--

DROP TABLE IF EXISTS `rel_genero_evento`;
CREATE TABLE IF NOT EXISTS `rel_genero_evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evento` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `ativo` enum('0','1') NOT NULL DEFAULT '0',
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_parceiro` (`id_evento`),
  KEY `id_atividade` (`id_genero`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `rel_genero_evento`
--

INSERT INTO `rel_genero_evento` (`id`, `id_evento`, `id_genero`, `ativo`, `hora`) VALUES
(1, 1, 1, '1', '2013-02-08 12:12:31'),
(2, 3, 3, '0', '2013-02-08 12:22:53'),
(3, 3, 2, '0', '2013-02-08 12:22:53'),
(4, 3, 1, '0', '2013-02-08 12:22:53'),
(5, 3, 4, '0', '2013-02-08 12:22:54'),
(6, 4, 5, '0', '2013-02-15 14:30:49'),
(7, 5, 3, '0', '2013-02-15 14:32:28'),
(8, 6, 4, '0', '2013-02-15 14:45:06'),
(9, 7, 7, '0', '2013-02-15 15:38:54'),
(10, 8, 1, '0', '2013-02-15 15:48:46'),
(11, 9, 8, '0', '2013-02-15 15:58:13'),
(12, 9, 9, '0', '2013-02-15 15:58:13');

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
  ADD CONSTRAINT `parceiros_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `parceiros_ibfk_3` FOREIGN KEY (`id_endereco`) REFERENCES `local_enderecos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `rel_genero_evento`
--
ALTER TABLE `rel_genero_evento`
  ADD CONSTRAINT `rel_genero_evento_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `rel_genero_evento_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_endereco`) REFERENCES `local_enderecos` (`id`);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
