<?php
require_once '../config/database.php';
require_once '../models/Trainer.php';

class TrainerController {
    private $db;
    private $trainer;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->trainer = new Trainer($this->db);
    }

    public function getTrainerById($id) {
        $stmt = $this->trainer->getById($id);
        $trainer = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($trainer);
    }

    public function addPokemonToTrainer($trainer_id) {
        $data = json_decode(file_get_contents("php://input"));
        $pokemon_id = $data->pokemon_id;

        if ($this->trainer->addPokemon($trainer_id, $pokemon_id)) {
            echo json_encode(array("message" => "Pokemon added to trainer successfully."));
        } else {
            echo json_encode(array("message" => "Unable to add Pokemon to trainer."));
        }
    }

    public function getTrainerPokemons($trainer_id) {
        $stmt = $this->trainer->getPokemons($trainer_id);
        $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($pokemons);
    }

    public function deleteTrainerPokemon($trainer_id, $pokemon_id) {
        if ($this->trainer->deletePokemon($trainer_id, $pokemon_id)) {
            echo json_encode(array("message" => "Pokemon removed from trainer successfully."));
        } else {
            echo json_encode(array("message" => "Unable to remove Pokemon from trainer."));
        }
    }
}
?>
