<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservaModel extends Model
{
    protected $table = 'Reserva';
    protected $primaryKey = 'id_reserva';
    protected $allowedFields = ['id_usuario', 'id_experiencia', 'id_pago', 'fecha_reserva','numero_personas', 'monto_total', 'estado_reserva', 'motivo_cancelacion'];
}