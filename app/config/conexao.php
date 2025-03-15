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

    $sql = "INSERT INTO registros (nome_aluno, placa_veiculo, matricula_saida, km_saida, hora_saida, matricula_entrada, km_entrada, hora_entrada, data_registro) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiissis", $nome_aluno, $placa_veiculo, $matricula_saida, $km_saida, $hora_saida, $matricula_entrada, $km_entrada, $hora_entrada, $data);
    $stmt->execute();
    $stmt->close();
}

// Buscar registros
$result = $conn->query("SELECT * FROM registros ORDER BY data_registro DESC");
?>
