<?php
namespace App\Controllers;

use App\Models\ExperienciaModel;
use App\Models\ReporteModel;
use App\Models\UsuarioModel;
use App\Models\ReservaModel;
use App\Models\CategoriaReporteModel;
use CodeIgniter\Controller;
use App\Libraries\KMeans;

class AdministradorController extends Controller
{
    public function __construct()
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login'); // Redirigir al login si no es administrador
        }

        // Cargar los modelos necesarios
        helper('form');
        helper('text');

        $this->experienciaModel = new ExperienciaModel();
        $this->reporteModel = new ReporteModel();
        $this->usuarioModel = new UsuarioModel();
        $this->reservaModel = new ReservaModel();
        $this->categoriaReporteModel = new CategoriaReporteModel();
    }

    // Menú principal del administrador
    public function menu()
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');  // Redirigir al login si no es administrador
        }

        return view('administrador/administrador_menu');
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

        // Obtener los reportes pendientes
        $reportes = $this->reporteModel->where('estado_reporte', 'Pendiente')->findAll();

        // Procesar los reportes para agregar los detalles del reportador y el motivo
        foreach ($reportes as &$reporte) {
            // Obtener el usuario que reportó
            $usuario = $this->usuarioModel->find($reporte['id_usuario']);
            $reporte['nombre_reportador'] = $usuario['nombre'];
            $reporte['email_reportador'] = $usuario['correo'];

            // Obtener el motivo del reporte desde la categoría
            $categoria = $this->categoriaReporteModel->find($reporte['id_categoria']);
            $reporte['motivo'] = $categoria ? $categoria['motivo'] : 'Sin motivo';

            // Obtener detalles del reportado (Experiencia o Comunidad)
            if ($reporte['id_experiencia']) {
                $experiencia = $this->experienciaModel->find($reporte['id_experiencia']);
                $reporte['tipo_reportado'] = 'Experiencia';
                $reporte['detalle_reportado'] = $experiencia['titulo'];
            } elseif ($reporte['id_comunidad']) {
                // En caso de que el reporte sea sobre una comunidad
                $comunidad = $this->usuarioModel->find($reporte['id_comunidad']);
                $reporte['tipo_reportado'] = 'Comunidad';
                $reporte['detalle_reportado'] = $comunidad['nombre'];
            }
        }

        // Pasar los reportes a la vista
        return view('administrador/ver_reportes', ['reportes' => $reportes]);
    }

    public function ban_experiencia()
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Acceso no autorizado']);
        }

        // Obtener los datos enviados en el POST
        $id_experiencia = $this->request->getPost('id_experiencia');
        $razon = $this->request->getPost('razon');

        // Verificar si los datos están presentes
        if (empty($id_experiencia) || empty($razon)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Faltan datos para realizar la acción']);
        }

        // Iniciar la transacción para asegurarnos de que todo se ejecute correctamente
        $db = \Config\Database::connect();
        $db->transStart();

        // 1. Banear la experiencia
        $db->table('Experiencia')->update(['estado' => 'Baneada', 'motivo_baneo' => $razon], ['id_experiencia' => $id_experiencia]);

        // Verificar si la experiencia fue encontrada y actualizada
        if ($db->affectedRows() === 0) {
            $db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => 'Experiencia no encontrada']);
        }

        // 2. Obtener la comunidad asociada a la experiencia
        $comunidad = $db->table('Experiencia')->select('id_comunidad')->where('id_experiencia', $id_experiencia)->get()->getRow();

        if ($comunidad) {
            // 3. Suspender la cuenta de la comunidad
            $db->table('Usuario')->update(['tipo_cuenta' => 'Suspendido', 'motivo_suspension' => $razon], ['id_usuario' => $comunidad->id_comunidad]);

            // 4. Cancelar todas las experiencias de esta comunidad (en estado 'Pendiente' o cualquier estado)
            $db->table('Experiencia')->where('id_comunidad', $comunidad->id_comunidad)
                ->update(['estado' => 'Baneada']);
        }

        // Confirmar la transacción
        $db->transComplete();

        // Verificar si la transacción fue exitosa
        if ($db->transStatus() === FALSE) {
            // Si la transacción falla, revertir los cambios
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error al procesar el baneo de la experiencia']);
        }

        // Devolver una respuesta exitosa
        return $this->response->setJSON(['status' => 'ok', 'message' => 'La experiencia ha sido baneada y la comunidad suspendida']);
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
        $id_usuario = $this->request->getPost('id_usuario');
        $nombre = $this->request->getPost('nombre');
        $correo = $this->request->getPost('correo');
        $tipo_cuenta = $this->request->getPost('tipo_cuenta');

        // Validar que los campos no estén vacíos
        if (!$nombre || !$correo || !$tipo_cuenta) {
            session()->setFlashdata('error', 'Todos los campos son obligatorios.');
            return redirect()->to('/admin/editar_usuario/' . $id_usuario);
        }

        // Actualizar el usuario
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
        $usuario = $this->usuarioModel->find($id_usuario);
        if (!$usuario) {
            session()->setFlashdata('error', 'Usuario no encontrado.');
            return redirect()->to('/admin/ver_usuarios');
        }

        // Eliminar usuario
        $this->usuarioModel->delete($id_usuario);

        session()->setFlashdata('success', 'Usuario eliminado correctamente.');
        return redirect()->to('/admin/ver_usuarios');
    }


    public function ver_usuarios()
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');
        }

        // Obtener el término de búsqueda si existe
        $searchTerm = $this->request->getGet('search');

        // Configurar la paginación
        $perPage = 10; // Número de usuarios por página

        // Consulta base con paginación
        $query = $this->usuarioModel;

        // Aplicar filtro de búsqueda si existe
        if (!empty($searchTerm)) {
            $query->groupStart()
                ->like('nombre', $searchTerm)
                ->orLike('correo', $searchTerm)
                ->orLike('tipo_cuenta', $searchTerm)
                ->groupEnd();
        }

        // Obtener usuarios paginados
        $data['usuarios'] = $query->orderBy('nombre', 'ASC')->paginate($perPage);
        $data['pager'] = $this->usuarioModel->pager;
        $data['searchTerm'] = $searchTerm;

        return view('administrador/ver_usuarios', $data);
    }

    // Ver estadísticas
   

    public function ver_estadisticas()
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Admin') {
            return redirect()->to('/login');
        }

        // Obtener datos de usuarios para clustering
        $usuarios = $this->usuarioModel->findAll();

        // Preparar datos para k-means (ejemplo: codificar tipo_cuenta como numérico)
        $tipoCuentaMap = [
            'Admin' => 0,
            'Comunidad' => 1,
            'Turista' => 2,
            'Suspendido' => 3
        ];

        $dataPoints = [];
        foreach ($usuarios as $usuario) {
            $tipoCuentaNum = isset($tipoCuentaMap[$usuario['tipo_cuenta']]) ? $tipoCuentaMap[$usuario['tipo_cuenta']] : 4;
            // Ejemplo: usar tipo_cuenta numérico y longitud del nombre como características
            $dataPoints[] = [
                $tipoCuentaNum,
                strlen($usuario['nombre'])
            ];
        }

        // Ejecutar k-means
        $kmeans = new KMeans(3);
        $kmeans->fit($dataPoints);
        $clusters = $kmeans->getClusters();

        // Contar elementos por cluster
        $clusterCounts = array_count_values($clusters);

        // Preparar datos para la vista
        $data['clusterCounts'] = $clusterCounts;
        $data['numClusters'] = 3;

        // Pasar los datos a la vista
        return view('administrador/ver_estadisticas', $data);
    }


    // Obtener reservas realizadas por día
    public function getReservasPorDia()
    {
        $builder = $this->reservaModel->builder();
        $builder->select('DATE(fecha_reserva) AS fecha, COUNT(id_reserva) AS total')
            ->groupBy('DATE(fecha_reserva)')
            ->orderBy('fecha', 'ASC');
        return $builder->get()->getResultArray();
    }

}

