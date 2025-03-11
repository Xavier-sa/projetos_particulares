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

// Função para verificar se o veículo está em uso
function veiculoEmUso($conn, $placa_veiculo) {
    $sql = "SELECT * FROM registros WHERE placa_veiculo = ? AND hora_entrada IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $placa_veiculo);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0; // Retorna true se o veículo estiver em uso
}

// Processar formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_aluno = $_POST['nome_aluno'];
    $placa_veiculo = $_POST['placa_veiculo'];
    $matricula_saida = $_POST['matricula_motorista_saida'];
    $km_saida = $_POST['km_veiculo_saida'];
    $hora_saida = $_POST['hora_saida'];
    $matricula_entrada = $_POST['matricula_motorista_entrada'];
    $km_entrada = $_POST['km_veiculo_entrada'];
    $hora_entrada = $_POST['hora_entrada'];
    $data = $_POST['data'];

    // Verificar se o veículo já está em uso
    if (veiculoEmUso($conn, $placa_veiculo)) {
        // Se estiver em uso, só permite registrar a entrada
        if (!empty($hora_entrada)) {
            $sql = "UPDATE registros SET matricula_entrada = ?, km_entrada = ?, hora_entrada = ? WHERE placa_veiculo = ? AND hora_entrada IS NULL";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("siss", $matricula_entrada, $km_entrada, $hora_entrada, $placa_veiculo);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "<script>alert('Erro: Este veículo já está em uso. Registre a entrada antes de uma nova saída.');</script>";
        }
    } else {
        // Se não estiver em uso, permite registrar a saída
        if (!empty($hora_saida)) {
            $sql = "INSERT INTO registros (nome_aluno, placa_veiculo, matricula_saida, km_saida, hora_saida, data_registro) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssiss", $nome_aluno, $placa_veiculo, $matricula_saida, $km_saida, $hora_saida, $data);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "<script>alert('Erro: Registre a saída do veículo.');</script>";
        }
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
        // Função para exibir/ocultar o formulário
        function toggleForm() {
            const formContainer = document.querySelector('.form-container');
            formContainer.classList.toggle('active');
        }
    </script>
</head>
<body>
    <h1>Controle de Entrada e Saída de Veículos</h1>

    <!-- Botão para exibir o formulário -->
    <button onclick="toggleForm()">Adicionar Registro</button>

    <!-- Formulário de registro -->
    <div class="form-container">
        <h2>Registrar Entrada e Saída</h2>
        <form method="POST">
            <input type="text" name="nome_aluno" placeholder="Nome do Aluno" required>
            <input type="text" name="placa_veiculo" placeholder="Placa do Veículo" required>
            <input type="text" name="matricula_motorista_saida" placeholder="Matrícula (Saída)" required>
            <input type="number" name="km_veiculo_saida" placeholder="KM (Saída)" required>
            <input type="time" name="hora_saida" required>
            <input type="text" name="matricula_motorista_entrada" placeholder="Matrícula (Entrada)" required>
            <input type="number" name="km_veiculo_entrada" placeholder="KM (Entrada)" required>
            <input type="time" name="hora_entrada" required>
            <input type="date" name="data" required>
            <button type="submit">Registrar</button>
        </form>
    </div>

    <!-- Tabela de histórico -->
    <div class="table-container">
        <h2>Histórico</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Placa</th>
                    <th>Motorista </th>
                    <th>KM (Saída)</th>
                    <th>Hora (Saída)</th>
                    <th>Motorista</th>
                    <th>KM (Entrada)</th>
                    <th>Hora (Entrada)</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nome_aluno']) ?></td>
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
</body>
</html>

<?php $conn->close(); ?>