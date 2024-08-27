<?php

class Task{

  private $database;

  public function __construct($database){
    $this->database = $database;
  }

  public function getTasksByUser($userId){
    $queryString = "SELECT * FROM tasks WHERE user_id = :user_id";
    return $this->database->fetchAll($queryString, [':user_id' => $userId]);
  }

  public function getTaskById($taskId){
    $queryString = "SELECT * FROM tasks WHERE id = :id";
    return $this->database->fetch($queryString, [':id' => $taskId]);
  }

  public function createTask($title, $description, $status, $userId){
    $queryString = "INSERT INTO tasks (title, description, status, user_id) VALUES (:title, :description, :status, :user_id)";
    return $this->database->execute($queryString, [
      ':title' => $title,
      ':description' => $description,
      ':status' => $status,
      ':user_id' => $userId
    ]);
  }

  public function updateTask($taskId, $title, $description, $status){
    $queryString = "UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :id";
    return $this->database->execute($queryString, [
      ':title' => $title,
      ':description' => $description,
      ':status' => $status,
      ':id' => $taskId
    ]);
  }

  public function deleteTask($taskId){
    $queryString = "DELETE FROM tasks WHERE id = :id";
    return $this->database->execute($queryString, [':id' => $taskId]);
  }
}