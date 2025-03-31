

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






-- Criar a tabela categorias
create table if not exists categorias (
    id int auto_increment primary key,
    nome varchar(100) not null
);

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












-- Inserir usuários (precisa ser antes dos artigos para garantir a referência correta)
insert into usuarios(nome, email, telefone, data_nascimento, cpf) values
('xavier', 'xavier@gmail.com', '1234567890', '1985-04-15', '12345678901'),
('teste', 'teste@gmail.com', '1234567891', '1990-08-25', '98765432100'),
('santos', 'santos@gmail.com', '1234567892', '1988-12-01', '12332112345'),
('wellington', 'wellington@gmail.com', '1234567893', '1992-11-30', '54321678901');

-- Inserir categorias
insert into categorias (nome) values
('Sistemas'),
('Aplicativos Web'),
('Consultoria'),
('Suporte Técnico');

-- Inserir artigos (agora com os ids corretos dos usuários)
insert into artigos(titulo, conteudo, categoria_id, usuario_id) values
('Introdução ao Python: Linguagem para Iniciantes', 
 'Python é uma linguagem de programação de alto nível e fácil de aprender, amplamente usada para automação, análise de dados, inteligência artificial, desenvolvimento web e muito mais. Neste artigo, vamos explorar o básico do Python, desde variáveis até estruturas de controle, e como começar a escrever seu primeiro código.', 
 1, 1), -- Associando com categoria 'Sistemas' e usuário 'xavier'

('PHP: Como Criar Sites Dinâmicos e Interativos', 
 'PHP é uma das linguagens mais populares para desenvolvimento de sites dinâmicos. Neste artigo, vamos ensinar como usar o PHP para criar páginas interativas, processar formulários e conectar-se a bancos de dados, além de boas práticas para escrever código seguro.', 
 2, 2), -- Associando com categoria 'Aplicativos Web' e usuário 'teste'

('Java: Estruturas de Dados e Algoritmos', 
 'Java é uma das linguagens mais poderosas e versáteis, usada para desenvolvimento de software em diversos campos. Neste artigo, discutimos como implementar e utilizar diferentes estruturas de dados, como listas, pilhas e filas, além de explorar alguns algoritmos clássicos que são essenciais para programadores Java.', 
 3, 3), -- Associando com categoria 'Consultoria' e usuário 'santos'

('C# para Desenvolvimento de Aplicações Desktop e Web', 
 'C# é uma linguagem moderna da Microsoft, com suporte robusto para desenvolvimento de aplicações desktop e web. Neste artigo, vamos explorar como usar o C# no ambiente .NET para criar aplicações completas, abordando desde a criação de interfaces gráficas até a construção de aplicações web com ASP.NET.', 
 4, 4); -- Associando com categoria 'Suporte Técnico' e usuário 'wellington'

-- Verificar os dados inseridos nas tabelas
select * from usuarios;
select * from categorias;
select * from artigos;
