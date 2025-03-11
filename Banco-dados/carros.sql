-- Tabela para armazenar marcas de carros
CREATE TABLE marcas (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE
);

-- Tabela para armazenar informações dos carros
CREATE TABLE carros (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(7) NOT NULL UNIQUE,
    marca_id INT NOT NULL,
    modelo VARCHAR(50),
    ano INT,
    FOREIGN KEY (marca_id) REFERENCES marcas(id)
);

-- Tabela de controle de entrada e saída de veículos
CREATE TABLE controle_entrada_saida (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_aluno VARCHAR(255) NOT NULL,
    placa_veiculo VARCHAR(7) NOT NULL,
    matricula_motorista_saida VARCHAR(50) NOT NULL,
    km_veiculo_saida INT NOT NULL,
    hora_saida TIME NOT NULL,
    matricula_motorista_entrada VARCHAR(50) NOT NULL,
    km_veiculo_entrada INT NOT NULL,
    hora_entrada TIME NOT NULL,
    data DATE NOT NULL,
    FOREIGN KEY (placa_veiculo) REFERENCES carros(placa),
    CONSTRAINT placa_veiculo_unico UNIQUE (placa_veiculo, data)
);

-- Inserção de exemplo na tabela marcas
INSERT INTO marcas(nome) VALUES('Chevrolet');



USE aula_db;

CREATE TABLE registros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_aluno VARCHAR(100),
    placa_veiculo VARCHAR(20),
    matricula_saida VARCHAR(50),
    km_saida INT,
    hora_saida TIME,
    matricula_entrada VARCHAR(50),
    km_entrada INT,
    hora_entrada TIME,
    data_registro DATE
);

