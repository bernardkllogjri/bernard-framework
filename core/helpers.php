<?php
    function env($key){
        return $_ENV[$key];
    }

    function formated_view_string($string, array $data = []){
        extract($data);
        return "../resources/views/".str_replace('.','/',$string).".view.php";
    }

    function view($view){
        return require formated_view_string($view);
    }

    function config($key){
        $configs = require '../config/site.php';
        return $configs[$key];
    }

    function dd(...$args){
        die(var_dump($args));
    }

    function partials($partial){
        include formated_view_string($partial);
    }
