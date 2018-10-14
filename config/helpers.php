<?php
  function env($key){
    return $_ENV[$key];
  }

  function view($view){
    require("../views/{$view}.view.php");
  }

  function config($key){
    $configs = require 'site.php';
    return $configs[$key];
  }

  function dd(...$args){
    die(var_dump($args));
  }