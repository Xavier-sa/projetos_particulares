<?php
session_start(); // Começar a sessão

// Inicializar os artigos se não existirem ainda
if (!isset($_SESSION['artigos'])) {
    $_SESSION['artigos'] = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Artigos</title>
</head>
<body>
    <h1>Lista de Artigos</h1>

    <a href="cadastrar.php">Cadastrar Novo Artigo</a><br><br>

    <ul>
        <?php foreach ($_SESSION['artigos'] as $artigo): ?>
            <li>
                <strong><?php echo $artigo['titulo']; ?></strong>: <?php echo $artigo['conteudo']; ?>
                <a href="editar.php?id=<?php echo $artigo['id']; ?>">Editar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
