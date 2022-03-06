<?php

if (is_file(ROOT . "/vendor/autoload.php")) {
    require_once ROOT . "/vendor/autoload.php";
}

/**
 * Add your directories here
 */

$directories = [
    ["path" => ROOT . "/src/functions", "extensions" => ["php"]],
];

$importer = new src\core\importer\Importer();
$paths = $importer->getPaths($directories);

foreach ($paths as $path) {
    include_once $path;
}
