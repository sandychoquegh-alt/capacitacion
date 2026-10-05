<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EstudianteMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ) {

        if (
            !auth()->check() ||

            auth()->user()->rol_id != 2
        ) {

            abort(403, 'Acceso no autorizado');

        }

        return $next($request);
    }
}