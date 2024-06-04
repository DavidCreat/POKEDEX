<?php
require_once '../config/database.php';
require_once '../models/Pokemon.php';

class PokemonController {
    private $db;
    private $pokemon;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->pokemon = new Pokemon($this->db);
    }

    public function getAllPokemons() {
        $stmt = $this->pokemon->getAll();
        $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($pokemons);
    }

    public function getPokemonById($id) {
        $stmt = $this->pokemon->getById($id);
        $pokemon = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($pokemon);
    }

    public function createPokemon() {
        $data = json_decode(file_get_contents("php://input"));

        $this->pokemon->name = $data->name;
        $this->pokemon->type = $data->type;
        $this->pokemon->image = $data->image;

        if ($this->pokemon->create()) {
            echo json_encode(array("message" => "Pokemon created successfully."));
        } else {
            echo json_encode(array("message" => "Unable to create Pokemon."));
        }
    }

    public function updatePokemon($id) {
        $data = json_decode(file_get_contents("php://input"));

        $this->pokemon->name = $data->name;
        $this->pokemon->type = $data->type;
        $this->pokemon->image = $data->image;

        if ($this->pokemon->update($id)) {
            echo json_encode(array("message" => "Pokemon updated successfully."));
        } else {
            echo json_encode(array("message" => "Unable to update Pokemon."));
        }
    }

    public function deletePokemon($id) {
        if ($this->pokemon->delete($id)) {
            echo json_encode(array("message" => "Pokemon deleted successfully."));
        } else {
            echo json_encode(array("message" => "Unable to delete Pokemon."));
        }
    }
}
?>
