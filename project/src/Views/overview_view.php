<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo Overzicht</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <h1>Mijn Todos</h1>
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
                            <td><?= htmlspecialchars($todo['title']) ?></td>
                            <td><?= htmlspecialchars($todo['description']) ?></td>
                            <td><?= htmlspecialchars($todo['due_date']) ?></td>
                            <td><?= $todo['is_completed'] ? 'Afgerond' : 'Open' ?></td>
                            <td>
                                <a href="/public/todo/update.php?id=<?= $todo['id'] ?>" class="action-link">Bewerken</a>
                                <a href="/public/todo/delete.php?id=<?= $todo['id'] ?>" class="action-link delete">Verwijderen</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">Geen todos gevonden.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>

