<?php

require_once __DIR__ . '/../src/Controllers/TodoController.php';


// Always need the controller
$todoController = new TodoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($todoController->deleteTodo($id)) {
        $success = "Todo deleted successfully!";
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Failed to delete todo.";
    }
    // Fetch for redisplay if needed
    $todo = null;
} else {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $todo = $todoController->getTodoById($id);
}

require_once __DIR__ . '/../src/Views/delete_view.php';

