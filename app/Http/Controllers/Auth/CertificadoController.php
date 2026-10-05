<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;

class CertificadoController extends Controller
{
    public function index()
    {
        return view('estudiante.certificados.index');
    }
}