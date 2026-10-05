<x-app-layout>
<br>
<div class="max-w-7xl mx-auto px-6 py-10">


    <div class="flex justify-between items-center mb-8">

        <button class="btn btn-primary"  style="
                    width:10%;
                    padding:2px;
                    background:#2563eb;
                    color:white;
                    border:none;
                    border-radius:10px;
                    font-weight:bold;
                    cursor:pointer;
                "
    onclick="abrirModalCertificado()">

    + Crear nuevo certificado

</button>

<div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;margin-bottom:20px;">

    <form method="GET" action="{{ route('admin.certificados.index') }}">
        <div style="display:flex;align-items:center;gap:10px;">
            
            <div style="display:flex;align-items:center;background:#f3f4f6;padding:10px 14px;border-radius:12px;width:320px;">
                <i class="fa-solid fa-magnifying-glass"></i>
                
                <input type="text" name="buscar" value="{{$buscar }}" placeholder="Buscar usuario..." style="border:none;background:transparent;outline:none;margin-left:10px;width:100%;">
            </div>

            <button style="background:linear-gradient(135deg,#2563eb,#1d4ed8);color:white;border:none;padding:11px 22px;border-radius:12px;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:8px;">
                <i class="fa-solid fa-filter"></i>
                Buscar
            </button>

        </div>
    </form>

</div>
</div>


<div>
            <h1 class="text-3xl font-bold">
                Certificados
            </h1>

            <p class="text-gray-500">
                Personas con certificados generados
            </p>
        </div>
    <div class="bg-white shadow rounded-xl overflow-hidden">


        <table class="w-full">


            <thead class="bg-gray-100">

                <tr>



                    <th class="p-4 text-left">
                        Usuario
                    </th>


                    <th class="p-4 text-left">
                        Curso
                    </th>


                    <th class="p-4 text-left">
                        Fecha
                    </th>


                    <th class="p-4 text-left">
                        Estado
                    </th>


                </tr>


            </thead>



            <tbody>


            @forelse($certificados as $certificado)


                <tr class="border-b">

                    <td class="p-4">


                       {{ $certificado->inscripcion->usuario->nombre ?? 'Sin usuario' }}
                       {{ $certificado->inscripcion->usuario->apellido ?? 'Sin apellido' }}

                    </td>


                    <td class="p-4">


                        {{ $certificado->inscripcion->curso->titulo ?? 'Sin curso' }}


                    </td>



                    <td class="p-4">

                        {{ $certificado->created_at->format('d/m/Y') }}

                    </td>



                    <td class="p-4">


                    <a
    href="{{ asset('storage/' . $certificado->ruta) }}"
    target="_blank"
    style="
        display:inline-flex;
        align-items:center;
        gap:8px;
        background:linear-gradient(135deg,#2563eb,#1d4ed8);
        color:white;
        padding:9px 16px;
        border-radius:10px;
        text-decoration:none;
        font-weight:600;
        font-size:14px;
        box-shadow:0 8px 18px rgba(37,99,235,.25);
        transition:.3s;
    "
    onmouseover="this.style.transform='translateY(-2px)'"
    onmouseout="this.style.transform='translateY(0)'"
>


<!-- ICONO OJO REAL -->

<svg 
width="18"
height="18"
viewBox="0 0 24 24"
fill="none"
stroke="currentColor"
stroke-width="2">

<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/>

<circle cx="12" cy="12" r="3"/>

</svg>


Ver Certificado


</a>


                    </td>


                </tr>


            @empty


                <tr>

                    <td colspan="5"
                        class="p-5 text-center text-gray-500">


                        No existen certificados registrados.


                    </td>


                </tr>


            @endforelse


            </tbody>


        </table>
{{ $certificados->links() }}

    </div>

@include('admin.certificados.create')
</div>


</x-app-layout>
<script>
function abrirModalCertificado() {
    document.getElementById('modalCertificado').style.display = 'block';
}

function cerrarModalCertificado() {
    document.getElementById('modalCertificado').style.display = 'none';
}
</script>