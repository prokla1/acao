-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 05, 2013 as 07:11 PM
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `aa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividades`
--

DROP TABLE IF EXISTS `atividades`;
CREATE TABLE IF NOT EXISTS `atividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `ativo` enum('0','1') NOT NULL DEFAULT '0',
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `atividades`
--

INSERT INTO `atividades` (`id`, `nome`, `url`, `ativo`, `hora`) VALUES
(1, 'Cinema', 'cinema', '1', '2013-02-14 12:24:47'),
(2, 'Teatro', 'teatro', '1', '2013-02-14 12:24:47'),
(3, 'Bar', 'bar', '1', '2013-02-14 12:24:47'),
(4, 'Restaurante', 'restaurante', '1', '2013-02-14 12:24:47'),
(5, 'Casa Noturna', 'casa-noturna', '1', '2013-02-14 12:24:47'),
(6, 'Festa', 'festa', '1', '2013-02-14 12:24:47'),
(7, 'Karaokê', 'karaoke', '1', '2013-03-05 14:27:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `conversao`
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

--
-- Extraindo dados da tabela `conversao`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `cortesias`
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

--
-- Extraindo dados da tabela `cortesias`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
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

--
-- Extraindo dados da tabela `eventos`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos_fotos`
--

DROP TABLE IF EXISTS `eventos_fotos`;
CREATE TABLE IF NOT EXISTS `eventos_fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evento` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_evento` (`id_evento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `eventos_fotos`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `generos`
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
-- Extraindo dados da tabela `generos`
--

