<?php
require_once '../config/database.php';
require_once '../models/Trainer.php';

$trainerModel = new Trainer($pdo);

$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

if ($action) {
    switch ($action) {
        case 'add':
            $name = $_POST['name'];
            $age = $_POST['age'];
            $region = $_POST['region'];
            $trainerModel->add($name, $age, $region);
            break;
        case 'edit':
            $name = $_POST['name'];
            $age = $_POST['age'];
            $region = $_POST['region'];
            $trainerModel->update($id, $name, $age, $region);
            break;
        case 'delete':
            $trainerModel->delete($id);
            break;
    }
    header('Location: ../index.php');
} else {
    $trainers = $trainerModel->getAll();
    header('Content-Type: application/json');
    echo json_encode($trainers);
}
?>
