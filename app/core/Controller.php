<?php

namespace App\Core;

class Controller{
    public function model($model){
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new ("App\\Models\\" . $model)();
    }

    public function view($view, $data = []){
        extract($data);
        $viewFile = __DIR__ . '../views/' . $view . '.php';

        if(file_exists($viewFile)){
            require_once $viewFile;
        }
        else{
            die("La vue ". $view . "n'existe pas !");
        }
    }

    public function redirect($url){
        header("location: " . $url);
    }
}