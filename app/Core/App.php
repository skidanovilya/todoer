<?php

namespace TorjaPHP\Core;

use TorjaPHP\Components\Validator;

class App {

  private static $default_controller_name = "Tasks";

  protected $controller;
  protected $action = "page";
  protected $params = [];

  public function __construct() {

    $url_parts = $this->getUrlParts();

    $controller_name = array_shift($url_parts);
    $controller_name = ucwords($controller_name);

    if (!$this->controllerExists($controller_name)) {
      $controller_name = App::$default_controller_name;
    }

    $namespace = "\\TorjaPHP\\Controllers\\";
    $class_name = $namespace . $controller_name;

    $this->controller = new $class_name;

    $action_name = array_shift($url_parts);
    if (method_exists($this->controller, $action_name)) {
      $this->action = $action_name;
    }

    $this->params = $url_parts ? array_values($url_parts) : [];
  }

  public function run() {
    call_user_func_array( [$this->controller, $this->action], $this->params );
  }

  private function controllerExists($controller_name) {
    return file_exists( $this->createControllerPath($controller_name) );
  }

  private function createControllerPath ($controller) {
    return $file_path = APPROOT . "/Controllers/" . $controller . ".php";
  }

  private function getUrlParts() : array {
    $url_parts = [];

    if ( isset($_GET["url"]) ) {
      $url = $_GET["url"];
      $url = rtrim($url, "/");
      $url = filter_var($url, FILTER_SANITIZE_URL);

      $url_parts = explode("/", $url);
    }

    return $url_parts;
  }

}
