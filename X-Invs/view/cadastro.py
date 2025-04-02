from PySide6.QtWidgets import QMainWindow
from view.ui.ui_cadastro import Ui_CadastroWindow  # Importe a classe correta
from PySide6.QtGui import QIcon
from PySide6.QtCore import Qt

class CadastroView(QMainWindow, Ui_CadastroWindow):
    def __init__(self):
        super().__init__()
        self.setupUi(self)  # Configura a interface
        self.setWindowTitle("Cadastro")  # Define o título da janela
        self.resize(400, 586)  # Define o tamanho da janela
        self.setWindowFlags(Qt.WindowCloseButtonHint) 
        self.setWindowIcon(QIcon("view/images/icon.PNG"))  # Caminho para o ícone