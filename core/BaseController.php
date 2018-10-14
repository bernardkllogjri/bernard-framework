<?php

namespace Core;
use Traits\{Session, Connection};

class BaseController{

    use Session;
    use Connection;
    protected $connection = null;

    public function __construct(){
      
      $this->connection = Connection::make();
      if($_SESSION['user']){
          $this->logeddin = true;
      }else{
          $this->logeddin = false;
      }
      session_start();

    }
  }