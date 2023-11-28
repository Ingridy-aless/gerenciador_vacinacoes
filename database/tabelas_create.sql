CREATE TABLE Clientes (
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(70) NOT NULL,
	cpf VARCHAR(14) UNIQUE NOT NULL,
	telefone VARCHAR(10) NOT NULL, 
	rua VARCHAR(100) NOT NULL, 
	numero INT NOT NULL, 
	cidade INT(11) NOT NULL, 
	estado INT(11) NOT NULL, 
	cep VARCHAR(9) NOT NULL,
	criado_em TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	atualizado_em TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP 			
);

CREATE TABLE Animais (
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100) NOT NULL,
	especie VARCHAR(50) NOT NULL,
	idade INT NOT NULL, 
	raca VARCHAR(50) NOT NULL,
	sexo VARCHAR(30) NOT NULL,
	cliente BIGINT NOT NULL,
	criado_em TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	atualizado_em TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP, 
	FOREIGN KEY(cliente) REFERENCES Clientes(id)
);

CREATE TABLE Vacinas (
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100) NOT NULL,
	laboratorio VARCHAR(100) NOT NULL,
	lote INT NOT NULL,
	validade DATE NOT NULL,
	criado_em TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	atualizado_em TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP 
);

CREATE TABLE Vacinacao (
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	data_aplicacao DATE NOT NULL,
	animal BIGINT NOT NULL,
	vacina BIGINT NOT NULL,
	criado_em TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	atualizado_em TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY(animal) REFERENCES Animais(id),
	FOREIGN KEY(vacina) REFERENCES Vacinas(id) 
);

/* 
	As tabelas estados e cidades foram criadas e adaptadas conforme: 
	https://github.com/chinnonsantos/sql-paises-estados-cidades/tree/master/MySQL
*/

CREATE TABLE Estados (
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(75) NOT NULL,
	uf VARCHAR(2) NOT NULL,
	ibge INT(2) NOT NULL,
	criado_em TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	atualizado_em TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE Cidades (
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(120) NOT NULL,
	estado BIGINT NOT NULL,
	ibge INT(7) NOT NULL,
	criado_em TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	atualizado_em TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY(estado) REFERENCES Estados(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;