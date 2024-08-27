<?php

/* Archivo de configuración donde se proporciona las credenciales para la conexión con la BD */

return [
  'db' => [ //Credenciales de la base de datos
    'host' => 'localhost',
    'dbname' => 'todo_list',
    'user' => 'root',
    'password' => '',
  ],
  'app' => [ //Url raíz para las rutas de la aplicación
    'base_url' => 'http://localhost/todo_list/public',
  ],
];
