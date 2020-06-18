<?php 

namespace TorjaPHP\Components;

class Flash {
    const FLASH_SUCCESS = 0;
    const FLASH_ERROR = 1;

    public static function exists() {
        return !is_null(Session::get("flash_message")) && !is_null(Session::get("flash_type"));
    }

    public static function get() {
        $flash = [
            "message" => Session::get("flash_message"),
            "type" => Session::get("flash_type"),
        ];

        Session::destroy("flash_message");
        Session::destroy("flash_type");

        return $flash;
    }

    private static function flash($message, $type) {
        Session::destroy("flash_message");
        Session::destroy("flash_type");

        Session::add("flash_message", $message);

        switch ($type) {
            case self::FLASH_SUCCESS:
                Session::add("flash_type", "success");
            break;
            case self::FLASH_ERROR:
                Session::add("flash_type", "danger");
            break;
        }
    }

    public static function success($massage) {
        self::flash($massage, self::FLASH_SUCCESS);
    }

    public static function error($massage) {
        self::flash($massage, self::FLASH_ERROR);
    }
}