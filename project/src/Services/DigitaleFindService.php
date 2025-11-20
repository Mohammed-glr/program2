<?php

require_once __DIR__ . '/../../config/Connection.php';
require_once __DIR__ . '/../Database/DigitaleFindRepo.php';


class DigitaleFindService
{
    private $digitaleFindRepo;

    public function __construct() {
        $this->digitaleFindRepo = new DigitaleFindRepository();
    }

    public function createDigitaleFind(string $title, ?string $description, string $type, string $discoverDate, string $fileUrl, ?int $userId = null): bool
    {
        return $this->digitaleFindRepo->createDigitaleFind( $title, $description, $type, $discoverDate, $fileUrl, $userId);
    }

    public function updateDigitaleFind(int $id, string $title, ?string $description, string $type, string $discoverDate, string $fileUrl): bool
    {
        return $this->digitaleFindRepo->updateDigitaleFind($id, $title, $description, $type, $discoverDate, $fileUrl);
    }

    public function deleteDigitaleFind(int $id): bool
    {
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