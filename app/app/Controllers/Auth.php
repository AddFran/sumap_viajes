<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function login()
    {
        helper('form');
        return view('login_view');
    }

    public function login_process()
    {
        helper('form');
        $session = session();
        $model = new UsuarioModel();

        $correo = $this->request->getPost('correo');
        $password = $this->request->getPost('contraseña');

        // Buscar usuario por correo
        $usuario = $model->where('correo', $correo)->first();

        if ($usuario && password_verify($password, $usuario['contraseña'])) {
            // Login exitoso
            $session->set([
                'id_usuario' => $usuario['id_usuario'],
                'nombre' => $usuario['nombre'],
                'correo' => $usuario['correo'],
                'tipo_cuenta' => $usuario['tipo_cuenta'],
                'logged_in' => true
            ]);

            // Redirección según tipo de cuenta
            switch ($usuario['tipo_cuenta']) {
                case 'Admin':
                    return redirect()->to('/admin/menu');
                case 'Comunidad':
                    return redirect()->to('/comunidad/menu');
                case 'Turista':
                    return redirect()->to('/turista/menu');
                case 'Suspendido':
                    return redirect()->to('/suspendido');
            }
        }

        // Si no coincide usuario o contraseña
        return view('login_view', ['error' => 'Correo o contraseña incorrectos.']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
