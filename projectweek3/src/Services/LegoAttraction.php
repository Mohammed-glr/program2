<?php

require_once __DIR__ . '/../Models/LegoAttractions.php';

class Attraction
{
    private LegoAttraction $legoAttraction;

    public function __construct(LegoAttraction $legoAttraction)
    {
        $this->legoAttraction = $legoAttraction;
    }

    public function showInfo(): array
    {
        return [
            "Attractie: " . $this->legoAttraction->getName(),
            "Beschrijving: " . $this->legoAttraction->getDescription(),
            "Locatie: " . $this->legoAttraction->getLocation(),
            "Status: " . $this->legoAttraction->getStatus(),
            "Wachttijd: " . $this->legoAttraction->getWaitTime() . " minuten",
            "Minimumhoogte: " . $this->legoAttraction->getMinHeight() . " cm"
        ];
    }

    public function isOpen(): bool
    {
        return $this->legoAttraction->getStatus() === Status::Open;
    }
}