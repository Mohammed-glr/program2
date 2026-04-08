<?php

class Status
{
    public const Open = 'Open';
    public const Closed = 'Closed';
    public const Maintenance = 'Maintenance';
}

class LegoAttraction
{
    private string $name;
    private string $description;
    private string $location;
    private string $status;
    private int $waitTime;
    private int $minHeight;

    public function __construct(string $name, string $description, string $location, string $status, int $waitTime, int $minHeight)
    {
        $this->setName($name);
        $this->setDescription($description);
        $this->setLocation($location);
        $this->setStatus($status);
        $this->setWaitTime($waitTime);
        $this->setMinHeight($minHeight);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Naam mag niet leeg zijn.');
        }
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        if (empty($description)) {
            throw new InvalidArgumentException('Beschrijving mag niet leeg zijn.');
        }
        $this->description = $description;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        if (empty($location)) {
            throw new InvalidArgumentException('Locatie mag niet leeg zijn.');
        }
        $this->location = $location;
    }

    public function getMinHeight(): int
    {
        return $this->minHeight;
    }

    public function setMinHeight(int $minHeight): void
    {
        if ($minHeight < 0) {
            throw new InvalidArgumentException('Minimumhoogte mag niet negatief zijn.');
        }
        if ($minHeight > 250) {
            throw new InvalidArgumentException('Minimumhoogte mag niet groter zijn dan 250.');
        }
        $this->minHeight = $minHeight;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $validStatuses = [Status::Open, Status::Closed, Status::Maintenance];
        if (!in_array($status, $validStatuses)) {
            throw new InvalidArgumentException('Status moet een van deze waarden zijn: ' . implode(', ', $validStatuses));
        }
        $this->status = $status;
    }

    public function getWaitTime(): int
    {
        return $this->waitTime;
    }

    public function setWaitTime(int $waitTime): void
    {
        if ($waitTime < 0) {
            throw new InvalidArgumentException('Wachttijd mag niet negatief zijn.');
        }
        if ($waitTime > 300) {
            throw new InvalidArgumentException('Wachttijd mag niet groter zijn dan 300 minuten.');
        }
        $this->waitTime = $waitTime;
    }

    public function showInfo(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'status' => $this->status,
            'waitTime' => $this->waitTime . ' minuten',
            'minHeight' => $this->minHeight . ' cm'
        ];
    }

    public function isOpen(): bool
    {
        return $this->status === Status::Open;
    }
}
