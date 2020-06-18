<?php 

namespace TorjaPHP\Components;

class Validator {
    private $errors = [];

    public function sanitize($value, $callback = NULL) {
        $value = trim($value);
        $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);

        if ($callback) {
            $value = \call_user_func($callback, $value);
        }
        return $value;
    }

    public function validate($value, $slug, $message, $callback) {
        if (\call_user_func($callback, $value)) {
            return TRUE;
        } else {
            if (\key_exists($slug, $this->errors)) {
                array_push($this->errors[$slug], $message);
            } else {
                $this->errors[$slug] = [$message];
            }

            return FALSE;
        }
    }

    public function getErrors() {
        return $this->errors;
    }
}