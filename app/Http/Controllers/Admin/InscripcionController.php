<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Inscripcion;
use App\Models\Usuario;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InscripcionController extends Controller
{
public function index()
{
    $inscripciones = Inscripcion::with(['usuario', 'curso'])
        ->whereHas('usuario', function ($query) {
            $query->whereNotNull('password');
        })
        ->get();

    return view('admin.inscripciones.index', compact('inscripciones'));
}

// ✅ aprobar
public function aprobar($id)
{
    try {

        $inscripcion = Inscripcion::findOrFail($id);


        $inscripcion->estado = 'aprobado';

        $inscripcion->save();


        return back()->with(
            'success',
            'Inscripción aprobada correctamente.'
        );


    } catch (\Exception $e) {

        return back()->with(
            'error',
            $e->getMessage()
        );

    }
}
// ❌ rechazar
public function rechazar($id)
{
    $inscripcion = Inscripcion::findOrFail($id);
    $inscripcion->estado = 'rechazado';
    $inscripcion->save();

    return back()->with('error', 'Inscripción rechazada');
}

}