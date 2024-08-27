<?php

require_once __DIR__ . '/../src/config/init.php';
require_once __DIR__ . '/../src/controllers/TaskController.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
  $title = trim($_POST['title']);
  $description = trim($_POST['description']);
  $status = trim($_POST['status']);
  $userId = $_SESSION['user_id'];

  //Validación
  if(empty($title) || empty($description) || empty($status)){
    die("Al menos un campo no ha sido capturado");
  }

  $taskController = new TaskController($db);

  if($taskController->addTask($title, $description, $status, $userId)){
    header('Location: dashboard.php');
    exit;
  }else{
    echo "Error al agregar tarea";
  }
}else{
  header('Location: dashboard.php');
  exit;
}