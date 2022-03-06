<?php

namespace src\core\importer;

use Exception;

class Importer
{
    /**
     * The script should call this function to return all direct paths for importing
     * It returns a sorted array
     */
    public function getPaths($directories)
    {
        $paths = [];

        foreach ($directories as $directory) {
            if (!isset($directory["path"])) {
                throw new Exception('no property "path" set for directory');
            }

            if (!isset($directory["extensions"])) {
                throw new Exception('no property "extensions" set for directory');
            }

            $files = $this->scanDirectory($this->addTrailingSlash($directory["path"]), $directory["extensions"]);

            if (isset($directory["exclude"])) {
                $files = $this->removeExcludedDirectories($files, $directory["exclude"]);
            }

            $paths = array_merge($paths, $files);
        }

        return $paths;
    }

    /**
     * This function returns all files as a direct path from the requested directory
     * The input parameter is an absolute path
     * It only returns files if they have a file extension specified in the extensions array
     */
    public function scanDirectory($absolute_path, $extensions)
    {
        $filenames      = scandir($absolute_path);
        $absolute_paths = [];

        foreach ($filenames as $filename) {
            $absolute_file_path = sprintf("%s%s", $absolute_path, $filename);

            if (is_file($absolute_file_path)) {
                $fileinfo = pathinfo($absolute_file_path);

                if (in_array(strtolower($fileinfo["extension"]), $extensions)) {
                    $absolute_paths[] = sprintf("%s%s", $absolute_path, $filename);
                }
            }
        }

        return $absolute_paths;
    }

    /**
     * This function removes all paths present in the exclude list
     * This function only checks if there are excluded files in the path if $exclude is an array
     */
    public function removeExcludedDirectories($paths, $exclude)
    {
        if (is_array($exclude)) {
            foreach ($paths as $path) {
                if (in_array(basename($path), $exclude)) {
                    $index = array_search($path, $paths);
                    unset($paths[$index]);
                }
            }
        }

        return $paths;
    }

    /**
     * In order for the other methods to work the path needs to have a trailing slash at the end
     * This method adds a trailing slash if there is none present
     */
    public function addTrailingSlash($absolute_path)
    {
        $last_character = $absolute_path[strlen($absolute_path) - 1];

        if (!in_array($last_character, ["/", "\\"])) {
            $absolute_path .= DIRECTORY_SEPARATOR;
        }

        return $absolute_path;
    }
}
