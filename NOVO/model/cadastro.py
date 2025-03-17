import sys
from PySide6.QtWidgets import QApplication, QDialog, QMessageBox
from PySide6.QtUiTools import QUiLoader
from PySide6.QtCore import QFile

import mysql.connector

class CadastroWindow(QDialog):
    def __init__(self):
        super().__init__()

        # Carrega a interface do arquivo .ui
        loader = QUiLoader()
        ui_file = QFile("ui/cadastro.ui")
        if not ui_file.exists():
            QMessageBox.critical(self, "Erro", "Arquivo UI não encontrado!")
            return

        ui_file.open(QFile.ReadOnly)
        self.ui = loader.load(ui_file, self)
        ui_file.close()

        # Conecta o botão de cadastro à função de registro
        self.ui.btn_cadastrar.clicked.connect(self.registrar_usuario)

    def connect_db(self):
        """Conecta ao banco de dados"""
        try:
            conn = mysql.connector.connect(
                host="127.0.0.1",
                port="3306",
                user="root",
                password="",
                database="mau_mau"
            )
            if conn.is_connected():
                print("Conexão com o banco de dados estabelecida.")
                return conn
        except mysql.connector.Error as err:
            QMessageBox.critical(self, "Erro de Conexão", f"Erro ao conectar ao banco de dados: {err}")
            return None

    def registrar_usuario(self):
        """Registra um novo usuário"""
        usuario = self.ui.lineEdit_user.text().strip()
        senha = self.ui.lineEdit_password.text().strip()
        confirmar_senha = self.ui.lineEdit_confirm_password.text().strip()

        # Validação dos campos
        if not usuario or not senha or not confirmar_senha:
            QMessageBox.warning(self, "Erro", "Preencha todos os campos.")
            return

        if senha != confirmar_senha:
            QMessageBox.warning(self, "Erro", "As senhas não coincidem.")
            return

        conn = self.connect_db()
        if conn is None:
            return

        cursor = conn.cursor()
        try:
            query = "INSERT INTO users (username, password) VALUES (%s, %s)"
            cursor.execute(query, (usuario, senha))
            conn.commit()
            QMessageBox.information(self, "Sucesso", "Usuário cadastrado com sucesso!")
            self.close()
        except mysql.connector.Error as err:
            QMessageBox.critical(self, "Erro", f"Erro ao registrar o usuário: {err}")
        finally:
            cursor.close()
            conn.close()

if __name__ == "__main__":
    app = QApplication(sys.argv)
    window = CadastroWindow()
    window.show()
    sys.exit(app.exec())