<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo Verwijderen</title>
    <link rel="stylesheet" href="../../public/assets/css/global.css">
</head>
<body>
    <main>
        <h1>Todo Verwijderen</h1>
        <?php if (isset($todo)): ?>
            <p>Weet je zeker dat je de volgende todo wilt verwijderen?</p>
            <ul>
                <li><strong>Titel:</strong> <?= htmlspecialchars($todo->getTitle()) ?></li>
                <li><strong>Omschrijving:</strong> <?= htmlspecialchars($todo->getDescription()) ?></li>
            </ul>
            <form method="POST" action="delete.php?id=<?= $todo->getId() ?>">
                <input type="hidden" name="id" value="<?= $todo->getId() ?>">
                <button type="submit" class="danger">Verwijderen</button>
                <a href="dashboard.php" class="primary-button">Annuleren</a>
            </form>
        <?php else: ?>
            <p>Todo niet gevonden.</p>
            <a href="dashboard.php" class="primary-button">Terug</a>
        <?php endif; ?>
    </main>
</body>
</html>
