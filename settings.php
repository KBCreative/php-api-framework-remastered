<?php

define("ROOT", __DIR__);
define("DEBUG", true);
define("SYNTAXREPORTING", DEBUG);
define("ERRORREPORTING", DEBUG);

if (!SYNTAXREPORTING) {
    if (ERRORREPORTING) {
        error_reporting(E_ERROR | E_WARNING);
    } else {
        error_reporting(0);
    }
}
