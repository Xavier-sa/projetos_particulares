-- Data Manipulation Language

-- Adicionando marcas
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
('Jeep'),
('Volkswagen'),
('Renault'),
('Honda'),
('Nissan'),
('Volvo'),
('Audi'),
('Citroën'),
('Chery'),
('Mitsubishi'),
('Land Rover');

-- Adicionando a marca Ferrari (ID 21)
INSERT INTO marcas (nome) VALUES ('Ferrari');

-- Adicionando carros
INSERT INTO carros (placa, marca_id, modelo, ano) VALUES
('7894ABC', 1, 'Corolla', 2020),          -- Toyota
('5678DEF', 2, 'Fusion', 2018),           -- Ford
('9101GHI', 3, 'X5', 2021),               -- BMW
('1122JKL', 4, 'A4', 2022),               -- Mercedes-Benz
('3344MNO', 5, 'Onix', 2023),             -- Chevrolet
('5566PQR', 6, 'Tucson', 2020),           -- Hyundai
('7788STU', 7, 'Sportage', 2021),         -- Kia
('9900VWX', 8, 'Argo', 2020),             -- Fiat
('2233YZA', 9, '308', 2019),              -- Peugeot
('4455BCD', 10, 'Renegade', 2022),        -- Jeep
('1234XYZ', 11, 'Gol', 2019),             -- Volkswagen
('2345QWE', 11, 'Polo', 2021),            -- Volkswagen
('3456RTY', 12, 'Kwid', 2020),            -- Renault
('4567UIO', 12, 'Sandero', 2022),         -- Renault
('5678PAS', 13, 'Civic', 2021),           -- Honda
('6789DFG', 13, 'HR-V', 2022),            -- Honda
('7890HJK', 14, 'Kicks', 2021),           -- Nissan
('8901LZX', 14, 'Versa', 2020),           -- Nissan
('9012CVB', 15, 'XC40', 2023),            -- Volvo
('0123NMQ', 16, 'A3', 2022),              -- Audi
('1122QAZ', 17, 'C4 Cactus', 2021),       -- Citroën
('2234WSX', 18, 'Tiggo 5X', 2022),        -- Chery
('3345EDC', 19, 'ASX', 2020),             -- Mitsubishi
('4456RFV', 20, 'Discovery Sport', 2023); -- Land Rover

-- Adicionando pessoas
INSERT INTO pessoas (nome, cpf, data_nascimento) VALUES
('Abraham', '12345678901', '1999-01-01'),
('Isaac', '23456789012', '1998-02-02'),
('Jacob', '34567890123', '1997-03-03'),
('Moises', '45678901234', '1996-04-04'),
('David', '56789012345', '1995-05-05'),
('Solomon', '67890123456', '1994-06-06'),
('Samuel', '78901234567', '1993-07-07'),
('Elijah', '89012345678', '1992-08-08'),
('Peter', '90123456789', '2001-09-09'),
('Mary', '01234567890', '2002-10-10'),
('José', '11122233344', '1985-05-15'),       -- José, filho de Jacó
('Rute', '22233344455', '1990-08-25'),       -- Rute, personagem do livro de Rute
('Davi', '33344455566', '1988-03-10'),       -- Davi, rei de Israel
('Ester', '44455566677', '1995-11-30'),      -- Ester, rainha da Pérsia
('Salomão', '55566677788', '1980-07-20'),    -- Salomão, filho de Davi
('Raquel', '66677788899', '1992-09-12'),     -- Raquel, esposa de Jacó
('Jonas', '77788899900', '1987-04-05'),      -- Jonas, profeta
('Lídia', '88899900011', '1998-12-18'),      -- Lídia, vendedora de púrpura
('Timóteo', '99900011122', '2000-02-22'),    -- Timóteo, discípulo de Paulo
('Débora', '00011122233', '1993-06-14');     -- Débora, juíza de Israel

-- Relacionando pessoas aos carros
INSERT INTO carros_pessoas (placa, pessoa_id) VALUES
('7894ABC', 1),  -- Abraham tem um Corolla
('5678DEF', 2),  -- Isaac tem um Fusion
('9101GHI', 3),  -- Jacob tem um X5
('1122JKL', 4),  -- Moises tem um A4
('3344MNO', 5),  -- David tem um Onix
('5566PQR', 6),  -- Solomon tem um Tucson
('7788STU', 7),  -- Samuel tem um Sportage
('9900VWX', 8),  -- Elijah tem um Argo
('2233YZA', 9),  -- Peter tem um 308
('4455BCD', 10), -- Mary tem um Renegade
('1234XYZ', 11), -- José tem um Gol
('2345QWE', 12), -- Rute tem um Polo
('3456RTY', 13), -- Davi tem um Kwid
('4567UIO', 14), -- Ester tem um Sandero
('5678PAS', 15), -- Salomão tem um Civic
('6789DFG', 16), -- Raquel tem um HR-V
('7890HJK', 17), -- Jonas tem um Kicks
('8901LZX', 18), -- Lídia tem um Versa
('9012CVB', 19), -- Timóteo tem um XC40
('0123NMQ', 20); -- Débora tem um A3