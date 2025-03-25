<?php

class Database
{
    private $host = "localhost";
    private $port = "3306";
    private $username ="root";
    private $password;
    private $dbName = "xavier_solutions";
    

    // Responsável por instanciar um objeto de Database
    public function __construct($host, $port, $username, $password, $db)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;
    }

    // Responsável por criar a conexão com o DB
    public function createConnection() {
        try {
            // Usa o host correto
            $connUrl = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4"; 
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            // Criação da conexão
            $this->conn = new PDO($connUrl, $this->username, $this->password);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();  // Exibe o erro completo
            return null;
        }
    }
}

// Substitua pelos seus dados do banco de dados local
$database = new Database(
    "localhost",   // Host local
    3306,          // Porta padrão do MySQL
    "root",        // Nome de usuário padrão do MySQL (pode ser diferente, dependendo da sua instalação)
    "",            // Senha do MySQL (normalmente vazia para 'root' se você não configurou)
    "xavier_solutions"    // Nome do banco de dados que você criou
);

$conn = $database->createConnection();
