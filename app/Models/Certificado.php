<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Curso;

class Certificado extends Model
{
    protected $table = 'certificados';

    protected $fillable = [
        'inscripcion_id',
        'curso_id',
        'codigo',
        'ruta',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

   
 public function inscripcion()
    {
        return $this->belongsTo(
            Inscripcion::class,
            'inscripcion_id'
        );
    }

}