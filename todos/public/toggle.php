<?php
require_once __DIR__ . '/../src/Controllers/TodoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $todoController = new TodoController();
    $todoController->toggleTodoCompletion($id);
}
header('Location: dashboard.php');
exit();
