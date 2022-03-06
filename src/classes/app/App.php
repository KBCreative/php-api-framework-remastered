<?php

namespace src\classes\app;

use src\classes\request\Request;
use src\classes\request\RequestFactory;
use src\classes\response\Response;
use src\classes\response\ResponseFactory;
use src\classes\router\Router;

class App
{
    protected Router $router;
    protected Request $request;
    protected Response $response;
    

    public function __construct()
    {
        $requestFactory = new RequestFactory();
        $responseFactory = new ResponseFactory();

        $this->router = new Router();
        $this->request = $requestFactory->create();
        $this->response = $responseFactory->create();
        
    }

    public function execute()
    {
    }
}
