<?php

require_once __DIR__ . '/../src/Controllers/DigitaleFindController.php';

$digitaleFindController = new DigitaleFindController();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$digitaleFind = null;

if ($id > 0) {
    $digitaleFind = $digitaleFindController->getDigitaleFindById($id);
}

if (!$digitaleFind) {
    header('Location: dashboard.php');
    exit();
}

require_once __DIR__ . '/../src/Views/read_view.php';

