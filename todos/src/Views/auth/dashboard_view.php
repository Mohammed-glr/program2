<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Todos</title>
    <link rel="stylesheet" href="/assets/css/global.css">
</head>
<body>
    <main>
        <h1>Welcome to your Dashboard</h1>
        <div class="success-box">
            <p>Hello, <?php echo htmlspecialchars($username); ?>! You are successfully logged in.</p>
        </div>
        
        <div class="text-center mt-20">
            <a href="/logout.php" class="primary-button">Logout</a>
        </div>
    </main>
</body>
</html>