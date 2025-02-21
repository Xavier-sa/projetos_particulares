from PySide6.QtWidgets import QDialog
from perfil import Ui_Dialog  # Importa a interface gerada pelo Qt Designer

class PerfilWindow(QDialog):
    def __init__(self, nome_usuario, life, ki, forca):
        super().__init__()
        self.ui = Ui_Dialog()  # Instancia a interface do perfil
        self.ui.setupUi(self)  # Configura a interface na janela

        # Atualiza as labels com os dados do usuário
        self.ui.label.setText(f"Usuário: {nome_usuario}")
        self.ui.label_life.setText(f"Life: {life}")
        self.ui.label_ki.setText(f"Ki: {ki}")
        self.ui.label_4.setText(f"Força: {forca}")

        # Botão para fechar a janela e voltar
        self.ui.pushButton.clicked.connect(self.close)
