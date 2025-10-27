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
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $isCompleted = isset($_POST['is_completed']) ? ($_POST['is_completed'] === 'on') : false;

    $todoController = new TodoController();
    if ($todoController->updateTodo($id, $title, $description, $isCompleted)) {
        $success = "Todo updated successfully!";
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Failed to update todo.";
    }
}

require_once __DIR__ . '/../src/Views/update_view.php';