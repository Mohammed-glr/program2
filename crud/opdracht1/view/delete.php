<?php
require_once '../config.php';
$debugInfo = getConnectionDebugInfo();

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
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
    <title>Delete - CRUD Applicatie</title>
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
        <?php if (!empty($item)): ?>
            <h1>Item verwijderen</h1>
            <div class="warning-box">
                <p>Weet je zeker dat je het item "<strong><?php echo htmlspecialchars($item['title']); ?></strong>" wilt verwijderen?</p>
            </div>
            <form method="POST" action="../verwerking/delete.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
                <div class="action-links">
                    <button type="submit" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);">Ja, verwijderen</button>
                    <a href="index.php">Annuleren</a>
                </div>
            </form>
        <?php else: ?>
            <div class="text-center">
                <p style="color: #e74c3c; font-size: 1.2rem; margin-bottom: 20px;">Item niet gevonden.</p>
                <a href="index.php" class="primary-button">Terug naar overzicht</a>
            </div>
        <?php endif; ?>
    </main>
</body>
</html> 