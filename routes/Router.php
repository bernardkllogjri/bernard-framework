<?php
error_reporting(0);

(new Dotenv\Dotenv(dirname(__DIR__)))->load();
error_reporting($_ENV['ERR_REPORTING']);
require ('../config/helpers.php');


class Router{
    protected static $routes;

    public static function handleTraffic(){

        self::$routes = require '../routes/web.php';

        $compounds = explode('/',$_SERVER['REQUEST_URI']);

        for($i=0; $i < count($compounds); $i++){
            if(!$compounds[$i])
                array_splice($compounds,$i,$i+1);
        }

        $uri = '/'.implode('/',$compounds);

        if(!isset(self::$routes[$uri])){
            return require '../views/404.php';
        }

        $route = self::$routes[$uri];

        if(isset($route)){
            if(!is_string($route)){
                return $route();
            }

            $class = explode('@',$route)[0];
            $controller = '../Controllers/'.$class.'.php';
            $method = explode('@',$route)[1];

            if(file_exists($controller)){
                $object = (new $class);
                if(method_exists($object,$method)){
                    return $object->{$method}();
                }
            }

        }

        return view('404');
    }
}