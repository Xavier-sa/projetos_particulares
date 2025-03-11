create database if not  exists aula_db;

use aula_db;


-- placa, marca, modelo , ano
CREATE TABLE carros (      
    placa varchar(7) not null unique primary key,
    marca varchar(50) not null, 
    modelo varchar(50) ,
    ano int
);

drop table carros;
create table marcas (
	id int not null auto_increment primary key,
	nome varchar(50) not null,
	
);


insert into marcas(nome) values('Chevrolet');



-- 1. fazer os comandos para inserir, atualizar, excluir e visualizar registros de todas as tabelas 

-- 2. criar tabela para representar uma pessoa 
-- 3. representar a relação de motorista e carro conduzido 