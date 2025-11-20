<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digitale Vondst Verwijderen</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <div class="card-container">
            <div class="card">
                <h1>Digitale Vondst Verwijderen</h1>
                <p>Weet je zeker dat je de digitale vondst "<strong><?= htmlspecialchars($digitaleFind->getTitle()); ?></strong>" wilt verwijderen?</p>
                <form method="POST" action="delete.php?id=<?= $digitaleFind->getId(); ?>">
                    <div class="action">
                        <button type="submit">Ja, Verwijderen</button>
                        <a href="dashboard.php">Nee, Annuleren</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
