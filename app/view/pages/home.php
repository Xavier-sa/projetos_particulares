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

</head>
<body>
    <!-- arquivo responsável pela tela Home -->
    <main class="content">
    <h1>Bem-vindo à Xavier Solutions!</h1>
            <p>Transformamos suas ideias em soluções digitais inovadoras. Explore nossos serviços e entre em contato para saber mais.</p>
            <a href="<?php echo PG_PATH; ?>sobre.php">Saiba Mais</a>
        <!-- <nav>
            <ul>
                <li>Aba 1</li>
                <li>Aba 2</li>
            </ul>
        </nav>
        <table>
            <thead>
                <tr>
                    <td>Nome</td>
                    <td>Email</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Lucas</td>
                    <td>lucas@email.com</td>
                </tr>
                <tr>
                    <td>Matheus</td>
                    <td>matheus@email.com</td>
                </tr>
            </tbody>
        </table> -->
       
    </main>

    <!-- rodapé -->

   
    <?php require_once('../componentes/footer.php'); ?>
</body>
</html>








