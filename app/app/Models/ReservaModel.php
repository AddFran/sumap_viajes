<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservaModel extends Model
{
    protected $table = 'Reserva';
    protected $primaryKey = 'id_reserva';
    protected $allowedFields = ['id_usuario', 'id_experiencia', 'id_pago', 'fecha_reserva','numero_personas', 'monto_total', 'estado_reserva', 'motivo_cancelacion'];

    public function obtenerTransacciones()
    {
        // Agrupar por usuario para ver qué experiencias reservó cada uno
        $query = $this->select('id_usuario, GROUP_CONCAT(id_experiencia) AS experiencias_reservadas')
                    ->groupBy('id_usuario')
                    ->findAll();

        $transacciones = [];

        foreach ($query as $row) {
            $transacciones[] = explode(',', $row['experiencias_reservadas']);
        }

        return $transacciones;
    }

}