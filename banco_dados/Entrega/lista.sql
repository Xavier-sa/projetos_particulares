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

-- pessoa nome carros modelo
select p.nome as pessoa, c.modelo
from pessoas p
join carros_pessoas cp on p.id = cp.pessoa_id
join carros c on cp.placa = c.placa;

-- 10- Exiba o nome das pessaos que possuem carros de determinada marca (exemplo:"Ford").
select p.nome AS pessoa, m.nome AS marca
from pessoas p
join carros_pessoas cp on p.id = cp.pessoa_id
join carros c on cp.placa = c.placa
join marcas m on c.marca_id = m.id
where m.nome = 'Fiat';

-- 11-Conte quantas marcas de carros esão cadastradas.
-- aqui vai aparecer so a quantidade 1-solucao 
select count(*) as total_marcas from marcas;


-- aqui vai listar em sequencia 2-solucao
select nome from marcas;


-- 12-Descubra quantos carros existem no banco de dados.
select count(*) as total_carros from carros;

-- 13-Calcule a idade média das pessoas cadastradas.
select avg(year(curdate()) - year(data_nascimento)) as idade_media
from pessoas;

-- 14-Encontre o ano do carro mais antigo e do mais novo.
select min(ano) as ano_mais_antigo, max(ano) as ano_mais_novo
from carros;

-- 15-Conte quantas pessoas possuem pelo menos um carro.

select count(distinct pessoa_id) as total_pessoas_com_carro
from carros_pessoas;


-- 16-Liste todas as pessoas que possuem carros cadastrados.
-- solucao que usei o distinct para nao repetir pessoas que tem mais de um carro no nome 
select	distinct p.nome as pessoa
from pessoas p
join carros_pessoas cp on p.id = cp.pessoa_id;
-- solucao que lista varias vezes a  mesma pessoa
select p.nome 
from pessoas p
join carros_pessoas cp ON p.id = cp.pessoa_id;

-- 17-Encontre as marcas de carros que não possuem nenhum veículo registrado. 
select m.nome as marca
from marcas m
left join carros c on m.id = c.marca_id
where c.placa is null;

-- tem que sair Ferrari inseri OK funcionou


-- 18-Liste os 5 carros mais novos cadastrados.

select placa, modelo, ano, nome
from carros c
join marcas m ON c.marca_id = m.id
order by ano desc
limit 5;   -- funcionou lol

-- 19-Liste as pessoas pelo nome em ordem alfabética.

select nome  
from pessoas
order by nome;

-- 20-Liste as três marcas com mais carros cadastrados.

select m.nome, count(c.placa) AS total_carros
from marcas m
left join carros c on m.id = c.marca_id
group by m.id
order by total_carros desc
limit 3;


-- 21-Exclua uma marca que possui carros cadastrados. O que acontece? Explique.


delete from marcas  -- creio que nao seja permito devido cahve estrangeira 
where id = <id_da_marca>;

-- 22-Exclua uma pessoa que possui carros associados. O que acontece? Explique.

delete from pessoas
where id = <id_da_pessoa>;  -- falha devido a achave e relacionemnto

-- 23-Atualize o nome de uma marca e verifique se isso afeta os carros associados.Explique.

update marcas
set nome = 'Xavier V6'
where id = 1; -- thiago alterei o do toyota para testar 

-- voltei pra toyota
update marcas
set nome = 'Toyota'
where id = 1; -- funcionando



-- aparentemente nao terei grandes problemas pois como apenas alterei o nome nas demais tabelas vira com o novo nome da marca
