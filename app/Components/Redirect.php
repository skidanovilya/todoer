<?php 

namespace TorjaPHP\Components;

class Redirect {
    private $url;

    public function __construct($url) {
        $this->url = ltrim($url, "/");
    }

    public function run() {
        header("Location: /" . $this->url);
        exit();
    }
}