<?php

require __DIR__ . "\..\..\Config\Database.php";
require __DIR__ . "\..\..\Model\Filme.php";

$filmeModel = new Filme($conn);

$id = $_GET["id"];

$filme = $filmeModel->findById($id);

?>
<!-- sem ESTILO meu codigo original : -->
<!-- <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>
</head>
<body>
    <section>
    <h1>Detalhes Filme</h1>
    <img src="<?php echo $filme->imagem_url; ?>" alt="<?php echo $filme->titulo; ?>">
    <h3>Titulo: <?php echo $filme->titulo; ?></h3>
    <p>Ano: <?php echo $filme->ano; ?></p>
    <p>Descrição: <?php echo $filme->descricao; ?></p>
    <a href="listar.php" class="home-link">
            <i class="bi bi-house-door"></i> Início
</section>
</body>
</html> -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Filme</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            max-width: 400px;
            text-align: center;
        }
        .card img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .card h3 {
            margin: 10px 0;
            color: #333;
        }
        .card p {
            margin: 5px 0;
            color: #666;
        }
        .home-link {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #fff;
            background: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .home-link:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="<?php echo $filme->imagem_url; ?>" alt="<?php echo $filme->titulo; ?>">
        <h3>Título: <?php echo $filme->titulo; ?></h3>
        <p>Ano: <?php echo $filme->ano; ?></p>
        <p>Descrição: <?php echo $filme->descricao; ?></p>
        <a href="listar.php" class="home-link">Início</a>
    </div>
</body>
</html>
