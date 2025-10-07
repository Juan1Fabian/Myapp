<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - Sistema de Superhéroes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/dashboard') ?>">🦸‍♂️ Sistema de Superhéroes</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3 d-flex align-items-center">
                    <?= avatar_completo($usuario['nombre'], $usuario['apellido'], 32, 'rounded-circle me-2') ?>
                    Bienvenido, <?= esc($usuario['nombre'] . ' ' . $usuario['apellido']) ?>
                </span>
                <?php if ($usuario['rol'] === 'administrador'): ?>
                <a class="btn btn-outline-light btn-sm me-2" href="<?= base_url('/registro') ?>">Registro</a>
                <?php endif; ?>
                <a class="btn btn-outline-light btn-sm me-2" href="<?= base_url('/dashboard') ?>">Dashboard</a>
                <a class="btn btn-outline-light btn-sm" href="<?= base_url('/logout') ?>">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Perfil de Usuario</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="mb-3">
                                    <?= avatar_completo($usuario['nombre'], $usuario['apellido'], 120, 'rounded-circle border border-3 border-primary shadow') ?>
                                </div>
                                <h5 class="text-primary"><?= esc($usuario['nombre'] . ' ' . $usuario['apellido']) ?></h5>
                                <p class="text-muted">
                                    <span class="badge bg-<?= $usuario['rol'] === 'administrador' ? 'danger' : 'secondary' ?>">
                                        <?= ucfirst(esc($usuario['rol'])) ?>
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <h5 class="mb-3">Información Personal</h5>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>ID de Usuario:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        #<?= esc($usuario['id']) ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Nombre de Usuario:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <?= esc($usuario['nomusuario']) ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Nombre Completo:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <?= esc($usuario['nombre'] . ' ' . $usuario['apellido']) ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Correo Electrónico:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <?= esc($usuario['email']) ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Rol del Sistema:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="badge bg-<?= $usuario['rol'] === 'administrador' ? 'danger' : 'secondary' ?> fs-6">
                                            <?= ucfirst(esc($usuario['rol'])) ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Estado:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="badge bg-success fs-6">Activo</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="<?= base_url('/dashboard') ?>" class="btn btn-primary me-2">
                                Volver al Dashboard
                            </a>
                            <a href="<?= base_url('/logout') ?>" class="btn btn-danger">
                                Cerrar Sesión
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
