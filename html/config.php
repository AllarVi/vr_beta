<?php
header("Content-Type: text/html; charset=utf-8");

require_once 'vendor/autoload.php';

use Parse\ParseClient;

ParseClient::initialize('RbyxhPWWGadeOAWwm1LYUvnLEGd79OvyrJeHNTPS', 'VAeeRrK3hLHVR4rx9wSOoucZOsqHrwSte2O5aa5N', '7bO7EJpG7PCh2KHBTWfX8ikDUAo3Ykziabf69cBL');

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