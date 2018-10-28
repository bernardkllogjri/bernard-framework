<?php

use \FrameLab\Router as Route;

Route::get('/','MainController@index');
Route::get('/test',function(){
    dd('It Works!');
});
