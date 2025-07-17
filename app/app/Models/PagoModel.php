<?php

namespace App\Models;

use CodeIgniter\Model;

class PagoModel extends Model
{
    protected $table = 'Pagos';
    protected $primaryKey = 'id_pago';
    protected $allowedFields = ['monto', 'metodo_pago', 'estado_pago'];
}
