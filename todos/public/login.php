<?php
require_once __DIR__ . '/../src/Controllers/UserController.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $userController = new UserController();
    if ($userController->login($username, $password)) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}

require_once __DIR__ . '/../src/Views/login_view.php';
