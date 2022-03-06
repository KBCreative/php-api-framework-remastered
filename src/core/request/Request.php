<?php

namespace src\core\request;

class Request
{
    protected $path;
    protected $method;
    protected $body;
    protected $headers;
    protected $parameters;
    protected $cookies;

    public function __construct()
    {
        $this->path = (isset($_GET["REQUEST_URI"])) ? trim($_GET["REQUEST_URI"], "/") : trim($_SERVER["REQUEST_URI"], "/");
        $this->method = strtolower($_SERVER["REQUEST_METHOD"]);
        $this->body = file_get_contents("php://input");
        $this->headers = getallheaders();
        $this->parameters = $_GET;
        $this->cookies = $_COOKIE;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getCookies()
    {
        return $this->cookies;
    }

    public function getJson()
    {
        return json_decode($this->body, true);
    }

    public function getFormData() {
        return $_POST;
    }
}
