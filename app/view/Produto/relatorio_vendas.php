<?php
// Relatório de Vendas
require_once '../../config/Database.php';

// Consultar todas as vendas
$query = "SELECT v.id, p.nome AS produto, v.quantidade, v.total, u.nome AS usuario, v.data_hora 
          FROM vendas v
          JOIN produtos p ON v.produto_id = p.id
          JOIN usuarios u ON v.usuario_id = u.id";
$stmt = $conn->prepare($query);
$stmt->execute();
$vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Vendas</title>
    <style>
        /* Estilo global */
body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background-color: #0C1445; /* Azul escuro, fundo */
    color: #FFFFFF; /* Branco */
    text-align: center;
}

/* Estilo para o Cabeçalho */
h1, h2 {
    font-family: 'Impact', sans-serif; /* Fonte com estilo DBZ */
    font-size: 3rem; /* Aumenta o tamanho para dar mais impacto */
    color: #FFD700; /* Amarelo forte */
    text-shadow: 3px 3px 0px #FF4500, 6px 6px 0px #000; /* Laranja e sombra preta */
}

/* Estilo para os Parágrafos */
p {
    font-family: 'Impact', sans-serif; /* Fonte com estilo DBZ */
    font-size: 2.5rem; /* Tamanho grande para dar um estilo forte */
    color: #ffd90073; /* Amarelo forte com transparência */
    text-shadow: 3px 3px 0px #ffdd0078, 6px 6px 0px #000; /* Laranja e sombra preta */
}

/* Links */
a {
    text-decoration: none;
    color: #FFD700; /* Amarelo */
    font-weight: bold;
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    /* background-color: #4CAF50; */
    border-radius: 5px;
}

a:hover {
    color: #FF4500; /* Laranja */
    text-shadow: 1px 1px 2px #FFF;
    /* background-color: #45a049; */
}

/* Menu de Navegação */
nav {
    background-color: #FF4500; /* Laranja */
    padding: 15px 0; /* Mais espaço */
    border-bottom: 5px solid #FFD700; /* Borda amarela */
}

nav ul {
    list-style: none; /* Remove os marcadores de lista */
    padding: 0;
    margin: 0;
    text-align: center;
}

nav li {
    display: inline-block;
    margin-right: 30px; /* Espaçamento entre os itens */
}

nav a {
    text-decoration: none;
    color: #FFD700; /* Amarelo */
    font-size: 2rem; /* Tamanho da fonte grande */
    font-weight: bold;
    transition: 0.3s ease-in-out;
}

nav a:hover {
    color: #FF4500; /* Laranja */
    text-shadow: 1px 1px 2px #FFF;
}

/* Responsividade do Menu */
@media (max-width: 768px) {
    nav li {
        display: block; /* Coloca os itens do menu em coluna */
        margin: 10px 0;
    }

    nav a {
        font-size: 1.5rem; /* Reduz o tamanho da fonte em telas menores */
    }
}

/* Botões */
button {
    background-color: #FF4500; /* Laranja */
    border: 2px solid #FFD700; /* Borda amarela */
    color: #000;
    padding: 10px 20px;
    font-size: 1rem;
    font-weight: bold;
    text-transform: uppercase;
    box-shadow: 3px 3px 0px #000;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
}

button:hover {
    background-color: #FFD700; /* Amarelo */
    color: #000;
    transform: translateY(-5px); /* Efeito de salto */
    box-shadow: 5px 5px 0px #000;
}

/* Formulário */
form {
    background-color: #FF4500; /* Laranja */
    padding: 20px;
    margin: 20px auto;
    width: 80%;
    max-width: 400px;
    border: 5px solid #FFD700; /* Borda amarela */
    border-radius: 10px;
    box-shadow: 5px 5px 0px #000;
}

input[type="text"] {
    padding: 10px;
    width: 90%;
    margin: 10px 0;
    border: 2px solid #FFD700;
    border-radius: 5px;
    font-size: 1rem;
    text-align: center;
}

input:focus {
    outline: none;
    border-color: #FFFFFF;
    box-shadow: 0px 0px 5px #FFD700;
}

/* Tabela */
table {
    width: 80%;  /* Define a largura da tabela */
    margin: 20px auto;  /* Centraliza a tabela horizontalmente com margem no topo */
    border-collapse: collapse;  /* Remove os espaços entre as bordas */
    background-color: #ffffff83;  /* Cor de fundo branca para a tabela */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);  /* Sombras para dar um efeito */
}

th, td {
    padding: 12px;  /* Adiciona espaçamento interno nas células */
    text-align: left;  /* Alinha o texto à esquerda nas células */
    border: 1px solid #c8a91c;  /* Borda de 1px nas células */
}

th {
    background-color: #c8c07895;  /* Cor de fundo para o cabeçalho da tabela */
    color: #333;  /* Cor do texto no cabeçalho */
}

tr:nth-child(even) {
    background-color: #9ca11f;  /* Altera a cor de fundo para as linhas pares */
}

/* Rodapé */
footer {
    /* background-color: #333; Cor de fundo escura */
    color: #fff; /* Cor do texto branca */
    text-align: center; /* Alinha o texto ao centro */
    padding: 20px 0; /* Espaçamento no topo e na base */
    position: fixed;
    bottom: 0;
    width: 100%; /* Faz o footer ocupar toda a largura da página */
}

footer p {
    margin: 0; /* Remove qualquer margem extra */
    font-size: 1rem; /* Tamanho de fonte moderado */
}

    </style>
</head>
<body>

<h1>Relatório de Vendas</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Total</th>
            <th>Usuário</th>
            <th>Data e Hora</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vendas as $venda): ?>
            <tr>
                <td><?php echo $venda['id']; ?></td>
                <td><?php echo $venda['produto']; ?></td>
                <td><?php echo $venda['quantidade']; ?></td>
                <td>R$ <?php echo number_format($venda['total'], 2, ',', '.'); ?></td>
                <td><?php echo $venda['usuario']; ?></td>
                <td><?php echo $venda['data_hora']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
