import sys
from PySide6.QtWidgets import QApplication, QMainWindow, QMessageBox, QDialog
import mysql.connector
from model.login import Ui_Login  
from model.cadastrar import CadastroWindow
from model.perfil import PerfilWindow

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
           
            # Abrir a janela de cadastro após o login
            self.cadastro_window = CadastroWindow()
            self.cadastro_window.show()
            
        else:
            QMessageBox.warning(self, "Erro", "Usuário ou senha incorretos!")

        cursor.close()
        conn.close()

# Inicializa o aplicativo
if __name__ == "__main__":
    app = QApplication(sys.argv)
    window = LoginApp()
    window.show()
    sys.exit(app.exec())