<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeccionEmpresa;
use App\Models\SeccionEmpresaImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SeccionEmpresaController extends Controller
{


    public function index()
{
    $secciones = SeccionEmpresa::with('imagenes')
        ->paginate(10);

    return view(
        'admin.secciones_empresas.index',
        compact('secciones')
    );
}




    public function create()
    {

        return view(
            'admin.secciones_empresas.create'
        );

    }





    public function store(Request $request)
    {


        $request->validate([


            'titulo' => 'required|max:255',


            'descripcion' => 'required',


            'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',


        ]);




        $seccion = SeccionEmpresa::create([


            'titulo' => $request->titulo,


            'descripcion' => $request->descripcion,


        ]);





        // GUARDAR MULTIPLES IMAGENES

        if($request->hasFile('imagenes')){


            foreach($request->file('imagenes') as $imagen){



                $ruta = $imagen->store(
                    'secciones_empresas',
                    'public'
                );



                SeccionEmpresaImagen::create([


                    'seccion_empresa_id' => $seccion->id,


                    'imagen' => $ruta,


                ]);



            }


        }




        return redirect()

            ->route('admin.secciones_empresas.index')

            ->with(
                'success',
                'Sección empresarial creada correctamente.'
            );

    }







    public function edit($id)
    {


        $seccion = SeccionEmpresa::with('imagenes')
            ->findOrFail($id);



        return view(
            'admin.secciones_empresas.edit',
            compact('seccion')
        );


    }







    public function update(Request $request,$id)
    {


        $seccion = SeccionEmpresa::findOrFail($id);




        $request->validate([


            'titulo' => 'required|max:255',


            'descripcion' => 'required',


            'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',


        ]);





        $seccion->update([


            'titulo' => $request->titulo,


            'descripcion' => $request->descripcion,


        ]);






        // AGREGAR NUEVAS IMAGENES

        if($request->hasFile('imagenes')){



            foreach($request->file('imagenes') as $imagen){



                $ruta = $imagen->store(
                    'secciones_empresas',
                    'public'
                );



                SeccionEmpresaImagen::create([


                    'seccion_empresa_id'=>$seccion->id,


                    'imagen'=>$ruta,


                ]);



            }


        }





        return redirect()

            ->route('admin.secciones_empresas.index')

            ->with(
                'success',
                'Sección empresarial actualizada correctamente.'
            );


    }








    public function destroy($id)
    {


        $seccion = SeccionEmpresa::with('imagenes')
            ->findOrFail($id);





        // ELIMINAR ARCHIVOS FISICOS

        foreach($seccion->imagenes as $imagen){


            if(Storage::disk('public')->exists($imagen->imagen)){


                Storage::disk('public')->delete(
                    $imagen->imagen
                );


            }


        }





        // BORRA IMAGENES RELACIONADAS

        $seccion->imagenes()->delete();





        // BORRA REGISTRO PRINCIPAL

        $seccion->delete();






        return redirect()

            ->route('admin.secciones_empresas.index')

            ->with(
                'success',
                'Sección empresarial eliminada correctamente.'
            );


    }


}