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

// Se crea instancia de AuthController para gestionar la autenticación
$authController = new AuthController($db);

if($_SERVER['REQUEST_METHOD'] === "POST"){
  $fullname = trim($_POST['fullname']);
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $password_repeat = trim($_POST['password_repeat']);

  //Validaciones
  if(empty($fullname) || empty($username) || empty($password)){
    die("Al menos un campo no ha sido capturado");
  }

  if(strlen($username) < 5){
    die("El nombre de usuario debe tener al menos 5 caracteres");
  }

  if(strlen($password) < 8){
    die("La contraseña debe tener al menos 8 caracteres");
  }

  if($password != $password_repeat){
    die("Las contraseñas no coinciden, inténtalo nuevamente");
  }

  // Se procesa el registro de un nuevo usuario
  $isRegistered = $authController->register($fullname, $username, $password);
  //die($isRegistered);
  if(!$isRegistered){
    session_start();
  
    $newUserId = $db->lastInsertId();

    $_SESSION['user_id'] = $newUserId;
    $_SESSION['fullname'] = $fullname;
    header('Location: dashboard.php');
    exit;
  }
}

require __DIR__ . '/../src/views/register.php';