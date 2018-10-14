<?php

use \Router\Router as Route;

Route::register('/','MainController@index');
Route::register('/test',function(){
    dd('It Works!');
});