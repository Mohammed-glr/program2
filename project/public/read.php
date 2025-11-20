<?php

require_once __DIR__ . '/../src/Controllers/DigitaleFindController.php';



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $digitaleFind = $digitaleFindController->getDigitaleFindById($id);
    if ($digitaleFind) {
        require_once __DIR__ . '/../src/Views/read_view.php';
    } else {
        echo "Digitale find not found.";
    }
}
