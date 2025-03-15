create database if not  exists aula_db;
-- aqui da maneira do professor thiago


USE aula_db;

CREATE TABLE marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL
);

-- placa, marca, modelo , ano
CREATE TABLE carros (      
    placa varchar(7) not null unique primary key,
    modelo varchar(50),
    ano int,
    marca_id int not null, 
    foreign key(marca_id) references marcas (id)
);

-- id, nome , cpf, data nascimento
create table pessoas(
	id int primary key auto_increment,
	nome varchar (255) not null,
	cpf varchar(11) not null unique,
	data_nascimento date not null
);


create table carros_pessoas(
	placa varchar(7) not null,
	pessoa_id int not null,
	
	primary key (placa,pessoa_id),
	foreign key (placa) references carros (placa),
	foreign key (pessoa_id) references pessoas(id)
	

);
-- ----------------------------------------------



-- inserir em marcas
insert  into marcas(nome)
values
('GM'),
('VW'),
('NISSAN'),
('AUDI'),
('HONDA');

-- inserir em carros
insert into carros(placa,marca_id,modelo,ano)
values('1234abc',1,'Celta',1999);

-- comando para deletar TABLES
drop table marcas;
drop table carros;
drop table pessoas ;
-- atençao 
DROP DATABASE aula_db;




-- aqui o que  tinha feito
create table pessoa(
	nome varchar(100),
	matricula int auto_increment primary key,
	idade int, 
	categoria char(2)
	);

-- abaixo comandos que usei na TABLE pessoa

-- inserir
insert into pessoa(nome,matricula,idade,categoria)
values('XAVIER',7,31,'D');

insert into pessoa(nome,idade,categoria)
values('XAVIER 2',31,'D');

insert into pessoa (nome,idade,categoria)
values('Goamory',62,'C');

insert into pessoa (nome,idade,categoria)
values('Raditz',63,'D');

insert into pessoa(nome,idade,categoria)
values('Holy',53,'E');


-- atualizar
update pessoa 
set idade = 58
where matricula = 10;

update pessoa 
set nome = 'BARDOCK'
where matricula = 10;

-- deletar
delete from pessoa 
where matricula = 7;

-- consultar

select *from carros;
select *from marcas;
select *from pessoas;
select *from carros_pessoas;


-- consultar ordenando 
select *from pessoa 
order by nome asc;


-- consultar limitando quantidade

--      TABLE PESSOA

select *from pessoa
limit 5;

--      TABLE CARROS

select *from carros 
limit 5;

--      TABLE MARCAS

select *from marcas 
limit 5;



-- exibir todas as tabelas
SHOW TABLES;

SELECT placa FROM carros;

SELECT placa FROM carros WHERE placa IN ('7894ABC', '5678DEF', '9101GHI', '1122JKL', '3344MNO', '5566PQR', '7788STU', '9900VWX', '2233YZA', '4455BCD');


-- 1. fazer os comandos para inserir, atualizar, excluir e visualizar registros de todas as tabelas 


-- 2. criar tabela para representar uma pessoa 


-- 3. representar a relação de motorista e carro conduzido 


-- aula 14/03/2025
-- vou add mais marcas
INSERT INTO marcas (nome) VALUES 
('Toyota'),
('Ford'),
('BMW'),
('Mercedes-Benz'),
('Chevrolet'),
('Hyundai'),
('Kia'),
('Fiat'),
('Peugeot'),
('Jeep');

-- vou add mais carros (MELHORA A VISIBILIDADE )
INSERT INTO carros(placa, marca_id, modelo, ano) VALUES
('7894ABC', 1, 'Corolla', 2020),
('5678DEF', 2, 'Fusion', 2018),
('9101GHI', 3, 'X5', 2021),
('1122JKL', 4, 'A4', 2022),
('3344MNO', 5, 'Onix', 2023),
('5566PQR', 6, 'Tucson', 2020),
('7788STU', 7, 'Sportage', 2021),
('9900VWX', 8, 'Argo', 2020),
('2233YZA', 9, '308', 2019),
('4455BCD', 10, 'Renegade', 2022);


-- add mais pessoas para melhora a tabela
INSERT INTO pessoas(nome, cpf, data_nascimento) VALUES
('Abraham', '12345678901', '1999-01-01'),
('Isaac', '23456789012', '1998-02-02'),
('Jacob', '34567890123', '1997-03-03'),
('Moses', '45678901234', '1996-04-04'),
('David', '56789012345', '1995-05-05'),
('Solomon', '67890123456', '1994-06-06'),
('Samuel', '78901234567', '1993-07-07'),
('Elijah', '89012345678', '1992-08-08'),
('Peter', '90123456789', '2001-09-09'),
('Mary', '01234567890', '2002-10-10');


-- relacionando pessoas aos carros 
insert into carros_pessoas(placa, pessoa_id) values 
('1234abc',1),
('2233YZA', 2),
('4455bcd',3),
('3344MNO', 4),
('5566PQR', 5),
('5678DEF', 6),
('7788STU', 7),
('7894ABC', 8),
('9101GHI', 9),
('9900VWX', 10);

-- 1-Selecione todos os registros da tabela marcas

select * from marcas;


-- 2-Liste Todas as placas e anos dos carros cadastrados;

select placa, ano from carros;


-- 3-Mostre o nome e a data de nascimento de todas as pessoas;

select nome, data_nascimento from pessoas;


-- 4-Liste todos os carros do ano 2020 ou mais recentes;

select * from carros where ano >= 2020;



-- 5-Encontre todas as pessoas nascidas antes do ano 2000.
-- uma solução
select * from pessoas where data_nascimento < '2000-01-01';
-- outra solução
select * from pessoas where year(data_nascimento) < '2000';

-- 6-Selecione os carros de uma marca específica (exemplo: "Toyota").
-- solucao professor
select *from marcas where nome = 'Toyota';


select c.placa, c.modelo, c.ano, m.nome as marca
from carros c
join marcas m on c.marca_id = m.id 
where m.nome = 'BMW';

-- 7-Exiba todas as pessoas cujo nome comece com a letra "A".

select *from pessoas where nome like 'a%';

-- 8-Liste todas as placas dos carros e o nome da respectiva marca.

select c.placa, m.nome as marca
from carros c
join marcas m on c.marca_id = m.id;
 

-- 9-Mostre o nome das pessoas e os carros que elas possuem.





-- exiba o nome das pessoas que possuem carros de determinada marca (exemplo: "Ford");
-- conte quantas marcas de carros estão cadastradas;
-- descubra quantos carros existem no banco de dados;
-- calcule a idade média das pessoas cadastradas;
-- encontre o ano do carro mais antigo e do mais novo;
-- conte quantas pessoas possuem pelo menos um carro;
-- liste todas as pessoas que possuem carros cadastrados;
-- encontre as marcas de carros que não possuem nenhum veículo registrado.

SHOW TABLES;















