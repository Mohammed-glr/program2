<?php

class Connection
{
    private static ?PDO $instance = null;

    public static function getInstance() : PDO
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../../config/database.php';
            
            $dns = sprintf(
                'mysql:host=%s;dbname=%s',
                $config['host'],
                $config['name'],
            );

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