from PySide6.QtWidgets import QApplication, QDialog
from PySide6.QtCore import Qt
from PySide6.QtWidgets import QMessageBox
from PySide6.QtGui import QIcon
from ui_login import Ui_Login
from conexao import connect_db

class Login(QDialog):
    def __init__(self):
        super().__init__()
        self.ui = Ui_Login()  # Cria uma instância da UI gerada
        self.ui.setupUi(self)  # Configura a UI dentro do diálogo

        # Conecta o botão de login ao método de validação
        self.ui.btn_login.clicked.connect(self.handle_login)

    def handle_login(self):
        # Pega os valores dos campos de usuário e senha
        usuario = self.ui.lineEdit_user.text()
        senha = self.ui.lineEdit_password.text()

        # Conecta ao banco de dados
        conn = connect_db()
        if conn:
            cursor = conn.cursor()
            query = "SELECT * FROM users WHERE usuario = %s AND senha = %s"
            cursor.execute(query, (usuario, senha))
            result = cursor.fetchone()
            cursor.close()
            conn.close()

            if result:
                # Se o login for bem-sucedido, exibe uma mensagem de sucesso
                QMessageBox.information(self, "Sucesso", "Login realizado com sucesso!")
                self.accept()  # Fecha a janela de login (opcional, dependendo da sua lógica)
            else:
                # Se o login falhar, exibe uma mensagem de erro
                QMessageBox.warning(self, "Erro", "Usuário ou senha incorretos!")





    





if __name__ == "__main__":
    app = QApplication([])  # Cria uma instância do aplicativo Qt
    login = Login()  # Cria a instância da classe Login
    login.show()  # Exibe a janela
    app.exec()  # Executa o loop de eventos do Qt
