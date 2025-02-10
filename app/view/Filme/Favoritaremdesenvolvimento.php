<?php

require __DIR__ . "\..\..\Config\Database.php";
require __DIR__ . "\..\..\Model\Filme.php";

// Verifica se o ID foi passado e marca o filme como favorito
if (isset($_POST['id'])) {
    $filmeModel = new Filme($conn);
    $resultado = $filmeModel->favoritarFilme($_POST['id']); // Método no modelo Filme

    // Após favoritar, redireciona de volta com a mensagem de sucesso ou erro
    if ($resultado) {
        header('Location: index.php?mensagem=sucesso');
    } else {
        header('Location: index.php?mensagem=erro');
    }
    exit;
}
?>

?>
<script>
    const parametros = new URLSearchParams(window.location.search)
const tipoMensagem = parametros.get("mensagem")

if (tipoMensagem === "sucesso") {
    const notificacao = document.createElement("div")
    notificacao.className = "notificacao sucesso"
    notificacao.innerHTML = "Operação realizada com sucesso!"
    
    document.body.appendChild(notificacao)
    
    setTimeout(function() {
        document.body.removeChild(notificacao)
    }, 2000)
} else if (tipoMensagem === "erro") {
    const notificacao = document.createElement("div")
    notificacao.className = "notificacao erro"
    notificacao.innerHTML = "Erro ao realizar operação!"
    
    document.body.appendChild(notificacao)
    
    setTimeout(function() {
        document.body.removeChild(notificacao)
    }, 2000)
}

</script>


