<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

 class UsuarioNuevoController extends Controller
{
public function usuariosNuevos()
{
    $usuarios = Usuario::whereNull('password')
        ->where('rol_id', 2)
        ->get();


    return view(
        'admin.usuarios.nuevos',
        compact('usuarios')
    );
}

public function aprobarUsuario($id)
{
    try {

        $usuario = Usuario::findOrFail($id);


        // generar contraseña temporal
        $codigo = strtoupper(Str::random(10));


        // crear contraseña
        $usuario->password = Hash::make($codigo);

        $usuario->save();



        // enviar correo

        Mail::raw(

            "Tu cuenta fue aprobada.\n\n"
            ."Tu contraseña temporal es: {$codigo}\n\n"
            ."Puedes ingresar aquí:\n"
            ."http://127.0.0.1:8000/login",

            function ($message) use ($usuario) {

                $message->to($usuario->email)
                    ->subject('Acceso al sistema');

            }
        );


        return back()->with(
            'success',
            'Usuario aprobado correctamente.'
        );


    } catch (\Exception $e) {


        return back()->with(
            'error',
            $e->getMessage()
        );

    }
}

public function rechazarUsuario($id)
{
    try {

        $usuario = Usuario::findOrFail($id);


        $usuario->delete();


        return back()->with(
            'success',
            'Usuario rechazado correctamente.'
        );


    } catch (\Exception $e) {


        return back()->with(
            'error',
            $e->getMessage()
        );

    }
}
}