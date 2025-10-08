<?php

class Connection
{
    private static ?PDO $instance = null;

    public static function getInstance() : PDO
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../../config/database.php';
            

            $host = $config['host'];
            if (strpos($host, ':') !== false) {
                $dns = sprintf(
                    'mysql:host=%s;dbname=%s',
                    $host,
                    $config['name']
                );
            } else {
                $dns = sprintf(
                    'mysql:host=%s;dbname=%s',
                    $host,
                    $config['name']
                );
            }

            self::$instance = new PDO(
                $dns,
                $config['user'],
                $config['password'],
                $config['options']
            );
        }
        return self::$instance;
    }
}