<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $table = 'modulos';

    // 🔐 Campos que se pueden guardar masivamente
    protected $fillable = [
        'curso_id',
        'titulo',
        'descripcion',
        'orden',
        'estado'
    ];

    // 🔄 Relación: un módulo pertenece a un curso
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    // 🎬 Relación: un módulo tiene muchos videos
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    // 🔥 Scope para módulos activos (opcional pero PRO)
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    // 🔢 Orden automático (opcional)
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($modulo) {
            if (is_null($modulo->orden)) {
                $modulo->orden = self::where('curso_id', $modulo->curso_id)->max('orden') + 1;
            }
        });
    }
}
