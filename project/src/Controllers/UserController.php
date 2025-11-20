<?php

require_once __DIR__ . '/../Services/AuthService.php';

class UserController
{
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function login(string $username, string $password): bool
    {
        return $this->authService->login($username, $password);
    }

    public function logout(): void
    {
        $this->authService->logout();
    }

    public function register(string $username, string $password): bool
    {
        return $this->authService->register($username, $password);
    }

    public function changePassword(string $username, string $oldPassword, string $newPassword): bool
    {
        return $this->authService->changePassword($username, $oldPassword, $newPassword);
    }

    public function deleteUser(string $username, string $password): bool
    {
        return $this->authService->deleteUser($username, $password);
    }

    public function getCurrentUser(): ?string
    {
        return $this->authService->getCurrentUser();
    }

    public function dashboard(): void
    {
        if (!$this->authService->isAuthenticated()) {
            header('Location: login.php');
            exit();
        }

        $username = $this->getCurrentUser();

        require_once __DIR__ . '/TodoController.php';
        require_once __DIR__ . '/../Database/UserRepo.php';
        $userRepo = new UserRepository();
        $user = $userRepo->findByUsername($username);
        $todos = [];
        if ($user) {
            $todoController = new TodoController();
            $todos = $todoController->getTodosByUserId($user->getId());
        }

        require_once __DIR__ . '/../Views/dashboard_view.php';
    }
}