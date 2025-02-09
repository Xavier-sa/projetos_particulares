<?php

class Venda {
    private $conn;
    private $table = 'vendas';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para inserir a venda
    public function insertVenda($usuario_id, $produtosVenda, $total, $data_venda, $cliente_id = null) {
        // Verificar se os produtos existem na tabela produtos
        foreach ($produtosVenda as $produto) {
            $queryProduto = "SELECT id FROM produtos WHERE id = ?";
            $stmtProduto = $this->conn->prepare($queryProduto);
            $stmtProduto->execute([$produto['id']]);

            if ($stmtProduto->rowCount() == 0) {
                throw new Exception("Produto com ID {$produto['id']} não encontrado.");
            }
        }

        // Iniciar a transação
        $this->conn->beginTransaction();

        try {
            // Inserir a venda
            $queryVenda = "INSERT INTO " . $this->table . " (usuario_id, cliente_id, total, data_venda) VALUES (?, ?, ?, ?)";
            $stmtVenda = $this->conn->prepare($queryVenda);
            $stmtVenda->execute([$usuario_id, $cliente_id, $total, $data_venda]);

            // Obter o ID da venda inserida
            $venda_id = $this->conn->lastInsertId();

            // Inserir os produtos da venda
            $queryProdutoVenda = "INSERT INTO venda_produtos (venda_id, produto_id, quantidade, preco) VALUES (?, ?, ?, ?)";
            $stmtProdutoVenda = $this->conn->prepare($queryProdutoVenda);

            foreach ($produtosVenda as $produto) {
                $stmtProdutoVenda->execute([$venda_id, $produto['id'], $produto['quantidade'], $produto['preco']]);
            }

            // Confirmar a transação
            $this->conn->commit();

        } catch (Exception $e) {
            // Caso ocorra um erro, desfazer a transação
            $this->conn->rollBack();
            throw new Exception("Erro ao processar a venda: " . $e->getMessage());
        }
    }
}

