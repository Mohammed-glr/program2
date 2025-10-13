<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$server = 'localhost:3306';
$dbName = '102376_PROGRAM2';
$username = '102376_3';
$password = 'SkS~47~K5tmgkcws';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$connectionStatus = 'disconnected';
$connectionMessage = '';
$connectionTime = '';

class Connection {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        global $server, $dbName, $username, $password, $options;

        if (self::$instance === null) {
            try {
                self::$instance = new PDO("mysql:host=$server;dbname=$dbName", $username, $password, $options);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
    public static function getConnection() {
        if (self::$instance === null) {
            self::getInstance();
        }
        return self::$instance;
    }

    public static function getConnectionDebugInfo() {
        global $connectionStatus, $connectionMessage, $connectionTime;

        return [
            'status' => $connectionStatus,
            'message' => $connectionMessage,
            'time' => $connectionTime,
        ];
    }
}

?>
