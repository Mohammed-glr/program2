<?php

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

require_once __DIR__ . '/../src/Views/space_objects_read_view.php';
