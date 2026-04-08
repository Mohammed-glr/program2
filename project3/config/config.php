<?php

declare(strict_types=1);


$server = 'localhost:3306';
$dbName = '102376_PW3';
$DBusername = 'ESA_DB';
$DBpassword = 'V9Y8xsjh^?jQixg5';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
