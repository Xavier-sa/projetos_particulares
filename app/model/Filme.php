<?php

require_once "Model.php";

// Classe Model que representa uma tabela no banco
class Filme extends Model {

    protected $table = "filmes";  // Tabela no banco de dados
    protected $class = __CLASS__;  // Classe para o objeto atual

    // Atributos que representam as colunas da tabela
    public $id;
    public $titulo;
    public $ano;
    public $descricao;
    public $imagem_url;  // adicionado dia 21 (Atributo para armazenar a URL da imagem)
    public $favorito = 0;  // adicionado dia 21 (Atributo para marcar se o filme é favorito (default: 0))

    // Construtor da classe
    public function __construct($conn = null) {
        parent::__construct($conn);
    }

    // Método para inserir um novo filme no banco de dados
    public function inserir() {
        // SQL para inserir um novo filme
        $query = "INSERT INTO " . $this->table . " (titulo, ano, descricao, favorito, imagem_url) 
                  VALUES (:titulo, :ano, :descricao, :favorito, :imagem_url)";

        // Preparar a consulta
        $stmt = $this->conn->prepare($query);

        // Vincular os parâmetros aos valores do objeto
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":ano", $this->ano);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":favorito", $this->favorito, PDO::PARAM_INT);  // Garantir que 'favorito' é um inteiro
        $stmt->bindParam(":imagem_url", $this->imagem_url);  // Campo para armazenar a URL da imagem
        
        // Tentar executar a consulta e verificar se a inserção foi bem-sucedida
        if ($stmt->execute()) {
            // Retorna o ID do novo filme inserido
            $this->id = $this->conn->lastInsertId();
            return true;
        } else {
            // Se a execução falhar, retorna false
            return false;
        }
    }

    // Método para favoritar um filme
    public function favoritarFilme($id) {
        // Atualiza o campo "favorito" do filme para 1 (verdadeiro)
        $sql = "UPDATE " . $this->table . " SET favorito = 1 WHERE id = :id";

        // Prepara a query
        $stmt = $this->conn->prepare($sql);

        // Vincula o ID do filme ao parâmetro da query
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Executa a query e retorna o resultado
        return $stmt->execute();
    }

    // Método para editar um filme
    public function editar() {
        var_dump($this->titulo, $this->descricao, $this->id);

        // A consulta de atualização não deve alterar o ID
        $query = "UPDATE " . $this->table . " SET titulo = :titulo, descricao = :descricao, ano = :ano, imagem_url = :imagem_url WHERE id = :id";
        
        // Preparando a consulta
        $stmt = $this->conn->prepare($query);
        
        // Bind dos parâmetros
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':ano', $this->ano);  // Vincula o valor do ano
        $stmt->bindParam(':imagem_url', $this->imagem_url);  // Vincula a URL da imagem
        $stmt->bindParam(':id', $this->id);
      
        
        // Verifique se a execução foi bem-sucedida
        if ($stmt->execute()) {
            return true;
        } else {
            // Caso a execução falhe, você pode capturar mais informações
            $errorInfo = $stmt->errorInfo(); // Pega o erro gerado na execução da consulta
            echo "Erro: " . $errorInfo[2]; // Mostra a mensagem de erro
            return false;
        }
    }
}
?>
