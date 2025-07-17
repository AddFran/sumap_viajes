<?php

namespace App\Models;

use CodeIgniter\Model;

class ValoracionModel extends Model
{
    protected $table = 'Valoracion';
    protected $primaryKey = 'id_valoracion';
    protected $allowedFields = [
        'id_usuario',
        'id_experiencia',
        'id_reserva',
        'calificacion',
        'comentario'
    ];
}
