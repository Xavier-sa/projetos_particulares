<?php
// Inicia a sessão para exibir mensagens de sucesso ou erro
session_start();

// Verifica se o ID foi passado via POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Verifica se o ID é válido
    if (!is_numeric($id)) {
        echo "ID inválido!";
        exit;
    }

    // Conexão com o banco de dados
    require __DIR__ . "\..\..\Config\Database.php";  // Conexão com o banco de dados
    require __DIR__ . "\..\..\Model\Usuario.php";     // Inclusão do modelo de usuário

    // Instancia o modelo de Usuário
    $usuarioModel = new Usuario($conn);

    try {
        // Prepara a consulta para excluir o usuário
        $stmt = $conn->prepare("DELETE FROM usuario WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Executa a exclusão
        $stmt->execute();

        // Verifica se o usuário foi excluído
        if ($stmt->rowCount() > 0) {
            $_SESSION['msg'] = 'Usuário excluído com sucesso!';
        } else {
            $_SESSION['msg'] = 'Nenhum usuário encontrado com o ID fornecido.';
        }

    } catch (Exception $e) {
        $_SESSION['msg'] = 'Erro ao excluir usuário: ' . $e->getMessage();
    }

    // Redireciona para a página de listagem ou onde for necessário
    header("Location: ../index.php"); // Aqui subimos um nível e acessamos o index.php
    exit;
} else {
    echo "ID não fornecido!";
    exit;
}
?>
