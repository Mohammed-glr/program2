<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruimteobject Details</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <?php if ($error): ?>
            <div style="color: red; margin-bottom: 20px;">
                <strong>Fout:</strong> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php elseif ($spaceObject): ?>
            <div class="card-container">
                <div class="card">
                    <h2><?= htmlspecialchars($spaceObject->getName()); ?></h2>
                    <p><strong>Beschrijving:</strong> <?= htmlspecialchars($spaceObject->getDescription()); ?></p>
                    <p><strong>Type:</strong> <?= htmlspecialchars($spaceObject->getType()); ?></p>
                    <p><strong>Ontdekkingsdatum:</strong> <?= htmlspecialchars($spaceObject->getDiscoveredDate()); ?></p>
                    <p><strong>Bestands-URL:</strong> <a href="<?= htmlspecialchars($spaceObject->getFileUrl()); ?>" target="_blank">Bekijk bestand</a></p>
                    <div class="action-links">
                        <a href="space_objects_update.php?id=<?= $spaceObject->getId(); ?>">Bewerken</a>
                        <a href="space_objects_delete.php?id=<?= $spaceObject->getId(); ?>" class="danger">Verwijderen</a>
                        <a href="space_objects_dashboard.php">Terug</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
