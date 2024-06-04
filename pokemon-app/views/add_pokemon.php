<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pokémon</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Agregar Pokémon</h1>
    <form action="../api/pokemon.php?action=add" method="post">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="types">Tipos (separados por coma):</label>
        <input type="text" name="types" id="types" required><br>
        <label for="moves">Movimientos (separados por coma):</label>
        <input type="text" name="moves" id="moves" required><br>
        <button type="submit">Agregar Pokémon</button>
    </form>
    <a href="../index.php">Volver</a>
</body>
</html>
