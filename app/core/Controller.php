<?php

namespace App\Core;

class Controller
{
    public function model($model, $dossier = null)
    {
        $path = __DIR__ . '/../models/' . ($dossier ? $dossier . '/' : '') . $model . '.php';
        if (file_exists($path)) {
            require_once $path;
            $className = "App\\Models\\" . ($dossier ? ucfirst($dossier) . "\\" : "") . $model;
            return new $className();
        }
        return null;
    }

    public function view($view, $data = [])
    {
        extract($data);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("La vue " . $view . " n'existe pas ! (Path: $viewFile)");
        }
    }

    public function redirect($url)
    {
        header("location: " . $url);
    }
}