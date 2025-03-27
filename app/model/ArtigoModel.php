<?php
class ArtigoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function criarArtigo($titulo, $conteudo, $id_categoria, $id_usuario) {
        try {
            $sql = "INSERT INTO artigos (titulo, conteudo, id_categoria, id_usuario) 
                    VALUES (:titulo, :conteudo, :id_categoria, :id_usuario)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $stmt->bindParam(':conteudo', $conteudo, PDO::PARAM_STR);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao criar artigo: " . $e->getMessage());
            return false;
        }
    }

    public function listarArtigos() {
        try {
            $sql = "SELECT * FROM artigos";
            return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar artigos: " . $e->getMessage());
            return [];
        }
    }

    public function excluirArtigo($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM artigos WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao excluir artigo: " . $e->getMessage());
            return false;
        }
    }
}
?>