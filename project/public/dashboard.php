<?php
require_once __DIR__ . '/../src/Controllers/UserController.php';
require_once __DIR__ . '/../src/Controllers/DigitaleFindController.php';
$controller = new UserController();
$findController = new DigitaleFindController();
$controller->dashboard();
?>