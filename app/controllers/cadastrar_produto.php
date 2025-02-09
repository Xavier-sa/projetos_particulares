<?php
// Iniciar a sessão (caso precise usar informações de sessão)
session_start();

// Incluir os arquivos de conexão com o banco de dados e a classe Produto
require_once 'app/config/Database.php';  // Arquivo que contém a classe de conexão com o banco
require_once 'app/model/Produto.php';  // Arquivo com a classe Produto

// Criar uma instância da classe Database para estabelecer a conexão com o banco de dados
$database = new Database();
$db = $database->GetConnection();  // Método que retorna a conexão com o banco de dados

// Verificar se o formulário foi enviado via POST (quando o usuário clicar no botão "Cadastrar Produto")
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Pegar os dados do formulário
    $nome = $_POST['nome'];  // O valor do campo "nome"
    $quantidade = $_POST['quantidade'];  // O valor do campo "quantidade"
    $preco = $_POST['preco'];  // O valor do campo "preco"
    $descricao = $_POST['descricao'];  // O valor do campo "descricao"
    $imagem_url = $_POST['imagem_url'];  // O valor do campo "imagem_url"

    // Validar os dados (checar se os campos não estão vazios)
    if (empty($nome) || empty($quantidade) || empty($preco) || empty($descricao)) {
        // Se algum campo estiver vazio, exibe um erro
        echo "Todos os campos são obrigatórios.";
        exit;  // Interrompe a execução do código
    }

    // Criar uma instância da classe Produto, passando a conexão com o banco
    $produto = new Produto($db);

    // Atribuir os valores recebidos do formulário aos atributos da classe Produto
    $produto->nome = $nome;
    $produto->quantidade = $quantidade;
    $produto->preco = $preco;
    $produto->descricao = $descricao;
    $produto->imagem_url = $imagem_url;

    // Tentar inserir o novo produto no banco de dados usando o método 'inserir'
    if ($produto->inserir()) {
        // Se a inserção for bem-sucedida, exibe uma mensagem de sucesso
        echo "Produto cadastrado com sucesso! <a href='listar_produtos.php'>Clique aqui para ver a lista de produtos</a>";
    } else {
        // Se houver algum erro ao cadastrar, exibe uma mensagem de erro
        echo "Erro ao cadastrar o produto. Tente novamente.";
    }
}
?>
