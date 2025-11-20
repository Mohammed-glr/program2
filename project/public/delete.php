<?php

require_once __DIR__ . '/../src/Controllers/DigitaleFindController.php';


$digitaleFindController = new DigitaleFindController();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$digitaleFind = null;

if ($id > 0) {
    $digitaleFind = $digitaleFindController->getDigitaleFindById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    $success = $digitaleFindController->deleteDigitaleFind($id);
    if ($success) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Failed to delete digitale find.";
    }
}

require_once __DIR__ . '/../src/Views/delete_view.php';

