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
        return '<a href="index.php?action=clicked">' . $this->user->string . "</a>";
    }

    public function outputEPersonData()
    {

        return "<p>Eesnimi: " . $this->user->firstName . "</p>" .
        "<p>Perekonnanimi: " . $this->user->lastName . "</p>" .
        "<p>Isikukood: " . $this->user->nationalID . "</p>";
    }
}