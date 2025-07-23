<?php

namespace App\Controllers;

use App\Models\ExperienciaModel;
use App\Models\ImagenModel;
use App\Models\ReservaModel;
use App\Models\UsuarioModel;

class Comunidad extends BaseController
{
    public function menu()
    {
        $session = session();

        // Verificación mínima de acceso
        if (!$session->get('logged_in') || $session->get('tipo_cuenta') !== 'Comunidad') {
            return redirect()->to('/login');
        }

        return view('comunidad/comunidad_menu');
    }

    public function crearExperiencia()
    {
        //helper('form');

        if (!session()->get('logged_in') || session()->get('tipo_cuenta') !== 'Comunidad') {
            return redirect()->to('/login');
        }

        return view('comunidad/comunidad_crear_experiencia');
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
            'cupos' => 'required|integer|greater_than[0]',
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
            return view('comunidad/comunidad_crear_experiencia', ['validation' => $validation]);
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
            'cupo_maximo' => $this->request->getPost('cupos'),
        ], true);

        $imagenes = $this->request->getFiles()['imagenes'];

        foreach ($imagenes as $img) {
            if ($img->isValid() && !$img->hasMoved()) {
                $nombre = $img->getRandomName();
                $ruta_relativa = 'uploads/experiencias/' . $nombre;
                $ruta_absoluta = FCPATH . $ruta_relativa;
                $img->move(dirname($ruta_absoluta), $nombre);
                $imgModel->insert([
                    'id_experiencia' => $id_experiencia,
                    'ruta_imagen' => $ruta_relativa,
                    'descripcion' => '',
                ]);
            }
        }

       return redirect()->to('/comunidad/menu')->with('mensaje', 'Experiencia registrada con imágenes y cupos.');
    }

    public function gestionarExperiencias()
    {
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') !== 'Comunidad') {
            return redirect()->to('/login');
        }

        $model = new \App\Models\ExperienciaModel();
        $experiencias = $model->where('id_comunidad', session()->get('id_usuario'))->findAll();

        return view('comunidad/comunidad_gestionar_experiencias', ['experiencias' => $experiencias]);
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
            'cupo_maximo' => $this->request->getPost('cupos'),
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

    public function verReservas()
    {
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') !== 'Comunidad') {
            return redirect()->to('/login');
        }

        $id_comunidad = session()->get('id_usuario');
        $reservaModel = new ReservaModel();
        $expModel = new ExperienciaModel();
        $usuarioModel = new UsuarioModel();

        // Obtener todas las experiencias de la comunidad
        $experiencias = $expModel->where('id_comunidad', $id_comunidad)->findAll();

        // Obtener los ids de las experiencias de la comunidad
        $id_experiencias = array_map(function($exp) {
            return $exp['id_experiencia'];
        }, $experiencias);

        if (empty($id_experiencias)) {
            // Si no hay experiencias, retornar sin mostrar reservas
            return view('comunidad/comunidad_reservas', ['reservas' => []]);
        }

        // Obtener las reservas asociadas a las experiencias de la comunidad
        $reservas = $reservaModel->whereIn('id_experiencia', $id_experiencias)
            ->orderBy('fecha_reserva', 'DESC')
            ->findAll();

        // Asociar experiencias y turistas
        foreach ($reservas as &$reserva) {
            // Obtener la experiencia asociada a la reserva
            $experiencia = $expModel->find($reserva['id_experiencia']);
            $reserva['experiencia'] = $experiencia['titulo'] ?? 'Experiencia no encontrada';

            // Obtener el usuario turista (reservante)
            $turista = $usuarioModel->find($reserva['id_usuario']);
            $reserva['turista'] = $turista['nombre'] ?? 'Turista no encontrado';
            $reserva['correo_turista'] = $turista['correo'] ?? 'Correo no encontrado'; // Añadimos el correo
        }

        return view('comunidad/comunidad_reservas', ['reservas' => $reservas]);
    }


    public function cambiarEstadoReserva()
    {
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') !== 'Comunidad') {
            return redirect()->to('/login');
        }

        // Obtener el ID de la reserva y el nuevo estado
        $id_reserva = $this->request->getPost('id_reserva');
        $estado_reserva = $this->request->getPost('estado_reserva');

        // Instanciar el modelo de reservas
        $reservaModel = new \App\Models\ReservaModel();

        // Validar si la reserva existe
        $reserva = $reservaModel->find($id_reserva);
        if (!$reserva) {
            return redirect()->back()->with('error', 'Reserva no encontrada.');
        }

        // Actualizar el estado de la reserva
        $reservaModel->update($id_reserva, [
            'estado_reserva' => $estado_reserva
        ]);

        return redirect()->to('/comunidad/ver-reservas')->with('mensaje', 'Estado de la reserva actualizado correctamente.');
    }

}
