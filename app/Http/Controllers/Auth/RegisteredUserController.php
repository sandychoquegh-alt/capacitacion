<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Usuario;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | MOSTRAR FORMULARIO
    |--------------------------------------------------------------------------
    */
    public function create()
    {

        return view('auth.register');

    }

    /*
    |--------------------------------------------------------------------------
    | REGISTRAR USUARIO
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {

        $request->validate([
    'nombre' => ['required', 'string', 'max:255'],
    'apellido' => ['required', 'string', 'max:255'],
    'email' => ['required', 'email', 'unique:usuarios,email'],
    'password' => ['required', 'min:6', 'confirmed'],
]);

        // CREAR USUARIO
        $usuario = Usuario::create([

            'nombre' => $request->nombre,
            'apellido' => $request->apellido,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'rol_id' => 2,

            'estado' => 'activo'

        ]);

        // LOGIN AUTOMÁTICO
        Auth::login($usuario);

        // REDIRECCIÓN
        return redirect()->route('dashboard');

    }

}