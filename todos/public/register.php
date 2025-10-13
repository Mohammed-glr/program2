<?php
require_once __DIR__ . '/../src/Controllers/UserController.php';

$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $controller = new UserController();
    if ($controller->register($username, $password)) {
        $success = "Registration successful! You can now login.";
        header('Location: /login.php');
        exit();
    } else {
        $error = "Username already exists or registration failed.";
    }
}

require_once __DIR__ . '/../src/Views/auth/register_view.php';