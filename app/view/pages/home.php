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
    <title>Xavier Solutions </title>   
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?php echo IMG_PATH; ?>icon.PNG">
</head>
<body>
    <!-- arquivo responsável pela tela Home -->
    <main class="content">
        <h1>Bem-vindo à Xavier Solutions!</h1>
        <p>Transformamos suas ideias em soluções digitais inovadoras. Explore nossos serviços e entre em contato para saber mais.</p>
        <a href="<?php echo PG_PATH; ?>sobre.php">Saiba Mais</a>
        <form action="<?php echo PG_PATH; ?>login.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>
    
    <button type="submit">Entrar</button>
</form>


    <div class="login">
        <h1>Login </h1>
        <p>Para acessar o sistema, você precisa fazer login. Caso não tenha um usuário, entre em contato com o administrador.</p>
        <p><a href="<?php echo PG_PATH; ?>login.php"><span class="material-symbols-outlined">home_pin</span></a></p>
    </div>
  </main>
    <?php require_once('../componentes/footer.php'); ?>
</body>
</html>
