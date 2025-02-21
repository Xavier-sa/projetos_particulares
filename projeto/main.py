import sys
from PySide6.QtWidgets import QApplication, QMainWindow, QMessageBox, QDialog
import mysql.connector
from login import Ui_Dialog  # Tela de Login
from status import Ui_StatusWindoW  # Tela de Status
from perfil import Ui_PerfilWindow  # Tela de Perfil

class LoginApp(QMainWindow):
    def __init__(self):
        super().__init__()
        self.ui = Ui_Dialog()
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
            self.show_status_window()
        else:
            QMessageBox.warning(self, "Erro", "Usuário ou senha incorretos!")

        cursor.close()
        conn.close()

    def show_status_window(self):
        """Abre a tela de Status"""
        self.status_window = QDialog(self)
        self.status_ui = Ui_StatusWindoW()
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
        self.perfil_ui = Ui_PerfilWindow()
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
            self.perfil_ui.label_username.setText(f"Jogador: {user_data[0]}")
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
