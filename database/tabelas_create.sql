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
	Não foram utilizadas foreign keys e id BIGINT, pois seguimos o padrão de inserção e criação da tabela 
	fornecida pelo github anterior, para não gerar conflitos com os dados de inserção.
*/

CREATE TABLE Estados (
	id INT(11) NOT NULL PRIMARY KEY,
	nome VARCHAR(75) DEFAULT NULL,
	uf VARCHAR(2) DEFAULT NULL,
	ibge INT(2) DEFAULT NULL,
	criado_em TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	atualizado_em TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE Cidades (
	id INT(11) NOT NULL PRIMARY KEY,
	nome VARCHAR(120) DEFAULT NULL,
	uf INT(2) DEFAULT NULL,
	ibge INT(7) DEFAULT NULL,
	criado_em TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	atualizado_em TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;