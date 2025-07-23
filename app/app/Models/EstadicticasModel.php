<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadisticasModel extends Model
{
    // Modelo para consultar las estadísticas
    public function obtenerEstadisticas()
    {
        // Obtener el total de experiencias aprobadas
        $experienciasAprobadas = $this->db->table('experiencias')
                                          ->where('estado', 'aprobada')
                                          ->countAllResults();

        // Obtener el total de usuarios
        $usuariosRegistrados = $this->db->table('usuarios')->countAllResults();

        // Obtener el total de reservas realizadas
        $reservasRealizadas = $this->db->table('reservas')->countAllResults();

        return [
            'experienciasAprobadas' => $experienciasAprobadas,
            'usuariosRegistrados'   => $usuariosRegistrados,
            'reservasRealizadas'    => $reservasRealizadas
        ];
    }
}