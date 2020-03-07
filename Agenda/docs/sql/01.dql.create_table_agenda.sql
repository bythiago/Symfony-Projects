-- contato
CREATE TABLE `contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sexo` char(1) NOT NULL,
  `dt_nascimento` date NOT NULL,
  `apelido` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

-- telefone
CREATE TABLE `telefone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(9) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_contato` int(11) NOT NULL,
  `ddd` varchar(2) NOT NULL DEFAULT '24',
  PRIMARY KEY (`id`)
)

-- telefone_tipo
CREATE TABLE `telefone_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

--insert
INSERT INTO agenda_2019.telefone_tipo (id, tipo) VALUES(1, 'Celular');
INSERT INTO agenda_2019.telefone_tipo (id, tipo) VALUES(2, 'Casa');
INSERT INTO agenda_2019.telefone_tipo (id, tipo) VALUES(3, 'Trabalho');