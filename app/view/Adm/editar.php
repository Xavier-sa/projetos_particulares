<?php
// O PHP pode ser usado para incluir conteúdo dinâmico, mas neste caso
// apenas queremos exibir uma página estática.
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Em Desenvolvimento</title>
    <style>
        /* Definir o fundo da página */
        body {
            background-image: url('fundo.jpg'); /* Caminho para a sua imagem de fundo */
            background-size: cover; /* Garantir que a imagem cubra toda a tela */
            background-position: center;
            height: 100vh; /* Fazer o fundo cobrir a altura da tela */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Estilo da mensagem */
        .mensagem {
            font-size: 5rem; /* Definir o tamanho da fonte grande */
            color: white; /* Cor do texto */
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.7); /* Sombra para melhorar a visibilidade */
            font-family: Arial, sans-serif; /* Definir a fonte */
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="mensagem">
        <p>Está em desenvolvimento.</p>
    </div>
</body>
</html>

