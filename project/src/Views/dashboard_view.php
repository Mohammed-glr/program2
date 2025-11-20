

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?= htmlspecialchars($username); ?></title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <div class="success-box">

            <p>Hello, <?= htmlspecialchars($username); ?>! Je bent succesvol ingelogd.</p>
        </div>
        <h1>Welkom, <?= htmlspecialchars($username); ?>!</h1>
        <div class="action-links">
            <a href="create.php">Nieuwe Digitale Vondst</a>
            <a href="logout.php">Uitloggen</a>
        </div>
        <section>
            <h2>Digitale Vondsten</h2>
            <?php if (empty($digitaleFinds)): ?>
                <div class="card">
                    <p>Geen digitale vondsten gevonden. <a href="create.php">Maak je eerste digitale vondst</a>.</p>
                </div>
            <?php else: ?>
                <div class="card-container">
                    <?php foreach ($digitaleFinds as $find): ?>
                        <div class="card">
                            <h3><?= htmlspecialchars($find->getTitle()) ?></h3>
                            <p><strong>Omschrijving:</strong> <?= htmlspecialchars($find->getDescription()) ?></p>
                            <p><strong>Type:</strong> <?= htmlspecialchars($find->getType()) ?></p>
                            <p><strong>Ontdekkingsdatum:</strong> <?= htmlspecialchars($find->getDiscoverDate()) ?></p>
                            <p><strong>Gemaakt door:</strong> <?= htmlspecialchars($find->getUserId() ? ($creatorNames[$find->getUserId()] ?? 'Onbekend') : 'Onbekend') ?></p>
                            <p><strong>Bestands-URL:</strong> <a href="<?= htmlspecialchars($find->getFileUrl()) ?>" target="_blank">Bekijk bestand</a></p>
                            <div class="card-actions">
                                <a href="read.php?id=<?= $find->getId() ?>">Bekijken</a>
                                <a href="update.php?id=<?= $find->getId() ?>">Bewerken</a>
                                <a href="delete.php?id=<?= $find->getId() ?>" class="danger">Verwijderen</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>