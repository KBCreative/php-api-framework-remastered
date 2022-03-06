<?php

function get_base_url()
{
    return (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? "https" : "http") . sprintf("://%s", $_SERVER["HTTP_HOST"]);
}

function get_path()
{
    return trim($_SERVER["REQUEST_URI"], "/");
}

function get_request_url()
{
    return sprintf("%s/%s", get_base_url(), get_path());
}

function get_index_url()
{
    $base_url = get_request_url();
    $base_path = ROOT;

    $url_split = explode("/", trim($base_url, "/"));
    $path_split = explode(DIRECTORY_SEPARATOR, trim($base_path, "/\\"));

    $index_url_parts = [get_base_url()];

    foreach ($url_split as $url_part) {
        foreach ($path_split as $path_part) {
            if (($url_part == $path_part) && !empty($url_part)) {
                $index_url_parts[] = $url_part;
            }
        }
    }

    return implode("/", $index_url_parts);
}

function urlencode_parameters($parameters)
{
    $parameters_array = [];

    foreach ($parameters as $parameter_name => $parameter_value) {
        $url_encoded_parameter  = sprintf("%s=%s", urlencode($parameter_name), urlencode($parameter_value));
        $parameters_array[]     = $url_encoded_parameter;
    }

    $query_string = implode("&", $parameters_array);

    return $query_string;
}

function urldecode_parameters($string)
{
    $parts          = explode("&", $string);
    $parts_array    = [];

    foreach ($parts  as $part) {
        $part_split = explode("=", $part, 2);
        $key        = urldecode($part_split[0]);
        $value      = urldecode($part_split[1]);

        $parts_array[$key] = $value;
    }

    return $parts_array;
}
