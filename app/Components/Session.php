<?php 

namespace TorjaPHP\Components;

class Session {
    public static function run() {
        session_start();
    }

    public static function stop() {
        \session_destroy();
    }

    public static function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
    }

    public static function add($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function destroy($key) {
        unset($_SESSION[$key]);
    }
}