<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Digital Finds</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        
        <?php if (isset($error)): ?>
            <div class="warning-box">
                <p><?= htmlspecialchars($error); ?></p>
            </div>
            <?php endif; ?>
            
            <form action="login.php" method="POST">
            <h1>Login</h1>
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required placeholder="Enter your username">
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
            </div>
            <button type="submit">Login</button>
            <p class="link-text">
                Don't have an account? <a href="register.php">Register here</a>.
            </p>
        </form>
        
    </main>
</body>
</html>