<?php

require_once __DIR__ . '/../Services/SpaceObjectService.php';

class SpaceObjectController
{
    private $spaceObjectService;

    public function __construct() {
        $this->spaceObjectService = new SpaceObjectService();
    }

    public function createSpaceObject(string $name, ?string $description, string $type, string $discoveredDate, string $fileUrl, ?array $uploadedFile = null): bool
    {
        return $this->spaceObjectService->createSpaceObject($name, $description, $type, $discoveredDate, $fileUrl, $uploadedFile);
    }

    public function updateSpaceObject(int $id, string $name, ?string $description, string $type, string $discoveredDate, string $fileUrl, ?array $uploadedFile = null): bool
    {
        return $this->spaceObjectService->updateSpaceObject($id, $name, $description, $type, $discoveredDate, $fileUrl, $uploadedFile);
    }

    public function deleteSpaceObject(int $id): bool
    {
        return $this->spaceObjectService->deleteSpaceObject($id);
    }

    public function getSpaceObjectById(int $id): ?SpaceObjects
    {
        return $this->spaceObjectService->getSpaceObjectById($id);
    }

    public function getAllSpaceObjects(): array
    {
        return $this->spaceObjectService->getAllSpaceObjects();
    }

    public function getSpaceObjectsByType(string $type): array
    {
        return $this->spaceObjectService->getSpaceObjectsByType($type);
    }

    public function searchSpaceObjects(string $query): array
    {
        return $this->spaceObjectService->searchSpaceObjects($query);
    }
}
