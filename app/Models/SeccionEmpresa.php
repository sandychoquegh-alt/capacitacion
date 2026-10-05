<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeccionEmpresa extends Model
{

    protected $table = 'secciones_empresas';


    protected $fillable = [

        'titulo',
        'descripcion',

    ];



    public function imagenes()
    {

        return $this->hasMany(
            SeccionEmpresaImagen::class,
            'seccion_empresa_id'
        );

    }

}