<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo Bewerken</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <h1>Todo Bewerken</h1>
        <form method="POST" action="/todo/update.php?id=<?= $todo['id'] ?>">
            <div>
                <label for="title">Titel</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($todo['title']) ?>" required>
            </div>
            <div>
                <label for="description">Omschrijving</label>
                <textarea id="description" name="description" rows="4"><?= htmlspecialchars($todo['description']) ?></textarea>
            </div>
            <div>
                <label for="due_date">Vervaldatum</label>
                <input type="date" id="due_date" name="due_date" value="<?= htmlspecialchars($todo['due_date']) ?>">
            </div>
            <div>
                <label>
                    <input type="checkbox" name="is_completed" value="1" <?= $todo['is_completed'] ? 'checked' : '' ?>>
                    Afgerond
                </label>
            </div>
            <div class="action-links">
                <button type="submit">Opslaan</button>
                <a href="/todos/src/Views/todo/overview_view.php">Annuleren</a>
            </div>
        </form>
    </main>
</body>
</html>
