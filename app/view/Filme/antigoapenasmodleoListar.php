<?php
require __DIR__ . "\..\..\Config\Database.php";
require __DIR__ . "\..\..\Model\Filme.php";  // Supondo que a classe Filme existe

$filmeModel = new Filme($conn);
$filmes = $filmeModel->findAll();  // Método para buscar todos os filmes
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Filmes</title>

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
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
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
        <div class="container">
            <a href="index.php">Catálogo de Filmes</a>
            <div>
                <a href="index.php">Início</a>
                <a href="adicionar.php">Adicionar Filme</a>
                <a href="favoritos.php">Favoritos</a>
                <a href="login.php">Login</a>
            </div>
        </div>
    </nav>
   
    <div class="container">
        <h1>Catálogo de Filmes</h1>
        <div class="cards">
            <!-- Percorre a lista de filmes -->
            <?php foreach ($filmes as $filme) { ?>
                <div class="card">
                    <!-- Exibe a imagem do filme -->
                    <img src="<?php echo $filme->imagem_url; ?>" alt="<?php echo $filme->titulo; ?>" class="card-image">

                    <div class="card-info">
                        <!-- Exibe o título e a descrição do filme -->
                        <h2 class="title"><?php echo $filme->titulo; ?></h2>
                        <p class="description"><?php echo $filme->descricao; ?></p>
                        <!-- Botão de ação (ver detalhes) -->
                        <form action="Visualizar.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo $filme->id; ?>">
                            <button class="btn">Ver Detalhes</button>
                            
                        </form>

                        <!--  excluir meus filmes    -->
                        <form action="Excluir.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $filme->id ?>">
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                        </form>

                        <!--  favoritar os  filmes    -->
                        <form action="Favoritar.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $filme->id ?>">
                            <button type="submit" onclick="return confirm('Deseja adicionar a sua lista?');">Favoritos</button>
                        </form>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
