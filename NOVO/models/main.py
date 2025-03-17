import sys
from PySide6.QtWidgets import QApplication, QMessageBox
from PySide6.QtGui import QIcon
from login import Login
from cadastro import Cadastro

def abrir_login():
    """Função para abrir a janela de login."""
    login_window = Login()
    login_window.setWindowIcon(QIcon("images/icon.PNG"))
    login_window.show()
    return login_window

def main():
    # Cria a aplicação
    app = QApplication(sys.argv)

    # Abre a janela de login inicialmente
    login_window = abrir_login()

    # Função para abrir a janela de cadastro após login bem-sucedido
    def abrir_cadastro(user_id):
        # Fecha a janela de login
        login_window.close()

        # Abre a janela de cadastro
        cadastro = Cadastro()
        cadastro_window = cadastro.abrir_janela_cadastro(user_id)
        
        # Após a janela de cadastro ser fechada, abrir o login novamente
        cadastro_window.destroyed.connect(voltar_login)  # Conecta o fechamento da janela de cadastro
        
        return cadastro_window

    def voltar_login():
        """Função que volta para a tela de login após o cadastro."""
        # Abre a janela de login novamente
        login_window = abrir_login()

    # Executa a aplicação
    sys.exit(app.exec())

if __name__ == "__main__":
    main()
