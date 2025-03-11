<?php
// Conexão com o banco de dados (MySQL)
$host = "localhost";
$user = "root";
$password = "";
$database = "aula_db";
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Função para executar consultas SQL e exibir resultados
function executarConsulta($conn, $sql) {
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "<script>alert('Operação realizada com sucesso!');</script>";
    } elseif ($result === FALSE) {
        echo "<script>alert('Erro na operação: " . $conn->error . "');</script>";
    } else {
        return $result; // Retorna o resultado para SELECT
    }
}

// Processar formulários
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['inserir_marca'])) {
        $nome_marca = $_POST['nome_marca'];
        $sql = "INSERT INTO marcas (nome) VALUES ('$nome_marca')";
        executarConsulta($conn, $sql);
    }

    if (isset($_POST['inserir_carro'])) {
        $placa = $_POST['placa'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $ano = $_POST['ano'];
        $sql = "INSERT INTO carros (placa, marca, modelo, ano) VALUES ('$placa', '$marca', '$modelo', $ano)";
        executarConsulta($conn, $sql);
    }

    if (isset($_POST['atualizar_carro'])) {
        $placa = $_POST['placa'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $ano = $_POST['ano'];
        $sql = "UPDATE carros SET marca = '$marca', modelo = '$modelo', ano = $ano WHERE placa = '$placa'";
        executarConsulta($conn, $sql);
    }

    if (isset($_POST['excluir_carro'])) {
        $placa = $_POST['placa'];
        $sql = "DELETE FROM carros WHERE placa = '$placa'";
        executarConsulta($conn, $sql);
    }
}

// Buscar registros
$marcas = $conn->query("SELECT * FROM marcas");
$carros = $conn->query("SELECT * FROM carros");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Veículos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin-bottom: 20px;
        }
        input, select, button {
            padding: 8px;
            margin: 5px 0;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestão de Veículos</h1>

        <!-- Formulário para inserir marca -->
        <h2>Inserir Marca</h2>
        <form method="POST">
            <input type="text" name="nome_marca" placeholder="Nome da Marca" required>
            <button type="submit" name="inserir_marca">Inserir Marca</button>
        </form>

        <!-- Formulário para inserir carro -->
        <h2>Inserir Carro</h2>
        <form method="POST">
            <input type="text" name="placa" placeholder="Placa" required>
            <input type="text" name="marca" placeholder="Marca" required>
            <input type="text" name="modelo" placeholder="Modelo">
            <input type="number" name="ano" placeholder="Ano">
            <button type="submit" name="inserir_carro">Inserir Carro</button>
        </form>

        <!-- Formulário para atualizar carro -->
        <h2>Atualizar Carro</h2>
        <form method="POST">
            <input type="text" name="placa" placeholder="Placa do Carro" required>
            <input type="text" name="marca" placeholder="Nova Marca" required>
            <input type="text" name="modelo" placeholder="Novo Modelo">
            <input type="number" name="ano" placeholder="Novo Ano">
            <button type="submit" name="atualizar_carro">Atualizar Carro</button>
        </form>

        <!-- Formulário para excluir carro -->
        <h2>Excluir Carro</h2>
        <form method="POST">
            <input type="text" name="placa" placeholder="Placa do Carro" required>
            <button type="submit" name="excluir_carro">Excluir Carro</button>
        </form>

        <!-- Tabela de Marcas -->
        <h2>Marcas Cadastradas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $marcas->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['nome'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Tabela de Carros -->
        <h2>Carros Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $carros->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['placa'] ?></td>
                        <td><?= $row['marca'] ?></td>
                        <td><?= $row['modelo'] ?></td>
                        <td><?= $row['ano'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>