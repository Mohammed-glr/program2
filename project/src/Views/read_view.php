<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digitale Vondst Details</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <div class="card-container" >
            <div class="card">
                <h2><?= htmlspecialchars($digitaleFind->getTitle()); ?></h2>
                <p><strong>Beschrijving:</strong> <?= htmlspecialchars($digitaleFind->getDescription()); ?></p>
                <p><strong>Type:</strong> <?= htmlspecialchars($digitaleFind->getType()); ?></p>
                <p><strong>Ontdekkingsdatum:</strong> <?= htmlspecialchars($digitaleFind->getDiscoverDate()); ?></p>
                <p><strong>Bestands-URL:</strong> <a href="<?= htmlspecialchars($digitaleFind->getFileUrl()); ?>" target="_blank">Bekijk bestand</a></p>
                <div class="action-links">
                    <a href="update.php?id=<?= $digitaleFind->getId(); ?>">Bewerken</a>
                    <a href="delete.php?id=<?= $digitaleFind->getId(); ?>" class="danger">Verwijderen</a>
                    <a href="dashboard.php">Terug naar Dashboard</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
