<?php
// Iniciar a sessão
session_start();

// Incluir o arquivo de conexão e o modelo de usuário
require_once '../config/Database.php';
require_once '../model/Usuario.php';

// Credenciais do banco de dados
$host = "localhost";
$port = 3306;
$username = "root";
$password = "";
$db_name = "sistema_vendas";

// Criar a conexão com o banco de dados
$database = new Database($host, $port, $username, $password, $db_name);
$conn = $database->createConnection(); // A variável $conn é agora a conexão com o DB

// Verificando se a conexão foi bem-sucedida
if ($conn === null) {
    echo "Erro na conexão com o banco de dados!";
    exit;
}

// Instanciar o modelo de usuário
$usuario = new Usuario($conn);

// Pegar os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// Hash da senha
$senhaHash = password_hash($senha, PASSWORD_BCRYPT); // Usando bcrypt para hashing seguro

// Criar o usuário
if ($usuario->create($nome, $email, $senhaHash)) {
    $_SESSION['sucesso'] = "Cadastro realizado com sucesso!";
    header("Location: ../view/Produto/tela_vendas.php"); // Redirecionar para a lista de produtos após o cadastro
    exit();
} else {
    $_SESSION['erro'] = "Erro ao criar o usuário!";
    header("Location: ../view/Usuario/registrar.php"); // Redirecionar de volta ao formulário de registro
    exit();
}
?>
