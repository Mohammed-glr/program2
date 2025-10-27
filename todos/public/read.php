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
    $todo = $todoController->getTodoById($id);
    if ($todo) {
        header('Content-Type: application/json');
        echo json_encode([
            'id' => $todo->getId(),
            'user_id' => $todo->getUserId(),
            'title' => $todo->getTitle(),
            'description' => $todo->getDescription(),
            'is_completed' => $todo->isCompleted()
        ]);
        exit();
    } else {
        $error = "Todo not found.";
    }
}

if ($error) {
    header('Content-Type: application/json', true, 404);
    echo json_encode(['error' => $error]);
    exit();
}
