<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Inscripcion;
use App\Models\User; 
use App\Models\Certificado;
use App\Services\ProgresoService; 
use Illuminate\Support\Facades\Storage;

class CertificadoController extends Controller
{
  
    public function index()
{
    $certificados = Certificado::with(
        'inscripcion.curso',
        'inscripcion.usuario'
    )

    ->whereHas('inscripcion', function($query){

        $query->where(
            'usuario_id',
            auth()->id()
        );

    })

    ->get();

    return view(
        'estudiante.certificados',
        compact('certificados')
    );
}

   public function generar($id)
{
    $inscripcion = Inscripcion::with(
        'usuario',
        'curso'
    )->findOrFail($id);

    // 🔐 Validar que completó el curso
    if (!ProgresoService::cursoCompletado(
        auth()->id(),
        $inscripcion->curso_id
    )) {

        return back()->with(
            'error',
            'Debes completar todos los videos'
        );
    }

    // 👉 Buscar o crear certificado
    $certificado = Certificado::firstOrCreate(

        [
            'inscripcion_id' => $inscripcion->id
        ],

        [
            'codigo' =>
                'CERT-'.$inscripcion->id.'-'.date('Y')
        ]
    );

    // 👉 ASEGURAR CARPETA PUBLICA
    if (!Storage::disk('public')->exists(
        'certificados'
    )) {

        Storage::disk('public')->makeDirectory(
            'certificados'
        );
    }

    $ruta = $certificado->ruta;

    // 👉 SI NO EXISTE PDF
    if (
        !$ruta ||
        !Storage::disk('public')->exists($ruta)
    ) {

        $data = [

            // 👇 NOMBRE EDITABLE
            'nombre' => request('nombre')
                ? request('nombre')
                : $inscripcion->usuario->nombre,

            // 👇 CURSO EDITABLE
            'curso' => request('curso')
                ? request('curso')
                : $inscripcion->curso->titulo,

            'fecha' => now()->format('d/m/Y'),

            'codigo' => $certificado->codigo,
        ];

        // 👉 GENERAR PDF
        $pdf = Pdf::loadView(
            'estudiante.certificados.plantilla',
            $data
        )->setPaper('A4', 'landscape');

        // 👉 RUTA PDF
        $ruta =
            'certificados/' .
            $certificado->codigo .
            '.pdf';

        // 👉 GUARDAR PDF EN PUBLIC
        Storage::disk('public')->put(
            $ruta,
            $pdf->output()
        );

        // 👉 GUARDAR RUTA EN BD
        $certificado->ruta = $ruta;

        $certificado->save();
    }

    // 👉 OBTENER SOLO LOS CERTIFICADOS
    // 👉 DEL USUARIO LOGUEADO
    $certificados = Certificado::with(
        'inscripcion.curso',
        'inscripcion.usuario'
    )

    ->whereHas('inscripcion', function($query){

        $query->where(
            'usuario_id',
            auth()->id()
        );

    })

    ->get();

    // 👉 MOSTRAR VISTA
    return view(
        'estudiante.certificados',
        compact('certificados')
    );
}

}