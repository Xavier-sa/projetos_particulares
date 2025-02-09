<?php
class Usuario {
    private $conn;
    private $table = 'usuarios';  // Nome da tabela no banco de dados

    // Propriedades do Usuário
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $data_criacao;

    // Construtor que recebe a conexão
    public function __construct($db) {
        $this->conn = $db;
    }

    // Função para criar um novo usuário
    public function create($nome, $email, $senhaHash) {
        // Verifica se o email já existe
        if ($this->emailExiste($email)) {
            return false;  // Retorna false se o email já existir
        }
    
        // Comando SQL para inserir um novo usuário
        $query = "INSERT INTO " . $this->table . " (nome, email, senha) VALUES (:nome, :email, :senha)";
        
        // Preparando a consulta
        $stmt = $this->conn->prepare($query);
    
        // Bind dos parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
    
        // Executa a consulta
        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
        return false;
    }
    
    // Função de login
    public function login($email, $senha) {
        $query = "SELECT id, nome, email, senha FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
    
        // Filtrando os dados
        $stmt->bindParam(":email", $email);
    
        // Executa a query
        $stmt->execute();
    
        // Verifica se o usuário existe
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verifica se a senha está correta (usando hash de senha, por exemplo)
            if (password_verify($senha, $row['senha'])) {
                return $row;  // Retorna os dados do usuário
            } else {
                return false;  // Senha incorreta
            }
        }
    
        // Retorna false se o login falhar
        return false;
    }

    // Função para verificar se o email já existe
    public function emailExiste($email) {
        $query = "SELECT id FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            return true; // Email já existe
        }
        return false; // Email não existe
    }

    // Função para listar todos os usuários
    public function listarUsuarios() {
        $query = "SELECT id, nome, email FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Função para excluir usuário
    public function excluirUsuario($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        try {
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    // Função para editar dados de usuário
    public function editarUsuario($id, $nome, $email) {
        $query = "UPDATE " . $this->table . " SET nome = :nome, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        try {
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }
    
}
?>
