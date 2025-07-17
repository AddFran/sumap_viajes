<?php
namespace App\Models;
use CodeIgniter\Model;

class CategoriaReporteModel extends Model
{
    protected $table = 'Categoria_Reporte';
    protected $primaryKey = 'id_categoria';
    protected $allowedFields = ['motivo', 'descripcion_categoria', 'activo'];
}
