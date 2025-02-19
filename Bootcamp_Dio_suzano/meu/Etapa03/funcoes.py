funcao = "Bloco de codigo,  que tem um nome , identifacador da funcao , tenho 5 linhas dou um nome que seria a funcao"
nome = input(str("Diga seu nome:\n"))

def exibir_mensagem():
    print("Hello World!")

def exibir_mensagem_2(nome):
    print(f"Seja Bem Vindo {nome}")


def exibir_mensagem_3(nome = "Anônimo"):
    print(f"Seja Bem Vindo {nome}")



exibir_mensagem()
exibir_mensagem_2(nome=" XAVIER")
exibir_mensagem_3()
exibir_mensagem_3
exibir_mensagem_3(nome="Chappie")