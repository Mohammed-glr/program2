<?php
require_once '../config.php';
$debugInfo = getConnectionDebugInfo();

$stmt = $pdo->query('SELECT * FROM todos ORDER BY id ASC');
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview - CRUD Applicatie</title>
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
        <h1>Overzicht</h1>
        <div class="text-center mb-20">
            <a href="create.php" class="primary-button">Nieuw item</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titel</th>
                    <th>Afgerond</th>
                    <th>Vervaldatum</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><a href="read.php?id=<?php echo urlencode($row['id']); ?>"><?php echo htmlspecialchars($row['title']); ?></a></td>
                        <td><span class="<?php echo !empty($row['is_completed']) ? 'status-completed' : 'status-pending'; ?>"><?php echo !empty($row['is_completed']) ? 'Ja' : 'Nee'; ?></span></td>
                        <td><?php echo htmlspecialchars($row['due_date'] ?? '-'); ?></td>
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
    </main>
</body>
</html>