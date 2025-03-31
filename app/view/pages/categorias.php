<?php
require_once('../../config/env.php');
require_once('../componentes/navbar.php');
require_once('../componentes/sidebar.php');
require_once('../../config/database.php');

// Conexão com o banco
$database = new Database("localhost", "3306", "root", "", "xavier_solutions");
$pdo = $database->createConnection();

if (!$pdo) {
    die("Não foi possível conectar ao banco de dados");
}

require_once('../../model/CategoriaModel.php');
$categoriaModel = new CategoriaModel($pdo);

// Obtendo apenas as categorias
$categorias = $categoriaModel->listarCategorias();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xavier Solutions - Categorias</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>style.css">
</head>
<body>

<main class="content">
    <h1>Categorias</h1>
    
    <div class="card">
        <h2>
            Lista de Categorias
            
        </h2>
        <a href="adicionar_categoria.php" class="btn btn-add">+ Novo</a>
        
        <?php if (empty($categorias)): ?>
            <p>Nenhuma categoria cadastrada.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($categoria['nome']); ?></td>
                            <td><?php echo htmlspecialchars($categoria['descricao']); ?></td>
                            <td class="actions">
                                <a href="editar_categoria.php?id=<?php echo $categoria['id']; ?>">Editar</a>
                                <a href="excluir_categoria.php?id=<?php echo $categoria['id']; ?>" 
                                   onclick="return confirm('Tem certeza que deseja excluir?')">
                                    Excluir
                                </a>
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