<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digitale Vondsten Overzicht</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <h1>Mijn Digitale Vondsten</h1>
        <a href="create.php" class="primary-button">Nieuwe Digitale Vondst</a>
        <?php if (empty($digitaleFinds)): ?>
            <p>Je hebt nog geen digitale vondsten. <a href="create.php">Maak er een aan!</a></p>
        <?php else: ?>
            <div class="card-container">
                <?php foreach ($digitaleFinds as $find): ?>
                    <div class="card">
                        <h2><?= htmlspecialchars($find->getTitle()); ?></h2>
                        <p><?= htmlspecialchars($find->getDescription()); ?></p>
                        <a href="edit.php?id=<?= $find->getId(); ?>">Bewerken</a>
                        <a href="delete.php?id=<?= $find->getId(); ?>" class="danger">Verwijderen</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>

