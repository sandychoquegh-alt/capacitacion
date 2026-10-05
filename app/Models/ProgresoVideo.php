<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresoVideo extends Model
{
    use HasFactory;

    protected $table = 'progreso_videos';

    protected $fillable = [
        'usuario_id',
        'video_id',
        'visto',       // 1 = visto, 0 = no visto
        'progreso', 
        'segundo',   // porcentaje (0 - 100)
    ];

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Relación con Video
    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}