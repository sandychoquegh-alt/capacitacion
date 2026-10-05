<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Inscripcion; // IMPORTANTE
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Curso;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegisteredUsuarioController extends Controller
{
    /**
     * Mostrar vista principal
     */
    public function create()
    {
        
        return view('auth.register');
    }

    /**
     * Registro + inscripción
     */
 public function store(Request $request)
{
    $request->validate([
        'nombres' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'ci' => 'required|string|max:30',
        'telefono' => 'required|string|max:20',
        'metodo_pago' => 'required|in:qr,bancaria',
        'curso_id' => 'required',
    ]);

    // BUSCAR USUARIO
    $usuario = Usuario::where('email', $request->email)->first();

    if (!$usuario) {
        $usuario = Usuario::create([
            'nombre' => $request->nombres,
            'email' => $request->email,
            'password' => null,
            'rol_id' => 2,
            'telefono' => $request->telefono, // 🔥 CORREGIDO (antes tenías celular)
            'ci' => $request->ci,
            'apellido' => $request->apellido,
            'prefijo' => $request->prefijo,
            'estado' => 'activo',
        ]);
    }

    // VERIFICAR INSCRIPCIÓN
    $existe = Inscripcion::where('curso_id', $request->curso_id)
        ->where('usuario_id', $usuario->id)
        ->first();

    if ($existe) {
        return response()->json([
            'success' => false,
            'message' => 'Ya estás inscrito en este curso'
        ]);
    }

    // CREAR INSCRIPCIÓN
    $inscripcion = Inscripcion::create([
        'usuario_id' => $usuario->id,
        'curso_id' => $request->curso_id,
        'metodo_pago' => $request->metodo_pago,
        'estado' => 'pendiente',
    ]);

    // RESPUESTA JSON (PARA JS)
    return response()->json([
        'success' => true,
        'inscripcion_id' => $inscripcion->id,
        'curso_id' => $inscripcion->curso_id,
        'metodo_pago' => $request->metodo_pago,
    ]);
}

public function generarQR($id)
{
    try {

        // 🔍 Buscar inscripción
        $inscripcion = Inscripcion::find($id);

        if (!$inscripcion) {
            return response()->json([
                'success' => false,
                'error' => 'Inscripción no encontrada'
            ], 404);
        }

        // 🔍 Buscar curso
        $curso = Curso::find($inscripcion->curso_id);

        if (!$curso) {
            return response()->json([
                'success' => false,
                'error' => 'Curso no encontrado'
            ], 404);
        }

        // 📦 Datos del QR
        $data = json_encode([
            'curso' => $curso->titulo,
            'monto' => $curso->precio,
            'inscripcion' => $inscripcion->id
        ]);

        // 🟢 GENERAR QR (SVG seguro, sin imagick)
        $qr = QrCode::format('svg')
            ->size(250)
            ->errorCorrection('H')
            ->generate($data);

        return response()->json([
            'success' => true,
            'qr' => base64_encode($qr)
        ]);

    } catch (\Exception $e) {

        // 🧠 LOG REAL PARA DEBUG
        Log::error('Error QR:', [
            'message' => $e->getMessage()
        ]);

        return response()->json([
            'success' => false,
            'error' => 'Error al generar QR',
            'debug' => $e->getMessage()
        ], 500);
    }
}

public function info($id)
{
    try {

        $inscripcion = Inscripcion::find($id);

        if (!$inscripcion) {
            return response()->json([
                'success' => false,
                'message' => 'Inscripción no encontrada'
            ], 404);
        }

        $curso = Curso::find($inscripcion->curso_id);

        if (!$curso) {
            return response()->json([
                'success' => false,
                'message' => 'Curso no encontrado'
            ], 404);
        }

        // Enviar datos al modal
        return response()->json([

            'success' => true,

            'curso' => $curso->titulo,

            'monto' => $curso->precio,

            'inscripcion_id' => $inscripcion->id,

            'curso_id' => $curso->id,

            'imgqr' => $curso->imgqr

        ]);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
}

 // =========================
    

public function enviarComprobante(Request $request)
{
    $request->validate([
        'inscripcion_id' => 'required|exists:inscripciones,id',
        'comprobante' => 'required|image|max:2048',
    ]);

    $inscripcion = Inscripcion::findOrFail($request->inscripcion_id);

    $ruta = $request->file('comprobante')
                    ->store('comprobantes','public');

    $inscripcion->update([
        'comprobante' => $ruta,
        'estado' => 'pendiente',
    ]);

    return redirect()
        ->back()
        ->with('success','Comprobante enviado correctamente.');
}
}

