<?php

require_once __DIR__ . '/../src/Controllers/SpaceObjectController.php';

$spaceObjectController = new SpaceObjectController();
$spaceObjects = $spaceObjectController->getAllSpaceObjects();

require_once __DIR__ . '/../src/Views/space_objects_dashboard_view.php';
