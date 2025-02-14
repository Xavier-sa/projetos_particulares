from flask_mysqldb import MySQL

# Inicializa o MySQL
mysql = MySQL()

def init_db(app):
    mysql.init_app(app)
