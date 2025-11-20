<?php

require_once __DIR__ . '/../src/Controllers/DigitaleFindController.php';
require_once __DIR__ . '/../src/Services/AuthService.php';
require_once __DIR__ . '/../src/Database/UserRepo.php';

$digitaleFindController = new DigitaleFindController();
$authService = new AuthService();

session_start();

if (!$authService->isAuthenticated()) {
    header('Location: login.php');
    exit();
}

$userId = null;
$username = $authService->getCurrentUser();
if ($username) {
    $userRepo = new UserRepository();
    $user = $userRepo->findByUsername($username);
    if ($user) {
        $userId = $user->getId();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $type = $_POST['type'] ?? '';
    $discoverDate = $_POST['discover_date'] ?? '';
    $fileUrl = $_POST['file_url'] ?? '';

    $success = $digitaleFindController->createDigitaleFind($title, $description, $type, $discoverDate, $fileUrl, $userId);
    if ($success) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Failed to create digitale find.";
    }
}

require_once __DIR__ . '/../src/Views/create_view.php';
