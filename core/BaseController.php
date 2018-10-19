<?php

namespace Core;
use DB;
use Traits\{Session, Connection};

class BaseController{

    use Session;

    public function __construct(){
        DB::init(Connection::make());

        if($_SESSION['user']){
            $this->logeddin = true;
        }else{
            $this->logeddin = false;
        }
        session_start();

    }
}
