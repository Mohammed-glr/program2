<?php
require_once '../config.php';
$debugInfo = getConnectionDebugInfo();

$item = null;
$items = [];

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM todos WHERE id = :id');
    $stmt->execute([':id' => $_GET['id']]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $stmt = $pdo->query('SELECT * FROM todos ORDER BY id ASC');
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read - CRUD Applicatie</title>
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
        <?php if ($item): ?>
            <h1>Details van item #<?php echo htmlspecialchars($item['id']); ?></h1>
            <dl>
                <dt>Titel</dt>
                <dd><?php echo htmlspecialchars($item['title']); ?></dd>
                <dt>Omschrijving</dt>
                <dd><?php echo nl2br(htmlspecialchars($item['description'])); ?></dd>
                <dt>Vervaldatum</dt>
                <dd><?php echo htmlspecialchars($item['due_date'] ?? '-'); ?></dd>
                <dt>Afgerond</dt>
                <dd><span class="<?php echo !empty($item['is_completed']) ? 'status-completed' : 'status-pending'; ?>"><?php echo !empty($item['is_completed']) ? 'Ja' : 'Nee'; ?></span></dd>
            </dl>
            <div class="action-links">
                <a href="update.php?id=<?php echo urlencode($item['id']); ?>">Bewerken</a>
                <a href="delete.php?id=<?php echo urlencode($item['id']); ?>">Verwijderen</a>
                <a href="index.php" style="background: rgba(52, 73, 94, 0.1); color: #34495e;">Terug naar overzicht</a>
            </div>
        <?php else: ?>
            <h1>Alle items</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titel</th>
                        <th>Afgerond</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><a href="read.php?id=<?php echo urlencode($row['id']); ?>"><?php echo htmlspecialchars($row['title']); ?></a></td>
                            <td><span class="<?php echo !empty($row['is_completed']) ? 'status-completed' : 'status-pending'; ?>"><?php echo !empty($row['is_completed']) ? 'Ja' : 'Nee'; ?></span></td>
                            <td>
                                <div class="action-links">
                                    <a href="update.php?id=<?php echo urlencode($row['id']); ?>">Bewerken</a>
                                    <a href="delete.php?id=<?php echo urlencode($row['id']); ?>">Verwijderen</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <div class="text-center mt-20">
            <a href="create.php" class="primary-button">Nieuw item</a>
        </div>
    </main>
</body>
</html> 