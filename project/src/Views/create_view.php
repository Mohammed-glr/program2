<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Digitale Vondst aanmaken</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <form method="POST" action="create.php">
        <h1>Nieuwe Digitale Vondst aanmaken</h1>
            <div>
                <label for="title">Titel</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="description">Beschrijving</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div>
                <label for="type">Type</label>
                <input type="text" id="type" name="type" required>
            </div>
            <div>
                <label for="discover_date">Ontdekkingsdatum</label>
                <input type="date" id="discover_date" name="discover_date" required>
            </div>
            <div>
                <label for="file_url">Bestands-URL</label>
                <input type="url" id="file_url" name="file_url" required>
            </div>
            <div class="action-links">
                <button type="submit">Opslaan</button>
                <a href="dashboard.php">Annuleren</a>
            </div>
        </form>
    </main>
</body>
</html>
