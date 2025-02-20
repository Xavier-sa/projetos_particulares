<?php
include('../../config/env.php');
include('../componentes/navbar.php');
include('../componentes/sidebar.php');
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
    <nav>
        
        <ul>
            <li><a href="<?php echo PGC_PATH; ?>sistemas.php">Sistemas</a></li>
            <li><a href="<?php echo PGC_PATH; ?>aplicativos.php">Aplicativos Web</a></li>
            <li><a href="<?php echo PGC_PATH; ?>consultoria.php">Consultoria</a></li>
            <li><a href="<?php echo PGC_PATH; ?>suporte_tecnico.php">Suporte Técnico</a></li>
        </ul>
    </nav>
    
    <article>
        
    </article>
</main>

<?php include('../componentes/footer.php'); ?>
</body>
</html>
