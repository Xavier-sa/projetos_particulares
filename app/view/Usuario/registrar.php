<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>

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
            margin: 0;
            margin-bottom: 20px;
        }

        form {
            margin: 20px 0;
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
            margin-top: 20px;
            text-align: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>


    <div class="container">
        <h2>Cadastro</h2>
        <!-- Exibir a mensagem de sucesso, se existir -->
        <?php if (isset($_SESSION['sucesso'])): ?>
            <div class="mensagem sucesso">
                <?php echo $_SESSION['sucesso']; ?>
            </div>
            <?php unset($_SESSION['sucesso']); // Limpa a mensagem após exibição ?>
        <?php endif; ?>

        <!-- Exibir a mensagem de erro, se existir -->
        <?php if (isset($_SESSION['erro'])): ?>
            <div class="mensagem erro">
                <?php echo $_SESSION['erro']; ?>
            </div>
            <?php unset($_SESSION['erro']); // Limpa a mensagem após exibição ?>
        <?php endif; ?>
        <form action="../../controllers/register_process.php" method="POST">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div>
                <button type="submit">Cadastrar</button>
            </div>
        </form>
        
        <p>Já tem uma conta? <a href="../Usuario/Login.php">Faça login</a></p>
    </div>
    <script>
    document.querySelector("form").addEventListener("submit", function(event) {
        let email = document.getElementById("email").value;
        let senha = document.getElementById("senha").value;
        if (!email || !senha) {
            alert("Por favor, preencha todos os campos!");
            event.preventDefault(); // Impede o envio do formulário
        }
    });
</script>

</body>
</html>
