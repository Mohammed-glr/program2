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
                        <div class="card space-object-card" onclick="window.location.href='space_objects_read.php?id=<?= $object->getId() ?>'">
                            <?php if ($object->getImageFilename()): ?>
                                <img src="image.php?file=<?= urlencode($object->getImageFilename()); ?>&op=resize&w=400&h=300" 
                                     alt="<?= htmlspecialchars($object->getName()) ?>">
                            <?php elseif ($object->getFileUrl()): ?>
                                <img src="<?= htmlspecialchars($object->getFileUrl()) ?>" 
                                     alt="<?= htmlspecialchars($object->getName()) ?>"
                                     onerror="this.parentElement.innerHTML='<div class=\'no-image\'>Geen afbeelding beschikbaar</div>'">
                            <?php else: ?>
                                <div class="no-image">Geen afbeelding beschikbaar</div>
                            <?php endif; ?>
                            <div class="space-object-overlay">
                                <h3 style="margin: 0 0 5px 0;"><?= htmlspecialchars($object->getName()) ?></h3>
                                <p style="margin: 0; font-size: 0.9em;"><?= htmlspecialchars($object->getType()) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
