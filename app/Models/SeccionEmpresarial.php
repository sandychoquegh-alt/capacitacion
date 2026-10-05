<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionEmpresarial extends Model
{
    use HasFactory;

    protected $table = 'secciones_empresariales';

    protected $fillable = [

        'titulo',

        'descripcion',

        'imagen',

        'texto_boton',

    ];
}