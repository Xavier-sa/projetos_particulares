from PySide6.QtWidgets import *
from PySide6.QtCore import QSize


class Youwindow(QMainWindow):
    def __init__(self):
        super().__init__()

        self. setFixedSize(QSize(400, 200))
        self.horizontal = QHBoxLayout()

        self.label1 = QLabel("Hello World")
        self.button1 = QPushButton("Click ")
        self.button2 = QPushButton("Click Me")
        self.button3 = QPushButton("Click Please")

        container = QWidget()
        container.setLayout(self.horizontal)

        self.setCentralWidget(container)


app=QApplication([])
window=Youwindow()  
window.show()
app.exec_()