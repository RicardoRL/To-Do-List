<?php

require_once __DIR__ . '/../helpers/pdo.php';
require_once __DIR__ . '/../controllers/AuthController.php';

$config = require_once __DIR__ . '/config.php';

/* Inicio de sesión */
session_start();

/* Se crea instancia de DbPDO */
$db = new DbPDO($config['db']);

if(!$db->getConnectionStatus()){
  die("Error al conectarse a la base de datos");
}

/* Verificar si el usuario está autenticado */
$authController = new AuthController($db);

if(!$authController->isAuthenticated()){
  header('Location: login.php');
  exit;
}