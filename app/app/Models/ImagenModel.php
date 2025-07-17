<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagenModel extends Model
{
    protected $table = 'Imagenes';
    protected $primaryKey = 'id_imagen';
    protected $allowedFields = ['id_experiencia', 'ruta_imagen', 'descripcion'];
}
