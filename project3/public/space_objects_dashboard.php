<?php

require_once __DIR__ . '/../src/Controllers/SpaceObjectController.php';

$spaceObjectController = new SpaceObjectController();
$spaceObjects = $spaceObjectController->getAllSpaceObjects();
$selectedObject = null;

$id = $_GET['id'] ?? null;
if ($id) {
    $selectedObject = $spaceObjectController->getSpaceObjectById((int)$id);
}

require_once __DIR__ . '/../src/Views/space_objects_dashboard_view.php';
