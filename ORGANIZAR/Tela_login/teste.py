import sys
from PySide6.QtWidgets import QApplication, QWidget, QLabel, QLineEdit, QPushButton, QVBoxLayout, QHBoxLayout, QMessageBox
from PySide6.QtGui import QPixmap
from PySide6.QtCore import Qt
from hashlib import sha256
import mysql.connector

class LoginWindow(QWidget):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("Tela de Login")
        self.setFixedSize(400, 500)  # Aumentar a caixa de fundo
        self.setStyleSheet("background-color: #f0f0f0;")  # Definindo cor de fundo
        layout = QVBoxLayout()

        # Logo
        logo_label = QLabel()
        pixmap = QPixmap("logo.png")  
        logo_label.setPixmap(pixmap)
        logo_label.setAlignment(Qt.AlignCenter)
        layout.addWidget(logo_label)

        # Adicionar título
        h_layout = QHBoxLayout()
        label = QLabel("Login")
        label.setStyleSheet("font-size: 36px; font-weight: bold; color: #333;")
        h_layout.addStretch(12)
        h_layout.addWidget(label)
        h_layout.addStretch(12)
        layout.addLayout(h_layout)

        # Campo de email
        email_label = QLabel("Email:")
        self.email_input = QLineEdit()
        self.email_input.setPlaceholderText("Digite seu email")
        layout.addWidget(email_label)
        layout.addWidget(self.email_input)

        # Campo de senha
        senha_label = QLabel("Senha:")
        self.senha_input = QLineEdit()
        self.senha_input.setPlaceholderText("Digite sua senha")
        self.senha_input.setEchoMode(QLineEdit.Password)
        layout.addWidget(senha_label)
        layout.addWidget(self.senha_input)

        # Botão de login
        login_button = QPushButton("Login")
        login_button.clicked.connect(self.handle_Login)
        layout.addWidget(login_button)

        self.setLayout(layout)

    def conectar_banco(self):
        try:
            conn = mysql.connector.connect(
                host="localhost",
                user="root",
                password="",
                database="login"
            )
            return conn
        except mysql.connector.Error as err:
            QMessageBox.critical(self, "Erro de conexão", f"Erro ao conectar: {err}")
            return None

    def validar_login(self, email, senha):
        conn = self.conectar_banco()
        if conn is None:
            return False

        cursor = conn.cursor()
        senha_hash = sha256(senha.encode()).hexdigest()

        query = "SELECT * FROM login WHERE email = %s AND senha = %s"
        cursor.execute(query, (email, senha_hash))

        result = cursor.fetchone()
        cursor.close()
        conn.close()
        if result:
            return True
        else:
            return False

    def handle_Login(self):
        email = self.email_input.text()
        senha = self.senha_input.text()

        if not email or not senha:  # Verificar se os campos estão vazios
            QMessageBox.warning(self, "Erro", "Por favor, preencha todos os campos.")
            return

        if self.validar_login(email, senha):
            QMessageBox.information(self, "Sucesso", "Login bem-sucedido!")
            self.close()  # Fechar a tela de login
            self.abrir_tela_cadastro()  # Abrir a tela de cadastro
        else:
            QMessageBox.information(self, "Erro", "Email ou senha inválidos.")

    def abrir_tela_cadastro(self):
        self.cadastro_window = CadastroWindow()  # Criar a janela de cadastro
        self.cadastro_window.show()  # Mostrar a janela

class CadastroWindow(QWidget):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("Tela de Cadastro de Personagem")
        layout = QVBoxLayout()

        # Planeta
        planeta_label = QLabel("Planeta:")
        self.planeta_input = QLineEdit()
        self.planeta_input.setPlaceholderText("Digite o nome do planeta")
        layout.addWidget(planeta_label)
        layout.addWidget(self.planeta_input)

        # Raça
        raca_label = QLabel("Raça:")
        self.raca_input = QLineEdit()
        self.raca_input.setPlaceholderText("Digite a raça do personagem")
        layout.addWidget(raca_label)
        layout.addWidget(self.raca_input)

        # Vida
        vida_label = QLabel("Vida:")
        self.vida_input = QLineEdit()
        self.vida_input.setPlaceholderText("Digite o valor da vida")
        layout.addWidget(vida_label)
        layout.addWidget(self.vida_input)

        # Ki
        ki_label = QLabel("Ki:")
        self.ki_input = QLineEdit()
        self.ki_input.setPlaceholderText("Digite o valor de ki")
        layout.addWidget(ki_label)
        layout.addWidget(self.ki_input)

        # Força
        forca_label = QLabel("Força:")
        self.forca_input = QLineEdit()
        self.forca_input.setPlaceholderText("Digite o valor da força")
        layout.addWidget(forca_label)
        layout.addWidget(self.forca_input)

        # Inteligência
        inteligencia_label = QLabel("Inteligência:")
        self.inteligencia_input = QLineEdit()
        self.inteligencia_input.setPlaceholderText("Digite o valor da inteligência")
        layout.addWidget(inteligencia_label)
        layout.addWidget(self.inteligencia_input)

        # Botão de salvar
        save_button = QPushButton("Salvar Cadastro")
        save_button.clicked.connect(self.salvar_cadastro)  # Método para salvar os dados
        layout.addWidget(save_button)

        self.setLayout(layout)

    def salvar_cadastro(self):
        planeta = self.planeta_input.text()
        raca = self.raca_input.text()
        vida = self.vida_input.text()
        ki = self.ki_input.text()
        forca = self.forca_input.text()
        inteligencia = self.inteligencia_input.text()

        # Verificar se todos os campos estão preenchidos
        if not all([planeta, raca, vida, ki, forca, inteligencia]):
            QMessageBox.warning(self, "Erro", "Todos os campos devem ser preenchidos.")
            return

        # Salvar no banco de dados
        try:
            conn = mysql.connector.connect(
                host="localhost",
                user="root",
                password="",
                database="login"
            )
            cursor = conn.cursor()

            # Inserir os dados no banco
            query = """
                INSERT INTO Personagem (planeta, raca, vida, ki, forca, inteligencia)
                VALUES (%s, %s, %s, %s, %s, %s)
            """
            cursor.execute(query, (planeta, raca, vida, ki, forca, inteligencia))
            conn.commit()
            cursor.close()
            conn.close()

            QMessageBox.information(self, "Sucesso", "Cadastro realizado com sucesso!")
            self.close()  # Fechar a janela de cadastro após salvar os dados
        except mysql.connector.Error as err:
            QMessageBox.critical(self, "Erro", f"Erro ao salvar no banco de dados: {err}")
            

if __name__ == "__main__":
    app = QApplication(sys.argv)
    window = LoginWindow()
    window.show()
    sys.exit(app.exec())
