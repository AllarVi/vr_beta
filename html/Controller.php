<?php

/**
 * Created by PhpStorm.
 * User: allar
 * Date: 6.12.15
 * Time: 11:38
 */
class Controller
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function clicked()
    {
        $this->model->string = "Updated Data, thanks to MVC and PHP!";
    }

    public function auth()
    {
        $this->model->string = "ID kaardiga audentimine õnnestus edukalt!";
    }

}