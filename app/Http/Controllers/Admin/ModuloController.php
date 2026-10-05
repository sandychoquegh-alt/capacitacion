<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modulo;
use App\Models\Curso;

class ModuloController extends Controller
{
    // 📚 LISTAR
    public function index($curso_id)
    {
        $curso = Curso::with(['modulos' => function($q){
            $q->orderBy('orden');
        }])->findOrFail($curso_id);

        return view('admin.modulos.index', compact('curso'));
    }

    // 👉 FORM CREAR
public function create($curso_id)
{
    $curso = Curso::findOrFail($curso_id);
    return view('admin.modulos.create', compact('curso'));
}

    // 💾 CREAR
    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'titulo' => 'required|string|max:255',
        ]);

        // 🔥 Orden automático
        $orden = Modulo::where('curso_id', $request->curso_id)->max('orden') + 1;

       $modulo = Modulo::create([
    'curso_id' => $request->curso_id,
    'titulo' => $request->titulo,
    'orden' => $orden
]);

        return redirect()->route('admin.modulos.index', $modulo->curso_id)
        ->with('success', 'Módulo actualizado');
    }

     // 👉 FORM EDITAR
public function edit($id)
{
    $modulo = Modulo::findOrFail($id);
    return view('admin.modulos.edit', compact('modulo'));
}


    // ✏️ ACTUALIZAR
    public function update(Request $request, $id)
    {
        $modulo = Modulo::findOrFail($id);

        $request->validate([
            'titulo' => 'required|string|max:255',
        ]);

        $modulo->update([
            'titulo' => $request->titulo
        ]);

        return redirect()->route('admin.modulos.index', $modulo->curso_id)
        ->with('success', 'Módulo actualizado');
    }

    // ❌ ELIMINAR
    // 👉 ELIMINAR
public function destroy($id)
{
    $modulo = Modulo::findOrFail($id);
    $curso_id = $modulo->curso_id;

    $modulo->delete();

    return redirect()->route('admin.modulos.index', $curso_id)
        ->with('success', 'Módulo eliminado');
}
}