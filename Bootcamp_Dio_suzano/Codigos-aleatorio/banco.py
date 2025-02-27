''' 
Para ler e escrever dados em Python, utilizamos as seguintes funções: 
- input: lê UMA linha com dado(s) de Entrada do usuário;
- print: imprime um texto de Saída (Output), pulando linha.  
'''

class ContaBancaria:
    def __init__(self, titular):
        # Inicializa a conta com o nome do titular, saldo 0 e uma lista de operações
        self.titular = titular
        self.saldo = 0
        self.operacoes = []

    def depositar(self, valor):
        # Adiciona o valor ao saldo e registra a operação
        self.saldo += valor
        self.operacoes.append(f"+{valor}")

    def sacar(self, valor):
        # Verifica se há saldo suficiente para o saque
        if self.saldo >= abs(valor):
            # Subtrai o valor do saldo e registra a operação
            self.saldo -= abs(valor)
            self.operacoes.append(f"{valor}")
        else:
            # Se não houver saldo suficiente, registra a operação como "Saque não permitido"
            self.operacoes.append("Saque não permitido")

    def extrato(self):
        # Exibe as operações realizadas e o saldo final no formato correto
        operacoes_str = ", ".join(self.operacoes)
        print(f"Operações: {operacoes_str}; Saldo: {self.saldo}")


# Leitura do nome do titular
nome_titular = input().strip()

# Criação da conta bancária
conta = ContaBancaria(nome_titular)

# Leitura das transações (depósitos e saques)
entrada_transacoes = input().strip()
transacoes = [int(valor) for valor in entrada_transacoes.split(",")]

# Realiza as transações (depósitos e saques)
for valor in transacoes:
    if valor > 0:
        conta.depositar(valor)
    else:
        conta.sacar(valor)

# Exibe o extrato final da conta
conta.extrato()
