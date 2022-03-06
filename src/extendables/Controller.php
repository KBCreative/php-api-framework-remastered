<?php

namespace src\extendables;

use src\core\request\Request;
use src\core\template\Template;

class Controller
{
    protected Request $request;
    protected Template $template;

    public function __construct(Request $request, Template $template) {
        $this->request = $request;
        $this->template = $template;
    }
}