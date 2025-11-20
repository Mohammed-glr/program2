<?php

require_once __DIR__ . '/../src/Controllers/DigitaleFindController.php';


$digitaleFindController = new DigitaleFindController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : (isset($_POST['id']) ? (int)$_POST['id'] : 0);
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $type = $_POST['type'] ?? '';
    $discoverDate = $_POST['discover_date'] ?? '';
    $fileUrl = $_POST['file_url'] ?? '';

    $success = $digitaleFindController->updateDigitaleFind($id, $title, $description, $type, $discoverDate, $fileUrl);
    if ($success) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Failed to update digitale find.";
    }
} else {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $digitaleFind = $digitaleFindController->getDigitaleFindById($id);
    if (!$digitaleFind) {
        echo "Digitale find not found.";
        exit();
    }
}

require_once __DIR__ . '/../src/Views/update_view.php';