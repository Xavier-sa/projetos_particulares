<?php

// classe Model genérica que representa uma tabela no banco
class Model {

    protected $conn;
    protected $table;

    public function __construct($conn = null) {
        $this->conn = $conn;
    }

    // retorna todos os registros numa lista de objetos Model
    public function findAll() {
        $query = "SELECT * FROM $this->table";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);

        return $stmt->fetchAll();
    }

    // retorna um registro como objeto de Model
    public function findById($id) {
        $query = "SELECT * FROM $this->table WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);

        return $stmt->fetch();
    }

    // cria um registro de Model a partir de um objeto Model
    public function insert($obj) {
        $columns = $this->getColumns();
        $placeholders = $this->getPlaceholders($columns);

        $query = "INSERT INTO $this->table (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $placeholders) . ")";

        $stmt = $this->conn->prepare($query);
        $this->bindParams($stmt, $columns, $obj);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $obj->id = $this->conn->lastInsertId();
            return $obj;
        }
        return null;
    }

    // atualiza um registro pelo ID
    public function updateById($id, $obj) {
        $columns = $this->getColumns();
        $placeholders = $this->getPlaceholders($columns, TRUE);

        $query = "UPDATE $this->table SET " . implode(", ", $placeholders) . " WHERE id = :id";

        echo("<pre>");
        print_r($query);
        echo("</pre>");

        $stmt = $this->conn->prepare($query);
        $this->bindParams($stmt, $columns, $obj);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $obj->id = $id; // Atualiza o ID do objeto caso o método seja chamado com um novo filme
            return $obj; // Retorna o próprio objeto atualizado
        }
        return null;
    }

    // Método para deletar um registro pelo ID
    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount() > 0; // Retorna true se a exclusão foi bem-sucedida, false caso contrário
    }

    private function getColumns() {
        // captura todos atributos da classe
        $columns = array_keys(get_object_vars($this));

        // ignora atributos não relacionados à tabela | id pois é chave primária
        $columns = array_diff($columns, ["conn", "table", "class", "id"]);

        return $columns;
    }

    private function getPlaceholders($columns, $isUpdate = false) {

        if ($isUpdate) {
            // cria uma lista de atributos placeholder a partir da lista de colunas
            return array_map(function ($col) {
                return "$col = :$col";
            }, $columns);
        } else {
            // cria uma lista de atributos placeholder a partir da lista de colunas
            return array_map(function ($col) {
                return ":$col";
            }, $columns);
        }
    }

    private function bindParams($stmt, $columns, $obj) {
        foreach ($columns as $col) {
            $stmt->bindParam(":$col", $obj->$col);
        }
    }

}