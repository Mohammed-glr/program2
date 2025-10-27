<?php

require_once __DIR__ . '/../src/Controllers/TodoController.php';



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $todoController = new TodoController();
    $todo = $todoController->getTodoById($id);
    require_once __DIR__ . '/../src/Views/read_view.php';
    exit();
}
