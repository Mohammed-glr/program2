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
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';

    $todoController = new TodoController();
    $currentUser = $authController->getCurrentUser();
    if ($currentUser) {
        require_once __DIR__ . '/../src/Repositories/UserRepository.php';
        $userRepo = new UserRepository();
        $user = $userRepo->findByUsername($currentUser);
        if ($user) {
            $userId = $user->getId();
            if ($todoController->createTodo($userId, $title, $description)) {
                $success = "Todo created successfully!";
                header('Location: dashboard.php');
                exit();
            } else {
                $error = "Failed to create todo.";
            }
        } else {
            $error = "User not found.";
        }
    } else {
        $error = "User not authenticated.";
    }
}

require_once __DIR__ . '/../src/Views/create_view.php';