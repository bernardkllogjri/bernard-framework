<?php
namespace Controllers;
use Core\BaseController;

class MainController extends BaseController{

    public function index(){
        return view('home');
    }
}