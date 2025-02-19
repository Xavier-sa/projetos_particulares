menu =  """

[d] Depositar
[s] Sacar
[e] Extrato
[q] Sair

=> """


saldo = 0
limite = 500
extrato = ""
numero_saques = 0
LIMITE_SAQUES = 3

while True:
    opcao = input(menu)
    
    if opcao == "d":
        valor = float (input("Informe o valor do deposito: "))
        
        if valor > 0 :
            saldo += valor
            extrato += f"Deposito: R$ {valor:.2f}\n"

        else :
            print("Operação Falhou! O valor informado é invalido.")

    elif opcao == "s":
        valor = float(input("Informe o valor do saque: "))
        excedeu_saldo = valor > saldo
        excedeu_limite = valor > limite
        excedeu_saques = numero_saques >= LIMITE_SAQUES

        if excedeu_saldo:
            print("Operação Falhou! Você nao tem  saldo suficiente.") 

        elif excedeu_limite:
            print("Operação Falhou! O valor do saque excede  o limite . ")
        
        elif excedeu_saques:
            print("Operacao Falhou! Número maximo de saques excedido.")
        
        elif valor > 0:
            saldo -= valor
            extrato += f"Saque: R$ {valor:.2f}\n"
            numero_saques += 1
       
        else:
            print("Operação Falhou! O valor informado é invalido")


    elif opcao == "e":
        eX_menu = "EXTRATO"
        print("=".join(eX_menu).center(20,"="))
        print("Não foram realizadas movimentacoes." if not extrato else extrato)
        print(f"\nSaldo: R$ {saldo:.2f}")
        print(f"{'='*20}")
    
    elif opcao == "q":
        break


    else:
        print("Operação invalida, por favor selecione novamente a operacao desejada.")
