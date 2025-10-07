# Myapp

Un sistema de autenticación y gestión de usuarios desarrollado con CodeIgniter 4, que incluye login, registro y perfiles de usuario con avatares automáticos.

## Características

- **Autenticación completa**: Login y logout seguros
- **Registro de usuarios**: Formulario de registro con validaciones
- **Perfiles de usuario**: Vista detallada con información personal
- **Avatares automáticos**: Generados con iniciales usando CDN
- **Roles de usuario**: Administrador y Usuario con permisos diferenciados
- **Interfaz moderna**: diseño responsivo con Bootstrap 5

## Requisitos

- **PHP 8.1+**
- **MySQL/MariaDB**
- **Composer**
- **XAMPP** (recomendado para desarrollo local)

## Instalación

### 1. Clonar el proyecto
```bash
git clone https://github.com/Juan1Fabian/Myapp.git
```

### 2. Instalar dependencias
```bash
composer install
```

### 3. Configurar base de datos
- Crear base de datos `myapp_db` en MySQL
- Configurar archivo `.env` con tus credenciales:

```env
CI_ENVIRONMENT=development
CI_DEBUG=true

database.default.hostname = localhost
database.default.database = myapp_db
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

### 4. Ejecutar migraciones
```bash
php spark migrate
```

### 5. Ejecutar seeders (opcional)
Para agregar usuarios de prueba:
```bash
php spark db:seed UsuarioSeeder
```

### 6. Iniciar servidor
```bash
php spark serve
```

O usar XAMPP apuntando a la carpeta `public/`

## Usuarios por defecto

### Usuario Administrador (creado automáticamente):
- **Usuario**: `admin`
- **Contraseña**: `admin123`
- **Rol**: Administrador

### Usuarios de Prueba (con seeder):
Si ejecutas el seeder, se crearán estos usuarios adicionales:

**Usuarios normales** (contraseña: `123456`):
- `juan.perez` - Juan Pérez
- `maria.garcia` - María García  
- `carlos.lopez` - Carlos López
- `ana.martinez` - Ana Martínez

**Administrador adicional**:
- **Usuario**: `supervisor`
- **Contraseña**: `supervisor123`
- **Rol**: Administrador

## Funcionalidades

### Para todos los usuarios:
- Iniciar/cerrar sesión
- Ver perfil personal
- Avatar automático con iniciales

### Para administradores:
- Registrar nuevos usuarios
- Acceso completo al sistema

## Rutas principales

- `/` - Página de login
- `/registro` - Registro de usuarios
- `/dashboard` - Panel principal
- `/perfil` - Perfil de usuario
- `/logout` - Cerrar sesión

## Tecnologías utilizadas

- **Backend**: CodeIgniter 4.6.3
- **Frontend**: Bootstrap 5.0.2
- **Base de datos**: MySQL
- **Avatares**: UI Avatars API
- **PHP**: 8.2+

## Estructura del proyecto

```
app/
├── Controllers/
│   ├── Home.php
│   └── UsuarioControllers.php
├── Models/
│   └── UsuarioModel.php
├── Views/
│   ├── home/
│   │   └── login.php
│   ├── dashboard.php
│   ├── perfil.php
│   └── registro.php
├── Database/
│   └── Migrations/
└── Helpers/
    └── avatar_helper.php
```