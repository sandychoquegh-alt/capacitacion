<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgresoVideo;
use App\Models\Inscripcion;
use App\Models\Certificado;
use App\Services\ProgresoService;
use App\Models\Curso;
use App\Models\Video;
use App\Models\Pago;
use App\Models\User; // ✅ correcto
use Barryvdh\DomPDF\Facade\Pdf;

class CursosController extends Controller
{
    
public function index()
{
    $activo = Curso::where('estado', 'activo')
                   ->orderBy('id', 'asc')
                   ->get();

    $inscripciones = Inscripcion::where('usuario_id', auth()->id())->get();

    // 🔥 IDs de cursos donde el usuario YA está inscrito
    $cursosInscritosIds = $inscripciones->pluck('curso_id')->toArray();

    // 🔥 Ordenar: primero NO inscritos
    $activo = $activo->sortBy(function ($curso) use ($cursosInscritosIds) {
        return in_array($curso->id, $cursosInscritosIds) ? 1 : 0;
    });
   //estudiante.cursos   welcome
    return view('estudiante.cursos ', compact('activo', 'inscripciones'));
}

public function store(Request $request)
    {

        // VALIDAR
        $request->validate([

            'inscripcion_id' => 'required|exists:inscripcions,id',

            'comprobante' => 
                'required|image|mimes:jpg,jpeg,png,webp|max:5120'

        ]);

        // BUSCAR
        $inscripcion = Inscripcion::findOrFail(
            $request->inscripcion_id
        );

        // GUARDAR IMAGEN
        $ruta = $request
            ->file('comprobante')
            ->store('comprobantes', 'public');

        // ACTUALIZAR
        $inscripcion->comprobante = $ruta;

        $inscripcion->estado_pago = 'pendiente';

        $inscripcion->save();

        // RESPUESTA
        return response()->json([

            'success' => true,

            'message' =>
                'Comprobante enviado correctamente'

        ]);

    }
}