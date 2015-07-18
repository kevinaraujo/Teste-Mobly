/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : moblyteste

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2015-07-18 14:54:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for caracteristicas
-- ----------------------------
DROP TABLE IF EXISTS `caracteristicas`;
CREATE TABLE `caracteristicas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of caracteristicas
-- ----------------------------
INSERT INTO `caracteristicas` VALUES ('1', 'Câmera 8MP');
INSERT INTO `caracteristicas` VALUES ('2', 'Camêra 4MP');
INSERT INTO `caracteristicas` VALUES ('3', 'Branco');
INSERT INTO `caracteristicas` VALUES ('4', 'Preto');
INSERT INTO `caracteristicas` VALUES ('5', 'Dual Chip');
INSERT INTO `caracteristicas` VALUES ('6', 'Tela HD');

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES ('1', 'Smartphones');
INSERT INTO `categorias` VALUES ('2', 'Celular');

-- ----------------------------
-- Table structure for formaspagamento
-- ----------------------------
DROP TABLE IF EXISTS `formaspagamento`;
CREATE TABLE `formaspagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of formaspagamento
-- ----------------------------
INSERT INTO `formaspagamento` VALUES ('1', 'Boleto Bancário');
INSERT INTO `formaspagamento` VALUES ('2', 'Cartão Crédito');
INSERT INTO `formaspagamento` VALUES ('3', 'Cartão Débito');

-- ----------------------------
-- Table structure for pedidos
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `criadoem` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idforma` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES ('14', '5', '220590', '848', '2015-07-18 14:50:09', '2');

-- ----------------------------
-- Table structure for pedidoscarrinho
-- ----------------------------
DROP TABLE IF EXISTS `pedidoscarrinho`;
CREATE TABLE `pedidoscarrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpedido` int(11) DEFAULT NULL,
  `idproduto` int(11) DEFAULT NULL,
  `precovenda` float DEFAULT NULL,
  `sessao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pedidoscarrinho
-- ----------------------------
INSERT INTO `pedidoscarrinho` VALUES ('17', '14', '1', '749', null);
INSERT INTO `pedidoscarrinho` VALUES ('18', '14', '9', '99', null);

