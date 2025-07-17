<?php
namespace App\Models;
use CodeIgniter\Model;

class ReporteModel extends Model
{
    protected $table = 'Reporte';
    protected $primaryKey = 'id_reporte';
    protected $allowedFields = [
        'id_usuario', 
        'id_experiencia', 
        'id_categoria', 
        'descripcion', 
        'estado_reporte', // Agregamos 'estado_reporte' aquí
        'comentario_resolucion'
    ];

}
