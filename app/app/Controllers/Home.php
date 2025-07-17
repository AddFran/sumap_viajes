<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
    // Página de inicio
    public function index()
    {
        // Mensaje para la vista
        $data['mensaje'] = "¡Bienvenido a mi página con CodeIgniter!";
        return view('welcome_message', $data);
    }

    // Página de destino (la que se debe mostrar cuando presionas el botón)
    public function pagina_destino()
    {
        return view('pagina_destino'); // Carga la vista de la página destino
    }
}
