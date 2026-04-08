<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opdracht 1 - LegoAttractions Testcases</title>
    <link rel="stylesheet" href="assets/css/opdracht1.css">
</head>
<body>
    <div class="container">
        <h1>Opdracht 1: LegoAttraction Base Class Test Cases</h1>
        <p><strong>Studentenummer:</strong> 102376 | <strong>Achternaam beginletter:</strong> H</p>
        <p>
            <a href="opdracht1.php">Opdracht 1</a> |
            <a href="opdracht2.php">Opdracht 2</a>
        </p>

        <?php
            require_once __DIR__ . '/../src/Models/LegoAttractions.php';

            $attraction1 = new LegoAttraction(
                name: "haunted hollow",
                description: "Een spookachtige attractie vol verrassingen en griezelige effecten",
                location: "Haunted Hollow",
                status: Status::Open,
                waitTime: 45,
                minHeight: 120
            );

            $attraction2 = new LegoAttraction(
                name: "Space Tower",
                description: "Een futuristische attractie met rotatieve elementen",
                location: "Space Land",
                status: Status::Open,
                waitTime: 30,
                minHeight: 100
            );

            $attraction3 = new LegoAttraction(
                name: "Water Splash",
                description: "Een waterbaan vol splashes en plezier",
                location: "Water Park",
                status: Status::Maintenance,
                waitTime: 0,
                minHeight: 110
            );

            $attractions = [$attraction1, $attraction2, $attraction3];
            $attractionNames = ["haunted hollow", "Space Tower", "Water Splash"];

            foreach ($attractions as $index => $attraction) {
                $info = $attraction->showInfo();
                $isOpen = $attraction->isOpen();
                
                $status = $info['status'];
                $statusClass = match($status) {
                    'Open' => 'status-open',
                    'Closed' => 'status-closed',
                    'Maintenance' => 'status-maintenance',
                    default => ''
                };
        ?>
            <div class="attraction-box">
                <h2>Test Object <?php echo $index + 1; ?>: <?php echo htmlspecialchars($attractionNames[$index]); ?></h2>
                
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Attractienaam:</span>
                        <div class="info-value"><?php echo htmlspecialchars($info['name']); ?></div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Beschrijving:</span>
                        <div class="info-value"><?php echo htmlspecialchars($info['description']); ?></div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Locatie:</span>
                        <div class="info-value"><?php echo htmlspecialchars($info['location']); 
                            if (substr($info['location'], 0, 1) === 'H') {
                                echo " <span class='success'>(✓ Begint met H - studentnaam Haftarou)</span>";
                            }
                        ?></div>
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

                <div class="method-result">
                    <strong>Method Test - isOpen():</strong>
                    Retourneert: <span class="<?php echo $isOpen ? 'success' : ''; ?>"><?php echo $isOpen ? 'true (Attractie is OPEN)' : 'false (Attractie is GESLOTEN)'; ?></span>
                </div>

                <div class="method-result">
                    <strong>Method Test - showInfo():</strong>
                    Retourneert array met alle info (zie hierboven)
                </div>
            </div>
        <?php } ?>

    </div>
</body>
</html>
