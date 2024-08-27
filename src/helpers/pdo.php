<?php

class DbPDO{

  private $pdo;
  private $queryString;
  private $credentials;
  private $isConnected = false;

  public function __construct($config){
    $this->connect($config);
  }

  private function connect($config){
    $this->credentials = $config;
    $dsn = "mysql:host=" . $this->credentials['host'] . ";dbname=" . $this->credentials['dbname'];
    $password = $this->credentials['password'];
    $user = $this->credentials['user'];

    $options = array(
      PDO::ATTR_PERSISTENT => false, 
      PDO::ATTR_EMULATE_PREPARES => false, 
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
    );

    try{
      /* Realizar conexión */
      $this->pdo = new PDO($dsn, $user, $password, $options);

      $this->isConnected = true;

    }catch(PDOException $e){
      error_log("Error de conexión: " . $e->getMessage());
    }
  }

  public function query($sql, $params = []){
    $this->queryString = $this->pdo->prepare($sql);
    $this->queryString->execute($params);
    return $this->queryString;
  }

  public function fetch($sql, $params = []){
    return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
  }

  public function fetchAll($sql, $params = []){
    return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }

  public function execute($sql, $params = []){
    return $this->query($sql, $params);
  }

  public function lastInsertId(){
      return $this->pdo->lastInsertId();
  }

  public function getConnectionStatus(){
    return $this->isConnected;
  }
}