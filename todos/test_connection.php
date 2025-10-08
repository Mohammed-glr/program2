<?php
/**
 * Test database connection with new constants-based configuration
 */

echo "=== Testing Database Connection ===\n\n";

// Load the Connection class
require_once __DIR__ . '/src/Database/Connection.php';

try {
    echo "Loading configuration from constants.php...\n";
    
    $pdo = Connection::getInstance();
    
    echo "✓ Successfully connected to database!\n\n";
    
    // Test query
    $version = $pdo->query('SELECT VERSION()')->fetchColumn();
    echo "MySQL Version: $version\n";
    
    // Show configuration being used
    echo "\nConfiguration used:\n";
    echo "  Host: " . DB_HOST . "\n";
    echo "  Database: " . DB_NAME . "\n";
    echo "  User: " . DB_USER . "\n";
    
    // List tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "\nTables in database:\n";
    if (count($tables) > 0) {
        foreach ($tables as $table) {
            echo "  - $table\n";
        }
    } else {
        echo "  (no tables found)\n";
    }
    
    echo "\n✓ Connection test completed successfully!\n";
    
} catch (PDOException $e) {
    echo "✗ Connection failed!\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    echo "Note: This error is expected in dev container.\n";
    echo "The configuration will work on Plesk where MySQL is running.\n";
}
