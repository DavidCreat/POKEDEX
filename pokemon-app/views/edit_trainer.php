<?php
require_once '../config/database.php';
require_once '../models/Trainer.php';

$trainerModel = new Trainer($pdo);
$id = $_GET['id'];
$trainer = $trainerModel->getById($id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Entrenador</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Editar Entrenador</h1>
    <form action="../api/trainer.php?action=edit&id=<?= $id ?>" method="post">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="<?= $trainer['name'] ?>" required><br>
        <label for="age">Edad:</label>
        <input type="number" name="age" id="age" value="<?= $trainer['age'] ?>" required><br>
        <label for="region">Región:</label>
        <input type="text" name="region" id="region" value="<?= $trainer['region'] ?>" required><br>
        <button type="submit">Guardar cambios</button>
    </form>
    <a href="../index.php">Volver</a>
</body>
</html>
