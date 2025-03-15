# Consultas SQL

1. **Selecione todos os registros da tabela `marcas`:**
    ```sql
    SELECT * FROM marcas;
    ```

2. **Liste todas as placas e anos dos carros cadastrados:**
    ```sql
    SELECT placa, ano FROM carros;
    ```

3. **Mostre o nome e a data de nascimento de todas as pessoas:**
    ```sql
    SELECT nome, data_nascimento FROM pessoas;
    ```

4. **Liste todos os carros do ano 2020 ou mais recentes:**
    ```sql
    SELECT * FROM carros WHERE ano >= 2020;
    ```

5. **Encontre todas as pessoas nascidas antes do ano 2000:**
    ```sql
    SELECT * FROM pessoas WHERE YEAR(data_nascimento) < 2000;
    ```

6. **Selecione os carros de uma marca específica (exemplo: "Toyota"):**
    ```sql
    SELECT * FROM carros WHERE marca = 'Toyota';
    ```

7. **Exiba todas as pessoas cujo nome comece com a letra "A":**
    ```sql
    SELECT * FROM pessoas WHERE nome LIKE 'A%';
    ```

