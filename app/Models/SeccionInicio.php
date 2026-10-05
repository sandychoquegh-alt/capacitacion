<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeccionInicio extends Model
{
    protected $table = 'seccion_inicios';

    protected $fillable = [
        'titulo',
        'subtitulo',
        'imagen',
        'texto_boton',
        'descripcion0',
        'descripcion1',
    ];
}