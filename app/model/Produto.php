<?php

require_once "Model.php";

// Classe Produto que herda de Model
class Produto extends Model {

    protected $table = "produtos";  // Nome da tabela no banco de dados
    protected $class = __CLASS__;   // Classe para o objeto atual

    // Atributos que representam as colunas da tabela
    public $id;
    public $nome;
    public $quantidade;
    public $preco;
    // public $descricao;
    public $imagem_url;  // Atributo para armazenar a URL da imagem

    // Construtor da classe
    public function __construct($conn = null) {
        parent::__construct($conn);  // Chama o construtor da classe Model
    }

    // Método para inserir um novo produto no banco de dados
    public function inserir() {
        return $this->insert($this);
    }

    // Método para editar um produto existente
    public function editar() {
        return $this->updateById($this->id, $this);
    }

    // Método para deletar um produto
    public function deletar() {
        return $this->delete($this->id);
    }

    // Método para buscar todos os produtos
    public static function todos($conn) {
        $produto = new Produto($conn);
        return $produto->findAll();
    }

    // Método para buscar um produto pelo ID
    public static function buscarPorId($conn, $id) {
        $produto = new Produto($conn);
        return $produto->findById($id);
    }
    

    public function searchByName($pesquisa) {
        $sql = "SELECT * FROM produtos WHERE nome LIKE ? ORDER BY nome";
        $stmt = $this->conn->prepare($sql);
        $pesquisa = "%$pesquisa%";  // Usando wildcards para busca parcial
        $stmt->bind_param("s", $pesquisa);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);  // Retorna todos os produtos encontrados
    }
    

    
}





?>
