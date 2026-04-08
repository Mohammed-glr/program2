<?php

declare(strict_types=1);

require_once __DIR__ . '/CelestialObject.php';

class SpaceObjects extends CelestialObject
{
    private static int $instanceCount = 0;
    private int $id;

    public function __construct(
        int $id,
        string $name,
        ?string $description,
        string $type,
        string $discoveredDate,
        string $fileUrl,
        string $createdAt,
        ?string $imageFilename = null
    ) {
        parent::__construct($name, $description, $type, $discoveredDate, $fileUrl, $createdAt, $imageFilename);
        $this->setId($id);
        self::$instanceCount++;
    }

    public static function fromDatabaseRow(array $row): self
    {
        return new self(
            (int) $row['id'],
            (string) $row['name'],
            isset($row['description']) ? (string) $row['description'] : null,
            (string) $row['type'],
            (string) $row['discovered_date'],
            (string) $row['file_url'],
            (string) $row['created_at'],
            isset($row['image_filename']) && $row['image_filename'] !== '' ? (string) $row['image_filename'] : null
        );
    }

    public static function forCreate(
        string $name,
        ?string $description,
        string $type,
        string $discoveredDate,
        string $fileUrl,
        ?string $imageFilename = null
    ): self {
        return new self(0, $name, $description, $type, $discoveredDate, $fileUrl, date('Y-m-d H:i:s'), $imageFilename);
    }

    public static function getInstanceCount(): int
    {
        return self::$instanceCount;
    }

    public function setId(int $id): void
    {
        if ($id < 0) {
            throw new InvalidArgumentException('ID mag niet negatief zijn.');
        }

        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

}