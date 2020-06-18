<?php

namespace TorjaPHP\Core;

class Controller {
  protected function model($model) {
    $namespace = "\\TorjaPHP\\Models\\";
    $class_name = $namespace . ucwords(mb_strtolower($model));

    return new $class_name();
  }

  protected function view($view, $data = []) {

    // Loading header
    require_once APPROOT . "/Views/inc/header.php";

    
    if (file_exists(APPROOT . "/Views/" . $view . ".php")) {
      require_once APPROOT . "/Views/" . $view . ".php";
    } else {
      die("View does not exists!");
    }

    // Loading footer
    require_once APPROOT . "/Views/inc/footer.php";
  
  }

}
