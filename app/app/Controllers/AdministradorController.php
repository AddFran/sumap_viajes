<?php
namespace App\Controllers;

use App\Models\ExperienciaModel;
use App\Models\ReporteModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class AdministradorController extends Controller
{
    public function __construct()
    {
        // Cargar los modelos necesarios
        helper('form');
        helper('text');

        $this->experienciaModel = new ExperienciaModel();
        $this->reporteModel = new ReporteModel();
        $this->usuarioModel = new UsuarioModel();
    }

    // Menú principal del administrador
    public function menu()
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');  // Redirigir al login si no es administrador
        }

        return view('administrador_menu');
    }

    // Controlador: AdministradorController.php

    public function ver_experiencias()
    {
        
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');  // Redirigir al login si no es administrador
        }

        // Obtener las experiencias pendientes
        $data['experienciasPendientes'] = $this->experienciaModel->where('estado', 'Pendiente')->findAll();

        // Obtener la imagen asociada a cada experiencia
        $imagenModel = new \App\Models\ImagenModel(); // Modelo para la tabla Imagenes

        // Agregar la imagen a cada experiencia
        foreach ($data['experienciasPendientes'] as &$experiencia) {
            // Obtener la primera imagen asociada a la experiencia
            $imagen = $imagenModel->where('id_experiencia', $experiencia['id_experiencia'])->first();
            $experiencia['foto_experiencia'] = $imagen ? $imagen['ruta_imagen'] : null;  // Ruta de la imagen (si existe)
        }

        // Pasar las experiencias a la vista
        return view('administrador/ver_experiencias', $data);
    }


    public function aprobar_experiencia($id_experiencia)
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');  // Redirigir al login si no es un administrador
        }

        // Aprobar la experiencia y actualizar su estado
        $this->experienciaModel->update($id_experiencia, ['estado' => 'Aprobada']);
        session()->setFlashdata('success', 'La experiencia ha sido aprobada');

        // Redirigir a la lista de experiencias pendientes
        return redirect()->to('/admin/ver_experiencias');
    }


    // Rechazar experiencia
    public function rechazar_experiencia($id_experiencia)
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');  // Redirigir al login si no es administrador
        }

        // Rechazar la experiencia y actualizar su estado
        $this->experienciaModel->update($id_experiencia, ['estado' => 'Rechazada']);
        session()->setFlashdata('error', 'La experiencia ha sido rechazada');
        return redirect()->to('/admin/ver_experiencias');
    }

    public function ver_reportes()
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');  // Redirigir al login si no es administrador
        }

        // Obtener los reportes pendientes de la base de datos
        $reportes = $this->reporteModel
            ->select('Reporte.*, Categoria_Reporte.motivo')
            ->join('Categoria_Reporte', 'Reporte.id_categoria = Categoria_Reporte.id_categoria')
            ->where('estado_reporte', 'Pendiente')
            ->findAll();

        // Obtener los detalles de lo que fue reportado (ya sea experiencia o comunidad)
        foreach ($reportes as &$reporte) {
            if ($reporte['id_experiencia']) {
                // Si el reporte es sobre una experiencia
                $experiencia = $this->experienciaModel->find($reporte['id_experiencia']);
                $reporte['tipo_reportado'] = 'Experiencia';
                $reporte['detalle_reportado'] = $experiencia['titulo'];  // Título de la experiencia
                $reporte['descripcion_reportado'] = $experiencia['descripcion']; // Descripción de la experiencia
            } elseif ($reporte['id_comunidad']) {
                // Si el reporte es sobre una comunidad
                $comunidad = $this->usuarioModel->find($reporte['id_comunidad']);
                $reporte['tipo_reportado'] = 'Comunidad';
                $reporte['detalle_reportado'] = $comunidad['nombre'];  // Nombre de la comunidad
                $reporte['descripcion_reportado'] = $comunidad['descripcion'] ?? 'Sin descripción'; // Descripción de la comunidad
            }
        }

        // Pasar los reportes a la vista
        return view('administrador/ver_reportes', ['reportes' => $reportes]);
    }

    public function evaluar_reporte($id_reporte, $estado)
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');  // Redirigir al login si no es administrador
        }

        // Verificar que el reporte existe
        $reporte = $this->reporteModel->find($id_reporte);
        if (!$reporte) {
            session()->setFlashdata('error', 'Reporte no encontrado.');
            return redirect()->to('/admin/ver_reportes');
        }

        // Preparar los datos a actualizar
        $datos_actualizacion = [
            'estado_reporte' => $estado,  // Asegúrate de que 'estado_reporte' tenga un valor
        ];

        // Verificar si los datos no están vacíos antes de intentar la actualización
        if (empty($datos_actualizacion) || !isset($datos_actualizacion['estado_reporte'])) {
            session()->setFlashdata('error', 'No hay datos para actualizar.');
            return redirect()->to('/admin/ver_reportes');
        }

        // Realizar la actualización
        $actualizacion = $this->reporteModel->update($id_reporte, $datos_actualizacion);

        // Verificar si la actualización fue exitosa
        if ($actualizacion) {
            // Si el reporte es justificado, realizar la acción correspondiente (por ejemplo, suspender cuenta)
            if ($estado === 'Justificado') {
                if ($reporte['id_experiencia']) {
                    // Si el reporte es sobre una experiencia, suspender la cuenta de la comunidad correspondiente
                    $experiencia = $this->experienciaModel->find($reporte['id_experiencia']);
                    if ($experiencia) {
                        $this->usuarioModel->update($experiencia['id_comunidad'], ['tipo_cuenta' => 'Suspendida']);
                    }
                }
            }

            session()->setFlashdata('success', 'El reporte ha sido procesado');
        } else {
            session()->setFlashdata('error', 'No se pudo actualizar el reporte.');
        }

        // Redirigir al listado de reportes
        return redirect()->to('/admin/ver_reportes');
    }



    public function evaluar_reporte_ajax()
    {
        if ($this->request->isAJAX()) {
            $id_reporte = $this->request->getPost('id_reporte');
            $estado = $this->request->getPost('estado');

            $reporte = $this->reporteModel->find($id_reporte);
            if (!$reporte) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Reporte no encontrado']);
            }

            $this->reporteModel->update($id_reporte, ['estado_reporte' => $estado]);

            return $this->response->setJSON(['status' => 'ok', 'message' => 'Reporte actualizado']);
        }
    }




    public function editar_usuario($id_usuario)
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');  // Redirigir al login si no es administrador
        }

        // Obtener el usuario a editar
        $usuario = $this->usuarioModel->find($id_usuario);
        if (!$usuario) {
            session()->setFlashdata('error', 'Usuario no encontrado.');
            return redirect()->to('/admin/ver_usuarios');
        }

        // Pasar los datos a la vista para que el administrador los edite
        return view('administrador/editar_usuario', ['usuario' => $usuario]);
    }


    public function actualizar_usuario()
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');  // Redirigir al login si no es administrador
        }

        // Obtener los datos del formulario
        $id_usuario = $this->request->getPost('id_usuario');
        $nombre = $this->request->getPost('nombre');
        $correo = $this->request->getPost('correo');
        $tipo_cuenta = $this->request->getPost('tipo_cuenta');

        // Validar que los datos sean correctos (puedes agregar más validaciones)
        if (!$nombre || !$correo || !$tipo_cuenta) {
            session()->setFlashdata('error', 'Todos los campos son obligatorios.');
            return redirect()->to('/admin/editar_usuario/' . $id_usuario);
        }

        // Actualizar los datos del usuario
        $this->usuarioModel->update($id_usuario, [
            'nombre' => $nombre,
            'correo' => $correo,
            'tipo_cuenta' => $tipo_cuenta,
        ]);

        session()->setFlashdata('success', 'Usuario actualizado correctamente.');
        return redirect()->to('/admin/ver_usuarios');
    }


    public function eliminar_usuario($id_usuario)
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');  // Redirigir al login si no es administrador
        }

        // Verificar que el usuario exista antes de eliminar
        $usuario = $this->usuarioModel->find($id_usuario);
        if (!$usuario) {
            session()->setFlashdata('error', 'Usuario no encontrado.');
            return redirect()->to('/admin/ver_usuarios');
        }

        // Eliminar el usuario
        $this->usuarioModel->delete($id_usuario);

        session()->setFlashdata('success', 'Usuario eliminado correctamente.');
        return redirect()->to('/admin/ver_usuarios');
    }



    // Ver usuarios registrados
    public function ver_usuarios()
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');  // Redirigir al login si no es administrador
        }

        // Obtener todos los usuarios
        $data['usuarios'] = $this->usuarioModel->findAll();
        return view('administrador/ver_usuarios', $data);
    }

    // Suspender cuenta de usuario
    public function suspender_cuenta($id_usuario)
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');  // Redirigir al login si no es administrador
        }

        // Suspender la cuenta del usuario
        $this->usuarioModel->update($id_usuario, ['tipo_cuenta' => 'Suspendida']);
        session()->setFlashdata('success', 'La cuenta ha sido suspendida');
        return redirect()->to('/admin/ver_usuarios');
    }
}

