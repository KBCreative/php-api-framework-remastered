<?php

namespace src\classes\request;

class RequestFactory {
    public function create() {
        $path = $this->getPath();
        $method = strtolower($_SERVER["REQUEST_METHOD"]);

    }

    protected function getPath() {
        if (isset($_GET["path"])) {
            return trim($_GET["REQUEST_URI"], "/");
        } else {
            return trim($_SERVER["REQUEST_URI"], "/");
        }
    }
}