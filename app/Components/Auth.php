<?php 

namespace TorjaPHP\Components;

class Auth {
    public static function authorize() {
        Session::add("is_authorized", TRUE);
    }

    public static function deauthorize() {
        Session::destroy("is_authorized");
    }

    public static function isAuthorized() {
        return Session::get("is_authorized");
    }
}