<?php
// app/Controllers/ComunidadController.php
namespace App\Controllers;

use App\Models\ExperienciasModel;

class ComunidadController extends BaseController
{
    // Método para mostrar todas las experiencias
    public function index()
    {
        // Crear una instancia del modelo de experiencias
        $model = new ExperienciasModel();
        
        // Obtener todas las experiencias de la base de datos
        $data['experiencias'] = $model->findAll();  // Obtener todas las experiencias
        
        // Pasar los datos a la vista
        return view('comunidad/experiencias', $data);
    }

    // Método para mostrar el formulario de creación de experiencia y guardar los datos
    public function crear()
    {
        // Verificar si el usuario está logueado
        if (!session()->has('user_id')) {
            return redirect()->to('/login');  // Redirigir al login si no está logueado
        }

        // Si el formulario fue enviado
        if ($this->request->getMethod() === 'post') {

            // Validación de los datos del formulario
            $validation = \Config\Services::validation();
            $validation->setRules([
                'titulo' => 'required|min_length[3]',
                'descripcion' => 'required|min_length[10]',
                'precio' => 'required|decimal',
                'cupo' => 'required|integer',
                'fecha_inicio' => 'required|valid_date',
                'imagen' => 'mime_in[imagen,image/jpg,image/jpeg,image/png]|max_size[imagen,1024]', // Validación para imágenes
            ]);

            // Si la validación pasa
            if ($validation->withRequest($this->request)->run()) {
                // Crear una instancia del modelo de experiencias
                $model = new ExperienciasModel();

                // Obtener los datos del formulario
                $data = [
                    'titulo'       => $this->request->getPost('titulo'),
                    'descripcion'  => $this->request->getPost('descripcion'),
                    'precio'       => $this->request->getPost('precio'),
                    'comunidad_id' => session()->get('user_id'),  // ID del usuario logueado
                    'cupo'         => $this->request->getPost('cupo'),
                    'estado'       => 'pendiente',  // Por defecto, el estado es pendiente
                    'fecha_inicio' => $this->request->getPost('fecha_inicio'),
                ];

                // Subir la imagen si existe
                $imagen = $this->request->getFile('imagen');
                if ($imagen && $imagen->isValid()) {
                    // Generar un nombre aleatorio para la imagen
                    $newName = $imagen->getRandomName();
                    $imagen->move(WRITEPATH . 'uploads/profile_pics/', $newName);  // Mover la imagen a la carpeta correspondiente
                    $data['imagen'] = $newName;  // Guardar el nombre de la imagen en la base de datos
                }

                // Guardar los datos en la base de datos
                $model->save($data);

                // Redirigir con un mensaje de éxito
                session()->setFlashdata('success', 'Experiencia creada con éxito.');
                return redirect()->to('/comunidad/experiencias');
            } else {
                // Si la validación falla, redirigir de nuevo con los errores
                return redirect()->to('/comunidad/crear')->withInput()->with('errors', $validation->getErrors());
            }
        }

        // Si no es un método POST, se muestra el formulario
        return view('comunidad/crear');
    }

    // Método para editar una experiencia
    public function editar($id)
    {
        // Crear una instancia del modelo de experiencias
        $model = new ExperienciasModel();

        // Buscar la experiencia por ID
        $data['experiencia'] = $model->find($id);

        if (!$data['experiencia']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Experiencia no encontrada.');
        }

        // Validación de los datos del formulario
        $validation = \Config\Services::validation();
        $validation->setRules([
            'titulo' => 'required|min_length[3]',
            'descripcion' => 'required|min_length[10]',
            'precio' => 'required|decimal',
            'cupo' => 'required|integer',
            'fecha_inicio' => 'required|valid_date',
        ]);

        // Verificar si el formulario es enviado por POST
        if ($this->request->getMethod() === 'post' && $validation->withRequest($this->request)->run()) {
            // Obtener los datos del formulario
            $dataUpdate = [
                'titulo'       => $this->request->getPost('titulo'),
                'descripcion'  => $this->request->getPost('descripcion'),
                'precio'       => $this->request->getPost('precio'),
                'cupo'         => $this->request->getPost('cupo'),
                'estado'       => $this->request->getPost('estado'),
                'fecha_inicio' => $this->request->getPost('fecha_inicio'),
            ];

            // Verificar si se subió una nueva imagen
            $imagen = $this->request->getFile('imagen');
            if ($imagen && $imagen->isValid()) {
                // Eliminar la imagen anterior si existe
                if ($data['experiencia']['imagen']) {
                    unlink(WRITEPATH . 'uploads/profile_pics/' . $data['experiencia']['imagen']);  // Eliminar imagen anterior
                }

                // Subir la nueva imagen
                $newName = $imagen->getRandomName();
                $imagen->move(WRITEPATH . 'uploads/profile_pics/', $newName);
                $dataUpdate['imagen'] = $newName;  // Actualizar el nombre de la imagen
            }

            // Actualizar la experiencia en la base de datos
            $model->update($id, $dataUpdate);

            // Redirigir con un mensaje de éxito
            session()->setFlashdata('success', 'Experiencia actualizada con éxito.');
            return redirect()->to('/comunidad/experiencias');
        }

        // Si la validación falla, redirigir de nuevo con los errores
        return view('comunidad/editar', ['validation' => $validation, 'experiencia' => $data['experiencia']]);
    }

    // Método para eliminar una experiencia
    public function eliminar($id)
    {
        // Crear una instancia del modelo de experiencias
        $model = new ExperienciasModel();
        
        // Buscar la experiencia por ID
        $experiencia = $model->find($id);

        if (!$experiencia) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Experiencia no encontrada.');
        }

        // Eliminar la imagen asociada antes de eliminar el registro
        if ($experiencia['imagen']) {
            unlink(WRITEPATH . 'uploads/profile_pics/' . $experiencia['imagen']);
        }

        // Eliminar la experiencia de la base de datos
        $model->delete($id);

        // Redirigir con un mensaje de éxito
        session()->setFlashdata('success', 'Experiencia eliminada con éxito.');
        return redirect()->to('/comunidad/experiencias');
    }
}
