<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pokémon</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gestión de Pokémon</h1>
    <div id="content">
        <h2>Pokémon</h2>
        <a href="views/add_pokemon.php">Agregar Pokémon</a>
        <div id="pokemon-list">
            <?php
            require_once 'config/database.php';
            require_once 'models/Pokemon.php';
            $pokemonModel = new Pokemon($pdo);
            $pokemons = $pokemonModel->getAll();
            foreach ($pokemons as $pokemon) {
                echo "<div>
                        <h3>{$pokemon['name']}</h3>
                        <p>Tipo: " . implode(', ', $pokemon['types']) . "</p>
                        <p>Movimientos: " . implode(', ', $pokemon['moves']) . "</p>
                        <a href='views/edit_pokemon.php?id={$pokemon['id']}'>Editar</a>
                        <a href='api/pokemon.php?action=delete&id={$pokemon['id']}'>Eliminar</a>
                      </div>";
            }
            ?>
        </div>
        <h2>Entrenadores</h2>
        <a href="views/add_trainer.php">Agregar Entrenador</a>
        <div id="trainer-list">
            <?php
            require_once 'config/database.php';
            require_once 'models/Trainer.php';
            $trainerModel = new Trainer($pdo);
            $trainers = $trainerModel->getAll();
            foreach ($trainers as $trainer) {
                echo "<div>
                        <h3>{$trainer['name']}</h3>
                        <p>Edad: {$trainer['age']}</p>
                        <p>Región: {$trainer['region']}</p>
                        <p>Pokémon: " . implode(', ', array_map(function($p) { return $p['name']; }, $trainer['pokemon'])) . "</p>
                        <a href='views/edit_trainer.php?id={$trainer['id']}'>Editar</a>
                        <a href='api/trainer.php?action=delete&id={$trainer['id']}'>Eliminar</a>
                      </div>";
            }
            ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
