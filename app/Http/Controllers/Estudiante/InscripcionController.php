<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Inscripcion;

class InscripcionController extends Controller
{

    // ========================================
    // ENVIAR COMPROBANTE no tocar este controlador
    // ========================================

    public function enviarComprobante(Request $request)
    {

        // VALIDAR
        $request->validate([

            'curso_id' => 'required',


            'comprobante' =>
    'required|image|mimes:jpg,jpeg,png|max:5120'

        ]);

        // VERIFICAR SI YA EXISTE
        $existe = Inscripcion::where(
            'usuario_id',
            auth()->id()
        )
        ->where(
            'curso_id',
            $request->curso_id
        )
        ->first();

        if($existe){

            return response()->json([

                'success' => false,

                'message' =>
                    'Ya estás inscrito en este curso'

            ]);

        }

        // SUBIR IMAGEN
        $ruta = $request
            ->file('comprobante')
            ->store('comprobantes', 'public');

        // CREAR INSCRIPCIÓN
        $inscripcion = Inscripcion::create([

            'usuario_id' => auth()->id(),

            'curso_id' => $request->curso_id,

            

            'comprobante' => $ruta,

            'estado' => 'pendiente',

            'activo' => 0

        ]);

        return response()->json([

            'success' => true,

            'inscripcion_id' =>
                $inscripcion->id

        ]);

    }

}