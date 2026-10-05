<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('orden')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'titulo' => 'required|string|max:150',
            'subtitulo' => 'nullable|string',
            'imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'texto_boton' => 'nullable|string|max:80',
            'enlace_boton' => 'nullable|string|max:255',
            'orden' => 'required|integer|min:1',
            'estado' => 'required|in:activo,inactivo',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $datos['imagen'] = $request->file('imagen')
            ->store('banners', 'public');

        Banner::create($datos);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner creado correctamente.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $datos = $request->validate([
            'titulo' => 'required|string|max:150',
            'subtitulo' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'texto_boton' => 'nullable|string|max:80',
            'enlace_boton' => 'nullable|string|max:255',
            'orden' => 'required|integer|min:1',
            'estado' => 'required|in:activo,inactivo',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        if ($request->hasFile('imagen')) {
            Storage::disk('public')->delete($banner->imagen);

            $datos['imagen'] = $request->file('imagen')
                ->store('banners', 'public');
        }

        $banner->update($datos);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner actualizado correctamente.');
    }

    public function destroy(Banner $banner)
    {
        Storage::disk('public')->delete($banner->imagen);

        $banner->delete();

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner eliminado correctamente.');
    }
}
