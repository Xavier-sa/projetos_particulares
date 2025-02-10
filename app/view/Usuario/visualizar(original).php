<?php
session_start();  // Inicia a sessão para acessar as variáveis de sessão
// var_dump($_SESSION);  // Verifica se o ID está presente na sessão
// Inclui as configurações do banco de dados e o modelo de Usuario
require_once '../../config/Database.php';
require_once '../../model/Usuario.php';

$usuarioModel = new Usuario($conn);
// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo "Você precisa estar logado para acessar esta página.";
    exit;
}

// ** NOVO: Atribui os dados da sessão às propriedades do objeto $usuarioModel **
// Esses dados já estão armazenados na sessão após o login, então não precisamos fazer uma nova consulta ao banco para o nome.
// $usuarioModel->nome = $_SESSION['usuario_nome'];  // Atribuindo o nome da sessão à variável do objeto
// ** NOVO: Se o e-mail também estiver na sessão, podemos atribuir o e-mail aqui **
// Se você já armazenou o e-mail na sessão após o login, podemos atribuí-lo assim:
// $usuarioModel->email = $_SESSION['usuario_email'];  // Atribuindo o e-mail da sessão à variável do objeto

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Usuário</title>

    <style>
        
        /* Reset básico para remover margens e paddings padrão */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            line-height: 1.6;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .card {
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            font-size: 1.8em;
            margin-bottom: 10px;
            color: #444;
        }

        .card p {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #666;
        }

        .home-link {
            text-decoration: none;
            color: #007bff;
            font-size: 1.1em;
        }

        .home-link:hover {
            text-decoration: underline;
        }

        /* Estilo do link de edição e logout */
        a {
            text-decoration: none;
            color: #28a745;
            font-weight: bold;
            margin: 0 15px;
        }

        a:hover {
            color: #218838;
        }

        /* Estilo para o botão de logout */
        .logout {
            color: #dc3545;
        }

        .logout:hover {
            color: #c82333;
        }
        .dadosusuario{
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;

        }
        /* Responsividade para telas menores */
        @media (max-width: 768px) {
            .card {
                padding: 20px;
            }

            h1 {
                font-size: 2em;
            }

            .card h3 {
                font-size: 1.6em;
            }

            .card p {
                font-size: 1.1em;
            }
        }
   
    </style>
</head>
<body>
    <div class="dadosusuario">
    <h1>Dados do Usuário</h1>
    </div>
    <div class="card">
        <!-- Exibe os dados do usuário a partir da sessão -->
        <h3>Nome: <?php echo htmlspecialchars($usuarioModel->nome); ?></h3>
        <p>E-mail: <?php echo htmlspecialchars($usuarioModel->email); ?></p>
        
        <!-- Links para navegação -->
        <a href="../Filme/listar.php" class="home-link">Início</a> |
        <a href="editar.php">Editar Informações</a> | 
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
