<?php
/**
 * Simple Database Connection Test
 * Upload this to Plesk and run: php test.php
 */

require_once __DIR__ . '/src/Database/Connection.php';

echo "=== Database Connection Test ===\n\n";

try {
    echo "Attempting to connect to database...\n";
    echo "Host: " . DB_HOST . "\n";
    echo "Database: " . DB_NAME . "\n";
    echo "User: " . DB_USER . "\n\n";
    
    $pdo = Connection::getInstance();
    
    echo "✓ Connected successfully!\n\n";
    
    // Get MySQL version
    $version = $pdo->query('SELECT VERSION()')->fetchColumn();
    echo "MySQL Version: $version\n\n";
    
    // List all tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "Tables in database:\n";
    if (count($tables) > 0) {
        foreach ($tables as $table) {
            echo "  - $table\n";
        }
    } else {
        echo "  (no tables found)\n";
    }
    
    echo "\n✓✓✓ Connection test passed! ✓✓✓\n";
    
} catch (Exception $e) {
    echo "✗ Connection failed!\n";
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
