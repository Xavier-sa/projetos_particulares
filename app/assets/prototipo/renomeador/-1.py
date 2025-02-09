import os

# Função para renomear arquivos
def renomear_arquivos(diretorio, prefixo):
    # Listar os arquivos no diretório
    arquivos = os.listdir(diretorio)
    
    # Iterar sobre os arquivos
    for i, arquivo in enumerate(arquivos):
        # Caminho completo do arquivo
        caminho_antigo = os.path.join(diretorio, arquivo)
        
        # Verificar se é um arquivo (ignorar diretórios)
        if os.path.isfile(caminho_antigo):
            # Novo nome para o arquivo
            novo_nome = f"{prefixo}-{i+1}{os.path.splitext(arquivo)[1]}"  # Mantém a extensão do arquivo
            caminho_novo = os.path.join(diretorio, novo_nome)
            
            # Renomear o arquivo
            os.rename(caminho_antigo, caminho_novo)
            print(f"Arquivo renomeado: {arquivo} -> {novo_nome}")

# Defina o diretório e o prefixo desejado
diretorio = "C:/xampp/htdocs/app/assets/prototipo"  # Substitua pelo caminho do seu diretório
prefixo = ""  # Substitua pelo prefixo desejado

# Chamar a função
renomear_arquivos(diretorio, prefixo)
