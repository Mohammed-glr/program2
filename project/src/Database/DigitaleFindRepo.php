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

    public function createDigitaleFind(string $title, ?string $description, string $type, string $discoverDate, string $fileUrl): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO digitale_finds (title, description, type, discover_date, file_url, created_at, updated_at) VALUES (:title, :description, :type, :discover_date, :file_url, NOW(), NOW())');
        return $stmt->execute([
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
                $row['id'],
                $row['user_id'],
                $row['title'],
                $row['description'],
                (bool)$row['is_completed'],
                $row['created_at'],
                $row['updated_at']
            );
        }

        return null;
    }
}