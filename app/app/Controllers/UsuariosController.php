<?php
// app/Controllers/UsuariosController.php
namespace App\Controllers;

use App\Models\UsuariosModel;

class UsuariosController extends BaseController
{
    // Mostrar el formulario de registro
    public function register()
    {
        return view('register');  // Carga la vista de registro
    }

    // Crear un nuevo usuario
    public function create()
    {
        $model = new UsuariosModel();

        // Recoger los datos del formulario
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'tipo_usuario' => $this->request->getPost('tipo_usuario'),
        ];

        // Manejo de la foto de perfil
        $fotoPerfil = $this->request->getFile('foto_perfil');

        if ($fotoPerfil && $fotoPerfil->isValid() && !$fotoPerfil->hasMoved()) {
            // Generar un nombre único para la imagen
            $newName = $fotoPerfil->getRandomName();

            // Mover el archivo a la carpeta 'uploads'
            $fotoPerfil->move(WRITEPATH . 'uploads', $newName);

            // Guardar el nombre del archivo en la base de datos
            $data['foto_perfil'] = $newName;
        } else {
            // Si no se sube una imagen, usar la imagen predeterminada
            $data['foto_perfil'] = 'default-avatar.jpg';
        }

        // Guardar el usuario en la base de datos
        $model->save($data);

        // Redirigir a la página de login
        return redirect()->to('/login');
    }

    // Mostrar el formulario de login
    public function login()
    {
        return view('login');  // Carga la vista de login
    }

    // Procesar el login
    public function doLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $model = new UsuariosModel();

        // Buscar al usuario por correo electrónico
        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Guardar datos del usuario en la sesión
            session()->set('user_id', $user['id']);
            session()->set('user_name', $user['nombre']);
            session()->set('tipo_usuario', $user['tipo_usuario']);  // Guardar tipo de usuario en la sesión

            // Redirigir según el tipo de usuario
            if ($user['tipo_usuario'] == 'admin') {
                return redirect()->to('/admin/dashboard');  // Admin redirige al dashboard
            } elseif ($user['tipo_usuario'] == 'comunidad') {
                return redirect()->to('/comunidad/experiencias');  // Comunidad redirige a su gestión de experiencias
            } else {
                return redirect()->to('/turista/perfil');  // Turista redirige a su perfil
            }
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }
    }
}
