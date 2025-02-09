<?php

session_start();


// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Pegar os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    // Incluir o arquivo de conexão e o modelo de usuário
    require_once '../config/Database.php';

    require_once '../model/Usuario.php';


    // Criar a conexão com o banco de dados
//   $database = new Database(
//     "sql203.infinityfree.com",
//     3306,                       
//     "if0_37783332",            
//     "catalogo1239",         
//     "if0_37783332_filmesdb" 

  $database = new Database(
    "localhost",
    3306,                       
    "root",            
    "",         
    "sistema_vendas" 


);
    $db = $database->createConnection();

    // Instanciar o modelo de usuário
    $usuario = new Usuario($db);

    // Tentar autenticar o usuário
    $usuarioAutenticado = $usuario->login($email, $senha);

    if ($usuarioAutenticado) {
        // Se a autenticação for bem-sucedida, armazenar os dados na sessão
        $_SESSION['usuario_id'] = $usuarioAutenticado['id'];
        $_SESSION['usuario_nome'] = $usuarioAutenticado['nome'];

        
        header("Location: ../view/Produto/tela_vendas.php");
        exit;  // Impede que o código abaixo seja executado
    } else {
        // Caso contrário, definir uma variável de erro
        $_SESSION['login_error'] = "E-mail ou senha inválidos!";
        header("Location: ../view/Usuario/login.php");  // Redireciona de volta para o login
        exit;
    }
}