<?php
require_once '../config.php';
$debugInfo = getConnectionDebugInfo();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create - CRUD Applicatie</title>
    <link rel="stylesheet" href="../css/global.css">
    <script src="../scripts/scripts.js" defer></script>
</head>
<body>
    <div class="db-debugger">
        <div class="status status-<?php echo $debugInfo['status']; ?>">
            <span class="status-indicator"></span>
            DB: <?php echo ucfirst($debugInfo['status']); ?>
        </div>
    </div>

    <main>
        <h1>Nieuw item aanmaken</h1>
        <form method="POST" action="../verwerking/create.php">
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
                <a href="index.php">Annuleren</a>
            </div>
        </form>
    </main>
</body>
</html> 