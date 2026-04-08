<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opdracht 2 - TransportRide Child-Class Testcases</title>
    <link rel="stylesheet" href="assets/css/opdracht2.css">
</head>
<body>
    <div class="container">
        <h1>Opdracht 2: TransportRide Child-Class Test Cases</h1>
        <p><strong>Studentenummer:</strong> 102376 | <strong>Child-class type:</strong> TransportRide (erft van LegoAttraction)</p>

        <?php
            require_once __DIR__ . '/../src/Services/TransportRide.php';

            $ride1 = new TransportRide(
                name: "Monorail Express",
                description: "Moderne vervoer door het park met spectaculaire uitzichten",
                location: "Main Station",
                status: Status::Open,
                waitTime: 15,
                minHeight: 80,
                routeLength: "2500m",
                stops: ["Station Central", "Dinosaur Land", "Sky Tower", "main exit"]
            );

            $ride2 = new TransportRide(
                name: "Safari Train",
                description: "Een treinreis door de Lego Safari zone",
                location: "Safari Zone",
                status: Status::Open,
                waitTime: 20,
                minHeight: 90,
                routeLength: "1800m",
                stops: ["Safari Entrance", "Lion Savanna", "Giraffe Valley", "Safari Exit"]
            );

            $ride3 = new TransportRide(
                name: "Pirate Ship Transport",
                description: "Vervoer in piraten stijl door Water World",
                location: "Water World",
                status: Status::Maintenance,
                waitTime: 0,
                minHeight: 100,
                routeLength: "1200m",
                stops: ["Pirate Harbor", "Treasure Island", "Water Falls"]
            );

            $rides = [$ride1, $ride2, $ride3];
            $rideNames = ["Monorail Express", "Safari Train", "Pirate Ship Transport"];

            foreach ($rides as $index => $ride) {
                $info = $ride->showInfo();
                $isOpen = $ride->isOpen();
                $routeInfo = $ride->getRouteInfo();
                $duration = $ride->calculateDuration();
                
                $status = $info['status'];
                $statusClass = match($status) {
                    'Open' => 'success',
                    'Closed' => 'text-danger',
                    'Maintenance' => 'text-warning',
                    default => ''
                };
        ?>
            <div class="ride-box">
                <h3>Transport Ride <?php echo $index + 1; ?>: <?php echo htmlspecialchars($rideNames[$index]); ?></h3>
                
                <h4>📍 Parent Class Properties (LegoAttraction):</h4>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Naam:</span>
                        <div class="info-value"><?php echo htmlspecialchars($info['name']); ?></div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Beschrijving:</span>
                        <div class="info-value"><?php echo htmlspecialchars($info['description']); ?></div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Locatie:</span>
                        <div class="info-value"><?php echo htmlspecialchars($info['location']); ?></div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status:</span>
                        <div class="info-value"><span class="<?php echo $statusClass; ?>"><?php echo htmlspecialchars($info['status']); ?></span></div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Wachttijd:</span>
                        <div class="info-value"><?php echo htmlspecialchars($info['waitTime']); ?></div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Minimumhoogte:</span>
                        <div class="info-value"><?php echo htmlspecialchars($info['minHeight']); ?></div>
                    </div>
                </div>

                <h4>🚆 Child Class Properties (TransportRide):</h4>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Route Lengte:</span>
                        <div class="info-value"><?php echo htmlspecialchars($ride->getRouteLength()); ?></div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Aantal Haltes:</span>
                        <div class="info-value"><?php echo count($ride->getStops()); ?></div>
                    </div>
                </div>

                <h4>🔧 Method Tests:</h4>
                
                <div class="parent-method">
                    <strong>Parent Method - isOpen():</strong><br>
                    Retourneert: <span class="<?php echo $isOpen ? 'success' : ''; ?>"><?php echo $isOpen ? 'true' : 'false'; ?></span>
                    (Attractie is <?php echo $isOpen ? 'OPEN' : 'GESLOTEN'; ?>)
                </div>

                <div class="parent-method">
                    <strong>Parent Method - showInfo():</strong><br>
                    Retourneert array met alle parent-class informatie
                </div>

                <div class="child-method">
                    <strong>Child Method - getRouteInfo():</strong><br>
                    <?php echo htmlspecialchars($routeInfo); ?>
                </div>

                <div class="child-method">
                    <strong>Child Method - calculateDuration():</strong><br>
                    <?php echo htmlspecialchars($duration); ?>
                </div>

                <div class="child-method">
                    <strong>Child Method - getStops():</strong><br>
                    <?php 
                        $stops = $ride->getStops();
                        foreach ($stops as $i => $stop) {
                            echo ($i + 1) . ". " . htmlspecialchars($stop) . "<br>";
                        }
                    ?>
                </div>
            </div>
        <?php } ?>

    </div>
</body>
</html>
