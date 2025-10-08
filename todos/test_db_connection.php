<?php
/**
 * Database Connection Test Script
 * Run this from the command line: php test_db_connection.php
 */

// Load environment variables from .env file
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($key, $value) = explode('=', $line, 2);
        putenv(trim($key) . '=' . trim($value));
        $_ENV[trim($key)] = trim($value);
    }
}

echo "=== Database Connection Test ===\n\n";

// Get database configuration
$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '3306';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$dbname = getenv('DB_NAME') ?: 'development_db';

echo "Testing connection with:\n";
echo "  Host: $host\n";
echo "  Port: $port\n";
echo "  User: $user\n";
echo "  Password: " . (empty($password) ? '(empty)' : str_repeat('*', strlen($password))) . "\n";
echo "  Database: $dbname\n\n";

// Test 1: Try to connect without database
echo "Test 1: Connecting to MySQL server...\n";
try {
    $dsn = "mysql:host=$host;port=$port;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "✓ Successfully connected to MySQL server!\n";
    
    // Get MySQL version
    $version = $pdo->query('SELECT VERSION()')->fetchColumn();
    echo "  MySQL Version: $version\n\n";
    
} catch (PDOException $e) {
    echo "✗ Failed to connect to MySQL server\n";
    echo "  Error: " . $e->getMessage() . "\n\n";
    echo "Possible solutions:\n";
    echo "  1. Check if MySQL/MariaDB is installed and running\n";
    echo "  2. Verify the host is correct (try '127.0.0.1' instead of 'localhost')\n";
    echo "  3. Check if the port 3306 is correct\n";
    echo "  4. Verify username and password in .env file\n";
    exit(1);
}

// Test 2: Try to connect to specific database
echo "Test 2: Connecting to database '$dbname'...\n";
try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "✓ Successfully connected to database '$dbname'!\n\n";
    
    // List tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (count($tables) > 0) {
        echo "  Tables in database:\n";
        foreach ($tables as $table) {
            echo "    - $table\n";
        }
    } else {
        echo "  Database is empty (no tables found)\n";
    }
    
} catch (PDOException $e) {
    echo "✗ Failed to connect to database '$dbname'\n";
    echo "  Error: " . $e->getMessage() . "\n\n";
    
    if (strpos($e->getMessage(), 'Unknown database') !== false) {
        echo "The database '$dbname' does not exist.\n";
        echo "You need to create it first. Run:\n";
        echo "  mysql -u $user -p -e \"CREATE DATABASE $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;\"\n";
    }
    exit(1);
}

echo "\n=== All tests passed! ===\n";
echo "Your database connection is working correctly.\n";
echo "You can now run: vendor/bin/phinx migrate\n";
