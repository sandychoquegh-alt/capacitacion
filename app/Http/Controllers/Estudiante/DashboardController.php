<?php

namespace App\Http\Controllers\Estudiante;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Inscripcion; // IMPORTANTE
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Curso;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DashboardController extends Controller
{


public function store(Request $request)
{
    $request->validate([
        'curso_id' => 'required|exists:cursos,id',
    ]);

    $usuario = Auth::user();

    // Verificar si ya está inscrito
    $inscripcion = Inscripcion::where('usuario_id', $usuario->id)
        ->where('curso_id', $request->curso_id)
        ->first();

    if ($inscripcion) {

        return response()->json([
            'success' => false,
            'message' => 'Ya existe una inscripción para este curso.',
            'inscripcion_id' => $inscripcion->id,
            'curso_id' => $inscripcion->curso_id,
        ]);

    }

    $curso = Curso::findOrFail($request->curso_id);

    $inscripcion = Inscripcion::create([
        'usuario_id' => $usuario->id,
        'curso_id'   => $curso->id,
    ]);

    return response()->json([
        'success'        => true,
        'inscripcion_id' => $inscripcion->id,
        'curso_id'       => $curso->id,
        'curso'          => $curso->titulo,
        'monto'          => $curso->precio,
        'imgqr'          => $curso->imgqr,
    ]);

    }

public function enviarComprobante(Request $request)
{
    $request->validate([
        'inscripcion_id' => 'required|exists:inscripciones,id',
        'comprobante' => 'required|image|max:2048',
    ]);

    $inscripcion = Inscripcion::findOrFail($request->inscripcion_id);

    $ruta = $request->file('comprobante')->store('comprobantes', 'public');

    $inscripcion->update([
        'comprobante' => $ruta,
        'estado' => 'pendiente',
    ]);

    return back()->with('success', 'Comprobante enviado correctamente.');
}
}