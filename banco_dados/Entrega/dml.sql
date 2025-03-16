-- Data Manipulation Language

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

-- para o exericio 16 
insert into carros_pessoas(placa, pessoa_id) VALUES ('1122JKL','1');
-- para o exercicio 17 
insert into marcas (nome) Values('Ferrari');




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
('Moises', '45678901234', '1996-04-04'),
('David', '56789012345', '1995-05-05'),
('Solomon', '67890123456', '1994-06-06'),
('Samuel', '78901234567', '1993-07-07'),
('Elijah', '89012345678', '1992-08-08'),
('Peter', '90123456789', '2001-09-09'),
('Mary', '01234567890', '2002-10-10');


-- relacionando pessoas aos carros 
INSERT INTO carros_pessoas (placa, pessoa_id) VALUES
('7894ABC', 1),
('5678DEF', 2),
('9101GHI', 3),
('1122JKL', 4),
('3344MNO', 5),
('5566PQR', 6),
('7788STU', 7),
('9900VWX', 8),
('2233YZA', 9),
('4455BCD', 10);
