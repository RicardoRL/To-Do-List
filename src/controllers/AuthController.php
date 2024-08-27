<?php

require_once __DIR__ . '/../models/User.php';

class AuthController{
  
  private $user;

  public function __construct($database){
    $this->user = new User($database);
  }

  public function register($fullname, $username, $password){
    if($this->user->findUser($username)){
      return [
        'success' => false,
        'message' => 'El nombre de usuario ya existe'
      ];
    }

    if($this->user->create($fullname, $username, $password)){
      return [
        'success' => true,
        'message' => 'Usuario registrado con éxito'
      ];
    }

    return [
      'success' => false,
      'message' => 'Error al registrar el usuario'
    ];
  }

  public function login($username, $password){
    $user = $this->user->verifyPassword($username, $password);
    if($user){
      session_start();
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['fullname'] = $user['fullname'];
      return [
        "success" => true,
        "message" => "Acceso exitoso"
      ];
    }

    return [
      "success" => false,
      "message" => "Error al iniciar sesión"
    ];
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