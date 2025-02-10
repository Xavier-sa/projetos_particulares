<?php

require __DIR__ . "\..\..\Config\Database.php";
require __DIR__ . "\..\..\Model\Filme.php";

// meu_trecho_verificando_usuario_logado
session_start();

// Verifica se a sessão 'usuario_id' está definida
if (!isset($_SESSION['usuario_id'])) {
    // Se não estiver, redireciona ou mostra uma mensagem de erro
    header('Location: login.php'); // Redireciona para uma página de login
    exit;
}

// logado/deslogado




if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    return header("Location: Listar.php");
}

$id = (int) $_POST["id"];

$filmeModel = new Filme($conn);
$sucesso = $filmeModel->delete($id);

if ($sucesso === TRUE) {
    return header("Location: Listar.php?mensagem=sucesso");
} else {
    return header("Location: Listar.php?mensagem=erro");
}
