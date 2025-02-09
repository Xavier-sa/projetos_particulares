<?php
// Inicia a sessão para acessar as variáveis de sessão
session_start();

// Verifica se o usuário está autenticado (se o 'usuario_id' existe na sessão)
if (!isset($_SESSION['usuario_id'])) {
    // Redireciona para a página de login se o usuário não estiver autenticado
    header('Location: login.php');
    exit();
}

// Inclui as configurações do banco de dados e o modelo de Produto
require_once '../../config/Database.php';
require_once '../../model/Produto.php';  // Supondo que a classe Produto exista
require_once '../../model/Venda.php';   // Supondo que você tenha uma classe para Vendas

$produtoModel = new Produto($conn);

// Verifica se existe uma pesquisa de produto
$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

// Recupera os produtos com base na pesquisa, se existir
if ($pesquisa) {
    $produtos = $produtoModel->searchByName($pesquisa);  // Método que realiza a busca pelo nome do produto
} else {
    $produtos = $produtoModel->findAll();  // Método para buscar todos os produtos
}

// Variáveis para o cálculo de vendas
$total = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se os dados de produtos e quantidades foram enviados corretamente
    if (isset($_POST['produtos']) && is_array($_POST['produtos']) && isset($_POST['quantidades']) && is_array($_POST['quantidades'])) {
        $produtosSelecionados = $_POST['produtos'];
        $quantidades = $_POST['quantidades'];

        // Preparar o array de produtos para a função de inserção
        $produtosVenda = [];
        foreach ($produtosSelecionados as $index => $produtoId) {
            // Verificar se o produto existe no banco
            $produto = $produtoModel->findById($produtoId);
            $quantidade = $quantidades[$index];
            
            if ($quantidade > 0) {
                $produtosVenda[] = [
                    'id' => $produtoId,
                    'quantidade' => $quantidade,
                    'preco' => $produto->preco,
                ];
            }
        }

        // Cálculo do total da venda
        foreach ($produtosVenda as $produtoVenda) {
            $total += $produtoVenda['preco'] * $produtoVenda['quantidade'];
        }

        // Verifica se o cliente foi selecionado
        $clienteId = isset($_POST['cliente_id']) ? $_POST['cliente_id'] : null;

        // Registrar a venda no banco com todos os produtos
        if (count($produtosVenda) > 0) {
            $vendaModel = new Venda($conn);
            $vendaModel->insertVenda($_SESSION['usuario_id'], $produtosVenda, $total, date('Y-m-d H:i:s'), $clienteId);
        } else {
            echo "Erro: Nenhum produto válido selecionado!";
        }
    } else {
        echo "Erro: Dados de produtos ou quantidades inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VENDER</title>
    <link rel="icon" href="../../assets/img/xavi.JPG" type="image/jpg">
    <link rel="stylesheet" href="../../assets/css/telavendas.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    
</head>
<body>

    <div class="barralateralmenu">
        <a href="tela_vendas.php">Vendas</a>
        <a href="../Usuario/clientesdevem.php">Clientes</a>
        <a href="estoque.php">Estoque</a>
        <a href="catalogo_produtos.php">Catálogo de Produtos</a>
        <a href="cadastrar_produto.php">Adicionar Produtos</a>
        <a href="editar_produto.php">Editar Produtos</a>

    </div>

    <div class="content">
        <!-- <div class="catalogo">
            <h1>EFETUAR VENDAS</h1>

            <form method="GET" class="form-pesquisa">
                <input type="text" name="pesquisa" value="<?php echo $pesquisa; ?>" placeholder="Pesquisar produtos..." 
                    style="padding: 10px; font-size: 1rem; margin-top: 10px; width: 100%; max-width: 400px; border-radius: 5px; border: 1px solid #ddd;">
                <button type="submit" style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px;">Buscar</button>
            </form>
        </div> -->

        <form method="POST" class="form-venda" id="formVenda">
            <h2>Selecione os produtos</h2>

            <div class="cards">
                <?php foreach ($produtos as $produto) { ?>
                    <div class="card" onclick="adicionarProduto(<?php echo $produto->id; ?>, '<?php echo $produto->nome; ?>', <?php echo $produto->preco; ?>)">
                        <img src="<?php echo $produto->imagem_url; ?>" alt="<?php echo $produto->nome; ?>" class="card-image">
                        <div class="card-info">
                            <h3 class="title"><?php echo $produto->nome; ?></h3>
                            <p class="preco">R$ <?php echo number_format($produto->preco, 2, ',', '.'); ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>

           
            <table id="tabelaProdutos">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
       

            <div class="valorfinal">
                <label for="dinheiroRecebido">Dinheiro Recebido</label>
                <input type="number" id="dinheiroRecebido" name="dinheiroRecebido" placeholder="Digite o valor recebido" step="0.01">
                <h3 id="totalVenda">TOTAL: R$ 0,00</h3>
                <h3 id="troco">TROCO: R$ 0,00</h3>
            </div>

            <button type="submit" class="btn-vender">Finalizar Venda</button>
            <button type="button" class="btn-voltar" onclick="window.history.back();">Voltar</button>
            <a href="../Usuario/login.php" class="btn-login">Login</a>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
            <div class="totalaserpago">
                <h3>Total a ser Pago: R$ <?php echo number_format($total, 2, ',', '.'); ?></h3>
            </div>
        <?php } ?>
    </div>

    <script src="../../assets/js/script.js"></script>

</body>
</html>
