<?php

function mensagemBoasVindas() {
    return "Bem-vindo ao espaço de teste do Projeto Xavier! Estamos testando a integração do PHP com HTML e CSS.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Teste - Projeto Xavier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    
    <header>
        <div class="logo"><i class="fas fa-cogs"></i> Espaço XaVier</div>
    </header>

    
    <main>
        <section class="welcome">
            <h1>Página de Teste</h1>
            <p><?php echo mensagemBoasVindas(); ?></p> 
        </section>

      
        <section class="image-section">
            <div class="image-box"></div>
        </section>
    </main>

    
    <footer>
        <p>&copy; 2025 Projeto Xavier - Todos os direitos reservados.</p>
    </footer>

</body>
</html>
