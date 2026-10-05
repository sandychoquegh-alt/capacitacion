<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{

 protected $table = 'inscripciones';
    protected $fillable = [
        'curso_id',
        'usuario_id',
        'ci',
        'expedido',
        'nombres',
        'comprobante',
        'prefijo',
        'correo',
        'monto',
        'celular',
        'departamento',
        'cupon',
        'estado',
        'codigo_acceso',
        'evaluacion_completada'
    ];

    // 🧩 Relación: una inscripción pertenece a un curso
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    // 🧩 Relación: una inscripción puede pertenecer a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id' );
    }
    public function pagos()
{
    return $this->hasMany(Pago::class);
}


public function certificado()
{
    return $this->hasOne(
        Certificado::class,
        'inscripcion_id'
    );
}


}