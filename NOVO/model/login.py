import sys
import mysql.connector
from PySide6.QtWidgets import QApplication, QDialog, QMessageBox,QMainWindow
from PySide6.QtUiTools import QUiLoader
from PySide6.QtCore import QFile
from .cadastro import CadastroWindow  
from .conexao import connect_db

class LoginWindow(QDialog):
    def __init__(self):
        super().__init__()

        # Carrega a interface do arquivo .ui
        loader = QUiLoader()
        ui_file = QFile("UI/login.ui")
        if not ui_file.exists():
            QMessageBox.critical(self, "Erro", "Arquivo UI não encontrado!")
            return

        ui_file.open(QFile.ReadOnly)
        self.ui = loader.load(ui_file, self)
        ui_file.close()

        # Conecta o botão de login à função de verificação
        self.ui.btn_login.clicked.connect(self.verificar_login)

    

    def verificar_login(self):
        """Verifica o login do usuário"""
        usuario = self.ui.lineEdit_user.text().strip()
        senha = self.ui.lineEdit_password.text().strip()

        # Validação dos campos
        if not usuario or not senha:
            QMessageBox.warning(self, "Erro", "Preencha todos os campos.")
            return

        conn = self.connect_db()
        if conn is None:
            return

        cursor = conn.cursor()
        try:
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
        except mysql.connector.Error as err:
            QMessageBox.critical(self, "Erro", f"Erro ao executar a consulta: {err}")
        finally:
            cursor.close()
            conn.close()

if __name__ == "__main__":
    app = QApplication(sys.argv)
    window = LoginWindow()
    window.show()
    sys.exit(app.exec())