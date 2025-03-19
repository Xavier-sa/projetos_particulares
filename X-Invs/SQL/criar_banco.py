import mysql.connector
from mysql.connector import Error

def criar_banco():
    try:
        # Conecta ao MySQL (XAMPP)
        conexao = mysql.connector.connect(
            host="localhost",
            user="root",  # Usuário padrão do XAMPP
            password=""   # Senha padrão do XAMPP (vazia)
        )

        if conexao.is_connected():
            print("Conectado ao MySQL.")

            cursor = conexao.cursor()

            # Cria o banco de dados `mau_mau` se ele não existir
            cursor.execute("CREATE DATABASE IF NOT EXISTS mau_mau")
            print("Banco de dados 'mau_mau' criado ou já existente.")

            # Seleciona o banco de dados `mau_mau`
            cursor.execute("USE mau_mau")

            # Script SQL para criar as tabelas
            sql = """
            CREATE TABLE IF NOT EXISTS cadastro (
                id INT(11) NOT NULL AUTO_INCREMENT,
                user_id INT(11) DEFAULT NULL,
                salario INT(11) DEFAULT NULL,
                despesa INT(11) DEFAULT NULL,
                investimentos INT(11) DEFAULT NULL,
                rendaextra INT(11) DEFAULT NULL,
                veiculos INT(11) DEFAULT NULL,
                gasolina INT(11) DEFAULT NULL,
                cursos INT(11) DEFAULT NULL,
                PRIMARY KEY (id),
                KEY user_id (user_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            CREATE TABLE IF NOT EXISTS metas (
                id INT(11) NOT NULL AUTO_INCREMENT,
                user_id INT(11) NOT NULL,
                nome_meta VARCHAR(255) NOT NULL,
                valor_total DECIMAL(10,2) NOT NULL,
                valor_atual DECIMAL(10,2) DEFAULT 0.00,
                status VARCHAR(50) DEFAULT 'Em andamento',
                PRIMARY KEY (id),
                KEY user_id (user_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            CREATE TABLE IF NOT EXISTS progresso (
                id INT(11) NOT NULL AUTO_INCREMENT,
                meta_id INT(11) NOT NULL,
                valor_adicionado DECIMAL(10,2) NOT NULL,
                data DATE NOT NULL,
                PRIMARY KEY (id),
                KEY meta_id (meta_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            CREATE TABLE IF NOT EXISTS status_info (
                id INT(11) NOT NULL AUTO_INCREMENT,
                life INT(11) NOT NULL,
                ki INT(11) NOT NULL,
                forca INT(11) NOT NULL,
                user_id INT(11) DEFAULT NULL,
                PRIMARY KEY (id),
                UNIQUE KEY user_id (user_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            CREATE TABLE IF NOT EXISTS users (
                id INT(11) NOT NULL AUTO_INCREMENT,
                username VARCHAR(255) DEFAULT NULL,
                password VARCHAR(255) DEFAULT NULL,
                PRIMARY KEY (id),
                UNIQUE KEY username (username)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            """

            # Executa o script SQL
            for resultado in cursor.execute(sql, multi=True):
                pass  # Executa cada comando SQL

            print("Tabelas criadas com sucesso.")

            # Fecha a conexão
            cursor.close()
            conexao.close()
            print("Conexão encerrada.")

    except Error as e:
        print(f"Erro ao conectar ou criar o banco de dados: {e}")

if __name__ == "__main__":
    criar_banco()