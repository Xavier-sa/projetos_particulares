<?php
// Inicia a sessão para acessar as variáveis de sessão
session_start();

// Inclui as configurações do banco de dados e o modelo de Filme
require_once '../../config/Database.php';
require_once '../../model/Filme.php';

$filmeModel = new Filme($conn);
$filmes = $filmeModel->findAll();  // Método para buscar todos os filmes
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Filmes</title>
    <link rel="icon" href="xavi.JPG" type="image/png">
    
    <!-- Link para importar Material Icons do Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
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
            background-color: #eee;
            border-radius: 8px; /* aqui arrendodo o card */
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

        .descricao {
            font-size: 1rem;
            margin-bottom: 15px;
            color: #777;
            white-space: nowrap;  /* Impede que o texto quebre em múltiplas linhas */
            overflow: hidden;
            text-overflow: ellipsis;  /* Adiciona "..." no final do texto cortado */
        }
        .ano { 
            font-size: 1rem;
            margin-bottom: 15px;
            color: red;
        }

        /* Contêiner para os botões */
        .actions {
            display: flex;
            justify-content: space-around; /* Distribui os botões igualmente */
            gap: 10px; /* Espaçamento entre os ícones */
        }

        /* Estilo dos botões com ícones */
        .btn, .edititardados, .excluirfilme, .favoritafilme {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 2rem;
            padding: 10px;
            color: #444;
            transition: color 0.3s ease;
        }

        .btn:hover, .edititardados:hover, .excluirfilme:hover, .favoritafilme:hover {
            color: #007bff;
        }

        .excluirfilme {
            color: #DF0101;
        }

        .favoritafilme {
            color: #FFB800;
        }
        /* Estilo do container do catálogo */
        .catalogo {
        text-align: center;
        margin-top: 50px;
        }

        /* Estilo do título */
        .catalogo h1 {
        font-size: 2rem;
        transition: transform 0.3s ease, font-size 0.3s ease; /* Transição suave para aumentar o tamanho */
        color: #333; /* Cor do título */
        }

        /* Efeito ao passar o mouse */
        .catalogo h1:hover {
        transform: scale(1.2); /* Aumenta o título em 20% */
        font-size: 2.4rem; /* Ajuste no tamanho da fonte */
        color:rgb(5, 15, 25); /* Muda a cor para azul ao passar o mouse */
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
        <a href="../Usuario/registrar.php">Registrar-se</a>

        <?php
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
        <br><br>
        <div class="catalogo"><h1>Catálogo de Filmes</h1></div>
        <br>
        <div class="cards">
            <!-- Percorre a lista de filmes -->
            <?php foreach ($filmes as $filme) { ?>
                <div class="card">
                    <!-- Exibe a imagem do filme -->
                    <img src="<?php echo $filme->imagem_url; ?>" alt="<?php echo $filme->titulo; ?>" class="card-image">

                    <div class="card-info">
                        <!-- Exibe o título e a descrição do filme -->
                        <h2 class="title"><?php echo $filme->titulo; ?></h2>
                        <p class="descricao"><?php echo $filme->descricao; ?></p>
                        <p class="ano"><?php echo $filme->ano; ?></p>
                        
                        <!-- Contêiner para os botões -->
                        <div class="actions">
                            <!-- Botão de Ver Detalhes -->
                            <form action="visualizar.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo $filme->id; ?>">
                                <button class="btn" title="Ver Detalhes">
                                    <span class="material-icons">visibility</span>
                                </button>
                            </form>

                            <!-- Botão Editar -->
                            <form action="editar.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo $filme->id ?>">
                                <button class="edititardados" type="submit" onclick="return confirm('Tem certeza que deseja editar?');" title="Editar">
                                    <span class="material-icons">edit</span>
                                </button>
                            </form>

                            <!-- Botão Excluir -->
                            <form action="excluir.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $filme->id ?>">
                                <button class="excluirfilme" type="submit" onclick="return confirm('Tem certeza que deseja excluir?');" title="Excluir">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>

                            <!-- Botão Favoritar -->
                            <form action="favoritar.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $filme->id ?>">
                                <button class="favoritafilme" type="submit" onclick="return confirm('Deseja adicionar a sua lista de favoritos?');" title="Favoritos">
                                    <span class="material-icons">favorite</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
