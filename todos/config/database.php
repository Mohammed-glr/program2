<?php
// Load constants first
require_once __DIR__ . '/constants.php';

return [
    'host' => DB_HOST,
    'user' => DB_USER,
    'password' => DB_PASSWORD,
    'name' => DB_NAME,
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],
];




