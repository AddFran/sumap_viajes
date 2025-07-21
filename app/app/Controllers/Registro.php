<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Registro extends BaseController
{
    public function index()
    {
        return view('registro_view');
    }

    public function guardar()
    {
        $model = new UsuarioModel();

        // Validación
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre' => 'required|min_length[3]',
            'correo' => 'required|valid_email|is_unique[Usuario.correo]',
            'contraseña' => 'required|min_length[6]',
            'confirmar_contraseña' => 'matches[contraseña]',
            'tipo_cuenta' => 'required|in_list[Turista,Comunidad]',
            'foto_perfil' => 'uploaded[foto_perfil]|is_image[foto_perfil]|max_size[foto_perfil,1024]' // 1MB max
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('registro_view', ['validation' => $validation]);
        }

        // Manejo de imagen
        $imagen = $this->request->getFile('foto_perfil');
        $nombreImagen = $imagen->getRandomName();
        $imagen->move('uploads/perfiles/', $nombreImagen);

        // Guardar en DB
        $model->insert([
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
            'contraseña' => password_hash($this->request->getPost('contraseña'), PASSWORD_DEFAULT),
            'tipo_cuenta' => $this->request->getPost('tipo_cuenta'),
            'foto_perfil' => 'uploads/perfiles/' . $nombreImagen,
        ]);

        session()->setFlashdata('success', '¡Registro exitoso! Ahora puedes iniciar sesión.');
        return redirect()->to('/login');
    }
}
