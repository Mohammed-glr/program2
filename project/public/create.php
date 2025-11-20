<?php

require_once __DIR__ . '/../src/Controllers/DigitaleFindController.php';

$digitaleFindController = new DigitaleFindController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $type = $_POST['type'] ?? '';
    $discoverDate = $_POST['discover_date'] ?? '';
    $fileUrl = $_POST['file_url'] ?? '';

    $success = $digitaleFindController->createDigitaleFind($title, $description, $type, $discoverDate, $fileUrl);
    if ($success) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Failed to create digitale find.";
    }
}

require_once __DIR__ . '/../src/Views/create_view.php';