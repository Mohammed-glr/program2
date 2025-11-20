<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Digitale Vondsten</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        
        <?php if (isset($error)): ?>
            <div class="warning-box">
                <p><?php echo htmlspecialchars($error); ?></p>
            </div>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="success-box">
                    <p><?= htmlspecialchars($success); ?></p>
                </div>
                <?php endif; ?>
                
                <form action="register.php" method="POST">
            <h1>Register</h1>
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Register</button>
            
            <p class="link-text">
                Heb je al een account? <a href="login.php">Login hier</a>
            </p>
        </form>
    </main>
</body>
</html>