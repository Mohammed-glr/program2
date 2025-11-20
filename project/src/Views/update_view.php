<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digitale Vondst Bewerken</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <h1>Digitale Vondst Bewerken</h1>
        <form method="POST" action="update.php?id=<?= $digitaleFind->getId(); ?>">
            <div>
                <label for="title">Titel</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($digitaleFind->getTitle()); ?>" required>                
            </div>
            <div>
                <label for="description">Beschrijving</label>
                <textarea id="description" name="description" required><?= htmlspecialchars($digitaleFind->getDescription()); ?></textarea>
            </div>
            <div>
                <label for="type">Type</label>
                <input type="text" id="type" name="type" value="<?= htmlspecialchars($digitaleFind->getType()); ?>" required>
            </div>
            <div>
                <label for="discover_date">Ontdekkingsdatum</label>
                <input type="date" id="discover_date" name="discover_date" value="<?= htmlspecialchars($digitaleFind->getDiscoverDate()); ?>" required>
            </div>
            <div>
                <label for="file_url">Bestands-URL</label>
                <input type="url" id="file_url" name="file_url" value="<?= htmlspecialchars($digitaleFind->getFileUrl()); ?>" required>
            </div>
            <div class="action-links">
                <button type="submit">Opslaan</button>
                <a href="dashboard.php">Annuleren</a>
            </div>
        </form>
    </main>
</body>
</html>
