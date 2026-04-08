<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruimteobject Verwijderen</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <?php if ($error): ?>
            <div class="card-container">
                <div class="card">
                    <h1>Fout</h1>
                    <p style="color: red;"><strong><?php echo htmlspecialchars($error); ?></strong></p>
                    <div class="action-links">
                        <a href="space_objects_dashboard.php">Terug naar Dashboard</a>
                    </div>
                </div>
            </div>
        <?php elseif ($spaceObject): ?>
            <div class="card-container">
                <div class="card">
                    <h1>Ruimteobject Verwijderen</h1>
                    <p>Weet je zeker dat je het ruimteobject "<strong><?= htmlspecialchars($spaceObject->getName()); ?></strong>" wilt verwijderen?</p>
                    <form method="POST" action="space_objects_delete.php?id=<?= $spaceObject->getId(); ?>">
                        <div class="action">
                            <button type="submit">Ja, Verwijderen</button>
                            <a href="space_objects_dashboard.php">Nee, Annuleren</a>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
