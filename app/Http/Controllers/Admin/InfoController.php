<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{

    public function index()
{
    $infors = Info::latest()->paginate(10);

    return view('admin.infors.index', compact('infors'));
}

    public function create()
    {
        return view('admin.infors.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|max:255',
        'descripcion' => 'required',
    ]);

    Info::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
    ]);

    return redirect()
        ->route('admin.infors.index')
        ->with('success', 'Información registrada correctamente.');
}

    public function edit($id)
    {

        $info = Info::findOrFail($id);

        return view(
            'admin.infors.edit',
            compact('info')
        );

    }




    public function update(Request $request, $id)
    {

        $info = Info::findOrFail($id);


        $request->validate([

            'titulo'      => 'required|max:255',

            'descripcion' => 'required',

        ]);


        $info->update([

            'titulo'      => $request->titulo,

            'descripcion' => $request->descripcion,

        ]);


        return redirect()
            ->route('admin.infors.index')
            ->with(
                'success',
                'Información actualizada correctamente.'
            );

    }




    public function destroy($id)
    {

        $info = Info::findOrFail($id);

        $info->delete();


        return redirect()
            ->route('admin.infors.index')
            ->with(
                'success',
                'Información eliminada correctamente.'
            );

    }

}