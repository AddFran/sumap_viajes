<?php

namespace App\Controllers;

use App\Models\ExperienciaModel;
use App\Models\ImagenModel;
use App\Models\ReservaModel;
use App\Models\PagoModel;
use App\Models\ValoracionModel;
use App\Models\CategoriaReporteModel;

class Turista extends BaseController
{
    public function menu()
    {
        $session = session();

        if (!$session->get('logged_in') || $session->get('tipo_cuenta') !== 'Turista') {
            return redirect()->to('/login');
        }

        $expModel = new ExperienciaModel();
        $imgModel = new ImagenModel();
        $catModel = new CategoriaReporteModel();
        $categorias = $catModel->where('activo', true)->findAll();

        // 5 experiencias aleatorias aprobadas
        $experiencias = $expModel
            ->where('estado', 'Aprobada')
            ->orderBy('RAND()') // RAND() funciona en MySQL
            ->limit(5)
            ->findAll();

        // Añadir imagen a cada experiencia
        foreach ($experiencias as &$exp) {
            $img = $imgModel->where('id_experiencia', $exp['id_experiencia'])->first();
            $exp['imagen'] = $img['ruta_imagen'] ?? null;
        }

        return view('turista/turista_menu', [
            'nombre' => $session->get('nombre'),
            'experiencias' => $experiencias,
            'categorias' => $categorias
        ]);
    }

    public function verExperiencia($id)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('tipo_cuenta') !== 'Turista') {
            return redirect()->to('/login');
        }

        $expModel = new \App\Models\ExperienciaModel();
        $imgModel = new \App\Models\ImagenModel();

        $experiencia = $expModel->find($id);
        if (!$experiencia || $experiencia['estado'] !== 'Aprobada') {
            return redirect()->to('/turista/menu')->with('error', 'La experiencia no existe o no está aprobada.');
        }

        $imagenes = $imgModel->where('id_experiencia', $id)->findAll();

        return view('turista/turista_ver_experiencia', [
            'experiencia' => $experiencia,
            'imagenes' => $imagenes
        ]);
    }

    public function guardarReserva()
    {
        $session = session();

        if (!$session->get('logged_in') || $session->get('tipo_cuenta') !== 'Turista') {
            return redirect()->to('/login');
        }

        $id_usuario = $session->get('id_usuario');
        $id_experiencia = $this->request->getPost('id_experiencia');
        $numero_personas = $this->request->getPost('numero_personas');
        $precio_unitario = $this->request->getPost('precio_unitario');

        $monto_total = $numero_personas * $precio_unitario;

        $reservaModel = new ReservaModel();

        $reservaModel->insert([
            'id_usuario' => $id_usuario,
            'id_experiencia' => $id_experiencia,
            'numero_personas' => $numero_personas,
            'monto_total' => $monto_total,
            'estado_reserva' => 'Pendiente',
        ]);

        return redirect()->to('/turista/menu')->with('mensaje', 'Reserva realizada con éxito.');
    }

    public function confirmarPago()
    {
        $session = session();

        if (!$session->get('logged_in') || $session->get('tipo_cuenta') !== 'Turista') {
            return redirect()->to('/login');
        }

        $metodo = $this->request->getPost('metodo_pago');
        $monto = $this->request->getPost('monto');
        $id_experiencia = $this->request->getPost('id_experiencia');
        $numero_personas = $this->request->getPost('numero_personas');

        $pagoModel = new PagoModel();
        $reservaModel = new ReservaModel();

        $id_pago = $pagoModel->insert([
            'monto' => $monto,
            'metodo_pago' => $metodo,
            'estado_pago' => 'completado'
        ], true); // devuelve id_pago

        $reservaModel->insert([
            'id_usuario' => $session->get('id_usuario'),
            'id_experiencia' => $id_experiencia,
            'id_pago' => $id_pago,
            'numero_personas' => $numero_personas,
            'monto_total' => $monto,
            'estado_reserva' => 'Confirmada'
        ]);

        return redirect()->to('/turista/menu')->with('mensaje', 'Reserva y pago registrados correctamente.');
    }

    public function reservas()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('tipo_cuenta') !== 'Turista') {
            return redirect()->to('/login');
        }

        $reservaModel = new ReservaModel();
        $expModel = new ExperienciaModel();
        $pagoModel = new PagoModel();

        $reservas = $reservaModel
            ->where('id_usuario', $session->get('id_usuario'))
            ->orderBy('fecha_reserva', 'DESC')
            ->findAll();

        foreach ($reservas as &$res) {
            $res['experiencia'] = $expModel->find($res['id_experiencia']);
            $res['pago'] = $res['id_pago'] ? $pagoModel->find($res['id_pago']) : null;
        }

        // Pasar el nombre del usuario logueado a la vista
        return view('turista/turista_reservas', [
            'reservas' => $reservas,
            'nombre' => $session->get('nombre') // Aquí pasas la variable nombre a la vista
        ]);
    }

    public function guardarValoracion()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('tipo_cuenta') !== 'Turista') {
            return redirect()->to('/login');
        }

        $valoracionModel = new ValoracionModel();

        $data = [
            'id_usuario' => $session->get('id_usuario'),
            'id_experiencia' => $this->request->getPost('id_experiencia'),
            'id_reserva' => $this->request->getPost('id_reserva'),
            'calificacion' => $this->request->getPost('calificacion'),
            'comentario' => $this->request->getPost('comentario'),
        ];

        try {
            $valoracionModel->insert($data);
            return redirect()->to('/turista/reservas')->with('mensaje', 'Valoración registrada con éxito.');
        } catch (\Exception $e) {
            return redirect()->to('/turista/reservas')->with('error', 'Ya has valorado esta reserva.');
        }
    }

    public function cancelarReserva()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('tipo_cuenta') !== 'Turista') {
            return redirect()->to('/login');
        }

        $id_reserva = $this->request->getPost('id_reserva');
        $motivo = $this->request->getPost('motivo_cancelacion');

        $reservaModel = new \App\Models\ReservaModel();
        $reserva = $reservaModel->find($id_reserva);

        if (!$reserva || $reserva['id_usuario'] != $session->get('id_usuario')) {
            return redirect()->to('/turista/reservas')->with('error', 'Reserva no válida.');
        }

        $reservaModel->update($id_reserva, [
            'estado_reserva' => 'Cancelada',
            'motivo_cancelacion' => $motivo
        ]);

        return redirect()->to('/turista/reservas')->with('mensaje', 'Reserva cancelada correctamente.');
    }

    public function reportar()
    {
        $session = session();
        if (!$session->get('logged_in')) return redirect()->to('/login');

        $model = new \App\Models\ReporteModel();

        $data = [
            'id_usuario' => $session->get('id_usuario'),
            'id_experiencia' => $this->request->getPost('id_experiencia'),
            'id_categoria' => $this->request->getPost('id_categoria'),
            'descripcion' => $this->request->getPost('descripcion')
        ];

        try {
            $model->insert($data);
            return redirect()->back()->with('mensaje', 'Reporte enviado.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ya has reportado esta experiencia.');
        }
    }
}
