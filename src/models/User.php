<?php

Class User{
  private $database;

  public function __construct($database){
    $this->database = $database;
  }

  public function create($fullname, $username, $password){
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $queryString = "INSERT INTO users (fullname, username, password) VALUES (:fullname, :username, :password)";
    return $this->database->execute($queryString, [
      ':fullname' => $fullname,
      ':username' => $username,
      ':password' => $passwordHash
    ]);

    return $this->database->queryString->rowCount() > 0;
  }

  public function findUser($username){
    $queryString = "SELECT * FROM users WHERE username = :username";
    return $this->database->fetch($queryString, [':username' => $username]);  
  }

  public function verifyPassword($username, $password){
    $user = $this->findUser($username);
    if($user && password_verify($password, $user['password'])){
      return $user;
    }

    return false;
  }
}