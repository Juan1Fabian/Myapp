<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nomusuario' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'claveacceso' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'apellido' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'unique' => true,
            ],
            'activo' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],
            'rol' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'usuario',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('usuarios');

        // Insertar usuario administrador por defecto
        $data = [
            'nomusuario' => 'admin',
            'claveacceso' => password_hash('admin123', PASSWORD_DEFAULT),
            'nombre' => 'Administrador',
            'apellido' => 'Sistema',
            'email' => 'admin@superheroes.com',
            'activo' => 1,
            'rol' => 'administrador',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('usuarios')->insert($data);
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
