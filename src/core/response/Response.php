<?php

namespace src\core\response;

class Response
{
    protected $content;
    protected int $statusCode;

    public function __construct($content, int $statusCode = 200)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
    }

    public function send()
    {
        http_response_code($this->statusCode);

        if (is_array($this->content)) {
            header("Content-type: application/json");

            $output = json_encode($this->content);
        } else {
            header("Content-type: text/plain");

            $output = $this->content;
        }

        echo $output;
    }
}
