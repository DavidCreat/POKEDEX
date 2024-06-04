<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Entrenador</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Agregar Entrenador</h1>
    <form action="../api/trainer.php?action=add" method="post">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="age">Edad:</label>
        <input type="number" name="age" id="age" required><br>
        <label for="region">Región:</label>
        <input type="text" name="region" id="region" required><br>
        <button type="submit">Agregar Entrenador</button>
    </form>
    <a href="../index.php">Volver</a>
</body>
</html>
