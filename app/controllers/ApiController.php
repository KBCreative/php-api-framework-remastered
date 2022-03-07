<?php

namespace app\controllers;

use src\extendables\Controller;
use src\core\response\Response;

class ApiController extends Controller
{
    public function all()
    {
        return new Response([
            "success" => true,
            "message" => "This method is called via the all method"
        ]);
    }

    public function post()
    {
        return new Response([
            "success" => true,
            "message" => "This method is called via the specific method"
        ]);
    }
}
