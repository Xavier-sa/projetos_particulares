from PySide6.QtWidgets import (
    QMainWindow, QVBoxLayout, QLabel, QWidget, QPushButton
)
from PySide6.QtGui import QIcon
class PerfilWindow(QMainWindow):
    def __init__(self, user_id, username, user_data):
        super().__init__()
        self.user_id = user_id
        self.username = username
        self.user_data = user_data

        self.setWindowTitle("Perfil do Usuário")
        self.setGeometry(100, 100, 400, 500)


        self.setWindowIcon(QIcon("images/icon.png"))  # Altere o caminho para o seu ícone

        # Widget central
        self.widget = QWidget()
        self.setCentralWidget(self.widget)

        # self.setWindowIcon(QIcon("images/icon.png"))

        # Layout principal
        layout = QVBoxLayout()

        # Exibir o nome do usuário
        self.label_nome = QLabel(f"Bem-vindo, {self.username}!")
        layout.addWidget(self.label_nome)

        # Exibir as informações cadastradas
        self.label_salario = QLabel(f"Salário: {self.user_data['salario']} ")
        self.label_despesa = QLabel(f"Despesa: {self.user_data['despesa']}")
        self.label_investimentos = QLabel(f"Investimentos: {self.user_data['investimentos']}")
        self.label_rendaextra = QLabel(f"Renda Extra: {self.user_data['rendaextra']}")
        self.label_veiculos = QLabel(f"Veículos: {self.user_data['veiculos']}")
        self.label_gasolina = QLabel(f"Gasolina: {self.user_data['gasolina']}")
        self.label_cursos = QLabel(f"Cursos: {self.user_data['cursos']}")

      

        layout.addWidget(self.label_salario)
        layout.addWidget(self.label_despesa)
        layout.addWidget(self.label_investimentos)
        layout.addWidget(self.label_rendaextra)
        layout.addWidget(self.label_veiculos)
        layout.addWidget(self.label_gasolina)
        layout.addWidget(self.label_cursos)

        # Botão para fechar a tela
        self.btn_fechar = QPushButton("Fechar")
        self.btn_fechar.clicked.connect(self.close)
        layout.addWidget(self.btn_fechar)

        # Definir o layout no widget
        self.widget.setLayout(layout)




