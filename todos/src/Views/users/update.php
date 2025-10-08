<?php
require_once '../config.php';
$debugInfo = getConnectionDebugInfo();

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$item = null;
if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM management_todos WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update - CRUD Applicatie</title>
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
        <?php if ($id && !$item): ?>
            <div class="text-center">
                <p style="color: #e74c3c; font-size: 1.2rem; margin-bottom: 20px;">Item niet gevonden.</p>
                <a href="index.php" class="primary-button">Terug naar overzicht</a>
            </div>
        <?php else: ?>
            <h1>Item bewerken</h1>
            <form method="POST" action="../verwerking/update.php">
                <input type="hidden" name="id" value="<?php echo $item ? htmlspecialchars($item['id']) : ''; ?>">
                <div>
                    <label for="title">Titel</label>
                    <input type="text" id="title" name="title" required value="<?php echo $item ? htmlspecialchars($item['title']) : ''; ?>">
                </div>
                <div>
                    <label for="description">Omschrijving</label>
                    <textarea id="description" name="description" rows="4"><?php echo $item ? htmlspecialchars($item['description']) : ''; ?></textarea>
                </div>
                <div>
                    <label for="due_date">Vervaldatum</label>
                    <input type="date" id="due_date" name="due_date" value="<?php echo $item && $item['due_date'] ? htmlspecialchars($item['due_date']) : ''; ?>">
                </div>
                <div>
                    <label>
                        <input type="checkbox" name="is_completed" value="1" <?php echo ($item && !empty($item['is_completed'])) ? 'checked' : ''; ?>>
                        Afgerond
                    </label>
                </div>
                <div class="action-links">
                    <button type="submit">Opslaan</button>
                    <a href="index.php">Annuleren</a>
                </div>
            </form>
        <?php endif; ?>
    </main>
</body>
</html>