<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeccionInicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SeccionInicioController extends Controller
{


    public function index()
    {

        $secciones = SeccionInicio::latest()
            ->paginate(10);


        return view(
            'admin.seccion_inicios.index',
            compact('secciones')
        );

    }



    public function create()
    {

        return view(
            'admin.seccion_inicios.create'
        );

    }



    public function store(Request $request)
    {


        $request->validate([

            'titulo'=>'required|max:255',

            'subtitulo'=>'required|max:255',

            'imagen'=>'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'texto_boton'=>'required|max:100',

            'descripcion0'=>'nullable',

            'descripcion1'=>'nullable',

            'descripcion2'=>'nullable',

            'descripcion3'=>'nullable',

        ]);



        $imagen = null;



        if($request->hasFile('imagen')){


            $imagen = $request->file('imagen')
                ->store('seccion_inicio','public');


        }



        SeccionInicio::create([


            'titulo'=>$request->titulo,

            'subtitulo'=>$request->subtitulo,

            'imagen'=>$imagen,

            'texto_boton'=>$request->texto_boton,

            'descripcion0'=>$request->descripcion0,

            'descripcion1'=>$request->descripcion1,

            'descripcion2'=>$request->descripcion2,

            'descripcion3'=>$request->descripcion3,


        ]);



        return redirect()
            ->route('admin.seccion_inicios.index')
            ->with(
                'success',
                'Sección creada correctamente'
            );

    }


public function edit($id)
{
    $seccion = SeccionInicio::findOrFail($id);

    return view('admin.seccion_inicios.edit', compact('seccion'));
}




    public function update(Request $request,$id)
    {


        $seccion = SeccionInicio::findOrFail($id);



        $request->validate([


            'titulo'=>'required|max:255',

            'subtitulo'=>'required|max:255',

            'imagen'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'texto_boton'=>'required|max:100',

            'descripcion0'=>'nullable',

            'descripcion1'=>'nullable',

            'descripcion2'=>'nullable',

            'descripcion3'=>'nullable',

        ]);




        $imagen = $seccion->imagen;



        if($request->hasFile('imagen')){


            if($imagen && Storage::disk('public')->exists($imagen)){


                Storage::disk('public')->delete($imagen);


            }



            $imagen = $request->file('imagen')
                ->store('seccion_inicio','public');

        }




        $seccion->update([


            'titulo'=>$request->titulo,

            'subtitulo'=>$request->subtitulo,

            'imagen'=>$imagen,

            'texto_boton'=>$request->texto_boton,

            'descripcion0'=>$request->descripcion0,

            'descripcion1'=>$request->descripcion1,

            'descripcion2'=>$request->descripcion2,

            'descripcion3'=>$request->descripcion3,


        ]);



        return redirect()
            ->route('admin.seccion_inicios.index')
            ->with(
                'success',
                'Sección actualizada correctamente'
            );


    }





    public function destroy($id)
    {


        $seccion = SeccionInicio::findOrFail($id);



        if($seccion->imagen &&
           Storage::disk('public')->exists($seccion->imagen)){


            Storage::disk('public')->delete($seccion->imagen);

        }



        $seccion->delete();



        return redirect()
            ->route('admin.seccion_inicios.index')
            ->with(
                'success',
                'Sección eliminada correctamente'
            );


    }


}