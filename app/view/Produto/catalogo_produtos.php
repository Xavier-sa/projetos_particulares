<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root"; // ou o nome do seu usuário
$password = "";     // ou a senha do seu usuário
$dbname = "sistema_vendas"; // nome do banco de dados correto

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para buscar todas as categorias
$sql_categorias = "SELECT DISTINCT categoria FROM produtos";
$result_categorias = $conn->query($sql_categorias);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Produtos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Resetando estilos padrões */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            color: #333;
        }

        h1 {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .categoria {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .categoria h2 {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 15px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        /* Cards de produtos */
        .produtos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .produto {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .produto:hover {
            transform: translateY(-10px);
        }

        .produto img {
            max-width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .produto h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        .produto .preco {
            font-size: 1.3rem;
            color: #28a745;
            margin-bottom: 15px;
        }

        .produto .estoque {
            font-size: 1.1rem;
            color: #777;
            margin-bottom: 15px;
        }

        .produto .estoque.estoque-zero {
            color: #dc3545;
            font-weight: bold;
        }

        .produto button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .produto button:hover {
            background-color: #0056b3;
        }

        .search-container {
            margin-bottom: 30px;
            text-align: center;
        }

        .search-container input {
            padding: 10px;
            width: 80%;
            max-width: 400px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

    <h1>Catálogo de Produtos</h1>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Buscar por nome do produto...">
    </div>

    <?php
    // Verifica se há categorias para exibir
    if ($result_categorias->num_rows > 0) {
        while($categoria = $result_categorias->fetch_assoc()) {
            $categoria_nome = $categoria['categoria'];

            // Exibe o título da categoria
            echo "<div class='categoria'>";
            echo "<h2>" . ucfirst($categoria_nome) . "</h2>";

            // Consulta os produtos daquela categoria
            $sql_produtos = "SELECT * FROM produtos WHERE categoria = '$categoria_nome'";
            $result_produtos = $conn->query($sql_produtos);

            if ($result_produtos->num_rows > 0) {
                // Exibe os produtos da categoria
                echo "<div class='produtos'>";
                while($produto = $result_produtos->fetch_assoc()) {
                    echo "<div class='produto'>";
                    
                    // Aqui, a imagem será recuperada diretamente do banco
                    echo "<img src='" . $produto['imagem_url'] . "' alt='" . $produto['nome'] . "' />";
                    echo "<h3>" . $produto['nome'] . "</h3>";
                    echo "<p class='preco'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>";
                    echo "<p class='estoque'>Estoque: " . $produto['quantidade'] . "</p>";
                    if ($produto['quantidade'] == 0) {
                        echo "<p class='estoque estoque-zero'>Indisponível</p>";
                    }
                    echo "<button>Adicionar ao Carrinho</button>";
                    echo "</div>";
                }
                echo "</div>"; // Fecha a div dos produtos
            } else {
                echo "<p>Nenhum produto encontrado nesta categoria.</p>";
            }

            echo "</div>"; // Fecha a div da categoria
        }
    } else {
        echo "<p>Nenhuma categoria encontrada.</p>";
    }

    $conn->close();
    ?>

    <script>
        const searchInput = document.getElementById('searchInput');
        const produtos = document.querySelectorAll('.produto');

        searchInput.addEventListener('input', function() {
            const searchText = searchInput.value.toLowerCase();

            produtos.forEach(produto => {
                const nomeProduto = produto.querySelector('h3').textContent.toLowerCase();

                if (nomeProduto.includes(searchText)) {
                    produto.style.display = '';
                } else {
                    produto.style.display = 'none';
                }
            });
        });
    </script>

</body>
</html>
