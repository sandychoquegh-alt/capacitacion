<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgresoVideo;
use App\Models\ProgresoModulo;
use App\Models\Inscripcion;
use App\Models\Certificado;
use App\Services\ProgresoService;
use App\Models\Curso;
use App\Models\Video;
use App\Models\Pago;
use App\Models\User; // ✅ correcto
use Barryvdh\DomPDF\Facade\Pdf;

class CursoController extends Controller
{
    
public function index()
{
    $cursos = Curso::orderBy('id', 'asc')->get();

    $inscripciones = Inscripcion::where('usuario_id', auth()->id())->get();

    // 🔥 IDs de cursos donde el usuario YA está inscrito
    $cursosInscritosIds = $inscripciones->pluck('curso_id')->toArray();

    // 🔥 Ordenar: primero NO inscritos
    $cursos = $cursos->sortBy(function ($curso) use ($cursosInscritosIds) {
        return in_array($curso->id, $cursosInscritosIds) ? 1 : 0;
    });
   //estudiante.cursos   welcome
    return view('welcome', compact('cursos', 'inscripciones'));
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





public function subirComprobante(Request $request, $id)
{
    $request->validate([
        'comprobante' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
    ]);

    $inscripcion = Inscripcion::where('id', $id)
        ->where('usuario_id', auth()->id())
        ->firstOrFail();

    $ruta = $request->file('comprobante')->store('comprobantes', 'public');

    // 🔥 GUARDAR EN PAGOS
    Pago::create([
        'inscripcion_id' => $inscripcion->id,
        'comprobante' => $ruta,
    ]);

    // 🔥 actualizar estado
    $inscripcion->update([
        'estado' => 'pendiente'
    ]);

    return redirect()->route('estudiante.cursos')
        ->with('success', 'Comprobante enviado');
}
public function inscripcionWhatsapp(Request $request)
{
   
        $userId = auth()->id();

Inscripcion::updateOrCreate(
    [
        'usuario_id' => $userId,
        'curso_id' => $request->curso_id
    ],
    [
        'estado' => 'pendiente'
    ]
);

return response()->json([
    'success' => true,
    'message' => 'Inscripción registrada correctamente'
]);
    
}

public function estado($cursoId)
{
    $inscripcion = Inscripcion::where('usuario_id', auth()->id())
        ->where('curso_id', $cursoId)
        ->first();

    return response()->json([
        'estado' => $inscripcion->estado ?? null
    ]);
}



public function verVideos($curso_id)
{
    // 🔐 Validar que el usuario está inscrito en el curso
    $inscripcion = Inscripcion::where('usuario_id', auth()->id())
        ->where('curso_id', $curso_id)
        ->where('estado', 'aprobado')
        ->first();

    if (!$inscripcion) {
        abort(403, 'No tienes acceso a este curso');
    }

    // 📚 Traer curso con módulos y videos
    $curso = Curso::with(['modulos.videos'])->findOrFail($curso_id);

    // 🔹 Determinar video inicial para reproducir (primer video del primer módulo)
    $videoActual = null;
    foreach ($curso->modulos as $modulo) {
        if ($modulo->videos->count() > 0) {
            $videoActual = $modulo->videos->first();
            break;
        }
    }

    // 🔹 Para esta etapa, no calculamos progreso aún
    $progreso = 0;
  $modulos = $curso->modulos;
return view('estudiante.videos', compact('curso', 'modulos', 'videoActual', 'progreso','inscripcion'));
    
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



public function cursosDisponibles()
{
    // Obtener todos los cursos
    $cursos = Curso::all();

    // Obtener inscripciones del usuario logueado
    $inscripciones = auth()->user()->inscripciones; // Collection de Inscripcion

    // Para un manejo más limpio, convertir a array de IDs solo si lo necesitas
     $inscripcionesIds = $inscripciones->pluck('curso_id')->toArray();

    return view('estudiante.cursos', compact('cursos', 'inscripciones'));
}


public function marcarPendiente(Request $request)
{
    $inscripcion = Inscripcion::where('curso_id', $request->curso_id)
        ->where('usuario_id', auth()->id())
        ->first();

    if($inscripcion && $inscripcion->estado == 'preinscrito'){
        $inscripcion->update([
            'estado' => 'pendiente'
        ]);
    }

    return response()->json(['ok' => true]);
}

public function guardar(Request $request)
{
    // 👉 Guardar progreso
    ProgresoVideo::firstOrCreate([
        'usuario_id' => auth()->id(),
        'video_id' => $request->video_id
    ]);

    // 👉 Obtener inscripción
    $inscripcion = Inscripcion::where('usuario_id', auth()->id())
        ->where('curso_id', $request->curso_id)
        ->first();

    if (!$inscripcion) {
        return response()->json(['error' => 'Inscripción no encontrada'], 404);
    }

    // 👉 Verificar curso completado
    if (ProgresoService::cursoCompletado(auth()->id(), $inscripcion->curso_id)) {

        // marcar completado
        if (!$inscripcion->completado) {
            $inscripcion->completado = true;
            $inscripcion->save();
        }

        // 👉 SOLO crear registro (NO generar PDF aquí)
        Certificado::firstOrCreate([
            'inscripcion_id' => $inscripcion->id
        ], [
            'codigo' => 'CERT-'.$inscripcion->id.'-'.date('Y')
        ]);
    }

    return response()->download(
    storage_path('app/'.$ruta),
    'Certificado-'.$inscripcion->curso->titulo.'.pdf'
);
}




public function guardarProgresoModulo(Request $request)
{

    try {

        \App\Models\ProgresoModulo::updateOrCreate(

            [

                'usuario_id' => auth()->id(),

                'modulo_id' => $request->modulo_id

            ],

            [

                'completado' => true,

                'fecha_completado' => now()

            ]

        );

        return response()->json([

            'success' => true

        ]);

    } catch (\Exception $e) {

        return response()->json([

            'error' => $e->getMessage()

        ], 500);

    }

}



public function completarEvaluacion($id)
{
    $inscripcion = Inscripcion::findOrFail($id);

    // MARCAR COMO COMPLETADO
    $inscripcion->evaluacion_completada = 1;

    $inscripcion->save();

    return back()->with(
        'success',
        'Evaluación completada correctamente'
    );
}
}

