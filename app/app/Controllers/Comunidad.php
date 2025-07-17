<?php

namespace App\Controllers;

use App\Models\ExperienciaModel;
use App\Models\ImagenModel;

class Comunidad extends BaseController
{
    public function menu()
    {
        $session = session();

        // Verificación mínima de acceso
        if (!$session->get('logged_in') || $session->get('tipo_cuenta') !== 'Comunidad') {
            return redirect()->to('/login');
        }

        return view('comunidad_menu');
    }

    public function crearExperiencia()
    {
        //helper('form');

        if (!session()->get('logged_in') || session()->get('tipo_cuenta') !== 'Comunidad') {
            return redirect()->to('/login');
        }

        return view('comunidad_crear_experiencia');
    }

    public function guardarExperiencia()
    {
        helper(['form', 'filesystem']);

        if (!session()->get('logged_in') || session()->get('tipo_cuenta') !== 'Comunidad') {
            return redirect()->to('/login');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'titulo' => 'required|max_length[200]',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|valid_date',
            'fecha_fin' => 'required|valid_date',
            'precio' => 'required|decimal|greater_than_equal_to[0]',
            'imagenes.*' => 'uploaded[imagenes.0]|max_size[imagenes,2048]|is_image[imagenes]|mime_in[imagenes,image/jpg,image/jpeg,image/png]'
        ], [
            'imagenes.*' => [
                'uploaded' => 'Debes subir al menos una imagen',
                'max_size' => 'Cada imagen debe ser menor a 2MB',
                'is_image' => 'Solo se permiten archivos de imagen',
                'mime_in' => 'Formato inválido, solo JPG, JPEG, PNG'
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('comunidad_crear_experiencia', ['validation' => $validation]);
        }

        $expModel = new ExperienciaModel();
        $imgModel = new ImagenModel();

        $id_experiencia = $expModel->insert([
            'id_comunidad' => session()->get('id_usuario'),
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'fecha_inicio' => $this->request->getPost('fecha_inicio'),
            'fecha_fin' => $this->request->getPost('fecha_fin'),
            'precio' => $this->request->getPost('precio'),
            'estado' => 'Pendiente',
            'cupo_maximo' => 100,
        ], true); // 'true' devuelve el ID insertado

        $imagenes = $this->request->getFiles()['imagenes'];

        foreach ($imagenes as $img) {
            if ($img->isValid() && !$img->hasMoved()) {
                $nombre = $img->getRandomName();

                $nombre = $img->getRandomName();
                $ruta_relativa = 'uploads/experiencias/' . $nombre;
                $ruta_absoluta = FCPATH . $ruta_relativa;

                $img->move(dirname($ruta_absoluta), $nombre);

                // Guarda la ruta relativa (para mostrarla en HTML)
                $imgModel->insert([
                    'id_experiencia' => $id_experiencia,
                    'ruta_imagen' => $ruta_relativa,
                    'descripcion' => '',
                ]);

            }
        }

        return redirect()->to('/comunidad/menu')->with('mensaje', 'Experiencia registrada con imágenes.');
    }

    public function gestionarExperiencias()
    {
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') !== 'Comunidad') {
            return redirect()->to('/login');
        }

        $model = new \App\Models\ExperienciaModel();
        $experiencias = $model->where('id_comunidad', session()->get('id_usuario'))->findAll();

        return view('comunidad_gestionar_experiencias', ['experiencias' => $experiencias]);
    }

    public function actualizarExperiencia()
    {
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') !== 'Comunidad') {
            return redirect()->to('/login');
        }

        $model = new \App\Models\ExperienciaModel();

        $data = [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'fecha_inicio' => $this->request->getPost('fecha_inicio'),
            'fecha_fin' => $this->request->getPost('fecha_fin'),
            'precio' => $this->request->getPost('precio'),
        ];

        $idExperiencia = $this->request->getPost('id_experiencia');

        $model->update($idExperiencia, $data);

        return redirect()->to('/comunidad/gestionar-experiencias');
    }

    public function eliminarExperiencia()
    {
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') !== 'Comunidad') {
            return redirect()->to('/login');
        }

        $id = $this->request->getPost('id_experiencia');
        $model = new \App\Models\ExperienciaModel();

        // Asegurarse de que solo se eliminen las experiencias del usuario actual
        $experiencia = $model->find($id);
        if ($experiencia && $experiencia['id_comunidad'] == session()->get('id_usuario')) {
            $model->delete($id);
        }

        return redirect()->to('/comunidad/gestionar-experiencias');
    }

    // Funcion de prueba para mostrar las imagens asociadas al id de una esperiencia ------------------------------------------ JOEL LEE ESTO PORFASSSSSSSSS XDXDDDXDXDXDX 
    public function imagenPrueba()
    {
        $id_experiencia = 2; // ID fijo para la prueba

        $imgModel = new ImagenModel();
        $imagenes = $imgModel->where('id_experiencia', $id_experiencia)->findAll();

        return view('imagen_prueba', ['imagenes' => $imagenes]);
    }
}
