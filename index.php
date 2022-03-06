<?php

include_once "settings.php";
include_once "classloader.php";
include_once "includes.php";

$app = new src\core\app\App();

include_once "routes.php";

$app->execute();
