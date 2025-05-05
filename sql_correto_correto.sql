CREATE SCHEMA IF NOT EXISTS sistema DEFAULT CHARACTER SET utf8 ;
USE sistema;

CREATE TABLE atendente (
    id_atendente INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
	login varchar(45) NOT NULL,
	senha varchar(45) DEFAULT NULL,
	nome varchar(45) NOT NULL,
	tipo_acesso varchar(1) DEFAULT NULL,
	ativo varchar(1) DEFAULT NULL
);

insert into atendente values (1, 'raquel', 'd2063a446846c004df97e299fb781ea4', 'Raquel Wendt', 'A', 'A' );
select * from atendente;

CREATE TABLE tipo_atendimento (
    id_tipo_atendimento INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipo_atendimento VARCHAR(45) NOT NULL,
	ativo VARCHAR(1)NOT NULL
);

insert into tipo_atendimento values (1, 'INCIDENTE', 'A');
insert into tipo_atendimento values (2, 'DÚVIDA', 'A');
insert into tipo_atendimento values (3, 'REQUISIÇÃO', 'A');
insert into tipo_atendimento values (4, 'PROBLEMA', 'A');
select * from tipo_atendimento;


CREATE TABLE cliente (
    id_cliente INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL,
    cnpj varchar(18) NOT NULL,
	telefone VARCHAR (12), 
	ativo VARCHAR(1)NOT NULL
);

insert into cliente values(1, 'Casas Bahia', '12520458000178', '5137047687', 'A');
insert into cliente values(2, 'Imobiliária Guia', '85947256000112', '5198746842', 'A');
insert into cliente values(3, 'Brincasa', '23542653000165', '5196725295', 'A');
insert into cliente values(4, 'Subway', '74894512000145', '5192004512', 'A');
select * from cliente;


CREATE TABLE atendimento (
    id_atendimento INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    id_tipo_atendimento INT NOT NULL,
    id_atendente INT NOT NULL,
    id_cliente INT NOT NULL,
    dt_fim timestamp NULL,
    dt_inicio timestamp NULL,
    descricao VARCHAR(250)NOT NULL,
	ativo VARCHAR(1)NOT NULL,	
    FOREIGN KEY (id_tipo_atendimento) REFERENCES tipo_atendimento(id_tipo_atendimento),
    FOREIGN KEY (id_atendente) REFERENCES atendente(id_atendente),
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);

insert into atendimento values (1, 1, 1, 1, '2020-10-01 19:10:25-07', '2020-10-01 09:10:25-07','teste', 'A');
select * from atendimento;






