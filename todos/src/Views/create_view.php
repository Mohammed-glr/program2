<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Todo</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <h1>Nieuwe Todo aanmaken</h1>
        <form method="POST" action="/todo/create.php">
            <div>
                <label for="title">Titel</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="description">Omschrijving</label>
                <textarea id="description" name="description" rows="4"></textarea>
            </div>
            <div>
                <label for="due_date">Vervaldatum</label>
                <input type="date" id="due_date" name="due_date">
            </div>
            <div>
                <label>
                    <input type="checkbox" name="is_completed" value="1">
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
