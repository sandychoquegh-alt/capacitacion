<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InscripcionController extends Controller
{
    /**
     * APROBAR INSCRIPCIÓN
     * - Cambia estado
     * - Genera código de acceso
     * - Envía correo al usuario
     */
    
        // =========================
    // APROBAR INSCRIPCIÓN (ADMIN)
    // =========================
    public function aprobar($id)
    {
        try {

            $inscripcion = Inscripcion::findOrFail($id);

            

            // generar código único
            $codigo = strtoupper(Str::random(10));
            // cambiar estado
            $inscripcion->estado = 'aprobado';

            $inscripcion->codigo_acceso = $codigo;
            $inscripcion->save();

            // obtener usuario
            $usuario = Usuario::findOrFail($inscripcion->usuario_id);
//dd($inscripcion);
            // enviar correo
           Mail::raw(
    "Tu inscripción fue aprobada.\n\nCódigo de acceso: $codigo\n\nIngresa aquí: http://127.0.0.1:8000/login",
    function ($message) use ($inscripcion) {
        $message->to($inscripcion->correo)
                ->subject('Acceso al sistema');
    }
);

            return response()->json([
                'success' => true,
                'message' => 'Aprobado y correo enviado'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}