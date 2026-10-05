<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Curso;
use App\Models\Modulo;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    // 📋 LISTAR VIDEOS
    public function index($modulo_id)
{
    $modulo = \App\Models\Modulo::findOrFail($modulo_id);

    $videos = $modulo->videos()->orderBy('orden')->get();

    return view('admin.videos.index', compact('modulo', 'videos'));
}
 

    // ➕ FORM CREAR


    // 💾 GUARDAR
public function store(Request $request, $modulo_id)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'youtube_url' => 'required|url'
    ]);

    // 🔥 VALIDAR QUE EL MÓDULO EXISTE
    $modulo = \App\Models\Modulo::findOrFail($modulo_id);

    // 🔥 EXTRAER ID DE YOUTUBE
    $youtube_id = $this->extraerYoutubeId($request->youtube_url);

    if (!$youtube_id) {
        return back()->with('error', 'Link de YouTube inválido');
    }

    // 🔥 ORDEN AUTOMÁTICO (USAR EL MODULO_ID CORRECTO)
    $ultimoOrden = \App\Models\Video::where('modulo_id', $modulo_id)->max('orden');

    \App\Models\Video::create([
        'modulo_id' => $modulo_id, // ✅ SIEMPRE DESDE LA URL
        'titulo' => $request->titulo,
        'youtube_id' => $youtube_id,
        'orden' => ($ultimoOrden ?? 0) + 1
    ]);

    return redirect()
        ->route('admin.videos.index', $modulo_id) // ✅ NO request
        ->with('success', 'Video agregado correctamente');
}

public function create($modulo_id)
{
    $modulo = Modulo::findOrFail($modulo_id);
    return view('admin.videos.create', compact('modulo'));
}

public function ordenar(Request $request)
{
    foreach ($request->orden as $item) {
        Video::where('id', $item['id'])
            ->update(['orden' => $item['orden']]);
    }

    return response()->json(['success' => true]);
}

    // ✏️ EDITAR
    public function edit($id)
    {
        $video = Video::findOrFail($id);

        return view('admin.videos.edit', compact('video'));
    }

    // 🔄 ACTUALIZAR
   public function update(Request $request, $id)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'youtube_url' => 'required|url'
    ]);

    $video = \App\Models\Video::findOrFail($id);

    $youtube_id = $this->extraerYoutubeId($request->youtube_url);

    if (!$youtube_id) {
        return back()->with('error', 'Link inválido');
    }

    $video->update([
        'titulo' => $request->titulo,
        'youtube_id' => $youtube_id
    ]);

    return back()->with('success', 'Video actualizado correctamente');
}

    // ❌ ELIMINAR
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $curso_id = $video->curso_id;

        $video->delete();

        return redirect()
            ->route('admin.videos.index', $modulo_id)
            ->with('success', 'Video eliminado');
    }

     // 🎬 OBTENER ID DE YOUTUBE
    public function getYoutubeIdAttribute()
    {
        if (!$this->url) return null;

        parse_str(parse_url($this->url, PHP_URL_QUERY), $params);

        return $params['v'] ?? null;
    }

    // 🎥 URL EMBED AUTOMÁTICA
    public function getEmbedUrlAttribute()
    {
        return $this->youtube_id 
            ? "https://www.youtube.com/embed/" . $this->youtube_id
            : null;
    }

    private function extraerYoutubeId($url)
{
    preg_match('/(youtu\.be\/|v=)([^&]+)/', $url, $matches);
    return $matches[2] ?? null;
}
}