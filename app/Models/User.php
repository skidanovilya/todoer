<?php 

namespace TorjaPHP\Models;

use TorjaPHP\Components\Validator;
use TorjaPHP\Components\Auth;
use TorjaPHP\Core\Model;

class User extends Model {
    public function sanitizeCredentials(&$login, &$password) {
        $validator = new Validator();

        $login = $validator->sanitize($login);
        $password = $validator->sanitize($password);
    }

    public function validateCredentials($login, $password, &$errors) {
        $validator = new Validator();

        $validator->validate($login, "login", "Введите логин", function($log) {
            return !empty($log);
        });

        $user = $this->search("login", $login, TRUE);

        $validator->validate($user, "login", "Пользователя с таким логином не существует", function($u) {
            return $u;
        });

        $validator->validate($password, "password", "Введите пароль", function($pswd) {
            return !empty($pswd);
        });

        if ($user) {
            $validator->validate($password, "password", "Неправильный пароль", function($pswd) use($user) {
                return strcmp($user->password, $pswd) === 0;
            });
        }
        
        $errors = $validator->getErrors();
    }

    public function login() {
        Auth::authorize();
    }

    public function logout() {
        Auth::deauthorize();
    }
}

