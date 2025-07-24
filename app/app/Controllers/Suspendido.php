<?php

namespace App\Controllers;

class Suspendido extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in') || session()->get('tipo_cuenta') != 'Suspendido') {
            return redirect()->to('/login');
        }

        return view('suspendido');
    }

}
