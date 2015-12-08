<?php

/**
 * Created by PhpStorm.
 * User: allar
 * Date: 6.12.15
 * Time: 11:38
 */
class View
{
    private $user;
    private $controller;

    public function __construct($controller, $user)
    {
        $this->controller = $controller;
        $this->user = $user;
    }

    public function output()
    {
        return $this->user->string;
    }

    public function outputEPersonData()
    {

        return "<p>Eesnimi: " . $this->user->firstName . "</p>" .
        "<p>Perekonnanimi: " . $this->user->lastName . "</p>" .
        "<p>Isikukood: " . $this->user->nationalID . "</p>";
    }

    public function outputParseMessage()
    {
        return $this->user->parseMessage;
    }
}