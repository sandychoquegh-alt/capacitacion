<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeccionEmpresarial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeccionEmpresarialController extends Controller
{

    public function index()
    {

        $seccionesEmpresariales = SeccionEmpresarial::latest()
            ->paginate(10);

        return view(
            'admin.secciones_empresariales.index',
            compact('seccionesEmpresariales')
        );

    }



    public function create()
    {

        return view(
            'admin.secciones_empresariales.create'
        );

    }



    public function store(Request $request)
    {

        $request->validate([
            'titulo'       => 'required|max:255',
            'descripcion'  => 'required',
            'texto_boton' => 'required',
            'imagen'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);


        $imagen = null;


        if($request->hasFile('imagen')){

            $imagen = $request->file('imagen')
                ->store('secciones_empresariales','public');

        }


        SeccionEmpresarial::create([

            'titulo'       => $request->titulo,

            'descripcion'  => $request->descripcion,

            'texto_boton'  => $request->texto_boton,

            'imagen'       => $imagen,

        ]);


        return redirect()
            ->route('admin.secciones_empresariales.index')
            ->with(
                'success',
                'Información creada correctamente.'
            );

    }




    public function edit($id)
    {

        $seccion = SeccionEmpresarial::findOrFail($id);

        return view(
            'admin.secciones_empresariales.edit',
            compact('seccion')
        );

    }




    public function update(Request $request, $id)
    {

        $seccion = SeccionEmpresarial::findOrFail($id);


        $request->validate([

            'titulo'       => 'required|max:255',

            'descripcion'  => 'required',

            'texto_boton' => 'required',

            'imagen'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);


        $imagen = $seccion->imagen;


        if($request->hasFile('imagen')){

            if($imagen && Storage::disk('public')->exists($imagen)){

                Storage::disk('public')->delete($imagen);

            }

            $imagen = $request->file('imagen')
                ->store('secciones_empresariales','public');

        }


        $seccion->update([

            'titulo'       => $request->titulo,

            'descripcion'  => $request->descripcion,

            'texto_boton'  => $request->texto_boton,

            'imagen'       => $imagen,

        ]);


        return redirect()
            ->route('admin.secciones_empresariales.index')
            ->with(
                'success',
                'Información actualizada correctamente.'
            );

    }




    public function destroy($id)
    {

        $seccion = SeccionEmpresarial::findOrFail($id);


        if(
            $seccion->imagen &&
            Storage::disk('public')->exists($seccion->imagen)
        ){

            Storage::disk('public')->delete($seccion->imagen);

        }


        $seccion->delete();


        return redirect()
            ->route('admin.secciones_empresariales.index')
            ->with(
                'success',
                'Información eliminada correctamente.'
            );

    }

}