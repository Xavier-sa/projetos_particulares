import sys
from PySide6.QtWidgets import QApplication, QMainWindow, QMessageBox, QDialog
import mysql.connector
from model.login import Ui_Login  
from model.status import Ui_atribuir_pontos  
from model.perfil import Ui_Perfil_usuario  
from model.cadastro import Ui_Cadastro

class LoginApp(QMainWindow):
    def __init__(self):
        super().__init__()
        self.ui = Ui_Login()
        self.ui.setupUi(self)
        self.user_id = None

        self.ui.btn_login.clicked.connect(self.check_login)

    def connect_db(self):
        """Conecta ao banco de dados"""
        try:
            conn = mysql.connector.connect(
                host="localhost",
                user="root",
                password="",
                database="mau_mau"
            )
            return conn
        except mysql.connector.Error as err:
            QMessageBox.critical(self, "Erro", f"Erro ao conectar ao banco de dados: {err}")
            return None

    def check_login(self):
        """Verifica o login do usuário"""
        usuario = self.ui.lineEdit_user.text()
        senha = self.ui.lineEdit_password.text()

        conn = self.connect_db()
        if conn is None:
            return

        cursor = conn.cursor()
        query = "SELECT id, username FROM users WHERE username = %s AND password = %s"
        cursor.execute(query, (usuario, senha))
        user = cursor.fetchone()

        if user:
            self.user_id, self.username = user  # Armazena ID e Nome
            QMessageBox.information(self, "Login", "Login bem-sucedido!")
            self.close()
            self.cadastrar_usuario()
        else:
            QMessageBox.warning(self, "Erro", "Usuário ou senha incorretos!")

        cursor.close()
        conn.close()

    def cadastrar_usuario(self):
        """Método para cadastrar o novo usuário"""
        
        # Cria uma instância de Ui_Cadastro
        self.cadastro_window = QDialog(self)  # Cria uma nova janela de cadastro
        self.cadastro_ui = Ui_Cadastro()  # Cria uma instância de Ui_Cadastro
        self.cadastro_ui.setupUi(self.cadastro_window)  # Configura a interface de cadastro

        # Conectar o botão de cadastro à lógica
        self.cadastro_ui.pushButton.clicked.connect(self.realizar_cadastro)

        self.cadastro_window.show()

    def realizar_cadastro(self):
        """Realiza o cadastro do novo usuário"""
        
        # Obtém os dados do formulário
        nome_usuario = self.cadastro_ui.lineEdit_2.text()  # Nome de usuário
        senha = self.cadastro_ui.lineEdit_3.text()  # Senha
        senha_confirmada = self.cadastro_ui.lineEdit_4.text()  # Confirmação de senha
        servidor = self.cadastro_ui.lineEdit_5.text()  # Servidor
        classe = self.cadastro_ui.lineEdit_6.text()  # Classe
        life = self.cadastro_ui.lineEdit_8.text()  # Life
        ki = self.cadastro_ui.lineEdit_10.text()  # Ki
        forca = self.cadastro_ui.lineEdit_11.text()  # Força

        # Verifica se as senhas coincidem
        if senha != senha_confirmada:
            QMessageBox.warning(self.cadastro_window, "Erro", "As senhas não coincidem!")
            return

        conn = self.connect_db()
        if conn is None:
            return

        cursor = conn.cursor()
        
        # Inserir o usuário na tabela 'users'
        query_usuario = "INSERT INTO users (username, password, nome) VALUES (%s, %s, %s)"
        cursor.execute(query_usuario, (nome_usuario, senha, nome_usuario))  # Aqui 'nome_usuario' é usado para nome

        user_id = cursor.lastrowid  # Obtém o ID do usuário recém-inserido

        # Inserir o status do usuário na tabela 'status_info'
        query_status = """
        INSERT INTO status_info (user_id, life, ki, forca, servidor, classe)
        VALUES (%s, %s, %s, %s, %s, %s)
        """
        cursor.execute(query_status, (user_id, life, ki, forca, servidor, classe))
        
        conn.commit()
        cursor.close()
        conn.close()

        QMessageBox.information(self.cadastro_window, "Sucesso", "Usuário cadastrado com sucesso!")
        self.cadastro_window.close()  # Fecha a tela de cadastro
        self.show_status_window()  # Chama a tela de status

    def show_status_window(self):
        """Abre a tela de Status"""
        self.status_window = QDialog(self)
        self.status_ui = Ui_atribuir_pontos()
        self.status_ui.setupUi(self.status_window)
        self.status_window.show()

        self.status_ui.pushButton.clicked.connect(self.save_status_data)

    def save_status_data(self):
        """Salva os dados de Status e abre a tela de Perfil"""
        life = self.status_ui.lineEdit.text()
        ki = self.status_ui.lineEdit_ki.text()
        forca = self.status_ui.lineEdit_forca.text()

        if self.user_id is None:
            QMessageBox.warning(self.status_window, "Erro", "Erro: Usuário não logado!")
            return

        self.update_or_insert_status(self.user_id, life, ki, forca)
        self.status_window.close()
        self.show_perfil_window()

    def update_or_insert_status(self, user_id, life, ki, forca):
        """Atualiza ou insere os status"""
        conn = self.connect_db()
        if conn is None:
            return

        cursor = conn.cursor()
        query = """
        INSERT INTO status_info (user_id, life, ki, forca)
        VALUES (%s, %s, %s, %s)
        ON DUPLICATE KEY UPDATE
        life = life + VALUES(life),
        ki = ki + VALUES(ki),
        forca = forca + VALUES(forca);
        """
        cursor.execute(query, (user_id, life, ki, forca))
        conn.commit()
        cursor.close()
        conn.close()

    def show_perfil_window(self):
        """Abre a tela de Perfil com os dados do usuário"""
        self.perfil_window = QDialog(self)
        self.perfil_ui = Ui_Perfil_usuario()
        self.perfil_ui.setupUi(self.perfil_window)
        self.load_user_data()
        self.perfil_window.show()

    def load_user_data(self):
        """Carrega os dados do usuário na tela de Perfil"""
        conn = self.connect_db()
        if conn is None:
            return

        cursor = conn.cursor()
        query = "SELECT username, life, ki, forca FROM users JOIN status_info ON users.id = status_info.user_id WHERE users.id = %s"
        cursor.execute(query, (self.user_id,))
        user_data = cursor.fetchone()

        if user_data:
            self.perfil_ui.label_username.setText(f" {user_data[0]}")
            self.perfil_ui.label_username.setStyleSheet("color: red; font-weight: bold;")
            self.perfil_ui.label_life.setText(f"Life: {user_data[1]}")
            self.perfil_ui.label_ki.setText(f"Ki: {user_data[2]}")
            self.perfil_ui.label_forca.setText(f"Força: {user_data[3]}")

        cursor.close()
        conn.close()

# Inicializa o aplicativo
if __name__ == "__main__":
    app = QApplication(sys.argv)
    window = LoginApp()
    window.show()
    sys.exit(app.exec())
