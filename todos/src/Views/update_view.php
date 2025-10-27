<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo Bewerken</title>
    <link rel="stylesheet" href="../../public/assets/css/global.css">
</head>
<body>
    <main>
        <h1>Todo Bewerken</h1>
    <form method="POST" action="update.php?id=<?= $todo->getId() ?>">
            <div>
                <label for="title">Titel</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($todo->getTitle()) ?>" required>
            </div>
            <div>
                <label for="description">Omschrijving</label>
                <textarea id="description" name="description" rows="4"><?= htmlspecialchars($todo->getDescription()) ?></textarea>
            </div>
            <div>
                <label for="due_date">Vervaldatum</label>
                <input type="date" id="due_date" name="due_date" value="<?= htmlspecialchars($todo->getCreatedAt()) ?>">
            </div>
            <div>
                <label>
                    <input type="checkbox" name="is_completed" value="1" <?= $todo->isCompleted() ? 'checked' : '' ?>>
                    Afgerond
                </label>
            </div>
            <div class="action-links">
                <button type="submit">Opslaan</button>
                <a href="../overview_view.php">Annuleren</a>
            </div>
        </form>
    </main>
</body>
</html>
