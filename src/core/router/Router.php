<?php

namespace src\core\router;

use src\core\executable\Executable;
use src\core\request\Request;
use src\core\template\Template;

class Router
{
    protected $request;
    protected $routes = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function add(string $route, string $className)
    {
        $this->routes[$route] = "app\controllers\\$className";
    }

    public function remove(string $route)
    {
        unset($this->routes[$route]);
    }

    public function getCallback()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        foreach ($this->routes as $route => $className) {
            $template = new Template($route, $path);

            if ($template->isMatch()) {
                if (in_array($method, get_class_methods($className))) {
                    return $this->generateExecutable($className, $template, $method);
                }

                if (in_array("all", get_class_methods($className))) {
                    return $this->generateExecutable($className, $template, "all");
                }
            }
        }
    }

    protected function generateExecutable($className, $template, $method)
    {
        return new Executable(
            [
                new $className($this->request, $template),
                $method
            ],
            $template
        );
    }
}
