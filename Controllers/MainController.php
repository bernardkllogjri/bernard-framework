<?php

class MainController{

    use Session;
    use Connection;
    protected $connection = null;

    public function __construct()
    {
        session_start();
        $this->connection = Connection::make();
        if($_SESSION['user']){
            $this->logeddin = true;
        }else{
            $this->logeddin = false;
        }
    }


    public function index(){
        return view('home');
    }
}