<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Curso;
use App\Models\Inscripcion;

class EstudianteController extends Controller
{
    /**
     * Dashboard del estudiante
     */
    public function dashboard()
    {
        // Usuario autenticado
        $usuario = Auth::user();

        // Todos los cursos (opcionales para mostrar catálogo)
        $cursos = Curso::all();

       
        // Cursos recientes
    $recientes = Curso::where('estado', 'recientes')
        ->latest()
        ->get();

        // Cursos inscritos y aprobados del usuario
        $inscripciones = Inscripcion::with('curso')
            ->where('usuario_id', $usuario->id)
            ->where('estado', 'aprobado') // ← cambiar aquí si usas otro campo
            ->get();

        return view('estudiante.dashboard', [
            'cursos' => $cursos,
            'recientes' => $recientes,
            'inscripciones' => $inscripciones
        ]);
    }

    /**
     * Index redirige al dashboard
     */
    public function index()
{

    $recientes = Curso::where('estado','recientes')
        ->latest()
        ->get();


    return view('dashboard', compact('recientes'));

}
  

    public function guardarTiempo(Request $request)
{
    $usuario = auth()->user();

    DB::table('progreso_videos')->updateOrInsert(
        [
            'usuario_id' => $usuario->id,
            'video_id' => $request->video_id
        ],
        [
            'segundo' => $request->segundo,
            'updated_at' => now(),
            'created_at' => now()
        ]
    );

    return response()->json([
        'success' => true
    ]);
}

public function obtenerTiempo($video_id)
{
    $usuario = auth()->user();

    $progreso = DB::table('progreso_videos')
        ->where('usuario_id', $usuario->id)
        ->where('video_id', $video_id)
        ->first();

    return response()->json([
        'segundo' => $progreso->segundo ?? 0
    ]);
}
}