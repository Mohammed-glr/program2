<?php

class DigitaleFind
{
    private int $id;
    private ?int $userId;
    private string $title;
    private ?string $description;
    private string $type;
    private string $discoverDate;
    private string $fileUrl;
    private string $createdAt;
    private string $updatedAt;

    
    public function __construct(
        int $id,
        ?int $userId,
        string $title,
        ?string $description,
        string $type,
        string $discoverDate,
        string $fileUrl,
        string $createdAt,
        string $updatedAt
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;
        $this->discoverDate = $discoverDate;
        $this->fileUrl = $fileUrl;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDiscoverDate(): string
    {
        return $this->discoverDate;
    }

    public function getFileUrl(): string
    {
        return $this->fileUrl;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
}