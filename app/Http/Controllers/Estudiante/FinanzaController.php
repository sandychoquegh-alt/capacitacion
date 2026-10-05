<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Inscripcion;

class FinanzaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR CURSOS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $populares = Curso::where('estado', 'populares')
            ->orderBy('id')
            ->get();

        $inscripciones = Inscripcion::where('usuario_id', auth()->id())
            ->get()
            ->keyBy('curso_id');

        $cursosInscritos = $inscripciones->keys()->toArray();

        $populares = $populares->sortBy(function ($curso) use ($cursosInscritos) {
            return in_array($curso->id, $cursosInscritos) ? 1 : 0;
        });

        return view('estudiante.cursos.empresarios.finanzas', compact('populares', 'inscripciones'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREAR INSCRIPCIÓN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
        ]);

        $existe = Inscripcion::where('usuario_id', auth()->id())
            ->where('curso_id', $request->curso_id)
            ->first();

        if ($existe) {

            return response()->json([
                'success' => true,
                'inscripcion_id' => $existe->id,
                'curso_id' => $existe->curso_id,
                'monto' => optional($existe->curso)->precio
            ]);

        }

        $curso = Curso::findOrFail($request->curso_id);

        $inscripcion = Inscripcion::create([

            'usuario_id' => auth()->id(),

            'curso_id' => $curso->id,

            'estado' => 'preinscrito'

        ]);

        return response()->json([

            'success' => true,

            'inscripcion_id' => $inscripcion->id,

            'curso_id' => $curso->id,

            'monto' => $curso->precio

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SUBIR COMPROBANTE
    |--------------------------------------------------------------------------
    */

    public function enviarComprobante(Request $request)
    {
        $request->validate([

            'inscripcion_id' => 'required|exists:inscripciones,id',

            'comprobante' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120'

        ]);

        $inscripcion = Inscripcion::findOrFail(
            $request->inscripcion_id
        );

        $ruta = $request->file('comprobante')
            ->store('comprobantes', 'public');

        $inscripcion->update([

            'comprobante' => $ruta,

            'estado' => 'pendiente'

        ]);

        return back()->with(
            'success',
            'Comprobante enviado correctamente.'
        );
    }
}