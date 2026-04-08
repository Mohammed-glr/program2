<?php

class SpaceObjects
{
    private int $id;
    private string $name;
    private ?string $description;
    private string $type;
    private string $discoveredDate;
    private string $fileUrl;
    private ?string $imageFilename;
    private string $createdAt;

    
    public function __construct(
        int $id,
        string $name,
        ?string $description,
        string $type,
        string $discoveredDate,
        string $fileUrl,
        string $createdAt,
        string $imageFilename
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->discoveredDate = $discoveredDate;
        $this->fileUrl = $fileUrl;
        $this->imageFilename = $imageFilename;
        $this->createdAt = $createdAt;
    }

    public function getId(): int
    {
        return $this->id;
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