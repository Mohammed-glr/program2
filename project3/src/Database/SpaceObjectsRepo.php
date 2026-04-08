<?php

declare(strict_types=1);

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
            $results[] = SpaceObjects::fromDatabaseRow($row);
        }
        return $results;
    }

    public function createSpaceObject(SpaceObjects $spaceObject): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO SpaceObjects (name, description, type, discovered_date, file_url, image_filename, created_at) VALUES (:name, :description, :type, :discovered_date, :file_url, :image_filename, NOW())');
        return $stmt->execute([
            'name' => $spaceObject->getName(),
            'description' => $spaceObject->getDescription(),
            'type' => $spaceObject->getType(),
            'discovered_date' => $spaceObject->getDiscoveredDate(),
            'file_url' => $spaceObject->getFileUrl(),
            'image_filename' => $spaceObject->getImageFilename()
        ]);
    }

    public function updateSpaceObject(SpaceObjects $spaceObject): bool
    {
        $stmt = $this->pdo->prepare('UPDATE SpaceObjects SET name = :name, description = :description, type = :type, discovered_date = :discovered_date, file_url = :file_url, image_filename = :image_filename WHERE id = :id');
        return $stmt->execute([
            'name' => $spaceObject->getName(),
            'description' => $spaceObject->getDescription(),
            'type' => $spaceObject->getType(),
            'discovered_date' => $spaceObject->getDiscoveredDate(),
            'file_url' => $spaceObject->getFileUrl(),
            'image_filename' => $spaceObject->getImageFilename(),
            'id' => $spaceObject->getId()
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
            return SpaceObjects::fromDatabaseRow($row);
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
            $results[] = SpaceObjects::fromDatabaseRow($row);
        }
        return $results;
    }

    public function findByType(string $type): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM SpaceObjects WHERE type = :type');
        $stmt->execute(['type' => $type]);
        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = SpaceObjects::fromDatabaseRow($row);
        }
        return $results;
    }
}