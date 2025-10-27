<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/config.php';

class Connection {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        global $server, $dbName, $DBusername, $DBpassword, $options;

        if (self::$instance === null) {
            try {
                self::$instance = new PDO("mysql:host=$server;dbname=$dbName", $DBusername, $DBpassword, $options);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage() . "<br><br>Please check your database credentials in config/config.php");
            }
        }

        return self::$instance;
    }
    public static function getConnection(): PDO {
        return self::getInstance();
    }
}

?>
