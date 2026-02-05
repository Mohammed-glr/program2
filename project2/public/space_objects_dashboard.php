<?php

require_once __DIR__ . '/../src/Controllers/SpaceObjectController.php';

$spaceObjectController = new SpaceObjectController();
$spaceObjects = $spaceObjectController->getAllSpaceObjects();
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

require_once __DIR__ . '/../src/Views/space_objects_dashboard_view.php';
