<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root"; // ou o nome do seu usuário
$password = "";     // ou a senha do seu usuário
$dbname = "sistema_vendas"; // nome do banco de dados correto

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Inserção no banco de dados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantidade = $_POST['quantidade'];
    $produto_id = $_POST['produto_id'];
    $preco = $_POST['preco'];
    $data = $_POST['data'];
    $nome_cliente = $_POST['nome_cliente']; // Nome do cliente

    // Obter o nome do produto
    $sql_produto = "SELECT nome FROM produtos WHERE id = $produto_id";
    $result_produto = $conn->query($sql_produto);
    $produto_nome = '';
    if ($result_produto->num_rows > 0) {
        $row = $result_produto->fetch_assoc();
        $produto_nome = $row['nome'];
    }

    // Inserção no banco de dados para cada produto
    $sql = "INSERT INTO fiado (quantidade, produto_nome, preco, data, nome_cliente, status_pagamento)
            VALUES ('$quantidade', '$produto_nome', '$preco', '$data', '$nome_cliente', 'pendente')";

    if ($conn->query($sql) === TRUE) {
        echo "Produto registrado no fiado com sucesso!<br>";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Compras a Prazo (Fiado)</title>
</head>
<body>
    <h1>Cadastro de Compras a Prazo (Fiado)</h1>
    <form action="" method="POST">
        <label for="nome_cliente">Nome do Cliente:</label>
        <input type="text" name="nome_cliente" required><br><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" required><br><br>

        <label for="produto_id">Produto:</label>
        <select name="produto_id" required>
            <option value="">Selecione um produto</option>
            <?php
            // Listar produtos cadastrados no banco
            $sql_produtos = "SELECT * FROM produtos";
            $result_produtos = $conn->query($sql_produtos);

            if ($result_produtos->num_rows > 0) {
                while($row = $result_produtos->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nome'] . " - R$ " . number_format($row['preco'], 2, ',', '.') . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum produto disponível</option>";
            }
            ?>
        </select><br><br>

        <label for="preco">Preço:</label>
        <input type="number" step="0.01" name="preco" required><br><br>

        <label for="data">Data da Compra:</label>
        <input type="date" name="data" required><br><br>

        <button type="submit">Adicionar Produto ao Fiado</button>
    </form>

    <hr>

    <h2>Compras a Prazo (Fiado) Registradas</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Total</th> <!-- Exibir o total calculado -->
                <th>Data</th>
                <th>Nome do Cliente</th>
                <th>Status de Pagamento</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_geral = 0; // Inicializa o total geral para somar os totais

            // Exibir lista de compras a prazo registradas
            $sql_fiado = "SELECT * FROM fiado";
            $result_fiado = $conn->query($sql_fiado);

            if ($result_fiado->num_rows > 0) {
                while($row = $result_fiado->fetch_assoc()) {
                    // Calculando o total por linha (quantidade * preço)
                    $total = $row['quantidade'] * $row['preco'];
                    $total_geral += $total; // Soma ao total geral

                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['produto_nome'] . "</td>
                            <td>" . $row['quantidade'] . "</td>
                            <td>R$ " . number_format($total, 2, ',', '.') . "</td>
                            <td>" . $row['data'] . "</td>
                            <td>" . $row['nome_cliente'] . "</td>
                            <td>" . $row['status_pagamento'] . "</td>
                          </tr>";
                }

                // Exibindo o total geral na última linha da tabela
                echo "<tr>
                        <td colspan='6'><strong>Total Geral</strong></td>
                        <td><strong>R$ " . number_format($total_geral, 2, ',', '.') . "</strong></td>
                      </tr>";

            } else {
                echo "<tr><td colspan='7'>Nenhuma compra registrada</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
