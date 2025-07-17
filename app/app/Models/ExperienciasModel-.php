<?php
// app/Models/ExperienciasModel.php
namespace App\Models;

use CodeIgniter\Model;

class ExperienciasModel extends Model
{
    protected $table      = 'experiencias';  // Nombre de la tabla
    protected $primaryKey = 'id';            // Clave primaria

    // Definir los campos que se pueden insertar o actualizar
    protected $allowedFields = ['titulo', 'descripcion', 'imagen', 'precio', 'comunidad_id', 'cupo', 'estado', 'fecha_inicio'];

    // Habilitar los timestamps automáticos si deseas gestionar las columnas `created_at` y `updated_at`
    protected $useTimestamps = true;

    // Validación de los datos al insertar o actualizar
    protected $validationRules = [
        'titulo'       => 'required|min_length[3]|max_length[255]',
        'descripcion'  => 'required|min_length[10]',
        'precio'       => 'required|decimal',
        'comunidad_id' => 'required|is_natural_no_zero',
        'cupo'         => 'required|is_natural_no_zero',
        'estado'       => 'required|in_list[pendiente,aprobada,rechazada,completa]',
        'fecha_inicio' => 'required|valid_date',  // Validar que sea una fecha válida
    ];

    protected $validationMessages = [
        'titulo'       => [
            'required'   => 'El título es obligatorio.',
            'min_length' => 'El título debe tener al menos 3 caracteres.',
            'max_length' => 'El título no puede superar los 255 caracteres.',
        ],
        'descripcion'  => [
            'required' => 'La descripción es obligatoria.',
            'min_length' => 'La descripción debe tener al menos 10 caracteres.',
        ],
        'precio'       => [
            'required' => 'El precio es obligatorio.',
            'decimal'  => 'El precio debe ser un número decimal.',
        ],
        'comunidad_id' => [
            'required' => 'El campo comunidad es obligatorio.',
            'is_natural_no_zero' => 'El campo comunidad debe ser un número válido.',
        ],
        'cupo'         => [
            'required' => 'El campo cupo es obligatorio.',
            'is_natural_no_zero' => 'El campo cupo debe ser un número válido.',
        ],
        'estado'       => [
            'required' => 'El estado es obligatorio.',
            'in_list'  => 'El estado debe ser uno de: pendiente, aprobada, rechazada, cancelada.',
        ],
        'fecha_inicio' => [
            'required' => 'La fecha de inicio es obligatoria.',
            'valid_date' => 'La fecha de inicio debe ser una fecha válida.',
        ],
    ];
}
