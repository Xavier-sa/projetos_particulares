<?php
require_once('../../config/env.php');
require_once('../componentes/navbar.php');
require_once('../componentes/sidebar.php');
require_once('../../config/database.php');

// Correção: usar caminho absoluto
require_once(__DIR__ . '/../../model/ArtigoModel.php');

// Conexão com o banco
$database = new Database("localhost", "3306", "root", "", "xavier_solutions");
$pdo = $database->createConnection();

if (!$pdo) {
    die("Não foi possível conectar ao banco de dados");
}

// Instância do modelo
$artigoModel = new ArtigoModel($pdo);
$artigos = $artigoModel->listarArtigos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artigos - Xavier Solutions</title>
    <link rel="stylesheet" href="<?= CSS_PATH ?>style.css">
    
</head>
<body>

<main class="content">
    <h1>Artigos</h1>
    
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Lista de Artigos</h2>
            <a href="artigo_adicionar.php" class="btn btn-add">+ Novo</a>
        </div>
        
        <?php if (empty($artigos)): ?>
            <p>Nenhum artigo encontrado.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Conteudo</th>
                        <th>Autor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($artigos as $art): ?>
                        <tr>
                            <td><?= htmlspecialchars($art['titulo']) ?></td>
                            <td><?= htmlspecialchars($art['conteudo']) ?></td>
                            <td><?= htmlspecialchars($art['usuario_id']) ?></td>
                            <td>
                                <a href="editar_artigo.php?id=<?= $art['id'] ?>" class="btn btn-edit">Editar</a>
                                <a href="artigo_excluir.php?id=<?= $art['id'] ?>" 
                                   onclick="return confirm('Excluir este artigo?')" 
                                   class="btn btn-delete">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</main>

<?php require_once('../componentes/footer.php'); ?>
</body>
</html>