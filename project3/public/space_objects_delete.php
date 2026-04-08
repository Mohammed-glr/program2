<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/Controllers/SpaceObjectController.php';

$spaceObjectController = new SpaceObjectController();
$spaceObject = null;
$error = null;

$id = $_GET['id'] ?? null;

if (!$id) {
    $error = "Space object ID not provided.";
} else {
    $spaceObject = $spaceObjectController->getSpaceObjectById((int)$id);
    if (!$spaceObject) {
        $error = "Space object not found.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $spaceObject) {
    $success = $spaceObjectController->deleteSpaceObject((int)$id);
    
    if ($success) {
        header('Location: space_objects_dashboard.php');
        exit();
    } else {
        $error = "Failed to delete space object.";
    }
}

require_once __DIR__ . '/../src/Views/space_objects_delete_view.php';
