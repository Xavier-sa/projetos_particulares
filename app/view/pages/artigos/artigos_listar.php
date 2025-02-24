<?php
require_once('../../../config/env.php');
require_once('../../componentes/navbar.php');
require_once('../../componentes/sidebar.php');

require_once ('../listar_lista.php');  /* testando */
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xavier Solutions - Lista de Artigos</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>style.css">
</head>
<body>

<main class="content">
<h1>Lista de Artigos</h1>
    <a href="artigos_cadastrar.php">Cadastrar Novo Artigo</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Conteúdo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($artigos as $artigo): ?>
                <tr>
                    <td><?php echo $artigo['id']; ?></td>
                    <td><?php echo $artigo['titulo']; ?></td>
                    <td><?php echo $artigo['conteudo']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $artigo['id']; ?>">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php require_once('../../componentes/footer.php'); ?>
</body>
</html>
