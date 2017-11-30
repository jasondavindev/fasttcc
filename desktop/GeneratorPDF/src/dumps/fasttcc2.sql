CREATE DATABASE  IF NOT EXISTS `fasttcc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fasttcc`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: fasttcc
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.25-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idequipe` int(11) NOT NULL,
  `titulo` varchar(40) DEFAULT NULL,
  `subtitulo` varchar(100) DEFAULT NULL,
  `instituicao` varchar(50) DEFAULT NULL,
  `curso` varchar(30) DEFAULT NULL,
  `cidade` varchar(40) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `introducao_tema` text,
  `introducao_historico` text,
  `introducao_evolucao` text,
  `introducao_problema` text,
  `introducao_solucao` text,
  `objetivo_geral` text,
  `objetivo_esp1` tinytext,
  `objetivo_esp2` tinytext,
  `objetivo_esp3` tinytext,
  `objetivo_esp4` tinytext,
  `objetivo_esp5` tinytext,
  `objetivo_esp6` tinytext,
  `objetivo_esp7` tinytext,
  `objetivo_esp8` tinytext,
  `objetivo_esp9` tinytext,
  `objetivo_esp10` tinytext,
  `conc1` text,
  `conc2` text,
  `conc3` text,
  `conc4` text,
  `conc5` text,
  `conc6` text,
  `conc7` text,
  `conc8` text,
  `conc9` text,
  `conc10` text,
  `material1` text,
  `material2` text,
  `material3` text,
  `material4` text,
  `material5` text,
  `material6` text,
  `material7` text,
  `material8` text,
  `material9` text,
  `material10` text,
  `resumo_port` text,
  `palavra_chave1` varchar(255) DEFAULT NULL,
  `palavra_chave2` varchar(255) DEFAULT NULL,
  `palavra_chave3` varchar(255) DEFAULT NULL,
  `resumo_ing` text,
  `keyword1` varchar(255) DEFAULT NULL,
  `keyword2` varchar(255) DEFAULT NULL,
  `keyword3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_DOCUMENTO_EQUIPE` (`idequipe`),
  CONSTRAINT `FK_DOCUMENTO_EQUIPE` FOREIGN KEY (`idequipe`) REFERENCES `equipes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` VALUES (1,2,'Teste Titulo','Teste lululululululul lulululululululul eoqeoqeoqeoqeoqeoqeoqeoqeoqeoqeoqeoqeoqeoqeoqeoqeoqeoq','ETEC LUL','Info LUL','SJC',2017,'TEMA Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','HIST&Oacute;RICO Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','EVOLU&Ccedil;&Atilde;O Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum','PROBLEMA Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','SOLU&Ccedil;&Atilde;O Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.erunt mollit anim id est laborum.','obj esp 1','obj esp 2','obj esp 3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'pendrive','teclado','mouse',NULL,'',NULL,NULL,NULL,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\',\'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','lorem','ipsum','lulululu port','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\',\'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','loris','ipsuns','lululul ingles');
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipes`
--

DROP TABLE IF EXISTS `equipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idorientador` int(11) DEFAULT NULL,
  `apelido` varchar(35) NOT NULL,
  `dataCriacao` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apelido` (`apelido`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipes`
--

LOCK TABLES `equipes` WRITE;
/*!40000 ALTER TABLE `equipes` DISABLE KEYS */;
INSERT INTO `equipes` VALUES (1,NULL,'Nenhuma','2017-01-01'),(2,1,'Codex','2017-08-31');
/*!40000 ALTER TABLE `equipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_metodologia`
--

DROP TABLE IF EXISTS `itens_metodologia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens_metodologia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idDocumento` int(11) NOT NULL,
  `idObj_esp` int(2) NOT NULL,
  `numItem` int(1) NOT NULL,
  `nomeItem` varchar(50) DEFAULT NULL,
  `texto` text,
  `imagem` varchar(100) DEFAULT NULL,
  `titulo_imagem` varchar(100) DEFAULT NULL,
  `fonte` varchar(255) DEFAULT NULL,
  `resultado` text,
  PRIMARY KEY (`id`),
  KEY `FK_METODOLOGIA_DOCUMENTO` (`idDocumento`),
  CONSTRAINT `FK_METODOLOGIA_DOCUMENTO` FOREIGN KEY (`idDocumento`) REFERENCES `documentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_metodologia`
--

LOCK TABLES `itens_metodologia` WRITE;
/*!40000 ALTER TABLE `itens_metodologia` DISABLE KEYS */;
INSERT INTO `itens_metodologia` VALUES (1,1,1,1,'eoq 1','lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','97035867759b40f2b168db388660611check.jpg','check','owner','lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),(2,1,1,2,'eoq 2','lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','48997486659b40f560da1c412834440worddoc.jpg','worddoc','owner','lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),(3,1,1,3,'eoq 3','lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','184455326659b40f784b63c640355831paperwrite.jpg','paperwrite','owner','lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),(4,1,2,1,'masoq 1',NULL,NULL,NULL,NULL,NULL),(5,1,2,2,'masoq 2',NULL,NULL,NULL,NULL,NULL),(6,1,2,3,'masoq 3',NULL,NULL,NULL,NULL,NULL),(7,1,3,1,'sehloiro 1',NULL,NULL,NULL,NULL,NULL),(8,1,3,2,'sehloiro 2',NULL,NULL,NULL,NULL,NULL),(9,1,3,3,'sehloiro 3',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `itens_metodologia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referencial_teorico`
--

DROP TABLE IF EXISTS `referencial_teorico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referencial_teorico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iddocumento` int(11) NOT NULL,
  `titulo` varchar(30) DEFAULT NULL,
  `refCitacao` varchar(100) DEFAULT NULL,
  `refCompleta` varchar(255) DEFAULT NULL,
  `citacaoOriginal` text,
  `citacaoIndireta` text,
  `tipoCitacao` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_REFERENCIAL_DOCUMENTO` (`iddocumento`),
  CONSTRAINT `FK_REFERENCIAL_DOCUMENTO` FOREIGN KEY (`iddocumento`) REFERENCES `documentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referencial_teorico`
--

LOCK TABLES `referencial_teorico` WRITE;
/*!40000 ALTER TABLE `referencial_teorico` DISABLE KEYS */;
INSERT INTO `referencial_teorico` VALUES (1,1,'referencial teorico 1','fonte citacao 1','Dispon&iacute;vel em: &lt;https:\\\\ www.referencia bibliografica 1.com&gt;','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',0),(2,1,'referencial teorico 2','fonte citacao 2','UNIVERSIDADE LUL. referencia bibliografica 2. LUL. 2017','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua.','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua.',1),(3,1,'referencial teorico 3','fonte citacao 3','LUL, SEHLOIRO. referecia bibliografica 3. EOQ. p 90, 91, 96, 175, 185','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua.','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua.',1),(4,1,'referencial teorico 4','fonte citacao 4','SOLADO MALUCO. In: FON. LUL. S&atilde;o Paulo, 2017. v.3, p. 807-813.','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',0);
/*!40000 ALTER TABLE `referencial_teorico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idequipe` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(25) NOT NULL,
  `tipoUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_USUARIO_EQUIPE` (`idequipe`),
  CONSTRAINT `FK_USUARIO_EQUIPE` FOREIGN KEY (`idequipe`) REFERENCES `equipes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,'fon','fon','fon',2),(2,2,'user1','user1','123',1),(3,2,'user2','user2','123',0),(4,2,'user3','user3','123',0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'fasttcc'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-17  0:04:22
