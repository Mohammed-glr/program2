<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/Controllers/SpaceObjectController.php';

$spaceObjectController = new SpaceObjectController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $type = $_POST['type'] ?? '';
    $discoveredDate = $_POST['discovered_date'] ?? '';
    $fileUrl = $_POST['file_url'] ?? '';
    
    $uploadedFile = null;
    if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] !== UPLOAD_ERR_NO_FILE) {
        $uploadedFile = $_FILES['image_upload'];
    }

    $success = $spaceObjectController->createSpaceObject(
        $name, 
        $description, 
        $type, 
        $discoveredDate, 
        $fileUrl, 
        $uploadedFile
    );
    
    if ($success) {
        header('Location: space_objects_dashboard.php');
        exit();
    } else {
        $error = "Failed to create space object.";
    }
}

require_once __DIR__ . '/../src/Views/space_objects_create_view.php';
