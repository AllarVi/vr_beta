<?php
header("Content-Type: text/html; charset=utf-8");

function url()
{
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
    );
}

//Helper function, doesn't seem to work
function debug_to_console($data)
{

    if (is_array($data))
        $output = "<script>console.log( 'Debug Objects: " . implode(',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}