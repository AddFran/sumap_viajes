<?php

namespace App\Models;

use CodeIgniter\Model;

class ExperienciaModel extends Model
{
    protected $table = 'Experiencia';
    protected $primaryKey = 'id_experiencia';
    protected $allowedFields = [
        'id_comunidad', 'titulo', 'descripcion', 'fecha_inicio', 'fecha_fin', 'precio', 'estado', 'cupo_maximo', 'motivo_baneo'
    ];
}
