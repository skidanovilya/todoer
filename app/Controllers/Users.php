<?php 

namespace TorjaPHP\Controllers;

use TorjaPHP\Components\Redirect;
use TorjaPHP\Components\Flash;
use TorjaPHP\Components\Auth;
use TorjaPHP\Core\Controller;

class Users extends Controller {
    public function login() {
        if (Auth::isAuthorized()) {
            (new Redirect("/"))->run();
        }

        $data = [
            "title" => "Войдите в свой аккаунт",
            "form" => [
                "login" => "",
                "password" => "",
            ],
            "errors" => []
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $this->model("User");
            
            $data["form"]["login"] = $_POST["login"];
            $data["form"]["password"] = $_POST["password"];

            $user->sanitizeCredentials($data["form"]["login"], $data["form"]["password"]);

            $user->validateCredentials($data["form"]["login"], $data["form"]["password"], $data["errors"]);

            if (empty($data["errors"])) {
                $user->login();

                Flash::success("Вы успешно авторизованы!");

                (new Redirect("/"))->run();
            }
        }

        $this->view("users/login", $data);
    }

    public function logout() {
        if (Auth::isAuthorized()) {
            $user = $this->model("User");

            $user->logout();
    
            Flash::error("Вы вышли из аккаунта!");
        }

        (new Redirect("/"))->run();
    }
}