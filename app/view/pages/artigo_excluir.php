<?php
require_once('../../config/env.php');
require_once('../componentes/navbar.php');
require_once('../componentes/sidebar.php');
require_once('../../config/database.php');
require_once('../../model/ArtigoModel.php');

// Conexão com o banco de dados
$database = new Database("localhost", "3306", "root", "", "xavier_solutions");
$pdo = $database->createConnection();

// Instanciando o modelo do artigo
$artigoModel = new ArtigoModel($pdo);

// Verifica se foi passado um ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Busca o artigo antes de excluir (para confirmar existência)
    $artigo = $artigoModel->listarArtigos(); // você pode substituir isso por um método como obterArtigoPorId, se houver
    
    // Verifica se o artigo foi encontrado
    if (!$artigo) {
        die("Artigo não encontrado!");
    }

    // Processa a exclusão quando for POST (confirmação)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Executa a exclusão
        $resultado = $artigoModel->excluirArtigo($id);
        
        if ($resultado) {
            // Redireciona com mensagem de sucesso
            header('Location: listar_artigos.php?excluido=1');
            exit;
        } else {
            $erro = "Falha ao excluir o artigo.";
        }
    }
} else {
    die("ID do artigo não especificado!");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Artigo - Xavier Solutions</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>style.css">
</head>
<body>
    <main class="content">
        <h1>Excluir Artigo</h1>
        
        <?php if (isset($erro)): ?>
            <div><?php echo $erro; ?></div>
        <?php endif; ?>
        
        <div class="confirmation">
            <p>Você está prestes a excluir o artigo:</p>
            <p><strong>Título:</strong> <?php echo htmlspecialchars($artigo['titulo']); ?></p>
            <p><strong>Conteúdo:</strong> <?php echo htmlspecialchars($artigo['conteudo']); ?></p>
            
            <form method="POST">
                <input type="hidden" name="confirmacao" value="1">
                <button type="submit" class="btn btn-danger">Confirmar Exclusão<span class="material-symbols-outlined">
                delete_forever
                </span></button>
                <a href="listar_artigos.php" class="btn btn-secondary"><span class="material-symbols-outlined">cancel</span>Cancelar</a>
            </form>
        </div>
    </main>

    <?php require_once('../componentes/footer.php'); ?>
</body>
</html>
