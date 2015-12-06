<?php

/**
 * Created by PhpStorm.
 * User: allar
 * Date: 6.12.15
 * Time: 11:38
 */
class View
{
    private $model;
    private $controller;

    public function __construct($controller, $model)
    {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function output()
    {
        return '<a href="index.php?action=clicked">' . $this->model->string . "</a>";
    }
}