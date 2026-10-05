<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Curso;
use App\Models\Inscripcion;
use App\Models\Certificado;

class UsuarioController extends Controller
{



public function index(Request $request)
{
    $buscar = $request->buscar;


   $usuarios = Usuario::query()

    ->where('rol_id', 2)

    ->when($buscar, function ($query) use ($buscar) {

        $query->where(function ($q) use ($buscar) {

            $q->where('nombre', 'LIKE', "%{$buscar}%")
              ->orWhere('email', 'LIKE', "%{$buscar}%");

        });

    })

    ->orderByDesc('id')

    ->paginate(10)

    ->withQueryString();


$totalUsuarios = Usuario::where('rol_id', 2)->count();


    $totalCursos = Curso::count();

    $totalInscripciones = Inscripcion::count();

    $totalCertificados = Certificado::count();



    return view('admin.usuarios.index', compact(

        'usuarios',
        'buscar',
        'totalUsuarios',
        'totalCursos',
        'totalInscripciones',
        'totalCertificados'

    ));
}
public function destroy($id)
{

    $usuario = Usuario::findOrFail($id);


    $usuario->delete();


    return back()->with(
        'success',
        'Usuario eliminado correctamente'
    );

}
}