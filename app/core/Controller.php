<?php

class Controller extends Data
{
    // Create a new instance of a model
    protected function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    // Load data to a specific view
    protected function view($view, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        require_once '../app/views/' . $view . '.php';
    }
}
