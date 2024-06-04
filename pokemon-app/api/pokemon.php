<?php
require_once '../config/database.php';
require_once '../models/Pokemon.php';

$pokemonModel = new Pokemon($pdo);

$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

if ($action) {
    switch ($action) {
        case 'add':
            $name = $_POST['name'];
            $types = explode(',', $_POST['types']);
            $moves = explode(',', $_POST['moves']);
            $pokemonModel->create($name, $types, $moves);
            break;
        case 'edit':
            $name = $_POST['name'];
            $types = explode(',', $_POST['types']);
            $moves = explode(',', $_POST['moves']);
            $pokemonModel->update($id, $name, $types, $moves);
            break;
        case 'delete':
            $pokemonModel->delete($id);
            break;
    }
    header('Location: ../index.php');
} else {
    $pokemons = $pokemonModel->getAll();
    header('Content-Type: application/json');
    echo json_encode($pokemons);
}
?>
