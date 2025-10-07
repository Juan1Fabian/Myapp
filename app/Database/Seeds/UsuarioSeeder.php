<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        // Datos de usuarios de prueba
        $usuarios = [
            [
                'nomusuario' => 'juan.perez',
                'claveacceso' => password_hash('123456', PASSWORD_DEFAULT),
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'email' => 'juan.perez@email.com',
                'activo' => 1,
                'rol' => 'usuario',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nomusuario' => 'maria.garcia',
                'claveacceso' => password_hash('123456', PASSWORD_DEFAULT),
                'nombre' => 'María',
                'apellido' => 'García',
                'email' => 'maria.garcia@email.com',
                'activo' => 1,
                'rol' => 'usuario',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nomusuario' => 'carlos.lopez',
                'claveacceso' => password_hash('123456', PASSWORD_DEFAULT),
                'nombre' => 'Carlos',
                'apellido' => 'López',
                'email' => 'carlos.lopez@email.com',
                'activo' => 1,
                'rol' => 'usuario',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nomusuario' => 'ana.martinez',
                'claveacceso' => password_hash('123456', PASSWORD_DEFAULT),
                'nombre' => 'Ana',
                'apellido' => 'Martínez',
                'email' => 'ana.martinez@email.com',
                'activo' => 1,
                'rol' => 'usuario',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nomusuario' => 'supervisor',
                'claveacceso' => password_hash('supervisor123', PASSWORD_DEFAULT),
                'nombre' => 'Luis',
                'apellido' => 'Supervisor',
                'email' => 'supervisor@myapp.com',
                'activo' => 1,
                'rol' => 'administrador',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        // Insertar usuarios usando Query Builder
        foreach ($usuarios as $usuario) {
            $this->db->table('usuarios')->insert($usuario);
        }

        // Mensaje de confirmación
        echo "✅ Seeder ejecutado: 5 usuarios de prueba agregados.\n";
    }
}
