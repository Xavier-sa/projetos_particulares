class Produto:
    def __init__(self, nome, preco, estoque):
        self.nome = nome
        self.preco = preco
        self.estoque = estoque

    def __str__(self):
        return f"{self.nome} (R$ {self.preco:.2f}) - {self.estoque} unidades em estoque"

class Carrinho:
    def __init__(self):
        self.itens = []

    def adicionar_item(self, produto, quantidade):
        if produto.estoque >= quantidade:
            self.itens.append({"produto": produto, "quantidade": quantidade})
            produto.estoque -= quantidade
            print(f"{quantidade}x {produto.nome} adicionado(s) ao carrinho.")
        else:
            print(f"Estoque insuficiente para {produto.nome}.")

    def calcular_total(self):
        total = sum(item["produto"].preco * item["quantidade"] for item in self.itens)
        return total

    def listar_itens(self):
        if not self.itens:
            print("O carrinho está vazio.")
        else:
            print("Itens no carrinho:")
            for item in self.itens:
                print(f"{item['quantidade']}x {item['produto'].nome} - R$ {item['produto'].preco * item['quantidade']:.2f}")
            print(f"Total: R$ {self.calcular_total():.2f}")

class Ecommerce:
    def __init__(self):
        self.catalogo = []
        self.carrinho = Carrinho()

    def adicionar_produto(self, nome, preco, estoque):
        produto = Produto(nome, preco, estoque)
        self.catalogo.append(produto)
        print(f"Produto '{nome}' adicionado ao catálogo.")

    def listar_produtos(self):
        if not self.catalogo:
            print("Nenhum produto disponível no catálogo.")
        else:
            print("Catálogo de Produtos:")
            for produto in self.catalogo:
                print(produto)

    def menu(self):
        while True:
            print("\n=== Menu do E-commerce ===")
            print("1. Listar Produtos")
            print("2. Adicionar Produto ao Carrinho")
            print("3. Ver Carrinho")
            print("4. Finalizar Compra")
            print("5. Sair")
            opcao = input("Escolha uma opção: ")

            if opcao == "1":
                self.listar_produtos()
            elif opcao == "2":
                self.listar_produtos()
                nome_produto = input("Digite o nome do produto: ")
                quantidade = int(input("Digite a quantidade: "))
                produto = next((p for p in self.catalogo if p.nome == nome_produto), None)
                if produto:
                    self.carrinho.adicionar_item(produto, quantidade)
                else:
                    print("Produto não encontrado.")
            elif opcao == "3":
                self.carrinho.listar_itens()
            elif opcao == "4":
                total = self.carrinho.calcular_total()
                if total > 0:
                    print(f"Compra finalizada! Total: R$ {total:.2f}")
                    self.carrinho = Carrinho()  # Limpa o carrinho após a compra
                else:
                    print("O carrinho está vazio.")
            elif opcao == "5":
                print("Saindo...")
                break
            else:
                print("Opção inválida. Tente novamente.")

# Inicialização do E-commerce
if __name__ == "__main__":
    loja = Ecommerce()

    # Adicionando alguns produtos ao catálogo
    loja.adicionar_produto("Camiseta", 49.90, 10)
    loja.adicionar_produto("Calça Jeans", 99.90, 5)
    loja.adicionar_produto("Tênis", 199.90, 3)

    # Iniciando o menu interativo
    loja.menu()