<?php
  include __DIR__ . '/errores.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Registro</h2>
    <form action="" method="post">
      <div class="mb-3">
        <label for="fullname" class="form-label">Nombre completo</label>
        <input type="text" class="form-control" id="fullname" name="fullname" required>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Nombre de usuario</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Escribe una contraseña" required>
      </div>
      <div class="mb-3">
        <label for="password_repeat" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password_repeat" name="password_repeat" placeholder="Escribe tu contraseña nuevamente" required>
      </div>
      <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
  </div>
</body>
</html>
