<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable 
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'apellido',
        'password',
        'rol_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function cursos()
{
    return $this->belongsToMany(Curso::class);
}
public function progresos()
{
    return $this->hasMany(ProgresoVideo::class);
}
public function inscripciones()
{
    return $this->hasMany(Inscripcion::class, 'usuario_id');
}
}