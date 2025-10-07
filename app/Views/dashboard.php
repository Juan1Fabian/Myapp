<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Superhéroes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema de Superhéroes</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3 d-flex align-items-center">
                    <?= avatar_completo($usuario['nombre'], $usuario['apellido'], 32, 'rounded-circle me-2') ?>
                    Bienvenido, <?= esc($usuario['nombre'] . ' ' . $usuario['apellido']) ?>
                </span>
                <?php if ($usuario['rol'] === 'administrador'): ?>
                <a class="btn btn-outline-light btn-sm me-2" href="<?= base_url('/registro') ?>">Registro</a>
                <?php endif; ?>
                <a class="btn btn-outline-light btn-sm me-2" href="<?= base_url('/perfil') ?>">Perfil</a>
                <a class="btn btn-outline-light btn-sm" href="<?= base_url('/logout') ?>">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <h1 class="display-4 text-primary">¡Bienvenido al Sistema de Superhéroes!</h1>
                    <p class="lead mt-4">
                        Hola <strong><?= esc($usuario['nombre'] . ' ' . $usuario['apellido']) ?></strong>, 
                        te damos la bienvenida a nuestro sistema de gestión de superhéroes.
                    </p>
                    <hr class="my-4">
                    <p class="mb-4">
                        Desde aquí podrás gestionar toda la información relacionada con los superhéroes. 
                        Utiliza el menú superior para acceder a tu perfil o cerrar sesión.
                    </p>
                    <div class="mt-5">
                        <a class="btn btn-primary btn-lg me-3" href="<?= base_url('/perfil') ?>" role="button">
                            Ver mi Perfil
                        </a>
                        <?php if ($usuario['rol'] === 'administrador'): ?>
                        <a class="btn btn-warning btn-lg" href="<?= base_url('/registro') ?>" role="button">
                            Registro
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>