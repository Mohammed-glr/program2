<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', '102376_3');
define('DB_PASSWORD', 'SkS~47~K5tmgkcws');
define('DB_NAME', '102376_PROGRAM2');

define('APP_ENV', 'development');
define('APP_DEBUG', true);
define('APP_NAME', 'Todo Application');
define('BASE_URL', 'http://localhost:8000');

define('APP_ROOT', dirname(__DIR__));
define('PUBLIC_PATH', APP_ROOT . '/public');
define('STORAGE_PATH', APP_ROOT . '/storage');
define('VIEW_PATH', APP_ROOT . '/src/Views');
define('SESSION_NAME', 'todo_app_session');
