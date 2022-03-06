<?php

namespace src\core\app;

use src\core\request\Request;
use src\core\response\Response;
use src\core\router\Router;
use Exception;

class App
{
    public Router $router;
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function execute()
    {
        $executable = $this->router->getCallback();

        if (!$executable) {
            $response = new Response(
                [
                    "success" => false,
                    "error" => "route not found or method not supported"
                ],
                404
            );

            $response->send();
            return;
        }

        $callback = $executable->getCallback();

        try {
            $response = $callback(
                ...$executable->getPathVariables()
            );

            if (!($response instanceof Response)) {
                throw new Exception("return must be a Response class");
            }

            $response->send();
        } catch (Exception $exception) {
            $response = new Response(
                [
                    "success" => false,
                    "error" => $exception->getMessage()
                ],
                500
            );

            $response->send();
        }
    }
}
