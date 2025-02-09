<?php
// Inicia a sessão para acessar as variáveis de sessão
session_start();

// Verifica se o usuário está autenticado (se o 'usuario_id' existe na sessão)
if (!isset($_SESSION['usuario_id'])) {
    // Redireciona para a página de login se o usuário não estiver autenticado
    header('Location: login.php');
    exit();
}

// Inclui as configurações do banco de dados e o modelo de Venda
require_once '../../config/Database.php';
require_once '../../model/Venda.php';  // Supondo que você tenha uma classe para Vendas

// Recupera o id da venda passada pela URL ou variável de sessão
$vendaId = isset($_GET['venda_id']) ? $_GET['venda_id'] : null;

if ($vendaId) {
    // Obtemos os detalhes da venda a partir do banco
    $vendaModel = new Venda($conn);
    $venda = $vendaModel->findVendaById($vendaId); // Este método deve buscar uma venda no banco
} else {
    // Se não houver uma venda identificada, redireciona
    header('Location: tela_vendas.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venda Concluída</title>
    <link rel="icon" href="../../assets/img/xavi.JPG" type="image/jpg">
    <style>
        /* Estilos para a página de venda concluída */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .conteudo-venda-concluida {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }

        .conteudo-venda-concluida h2 {
            color: #28a745;
            font-size: 2rem;
        }

        .conteudo-venda-concluida p {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .btn-voltar {
            background-color: #007bff;
            color: white;
            padding: 15px 30px;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-voltar:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="conteudo-venda-concluida">
        <h2>Venda Concluída!</h2>

        <p><strong>Data da Venda:</strong> <?php echo date('d/m/Y H:i:s', strtotime($venda->data_venda)); ?></p>
        <p><strong>Total da Venda:</strong> R$ <?php echo number_format($venda->total, 2, ',', '.'); ?></p>
        <p><strong>Cliente:</strong> <?php echo $venda->cliente_nome; ?></p>

        <a href="tela_vendas.php" class="btn-voltar">Voltar para Vendas</a>
    </div>

</body>
</html>
