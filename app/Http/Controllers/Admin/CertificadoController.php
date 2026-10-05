<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Certificado;
use App\Models\Usuario;


class CertificadoController extends Controller
{


  public function index(Request $request)
{
$buscar = $request->input('buscar');

$certificados = Certificado::with([
    'inscripcion.usuario',
    'inscripcion.curso'
])
->when($buscar, function ($query) use ($buscar) {
    $query->whereHas('inscripcion.usuario', function ($usuario) use ($buscar) {
        $usuario->where('nombre', 'LIKE', "%{$buscar}%")
                ->orWhere('apellido', 'LIKE', "%{$buscar}%")
                ->orWhere('email', 'LIKE', "%{$buscar}%");
    })
    ->orWhereHas('inscripcion.curso', function ($curso) use ($buscar) {
        $curso->where('titulo', 'LIKE', "%{$buscar}%");
    });
})
->orderBy('id', 'desc')
->paginate(10)
->withQueryString();

return view('admin.certificados.index', compact(
    'certificados',
    'buscar'
));

}


    public function create()
    {
        return view('admin.certificados.create');
    }


}




