<?php

require_once __DIR__ . '/../Services/DigitaleFindService.php';

class DigitaleFindController
{
    private $digitaleFindService;

    public function __construct() {
        $this->digitaleFindService = new DigitaleFindService();
    }

    public function createDigitaleFind(string $title, ?string $description, string $type, string $discoverDate, string $fileUrl, ?int $userId = null, ?array $uploadedFile = null): bool
    {
        return $this->digitaleFindService->createDigitaleFind($title, $description, $type, $discoverDate, $fileUrl, $userId, $uploadedFile);
    }

    public function updateDigitaleFind(int $id, string $title, ?string $description, string $type, string $discoverDate, string $fileUrl, ?array $uploadedFile = null): bool
    {
        return $this->digitaleFindService->updateDigitaleFind($id, $title, $description, $type, $discoverDate, $fileUrl, $uploadedFile);
    }

    public function deleteDigitaleFind(int $id): bool
    {
        return $this->digitaleFindService->deleteDigitaleFind($id);
    }

    public function getDigitaleFindById(int $id): ?DigitaleFind
    {
        return $this->digitaleFindService->getDigitaleFindById($id);
    }
    public function getAllDigitaleFinds(): array
    {
        return $this->digitaleFindService->getAllDigitaleFinds();
    }

    public function getDigitaleFindsByUserId(int $userId): array
    {
        return $this->digitaleFindService->getDigitaleFindsByUserId($userId);
    }
}