<?php
// app/Models/UsuariosModel.php
namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    // Desactivar timestamps automáticos
    protected $useTimestamps = false; // Esto evitará que CodeIgniter intente gestionar `created_at` y `updated_at`

    protected $allowedFields = ['nombre', 'email', 'password', 'tipo_usuario', 'foto_perfil'];

    // Si usas columnas created_at y updated_at de forma manual, puedes hacerlo en tu controlador o al guardar
}
