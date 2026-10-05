<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Curso;
use App\Models\Inscripcion;
use App\Models\Certificado;
use Illuminate\Support\Facades\DB;
use App\Exports\InscripcionesCursosExport;
 use App\Exports\InscripcionesMesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::where('rol_id', 2)->count();
        $cursos = Curso::count();
        $inscripciones = Inscripcion::count();
        $certificados = Certificado::count();

      

        $datos = Inscripcion::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
    ->groupBy('mes')
    ->orderBy('mes')
    ->pluck('total', 'mes');

$inscripcionesPorMes = [];

for ($i = 1; $i <= 12; $i++) {

    $inscripcionesPorMes[] = $datos[$i] ?? 0;

}
         // Cursos más inscritos
    $cursosPopulares = Inscripcion::select(
            'curso_id',
            \DB::raw('count(*) as total')
        )
        ->groupBy('curso_id')
        ->orderByDesc('total')
        ->with('curso')
        ->get();



    $nombresCursos = $cursosPopulares
        ->pluck('curso.titulo');


    $cantidadCursos = $cursosPopulares
        ->pluck('total');

        return view('admin.dashboard', compact(
            'usuarios',
            'cursos',
            'inscripciones',
            'certificados',
            'inscripcionesPorMes',
           
            'nombresCursos',
        'cantidadCursos'
        ));
    }


   

public function exportarExcel(Request $request)
{
    return Excel::download(

        new InscripcionesMesExport(
            $request->anio
        ),

        'Inscripciones_'.$request->anio.'.xlsx'

    );
}

public function exportarInscripcionesCursos()
{
return Excel::download(
new InscripcionesCursosExport(),
'inscripciones_por_curso_y_mes.xlsx'
);
}

}