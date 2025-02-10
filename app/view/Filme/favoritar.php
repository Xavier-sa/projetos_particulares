<?php

// meu_trecho_verificando_usuario_logado
session_start();

// Verifica se a sessão 'usuario_id' está definida
if (!isset($_SESSION['usuario_id'])) {
    // Se não estiver, redireciona ou mostra uma mensagem de erro
    header('Location: login.php'); // Redireciona para uma página de login
    exit;
}

// logado/deslogado




// Definindo um cabeçalho HTTP para impedir o cache da página (opcional)
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página em Desenvolvimento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7db15; /* Fundo amarelo */
            color: #333;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #23232e;
            font-size: 3rem;
        }
        p {
            font-size: 1.5rem;
            color: #444;
        }
        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h1>Estamos em Desenvolvimento!</h1>
    <p>Nosso site está em construção e estará disponível em breve.</p>
    <p>Obrigado pela paciência!</p>

    <!-- Botão para retornar à página inicial ou outro link relevante -->
    <a href="listar.php" class="btn">Voltar à Página Inicial</a>

</body>
</html>
