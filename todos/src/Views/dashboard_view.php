

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Todos</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <h1>Welcome to your Dashboard</h1>
        <div class="success-box">
            <p>Hello, <?php echo htmlspecialchars($username); ?>! You are successfully logged in.</p>
        </div>
        <h1>Mijn Todos</h1>
        <div class="todo-overview">
            <a href="create.php" class="primary-button">Nieuwe Todo</a>
            <table class="todo-table">
                <thead>
                    <tr>
                        <th>Titel</th>
                        <th>Omschrijving</th>
                        <th>Vervaldatum</th>
                        <th>Status</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($todos)): ?>
                        <?php foreach ($todos as $todo): ?>
                            <tr>
                                <td><?= htmlspecialchars($todo->getTitle()) ?></td>
                                <td><?= htmlspecialchars($todo->getDescription()) ?></td>
                                <td><?= htmlspecialchars($todo->getCreatedAt()) ?></td>
                                <td><?= $todo->isCompleted() ? 'Afgerond' : 'Open' ?></td>
                                <td>
                                    <a href="update.php?id=<?= $todo->getId() ?>" class="action-link">Bewerken</a>
                                    <a href="delete.php?id=<?= $todo->getId() ?>" class="action-link delete">Verwijderen</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5">Geen todos gevonden.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>