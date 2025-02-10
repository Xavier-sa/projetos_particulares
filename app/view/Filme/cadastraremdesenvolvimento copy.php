<?php
// Inclui as configurações do banco de dados e o modelo de Filme
require __DIR__ . "\..\..\Config\Database.php";
require __DIR__ . "\..\..\Model\Filme.php";  // Supondo que a classe Filme exista

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $ano = $_POST['ano'];
    $imagem_url = $_POST['imagem_url'];

    // Instancia o modelo de Filme
    $filmeModel = new Filme($conn);
    
    // Atribui os valores ao objeto Filme
    $filmeModel->titulo = $titulo;
    $filmeModel->descricao = $descricao;
    $filmeModel->ano = $ano;
    $filmeModel->imagem_url = $imagem_url;
    
    // aqui estou inserindo o filme no banco de dados
    if ($filmeModel->inserir()) {
        echo "Filme cadastrado com sucesso! turma146";
    } else {
        echo "Erro ao cadastrar filme. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Filme</title>
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
    </style>
</head>
<body>

    <h1>Cadastrar Novo Filme</h1>
    
    <form method="POST" action="cadastraremdesenvolvimento.php">
        <label for="titulo">Título do Filme:</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="4" required></textarea>

        <label for="ano">Ano do Filme:</label>
        <input type="number" id="ano" name="ano" required>

        <!-- imagen tbm porem cadastrar por URL , -->
        <label for="imagem_url">URL da Imagem:</label>
        <input type="text" id="imagem_url" name="imagem_url" required>

        <button type="submit">Cadastrar Filme</button>
        
    </form>
    <a href="listar.php">Início</a>
</body>
</html>
