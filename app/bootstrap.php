<?php

require_once "Config/config.php";

error_reporting(E_ALL);
ini_set('display_errors', DEBUGMODE);

require_once "../vendor/autoload.php";

// Starting session
\TorjaPHP\Components\Session::run();