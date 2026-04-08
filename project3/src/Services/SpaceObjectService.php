<?php

declare(strict_types=1);

require_once __DIR__ . '/../../config/Connection.php';
require_once __DIR__ . '/../Database/SpaceObjectsRepo.php';
require_once __DIR__ . '/ImageService.php';


class SpaceObjectService
{
    private SpaceObjectRepository $spaceObjectRepo;
    private ImageService $imageService;

    public function __construct() {
        $this->spaceObjectRepo = new SpaceObjectRepository();
        $this->imageService = new ImageService();
    }

    public function createSpaceObject(string $name, ?string $description, string $type, string $discoveredDate, string $fileUrl, ?array $uploadedFile = null): bool
    {
        $imageFilename = null;

        if ($uploadedFile && !empty($uploadedFile['name'])) {
            $uploadResult = $this->imageService->uploadImage($uploadedFile);
            if (!$uploadResult['success']) {
                return false;
            }
            $imageFilename = $uploadResult['filename'];
        }
        elseif (!empty($fileUrl)) {
            $urlResult = $this->imageService->generateImageFromUrl($fileUrl);
            if ($urlResult['success']) {
                $imageFilename = $urlResult['filename'];
            }
        }

        try {
            $spaceObject = SpaceObjects::forCreate($name, $description, $type, $discoveredDate, $fileUrl, $imageFilename);
        } catch (InvalidArgumentException $exception) {
            return false;
        }

        return $this->spaceObjectRepo->createSpaceObject($spaceObject);
    }

    public function updateSpaceObject(int $id, string $name, ?string $description, string $type, string $discoveredDate, string $fileUrl, ?array $uploadedFile = null): bool
    {
        $spaceObject = $this->spaceObjectRepo->findById($id);
        if (!$spaceObject) {
            return false;
        }

        $imageFilename = $spaceObject->getImageFilename();

        if ($uploadedFile && !empty($uploadedFile['name'])) {
            if ($imageFilename) {
                $this->imageService->deleteImage($imageFilename);
            }

            $uploadResult = $this->imageService->uploadImage($uploadedFile);
            if (!$uploadResult['success']) {
                return false;
            }
            $imageFilename = $uploadResult['filename'];
        }
        elseif (!empty($fileUrl) && !$imageFilename) {
            $urlResult = $this->imageService->generateImageFromUrl($fileUrl);
            if ($urlResult['success']) {
                $imageFilename = $urlResult['filename'];
            }
        }

        try {
            $spaceObject->setName($name);
            $spaceObject->setDescription($description);
            $spaceObject->setType($type);
            $spaceObject->setDiscoveredDate($discoveredDate);
            $spaceObject->setFileUrl($fileUrl);
            $spaceObject->setImageFilename($imageFilename);
        } catch (InvalidArgumentException $exception) {
            return false;
        }

        return $this->spaceObjectRepo->updateSpaceObject($spaceObject);
    }

    public function deleteSpaceObject(int $id): bool
    {
        $spaceObject = $this->spaceObjectRepo->findById($id);
        if ($spaceObject && $spaceObject->getImageFilename()) {
            $this->imageService->deleteImage($spaceObject->getImageFilename());
        }

        return $this->spaceObjectRepo->deleteSpaceObject($id);
    }

    public function getSpaceObjectById(int $id): ?SpaceObjects
    {
        return $this->spaceObjectRepo->findById($id);
    }

    public function getAllSpaceObjects(): array
    {
        return $this->spaceObjectRepo->findAll();
    }

    public function getSpaceObjectsByType(string $type): array
    {
        return $this->spaceObjectRepo->findByType($type);
    }

    public function searchSpaceObjects(string $query): array
    {
        return $this->spaceObjectRepo->search($query);
    }
}
