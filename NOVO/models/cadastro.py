from PySide6.QtWidgets import QApplication, QMainWindow, QMessageBox, QDialog
from PySide6.QtGui import QIcon
from conexao import connect_db
from ui_cadastro import Ui_CadastroWindow



class CadastroWindow(QMainWindow, Ui_CadastroWindow):
    def __init__(self, user_id):
        super().__init__()
        self.setupUi(self)
        self.user_id = user_id  # Armazena o ID do usuário logado
        self.cadastrar_btn.clicked.connect(self.handle_cadastro)

    def handle_cadastro(self):
        # Coletar dados dos campos de entrada
        salario = self.salario.text()
        despesa = self.despesa.text()
        investimentos = self.investimentos.text()
        rendaextra = self.rendaextra.text()
        veiculos = self.veiculos.text()
        gasolina = self.gasolina.text()
        cursos = self.cursos.text()

        # Validar se todos os campos foram preenchidos e são números
        try:
            salario = int(salario)
            despesa = int(despesa)
            investimentos = int(investimentos)
            rendaextra = int(rendaextra)
            veiculos = int(veiculos)
            gasolina = int(gasolina)
            cursos = int(cursos)
        except ValueError:
            QMessageBox.warning(self, "Erro", "Todos os campos devem ser números inteiros!")
            return

        # Conectar ao banco de dados
        conn = connect_db()
        if conn:
            try:
                cursor = conn.cursor()
                query = """
                INSERT INTO cadastro (user_id, salario, despesa, investimentos, rendaextra, veiculos, gasolina, cursos)
                VALUES (%s, %s, %s, %s, %s, %s, %s, %s)
                """
                cursor.execute(query, (
                    self.user_id, salario, despesa, investimentos, rendaextra, veiculos, gasolina, cursos
                ))
                conn.commit()
                cursor.close()
                conn.close()

                QMessageBox.information(self, "Sucesso", "Cadastro realizado com sucesso!")
                # self.close()  # Fecha a janela de cadastro após o sucesso

                

                
                
                

                
            except Exception as e:
                QMessageBox.critical(self, "Erro", f"Erro ao cadastrar dados: {str(e)}")
        else:
            QMessageBox.critical(self, "Erro", "Não foi possível conectar ao banco de dados.")

class Cadastro(QDialog):
    def abrir_janela_cadastro(self, user_id):
        self.cadastro_window = CadastroWindow(user_id)
        self.cadastro_window.setWindowIcon(QIcon("images/icon.png"))
        self.cadastro_window.show()

# if __name__ == "__main__":
#     app = QApplication([])
#     cadastro = Cadastro()
#     cadastro.abrir_janela_cadastro(user_id=1)  # Exemplo: ID do usuário logado
#     app.exec()