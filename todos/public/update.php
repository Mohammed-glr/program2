<?php

require_once __DIR__ . '/../src/Controllers/TodoController.php';


$todoController = new TodoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : (isset($_POST['id']) ? (int)$_POST['id'] : 0);
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $isCompleted = isset($_POST['is_completed']) ? true : false;

    if ($todoController->updateTodo($id, $title, $description, $isCompleted)) {
        $success = "Todo updated successfully!";
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Failed to update todo.";
    }
    $todo = $todoController->getTodoById($id);
} else {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $todo = $todoController->getTodoById($id);
}

require_once __DIR__ . '/../src/Views/update_view.php';