from flask import Flask, jsonify, request
from backend.database import db
from backend.models import Personagem

app = Flask(__name__)

# Configuração para usar o banco de dados MySQL
app.config['MYSQL_HOST'] = 'localhost'  # Endereço do servidor MySQL (padrão no XAMPP)
app.config['MYSQL_USER'] = 'root'  # Usuário padrão do MySQL (normalmente 'root' no XAMPP)
app.config['MYSQL_PASSWORD'] = ''  # Senha (deixe vazio se não estiver configurada)
app.config['MYSQL_DB'] = 'dbz_rpg'  # Nome do banco de dados

# Inicializa o MySQL
from flask_mysqldb import MySQL
mysql = MySQL(app)

@app.route('/criar_personagem', methods=['POST'])
def criar_personagem():
    data = request.json
    nome = data['nome']
    raça = data['raça']
    força = data['força']
    velocidade = data['velocidade']
    energia = data['energia']

    # Conecta ao banco de dados
    cur = mysql.connection.cursor()
    cur.execute("INSERT INTO personagens(nome, raça, força, velocidade, energia) VALUES(%s, %s, %s, %s, %s)", 
                (nome, raça, força, velocidade, energia))
    mysql.connection.commit()
    cur.close()

    return jsonify({"message": "Personagem criado com sucesso!"}), 201

@app.route('/personagens', methods=['GET'])
def get_personagens():
    cur = mysql.connection.cursor()
    cur.execute("SELECT * FROM personagens")
    resultado = cur.fetchall()
    cur.close()

    personagens = [{
        "id": p[0],
        "nome": p[1],
        "raça": p[2],
        "força": p[3],
        "velocidade": p[4],
        "energia": p[5]
    } for p in resultado]

    return jsonify(personagens)

if __name__ == "__main__":
    app.run(debug=True)
