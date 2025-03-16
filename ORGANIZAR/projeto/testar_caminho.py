import os

caminho_imagem = "./logo.JPG"  # Substitua pelo nome do seu arquivo

if os.path.exists(caminho_imagem):
    print("Imagem encontrada!")
else:
    print("Imagem NÃO encontrada! Verifique o caminho.")
