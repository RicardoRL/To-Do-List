<!--Plantilla para mostrar mensajes de error-->
<?php if (isset($error)): ?>
  <div class="card" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; margin-bottom: 20px;">
    <div class="card-body">
      <strong><?php echo htmlspecialchars($error['message']); ?></strong>
    </div>
  </div>
<?php endif; ?>
