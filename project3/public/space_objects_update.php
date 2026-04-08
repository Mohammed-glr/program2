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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $spaceObject) {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $type = $_POST['type'] ?? '';
    $discoveredDate = $_POST['discovered_date'] ?? '';
    $fileUrl = $_POST['file_url'] ?? '';
    
    // Handle image upload if provided
    $uploadedFile = null;
    if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] !== UPLOAD_ERR_NO_FILE) {
        $uploadedFile = $_FILES['image_upload'];
    }

    $success = $spaceObjectController->updateSpaceObject(
        (int)$id,
        $name, 
        $description, 
        $type, 
        $discoveredDate, 
        $fileUrl, 
        $uploadedFile
    );
    
    if ($success) {
        header('Location: space_objects_read.php?id=' . $id);
        exit();
    } else {
        $error = "Failed to update space object.";
    }
}

require_once __DIR__ . '/../src/Views/space_objects_update_view.php';
