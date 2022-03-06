<?php

namespace src\core\template;

class Template
{
    protected $template_string;
    protected $string;
    protected $keys = [];
    protected $values = [];
    protected $regex;

    public function __construct($template_string, $string)
    {
        $this->template_string  = $template_string;
        $this->string           = $string;

        $this->generateRegex();
    }

    protected function generateRegex()
    {
        $template_parts = explode("/", $this->template_string);
        $string_parts   = explode("/", $this->string);
        $modified_parts = [];

        foreach ($template_parts as $index => $part) {
            if (preg_match("/{(.*)}/", $part, $matches)) {
                if (count($matches) > 1) {
                    $this->keys[]   = $matches[1];
                    $this->values[] = urldecode($string_parts[$index] ?? null);

                    $modified_parts[] = "(.[^/]*)";
                }
            } else {
                $modified_parts[] = $part;
            }
        }

        $joined_parts = trim(
            implode(
                "/",
                $modified_parts
            ),
            "/"
        );

        $this->regex = sprintf("/^%s$/", str_replace("/", "\/", $joined_parts));
    }

    /**
     * @return string
     */
    public function getRegex()
    {
        return $this->regex;
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return array_combine($this->keys, $this->values);
    }

    /**
     * @return boolean
     */
    public function isMatch()
    {
        return preg_match($this->regex, $this->string);
    }
}
