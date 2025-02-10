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
