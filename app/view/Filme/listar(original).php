<?php

// Inclui as configurações do banco de dados e o modelo de Filme
//$path = _DIR_ . "\..\..\Config\Database.php";
require_once '../../config/Database.php';

require_once '../../model/Filme.php';

$filmeModel = new Filme($conn);
$filmes = $filmeModel->findAll();  // Método para buscar todos os filmes
// var_dump($filmes); 
// die;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Filmes</title>
    <link rel="icon" href="xavi.JPG" type="image/png">

    <style>
        /* Resetando alguns estilos padrões */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Corpo e estilo geral */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7db15;
            /* background-color: #f4f4f4; cinza-claro */
            color: #333;
            padding: 20px;
        }

        /* Navbar */
        nav {
            background-color: #23232e;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            color: white;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        nav a {
            text-decoration: none;
            color: #ffffff;
            margin: 0 10px;
            font-size: 1.1rem;
        }

        nav a:hover {
            opacity: 0.7;
            transform: scale(1.1);
        }

        /* Container principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        /* Título */
        h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: #444;
        }

        /* Estilo para os cards */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        /* Card individual */
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        /* Efeito ao passar o mouse */
        .card:hover {
            transform: translateY(-10px);
        }

        /* Imagem do filme */
        .card-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-bottom: 2px solid #eee;
        }

        /* Informações do card */
        .card-info {
            padding: 15px;
        }

        .title {
            font-size: 1.6rem;
            margin-bottom: 10px;
            color: #333;
        }

        .description {
            font-size: 1rem;
            margin-bottom: 15px;
            color: #777;
        }

        .edititardados {
            font-size: 1rem;
            margin-bottom: 15px;
            color: #777;
        }


         .excluirfilme {
            font-size: 1rem;
            margin-bottom: 15px;
            color: #DF0101;
        }


          .favoritafilme {
            font-size: 1rem;
            margin-bottom: 15px;
            color:rgb(55, 53, 44);
        }


        
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
    <div class="logo">
        <a href="https://xavierdev.pages.dev">X-PLAYER-> XAVIER DESENVOLVEDOR</a>
    </div>
    <div>
        <a href="listar.php">Início</a>
        <a href="cadastraremdesenvolvimento.php">Adicionar Filme</a>
        <a href="favoritar.php">Favoritos</a>
        <a href="../Usuario/visualizar.php">Usuário</a>
        <a href="../Adm/painel.php">ADM</a>

        <?php
        // Inicia a sessão para acessar as variáveis de sessão
        session_start();
   
        // Verifica se o usuário está logado
        if (isset($_SESSION['usuario_id'])): ?>
            <!-- Se o usuário estiver logado, mostra o link para 'Logout' -->
            <a href=" ../Usuario/logout.php ">Sair</a>
        <?php else: ?>
            <!-- Se o usuário não estiver logado, mostra o link para 'Login' -->
            <a href="../Usuario/login.php">Login</a>
        <?php endif; ?>
    </div>
</nav>


    <div class="container">
        <h1>Catálogo de Filmes</h1>
        <div class="cards">
            <!-- Percorre a lista de filmes -->
            <?php foreach ($filmes as $filme) {
                  ?>
                <div class="card">
                    <!-- Exibe a imagem do filme -->
                    <img src="<?php echo $filme->imagem_url; ?>" alt="<?php echo $filme->titulo; ?>" class="card-image">

                    <div class="card-info">
                        <!-- Exibe o título e a descrição do filme -->
                        <h2 class="title"><?php echo $filme->titulo; ?></h2>
                        <p class="description"><?php echo $filme->descricao; ?></p>
                        <!-- Botão de ação (ver detalhes) -->

                        <form action="visualizar.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo $filme->id; ?>">
                            <button class="btn">Ver Detalhes</button>
                        </form>

                        <!-- Editar os dados puxando -->
                        <form action="editar.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo $filme->id ?>">
                            <button class="edititardados" type="submit" onclick="return confirm('Tem certeza que deseja editar?');">Editar</button>
                        </form>

                        <!-- Excluir filmes -->
                        <form action="excluir.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $filme->id ?>">
                            <button class="excluirfilme" type="submit" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                        </form>

                        <!-- Favoritar filmes -->
                        <form action="favoritar.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $filme->id ?>">
                            <button class="favoritafilme" type="submit" onclick="return confirm('Deseja adicionar a sua lista de favoritos?');">Favoritos</button>
                        </form>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
