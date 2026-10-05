<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeccionEmpresaImagen extends Model
{

    protected $table = 'secciones_empresas_imagenes';


    protected $fillable = [

        'seccion_empresa_id',
        'imagen',

    ];



    public function seccionEmpresa()
    {

        return $this->belongsTo(
            SeccionEmpresa::class,
            'seccion_empresa_id'
        );

    }

}