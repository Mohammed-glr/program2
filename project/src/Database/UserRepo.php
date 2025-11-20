<?php

require_once __DIR__ . '/../../config/Connection.php';
require_once __DIR__ . '/../Models/User.php';

class UserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance();
    }

    public function findByUsername(string $username): ?User
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $row = $stmt->fetch();

        if ($row) {
            return new User($row['id'], $row['username'], $row['password_hash']);
        }

        return null;
    }

    public function createUser(string $username, string $passwordHash): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)');
        return $stmt->execute(['username' => $username, 'password_hash' => $passwordHash]);
    }

    public function deleteUser(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function updatePassword(int $id, string $newPasswordHash): bool
    {
        $stmt = $this->pdo->prepare('UPDATE users SET password_hash = :password_hash WHERE id = :id');
        return $stmt->execute(['password_hash' => $newPasswordHash, 'id' => $id]);
    }

    public function verifyPassword(string $username, string $password): bool
    {
        $user = $this->findByUsername($username);
        if ($user) {
            return password_verify($password, $user->getPasswordHash());
        }
        return false;
    }
    
}