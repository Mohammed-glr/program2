<?php

class Todo
{
    private int $id;
    private int $userId;
    private string $title;
    private ?string $description;
    private bool $isCompleted;
    private string $createdAt;
    private string $updatedAt;

    public function __construct(
        int $id,
        int $userId,
        string $title,
        ?string $description,
        bool $isCompleted,
        string $createdAt,
        string $updatedAt
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->description = $description;
        $this->isCompleted = $isCompleted;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}