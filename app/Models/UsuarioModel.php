<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'nomusuario',
        'claveacceso',
        'nombre',
        'apellido',
        'email',
        'activo',
        'rol',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'nomusuario' => 'required|min_length[3]|max_length[50]|is_unique[usuarios.nomusuario]',
        'claveacceso' => 'required|min_length[6]',
        'email' => 'required|valid_email|is_unique[usuarios.email]'
    ];

    protected $validationMessages = [
        'nomusuario' => [
            'required' => 'El nombre de usuario es obligatorio',
            'min_length' => 'El nombre de usuario debe tener al menos 3 caracteres',
            'max_length' => 'El nombre de usuario no puede exceder 50 caracteres',
            'is_unique' => 'Este nombre de usuario ya está en uso'
        ],
        'claveacceso' => [
            'required' => 'La contraseña es obligatoria',
            'min_length' => 'La contraseña debe tener al menos 6 caracteres'
        ],
        'email' => [
            'required' => 'El email es obligatorio',
            'valid_email' => 'Debe proporcionar un email válido',
            'is_unique' => 'Este email ya está registrado'
        ]
    ];

    protected $skipValidation = false;

    /**
     * Buscar usuario por nombre de usuario
     */
    public function buscarPorUsuario($nomusuario)
    {
        return $this->where('nomusuario', $nomusuario)
                    ->where('activo', 1)
                    ->first();
    }

    /**
     * Verificar credenciales de login
     */
    public function verificarCredenciales($nomusuario, $claveacceso)
    {
        $usuario = $this->buscarPorUsuario($nomusuario);
        
        if ($usuario && password_verify($claveacceso, $usuario['claveacceso'])) {
            return $usuario;
        }
        
        return false;
    }

    /**
     * Crear nuevo usuario con contraseña hasheada
     */
    public function crearUsuario($datos)
    {
        if (isset($datos['claveacceso'])) {
            $datos['claveacceso'] = password_hash($datos['claveacceso'], PASSWORD_DEFAULT);
        }
        
        return $this->insert($datos);
    }
}
