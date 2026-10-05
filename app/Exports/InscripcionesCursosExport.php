<?php

namespace App\Exports;

use App\Models\Inscripcion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InscripcionesCursosExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return Inscripcion::selectRaw('
                MONTH(inscripciones.created_at) as mes_numero,
                MONTHNAME(inscripciones.created_at) as mes,
                YEAR(inscripciones.created_at) as anio,
                cursos.titulo as curso,
                COUNT(inscripciones.id) as total_inscripciones
            ')
            ->join('cursos', 'inscripciones.curso_id', '=', 'cursos.id')
            ->groupBy(
                'mes_numero',
                'mes',
                'anio',
                'cursos.titulo'
            )
            ->orderBy('anio', 'desc')
            ->orderBy('mes_numero', 'asc')
            ->get()
            ->map(function ($inscripcion) {
                return [
                    'mes' => $inscripcion->mes,
                    'anio' => $inscripcion->anio,
                    'curso' => $inscripcion->curso,
                    'total_inscripciones' => $inscripcion->total_inscripciones,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Mes de inscripción',
            'Año',
            'Curso',
            'Cantidad de inscripciones',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => [
                        'rgb' => 'FFFFFF',
                    ],
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => [
                        'rgb' => '2563EB',
                    ],
                ],
            ],
        ];
    }
}
