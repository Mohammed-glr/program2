<?php

require_once __DIR__ . '/../Services/AuthService.php';
require_once __DIR__ . '/DigitaleFindController.php';
require_once __DIR__ . '/../Database/UserRepo.php';

class UserController
{
    private $authService;
    private $digitaleFindController;
    private $userRepository;

    public function __construct() {
        $this->authService = new AuthService();
        $this->digitaleFindController = new DigitaleFindController();
        $this->userRepository = new UserRepository();
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
        session_start();
        if (!$this->authService->isAuthenticated()) {
            header('Location: login.php');
            exit();
        }

        $username = $this->authService->getCurrentUser();
        $digitaleFinds = $this->digitaleFindController->getAllDigitaleFinds();
        
        // Build a map of user IDs to usernames
        $creatorNames = [];
        foreach ($digitaleFinds as $find) {
            if ($find->getUserId() && !isset($creatorNames[$find->getUserId()])) {
                $user = $this->userRepository->findById($find->getUserId());
                $creatorNames[$find->getUserId()] = $user ? $user->getUsername() : 'Onbekend';
            }
        }

        require_once __DIR__ . '/../Views/dashboard_view.php';
    }

}