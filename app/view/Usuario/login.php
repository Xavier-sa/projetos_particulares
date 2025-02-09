<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            margin: 20px 0 40px 0;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #1e1e1e;
            color: #ffffff;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            margin-top: 30px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function mostrarMensagem() {
            // Aqui você pode modificar a mensagem conforme necessário
            alert("Bem Vindo!");
        }
    </script>
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form action="/app/controllers/login_process.php" method="POST" onsubmit="mostrarMensagem()">
        
            <div>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="teste@dev.com">
            </div>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" value="teste123">
            </div>
            <div>
                <button type="submit">Entrar</button>
            </div>
        </form>

        <p>Ainda não tem uma conta? <a href="registrar.php">Cadastre-se</a></p>
    </div>
</body>

</html>
