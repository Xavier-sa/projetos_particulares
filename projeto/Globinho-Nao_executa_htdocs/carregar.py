from PySide6.QtWidgets import QApplication, QLabel
from PySide6.QtGui import QPixmap
import sys

app = QApplication(sys.argv)

label = QLabel()
pixmap = QPixmap("logo.PNG")  # Altere para o nome correto do arquivo

if pixmap.isNull():
    print("Erro: Não foi possível carregar a imagem!")
else:
    print("Imagem carregada com sucesso!")
    label.setPixmap(pixmap)

label.show()
sys.exit(app.exec())
