<x-app-layout>

<br>

<div class="max-w-7xl mx-auto px-6 py-8">

<div style="background:#fff;padding:30px;border-radius:18px;box-shadow:0 10px 30px rgba(0,0,0,.08);">

    <!-- ENCABEZADO -->
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:25px;">

        <div>

            <h2 style="margin:0;font-size:24px;font-weight:700;color:#111827;">
                <i class="fa-solid fa-house text-blue-600"></i>
                Sección Inicio
            </h2>

            <p style="margin-top:6px;color:#6b7280;">
                Administra la información principal de la página de inicio.
            </p>

        </div>

       <button
onclick="abrirModalCrear()"
style="
background:#2563eb;
color:white;
padding:12px 20px;
border:none;
border-radius:10px;
">

<i class="fa-solid fa-plus"></i>

Nueva sección

</button>
</button>

    </div>

    <!-- ALERTA -->
    @if(session('success'))

        <div style="background:#dcfce7;color:#166534;padding:15px;border-radius:10px;margin-bottom:20px;">

            <i class="fa-solid fa-circle-check"></i>

            {{ session('success') }}

        </div>

    @endif

    <!-- TABLA -->

    <div style="overflow-x:auto;">

        <table style="width:100%;border-collapse:collapse;">

            <thead>

                <tr style="background:#f8fafc;border-bottom:2px solid #e5e7eb;">

                    <th style="padding:15px;">Imagen</th>

                    <th>Título</th>

                    <th>Subtítulo</th>

                    <th>Estado</th>

                    <th style="text-align:center;">Acciones</th>

                </tr>

            </thead>

            <tbody>

            @forelse($secciones as $seccion)

                <tr style="border-bottom:1px solid #e5e7eb;">

                    <td style="padding:15px;">

                        @if($seccion->imagen)

                            <img src="{{ asset('storage/'.$seccion->imagen) }}"
                                 style="width:120px;height:70px;border-radius:10px;object-fit:cover;">

                        @else

                            <div style="width:120px;height:70px;background:#f3f4f6;border-radius:10px;display:flex;align-items:center;justify-content:center;">

                                <i class="fa-solid fa-image" style="font-size:25px;color:#9ca3af;"></i>

                            </div>

                        @endif

                    </td>

                    <td>{{ $seccion->titulo }}</td>

                    <td>{{ $seccion->subtitulo }}</td>

                    <td>

                        @if($seccion->estado=='activo')

                            <span style="background:#dcfce7;color:#166534;padding:6px 12px;border-radius:20px;font-size:13px;font-weight:600;">

                                Activo

                            </span>

                        @else

                            <span style="background:#fee2e2;color:#991b1b;padding:6px 12px;border-radius:20px;font-size:13px;font-weight:600;">

                                Inactivo

                            </span>

                        @endif

                    </td>

                    <td style="text-align:center;">
<button
type="button"
onclick="abrirModalEditar({{ $seccion->id }})"
style="
background:#f59e0b;
color:white;
border:none;
padding:8px 12px;
border-radius:8px;
cursor:pointer;
">
    <i class="fa-solid fa-pen"></i>
</button>

                        <form action="{{ route('admin.seccion_inicios.destroy',$seccion->id) }}"
                              method="POST"
                              style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('¿Eliminar esta sección?')"
                                    style="background:#dc2626;color:white;border:none;padding:10px 12px;border-radius:10px;cursor:pointer;">

                                <i class="fa-solid fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" style="padding:50px;text-align:center;color:#9ca3af;">

                        <i class="fa-solid fa-folder-open" style="font-size:40px;"></i>

                        <br><br>

                        No existe información registrada.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>

<div id="modalEditar"
style="
display:none;
position:fixed;
inset:0;
background:rgba(0,0,0,.6);
z-index:9999;
justify-content:center;
align-items:center;
padding:20px;
">


<div id="contenidoModal"
style="
background:white;
width:55%;
max-width:900px;
max-height:90vh;
overflow:auto;
border-radius:18px;
padding:25px;
">

</div>


</div>
@include('admin.seccion_inicios.create')

<script>


function abrirModalEditar(id)
{
    let url = "{{ route('admin.seccion_inicios.edit', ':id') }}";
    url = url.replace(':id', id);

    fetch(url)
        .then(response => response.text())
        .then(html => {
            document.getElementById('contenidoModal').innerHTML = html;
            document.getElementById('modalEditar').style.display = 'flex';
        });
}
function cerrarModalEditar()
{
    document.getElementById('modalEditar').style.display = 'none';
    document.getElementById('contenidoModal').innerHTML = '';
}
</script>

</x-app-layout>
