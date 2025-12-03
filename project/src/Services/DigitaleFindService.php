<?php

require_once __DIR__ . '/../../config/Connection.php';
require_once __DIR__ . '/../Database/DigitaleFindRepo.php';
require_once __DIR__ . '/ImageService.php';


class DigitaleFindService
{
    private $digitaleFindRepo;
    private $imageService;

    public function __construct() {
        $this->digitaleFindRepo = new DigitaleFindRepository();
        $this->imageService = new ImageService();
    }

    /**
     * Create digitale find with optional image upload or URL
     */
    public function createDigitaleFind(string $title, ?string $description, string $type, string $discoverDate, string $fileUrl, ?int $userId = null, ?array $uploadedFile = null): bool
    {
        $imageFilename = null;

        // Handle image upload if provided
        if ($uploadedFile && !empty($uploadedFile['name'])) {
            $uploadResult = $this->imageService->uploadImage($uploadedFile);
            if (!$uploadResult['success']) {
                return false;
            }
            $imageFilename = $uploadResult['filename'];
        }
        // Handle image from URL if provided
        elseif (!empty($fileUrl)) {
            $urlResult = $this->imageService->generateImageFromUrl($fileUrl);
            if ($urlResult['success']) {
                $imageFilename = $urlResult['filename'];
            }
            // Continue even if URL processing fails - use fileUrl as-is
        }

        return $this->digitaleFindRepo->createDigitaleFind($title, $description, $type, $discoverDate, $fileUrl, $userId, $imageFilename);
    }

    /**
     * Update digitale find with optional image upload
     */
    public function updateDigitaleFind(int $id, string $title, ?string $description, string $type, string $discoverDate, string $fileUrl, ?array $uploadedFile = null): bool
    {
        $find = $this->digitaleFindRepo->findById($id);
        if (!$find) {
            return false;
        }

        $imageFilename = $find->getImageFilename();

        // Handle new image upload
        if ($uploadedFile && !empty($uploadedFile['name'])) {
            // Delete old image if exists
            if ($imageFilename) {
                $this->imageService->deleteImage($imageFilename);
            }

            $uploadResult = $this->imageService->uploadImage($uploadedFile);
            if (!$uploadResult['success']) {
                return false;
            }
            $imageFilename = $uploadResult['filename'];
        }
        // Handle image from URL if provided and no upload
        elseif (!empty($fileUrl) && !$imageFilename) {
            $urlResult = $this->imageService->generateImageFromUrl($fileUrl);
            if ($urlResult['success']) {
                $imageFilename = $urlResult['filename'];
            }
        }

        return $this->digitaleFindRepo->updateDigitaleFind($id, $title, $description, $type, $discoverDate, $fileUrl, $imageFilename);
    }

    /**
     * Delete digitale find and associated images
     */
    public function deleteDigitaleFind(int $id): bool
    {
        $find = $this->digitaleFindRepo->findById($id);
        if ($find && $find->getImageFilename()) {
            $this->imageService->deleteImage($find->getImageFilename());
        }

        return $this->digitaleFindRepo->deleteDigitaleFind($id);
    }

    public function getDigitaleFindById(int $id): ?DigitaleFind
    {
        return $this->digitaleFindRepo->findById($id);
    }

    public function getAllDigitaleFinds(): array
    {
        return $this->digitaleFindRepo->findAll();
    }

    public function getDigitaleFindsByUserId(int $userId): array
    {
        return $this->digitaleFindRepo->findByUserId($userId);
    }
}