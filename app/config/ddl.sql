

-- drop database xavier_solutions;


-- Criar o banco de dados, se não existir
create database if not exists xavier_solutions;

-- Usar o banco de dados
use xavier_solutions;

-- Criar a tabela home
-- create table if not exists home (
    -- id int auto_increment primary key,
    -- titulo varchar(255) not null,
    -- descricao text not null  
-- );

-- Criar a tabela categorias
create table if not exists categorias (
    id int auto_increment primary key,
    nome varchar(100) not null
);


-- Criar a tabela usuarios
create table if not exists usuarios (
    id int auto_increment primary key,
    nome varchar(100) not null,
    email varchar(100) not null unique,
    telefone varchar(20),
    data_nascimento date,
    cpf varchar(14) unique,
    imagem_caminho varchar(255),
    data_cadastro datetime default current_timestamp
);



-- DROP TABLE xavier_solutions.usuarios

-- Criar a tabela artigos
create table if not exists artigos (
    id int auto_increment primary key,
    titulo varchar(255) not null,
    conteudo text not null,
    categoria_id int,
    usuario_id int,  -- Alterado de usuario_matricula para usuario_id
    foreign key (categoria_id) references categorias(id),
    foreign key (usuario_id) references usuarios(id)  -- Relacionando com a tabela usuarios
);





-- DESCRIBE artigos;














-- Verificar os dados inseridos nas tabelas
select * from usuarios;
select * from categorias;
select * from artigos;
