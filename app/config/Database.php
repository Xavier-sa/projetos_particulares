<?php

class Database
{
    private $host;
    private $port;
    private $username;
    private $password;
    private $db;
    private $conn;

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
    public function createConnection()
    {
        try {
            // Usa o host correto
            $connUrl = "mysql:host={$this->host};port={$this->port};dbname={$this->db};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            // Criação da conexão
            $this->conn = new PDO($connUrl, $this->username, $this->password, $options);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }
}

// Defina os parâmetros de conexão do banco de dados
$host = "localhost";  // Host do banco de dados (pode ser um IP ou nome do host)
$port = 3306;         // Porta do MySQL (geralmente 3306)
$username = "root";   // Usuário do banco de dados
$password = "";       // Senha do banco de dados (no XAMPP padrão é vazia)
$db = "sistema_vendas";     // Nome do banco de dados

// Instanciar a classe Database com os parâmetros definidos
$database = new Database($host, $port, $username, $password, $db);

// Criar a conexão com o banco de dados
$conn = $database->createConnection();

// Verificar se a conexão foi bem-sucedida
// if ($conn === null) {
//     echo "Erro na conexão com o banco de dados!";
//     exit;  // Se a conexão falhar, interrompa a execução
// } else {
//     echo "Conexão com o banco de dados bem-sucedida!";
// }
