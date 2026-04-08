<?php

declare(strict_types=1);

abstract class CelestialObject
{
    protected static int $maxNameLength = 120;
    protected static int $maxTypeLength = 60;

    protected string $name;
    protected ?string $description;
    protected string $type;
    protected string $discoveredDate;
    protected string $fileUrl;
    protected ?string $imageFilename;
    protected string $createdAt;

    public function __construct(
        string $name,
        ?string $description,
        string $type,
        string $discoveredDate,
        string $fileUrl,
        string $createdAt,
        ?string $imageFilename = null
    ) {
        $this->setName($name);
        $this->setDescription($description);
        $this->setType($type);
        $this->setDiscoveredDate($discoveredDate);
        $this->setFileUrl($fileUrl);
        $this->setImageFilename($imageFilename);
        $this->setCreatedAt($createdAt);
    }

    public static function getMaxNameLength(): int
    {
        return self::$maxNameLength;
    }

    public static function getMaxTypeLength(): int
    {
        return self::$maxTypeLength;
    }

    public function setName(string $name): void
    {
        $name = trim($name);
        if ($name === '' || mb_strlen($name) > self::$maxNameLength) {
            throw new InvalidArgumentException('Naam is verplicht en mag niet te lang zijn.');
        }

        $this->name = $name;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description !== null ? trim($description) : null;
    }

    public function setType(string $type): void
    {
        $type = trim($type);
        if ($type === '' || mb_strlen($type) > self::$maxTypeLength || !preg_match('/^[\p{L}\p{N}\s\-]+$/u', $type)) {
            throw new InvalidArgumentException('Type is ongeldig.');
        }

        $this->type = $type;
    }

    public function setDiscoveredDate(string $discoveredDate): void
    {
        $date = DateTimeImmutable::createFromFormat('Y-m-d', $discoveredDate);
        if (!$date || $date->format('Y-m-d') !== $discoveredDate) {
            throw new InvalidArgumentException('Ontdekkingsdatum moet in formaat YYYY-MM-DD staan.');
        }

        $this->discoveredDate = $discoveredDate;
    }

    public function setFileUrl(string $fileUrl): void
    {
        $fileUrl = trim($fileUrl);
        if ($fileUrl !== '' && filter_var($fileUrl, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException('Bestands-URL is ongeldig.');
        }

        $this->fileUrl = $fileUrl;
    }

    public function setImageFilename(?string $imageFilename): void
    {
        if ($imageFilename !== null && !preg_match('/^[a-zA-Z0-9_\-.]+$/', $imageFilename)) {
            throw new InvalidArgumentException('Bestandsnaam van afbeelding is ongeldig.');
        }

        $this->imageFilename = $imageFilename;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $dateTime = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $createdAt);
        if (!$dateTime || $dateTime->format('Y-m-d H:i:s') !== $createdAt) {
            throw new InvalidArgumentException('createdAt moet in formaat YYYY-MM-DD HH:MM:SS staan.');
        }

        $this->createdAt = $createdAt;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDiscoveredDate(): string
    {
        return $this->discoveredDate;
    }

    public function getFileUrl(): string
    {
        return $this->fileUrl;
    }

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
