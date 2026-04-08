<?php

require_once __DIR__ . '/../Models/LegoAttractions.php';

class TransportRide extends LegoAttraction {
    private string $routeLength;
    private array $stops;

    public function __construct(string $name, string $description, string $location, string $status, int $waitTime, int $minHeight, string $routeLength, array $stops) {
        parent::__construct($name, $description, $location, $status, $waitTime, $minHeight);
        $this->routeLength = $routeLength;
        $this->stops = $stops;
    }

    public function getRouteLength(): string
    {
        return $this->routeLength;
    }

    public function setRouteLength(string $routeLength): void
    {
        $this->routeLength = $routeLength;
    }

    public function getStops(): array
    {
        return $this->stops;
    }

    public function setStops(array $stops): void
    {
        $this->stops = $stops;
    }

    public function getRouteInfo(): string {
        return "Route lengte: " . $this->routeLength . ", Haltes: " . implode(", ", $this->stops);
    }

    public function calculateDuration(): string {
        $lengthInMeters = intval(str_replace('m', '', $this->routeLength));
        $durationInMinutes = ceil($lengthInMeters / 100);
        return "Geschatte duur: " . $durationInMinutes . " minuten";
    }
}
