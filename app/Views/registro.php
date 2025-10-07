<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - Sistema de Superhéroes</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body class="bg-light">

<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
          <h4 class="mb-0">Registro de Usuario</h4>
          <span>
            <?php if (session()->get('logged_in')): ?>
              Registrar nuevo usuario en el sistema
            <?php else: ?>
              Sistema de Superhéroes
            <?php endif; ?>
          </span>
        </div>
        <div class="card-body">
          <form action="<?= base_url('/registro') ?>" method="post" autocomplete="off">
            
            <!-- Mostrar mensajes de éxito -->
            <?php if (session()->getFlashdata('success')): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            <?php endif; ?>

            <!-- Mostrar errores de validación -->
            <?php if (session()->getFlashdata('errors')): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                  <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                  <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            <?php endif; ?>

            <div class="row">
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="nombre" name="nombre" 
                         value="<?= old('nombre') ?>" required>
                  <label for="nombre">Nombre</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="apellido" name="apellido" 
                         value="<?= old('apellido') ?>" required>
                  <label for="apellido">Apellido</label>
                </div>
              </div>
            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="nomusuario" name="nomusuario" 
                     value="<?= old('nomusuario') ?>" required>
              <label for="nomusuario">Nombre de Usuario</label>
              <div class="form-text">Mínimo 3 caracteres, máximo 50</div>
            </div>

            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="email" name="email" 
                     value="<?= old('email') ?>" required>
              <label for="email">Correo Electrónico</label>
            </div>
            
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="claveacceso" name="claveacceso" required>
              <label for="claveacceso">Contraseña</label>
              <div class="form-text">Mínimo 6 caracteres</div>
            </div>

            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="confirmar_clave" name="confirmar_clave" required>
              <label for="confirmar_clave">Confirmar Contraseña</label>
            </div>

            <div class="form-check mb-3">
              <input type="checkbox" class="form-check-input" id="terminos" name="terminos" required>
              <label for="terminos" class="form-check-label">
                Acepto los términos y condiciones del sistema
              </label>
            </div>

            <div class="d-grid gap-2">
              <button class="btn btn-primary btn-lg" type="submit">
                🚀 Registrarse
              </button>
            </div>
          </form>
        </div>
        <div class="card-footer text-center">
          <?php if (session()->get('logged_in')): ?>
            <p class="mb-0">
              <a href="<?= base_url('/dashboard') ?>" class="btn btn-secondary btn-sm">Volver al Dashboard</a>
            </p>
          <?php else: ?>
            <p class="mb-0">
              ¿Ya tienes una cuenta? 
              <a href="<?= base_url('/') ?>" class="text-decoration-none">Iniciar Sesión</a>
            </p>
          <?php endif; ?>
        </div>
      </div>
    </div>  
  </div>
</div>

<script>
// Validar que las contraseñas coincidan
document.getElementById('confirmar_clave').addEventListener('input', function() {
    const password = document.getElementById('claveacceso').value;
    const confirmPassword = this.value;
    
    if (password !== confirmPassword) {
        this.setCustomValidity('Las contraseñas no coinciden');
    } else {
        this.setCustomValidity('');
    }
});
</script>
  
</body>
</html>
