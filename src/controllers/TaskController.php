<?php

require_once __DIR__ . '/../models/Task.php';

class TaskController{

  private $task;

  public function __construct($db){
    $this->task = new Task($db);
  }

  public function addTask($title, $description, $status, $userId){
    return $this->task->createTask($title, $description, $status, $userId);
  }

  public function editTask($taskId, $title, $description, $status){
    return $this->task->updateTask($taskId, $title, $description, $status);
  }

  public function deleteTask($taskId){
    return $this->task->deleteTask($taskId);
  }

  public function getTasksByUser($userId){
    return $this->task->getTasksByUser($userId);
  }

  public function getTaskById($taskId){
    return $this->task->getTaskById($taskId);
  }
}