import mysql.connector

def conectar_banco():
    """Conecta ao banco de dados e retorna a conexão e o cursor."""
    try:
        conexao = mysql.connector.connect(
            host="127.0.0.1",
            user="root",
            password="",
            database="aula_db"
        )
        cursor = conexao.cursor()
        print("Conexão ao banco de dados estabelecida.")
        return conexao, cursor
    except mysql.connector.Error as erro:
        print(f"Erro ao conectar ao banco de dados: {erro}")
        return None, None

def executar_consulta(cursor, consulta):
    """Executa uma consulta SQL e exibe os resultados."""
    try:
        cursor.execute(consulta)
        resultados = cursor.fetchall()

        if resultados:
            print("\nResultados:")
            for linha in resultados:
                print(linha)
        else:
            print("\nNenhum resultado encontrado.")
    except mysql.connector.Error as erro:
        print(f"Erro ao executar a consulta: {erro}")

def menu():
    """Exibe o menu de opções para o usuário."""
    print("\n--- Sistema de Consulta Interativo ---")
    print("1. Listar todas as marcas")
    print("2. Listar placas e anos dos carros")
    print("3. Mostrar nome e data de nascimento das pessoas")
    print("4. Listar carros do ano 2020 ou mais recentes")
    print("5. Encontrar pessoas nascidas antes do ano 2000")
    print("6. Listar carros de uma marca específica (ex: Toyota)")
    print("7. Mostrar pessoas cujo nome começa com 'A'")
    print("8. Listar placas dos carros e suas marcas")
    print("9. Mostrar pessoas e os carros que possuem")
    print("10. Mostrar pessoas que possuem carros de uma marca específica (ex: Ford, Toyota, BMW, Mercedes-Benz, Chevrolet, Hyundai, Kia, Fiat, Peugeot, Jeep, Ferrari")
    print("11. Contar quantas marcas de carros estão cadastradas")
    print("12. Contar quantos carros existem no banco de dados")
    print("13. Calcular a idade média das pessoas")
    print("14. Encontrar o ano do carro mais antigo e do mais novo")
    print("15. Contar quantas pessoas possuem pelo menos um carro")
    print("16. Listar todas as pessoas que possuem carros")
    print("17. Encontrar marcas de carros sem veículos registrados")
    print("18. Sair")
    return input("Escolha uma opção: ")

def main():
    """Função principal do sistema."""
    conexao, cursor = conectar_banco()
    if not conexao or not cursor:
        return

    while True:
        opcao = menu()

        if opcao == "1":
            executar_consulta(cursor, "SELECT * FROM marcas")
        elif opcao == "2":
            executar_consulta(cursor, "SELECT placa, ano FROM carros")
        elif opcao == "3":
            executar_consulta(cursor, "SELECT nome, data_nascimento FROM pessoas")
        elif opcao == "4":
            executar_consulta(cursor, "SELECT * FROM carros WHERE ano >= 2020")
        elif opcao == "5":
            executar_consulta(cursor, "SELECT * FROM pessoas WHERE YEAR(data_nascimento) < 2000")
        elif opcao == "6":
            marca = input("Digite o nome da marca (ex: Toyota): ")
            executar_consulta(cursor, f"""
                SELECT c.placa, c.modelo, c.ano, m.nome AS marca
                FROM carros c
                JOIN marcas m ON c.marca_id = m.id
                WHERE m.nome = '{marca}'
            """)
        elif opcao == "7":
            executar_consulta(cursor, "SELECT * FROM pessoas WHERE nome LIKE 'A%'")
        elif opcao == "8":
            executar_consulta(cursor, """
                SELECT c.placa, m.nome AS marca
                FROM carros c
                JOIN marcas m ON c.marca_id = m.id
            """)
        elif opcao == "9":
            executar_consulta(cursor, """
                SELECT p.nome AS pessoa, c.placa, c.modelo, c.ano
                FROM pessoas p
                JOIN carros_pessoas cp ON p.id = cp.pessoa_id
                JOIN carros c ON cp.placa = c.placa
            """)
        elif opcao == "10":
            marca = input("Digite o nome da marca (ex: Ford, Toyota, BMW, Mercedes-Benz, Chevrolet, Hyundai, Kia, Fiat, Peugeot, Jeep, Ferrari): ")  
            executar_consulta(cursor, f"""
                SELECT p.nome AS pessoa, m.nome AS marca
                FROM pessoas p
                JOIN carros_pessoas cp ON p.id = cp.pessoa_id
                JOIN carros c ON cp.placa = c.placa
                JOIN marcas m ON c.marca_id = m.id
                WHERE m.nome = '{marca}'
            """)
        elif opcao == "11":
            executar_consulta(cursor, "SELECT COUNT(*) AS total_marcas FROM marcas")
        elif opcao == "12":
            executar_consulta(cursor, "SELECT COUNT(*) AS total_carros FROM carros")
        elif opcao == "13":
            executar_consulta(cursor, """
                SELECT AVG(YEAR(CURDATE()) - YEAR(data_nascimento)) AS idade_media
                FROM pessoas
            """)
        elif opcao == "14":
            executar_consulta(cursor, "SELECT MIN(ano) AS ano_mais_antigo, MAX(ano) AS ano_mais_novo FROM carros")
        elif opcao == "15":
            executar_consulta(cursor, "SELECT COUNT(DISTINCT pessoa_id) AS total_pessoas_com_carro FROM carros_pessoas")
        elif opcao == "16":
            executar_consulta(cursor, """
                SELECT DISTINCT p.nome AS pessoa
                FROM pessoas p
                JOIN carros_pessoas cp ON p.id = cp.pessoa_id
            """)
        elif opcao == "17":
            executar_consulta(cursor, """
                SELECT m.nome AS marca
                FROM marcas m
                LEFT JOIN carros c ON m.id = c.marca_id
                WHERE c.placa IS NULL
            """)
        elif opcao == "18":
            print("Saindo da Lista...")
            break
        else:
            print("Opção inválida. Tente novamente.")

    # Fecha a conexão com o banco de dados
    if conexao.is_connected():
        cursor.close()
        conexao.close()
        print("Conexão ao banco de dados encerrada.")

if __name__ == "__main__":
    main()