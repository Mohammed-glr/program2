<?php
// Load constants
require_once __DIR__ . '/config/constants.php';

// Extract host and port from DB_HOST (e.g., "localhost:3306")
$host = DB_HOST;
$port = DB_PORT;
if (strpos($host, ':') !== false) {
    list($host, $port) = explode(':', $host, 2);
}

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => 'mysql',
            'host' => $host,
            'name' => DB_NAME,
            'user' => DB_USER,
            'pass' => DB_PASSWORD,
            'port' => $port,
            'charset' => 'utf8mb4',
        ],
    ],
    'version_order' => 'creation'
];
