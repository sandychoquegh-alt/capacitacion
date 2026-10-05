<?php

namespace App\Exports;

use App\Models\Inscripcion;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InscripcionesMesExport implements FromArray, WithHeadings
{
    protected $anio;

    public function __construct($anio)
    {
        $this->anio = $anio;
    }

    public function headings(): array
    {
        return [

            'Mes',

            'Cantidad de Inscripciones'

        ];
    }

    public function array(): array
    {
        $datos = [];

        $meses = [

            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'

        ];

        foreach ($meses as $numero => $nombre) {

            $cantidad = Inscripcion::whereYear(
                'created_at',
                $this->anio
            )
            ->whereMonth(
                'created_at',
                $numero
            )
            ->count();

            $datos[] = [

                $nombre,

                $cantidad

            ];
        }

        return $datos;
    }
}