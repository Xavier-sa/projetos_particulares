-- Criar o banco de dados se não existir
create database if not exists xavier_solutions;

-- drop database xavier_solutions;

-- Usar o banco de dados
use xavier_solutions;

-- Tabela home
create table home (
    id int auto_increment primary key,          -- identificador único
    titulo varchar(255) not null,               
    descricao text not null  
);

-- Tabela users
create table users (
    matricula int auto_increment primary key,    -- identificador único do usuário
    nome varchar(255) not null,                  -- nome do usuário
    email varchar(255) not null unique,          -- e-mail do usuário (único)
    telefone varchar(20),                        -- telefone do usuário
    data_nascimento date,                        -- data de nascimento do usuário
    cpf varchar(11) not null                     -- CPF do usuário
);

-- Tabela categorias
create table categorias (
    id int auto_increment primary key,           -- identificador único da categoria
    nome varchar(100) not null,                  -- nome da categoria
    descricao text                               -- descrição da categoria
);

-- Tabela artigos
create table artigos (
    id int auto_increment primary key,           -- identificador único do artigo
    titulo varchar(255) not null,                -- título do artigo
    conteudo text not null,                      -- conteúdo do artigo
    categoria_id int,                            -- chave estrangeira para a categoria
    usuario_matricula int,                      -- chave estrangeira para o usuário
    created_at timestamp default current_timestamp,  -- data de criação do artigo
    updated_at timestamp default current_timestamp on update current_timestamp,  -- data de atualização
    foreign key (categoria_id) references categorias(id),  -- relacionamento com categorias
    foreign key (usuario_matricula) references users(matricula)   -- relacionamento com usuários
);

