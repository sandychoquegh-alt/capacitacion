<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{  
    protected $table = 'pagos';
    // 🔥 Campos que se pueden llenar masivamente
    protected $fillable = [
        'inscripcion_id',
        'comprobante',
    ];

    // 🔥 Relación: un pago pertenece a una inscripción
    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }

    // 🔥 ACCESO RÁPIDO (OPCIONAL PERO PRO 💯)

    // 👉 Obtener curso directamente
    public function curso()
    {
        return $this->hasOneThrough(
            Curso::class,
            Inscripcion::class,
            'id',          // FK en inscripciones
            'id',          // FK en cursos
            'inscripcion_id', // FK en pagos
            'curso_id'     // FK en inscripciones
        );
    }

    // 👉 Obtener usuario directamente
    public function usuario()
    {
        return $this->hasOneThrough(
            User::class,
            Inscripcion::class,
            'id',
            'id',
            'inscripcion_id',
            'usuario_id'
        );
    }
}