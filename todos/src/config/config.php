<?php

$server = 'localhost:3306';
$dbName = '102376_PROGRAM2';
$username = '102376_1';
$password = 'N4Ep?9X^ytzipxx7';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$connectionStatus = 'disconnected';
$connectionMessage = '';
$connectionTime = '';

try {
    $startTime = microtime(true);
    $pdo = new PDO("mysql:host=$server;dbname=$dbName", $username, $password, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $endTime = microtime(true);
    $connectionStatus = 'connected';
    $connectionMessage = 'Database connected successfully';
    
} catch (PDOException $e) {
    $connectionStatus = 'failed';
    $connectionMessage = "Connection failed: " . $e->getMessage();
    echo $connectionMessage;
    die();
}

function getConnectionDebugInfo() {
    global $connectionStatus, $connectionMessage;
    
    return [
        'status' => $connectionStatus,
        'message' => $connectionMessage,
    ];
}


// the table 
// CREATE TABLE todos (
//     id INT PRIMARY KEY AUTO_INCREMENT,
//     title VARCHAR(255) NOT NULL,
//     description TEXT,
//     is_completed BOOLEAN DEFAULT FALSE,
//     due_date DATE,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// );


