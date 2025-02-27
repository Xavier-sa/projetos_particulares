class ContaBancaria:
    def __init__(self, titular, saldo):
        self.titular = titular
        self.saldo = saldo

class SistemaBancario:
    def __init__(self):
        # Inicializa a lista de contas
        self.contas = []

    def criar_conta(self, titular, saldo):
        # Cria uma nova conta e adiciona à lista de contas
        nova_conta = ContaBancaria(titular, saldo)
        self.contas.append(nova_conta)

    def listar_contas(self):
        # Lista todas as contas no formato "Titular: R$ Saldo, Titular: R$ Saldo, ..."
        contas_formatadas = [f"{conta.titular}: R$ {conta.saldo}" for conta in self.contas]
        print(", ".join(contas_formatadas))

# Cria uma instância de SistemaBancario
sistema = SistemaBancario()

# Loop para ler as entradas do usuário
while True:
    entrada = input().strip()
    if entrada.upper() == "FIM":  # Encerra o loop ao digitar "FIM"
        break
    # Divide a entrada em titular e saldo
    titular, saldo = entrada.split(", ")
    sistema.criar_conta(titular, int(saldo))  # Cria a conta com os dados fornecidos

# Lista todas as contas cadastradas
sistema.listar_contas()