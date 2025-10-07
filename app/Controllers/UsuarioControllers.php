<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class UsuarioControllers extends Controller
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        helper(['form', 'url', 'avatar']);
    }

    /**
     * Mostrar formulario de login
     */
    public function login()
    {
        // Si ya está logueado, redirigir al dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('home/login');
    }

    /**
     * Procesar login
     */
    public function procesarLogin()
    {
        $nomusuario = $this->request->getPost('nomusuario');
        $claveacceso = $this->request->getPost('claveacceso');
        $recordar = $this->request->getPost('recordar');

        // Validaciones básicas
        if (empty($nomusuario)) {
            session()->setFlashdata('error_nomuser', 'El nombre de usuario es obligatorio');
            return redirect()->back()->withInput();
        }

        if (empty($claveacceso)) {
            session()->setFlashdata('error_password', 'La contraseña es obligatoria');
            return redirect()->back()->withInput();
        }

        // Verificar credenciales
        $usuario = $this->usuarioModel->verificarCredenciales($nomusuario, $claveacceso);

        if ($usuario) {
            // Login exitoso
            $sessionData = [
                'user_id' => $usuario['id'],
                'nomusuario' => $usuario['nomusuario'],
                'nombre' => $usuario['nombre'],
                'apellido' => $usuario['apellido'],
                'email' => $usuario['email'],
                'rol' => $usuario['rol'],
                'logged_in' => true
            ];

            session()->set($sessionData);

            // Si marcó "recordar", establecer cookie
            if ($recordar) {
                $cookieData = [
                    'name' => 'remember_user',
                    'value' => $usuario['nomusuario'],
                    'expire' => 86400 * 30, // 30 días
                    'httponly' => true,
                    'secure' => false
                ];
                $this->response->setCookie($cookieData);
            }

            return redirect()->to('/dashboard');
        } else {
            // Login fallido
            session()->setFlashdata('error_password', 'Usuario o contraseña incorrectos');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Cerrar sesión
     */
    public function logout()
    {
        session()->destroy();
        
        // Eliminar cookie de recordar
        $this->response->deleteCookie('remember_user');
        
        return redirect()->to('/');
    }

    /**
     * Mostrar dashboard
     */
    public function dashboard()
    {
        // Verificar si está logueado
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $data = [
            'usuario' => [
                'id' => session()->get('user_id'),
                'nombre' => session()->get('nombre'),
                'apellido' => session()->get('apellido'),
                'nomusuario' => session()->get('nomusuario'),
                'email' => session()->get('email'),
                'rol' => session()->get('rol')
            ]
        ];

        return view('dashboard', $data);
    }

    /**
     * Mostrar perfil del usuario
     */
    public function perfil()
    {
        // Verificar si está logueado
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $data = [
            'usuario' => [
                'id' => session()->get('user_id'),
                'nombre' => session()->get('nombre'),
                'apellido' => session()->get('apellido'),
                'nomusuario' => session()->get('nomusuario'),
                'email' => session()->get('email'),
                'rol' => session()->get('rol')
            ]
        ];

        return view('perfil', $data);
    }

    /**
     * Registrar nuevo usuario
     */
    public function registro()
    {
        // Si ya está logueado y NO es administrador, redirigir al dashboard
        if (session()->get('logged_in') && session()->get('rol') !== 'administrador') {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'POST') {
            // Validaciones personalizadas
            $rules = [
                'nombre' => 'required|min_length[2]|max_length[100]',
                'apellido' => 'required|min_length[2]|max_length[100]',
                'nomusuario' => 'required|min_length[3]|max_length[50]|is_unique[usuarios.nomusuario]',
                'email' => 'required|valid_email|is_unique[usuarios.email]',
                'claveacceso' => 'required|min_length[6]',
                'confirmar_clave' => 'required|matches[claveacceso]',
                'terminos' => 'required'
            ];

            $messages = [
                'nombre' => [
                    'required' => 'El nombre es obligatorio',
                    'min_length' => 'El nombre debe tener al menos 2 caracteres',
                    'max_length' => 'El nombre no puede exceder 100 caracteres'
                ],
                'apellido' => [
                    'required' => 'El apellido es obligatorio',
                    'min_length' => 'El apellido debe tener al menos 2 caracteres',
                    'max_length' => 'El apellido no puede exceder 100 caracteres'
                ],
                'nomusuario' => [
                    'required' => 'El nombre de usuario es obligatorio',
                    'min_length' => 'El nombre de usuario debe tener al menos 3 caracteres',
                    'max_length' => 'El nombre de usuario no puede exceder 50 caracteres',
                    'is_unique' => 'Este nombre de usuario ya está en uso'
                ],
                'email' => [
                    'required' => 'El email es obligatorio',
                    'valid_email' => 'Debe proporcionar un email válido',
                    'is_unique' => 'Este email ya está registrado'
                ],
                'claveacceso' => [
                    'required' => 'La contraseña es obligatoria',
                    'min_length' => 'La contraseña debe tener al menos 6 caracteres'
                ],
                'confirmar_clave' => [
                    'required' => 'Debe confirmar la contraseña',
                    'matches' => 'Las contraseñas no coinciden'
                ],
                'terminos' => [
                    'required' => 'Debe aceptar los términos y condiciones'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }

            // Preparar datos para insertar
            $datos = [
                'nomusuario' => $this->request->getPost('nomusuario'),
                'claveacceso' => $this->request->getPost('claveacceso'),
                'nombre' => $this->request->getPost('nombre'),
                'apellido' => $this->request->getPost('apellido'),
                'email' => $this->request->getPost('email'),
                'activo' => 1,
                'rol' => 'usuario' // Los nuevos usuarios tienen rol "usuario" por defecto
            ];

            if ($this->usuarioModel->crearUsuario($datos)) {
                session()->setFlashdata('success', '¡Usuario registrado exitosamente! Ya puedes iniciar sesión.');
                return redirect()->to('/');
            } else {
                session()->setFlashdata('errors', ['Error al crear el usuario. Inténtalo de nuevo.']);
                return redirect()->back()->withInput();
            }
        }

        return view('registro');
    }
}