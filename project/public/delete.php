<?php

require_once __DIR__ . '/../src/Controllers/DigitaleFindController.php';


$digitaleFindController = new DigitaleFindController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    $success = $digitaleFindController->deleteDigitaleFind($id);
    if ($success) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Failed to delete digitale find.";
    }
}

require_once __DIR__ . '/../src/Views/delete_view.php';

