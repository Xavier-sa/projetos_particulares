<?php
// Incluir configurações e o modelo Filme
//corrigi os endereços lol 
require_once '../../config/Database.php';

require_once '../../model/Filme.php';
//var_dump("bora xavier visualize, funcionou lol");
//die;

$filmeModel = new Filme($conn);  // meu erro mais comum conexao deve ser fora dos IF 

// Verifica se o ID foi passado na URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Instancia o modelo de Filme
    

    // Carrega os dados do filme com base no ID
    $filme = $filmeModel->findById($id);

    // Verifica se o filme foi encontrado
    if (!$filme) {
        // Caso não encontre o filme, redireciona para a lista de filmes com uma mensagem de erro
        header("Location: listar.php?mensagem=erro");
        exit;
    }
} 
// else {
//     // Se o ID não foi passado, redireciona para a lista de filmes com uma mensagem de erro
//     header("Location: listar.php?mensagem=erro");
//     exit;
// }

// Verifica se o formulário foi enviado para atualizar o filme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    // var_dump($_POST); // Para verificar se os dados estão sendo enviados corretamente

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $ano = $_POST['ano']; 
    $imagem_url = $_POST['imagem_url'];  // imagem_url pode ser alterada, mas não será visível ao usuário
    
    // Atualiza os dados no modelo Filme

    $filmeModel->id = $_POST['id'];
    $filmeModel->titulo = $titulo;
    $filmeModel->ano = $ano;
    $filmeModel->descricao = $descricao;
    $filmeModel->imagem_url = $imagem_url; // alteração da imagem
    
    // Realiza a atualização no banco de dados
    if ($filmeModel->editar()) {
        echo "Filme atualizado com sucesso!";
        // redirecionar para a lista ou para a página do filme editado
        header("Location: listar.php?mensagem=sucesso");
        exit;
    } else {
        echo "Erro ao atualizar filme. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filme</title>
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

    <h1>Editar Filme</h1>

    <!-- Formulário de edição  obs: aqui eu to puxando apenas titulo e descricao nao exibindo o id pois define o tipo como hidden -->
    <form method="POST" action="editar.php">
        <input type="hidden" name="id" value="<?php echo $filme->id; ?>"> <!-- hidden deixa o Campo invisível  -->

        <label for="titulo">Título do Filme:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $filme->titulo; ?>" required>

        <label for="ano">Ano do Filme:</label>
        <input type="number" id="ano" name="ano" value="<?php echo $filme->ano; ?>" required>


        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="4" required><?php echo $filme->descricao; ?></textarea>

        <!-- Parte de imagem ( reativar):-->
        <label for="imagem_url">URL da Imagem:</label>
        <input type="text" id="imagem_url" name="imagem_url" value="<?php echo $filme->imagem_url; ?>" required>
        
        <!-- ($_POST['titulo'], $_POST['descricao'], $_POST['id']) -->
        <button type="submit">Atualizar</button>

        <!-- Link para voltar à lista de filmes -->
        <a href="listar.php" class="home-link">
            <i class="bi bi-house-door"></i> Voltar para a Lista
        </a>
    </form>

</body>
</html>
