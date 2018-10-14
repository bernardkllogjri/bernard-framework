<?php
namespace Traits;

trait Session{
    protected $logeddin;
    protected $login_url = '/admin';
    protected $after_login_page = 'dashboard';


    public function home(){
        $st = $this->connection->prepare('
            SELECT name,email,phone FROM users WHERE admin = 0
        ');
        if($st->execute()){
            $users = $st->fetchAll(PDO::FETCH_OBJ);
            return view($this->after_login_page);
        }else{
            return $this->index();
        }
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
        return require('../views/login.view.php');
    }

    public function login(){
        $st = $this->connection->prepare(
            'SELECT * FROM users WHERE email = :email limit 1'
        );
        $st->execute([
            'email' => $_POST['email'],
        ]);
        $user = $st->fetch(PDO::FETCH_OBJ);


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