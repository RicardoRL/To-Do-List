<?php

require_once __DIR__ . '/../src/config/init.php';
require_once __DIR__ . '/../src/models/Task.php';
require_once __DIR__ . '/../src/controllers/TaskController.php';

$userId = $_SESSION['user_id'];
$fullname = $_SESSION['fullname'];
$taskController = new TaskController($db);

$task = new Task($db);

$tasks = $task->getTasksByUser($userId);

//Verifica si se va a editar una tarea
$taskToEdit = null;

if(isset($_GET['editTaskId'])){
  $taskToEdit = $taskController->getTaskById(($_GET['editTaskId']));
  var_dump($taskToEdit);
}

require_once __DIR__ . '/../src/views/dashboard.php';
