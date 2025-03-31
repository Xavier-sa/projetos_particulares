<?php
require_once('../../config/env.php');
require_once('../componentes/navbar.php');
require_once('../componentes/sidebar.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Xavier Solutions</title>
    <link rel="stylesheet" href="<?= CSS_PATH ?>style.css">
   
    
</head>
<body>
<main class="content">
    <div class="login">
        <h2>Login</h2>
        
        <?php if (isset($_GET['erro'])): ?>
            <div class="error-message">
                <?php 
                if ($_GET['erro'] == 'email') {
                    echo "E-mail não cadastrado.";
                } elseif ($_GET['erro'] == 'acesso') {
                    echo "Por favor, faça login para acessar esta página.";
                }
                ?>
            </div>
        <?php endif; ?>
        
        <form action="../../controller/login_verificado.php" method="POST">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            
            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</main>
    <?php require_once('../componentes/footer.php'); ?>
</body>
</html>