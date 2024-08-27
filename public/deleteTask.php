<?php

require_once __DIR__ . '/../src/config/init.php';
require_once __DIR__ . '/../src/controllers/TaskController.php';

if(isset($_GET['id'])){

  $taskId = $_GET['id'];

  $taskController = new TaskController($db);

  if($taskController->deleteTask($taskId)){
    header('Location: dashboard.php');
    exit;
  }else{
    echo "Error al eliminar una tarea";
  }
}else{
  header('Location: dashboard.php');
  exit;
}