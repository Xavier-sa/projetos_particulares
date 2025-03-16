import os

def criar_estrutura_projeto():
    # Definindo a estrutura do projeto
    diretorios = [
        'projeto-globinho/images', 
        'projeto-globinho/ui', 
        'projeto-globinho/model', 
        'projeto-globinho/view', 
        'projeto-globinho/controller'
    ]
    
    # Criando as pastas
    for diretorio in diretorios:
        os.makedirs(diretorio, exist_ok=True)
        print(f'Pasta criada: {diretorio}')

    # Criando o arquivo main.py
    with open('projeto-globinho/main.py', 'w') as f:
        f.write('''import sys
from PySide6.QtWidgets import QApplication
from view.tela1_view import Tela1View
from model.usuario_model import UsuarioModel
from controller.tela1_controller import Tela1Controller

if __name__ == "__main__":
    app = QApplication(sys.argv)
    
    # Criar a model
    model = UsuarioModel()
    
    # Criar a view
    view = Tela1View()
    
    # Criar o controller
    controller = Tela1Controller(view, model)
    
    view.show()
    sys.exit(app.exec())
''')
    print('Arquivo main.py criado')

    # Criando o arquivo requirements.txt
    with open('projeto-globinho/requirements.txt', 'w') as f:
        f.write('''PySide6
''')
    print('Arquivo requirements.txt criado')

# Chamar a função para criar a estrutura
criar_estrutura_projeto()
