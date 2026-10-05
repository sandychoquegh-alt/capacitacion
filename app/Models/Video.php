<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos'; // opcional pero recomendado

    protected $fillable = [
        'modulo_id',
        'titulo',
        'descripcion',
        'url',
        'orden',
        'youtube_id'
        
    ];

    // 🔗 RELACIÓN
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }



public function modulo()
{
    return $this->belongsTo(Modulo::class);
}
public function progresos()
{
    return $this->hasMany(ProgresoVideo::class);
}

   
}