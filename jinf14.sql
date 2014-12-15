-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.5.14 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.1.0.4882
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for jinf14
DROP DATABASE IF EXISTS `jinf14`;
CREATE DATABASE IF NOT EXISTS `jinf14` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `jinf14`;


-- Dumping structure for table jinf14.areas
DROP TABLE IF EXISTS `areas`;
CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `appear` tinyint(1) DEFAULT NULL,
  `controller` varchar(25) NOT NULL,
  `controller_label` varchar(50) DEFAULT NULL,
  `action` varchar(25) NOT NULL,
  `action_label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `appear` (`appear`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- Dumping data for table jinf14.areas: ~35 rows (approximately)
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
REPLACE INTO `areas` (`id`, `parent_id`, `appear`, `controller`, `controller_label`, `action`, `action_label`) VALUES
	(1, NULL, 1, 'Users', 'Usu&aacute;rios', 'index', 'Todos'),
	(2, NULL, 0, 'Users', 'Usu&aacute;rios', 'add', 'Criar Novo'),
	(3, NULL, 0, 'Users', 'Usu&aacute;rios', 'edit', 'Editar'),
	(4, NULL, 0, 'Users', 'Usu&aacute;rios', 'delete', 'Excluir'),
	(5, 1, 1, 'Profiles', 'Perf&iacute;s de Usu&aacute;rio', 'index', 'Todos'),
	(6, NULL, 0, 'Profiles', 'Perf&iacute;s de Usu&aacute;rio', 'add', 'Criar Novo'),
	(7, NULL, 0, 'Profiles', 'Perf&iacute;s de Usu&aacute;rio', 'edit', 'Editar'),
	(8, NULL, 0, 'Profiles', 'Perf&iacute;s de Usu&aacute;rio', 'delete', 'Excluir'),
	(9, NULL, 0, 'Profiles', 'Perf&iacute;s de Usu&aacute;rio', 'view', 'Visualizar'),
	(10, NULL, 0, 'Users', 'Usu&aacute;rios', 'view', 'Visualizar'),
	(14, 1, 1, 'Areas', 'Ãreas', 'index', 'Lista'),
	(15, NULL, 0, 'Areas', 'Ãreas', 'add', 'Adicionar'),
	(16, NULL, 0, 'Areas', 'Ãreas', 'edit', 'Editar'),
	(17, NULL, 0, 'Areas', 'Ãreas', 'delete', 'Deletar'),
	(18, NULL, 0, 'Areas', 'Ãreas', 'view', 'Visualizar'),
	(19, NULL, 1, 'Edicoes', 'Edições', 'index', 'Listar'),
	(20, NULL, 0, 'Edicoes', 'Edições', 'add', 'Adicionar'),
	(21, NULL, 0, 'Edicoes', 'Edições', 'edit', 'Editar'),
	(22, NULL, 0, 'Edicoes', 'Edições', 'delete', 'Deletar'),
	(23, NULL, 0, 'Edicoes', 'Edições', 'view', 'Visualizar'),
	(24, NULL, 1, 'Atividades', 'Atividades', 'index', 'Listar'),
	(25, NULL, 0, 'Atividades', 'Atividades', 'add', 'Adicionar'),
	(26, NULL, 0, 'Atividades', 'Atividades', 'edit', 'Editar'),
	(27, NULL, 0, 'Atividades', 'Atividades', 'delete', 'Deletar'),
	(28, NULL, 0, 'Atividades', 'Atividades', 'view', 'Visualizar'),
	(29, NULL, 1, 'Agenda', 'Programação', 'index', 'Listar'),
	(30, NULL, 0, 'Agenda', 'Programação', 'add', 'Adicionar'),
	(31, NULL, 0, 'Agenda', 'Programação', 'edit', 'Editar'),
	(32, NULL, 0, 'Agenda', 'Programação', 'delete', 'Deletar'),
	(33, NULL, 0, 'Agenda', 'Programação', 'view', 'Visualizar'),
	(34, NULL, 0, 'Palestrantes', 'Palestrantes', 'index', 'Listar'),
	(35, NULL, 0, 'Palestrantes', 'Palestrantes', 'add', 'Adicionar'),
	(36, NULL, 0, 'Palestrantes', 'Palestrantes', 'edit', 'Editar'),
	(37, NULL, 0, 'Palestrantes', 'Palestrantes', 'delete', 'Deletar'),
	(38, NULL, 0, 'Palestrantes', 'Palestrantes', 'view', 'Visualizar');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;


-- Dumping structure for table jinf14.areas_profiles
DROP TABLE IF EXISTS `areas_profiles`;
CREATE TABLE IF NOT EXISTS `areas_profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` int(11) unsigned NOT NULL,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_areas_profiles_areas1` (`area_id`),
  KEY `fk_areas_profiles_profiles1` (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=utf8;

-- Dumping data for table jinf14.areas_profiles: ~45 rows (approximately)
/*!40000 ALTER TABLE `areas_profiles` DISABLE KEYS */;
REPLACE INTO `areas_profiles` (`id`, `area_id`, `profile_id`) VALUES
	(25, 1, 2),
	(26, 2, 2),
	(27, 3, 2),
	(28, 4, 2),
	(29, 10, 2),
	(94, 19, 3),
	(95, 20, 3),
	(96, 21, 3),
	(97, 22, 3),
	(98, 23, 3),
	(189, 1, 1),
	(190, 2, 1),
	(191, 3, 1),
	(192, 4, 1),
	(193, 10, 1),
	(194, 5, 1),
	(195, 6, 1),
	(196, 7, 1),
	(197, 8, 1),
	(198, 9, 1),
	(199, 14, 1),
	(200, 15, 1),
	(201, 16, 1),
	(202, 17, 1),
	(203, 18, 1),
	(204, 19, 1),
	(205, 20, 1),
	(206, 21, 1),
	(207, 22, 1),
	(208, 23, 1),
	(209, 24, 1),
	(210, 25, 1),
	(211, 26, 1),
	(212, 27, 1),
	(213, 28, 1),
	(214, 29, 1),
	(215, 30, 1),
	(216, 31, 1),
	(217, 32, 1),
	(218, 33, 1),
	(219, 34, 1),
	(220, 35, 1),
	(221, 36, 1),
	(222, 37, 1),
	(223, 38, 1);
/*!40000 ALTER TABLE `areas_profiles` ENABLE KEYS */;


-- Dumping structure for table jinf14.atividade
DROP TABLE IF EXISTS `atividade`;
CREATE TABLE IF NOT EXISTS `atividade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_atividade` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `descricao` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `duracao` int(11) NOT NULL,
  `vagas` int(11) DEFAULT NULL,
  `tipo_atividade_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fk_atividade_tipo_atividade1` (`tipo_atividade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table jinf14.atividade: ~1 rows (approximately)
/*!40000 ALTER TABLE `atividade` DISABLE KEYS */;
REPLACE INTO `atividade` (`id`, `nome_atividade`, `descricao`, `duracao`, `vagas`, `tipo_atividade_id`) VALUES
	(1, 'Oficina de Android', 'Descrição Livre', 8, 10, 1);
/*!40000 ALTER TABLE `atividade` ENABLE KEYS */;


-- Dumping structure for table jinf14.colaboradores
DROP TABLE IF EXISTS `colaboradores`;
CREATE TABLE IF NOT EXISTS `colaboradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `funcao` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `programacao_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_colaboradores_users1` (`user_id`),
  KEY `fk_colaboradores_programacao1` (`programacao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table jinf14.colaboradores: ~3 rows (approximately)
/*!40000 ALTER TABLE `colaboradores` DISABLE KEYS */;
REPLACE INTO `colaboradores` (`id`, `funcao`, `user_id`, `programacao_id`) VALUES
	(1, 'Monitoria', 1, 1),
	(2, 'Confere', 2, 1),
	(3, 'Arruma', 1, 2);
/*!40000 ALTER TABLE `colaboradores` ENABLE KEYS */;


-- Dumping structure for table jinf14.cursos
DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `modalidade` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table jinf14.cursos: ~4 rows (approximately)
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
REPLACE INTO `cursos` (`id`, `name`, `modalidade`) VALUES
	(1, 'Técnico em Informática', 'Ensino Técnico'),
	(2, 'Sistemas de Informação', 'Ensino Superior'),
	(3, 'Técnico em Eletrotécnica', 'Ensino Técnico'),
	(4, 'Engenharia Civil', 'Ensino Superior');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;


-- Dumping structure for table jinf14.departamentos
DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table jinf14.departamentos: ~3 rows (approximately)
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
REPLACE INTO `departamentos` (`id`, `name`, `created`, `modified`) VALUES
	(1, 'Departamento Acadêmico de Informática', '2014-12-06 00:00:00', '2014-12-06 00:00:00'),
	(2, 'Departamento Acadêmico de Engenharia Civil', '2014-12-06 00:00:00', '2014-12-06 23:30:51'),
	(3, 'Departamento Acadêmico de Eletroeletrônica', '2014-12-06 00:00:00', '2014-12-06 00:00:00');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;


-- Dumping structure for table jinf14.edicao
DROP TABLE IF EXISTS `edicao`;
CREATE TABLE IF NOT EXISTS `edicao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_ini` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `local` varchar(255) DEFAULT NULL,
  `ano` year(4) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table jinf14.edicao: ~2 rows (approximately)
/*!40000 ALTER TABLE `edicao` DISABLE KEYS */;
REPLACE INTO `edicao` (`id`, `data_ini`, `data_fim`, `local`, `ano`, `created`, `modified`, `nome`) VALUES
	(1, '2014-12-01', '2014-12-16', 'Instituto Federal do Maranhão', '0000', '2014-12-08 00:00:00', '2014-12-08 00:00:00', 'Edição Nova'),
	(2, '2014-12-08', '2014-12-17', 'Instituto Federal do Maranhão Centro Histórico', '0000', '2014-12-08 00:00:00', '2014-12-08 00:00:00', 'Edição Mais Nova');
/*!40000 ALTER TABLE `edicao` ENABLE KEYS */;


-- Dumping structure for table jinf14.inscricao
DROP TABLE IF EXISTS `inscricao`;
CREATE TABLE IF NOT EXISTS `inscricao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `programacao_id` int(11) NOT NULL,
  `presenca` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inscricao_users1` (`user_id`),
  KEY `fk_inscricao_programacao1` (`programacao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table jinf14.inscricao: ~2 rows (approximately)
/*!40000 ALTER TABLE `inscricao` DISABLE KEYS */;
REPLACE INTO `inscricao` (`id`, `user_id`, `programacao_id`, `presenca`) VALUES
	(1, 1, 1, 1),
	(2, 2, 1, 0);
/*!40000 ALTER TABLE `inscricao` ENABLE KEYS */;


-- Dumping structure for table jinf14.profiles
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table jinf14.profiles: ~3 rows (approximately)
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
REPLACE INTO `profiles` (`id`, `name`, `created`, `modified`) VALUES
	(1, 'Admin', '0000-00-00 00:00:00', '2014-12-06 11:29:22'),
	(2, 'Perfil Teste', '2012-03-25 00:21:45', '2012-04-02 17:09:38'),
	(3, 'Professor', '2013-12-15 02:08:35', '2013-12-15 02:08:35');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;


-- Dumping structure for table jinf14.programacao
DROP TABLE IF EXISTS `programacao`;
CREATE TABLE IF NOT EXISTS `programacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `horario_ini` time DEFAULT NULL,
  `horario_fim` time NOT NULL,
  `sala_id` int(11) NOT NULL,
  `atividade_id` int(11) NOT NULL,
  `edicao_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indice2` (`data`,`horario_ini`,`horario_fim`),
  KEY `fk_programacao_salas1` (`sala_id`),
  KEY `fk_programacao_atividade1` (`atividade_id`),
  KEY `fk_programacao_edicao1` (`edicao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table jinf14.programacao: ~2 rows (approximately)
/*!40000 ALTER TABLE `programacao` DISABLE KEYS */;
REPLACE INTO `programacao` (`id`, `data`, `horario_ini`, `horario_fim`, `sala_id`, `atividade_id`, `edicao_id`) VALUES
	(1, '2014-12-03', NULL, '00:00:00', 1, 1, 1),
	(2, '2014-12-22', '00:00:00', '00:00:00', 2, 1, 2);
/*!40000 ALTER TABLE `programacao` ENABLE KEYS */;


-- Dumping structure for table jinf14.salas
DROP TABLE IF EXISTS `salas`;
CREATE TABLE IF NOT EXISTS `salas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `localidade` varchar(50) DEFAULT NULL,
  `vagas` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `departamento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_salas_departamentos1` (`departamento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table jinf14.salas: ~3 rows (approximately)
/*!40000 ALTER TABLE `salas` DISABLE KEYS */;
REPLACE INTO `salas` (`id`, `descricao`, `localidade`, `vagas`, `created`, `modified`, `departamento_id`) VALUES
	(2, 'Laboratório 22', 'Pavimento Inferior', 0, '2014-12-07 11:59:10', '2014-12-07 18:00:33', 3),
	(3, 'Laboratório de Máquinas Elétricas', 'Pavimento DEE', 0, '2014-12-08 15:29:20', '2014-12-08 15:29:20', 3),
	(4, 'Laboratório 26', 'Pavimento Superior', 0, '2014-12-08 15:30:00', '2014-12-08 15:30:00', 1);
/*!40000 ALTER TABLE `salas` ENABLE KEYS */;


-- Dumping structure for table jinf14.tipo_atividade
DROP TABLE IF EXISTS `tipo_atividade`;
CREATE TABLE IF NOT EXISTS `tipo_atividade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table jinf14.tipo_atividade: ~1 rows (approximately)
/*!40000 ALTER TABLE `tipo_atividade` DISABLE KEYS */;
REPLACE INTO `tipo_atividade` (`id`, `nome`) VALUES
	(1, 'Mini Curso');
/*!40000 ALTER TABLE `tipo_atividade` ENABLE KEYS */;


-- Dumping structure for table jinf14.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(32) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `pass_switched` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `curso_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_curso1` (`curso_id`),
  KEY `fk_users_profiles1` (`profile_id`),
  CONSTRAINT `fk_users_curso1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_profiles1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table jinf14.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `password`, `name`, `email`, `last_login`, `pass_switched`, `created`, `modified`, `telefone`, `curso_id`, `profile_id`) VALUES
	(1, 'a78f76a37a7f699f39b324ba58b2aad5', 'Administrador', 'admin', '2014-12-15 20:09:24', 1, '2014-12-06 00:00:00', '2014-12-15 20:09:24', '12121212', 1, 1),
	(2, '123456', 'paciente zero', 'paciente@domain', '2014-12-08 00:00:00', 1, '2014-12-08 00:00:00', '2014-12-08 00:00:00', '1212112122', 2, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