INSERT INTO `generos` (`id`, `nome`, `ativo`, `hora`) VALUES
(1, 'Sertanejo', '1', '2013-02-08 09:57:44'),
(2, 'Rock', '1', '2013-02-08 09:57:44'),
(3, 'Ação', '1', '2013-02-08 09:58:03'),
(4, 'Terror', '1', '2013-02-08 09:58:03'),
(5, 'Comédia', '1', '2013-02-15 12:28:04'),
(6, 'Animação', '1', '2013-02-15 12:28:04'),
(7, 'Cultural', '1', '2013-02-15 13:37:35'),
(8, 'Funk', '1', '2013-02-15 13:55:41'),
(9, 'Pop', '1', '2013-02-15 13:55:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `local_cidades`
--

DROP TABLE IF EXISTS `local_cidades`;
CREATE TABLE IF NOT EXISTS `local_cidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `ativo` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `local_cidades`
--

INSERT INTO `local_cidades` (`id`, `nome`, `id_estado`, `ativo`) VALUES
(1, 'São José', 1, '1'),
(2, 'Biguaçu', 1, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `local_enderecos`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `local_enderecos`
--

INSERT INTO `local_enderecos` (`id`, `id_cidade`, `rua`, `numero`, `complemento`) VALUES
(1, 1, 'Rua Gerôncio Thives', 'nº 1079', 'Barreiros - Shopping Itaguaçu'),
(2, 1, 'Av. Constâncio Krummel', 'nº 2397', 'Praia Comprida'),
(3, 2, 'Rod. Br 101', 's/nº', 'Km 193 - Centro'),
(4, 2, 'Marginal Oeste Paulo Zimmermann', 'nº 83', 'BR 101, km 198 - Bom Viver'),
(5, 1, 'Rua Adhemar da Silva', 'nº 1', 'Kobrasol'),
(6, 1, 'Av. Lédio João Martins', 's/nº', 'ao lado da Videoteca 24h - Kobrasol '),
(7, 1, 'R. Caetano José Ferreira', 'nº 424', 'Kobrasol'),
(8, 1, 'Rua Koesa', 'nº 307', 'Kobrasol'),
(9, 1, 'Rua Domingos André Zanini', 'nº 277', 'Loja 01/02 - Centro Empresarial Terra Firme'),
(10, 1, 'Rua Assis Brasil', 'nº 5814', 'Ponta de Baixo'),
(11, 1, 'Rua Assis Brasil', 'nº 5848', 'Ponta de Baixo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `local_estados`
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
-- Extraindo dados da tabela `local_estados`
--

INSERT INTO `local_estados` (`id`, `sigla`, `nome`, `id_pais`, `ativo`) VALUES
(1, 'SC', 'Santa Catarina', 1, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `local_pais`
--

DROP TABLE IF EXISTS `local_pais`;
CREATE TABLE IF NOT EXISTS `local_pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(2) NOT NULL,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `local_pais`
--

INSERT INTO `local_pais` (`id`, `sigla`, `nome`) VALUES
(1, 'BR', 'Brasil');

-- --------------------------------------------------------

--
-- Estrutura da tabela `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cidade` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_cidade` (`id_cidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `news`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `parceiros`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `parceiros`
--

INSERT INTO `parceiros` (`id`, `url_amigavel`, `id_usuario`, `nome`, `descricao`, `foto`, `ativo`, `id_endereco`, `funcionamento`, `pagamento`, `telefone`, `num_votos`, `total_pontos`, `rating`, `hora`) VALUES
(1, 'quiosque-chopp-da-brahma', NULL, 'Quiosque Chopp da Brahma', '<p><p><strong>400 metros quadrados de descontração</strong><br>Inaugurado em 2008, o Quiosque da Brahma Shopping Itaguaçu tem o espaço ideal para as pessoas que frequentam o shopping dar aquela pausa relaxante.<br>Aqui, entre uma compra e outra, você pode ouvir uma boa música, tomar um chopp de qualidade e saborear porções e pratos deliciosos.</p><p><strong>Chopp Brahma com qualidade garantida</strong><br>O Quiosque é treinado pela Real Academia do Chopp e adota cuidados especiais com o chopp, desde o seu armazenamento até a hora em que ele chega cremoso em sua mesa.<br>As chopeiras e demais equipamentos têm design moderno e exclusivo, criado especialmente para quiosques, além de balcão e banquetas estilizadas que dão charme à decoração.</p><p><strong>Programação Musical</strong><br>No Quiosque você vai encontrar mais do que a loja âncora do chopp com petiscos. Vai encontrar também uma programação intensa de shows e apresentações musicais.<br><strong>Segunda, terça e quarta:</strong>&nbsp;voz e violão.<br><strong>Quinta-feira:</strong>&nbsp;Sertanejo Universitário.<br><strong>Sexta e sábado:</strong>&nbsp;Pop Rock.<br><strong>Domingo:</strong>&nbsp;Pagode.</p><p><strong>E mais</strong><br>- Delicioso buffet executivo, de segunda a sexta-feira.<br>- Aos sábados, feijoada com o Grupo Portal do Choro.<br>- Aos Domingos, buffet com grande variedade de frutos do mar.</p><br></p>', 'quiosque-chopp-da-brahma.jpg', '1', 1, '<p>Segunda a quarta-feira, das 11h às 00h30.<br>Quinta a domingo, das 11h às 2h.<br></p>', '<p>Cartão / dinheiro</p>', '(48) 3343 7146', 0, 0, '0.00', '2013-03-05 10:01:42'),
(2, 'clube-mare-alta', NULL, 'Clube Maré Alta', '<p>O Clube maré alta é uma casa de bailes e shows direcionada a um público de alto astral.&nbsp;</p><p>O diferencial está no horário de funcionamento que é de sexta à segunda (dia atípico), a partir das 15h. No período da tarde tem baile para a terceira idade e sem parar a festa, vai entrando a noite e o público jovem toma conta do clube.&nbsp;<br><br>A programação é fixa com música ao vivo, duas Bandas exclusivas, que tocam vários ritmos dançantes. Shows diferenciados durante o mês para o público dançar e se divertir com seus amigos são outros atrativos.<br><br>O valor das entradas varia conforme o horário e dia do baile, porém são acessíveis para quem quer dançar, encontrar alguém e curtir os amigos com segurança.<br><br>Venha se divertir no Clube Maré Alta, porque essa é a melhor opção.&nbsp;<br><br>Maré Alta: Divertimento, boa música, shows, cerveja gelada e um ambiente feliz.<br></p>', 'clube-mare-alta.jpg', '1', 2, '<p>Sexta e Sábado 15hrs às 4hrs<br><span style="font-size: 15px; line-height: 1.45em;">Domingos e Segundas: 15hrs à 1hr</span></p>', '<p>Não confirmado</p>', '(48) 32470310', 0, 0, '0.00', '2013-03-05 10:42:43'),
(3, 'centro-de-eventos-petry', NULL, 'Centro de eventos PETRY', '<p><h3>Conheça a nossa História</h3><p>O Centro de Eventos Petry iniciou suas atividades em Abril de 2002. Mas, desde 1.998, seus administradores, vinham de uma larga experiência com eventos em seu empreendimento anterior, o Complexo Esportivo Petry. Este explorava a prática esportiva oferecendo a comunidade de Biguaçu, Locação de Campo de Futebol Sintético e Escolinha de Futebol, além de Restaurante e Locação de seu salão para Festas com até no Maximo 300 pessoas.</p><p>Com necessidade de ampliar sua estrutura, o Complexo Esportivo Petry, transformou-se em Centro de Eventos Petry. Uma casa de eventos ampla com 3.780 metros quadrados de área construída, destinada a Produção e Promoção de Eventos com estrutura para atender eventos de 100 a 6.000 pessoas. Hoje, o Cepetry, como é conhecido, abrange todos os municípios da Grande Florianópolis pela fácil localização e acesso.</p><h4>Entre seus serviços, destacam-se os seguintes:</h4><ul><li>Shows Regionais e Nacionais</li><li>Formaturas</li><li>Locação de Espaço para Feiras, Workshops, Congressos e Exposições</li><li>Confraternizações com Buffet Próprio</li><li>Festas de Empresas</li></ul><p>Em 10 anos de História, o Cepetry, já realizou mais de 500 eventos aberto ao público, sendo vários Shows Nacionais de destaque entre eles: Roupa Nova, Zé Ramalho, Bruno e Marrone, Victor e Leo, Cezar Menotti e Fabiano, Alexandre Pires, Inimigos da HP, Jorge e Mateus, Paula Fernandes, Gustavo Lima, Luan Santana entre outros.</p><p>Com objetivo de manter a Qualidade de seus Shows e demais Eventos, o Petry tem como Missão a "Produção e Realização de Espetáculos para gerar o Entretenimento através dos Eventos, atendendo as necessidades de lazer e superando as expectativas do cliente, com Segurança, Qualidade, Respeito e Inovação".</p><p>Com isso, a empresa está Posicionada como uma casa de Eventos com Excelente Estrutura, Qualidade e Segurança nos Eventos que realiza.</p><p>A Visão da Empresa "é ser considerada perante o mercado consumidor como a melhor casa de espetáculos e eventos da Região Sul do Brasil ate 2015".</p><p>Seu Propósito atual é a melhoria da sua estrutura física, a profissionalização e capacitação de seus colaboradores. Já seu Propósito potencial é ampliar sua estrutura física, buscar soluções tecnológicas para a comercialização de produtos.</p><br></p>', 'centro-de-eventos-petry.jpg', '1', 3, '<p>Conforme eventos</p>', '<p>n/a.</p>', '(48) 3243-2632', 0, 0, '0.00', '2013-03-05 10:55:50'),
(4, 'celeiros-beer', NULL, 'Celeiros Beer', '<p>O CELEIRO`S BEER, iniciou suas atividades em janeiro de 2002, com objetivo de integrar socialmente a comunidade de Biguaçu. O empreendimento foi elaborado, planejado e construído em um espaço de aproximadamente 30.000 m² , localizado as margens da BR-101 na cidade de Biguaçu/SC e com uma área construída de 1500 m², para atender nossos clientes, com o intuito de promover eventos diversificados tais como:</p><br />\r\n\r\n<ul>\r\n<li>Bailes;</li>\r\n<li>Locação para formaturas;</li>\r\n<li>Locação de salão para eventos;</li>\r\n<li>Shows Regionais, Nacionais e Internacionais;</li>\r\n<li>Palestras e reuniões de empresas;</li>\r\n</ul>\r\n<br />\r\n<p>\r\nPossui localização estratégica, ás margens da BR 101, fácil acesso, ampla área externa, estacionamento fechado e vigiado, espaço versátil, o que permite atender um público de 100 a 2.500 pessoas.\r\n</p>\r\n\r\n<p>\r\nNosso principal objetivo é oferecer entretenimento através da produção e realização de eventos e espetáculos de qualidade, com segurança, comodidade e conforto aos nossos clientes, que aqui são tratados com diferenciais exclusivos, atendimento qualificado, personalizado e dirigido ao público determinado.\r\nNossa missão é promover e oferecer eventos de entretenimento para a comunidade em geral proporcionando à todos lazer e diversão com segurança, conforto, comodidade e qualidade no atendimento, visando o bem estar e preservando a integridade das pessoas, proporcionando melhoria na qualidade de vida no município de Biguaçu e região metropolitana.</p>', 'celeiros-beer.jpg', '1', 4, '<p>Conforme evento.</p>', '<p>n/a.</p>', '(48) 3258.4198', 0, 0, '0.00', '2013-03-05 11:25:32'),
(5, 'villa-show', NULL, 'Villa Show', '<p><p>Com uma estrutura diferenciada o Villa Show possui pista de dança, camarotes, mesas VIP, ambiente climatizado e amplo, com total visão do palco e dos demais ambientes da casa. O Villa Show&nbsp; tem a capacidade de instalar com comodidade um número considerável de clientes, sentadas ou em pé.</p><p>A casa foi desenhada de uma forma estratégica, para que mesmo dos camarotes mais reservados os clientes tenham visão do palco, fácil acesso à pista, caixa e saídas de emergência.</p><p><br>Temos também:</p><p>- Toaletes (masculino e feminino) Ambos com adaptação para deficientes físicos;<br>- 04 caixas para melhor atendê-lo;<br>- American bar;<br>- Pistas de dança ampla na frente do palco;<br>- Telão com shows;<br>- Chapelaria para oferecer melhor segurança a seus pertences.<br>- Garçons separados por área (Atendimento mais rápido e qualificado)<br>- Sistema Interno de câmeras com vigilância por profissional qualificado.<br>- Contamos com uma equipe de profissionais altamente capacitados para lhe atender, dentre eles um grupo de:<br>- Recepcionistas<br>- Garçons<br>- Caixa<br>- Seguranças<br>- Cozinheiros<br>- Auxiliares de limpeza<br>- Bar men</p><p>E um gerente supervisionando o desempenho dos mesmos a todo o momento.</p><p>Temos também manobrista, dando-lhe maior tranquilidade para entrar na casa e não se preocupar com vaga para estacionar.</p><p>O Villa Show é uma casa de tradição sertaneja e gauchesca, que como toda empresa tradicional, sempre preservou certos valores, não só fins lucrativos para seus acionistas, mas bem como prioridade, ética, respeito a todos, seriedade e honestidade, e assim conseguimos credibilidade junto aos clientes.</p><br></p>', 'villa-show.jpg', '1', 5, '<p>Conforme evento.</p>', '<p>N/A</p>', '(48) 3047-0969', 0, 0, '0.00', '2013-03-05 12:17:47'),
(6, 'bar-o-bohemio', NULL, 'Bar O Bohêmio', '<p>O Bar O Bohêmio, possui 1 ambiente externo, ao ar livre, permitido para fumantes e um ambiente interno climatizado, rústico, decorado com a temática dos anos 50, lembrando os bons tempos da boemia.&nbsp; O bar conta com uma boa música ao vivo nos estilos sertanejo, pagode e MPB. Procurando sempre inovar.<p><br></p><p>Oferecemos um amplo cardápio de bebidas: cervejas, refrigerantes, sucos, caipiras, drinques e destilados, além de servir petiscos e porções.</p><p></p><ul><li>Aceitamos Reserva</li><li>Ar condicionado</li><li>Estacionamento</li><li>Segurança</li><li>TV/Telão</li></ul><p></p><br></p>', 'bar-o-bohemio.jpg', '1', 6, '<p>Conforme evento</p>', '<p><b>Cartão de Crédito:&nbsp;</b>MasterCard,&nbsp; Visa.<br><b>Cartão de Débito:&nbsp;</b>Redeshop,&nbsp; Mastercard Maestro,&nbsp; Visa Electron,&nbsp; Maestro.<br></p>', '48 8400-5873', 0, 0, '0.00', '2013-03-05 12:40:53'),
(7, 'cantinho-da-fama', NULL, 'Cantinho da Fama', '<p>Todo o dia é dia de cantar, aproveite esse momento.<br></p><p>O melhor lugar para se cantar na Grande Florianópolis!<br></p>', 'cantinho-da-fama.jpg', '1', 7, '<p>Conforme agenda.</p>', '<p>N/A.</p>', '(48) 3357-6859', 0, 0, '0.00', '2013-03-05 13:02:50'),
(8, 'armazem-bar-cafe', NULL, 'Armazém Bar Café', '<p>Em breve...</p>', 'armazem-bar-cafe.jpg', '1', 8, '<p>Conforme agenda.</p>', '<p>N/A<br></p>', '(48) 3343-3432', 0, 0, '0.00', '2013-03-05 13:34:42'),
(9, 'cervejaria-original-sao-jose', NULL, 'Cervejaria Original (São José)', '<p><p><span>A Cervejaria Original é uma compilação do que melhor é produzido nos botecos do país. O que há de gostoso naqueles barzinhos de alguma pacata esquina do interior, somados ao que faz sucesso nas petiscarias das grandes Capitais, ajudou-nos a criar e sustentar uma proposta irresístivel.</span></p><p><span>Apresentar o simples com pinceladas de sofisticação. Garantir com que nossos clientes sintam-se à vontade desde o almoço e o Happy Hour da Cervejaria de Florianópolis, até as festas inesquecíveis da gigantesca Original de São José.</span></p><p><span>No cardápio brilham os mais de 30 rótulos de cervejas de vários países e os clássicos da coquetelaria nacional e internacional. Tudo harmonizando com a cozinha enfatizada na Baixa Gastronomia; bolinhos de frutos do mar, chapas de petiscos, pasteis, escondidinhos, o delicioso "Onion Original" e outras pérolas que deixam qualquer paladar com água na boca...</span></p><p></p><p><span>Móveis, quadros, placas de publicidade, equipamentos e vários utensílios que remontam às décadas do século passado, oferecem-nos a autêntica e elegante ambientação vintage</span></p><p></p><p><span>Cervejaria Original. Sem luxos ou excessos. Apenas um Boteco - o Melhor de Santa Catarina.</span></p><br></p>', 'cervejaria-original-sao-jose.jpg', '1', 9, '<p>Terça à Domingo, a partir das 19hrs.<br></p>', '<p>N/A</p>', '(48) 3034-7900', 0, 0, '0.00', '2013-03-05 13:50:35'),
(10, 'tropicalia-bar', NULL, 'Tropicalia Bar', '<p>Bandas, karaokê e também uma variedade de porções de frutos do mar. Estacionamento Exclusivo. Idade mínima 18 anos.<br></p>', 'tropicalia-bar.jpg', '1', 10, '<p>Karaokê de terça a domingo das 19:30hrs às 2hrs.</p><p>Quarta, sexta e sábado com as melhores bandas.<br></p>', '<p>American Express<br>Diners Club<br>ELO<br>MasterCard<br>Visa<br><br></p><p><br></p>', '(48) 325-2005', 0, 0, '0.00', '2013-03-05 14:39:04'),
(11, 'affinita-club', NULL, 'Affinitá Club', '<p><p>Surgiu da necessidade de uma casa específica e permanente, para casais exigentes de bom gosto, iniciantes ou experientes no swing.</p><p>A grande Florianópolis tem agora uma casa aconchegante, discreta, segura, bem localizada e própria para pessoas alegres e de bem com a vida. eis a affinitá club, projetada para grandes momentos de sedução, trocas prazerosas, exibicionismo e voyeurismo e tudo o que sua imaginação mandar, e onde ninguém é obrigado a nada.</p><p>Primamos pela segurança, discrição, conforto e alto astral em nossas festas.</p><p>Tudo na Affinitá club foi criado levando em consideração a opinião de casais amigos adeptos do swing.</p><p></p><div><h2>Principais vantagens:</h2><p>» exclusiva pista de dança;<br>» lounge sex;<br>» american bar;<br>» som e iluminação de última geração;<br>» estacionamento privativo com manobrista;<br>» fácil localização e local discreto;<br>» shows com performers profissionais em todas<br>&nbsp;as festas;<br>» dj residente;<br>» garçons e garçonetes treinados;<br>» aceitamos cartões de crédito: mastercard,<br>&nbsp;visa, hipercard.</p><p></p><h2>Diversos ambientes incluindo:</h2><p>» sala temática de massagem com cremes;<br>» suítes privativas;<br>» quarto coletivo;<br>» cabines de toque;<br>» dark room;<br>» cine sex;<br>» pole dance e palquinho para performance dos<br>&nbsp;casais;<br><br><br><b>Todos os Ambientes são climatizados</b></p></div><p>O casal proprietário&nbsp;<a href="http://www.affinitaclub.com.br/#perfil&amp;cad_id=MTA5LWExNDIyZQ,,">TWSC</a>, estão presentes em todas as festas, sempre a disposição para ouvir a todos. com suas sugestões. novos ambientes serão criados. Vocês são nossos convidados, nossa principal razão de existência, sua satisfação é nosso compromisso.</p><p>Reservamos ainda alguns agrados e delicadezas como surpresas, venha divertir-se em nossa casa.</p><br></p>', 'affinita-club.jpg', '1', 11, '<p>N/A</p>', '<p>N/A<br></p>', '(48) 9624-0725', 0, 0, '0.00', '2013-03-05 15:05:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `parceiros_contato`
--

DROP TABLE IF EXISTS `parceiros_contato`;
CREATE TABLE IF NOT EXISTS `parceiros_contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parceiro` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `assunto` varchar(200) NOT NULL,
  `mensagem` text NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enviado` enum('0','1') DEFAULT '0' COMMENT '0->nao || 1->sim',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `parceiros_contato`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `parceiros_fotos`
--

DROP TABLE IF EXISTS `parceiros_fotos`;
CREATE TABLE IF NOT EXISTS `parceiros_fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parceiro` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_parceiro` (`id_parceiro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

--
-- Extraindo dados da tabela `parceiros_fotos`
--

INSERT INTO `parceiros_fotos` (`id`, `id_parceiro`, `url`) VALUES
(1, 1, '201303051018255135f0a12a724.jpg'),
(2, 1, '201303051018255135f0a1d1cf8.jpg'),
(3, 1, '201303051018265135f0a24a3a7.jpg'),
(4, 1, '201303051018265135f0a296290.jpg'),
(5, 1, '201303051018275135f0a326f35.jpg'),
(6, 1, '201303051018275135f0a3bee2d.jpg'),
(7, 1, '201303051018285135f0a457d2b.jpg'),
(8, 3, '201303051115455135fe118e24c.jpg'),
(9, 3, '201303051115465135fe1295812.jpg'),
(10, 3, '201303051115475135fe133687a.jpg'),
(11, 3, '201303051115475135fe13cbbe5.jpg'),
(12, 3, '201303051115485135fe147d128.jpg'),
(13, 3, '201303051115495135fe1523963.jpg'),
(14, 4, '2013030511345951360293bf582.jpg'),
(15, 4, '2013030511350051360294966d1.jpg'),
(16, 4, '201303051135015136029565b41.jpg'),
(17, 4, '201303051135025136029611862.jpg'),
(18, 4, '2013030511350251360296b1871.jpg'),
(19, 4, '20130305113503513602974fecd.jpg'),
(20, 5, '2013030512270251360ec62c1e4.jpg'),
(21, 5, '2013030512270251360ec6bbc3c.jpg'),
(22, 5, '2013030512270351360ec754ad8.jpg'),
(23, 6, '20130305124731513613936e3c7.jpg'),
(24, 7, '2013030513171951361a8fc5300.jpg'),
(25, 7, '2013030513172051361a9060018.jpg'),
(26, 7, '2013030513172051361a90befe8.jpg'),
(27, 7, '2013030513172151361a916db20.jpg'),
(28, 7, '2013030513172251361a9244f3b.jpg'),
(29, 7, '2013030513172351361a9306ee9.jpg'),
(30, 7, '2013030513172351361a93ac053.jpg'),
(31, 7, '2013030513172451361a9453245.jpg'),
(32, 7, '2013030513172451361a94f0911.jpg'),
(33, 7, '2013030513172551361a95965e6.jpg'),
(34, 7, '2013030513172651361a96658e0.jpg'),
(35, 7, '2013030513172751361a970956e.jpg'),
(36, 7, '2013030513172751361a97a141b.jpg'),
(37, 7, '2013030513172851361a9845577.jpg'),
(38, 7, '2013030513172951361a9919993.jpg'),
(39, 7, '2013030513172951361a99b4471.jpg'),
(40, 7, '2013030513173051361a9a6dbf6.jpg'),
(41, 7, '2013030513173151361a9b17cf5.jpg'),
(42, 7, '2013030513173151361a9bb1a02.jpg'),
(43, 7, '2013030513173251361a9c5ae1b.jpg'),
(44, 8, '2013030513371351361f3943d6c.jpg'),
(45, 8, '2013030513371351361f39f3d8a.jpg'),
(46, 8, '2013030513371451361f3aa27ae.jpg'),
(47, 8, '2013030513371551361f3b59985.jpg'),
(48, 8, '2013030513371651361f3c483c5.jpg'),
(49, 8, '2013030513371751361f3d12bcb.jpg'),
(50, 8, '2013030513371751361f3dc5c5e.jpg'),
(51, 8, '2013030513371851361f3e90eba.jpg'),
(52, 8, '2013030513371951361f3f3e48f.jpg'),
(53, 8, '2013030513371951361f3fee8c3.jpg'),
(54, 8, '2013030513372051361f40a29b4.jpg'),
(55, 8, '2013030513372151361f4159684.jpg'),
(56, 8, '2013030513372251361f421b019.jpg'),
(57, 8, '2013030513372251361f42db9fd.jpg'),
(58, 8, '2013030513372351361f4392584.jpg'),
(59, 8, '2013030513372451361f4451458.jpg'),
(60, 9, '201303051355035136236766791.jpg'),
(61, 10, '2013030514420051362e68dee4a.jpg'),
(62, 10, '2013030514420151362e6952c21.jpg'),
(63, 10, '2013030514420151362e69dfcec.jpg'),
(64, 10, '2013030514420251362e6a7e2dd.jpg'),
(65, 10, '2013030514420351362e6b016a4.jpg'),
(66, 10, '2013030514420351362e6b8651d.jpg'),
(67, 11, '20130305151323513635c3328d3.jpg'),
(72, 11, '20130305151326513635c67889b.jpg'),
(73, 11, '20130305151327513635c7489a4.jpg'),
(74, 11, '20130305151327513635c7d8374.jpg'),
(75, 11, '20130305151328513635c876391.jpg'),
(76, 11, '20130305151329513635c9095fd.jpg'),
(77, 11, '20130305151329513635c9b5041.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `id_parceiro` int(11) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `ratings`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_atividade_parceiro`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Extraindo dados da tabela `rel_atividade_parceiro`
--

INSERT INTO `rel_atividade_parceiro` (`id`, `id_parceiro`, `id_atividade`, `ativo`, `hora`) VALUES
(1, 1, 3, '0', '2013-03-05 10:01:42'),
(2, 1, 5, '0', '2013-03-05 10:01:42'),
(3, 1, 4, '0', '2013-03-05 10:01:42'),
(4, 2, 5, '0', '2013-03-05 10:42:43'),
(5, 2, 6, '0', '2013-03-05 10:42:43'),
(6, 3, 3, '0', '2013-03-05 10:55:50'),
(7, 3, 5, '0', '2013-03-05 10:55:50'),
(8, 3, 6, '0', '2013-03-05 10:55:50'),
(9, 3, 4, '0', '2013-03-05 10:55:50'),
(10, 4, 3, '0', '2013-03-05 11:25:32'),
(11, 4, 5, '0', '2013-03-05 11:25:32'),
(12, 4, 6, '0', '2013-03-05 11:25:33'),
(13, 5, 3, '0', '2013-03-05 12:17:48'),
(14, 5, 5, '0', '2013-03-05 12:17:48'),
(15, 5, 6, '0', '2013-03-05 12:17:48'),
(16, 6, 3, '0', '2013-03-05 12:40:54'),
(17, 6, 5, '0', '2013-03-05 12:40:54'),
(18, 6, 4, '0', '2013-03-05 12:40:54'),
(19, 7, 3, '0', '2013-03-05 13:02:50'),
(20, 7, 5, '0', '2013-03-05 13:02:50'),
(21, 7, 6, '0', '2013-03-05 13:02:50'),
(22, 7, 4, '0', '2013-03-05 13:02:50'),
(23, 8, 3, '0', '2013-03-05 13:34:42'),
(24, 8, 5, '0', '2013-03-05 13:34:42'),
(25, 8, 6, '0', '2013-03-05 13:34:42'),
(26, 8, 4, '0', '2013-03-05 13:34:42'),
(27, 9, 3, '0', '2013-03-05 13:50:35'),
(28, 9, 5, '0', '2013-03-05 13:50:35'),
(29, 9, 6, '0', '2013-03-05 13:50:35'),
(30, 9, 4, '0', '2013-03-05 13:50:35'),
(31, 10, 3, '0', '2013-03-05 14:39:05'),
(32, 10, 5, '0', '2013-03-05 14:39:05'),
(33, 10, 6, '0', '2013-03-05 14:39:05'),
(34, 10, 7, '0', '2013-03-05 14:39:05'),
(35, 10, 4, '0', '2013-03-05 14:39:05'),
(36, 11, 3, '0', '2013-03-05 15:05:23'),
(37, 11, 5, '0', '2013-03-05 15:05:23'),
(38, 11, 6, '0', '2013-03-05 15:05:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_genero_evento`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `rel_genero_evento`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_local_parceiro`
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
-- Extraindo dados da tabela `rel_local_parceiro`
--

INSERT INTO `rel_local_parceiro` (`id`, `id_parceiro`, `id_local`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_local_usuario`
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
-- Extraindo dados da tabela `rel_local_usuario`
--

INSERT INTO `rel_local_usuario` (`id`, `id_usuario`, `id_local`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
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
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_facebook`, `nome`, `cpf`, `email`, `senha`, `sexo`, `nascimento`, `foto`, `ativo`, `email_verificado`, `id_endereco`, `hora`, `array_face`, `admin`) VALUES
(1, '', 'Juscelino Iene Cordeiro da Silva', 00000000000, 'jus@jus.com', '202cb962ac59075b964b07152d234b70', '0', '0000-00-00', 'null.jpg', '1', '0', NULL, '2012-06-05 17:31:07', '', '0'),
(2, '', 'Elias Augusto de Oliveira', 00000000000, 'elias@elias.com', '202cb962ac59075b964b07152d234b70', '0', '0000-00-00', 'null.jpg', '1', '0', NULL, '2012-06-05 17:32:39', '', '0'),
(18, NULL, 'teste', 00000000001, 'teste@teste.com', '698dc19d489c4e4db73e28a713eab07b', '1', '1982-11-21', 'null.jpg', '0', '0', NULL, '2013-01-15 18:53:40', '', '1'),
(27, '100001551508566', 'Juscelino Iene', NULL, 'ju.impossivel@gmail.com', NULL, '1', '1982-11-21', NULL, '1', '1', NULL, '2013-01-25 12:04:36', '{"id":"100001551508566","name":"Juscelino Iene","first_name":"Juscelino","last_name":"Iene","link":"http:\\/\\/www.facebook.com\\/juscelino.iene","username":"juscelino.iene","birthday":"11\\/21\\/1982","hometown":{"id":"107664652596260","name":"Apucarana"},"location":{"id":"106339232734991","name":"Florian\\u00f3polis, Santa Catarina"},"sports":[{"id":"160899230620548","name":"Levantamento de copo","description":"Movimento repetitivo prolongado."}],"favorite_teams":[{"id":"204073162943401","name":"Clube de Regatas do Flamengo"}],"gender":"male","email":"ju.impossivel@gmail.com","timezone":-2,"locale":"pt_BR","languages":[{"id":"108083115891989","name":"Portugu\\u00eas"},{"id":"450169151702580","name":"Portuguese"}],"verified":true,"updated_time":"2013-01-25T03:20:05+0000"}', '0'),
(28, '100004671760264', 'Juscelino NetChefs', NULL, 'juscelino@netchefs.com.br', NULL, '1', '1982-11-21', NULL, '1', '1', NULL, '2013-02-02 20:27:20', '{"id":"100004671760264","name":"Juscelino NetChefs","first_name":"Juscelino","last_name":"NetChefs","link":"http:\\/\\/www.facebook.com\\/juscelino.netchefs","username":"juscelino.netchefs","birthday":"11\\/21\\/1982","hometown":{"id":"106339232734991","name":"Florian\\u00f3polis, Santa Catarina"},"location":{"id":"106339232734991","name":"Florian\\u00f3polis, Santa Catarina"},"work":[{"employer":{"id":"417145488333485","name":"NetChefs (Delivery Online)"},"location":{"id":"106339232734991","name":"Florian\\u00f3polis, Santa Catarina"},"position":{"id":"103148596409273","name":"Socio"},"description":"Delivery Online - NetChefs \\u00e9 uma pra\\u00e7a de alimenta\\u00e7\\u00e3o virtual.\\nMaior comodidade e vantagens para o consumidor fazer seu pedido delivery","start_date":"0000-00"}],"education":[{"school":{"id":"177300002318530","name":"Senai Santa Catarina"},"type":"College"}],"gender":"male","email":"juscelino@netchefs.com.br","timezone":-2,"locale":"pt_BR","verified":true,"updated_time":"2013-01-14T22:00:37+0000"}', '0');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `conversao`
--
ALTER TABLE `conversao`
  ADD CONSTRAINT `conversao_ibfk_1` FOREIGN KEY (`id_cortesia`) REFERENCES `cortesias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversao_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversao_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `cortesias`
--
ALTER TABLE `cortesias`
  ADD CONSTRAINT `cortesias_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_3` FOREIGN KEY (`id_parceiro`) REFERENCES `parceiros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `eventos_ibfk_4` FOREIGN KEY (`id_endereco`) REFERENCES `local_enderecos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `eventos_fotos`
--
ALTER TABLE `eventos_fotos`
  ADD CONSTRAINT `eventos_fotos_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `local_cidades`
--
ALTER TABLE `local_cidades`
  ADD CONSTRAINT `local_cidades_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `local_estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `local_enderecos`
--
ALTER TABLE `local_enderecos`
  ADD CONSTRAINT `local_enderecos_ibfk_2` FOREIGN KEY (`id_cidade`) REFERENCES `local_cidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `local_estados`
--
ALTER TABLE `local_estados`
  ADD CONSTRAINT `local_estados_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `local_pais` (`id`);

--
-- Restrições para a tabela `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`id_cidade`) REFERENCES `local_cidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `parceiros`
--
ALTER TABLE `parceiros`
  ADD CONSTRAINT `parceiros_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `parceiros_ibfk_3` FOREIGN KEY (`id_endereco`) REFERENCES `local_enderecos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `parceiros_fotos`
--
ALTER TABLE `parceiros_fotos`
  ADD CONSTRAINT `parceiros_fotos_ibfk_2` FOREIGN KEY (`id_parceiro`) REFERENCES `parceiros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `rel_atividade_parceiro`
--
ALTER TABLE `rel_atividade_parceiro`
  ADD CONSTRAINT `rel_atividade_parceiro_ibfk_3` FOREIGN KEY (`id_parceiro`) REFERENCES `parceiros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rel_atividade_parceiro_ibfk_4` FOREIGN KEY (`id_atividade`) REFERENCES `atividades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `rel_genero_evento`
--
ALTER TABLE `rel_genero_evento`
  ADD CONSTRAINT `rel_genero_evento_ibfk_3` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rel_genero_evento_ibfk_4` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `rel_local_parceiro`
--
ALTER TABLE `rel_local_parceiro`
  ADD CONSTRAINT `rel_local_parceiro_ibfk_2` FOREIGN KEY (`id_parceiro`) REFERENCES `parceiros` (`id`),
  ADD CONSTRAINT `rel_local_parceiro_ibfk_3` FOREIGN KEY (`id_local`) REFERENCES `local_enderecos` (`id`);

--
-- Restrições para a tabela `rel_local_usuario`
--
ALTER TABLE `rel_local_usuario`
  ADD CONSTRAINT `rel_local_usuario_ibfk_1` FOREIGN KEY (`id_local`) REFERENCES `local_enderecos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rel_local_usuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Restrições para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_endereco`) REFERENCES `local_enderecos` (`id`);
SET FOREIGN_KEY_CHECKS=1;
