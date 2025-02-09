<?php
// Inclui as configurações do banco de dados e o modelo de Produto
require __DIR__ . "\..\..\Config\Database.php";
require __DIR__ . "\..\..\Model\Produto.php";  // Supondo que a classe Produto exista

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    // $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $imagem_url = $_POST['imagem_url'];

    // Instancia o modelo de Produto
    $produtoModel = new Produto($conn);
    
    // Atribui os valores ao objeto Produto
    $produtoModel->nome = $nome;
    // $produtoModel->descricao = $descricao;
    $produtoModel->quantidade = $quantidade;
    $produtoModel->preco = $preco;
    $produtoModel->imagem_url = $imagem_url;
    
    // Aqui estou inserindo o produto no banco de dados
    if ($produtoModel->inserir()) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar produto. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>

    <!-- Adicionando ícone e link do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        /* Estilos básicos */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7db15;
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
        
        /* Estilo do link "Início" */
        .home-link {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: #007bff;
            font-size: 1.1rem;
            margin-top: 20px;
        }
        .home-link i {
            margin-right: 8px; /* Espaçamento entre o ícone e o texto */
        }
    </style>
</head>
<body>

    <h1>Cadastrar Novo Produto</h1>
    
    <form method="POST" action="cadastrar_produto.php">
        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" required>

        <!-- <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="4" required></textarea> -->

        <label for="quantidade">Quantidade:</label>
        <input type="number" id="quantidade" name="quantidade" required>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" required>

        <label for="imagem_url">URL da Imagem:</label>
        <input type="text" id="imagem_url" name="imagem_url" >

        <button type="submit">Cadastrar Produto</button>
        
        <!-- Ícone de "Início" -->
        <a href="listar_produtos.php" class="home-link">
            <i class="bi bi-house-door"></i> Início
        </a>
        <h1>xavier</h1>
    </form>
    
</body>
</html>
