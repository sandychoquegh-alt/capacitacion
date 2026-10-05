<x-app-layout>
<br>
<div class="max-w-7xl mx-auto px-6 py-10" style="background:#ffffff;padding:25px;border-radius:16px;box-shadow:0 10px 25px rgba(0,0,0,.08);">


<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:25px;">
    <div>
        <h2 style="margin:0;font-size:22px;font-weight:700;">
            <i class="fa-solid fa-images"></i>
            Banners del inicio
        </h2>

        <p style="margin:6px 0 0;color:#6b7280;">
            Administra las imágenes y mensajes que se muestran en la página principal.
        </p>
    </div>

  
</div>

@if(session('success'))
    <div style="background:#dcfce7;color:#166534;padding:12px;border-radius:10px;margin-bottom:20px;">
        {{ session('success') }}
    </div>
@endif

<div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#f3f4f6;text-align:left;">
                <th style="padding:12px;">Imagen</th>
                <th style="padding:12px;">Título</th>
                <th style="padding:12px;">Orden</th>
                <th style="padding:12px;">Estado</th>
                <th style="padding:12px;text-align:center;">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse($banners as $banner)
                <tr style="border-bottom:1px solid #e5e7eb;">
                    <td style="padding:12px;">
                        <img src="{{ asset('storage/' . $banner->imagen) }}"
                             alt="{{ $banner->titulo }}"
                             style="width:120px;height:65px;object-fit:cover;border-radius:8px;">
                    </td>

                    <td style="padding:12px;">{{ $banner->titulo }}</td>
                    <td style="padding:12px;">{{ $banner->orden }}</td>

                    <td style="padding:12px;">
                        <span style="background:{{ $banner->estado === 'activo' ? '#dcfce7' : '#fee2e2' }};color:{{ $banner->estado === 'activo' ? '#166534' : '#991b1b' }};padding:6px 10px;border-radius:999px;font-size:12px;">
                            {{ ucfirst($banner->estado) }}
                        </span>
                    </td>

                    <td style="padding:12px;text-align:center;">
                        <a href="{{ route('admin.banners.edit', $banner) }}"
                           style="background:#f59e0b;color:#fff;padding:8px 10px;border-radius:8px;text-decoration:none;">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <form action="{{ route('admin.banners.destroy', $banner) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('¿Desea eliminar este banner?')"
                                    style="background:#dc2626;color:#fff;border:none;padding:8px 10px;border-radius:8px;cursor:pointer;">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding:30px;text-align:center;color:#6b7280;">
                        No existen banners registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top:20px;">
    {{ $banners->links() }}
</div>


</div>


</x-app-layout>
<br>