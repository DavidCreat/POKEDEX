<?php
require_once '../config/database.php';
require_once '../models/Pokemon.php';

$pokemonModel = new Pokemon($pdo);
$id = $_GET['id'];
$pokemon = $pokemonModel->getById($id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pokémon</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Editar Pokémon</h1>
    <form action="../api/pokemon.php?action=edit&id=<?= $id ?>" method="post">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="<?= $pokemon['name'] ?>" required><br>
        <label for="types">Tipos (separados por coma):</label>
        <input type="text" name="types" id="types" value="<?= implode(', ', $pokemon['types']) ?>" required><br>
        <label for="moves">Movimientos (separados por coma):</label>
        <input type="text" name="moves" id="moves" value="<?= implode(', ', $pokemon['moves']) ?>" required><br>
        <button type="submit">Guardar cambios</button>
    </form>
    <a href="../index.php">Volver</a>
</body>
</html>
