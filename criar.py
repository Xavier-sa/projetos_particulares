import os

# Função para criar as pastas e arquivos
def criar_estrutura():
    # Estrutura de diretórios
    estrutura = {
        'dbz_rpg_project': {
            'backend': ['app.py', 'models.py', 'database.py'],
            'frontend': ['index.html', 'style.css', 'script.js'],
            'requirements.txt': None
        }
    }

    # Caminho base
    base_path = '.'

    # Função recursiva para criar pastas e arquivos
    def criar_pastas_e_arquivos(caminho, estrutura):
        for chave, valor in estrutura.items():
            novo_caminho = os.path.join(caminho, chave)
            if isinstance(valor, list):  # Se for uma lista, significa que são arquivos
                os.makedirs(novo_caminho, exist_ok=True)
                for arquivo in valor:
                    caminho_arquivo = os.path.join(novo_caminho, arquivo)
                    with open(caminho_arquivo, 'w') as f:
                        pass  # Cria o arquivo vazio
            elif valor is None:  # Se for None, significa que é um arquivo no nível atual
                with open(novo_caminho, 'w') as f:
                    pass  # Cria o arquivo vazio

    # Cria a estrutura a partir do diretório raiz
    for chave, valor in estrutura.items():
        caminho_raiz = os.path.join(base_path, chave)
        os.makedirs(caminho_raiz, exist_ok=True)
        criar_pastas_e_arquivos(caminho_raiz, {k: v for k, v in estrutura.items() if k == chave})

    print("Estrutura de pastas e arquivos criada com sucesso!")

# Chama a função para criar a estrutura
criar_estrutura()
