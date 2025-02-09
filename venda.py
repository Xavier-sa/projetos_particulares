import sys
from PySide6.QtWidgets import QApplication, QWidget, QVBoxLayout, QHBoxLayout, QPushButton, QTableWidget, QTableWidgetItem, QLabel, QLineEdit
from PySide6.QtCore import Qt

class AppVendas(QWidget):
    def __init__(self):
        super().__init__()

        self.setWindowTitle("Efetuar Vendas")
        self.setGeometry(100, 100, 800, 600)

        self.total = 0.0

        # Layout principal
        self.layout = QVBoxLayout()

        # Título
        self.titulo_label = QLabel("Efetuar Vendas")
        self.titulo_label.setAlignment(Qt.AlignCenter)
        self.layout.addWidget(self.titulo_label)

        # Barra de pesquisa de produtos
        self.barra_pesquisa = QLineEdit()
        self.barra_pesquisa.setPlaceholderText("Pesquisar produtos...")
        self.layout.addWidget(self.barra_pesquisa)

        # Tabela de produtos
        self.tabela_produtos = QTableWidget()
        self.tabela_produtos.setColumnCount(4)  # Nome do Produto, Quantidade, Preço, Total
        self.tabela_produtos.setHorizontalHeaderLabels(["Produto", "Quantidade", "Preço", "Total"])
        self.layout.addWidget(self.tabela_produtos)

        # Seção de total
        self.total_label = QLabel(f"TOTAL: R$ {self.total:.2f}")
        self.layout.addWidget(self.total_label)

        # Dinheiro recebido
        self.dinheiro_recebido_label = QLabel("Dinheiro Recebido:")
        self.dinheiro_recebido_input = QLineEdit()
        self.dinheiro_recebido_input.setPlaceholderText("Digite o valor recebido")
        self.layout.addWidget(self.dinheiro_recebido_label)
        self.layout.addWidget(self.dinheiro_recebido_input)

        # Label de troco
        self.troco_label = QLabel(f"TROCO: R$ 0.00")
        self.layout.addWidget(self.troco_label)

        # Botões
        self.botoes_layout = QHBoxLayout()

        self.finalizar_button = QPushButton("Finalizar Venda")
        self.finalizar_button.clicked.connect(self.finalizar_venda)
        self.botoes_layout.addWidget(self.finalizar_button)

        self.voltar_button = QPushButton("Voltar")
        self.voltar_button.clicked.connect(self.voltar)
        self.botoes_layout.addWidget(self.voltar_button)

        self.layout.addLayout(self.botoes_layout)

        self.setLayout(self.layout)

    def atualizar_total(self):
        """Calcula o total com base nas quantidades e preços inseridos."""
        self.total = 0
        for row in range(self.tabela_produtos.rowCount()):
            quantidade_item = self.tabela_produtos.item(row, 1)
            preco_item = self.tabela_produtos.item(row, 2)

            if quantidade_item and preco_item:
                quantidade = int(quantidade_item.text())
                preco = float(preco_item.text().replace('R$', '').replace(',', '.'))
                total_item = quantidade * preco

                # Atualiza a célula Total
                self.tabela_produtos.setItem(row, 3, QTableWidgetItem(f"R$ {total_item:,.2f}"))

                # Atualiza o total geral
                self.total += total_item

        self.total_label.setText(f"TOTAL: R$ {self.total:,.2f}")

        # Atualiza o troco
        if self.dinheiro_recebido_input.text():
            dinheiro_recebido = float(self.dinheiro_recebido_input.text().replace(',', '.'))
            troco = dinheiro_recebido - self.total
            self.troco_label.setText(f"TROCO: R$ {troco:,.2f}")
        else:
            self.troco_label.setText("TROCO: R$ 0.00")

    def finalizar_venda(self):
        """Finaliza a venda e exibe o total."""
        # Aqui você pode adicionar o código para salvar a venda no banco de dados
        print("Venda finalizada")
        print(f"Total: R$ {self.total:,.2f}")

    def voltar(self):
        """Volta para a tela anterior."""
        print("Voltando para a tela anterior")

def main():
    app = QApplication(sys.argv)
    janela = AppVendas()
    janela.show()
    sys.exit(app.exec())

if __name__ == "__main__":
    main()
