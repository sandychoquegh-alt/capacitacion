<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\ProgresoModulo;

class ProgresoModuloController extends Controller
{

    // ========================================
    // GUARDAR PROGRESO
    // ========================================

    public function guardar(Request $request)
    {

        $request->validate([

            'modulo_id' => 'required'

        ]);

        // EVITAR DUPLICADOS
        $existe = ProgresoModulo::where(

            'usuario_id',
            auth()->id()

        )

        ->where(

            'modulo_id',
            $request->modulo_id

        )

        ->first();

        // SI YA EXISTE
        if($existe){

            return response()->json([

                'success' => true,
                'mensaje' => 'Ya existe'

            ]);

        }

        // GUARDAR
        $guardar = ProgresoModulo::create([

            'usuario_id' => auth()->id(),

            'modulo_id' => $request->modulo_id,

            'completado' => 1

        ]);

        return response()->json([

            'success' => true,
            'data' => $guardar

        ]);

    }

}