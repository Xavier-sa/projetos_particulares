<?php
// Conexão com o banco de dados (MySQL)
$host = "localhost";
$user = "root";
$password = "";
$database = "trabalho";
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Função para verificar se o veículo está em uso (se já saiu, mas ainda não retornou)
function veiculoEmUso($conn, $placa_veiculo) {
    $sql = "SELECT * FROM registros WHERE placa_veiculo = ? AND hora_entrada IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $placa_veiculo);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Processar o registro de saída
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_saida'])) {
    $placa_veiculo = $_POST['placa_veiculo'];
    $matricula_saida = $_POST['matricula_motorista_saida'];
    $km_saida = $_POST['km_veiculo_saida'];
    $hora_saida = $_POST['hora_saida'];
    $data = $_POST['data'];

    // Verificar se o veículo já está em uso
    if (veiculoEmUso($conn, $placa_veiculo)) {
        echo "<script>alert('Erro: Este veículo já saiu e ainda não retornou. Registre a entrada primeiro.');</script>";
    } else {
        // Registrar a saída do veículo
        $sql = "INSERT INTO registros (placa_veiculo, matricula_saida, km_saida, hora_saida, data_registro) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiss", $placa_veiculo, $matricula_saida, $km_saida, $hora_saida, $data);
        $stmt->execute();
        $stmt->close();
    }
}

// Processar o registro de entrada
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_entrada'])) {
    $placa_veiculo = $_POST['placa_veiculo'];
    $matricula_entrada = $_POST['matricula_motorista_entrada'];
    $km_entrada = $_POST['km_veiculo_entrada'];
    $hora_entrada = $_POST['hora_entrada'];

    // Verificar se o veículo está em uso (ou seja, se já saiu e precisa registrar a entrada)
    if (veiculoEmUso($conn, $placa_veiculo)) {
        // Registrar a entrada do veículo
        $sql = "UPDATE registros 
                SET matricula_entrada = ?, km_entrada = ?, hora_entrada = ? 
                WHERE placa_veiculo = ? AND hora_entrada IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siss", $matricula_entrada, $km_entrada, $hora_entrada, $placa_veiculo);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "<script>alert('Erro: Este veículo ainda não saiu. Registre a saída primeiro.');</script>";
    }
}

// Buscar registros
$result = $conn->query("SELECT * FROM registros ORDER BY data_registro DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Veículos</title>
    <link rel="stylesheet" href="/app/view/assets/css/style.css">
   
    <script>
        // Função para exibir o formulário de saída
        function exibirFormSaida() {
            document.getElementById('formSaida').style.display = 'block';
            document.getElementById('formEntrada').style.display = 'none';
        }

        // Função para exibir o formulário de entrada
        function exibirFormEntrada() {
            document.getElementById('formEntrada').style.display = 'block';
            document.getElementById('formSaida').style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Controle de Entrada e Saída de Veículos</h1>

        <!-- Botões para exibir os formulários -->
        <button onclick="exibirFormSaida()">Registrar Saída</button>
        <button onclick="exibirFormEntrada()">Registrar Entrada</button>

        <!-- Formulário de saída -->
        <div id="formSaida" class="form-container">
            <h2>Registrar Saída</h2>
            <form method="POST">
                <input type="hidden" name="registrar_saida" value="1">
                <input type="text" name="placa_veiculo" placeholder="Placa do Veículo" required>
                <input type="text" name="matricula_motorista_saida" placeholder="Matrícula do Motorista" required>
                <input type="number" name="km_veiculo_saida" placeholder="KM (Saída)" required>
                <input type="time" name="hora_saida" required>
                <input type="date" name="data" required>
                <button type="submit">Registrar Saída</button>
            </form>
        </div>

        <!-- Formulário de entrada -->
        <div id="formEntrada" class="form-container">
            <h2>Registrar Entrada</h2>
            <form method="POST">
                <input type="hidden" name="registrar_entrada" value="1">
                <input type="text" name="placa_veiculo" placeholder="Placa do Veículo" required>
                <input type="text" name="matricula_motorista_entrada" placeholder="Matrícula do Motorista" required>
                <input type="number" name="km_veiculo_entrada" placeholder="KM (Entrada)" required>
                <input type="time" name="hora_entrada" required>
                <button type="submit">Registrar Entrada</button>
            </form>
        </div>

        <!-- Tabela de histórico -->
        <div class="table-container">
            <h2>Histórico</h2>
            <table>
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Motorista Saída</th>
                        <th>KM (Saída)</th>
                        <th>Hora (Saída)</th>
                        <th>Motorista Entrada</th>
                        <th>KM (Entrada)</th>
                        <th>Hora (Entrada)</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['placa_veiculo']) ?></td>
                            <td><?= htmlspecialchars($row['matricula_saida']) ?></td>
                            <td><?= htmlspecialchars($row['km_saida']) ?></td>
                            <td><?= htmlspecialchars($row['hora_saida']) ?></td>
                            <td><?= htmlspecialchars($row['matricula_entrada']) ?></td>
                            <td><?= htmlspecialchars($row['km_entrada']) ?></td>
                            <td><?= htmlspecialchars($row['hora_entrada']) ?></td>
                            <td><?= htmlspecialchars($row['data_registro']) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>