from login import Login
from PySide6.QtWidgets import QApplication, QMessageBox


def voltar_login(self):
        self.close()
        login = Login()
        login.show()