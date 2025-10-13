
<?php

class SessionHelper {
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public static function destroy() {
        session_start();
        session_unset();
        session_destroy();
    }
}