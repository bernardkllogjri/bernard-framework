<?php

namespace Router;

class Router{
    protected static $routes = [];

    public static function handleTraffic(){

        $compounds = explode('/',$_SERVER['REQUEST_URI']);

        for($i=0; $i < count($compounds); $i++){
            if(!$compounds[$i])
                array_splice($compounds,$i,$i+1);
        }

        $uri = '/'.implode('/',$compounds);
        if(!isset(self::$routes[$uri])){
            return view('404');
        }

        $route = self::$routes[$uri];

        if(isset($route)){
            if(!is_string($route)){
                return $route();
            }

            $class = 'Controllers\\'.explode('@',$route)[0];
            $method = explode('@',$route)[1];

            if(class_exists($class)){
                $object = (new $class);
                if(method_exists($object,$method)){
                    return $object->{$method}();
                }
            }

        }

        return view('404');
    }

    public static function register(string $routeName, $callback){
        static::$routes[$routeName] = $callback;
    }
}