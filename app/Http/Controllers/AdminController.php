<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

// IMPORTAR MODELOS (ajusta si los nombres cambian)
use App\Models\User;
use App\Models\Curso;
use App\Models\Inscripcion;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 📊 Contadores
        $usuarios = User::count();
        $cursos = Curso::count();
        $inscripciones = Inscripcion::count();

        // 📋 Lista con relaciones
        $inscripcionesLista = Inscripcion::with(['usuario', 'curso'])
            ->latest()
            ->get();

        return view('admin.dashboard', compact(
            'usuarios',
            'cursos',
            'inscripciones',
            'inscripcionesLista'
        ));
    }
}