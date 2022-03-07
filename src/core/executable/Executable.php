<?php

namespace src\core\executable;

use src\core\template\Template;

class Executable
{
    protected $callback;
    protected $template;

    public function __construct(array $callback, $template) {
        $this->callback = $callback;
        $this->template = $template;
    }

    public function getCallback()
    {
        return $this->callback;
    }

    public function getPathVariables()
    {
        return $this->template->getValues();
    }

    public function getTemplate()
    {
        return $this->template;
    }
}