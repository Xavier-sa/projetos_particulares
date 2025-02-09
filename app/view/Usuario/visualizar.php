<?php
session_start();  // Inicia a sessão para acessar as variáveis de sessão

// Inclui as configurações do banco de dados e o modelo de Venda
require_once '../../config/Database.php';
require_once '../../model/Usuario.php';
require_once '../../model/Venda.php';  // Supondo que você tenha uma classe Venda

$usuarioModel = new Usuario($conn);

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo "Você precisa estar logado para acessar esta página.";
    exit;
}

// Atribui os dados da sessão às propriedades do objeto $usuarioModel
$usuarioModel->nome = $_SESSION['usuario_nome'];
$usuarioId = $_SESSION['usuario_id'];

// Instancia o modelo de Venda para buscar as vendas do usuário
$vendaModel = new Venda($conn);
$vendas = $vendaModel->getVendasPorUsuario($usuarioId);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Usuário</title>
    <style>
        /* Estilo básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            line-height: 1.6;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        h3 {
            text-align: center;
            color: black;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .card {
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            font-size: 1.8em;
            margin-bottom: 10px;
            color: #444;
        }

        .card p {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #666;
        }

        /* Estilo da lista de vendas */
        .vendas {
            margin-top: 20px;
            font-size: 1.1em;
        }

        .vendas table {
            width: 100%;
            border-collapse: collapse;
        }

        .vendas table, .vendas th, .vendas td {
            border: 1px solid #ddd;
        }

        .vendas th, .vendas td {
            padding: 10px;
            text-align: left;
        }

        .vendas th {
            background-color: #f4f7fc;
        }

    </style>
</head>
<body>
    <h1>Dados do Usuário</h1>
    
    <div class="card">
        <h3>Nome: <?php echo htmlspecialchars($usuarioModel->nome); ?></h3>

        <h3>Vendas Realizadas:</h3>

        <!-- Exibe a lista de vendas -->
        <div class="vendas">
            <?php if (count($vendas) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor Total</th>
                            <th>Data da Venda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vendas as $venda): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($venda['produto_nome']); ?></td>
                                <td><?php echo htmlspecialchars($venda['quantidade']); ?></td>
                                <td>R$ <?php echo number_format($venda['valor_total'], 2, ',', '.'); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($venda['data_venda'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Você ainda não realizou nenhuma venda.</p>
            <?php endif; ?>
        </div>

        <a href="../Produto/listar_produtos.php">Início</a> |
        <a href="editar.php">Editar Informações</a> | 
        <a href="logout.php" class="logout">Sair</a>
    </div>
</body>
</html>
