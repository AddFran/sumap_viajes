<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
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

        // Obtener el término de búsqueda si existe
        $searchTerm = $this->request->getGet('search');

        // Consulta base
        $expModel->where('estado', 'Aprobada');

        // Aplicar filtro de búsqueda si existe
        if (!empty($searchTerm)) {
            $expModel->like('titulo', $searchTerm);
        }

        // Obtener experiencias (limitamos a 20 para no sobrecargar)
        $experiencias = $expModel->orderBy('RAND()')->findAll(20);

        // Añadir imagen a cada experiencia
        foreach ($experiencias as &$exp) {
            $img = $imgModel->where('id_experiencia', $exp['id_experiencia'])->first();
            $exp['imagen'] = $img['ruta_imagen'] ?? null;
        }

        return view('turista/turista_menu', [
            'nombre' => $session->get('nombre'),
            'experiencias' => $experiencias,
            'categorias' => $categorias,
            'searchTerm' => $searchTerm // Pasamos el término de búsqueda a la vista
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
        $usuarioModel = new \App\Models\UsuarioModel(); // Cargar el modelo de usuarios

        // Obtener la experiencia
        $experiencia = $expModel->find($id);
        if (!$experiencia || $experiencia['estado'] !== 'Aprobada') {
            return redirect()->to('/turista/menu')->with('error', 'La experiencia no existe o no está aprobada.');
        }

        // Obtener imágenes de la experiencia
        $imagenes = $imgModel->where('id_experiencia', $id)->findAll();

        // Obtener las valoraciones (solo con id_usuario y calificacion)
        $valoracionModel = new \App\Models\ValoracionModel();
        $valoraciones = $valoracionModel->where('id_experiencia', $id)->findAll();

        // Añadir el nombre del usuario a cada valoración
        foreach ($valoraciones as &$valoracion) {
            $usuario = $usuarioModel->find($valoracion['id_usuario']);
            $valoracion['nombre'] = $usuario['nombre']; // Añadir el nombre del usuario a la valoración
        }

        // Calcular el promedio de valoraciones
        $promedio = 0;
        $cantidadValoraciones = count($valoraciones);

        if ($cantidadValoraciones > 0) {
            $totalCalificaciones = array_sum(array_column($valoraciones, 'calificacion'));
            $promedio = round($totalCalificaciones / $cantidadValoraciones, 1); // Promedio con un decimal
        }

        // Pasar todos los datos a la vista
        return view('turista/turista_ver_experiencia', [
            'experiencia' => $experiencia,
            'imagenes' => $imagenes,
            'promedio' => $promedio,
            'valoraciones' => $valoraciones,
            'nombre' => $session->get('nombre')
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
    $experienciaModel = new ExperienciaModel();

    $experiencia = $experienciaModel->find($id_experiencia);

    if (!$experiencia || $experiencia['cupo_maximo'] < $numero_personas) {
        return redirect()->back()->with('error', 'No hay suficiente cupo disponible.');
    }

    // Insertar la reserva
    $reservaModel->insert([
        'id_usuario' => $id_usuario,
        'id_experiencia' => $id_experiencia,
        'numero_personas' => $numero_personas,
        'monto_total' => $monto_total,
        'estado_reserva' => 'Pendiente',
    ]);

    // Actualizar el cupo
    $nuevoCupo = $experiencia['cupo_maximo'] - $numero_personas;
    $experienciaModel->update($id_experiencia, ['cupo_maximo' => $nuevoCupo]);

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
    $experienciaModel = new ExperienciaModel();

    $experiencia = $experienciaModel->find($id_experiencia);

    if (!$experiencia || $experiencia['cupo_maximo'] < $numero_personas) {
        return redirect()->back()->with('error', 'No hay suficiente cupo disponible.');
    }

    // Crear pago
    $id_pago = $pagoModel->insert([
        'monto' => $monto,
        'metodo_pago' => $metodo,
        'estado_pago' => 'completado'
    ], true);

    // Crear reserva
    $reservaModel->insert([
        'id_usuario' => $session->get('id_usuario'),
        'id_experiencia' => $id_experiencia,
        'id_pago' => $id_pago,
        'numero_personas' => $numero_personas,
        'monto_total' => $monto,
        'estado_reserva' => 'Confirmada'
    ]);

    // Actualizar cupo
    $nuevoCupo = $experiencia['cupo_maximo'] - $numero_personas;
    $experienciaModel->update($id_experiencia, ['cupo_maximo' => $nuevoCupo]);

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

        return view('turista/turista_reservas', [
            'reservas' => $reservas,
            'nombre' => $session->get('nombre')
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
