from PySide6.QtWidgets import QApplication, QDialog, QMessageBox
from PySide6.QtGui import QIcon
from ui_login import Ui_Login
from conexao import connect_db
from cadastro import Cadastro  # Importe a classe Cadastro

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
            query = "SELECT id FROM users WHERE username = %s AND password = %s"
            cursor.execute(query, (usuario, senha))
            result = cursor.fetchone()
            cursor.close()
            conn.close()

            if result:
                user_id = result[0]  # Obtém o ID do usuário logado
                QMessageBox.information(self, "Sucesso", "Login realizado com sucesso!")
                self.accept()  # Fecha a janela de login

                # Abre a janela de cadastro com o user_id
                self.cadastro = Cadastro()
                self.cadastro.abrir_janela_cadastro(user_id)
            else:
                # Se o login falhar, exibe uma mensagem de erro
                QMessageBox.warning(self, "Erro", "Usuário ou senha incorretos!")

if __name__ == "__main__":
    app = QApplication([])  # Aqui abre o Qt
    login = Login()         # Aqui chama a classe Login
    login.setWindowIcon(QIcon("images/icon.PNG"))  # Aqui define o ícone da janela
    login.show()            # Aqui mostra a janela
    app.exec()              # Aqui executa o Qt