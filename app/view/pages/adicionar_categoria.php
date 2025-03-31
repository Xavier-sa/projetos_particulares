<?php
require_once('../../config/env.php');
require_once('../componentes/navbar.php');
require_once('../componentes/sidebar.php');
require_once('../../config/database.php');

// Conexão com o banco de dados
$database = new Database("localhost", "3306", "root", "", "xavier_solutions");
$pdo = $database->createConnection();

if (!$pdo) {
    die("Não foi possível conectar ao banco de dados");
}

require_once('../../model/CategoriaModel.php');
$categoriaModel = new CategoriaModel($pdo);

$msg = ""; // Variável para armazenar mensagens de erro ou sucesso

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pega os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    // Valida se os campos não estão vazios
    if (!empty($nome) && !empty($descricao)) {
        // Cria a nova categoria
        $categoriaModel->criarCategoria($nome, $descricao);
        $msg = "Categoria adicionada com sucesso!";
    } else {
        $msg = "Por favor, preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xavier Solutions - Adicionar Categoria</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>style.css">
</head>
<body>

<main class="content">
    <h1>Adicionar Nova Categoria</h1>
    
    <?php if ($msg): ?>
        <div class="message"><?php echo htmlspecialchars($msg); ?></div>
    <?php endif; ?>
        <div class="cadastrar">
    <div class="card">
        <form method="POST" action="adicionar_categoria.php">
            <label for="nome">Nome da Categoria</label>
            <input type="text" id="nome" name="nome" required>
            
            <label for="descricao">Descrição da Categoria</label>
            <textarea id="descricao" name="descricao" required></textarea>
            
            <button type="submit" class="btn-add">Adicionar Categoria</button>
        </form>
    </div>
    </div>
</main>

<?php require_once('../componentes/footer.php'); ?>

</body>
</html>
