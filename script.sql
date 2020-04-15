CREATE TABLE equipes
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idorientador INT NULL,
    apelido VARCHAR(55) NOT NULL UNIQUE,
    dataCriacao DATE NOT NULL
) ENGINE = InnoDB;

CREATE TABLE usuarios
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idequipe INT NOT NULL,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipoUsuario INT NOT NULL,
    CONSTRAINT FK_USUARIO_EQUIPE FOREIGN KEY (idequipe) REFERENCES equipes(id)
) ENGINE = InnoDB;

CREATE TABLE documentos
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	idequipe INT NOT NULL,
    titulo VARCHAR(255) NULL,
    subtitulo VARCHAR(255) NULL,
    instituicao VARCHAR(255) NULL,
    curso VARCHAR(255) NULL,
    cidade VARCHAR(255) NULL,
	ano SMALLINT NULL,
    introducao_tema TEXT NULL,
    introducao_historico TEXT NULL,
    introducao_evolucao TEXT NULL,
    introducao_problema TEXT NULL,
    introducao_solucao TEXT NULL,
    objetivo_geral TEXT NULL,
    objetivo_esp1 TINYTEXT NULL,
    objetivo_esp2 TINYTEXT NULL,
    objetivo_esp3 TINYTEXT NULL,
    objetivo_esp4 TINYTEXT NULL,
    objetivo_esp5 TINYTEXT NULL,
    objetivo_esp6 TINYTEXT NULL,
    objetivo_esp7 TINYTEXT NULL,
    objetivo_esp8 TINYTEXT NULL,
    objetivo_esp9 TINYTEXT NULL,
    objetivo_esp10 TINYTEXT NULL,
	conc1 TEXT NULL,
	conc2 TEXT NULL,
	conc3 TEXT NULL,
	conc4 TEXT NULL,
	conc5 TEXT NULL,
	conc6 TEXT NULL,
	conc7 TEXT NULL,
	conc8 TEXT NULL,
	conc9 TEXT NULL,
	conc10 TEXT NULL,
	material1 TEXT NULL,
	material2 TEXT NULL,
	material3 TEXT NULL,
	material4 TEXT NULL,
	material5 TEXT NULL,
	material6 TEXT NULL,
	material7 TEXT NULL,
	material8 TEXT NULL,
	material9 TEXT NULL,
	material10 TEXT NULL,
    resumo_port TEXT NULL,
	palavra_chave1 VARCHAR(255) NULL,
	palavra_chave2 VARCHAR(255) NULL,
	palavra_chave3 VARCHAR(255) NULL,
	resumo_ing TEXT NULL,
	keyword1 VARCHAR(255) NULL,
	keyword2 VARCHAR(255) NULL,
	keyword3 VARCHAR(255) NULL,
    CONSTRAINT FK_DOCUMENTO_EQUIPE FOREIGN KEY (idequipe) REFERENCES equipes(id)
) ENGINE = InnoDB;

CREATE TABLE referencial_teorico
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    iddocumento INT NOT NULL,
	titulo VARCHAR(255) NULL,
    refCitacao VARCHAR(255) NULL,
    refCompleta TEXT NULL,
    citacaoOriginal TEXT NULL,
    citacaoIndireta TEXT NULL,
    tipoCitacao SMALLINT NULL,
    CONSTRAINT FK_REFERENCIAL_DOCUMENTO FOREIGN KEY (iddocumento) REFERENCES documentos(id)
) ENGINE = InnoDB;

INSERT INTO equipes SET id = 1, apelido = 'Nenhuma', dataCriacao = '2017-01-01';

CREATE TABLE itens_metodologia
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idDocumento INT NOT NULL,
    idObj_esp INT(2) NOT NULL,
	numItem INT(1) NOT NULL,
	nomeItem VARCHAR(255) NULL,
    texto TEXT NULL,
    imagem VARCHAR(255) NULL,
	titulo_imagem VARCHAR(255) NULL,
	fonte VARCHAR(255) NULL,
	resultado TEXT NULL,
    CONSTRAINT FK_METODOLOGIA_DOCUMENTO FOREIGN KEY(idDocumento) REFERENCES documentos(id)
) ENGINE = InnoDB;

CREATE TABLE metodologia
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NULL,
    texto TEXT NULL,
    img_texto VARCHAR(255),
    nome_img_texto VARCHAR(255),
    fonte_img_texto VARCHAR(255),
    resultado TEXT NULL,
    img_resultado VARCHAR(255),
    nome_img_resultado VARCHAR(255),
    fonte_img_resultado VARCHAR(255),
    idreference INT DEFAULT 0,
    iddocumento INT NOT NULL,
    CONSTRAINT FK_METODOLOGIAS_DOCUMENTO FOREIGN KEY (iddocumento) REFERENCES documentos(id)
) ENGINE = InnoDB;

INSERT INTO usuarios SET nome = 'orientador', email = 'teste', senha = '$2y$10$nQrGVX2k5H/BA/oLSuqb6ubSOw7fA5DJV7UMgk7wYEzX166m7nJ7e', tipousuario = 2, idequipe = 1