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
    die("Al menos un campo no ha sido capturado");
  }

  if($authController->login($username, $password)){
    header("Location: dashboard.php");
    exit;
  }else{
    echo "<p>Nombre de usuario o contraseña incorrectos.</p>";
  }
}

require_once __DIR__ . '/../src/views/login.php';