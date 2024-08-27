<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="mb-0">Bienvenido, <?php echo htmlspecialchars($fullname); ?>!</h1>
      <div>
        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addTaskModal">
            Agregar tarea
        </button>
        <a href="logout.php" class="btn btn-secondary">Cerrar sesión</a>
      </div>
    </div>
    <h2>Tus tareas</h2>

    <table class="table table-striped">
      <thead>
        <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($tasks)): ?>
          <?php foreach ($tasks as $task): ?>
            <tr>
              <td><?php echo htmlspecialchars($task['title']); ?></td>
              <td><?php echo htmlspecialchars($task['description']); ?></td>
              <td><?php echo htmlspecialchars($task['status']); ?></td>
              <td>
                <a href="#" 
                  class="btn btn-warning" 
                  data-bs-toggle="modal" 
                  data-bs-target="#editTaskModal"
                  data-bs-id="<?php echo $task['id'];?>"
                  data-bs-title="<?php echo htmlspecialchars($task['title']); ?>"
                  data-bs-description="<?php echo htmlspecialchars($task['description']); ?>"
                  data-bs-status="<?php echo htmlspecialchars($task['status']); ?>">
                  Editar
                </a>
                <a href="deleteTask.php?id=<?php echo $task['id']; ?>"
                   class="btn btn-danger"
                   onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');">
                   Eliminar
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No tienes tareas aún.</td>
            </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>

<!-- Modal para agregar tareas-->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTaskModalLabel">Agregar nueva tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addTaskForm" action="addTask.php" method="POST">
          <div class="mb-3">
            <label for="taskTitle" class="form-label">Título</label>
            <input type="text" class="form-control" id="taskTitle" name="title" required>
          </div>
          <div class="mb-3">
            <label for="taskDescription" class="form-label">Descripción</label>
            <textarea class="form-control" id="taskDescription" name="description" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="taskStatus" class="form-label">Estado</label>
            <select class="form-select" id="taskStatus" name="status" required>
              <option value="Pendiente">Pendiente</option>
              <option value="En progreso">En progreso</option>
              <option value="Completada">Completada</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para editar tarea -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editTaskModalLabel">Editar tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editTaskForm" action="editTask.php" method="POST">
          <input type="hidden" id="editTaskId" name="id">
          <div class="mb-3">
            <label for="editTaskTitle" class="form-label">Título</label>
            <input type="text" class="form-control" id="editTaskTitle" name="title" required>
          </div>
          <div class="mb-3">
            <label for="editTaskDescription" class="form-label">Descripción</label>
            <textarea class="form-control" id="editTaskDescription" name="description" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="editTaskStatus" class="form-label">Estado</label>
            <select class="form-select" id="editTaskStatus" name="status" required>
              <option value="pendiente">Pendiente</option>
              <option value="en progreso">En progreso</option>
              <option value="completada">Completada</option>
          </select>
          </div>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var editTaskModal = document.getElementById('editTaskModal');
  editTaskModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;

    var taskId = button.getAttribute('data-bs-id');
    var taskTitle = button.getAttribute('data-bs-title');
    var taskDescription = button.getAttribute('data-bs-description');
    var taskStatus = button.getAttribute('data-bs-status');

    var modalTitle = editTaskModal.querySelector('.modal-title');
    var inputTaskId = editTaskModal.querySelector('#editTaskId');
    var inputTaskTitle = editTaskModal.querySelector('#editTaskTitle');
    var inputTaskDescription = editTaskModal.querySelector('#editTaskDescription');
    var inputTaskStatus = editTaskModal.querySelector('#editTaskStatus');

    modalTitle.textContent = 'Editar tarea: ' + taskTitle;
    inputTaskId.value = taskId;
    inputTaskTitle.value = taskTitle;
    inputTaskDescription.value = taskDescription;
    
    // Establecer el valor del estado correctamente
    inputTaskStatus.value = taskStatus;
  });
});
</script>



</html>
