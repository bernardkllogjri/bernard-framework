<?php
    return [
        '/' => 'MainController@index',
        '/test' => function(){
            die(var_dump('It Works!'));
        }
    ];