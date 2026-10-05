<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresoModulo extends Model
{
    use HasFactory;

    protected $table = 'progreso_modulos';

    protected $fillable = [

        'usuario_id',
        'modulo_id',
        'completado',
        'fecha_completado'
       
    ];

    protected $casts = [

        'completado' => 'boolean',
        'fecha_completado' => 'datetime'

    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN USUARIO
    |--------------------------------------------------------------------------
    */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN MÓDULO
    |--------------------------------------------------------------------------
    */
    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }
}




