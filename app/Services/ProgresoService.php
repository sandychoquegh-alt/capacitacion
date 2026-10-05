<?php
namespace App\Services;

use App\Models\Video;
use App\Models\ProgresoVideo;

class ProgresoService
{
    public static function progresoCurso($userId, $cursoId)
    {
        $total = Video::where('curso_id', $cursoId)->count();

        $vistos = ProgresoVideo::where('usuario_id', $userId)
            ->whereIn('video_id', function ($q) use ($cursoId) {
                $q->select('id')->from('videos')->where('curso_id', $cursoId);
            })->count();

        return [
            'total' => $total,
            'vistos' => $vistos,
            'porcentaje' => $total > 0 ? round(($vistos / $total) * 100) : 0
        ];
    }

    public static function cursoCompletado($userId, $cursoId)
    {
        $data = self::progresoCurso($userId, $cursoId);

        return $data['vistos'] === $data['total'];
    }
}