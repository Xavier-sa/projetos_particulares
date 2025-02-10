



<?php
session_start();

// Exibir mensagem de sucesso ou erro
if (isset($_SESSION['msg'])) {
    echo "<p>{$_SESSION['msg']}</p>";
    unset($_SESSION['msg']);
}

// Conectar ao banco de dados
try {  
    $pdo = new PDO('mysql:host=localhost;dbname=filmesdb', 'root', ''); // Altere as credenciais conforme necessário
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configura para lançar exceções em caso de erro

    // Consultar a tabela de usuários
    $sql = "SELECT * FROM usuarios"; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute(); // Executa a consulta SQL
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC); // Atribui os resultados à variável $usuarios

} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit;
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <style>
        /* Definir o fundo da página */
        body {
            background-image: url('fundoadm.jpg'); /* Caminho para a sua imagem de fundo */
            background-size: cover; /* Garantir que a imagem cubra toda a tela */
            background-position: center;
            height: 100vh; /* Fazer o fundo cobrir a altura da tela */
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Centralizar o conteúdo da página */
        .container {
            text-align: center; /* Centraliza o texto */
            margin: 0 auto;
            padding: 20px;
            width: 80%; /* Ajuste a largura do conteúdo */
        }

        /* Estilo dos títulos */
        h2, h3 {
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6); /* Adiciona sombra ao texto */
        }

        /* Estilo da tabela */
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 100%;
            max-width: 1000px;
            background-color: rgba(255, 255, 255, 0.8); /* Fundo semi-transparente para a tabela */
            border-radius: 10px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color:rgb(49, 52, 49);
            color: white;
        }

        td {
            background-color:rgb(204, 190, 190);
        }

        /* Estilo para os botões */
        input[type="submit"] {
            padding: 5px 10px;
            margin: 5px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Estilo para a linha "Nenhum usuário encontrado" */
        td[colspan="4"] {
            text-align: center;
            color: white;
            font-weight: bold;
        }
        .btn-editar {
            background-color: #a3c9f0; /* Azul fraco */
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-editar:hover {
            background-color: #8bbff2; /* Azul mais forte no hover */
        }
        .home{ 
            text-align: center; /* Centraliza o texto */
            margin: 0 auto;
            padding: 20px;
            width: 80%; /* Ajuste a largura do conteúdo */
            color: rebeccapurple;

        }
    </style>
</head>
<body>

<div class="container">
    <h2>Painel de Administração</h2>
    <h3>Lista de Usuários</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($usuarios)): // Verifica se existem usuários ?>
                <?php foreach ($usuarios as $row): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <!-- Botão para editar -->
                            <form action="editar.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Editar">
                            </form>
                            <!-- Botão para excluir -->
                            <form action="excluir.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Excluir">
                            </form>
                            <form action="bloquear.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Bloquear">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum usuário encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="home">
    <form action="../../Filme/listar.php" method="POST" style="display:inline;">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="submit" value="HOME">
    </form>
</div>

</body>
</html>
