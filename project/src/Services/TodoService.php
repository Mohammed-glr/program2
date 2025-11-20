<?php

require_once __DIR__ . '/../../config/Connection.php';
require_once __DIR__ . '/../Database/DigitaleFindRepo.php';


class TodoService
{
    private $digitaleFindRepo;

    public function __construct() {
        $this->digitaleFindRepo = new DigitaleFindRepository();
    }

    public function createDigitaleFind(string $title, ?string $description, string $type, string $discoverDate, string $fileUrl): bool
    {
        return $this->digitaleFindRepo->createDigitaleFind( $title, $description, $type, $discoverDate, $fileUrl);
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
}