<?php
namespace Controllers;
use FrameLab\BaseController;

class MainController extends BaseController{

    public function index(){
        return view('home');
    }
}