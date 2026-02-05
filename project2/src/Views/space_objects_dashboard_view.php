<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruimteobject Dashboard</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <h1>Ruimteobjecten</h1>
        <div class="action-links">
            <a href="space_objects_create.php">Nieuw Ruimteobject</a>
            <a href="dashboard.php">Terug naar Digitale Vondsten</a>
        </div>
        <section>
            <h2>Alle Ruimteobjecten</h2>
            <?php if (empty($spaceObjects)): ?>
                <div class="card">
                    <p>Geen ruimteobjecten gevonden. <a href="space_objects_create.php">Maak je eerste ruimteobject</a>.</p>
                </div>
            <?php else: ?>
                <div class="card-container">
                    <?php foreach ($spaceObjects as $object): ?>
                        <div class="card">
                            <h3><?= htmlspecialchars($object->getName()) ?></h3>
                            <p><strong>Beschrijving:</strong> <?= htmlspecialchars($object->getDescription()) ?></p>
                            <p><strong>Type:</strong> <?= htmlspecialchars($object->getType()) ?></p>
                            <p><strong>Ontdekkingsdatum:</strong> <?= htmlspecialchars($object->getDiscoveredDate()) ?></p>
                            <p><strong>Bestands-URL:</strong> <a href="<?= htmlspecialchars($object->getFileUrl()) ?>" target="_blank">Bekijk bestand</a></p>
                            <div class="card-actions">
                                <a href="space_objects_read.php?id=<?= $object->getId() ?>">Bekijken</a>
                                <a href="space_objects_update.php?id=<?= $object->getId() ?>">Bewerken</a>
                                <a href="space_objects_delete.php?id=<?= $object->getId() ?>" class="danger">Verwijderen</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
