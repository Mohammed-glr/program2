<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Todos</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <h1>Register</h1>
        
        <?php if (isset($error)): ?>
            <div class="warning-box">
                <p><?php echo htmlspecialchars($error); ?></p>
            </div>
        <?php endif; ?>
        
        <?php if (isset($success)): ?>
            <div class="success-box">
                <p><?php echo htmlspecialchars($success); ?></p>
            </div>
        <?php endif; ?>
        
        <form action="register.php" method="POST">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        
        <p class="text-center mt-20">
            Already have an account? <a href="login.php">Login here</a>
        </p>
    </main>
</body>
</html>