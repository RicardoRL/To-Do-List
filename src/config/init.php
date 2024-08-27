<?php

/* Archivo que permite validar si el usuario está autenticado */

require_once __DIR__ . '/../helpers/pdo.php';
require_once __DIR__ . '/../controllers/AuthController.php';

$config = require_once __DIR__ . '/config.php';

session_start();

// Se crea instancia de PDO
$db = new DbPDO($config['db']);

if(!$db->getConnectionStatus()){
  die("Error al conectarse a la base de datos");
}

// Verifica si el usuario está autenticado
$authController = new AuthController($db);

if(!$authController->isAuthenticated()){
  header('Location: login.php');
  exit;
}