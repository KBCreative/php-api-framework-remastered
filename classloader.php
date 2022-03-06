<?php

spl_autoload_register("autoload_class");

function autoload_class($class_name)
{
    include_once sprintf(
        "%s%s%s.php",
        ROOT,
        DIRECTORY_SEPARATOR,
        str_replace(["/", "\\"], DIRECTORY_SEPARATOR, $class_name)
    );
}
