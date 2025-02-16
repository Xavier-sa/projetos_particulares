<?php
include('../../config/env.php');  // Inclui as configurações
include('../componentes/navbar.php');  // Inclui a barra de navegação
include('../componentes/sidebar.php');  // Inclui a sidebar
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xavier Solutions - Teste</title>  <!-- Título da Página -->
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>style.css">  <!-- Caminho do CSS -->
</head>
<body>

<main class="content">
    <h1>XAVIER TESTE</h1>  
    <h6>Você será redirecionado em breve...</h6>  

   
    <script src="<?php echo ASSETS_PATH; ?>rd.js"></script>  
    
</main>

<?php include('../componentes/footer.php'); ?>  

</body>
</html>
