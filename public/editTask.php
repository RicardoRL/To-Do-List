<?php
require_once __DIR__ . '/../src/config/init.php';
require_once __DIR__ . '/../src/controllers/TaskController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $title = trim($_POST['title']);
  $description = trim($_POST['description']);
  $status = trim($_POST['status']);
  
  //Validación
  if(empty($title) || empty($description) || empty($status)){
    die("Al menos un campo no ha sido capturado");
  }
  $taskController = new TaskController($db);

  if ($taskController->editTask($id, $title, $description, $status)) {
      header('Location: dashboard.php');
      exit;
  } else {
      echo "Error al actualizar la tarea.";
  }
} else {
  header('Location: dashboard.php');
  exit;
}
