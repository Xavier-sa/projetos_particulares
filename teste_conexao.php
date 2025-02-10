<?php
// Dados de conexão
$servidor = "sql203.infinityfree.com";  // Nome do servidor MySQL (correto)
$usuario = "if0_37783332";              // Nome do usuário do banco de dados
$senha = "catalogo1239";               // Senha do banco de dados (do vPanel)
$banco = "if0_37783332_filmesdb";      // Nome do banco de dados

// Criando a conexão
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);  // Exibe o erro, se houver
} else {
    echo "Conexão bem-sucedida ao banco de dados!";
}

// Fecha a conexão
$conexao->close();
?>
