<?php

require_once __DIR__ . '/../models/User.php';

class AuthController{
  
  private $user;

  public function __construct($database){
    $this->user = new User($database);
  }

  public function register($fullname, $username, $password){
    if($this->user->findUser($username)){
      return true;
    }

    if($this->user->create($fullname, $username, $password)){
      return true;
    }

    return false; //Si no se puede crear usuario retorna false
  }

  public function login($username, $password){
    $user = $this->user->verifyPassword($username, $password);
    if($user){
      session_start();
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['fullname'] = $user['fullname'];
      return true;
    }

    return false;
  }

  public function logout(){
    session_start();
    session_unset();
    session_destroy();
  }

  public function isAuthenticated(){
    return isset($_SESSION['user_id']);
  }
}