-- ----------------------------
-- Table structure for produtos
-- ----------------------------
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` text,
  `precovenda` float DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `idsubcategoria` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of produtos
-- ----------------------------
INSERT INTO `produtos` VALUES ('1', '120500202', 'Smartphone Motorola Novo Moto G DTV Colors Dual Chip XT 1069 Desbloqueado Android 4.4 Tela 5\" 16GB 3G Wi-Fi Câmera de 8MP - Preto', 'A Motorola inova mais uma vez em tecnologia trazendo a evolução do incrível Moto G em um aparelho com tecnologia inteligente que confirma seu sucesso no mercado. Com a nova Tela HD Brilhante de 5 polegadas e resolução de 16 milhões de cores, o Motorola Moto G DTV Colors garante excelente visualização das fotos e vídeos capturados pela Câmera Traseira de 8MP com flash em LED. Você pode ainda realizar videochamadas com a Câmera Frontal que agora conta com definição de 2MP.', '749', 'prod_1.png', '1', '2', '1');
INSERT INTO `produtos` VALUES ('2', '120980138', 'Smartphone LG L Prime D337 Dual Chip Android 4.4 Kit Kat Tela 5\" 8GB 3G Wi-Fi Câmera 8MP - Dourado', 'Este smartphone possui um belo design, é prático e possui todos os recursos e funcionalidades que você precisa. Com o Smartphone LG L Prime Dual Chip você pode desfrutar dos benefícios, planos e promoções de diferentes operadoras com apenas um celular, matando a saudade dos amigos, familiares e de quem está longe e destinar uma linha apenas para trabalho e outra para uso pessoal.', '499', 'prod_2.png', '1', '2', '1');
INSERT INTO `produtos` VALUES ('3', '122056811', 'Smartphone Samsung Galaxy E5 Duos Dual Chip Desbloqueado Android 4.4 Tela Amoled HD 5\" 16GB 4G Wi-Fi Câmera 8MP - Preto', 'O Samsung Galaxy E5 é um smartphone Android versão 4.4 com características tecnológicas que farão toda a diferença na hora de escolher o seu smartphone. O Galaxy E5 está com certeza entre uma das melhores apostas da Samsung com sua incrível tela Amoled HD de 5 polegadas e design fino com espessura de apenas 7.3 milímetros torna o Samsung Galaxy E5 um dos telefones mais finos que existem. \r\n', '869', 'prod_3.png', '1', '2', '1');
INSERT INTO `produtos` VALUES ('4', '120287018', 'O Samsung Galaxy E5 é um smartphone Android versão 4.4 com características tecnológicas que farão toda a diferença na hora de escolher o seu smartphone. O Galaxy E5 está com certeza entre uma das melhores apostas da Samsung com sua incrível tela Amoled HD', 'O Nokia Lumia 530 é Dual Chip e conta com muitos aplicativos pré-instalados e mais milhares de outros disponíveis para download na Loja do Windows Phone. Imediatamente você pode testar o novo teclado Word Flow com aplicativos de chat. Graças a memória expansível para até 128 GB você armazena aplicativos, fotos, músicas e muito mais.', '278.1', 'prod_4.png', '1', '2', '1');
INSERT INTO `produtos` VALUES ('5', '122045477', 'Smartphone Nokia Lumia 730 Dual Chip Desbloqueado Windows Phone 8.1 Tela 4.7\" 8GB 3G Wi-Fi Câmera 6.7MP - Laranja', 'O Smartphone Microsoft Lumia 730 Dual proporciona uma experiência completa para você! \r\n\r\nAproveite todas as funções do Smartphone Lumia 730 com sistema operacional Windows Phone 8.1 e processador Quad Core 1.2 ghz. Sua câmera traseira de 6.7MP e frontal de 5MP registram os seus momentos com resolução Full HD. Com esse Smartphone você vai navegar na internet via conexão Wi-Fi e 3G e armazenar seus arquivos na memória interna de até 8GB.', '665.1', 'prod_5.png', '1', '2', '1');
INSERT INTO `produtos` VALUES ('6', '120998670', 'iPhone 6 16GB Dourado iOS 8 4G Wi-Fi Câmera 8MP - Apple', 'O iPhone 6 não é só maior, ele é melhor em todos os sentidos. É maior, muito mais fino, mais poderoso, e consome muito menos energia. A superfície de metal lisa se integra perfeitamente à nossa tela Multi-Touch mais avançada. É uma nova geração de iPhone melhor em tudo.', '3499', 'prod_6.png', '1', '1', '1');
INSERT INTO `produtos` VALUES ('7', '120706462', 'iPhone 5C 8GB Branco Desbloqueado iOS 8 4G Wi-Fi Câmera 8MP - Apple', 'Um aparelho que fala com as cores, possui um incrível Chip A6, com câmera iSight de 8MP, otimizada tela retina de 4 polegadas, sistema operacional iOS 8 e muito mais. \r\nAssim é o iPhone 5c. Criado sob medida para os consumidores mais exigentes e sempre antenados em tecnologia e dispositivos móveis modernos e de alto desempenho.', '1499', 'prod_7.png', '1', '1', '1');
INSERT INTO `produtos` VALUES ('8', '117163321', 'Celular Asha 501 Dual Chip Desbloqueado Tim Preto Wi Fi Memória Interna 50MB Cartão de Memória 4GB', 'Aproveite os melhores conteúdos e divirta-se com os aplicativos que você pode instalar no seu moderno celular Nokia Asha. Esse celular foi especialmente desenvolvido para deixar a sua vida muito mais fácil e conectada as principais redes sociais. O incrível Asha 501 combina com seu estilo, pois reúne o que há de melhor em tecnologia para deixar o seu dia muito mais completo, organizado e completamente divertido. Leve, ele possui uma tela touch de 3 polegadas e vem com uma memória interna de 50MB, podendo ser estendida com um cartão Micro SD de até 32GB. \r\nRegistre seus momentos com excelente qualidade de imagem com a câmera de 3.2 Megapixels. Com ela você vai tirar belíssimas fotos e grava vídeos, ou ainda postar o registro em suas redes sociais e se divertir com os comentários e elogios de amigos e familiares. \r\ngg', '249', 'prod_8.png', '2', '3', '1');
INSERT INTO `produtos` VALUES ('9', '120200189', 'Celular Dual Chip Freecel Free Cross Desbloqueado Branco Câmera VGA 2G Memória Interna 32MB', 'Sinônimo de estilo e qualidade, a linha de telefones Celular Dual Chip Free Cross Freecel chegou para ficar. Facilita nas chamadas e envio de mensagens, além de ter câmera VGA, tecnologia Bluetooth, Reprodutor de MP3/MP4/Rádio FM, lanterna, conexão à internet via WAP e entrada para cartão Micro SD, tudo isso para você desfrutar das diversas opções de seu aparelho Free Cross.', '99', 'prod_9.png', '2', '3', '1');
INSERT INTO `produtos` VALUES ('10', '111509791', 'Celular LG T375 Desbloqueado Tim Branco Dual Chip Câmera de 2.0MP Wi Fi Memória Interna 50MB e Cartão 2GB', 'Um celular moderno para pessoas que gostam de interagir com o mundo!\r\nO LG T375 funciona com 2 Sim Cards ao mesmo tempo. Com ele você pode estar conectado com seus amigos e com o trabalho em um único aparelho. \r\n\r\nInternet\r\nCom o T375 da LG, você tem internet e Wi-Fi e pode ficar conectado sempre que quiser e acompanhar as novidades dos seus amigos e ficar ligado no que anda acontecendo.', '249', 'prod_10.png', '2', '3', '1');

-- ----------------------------
-- Table structure for produtos_caracteristicas
-- ----------------------------
DROP TABLE IF EXISTS `produtos_caracteristicas`;
CREATE TABLE `produtos_caracteristicas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproduto` int(11) DEFAULT NULL,
  `idcaracteristica` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of produtos_caracteristicas
-- ----------------------------
INSERT INTO `produtos_caracteristicas` VALUES ('1', '1', '1');
INSERT INTO `produtos_caracteristicas` VALUES ('2', '1', '4');
INSERT INTO `produtos_caracteristicas` VALUES ('3', '2', '1');
INSERT INTO `produtos_caracteristicas` VALUES ('4', '2', '5');
INSERT INTO `produtos_caracteristicas` VALUES ('5', '3', '1');
INSERT INTO `produtos_caracteristicas` VALUES ('6', '3', '4');
INSERT INTO `produtos_caracteristicas` VALUES ('7', '5', '5');
INSERT INTO `produtos_caracteristicas` VALUES ('8', '6', '1');
INSERT INTO `produtos_caracteristicas` VALUES ('9', '7', '1');
INSERT INTO `produtos_caracteristicas` VALUES ('10', '7', '3');
INSERT INTO `produtos_caracteristicas` VALUES ('11', '8', '4');
INSERT INTO `produtos_caracteristicas` VALUES ('12', '8', '5');
INSERT INTO `produtos_caracteristicas` VALUES ('13', '9', '3');
INSERT INTO `produtos_caracteristicas` VALUES ('14', '10', '3');
INSERT INTO `produtos_caracteristicas` VALUES ('15', '10', '5');
INSERT INTO `produtos_caracteristicas` VALUES ('16', '1', '5');
INSERT INTO `produtos_caracteristicas` VALUES ('17', '4', '6');

-- ----------------------------
-- Table structure for subcategorias
-- ----------------------------
DROP TABLE IF EXISTS `subcategorias`;
CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of subcategorias
-- ----------------------------
INSERT INTO `subcategorias` VALUES ('1', 'ios', '1');
INSERT INTO `subcategorias` VALUES ('2', 'android', '1');
INSERT INTO `subcategorias` VALUES ('3', 'outros', '2');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('5', 'Mobly', 'user@mobly.com.br', '123', '05307-000', 'Rua Major Paladino', '128', 'Galpão 12', 'Centro', 'São Paulo', 'SP');
