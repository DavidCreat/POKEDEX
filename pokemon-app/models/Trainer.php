<?php
class Trainer {
    private $conn;
    private $table_name = "trainers";

    public $id;
    public $name;
    public $age;
    public $region;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPokemon($trainer_id, $pokemon_id) {
        $query = "INSERT INTO trainer_pokemon SET trainer_id = :trainer_id, pokemon_id = :pokemon_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":trainer_id", $trainer_id);
        $stmt->bindParam(":pokemon_id", $pokemon_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getPokemons($trainer_id) {
        $query = "SELECT p.* FROM pokemon p JOIN trainer_pokemon tp ON p.id = tp.pokemon_id WHERE tp.trainer_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $trainer_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletePokemon($trainer_id, $pokemon_id) {
        $query = "DELETE FROM trainer_pokemon WHERE trainer_id = ? AND pokemon_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $trainer_id);
        $stmt->bindParam(2, $pokemon_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

?>
