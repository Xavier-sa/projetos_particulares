<?php
// Inicia a sessão para acessar as variáveis de sessão
session_start();

// Inclui as configurações do banco de dados e o modelo de Produto
require_once '../../config/Database.php';
require_once '../../model/Produto.php';  // Supondo que a classe Produto exista

$produtoModel = new Produto($conn);
$produtos = $produtoModel->findAll();  // Método para buscar todos os produtos
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Produtos</title>
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
            background-color:rgb(156, 153, 153);
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
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        /* Efeito ao passar o mouse */
        .card:hover {
            transform: translateY(-10px);
        }

        /* Imagem do produto */
        .card-image {
            /* width: 100%; */
            height: 150px;
            object-fit: cover;
            border-bottom: 2px solid #eee;
            /* white-space: nowrap;  /* Impede que o texto quebre em múltiplas linhas */
            overflow: hidden; */
        }

        /* Informações do card */
        .card-info {
            padding: 15px;
            white-space: nowrap;  /* Impede que o texto quebre em múltiplas linhas */
            overflow: hidden;
        }

        .title {
            font-size: 1.6rem;
            margin-bottom: 10px;
            color: #333;
        }

        /* .descricao {
            font-size: 1rem;
            margin-bottom: 15px;
            color: #777;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        } */
        .preco { 
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: green;
        }

        /* Contêiner para os botões */
        .actions {
            display: flex;
            justify-content: space-around;
            gap: 10px;
        }

        /* Estilo dos botões com ícones */
        .btn, .edititardados, .excluirproduto, .favoritarproduto {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 2rem;
            padding: 10px;
            color: #444;
            transition: color 0.3s ease;
        }

        .btn:hover, .edititardados:hover, .excluirproduto:hover, .favoritarproduto:hover {
            color: #007bff;
        }

        .excluirproduto {
            color: #DF0101;
        }

        .favoritarproduto {
            color: #FFB800;
        }

        .catalogo {
            text-align: center;
            margin-top: 50px;
        }

        .catalogo h1 {
            font-size: 2rem;
            transition: transform 0.3s ease, font-size 0.3s ease;
            color: yellow;
        }

        .catalogo h1:hover {
            transform: scale(1.2);
            font-size: 2.4rem;
            color:rgb(5, 15, 25);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
    <div class="logo">
        <h3>Desenvolvido por Xavier-sa</h3><!-- <a href="https://xavierdev.pages.dev">X-STORE -> Xavier Desenvolvedor</a> -->
    </div>
    <div>
        <a href="tela_vendas.php">VENDER</a>
        <a href="cadastrar_produto.php">CADASTRAR PRODUTOS</a>
        <a href="../Usuario/visualizar.php">Usuário</a>
        <a href="../Adm/painel.php">ADM</a>
        <a href="../Produto/relatorio_vendas.php">RELATORIO</a>

        <?php
        if (isset($_SESSION['usuario_id'])): ?>
            <a href="../Usuario/logout.php">Sair</a>
        <?php else: ?>
            <a href="../Usuario/login.php">Login</a>
        <?php endif; ?>
    </div>
</nav>

    <div class="container">
        <br><br>
        <div class="catalogo"><h1>Catálogo de Produtos</h1></div>
        <br>
        <div class="cards">
            <!-- Percorre a lista de produtos -->
            <?php foreach ($produtos as $produto) { ?>
                <div class="card">
                    <img src="<?php echo $produto->imagem_url; ?>" alt="<?php echo $produto->nome; ?>" class="card-image">

                    <div class="card-info">
                        <h2 class="title"><?php echo $produto->nome; ?></h2>
                        <!-- <p class="descricao"><?php echo $produto->descricao; ?></p> -->
                        <p class="preco">R$ <?php echo number_format($produto->preco, 2, ',', '.'); ?></p>
                        
                        <div class="actions">
                            <form action="visualizar_produto.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo $produto->id; ?>">
                                <!-- <button class="btn" title="Ver Detalhes">
                                    <span class="material-icons">visibility</span>
                                </button>
                            </form> -->

                            <form action="editar_produto.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo $produto->id ?>">
                                <!-- <button class="edititardados" type="submit" onclick="return confirm('Tem certeza que deseja editar?');" title="Editar">
                                    <span class="material-icons">edit</span>
                                </button> -->
                            </form>

                            <form action="excluir_produto.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $produto->id ?>">
                                <!-- <button class="excluirproduto" type="submit" onclick="return confirm('Tem certeza que deseja excluir?');" title="Excluir">
                                    <span class="material-icons">delete</span>
                                </button> -->
                            </form>

                            <form action="favoritar_produto.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $produto->id ?>">
                                <!-- <button class="favoritarproduto" type="submit" onclick="return confirm('Deseja adicionar a sua lista de favoritos?');" title="Favoritos">
                                    <span class="material-icons">favorite</span>
                                </button> -->
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
