<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'Usuario';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['nombre', 'correo', 'contraseña', 'tipo_cuenta', 'foto_perfil'];
    protected $useTimestamps = false;
}
