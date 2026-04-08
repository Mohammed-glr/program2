<?php

require_once __DIR__ . '/../../config/Connection.php';
require_once __DIR__ . '/../Models/SpaceObjects.php';

class SpaceObjectRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance();
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM SpaceObjects');
        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = new SpaceObjects(
                (int)$row['id'],
                $row['name'],
                $row['description'],
                $row['type'],
                $row['discovered_date'],
                $row['file_url'],
                $row['created_at'],
                isset($row['image_filename']) ? $row['image_filename'] : null
            );
        }
        return $results;
    }

    public function createSpaceObject(string $name, ?string $description, string $type, string $discoveredDate, string $fileUrl, ?string $imageFilename = null): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO SpaceObjects (name, description, type, discovered_date, file_url, image_filename, created_at) VALUES (:name, :description, :type, :discovered_date, :file_url, :image_filename, NOW())');
        return $stmt->execute([
            'name' => $name,
            'description' => $description,
            'type' => $type,
            'discovered_date' => $discoveredDate,
            'file_url' => $fileUrl,
            'image_filename' => $imageFilename
        ]);
    }

    public function updateSpaceObject(int $id, string $name, ?string $description, string $type, string $discoveredDate, string $fileUrl, ?string $imageFilename = null): bool
    {
        $stmt = $this->pdo->prepare('UPDATE SpaceObjects SET name = :name, description = :description, type = :type, discovered_date = :discovered_date, file_url = :file_url, image_filename = :image_filename WHERE id = :id');
        return $stmt->execute([
            'name' => $name, 
            'description' => $description, 
            'type' => $type, 
            'discovered_date' => $discoveredDate, 
            'file_url' => $fileUrl, 
            'image_filename' => $imageFilename,
            'id' => $id
        ]);
    }

    public function deleteSpaceObject(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM SpaceObjects WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function findById(int $id): ?SpaceObjects
    {
        $stmt = $this->pdo->prepare('SELECT * FROM SpaceObjects WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if ($row) {
            return new SpaceObjects(
                (int)$row['id'],
                $row['name'],
                $row['description'],
                $row['type'],
                $row['discovered_date'],
                $row['file_url'],
                $row['created_at'],
                isset($row['image_filename']) ? $row['image_filename'] : null
            );
        }

        return null;
    }

    public function search(string $query): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM SpaceObjects WHERE name LIKE :query OR description LIKE :query OR type LIKE :query');
        $searchQuery = '%' . $query . '%';
        $stmt->execute(['query' => $searchQuery]);
        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = new SpaceObjects(
                (int)$row['id'],
                $row['name'],
                $row['description'],
                $row['type'],
                $row['discovered_date'],
                $row['file_url'],
                $row['created_at'],
                isset($row['image_filename']) ? $row['image_filename'] : null
            );
        }
        return $results;
    }

    public function findByType(string $type): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM SpaceObjects WHERE type = :type');
        $stmt->execute(['type' => $type]);
        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = new SpaceObjects(
                (int)$row['id'],
                $row['name'],
                $row['description'],
                $row['type'],
                $row['discovered_date'],
                $row['file_url'],
                $row['created_at'],
                isset($row['image_filename']) ? $row['image_filename'] : null
            );
        }
        return $results;
    }
}