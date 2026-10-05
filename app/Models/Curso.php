<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'imgqr',
        'precio',
        'estado'
    ];

    public function videos()
{
    return $this->hasMany(Video::class);
}

public function usuario()
{
    return $this->belongsToMany(Usuario::class);
}

 public function inscripcion()
    {
        return $this->hasMany(Inscripcion::class, 'curso_id');
    }

    // Curso.php
public function modulos()
{
    return $this->hasMany(Modulo::class);
}


}