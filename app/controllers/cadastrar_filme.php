<?php
// Iniciar a sessão (caso precise usar informações de sessão)
session_start();

// Incluir os arquivos de conexão com o banco de dados e a classe Filme
require_once 'app/config/Database.php';  // Arquivo que contém a classe de conexão com o banco
require_once 'app/model/Filme.php';  // Arquivo com a classe Filme

// Criar uma instância da classe Database para estabelecer a conexão com o banco de dados
$database = new Database();
$db = $database->GetConnection();  // Método que retorna a conexão com o banco de dados

// Verificar se o formulário foi enviado via POST (quando o usuário clicar no botão "Cadastrar Filme")
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Pegar os dados do formulário
    $titulo = $_POST['titulo'];  // O valor do campo "titulo"
    $ano = $_POST['ano'];  // O valor do campo "ano"
    $descricao = $_POST['descricao'];  // O valor do campo "descricao"

    // Validar os dados (checar se os campos não estão vazios)
    if (empty($titulo) || empty($ano) || empty($descricao)) {
        // Se algum campo estiver vazio, exibe um erro
        echo "Todos os campos são obrigatórios.";
        exit;  // Interrompe a execução do código
    }

    // Criar uma instância da classe Filme, passando a conexão com o banco
    $filme = new Filme($db);

    // Atribuir os valores recebidos do formulário aos atributos da classe Filme
    $filme->titulo = $titulo;
    $filme->ano = $ano;
    $filme->descricao = $descricao;

    // Tentar inserir o novo filme no banco de dados usando o método 'inserir'
    if ($filme->inserir()) {
        // Se a inserção for bem-sucedida, exibe uma mensagem de sucesso
        echo "Filme cadastrado com sucesso! <a href='listar.php'>Clique aqui para ver a lista de filmes</a>";
    } else {
        // Se houver algum erro ao cadastrar, exibe uma mensagem de erro
        echo "Erro ao cadastrar o filme. Tente novamente.";
    }
}
?>
