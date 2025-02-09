<?php
// Incluir configurações e o modelo Produto
require_once '../../config/Database.php';
require_once '../../model/Produto.php';

$produtoModel = new Produto($conn);  // Conexão deve ser fora do IF

// Verifica se o ID foi passado na URL e é válido
if (isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Carrega os dados do produto com base no ID
    $produto = $produtoModel->findById($id);

    // Verifica se o produto foi encontrado
    if (!$produto) {
        header("Location: listar.php?mensagem=erro");
        exit;
    }
} else {
    header("Location: listar.php?mensagem=erro");
    exit;
}

// Verifica se o formulário foi enviado para atualizar o produto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitização dos dados
    $nome = htmlspecialchars($_POST['nome']);
    $descricao = htmlspecialchars($_POST['descricao']);
    $preco = (float)$_POST['preco'];
    $imagem_url = htmlspecialchars($_POST['imagem_url']);

    // Atualiza os dados no modelo Produto
    $produtoModel->id = $_POST['id'];
    $produtoModel->nome = $nome;
    $produtoModel->descricao = $descricao;
    $produtoModel->preco = $preco;
    $produtoModel->imagem_url = $imagem_url;
    
    // Realiza a atualização no banco de dados
    if ($produtoModel->editar()) {
        header("Location: listar.php?mensagem=sucesso");
        exit;
    } else {
        echo "Erro ao atualizar produto. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:  #121212;
            padding: 20px;
        }
        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1rem;
        }
        button:hover {
            background-color: #0056b3;
        }
        .home-link {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: #007bff;
            font-size: 1.1rem;
            margin-top: 20px;
        }
        .home-link i {
            margin-right: 8px;
        }
        .sucesso {
            color: green;
            font-size: 1.2rem;
        }
        .erro {
            color: red;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

    <h1>Editar Produto</h1>

    <!-- Verifica se há mensagens de sucesso ou erro -->
    <?php if (isset($_GET['mensagem'])): ?>
        <p class="<?= $_GET['mensagem'] == 'sucesso' ? 'sucesso' : 'erro' ?>">
            <?= $_GET['mensagem'] == 'sucesso' ? 'Produto atualizado com sucesso!' : 'Ocorreu um erro. Tente novamente.' ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="editar_produto.php">
        <input type="hidden" name="id" value="<?php echo $produto->id; ?>">

        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $produto->nome; ?>" required>

        <label for="preco">Preço do Produto:</label>
        <input type="number" step="0.01" id="preco" name="preco" value="<?php echo $produto->preco; ?>" required>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="4" required><?php echo $produto->descricao; ?></textarea>

        <label for="imagem_url">URL da Imagem:</label>
        <input type="text" id="imagem_url" name="imagem_url" value="<?php echo $produto->imagem_url; ?>" required>

        <button type="submit">Atualizar</button>

        <a href="listar_produto.php" class="home-link">
            <i class="bi bi-house-door"></i> Voltar para a Lista
        </a>
    </form>

</body>
</html>
