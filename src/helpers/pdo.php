<?php

class DbPDO{

  private $pdo;
  private $queryString;
  private $credentials;
  private $isConnected = false;

  // Constructor de la clase
  public function __construct($config){
    $this->connect($config);
  }

  // Función que permite realizar la conexión
  private function connect($config){
    $this->credentials = $config;
    $dsn = "mysql:host=" . $this->credentials['host'] . ";dbname=" . $this->credentials['dbname'];
    $password = $this->credentials['password'];
    $user = $this->credentials['user'];

    // Arreglo de opciones para configurar el comportamiento de la conexión PDO
    $options = array(
      PDO::ATTR_PERSISTENT => false, 
      PDO::ATTR_EMULATE_PREPARES => false, 
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
    );

    try{
      // Intento de realizar la conexión
      $this->pdo = new PDO($dsn, $user, $password, $options);

      $this->isConnected = true;

    }catch(PDOException $e){
      error_log("Error de conexión: " . $e->getMessage());
    }
  }

  // Función que permite ejecutar una consulta sql a la base de datos
  public function query($sql, $params = []){
    $this->queryString = $this->pdo->prepare($sql);
    $this->queryString->execute($params);
    return $this->queryString;
  }

  // Función que permite obtener el primer registro de la consulta
  public function fetch($sql, $params = []){
    return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
  }

  // Función que permite obtener todos los registros de la consulta
  public function fetchAll($sql, $params = []){
    return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }

  // Función que ejecuta la consulta a la base de datos
  public function execute($sql, $params = []){
    return $this->query($sql, $params);
  }

  // Función que permite obtener el último registro agregado a la tabla
  public function lastInsertId(){
      return $this->pdo->lastInsertId();
  }

  // Función que permite obtener el estatus de la conexión con la BD
  public function getConnectionStatus(){
    return $this->isConnected;
  }
}