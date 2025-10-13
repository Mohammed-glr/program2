<?php

require_once __DIR__ . '/../Database/UserRepo.php';
require_once __DIR__ . '/../Helpers/session.php';


class AuthService
{
    private $userRepo;

    public function __construct() {
        $this->userRepo = new UserRepository();
    }

    public function register(string $username, string $password): bool
    {
        if ($this->userRepo->findByUsername($username)) {
            return false;
        }
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        return $this->userRepo->createUser($username, $passwordHash);
    }

    public function login(string $username, string $password): bool
    {
        if ($this->userRepo->verifyPassword($username, $password)) {
            SessionHelper::start();
            $_SESSION['username'] = $username;
            return true;
        }
        return false;
    }

    public function logout(): void
    {
        SessionHelper::destroy();
    }

    public function isAuthenticated(): bool
    {
        SessionHelper::start();
        return isset($_SESSION['username']);
    }

    public function getCurrentUser(): ?string
    {
        SessionHelper::start();
        return $_SESSION['username'] ?? null;
    }

    public function changePassword(string $username, string $oldPassword, string $newPassword): bool
    {
        if ($this->userRepo->verifyPassword($username, $oldPassword)) {
            $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
            $user = $this->userRepo->findByUsername($username);
            return $this->userRepo->updatePassword($user->getId(), $newPasswordHash);
        }
        return false;
    }

    public function deleteUser(string $username, string $password): bool
    {
        if ($this->userRepo->verifyPassword($username, $password)) {
            $user = $this->userRepo->findByUsername($username);
            if ($user) {
                SessionHelper::destroy();
                return $this->userRepo->deleteUser($user->getId());
            }
        }
        return false;
    }

    
}