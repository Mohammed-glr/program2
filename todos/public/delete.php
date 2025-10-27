<?php

require_once __DIR__ . '/../src/Controllers/TodoController.php';
require_once __DIR__ . '/../src/Controllers/UserController.php';

$error = null;
$success = null;

session_start();
$authController = new UserController();
if (!$authController->getCurrentUser()) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    $todoController = new TodoController();
    if ($todoController->deleteTodo($id)) {
        $success = "Todo deleted successfully!";
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Failed to delete todo.";
    }
}

require_once __DIR__ . '/../src/Views/delete_view.php';