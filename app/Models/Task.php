<?php 

namespace TorjaPHP\Models;

use TorjaPHP\Core\Model;
use TorjaPHP\Components\Validator;

class Task extends Model {
    public function sanitizePage($page) {
        $validator = new Validator(); 

        return $validator->sanitize($page, function($v) {
            return filter_var($v, FILTER_SANITIZE_NUMBER_INT);
        });
    }

    public function validatePage($page, $last_page = 1) {
        $validator = new Validator();    

        $validator->validate($page, "page", "", function($v) use($last_page) {
            $options = ["options" => ["min_range" => 1, "max_range" => $last_page]];

            return filter_var($v, FILTER_VALIDATE_INT, $options);
        });

        return !$validator->getErrors();
    }

    public function validate($name, $email, $body, &$errors = NULL) {
        $validator = new Validator();

        $validator->validate($name, "name", "Пожалуйста введите имя", function ($v) {
            return !empty($v);
        });

        $validator->validate($email, "email", "Пожалуйста введите адрес электронной почты", function ($v) {
            return !empty($v);
        });

        $validator->validate($email, "email", "Пожалуйста введите правильный адрес электронной почты", function ($v) {
            return filter_var($v, FILTER_VALIDATE_EMAIL);
        });

        $validator->validate($body, "body", "Пожалуйста введите описание задачи", function ($v) {
            return !empty($v);
        });

        $errors = $validator->getErrors();

        return !$errors;
    }

    public function sanitize(&$name, &$email, &$body) {
        $validator = new Validator();

        $name = $validator->sanitize($name);
        
        $email = $validator->sanitize($email, function ($v) {
            $v = \mb_strtolower($v);
            $v = filter_var($v, FILTER_SANITIZE_EMAIL);
            return $v;
        }); 

        $body = $validator->sanitize($body);
    }

    public function post($name, $email, $body) {
        $data = [
            "name" => $name,
            "email" => $email,
            "body" => $body,
        ];

        $this->insert($data);
    }
}