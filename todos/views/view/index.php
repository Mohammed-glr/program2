<?php
require_once '../config.php';
$debugInfo = getConnectionDebugInfo();

$stmt = $pdo->query('SELECT * FROM management_todos ORDER BY id ASC');
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Applicatie - Namen Beheren</title>
    <link rel="stylesheet" href="../css/global.css">
    <script src="../scripts/scripts.js" defer></script>
</head>
<body>
    <div class="db-debugger">
        <div class="status status-<?php echo $debugInfo['status']; ?>">
            <span class="status-indicator"></span>
            <?= 'DB: ' . ucfirst($debugInfo['status']); ?>
        </div>
    </div>
    <main>
        <nav>
            <ul>
                <li><a href="create.php">Aanmaken</a></li>
            </ul>
        </nav>
        
        <h1>Overzicht</h1>
        <div class="text-center mb-20">
            <a href="create.php" class="primary-button">Nieuw item</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Titel</th>
                    <th>Afgerond</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $row): ?>
                    <tr>
                        <td><a href="read.php?id=<?php echo urlencode($row['id']); ?>"><?php echo htmlspecialchars($row['title']); ?></a></td>
                        <td><span class="<?php echo !empty($row['is_completed']) ? 'status-completed' : 'status-pending'; ?>"><?php echo !empty($row['is_completed']) ? 'Ja' : 'Nee'; ?></span></td>
                        <td>
                            <div class="action-links">
                                <a href="update.php?id=<?php echo urlencode($row['id']); ?>">Bewerken</a>
                                <a href="read.php?id=<?php echo urlencode($row['id']); ?>">Bekijken</a>
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