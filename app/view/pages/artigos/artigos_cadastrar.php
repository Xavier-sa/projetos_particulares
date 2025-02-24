
<?php
require_once('../../../config/env.php');
require_once('../../componentes/navbar.php');
require_once('../componentes/sidebar.php');

require_once ('../listar_lista.php');  /* testando */
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xavier Solutions - Cadastro de Artigo</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>style.css">
</head>
<body>

<main class="content">
<h1>Cadastro de Artigo</h1>
  <form id="form-artigo">
    <label for="titulo">Título</label>
    <input type="text" id="titulo" name="titulo" required><br><br>
    
    <label for="conteudo">Conteúdo</label>
    <textarea id="conteudo" name="conteudo" required></textarea><br><br>
    
    <button type="submit">Salvar</button>
  </form>


<?php require_once('../componentes/footer.php'); ?>
<script>
    document.getElementById('form-artigo').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Artigo cadastrado com sucesso (simulado)!');
    });
  </script>
</body>
</html>
