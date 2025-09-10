<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Applicatie - Namen Beheren</title>
    <link rel="stylesheet" href="../css/global.css">
    <script src="../scripts/scripts.js"></script>
</head>
<body>
    <div class="container">
        <h1>Namen Beheer Systeem</h1>
        
        <div class="form-section">
            <h2>Nieuwe naam toevoegen</h2>
            <form action="../verwerking/maken.php" method="POST">
                <div class="form-group">
                    <label for="naam">Naam:</label>
                    <input type="text" id="naam" name="naam" required>
                </div>
                <button type="submit">Naam toevoegen</button>
            </form>
        </div>

        <div class="form-section">
            <h2>Alle namen</h2>
            <div id="namen-lijst">
                <div class="no-data">Laden...</div>
            </div>
        </div>
    </div>
    <script>
    </script>
</body>
</html>