<?php
require_once __DIR__ . '/../src/controllers/AuthController.php';
require_once __DIR__ . '/../src/helpers/pdo.php';

$config = require_once __DIR__ . '/../src/config/config.php';

$db = new DbPDO($config['db']);

if(!$db->getConnectionStatus()){
  die('Error al conectarse a la base de datos');
}

$authController = new AuthController($db);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  //Validaciones
  if(empty($username) || empty($password)){
    $error = [
      "success" => false,
      "message" => "Al menos un campo no ha sido capturado"
    ];
  }else{
    // Se intenta efectuar el login
    $result = $authController->login($username, $password);
    
    if($result['success']){
      header("Location: dashboard.php");
      exit;
    }else{
      $error = $result;
    }
  }
}

require_once __DIR__ . '/../src/views/login.php';