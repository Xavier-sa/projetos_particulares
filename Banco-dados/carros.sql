-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS aula_db;

-- Seleção do banco de dados para uso
USE aula_db;

-- Tabela para armazenar as marcas de veículos
-- Tabela para armazenar as marcas de veículos
CREATE TABLE marcas (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,  -- Identificador único para cada marca
    nome VARCHAR(50) NOT NULL  -- Nome da marca do veículo
);


-- Inserção de uma marca exemplo
INSERT INTO marcas(nome) VALUES('Chevrolet');

-- Tabela para armazenar as informações de carros
CREATE TABLE carros (
    placa VARCHAR(7) NOT NULL UNIQUE PRIMARY KEY,
    marca VARCHAR(50) NOT NULL, 
    modelo VARCHAR(50),
    ano INT
);

-- Tabela para armazenar informações de pessoas (motoristas)
CREATE TABLE pessoas (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE
);

-- Tabela para representar a relação entre motoristas e carros
CREATE TABLE motoristas_carros (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_pessoa INT NOT NULL,
    placa_carro VARCHAR(7) NOT NULL,
    data_conducao DATE NOT NULL,
    FOREIGN KEY (id_pessoa) REFERENCES pessoas(id),
    FOREIGN KEY (placa_carro) REFERENCES carros(placa)
);

