<?php
require_once __DIR__ . '/../src/config/config.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';
require_once __DIR__ . '/../src/helpers/pdo.php';

// Se obtienen las credenciales de la base de datos
$config = require __DIR__ . '/../src/config/config.php';

// Se crea instancia de la clase que gestiona la conexión a la base de datos
$db = new DbPDO($config['db']);

if(!$db->getConnectionStatus()){
  die("Error al conectarse a la base de datos");
}

// Se crea instancia de AuthController para la autenticación
$authController = new AuthController($db);

if($_SERVER['REQUEST_METHOD'] === "POST"){
  
  // Obtención de parámetros
  $fullname = trim($_POST['fullname']);
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $password_repeat = trim($_POST['password_repeat']);

  //Validaciones
  if(empty($fullname) || empty($username) || empty($password)){
    $error = [
      "success" => false,
      "message" => "Al menos un campo no ha sido capturado"
    ];
  }else if(strlen($username) < 5){
    $error = [
      "success" => false,
      "message" => "El nombre de usuario debe tener al menos 5 caracteres"
    ];
  }else if(strlen($password) < 8){
    $error = [
      "success" => false,
      "message" => "La contraseña debe tener al menos 8 caracteres"
    ];
  }else if($password != $password_repeat){
    $error = [
      "success" => false,
      "message" => "Las contraseñas no coinciden, inténtalo nuevamente"
    ];
  }else{

    // Se intenta registrar el usuario cuando pasa las validaciones
    $result = $authController->register($fullname, $username, $password);
    $isRegistered = $result['success'];

    // Si el registro es exitoso se procede a iniciar la sesión, caso contrario, muestra error.
    if($isRegistered){
      session_start();
    
      $newUserId = $db->lastInsertId();

      $_SESSION['user_id'] = $newUserId;
      $_SESSION['fullname'] = $fullname;
      header('Location: dashboard.php');
      exit;
    }else{
      $error = $result;
    }
  }
}

require __DIR__ . '/../src/views/register.php';