<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Curso;

class CursoController extends Controller
{
public function index()
{
    $cursos = Curso::all();
    return view('admin.cursos.index', compact('cursos'));
}
public function create()
{
    return view('admin.cursos.create');
}


public function store(Request $request)
{

    $request->validate([

        'titulo' => 'required',
        'descripcion' => 'required',
        'precio' => 'required|numeric',

        'estado' => 'required|in:activo,populares,destacados,recientes,emprendedor1,emprendedor2,emprendedor3,empresario1,empresario2,empresario3',

    ]);


    $data = $request->except(['imagen', 'imgqr']);


    // GUARDAR IMAGEN CURSO
    if ($request->hasFile('imagen')) {

        $data['imagen'] = $request
            ->file('imagen')
            ->store('cursos', 'public');

    }


    // GUARDAR IMAGEN QR
    if ($request->hasFile('imgqr')) {

        $data['imgqr'] = $request
            ->file('imgqr')
            ->store('qrs', 'public');

    }


    Curso::create($data);


    return redirect()
        ->route('admin.cursos.index')
        ->with('success', 'Curso creado correctamente');

}




public function show($id)
{
    $curso = Curso::findOrFail($id);

    return view('admin.cursos.show', compact('curso'));
}




public function edit($id)
{
    $curso = Curso::findOrFail($id);

    return view('admin.cursos.edit', compact('curso'));
}




public function update(Request $request, $id)
{

    $request->validate([

        'titulo' => 'required',
        'descripcion' => 'required',
        'precio' => 'required|numeric',

        'estado' => 'required|in:activo,populares,destacados,recientes,emprendedor1,emprendedor2,emprendedor3,empresario1,empresario2,empresario3',

    ]);


    $curso = Curso::findOrFail($id);


    $data = $request->except(['imagen', 'imgqr']);



    // ACTUALIZAR IMAGEN CURSO

    if ($request->hasFile('imagen')) {


        if ($curso->imagen) {

            Storage::disk('public')
                ->delete($curso->imagen);

        }


        $data['imagen'] = $request
            ->file('imagen')
            ->store('cursos','public');

    }




    // ACTUALIZAR IMAGEN QR

    if ($request->hasFile('imgqr')) {


        if ($curso->imgqr) {

            Storage::disk('public')
                ->delete($curso->imgqr);

        }


        $data['imgqr'] = $request
            ->file('imgqr')
            ->store('qrs','public');

    }



    $curso->update($data);


    return redirect()
        ->route('admin.cursos.index')
        ->with('success','Curso actualizado');

}




public function destroy($id)
{

    Curso::destroy($id);


    return redirect()
        ->route('admin.cursos.index')
        ->with('success','Curso eliminado');

}
   
}