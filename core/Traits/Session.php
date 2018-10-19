<?php
namespace Traits;

use DB;

trait Session{
    protected $logeddin;
    protected $login_url = '/admin';
    protected $after_login_page = 'dashboard';


    public function home(){

        $users = DB::raw('SELECT name,email,phone FROM users WHERE admin = 0');

        if($users) {
            return view($this->after_login_page);
        }
        return $this->index();
    }

    public function dashboard(){
        if($this->logeddin){
            return $this->home();
        }else{
            return $this->loginForm();
        }
    }

    public function loginForm(){
        if($_SESSION['login_error']){
            $errors = $_SESSION['login_error'];
            unset($_SESSION['login_error']);
        }
        return view('login');
    }

    public function login(){
        $user = DB::raw('SELECT * FROM users WHERE email = :email limit 1', [
            'email' => $_POST['email']
        ]);


        if(password_verify($_POST['password'],$user->password)){
            $_SESSION['user'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            header("Location: {$_ENV['BASE_URL']}/{$this->login_url}");
        }else{
            $_SESSION['login_error'] = 'Your email and password don\'t match in our database';
            header("Location: {$_ENV['BASE_URL']}/{$this->login_url}");
        }
    }

    public function logout(){
        if($this->logeddin){
            session_destroy();
        }
        header("Location: {$_ENV['BASE_URL']}/");
    }

}
