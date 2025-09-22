<?php
require_once '../config.php';
$debugInfo = getConnectionDebugInfo();
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
        <div class="info">
    <main>
        
    </main>
</body>
</html>