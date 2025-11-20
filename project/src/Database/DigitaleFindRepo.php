<?php

require_once __DIR__ . '/../../config/Connection.php';
require_once __DIR__ . '/../Models/DigitaleFind.php';

class DigitaleFindRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance();
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM digitale_finds');
        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = new DigitaleFind(
                (int)$row['id'],
                isset($row['user_id']) ? (int)$row['user_id'] : null,
                $row['title'],
                $row['description'],
                $row['type'],
                $row['discover_date'],
                $row['file_url'],
                $row['created_at'],
                $row['updated_at']
            );
        }
        return $results;
    }

    public function createDigitaleFind(string $title, ?string $description, string $type, string $discoverDate, string $fileUrl, ?int $userId = null): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO digitale_finds (user_id, title, description, type, discover_date, file_url, created_at, updated_at) VALUES (:user_id, :title, :description, :type, :discover_date, :file_url, NOW(), NOW())');
        return $stmt->execute([
            'user_id' => $userId,
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'discover_date' => $discoverDate,
            'file_url' => $fileUrl
        ]);
    }

    public function updateDigitaleFind(int $id, string $title, ?string $description, string $type, string $discoverDate, string $fileUrl): bool
    {
        $stmt = $this->pdo->prepare('UPDATE digitale_finds SET title = :title, description = :description, type = :type, discover_date = :discover_date, file_url = :file_url, updated_at = NOW() WHERE id = :id');
        return $stmt->execute([
            'title' => $title, 
            'description' => $description, 
            'type' => $type, 
            'discover_date' => $discoverDate, 
            'file_url' => $fileUrl, 
            'id' => $id
        ]);
    }

    public function deleteDigitaleFind(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM digitale_finds WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function findById(int $id): ?DigitaleFind
    {
        $stmt = $this->pdo->prepare('SELECT * FROM digitale_finds WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if ($row) {
            return new DigitaleFind(
                (int)$row['id'],
                isset($row['user_id']) ? (int)$row['user_id'] : null,
                $row['title'],
                $row['description'],
                $row['type'],
                $row['discover_date'],
                $row['file_url'],
                $row['created_at'],
                $row['updated_at']
            );
        }

        return null;
    }

    public function findByUserId(int $userId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM digitale_finds WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $userId]);
        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = new DigitaleFind(
                (int)$row['id'],
                isset($row['user_id']) ? (int)$row['user_id'] : null,
                $row['title'],
                $row['description'],
                $row['type'],
                $row['discover_date'],
                $row['file_url'],
                $row['created_at'],
                $row['updated_at']
            );
        }
        return $results;
    }
}