<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>

<div class="container mt-3">
  <div class="row">
    <div class="col-md-5 mx-auto">
      <form action="<?= base_url('/login') ?>" method="post" autocomplete="off">
        <div class="mb-2">
          <h4 class="mb-0">Acceso al sistema</h4>
          <span>Sistema de super héroes</span>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control rounded-0" id="nomusuario" name="nomusuario" autofocus required>
          <label for="nomusuario">Nombre de usuario</label>
        </div>
        
        <div class="form-floating mb-2">
          <input type="password" class="form-control rounded-0" id="claveacceso" name="claveacceso" required>
          <label for="claveacceso">Contraseña</label>
        </div>

        <div class="form-check form-switch mb-2">
          <input type="checkbox" class="form-check-input" role="switch" id="recordar" name="recordar">
          <label for="recordar" class="form-check-label">Recordar contraseña</label>
        </div>

        <!-- Mensaje de éxito -->
        <?php if (session()->getFlashdata('success')): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php endif; ?>

        <div>
          <strong>
            <?php if (session()->getFlashdata('error_nomuser')): ?>
              <div class="text-danger"><?= session()->getFlashdata('error_nomuser') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error_password')): ?>
              <div class="text-danger"><?= session()->getFlashdata('error_password') ?></div>
            <?php endif; ?>
          </strong>
        </div>

        <div class="text-end">
          <button class="btn btn-primary rounded-0" type="submit">Iniciar sesión</button>
        </div>
      </form>
      
      <hr class="my-3">
      
      <div class="text-center">
        <p class="mb-0">
          ¿No tienes una cuenta? 
          <a href="<?= base_url('/registro') ?>" class="text-decoration-none">Regístrate aquí</a>
        </p>
      </div>
    </div>  
  </div>
</div>
  
</body>
</html>