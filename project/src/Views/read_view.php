<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo Details</title>
    <link rel="stylesheet" href="../../public/assets/css/global.css">
</head>
<body>
    <main>
        <h1>Todo Details</h1>
        <?php if (isset($todo)): ?>
            <ul>
                <li><strong>Titel:</strong> <?= htmlspecialchars($todo->getTitle()) ?></li>
                <li><strong>Omschrijving:</strong> <?= htmlspecialchars($todo->getDescription()) ?></li>
                <li><strong>Vervaldatum:</strong> <?= htmlspecialchars($todo->getCreatedAt()) ?></li>
                <li><strong>Status:</strong> <?= $todo->isCompleted() ? 'Afgerond' : 'Open' ?></li>
            </ul>
            <a href="dashboard.php" class="primary-button">Terug naar overzicht</a>
        <?php else: ?>
            <p>Todo niet gevonden.</p>
            <a href="dashboard.php" class="primary-button">Terug</a>
        <?php endif; ?>
    </main>
</body>
</html>
