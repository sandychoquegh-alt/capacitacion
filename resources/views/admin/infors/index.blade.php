<x-app-layout>

<br>
<div class="max-w-7xl mx-auto px-6 py-8">

    <!-- ENCABEZADO -->

    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
    ">

        <div>

            <h2 style="margin:0;font-weight:700;color:#1f2937;">

                <i class="fa-solid fa-images"></i>

                Informaciones Inicio

            </h2>

            <p style="margin-top:6px;color:#6b7280;">

                Administra la información que se mostrará debajo del banner principal.

            </p>

        </div>

        <button
        type="button"
            onclick="abrirModalCrear()"
            style="
                background:#2563eb;
                color:white;
                border:none;
                padding:12px 18px;
                border-radius:10px;
                cursor:pointer;
                font-weight:600;
            ">

            <i class="fa-solid fa-plus"></i>

            Nueva Información

        </button>

    </div>

    <!-- TABLA -->

    <div style="
        background:white;
        border-radius:16px;
        overflow:hidden;
        box-shadow:0 10px 30px rgba(0,0,0,.08);
    ">

        <table style="width:100%;border-collapse:collapse;">

            <thead>

                <tr style="background:#f8fafc;">

                    <th>Título</th>

                    <th>Descripcion</th>

                    <th style="text-align:center;">Acciones</th>

                </tr>

            </thead>

            <tbody>

            @forelse($infors as $info)

                <tr style="border-top:1px solid #e5e7eb;">

                    

                    <td>{{ $info->titulo }}</td>

                    <td>{{ $info->descripcion }}</td>

                    <td style="text-align:center;">

                        <button
                        type="button"
                            onclick="abrirModalEditar({{ $info->id }})"
                            style="
                                background:#f59e0b;
                                color:white;
                                border:none;
                                padding:10px 12px;
                                border-radius:8px;
                                cursor:pointer;
                            ">

                            <i class="fa-solid fa-pen"></i>

                        </button>

                        <form
                            action="{{ route('admin.infors.destroy',$info->id) }}"
                            method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('¿Eliminar esta información?')"
                                style="
                                    background:#dc2626;
                                    color:white;
                                    border:none;
                                    padding:10px 12px;
                                    border-radius:8px;
                                    cursor:pointer;
                                ">

                                <i class="fa-solid fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5"
                        style="
                            text-align:center;
                            padding:60px;
                            color:#9ca3af;
                        ">

                        <i class="fa-solid fa-folder-open"
                           style="font-size:45px;"></i>

                        <br><br>

                        No existen registros.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>
    @include('admin.infors.create')
    <div id="modalEditar"
style="
display:none;
position:fixed;
inset:0;
background:rgba(0,0,0,.65);
z-index:9999;
justify-content:center;
align-items:center;
padding:20px;
">

    <div
    style="
    background:white;
    width:100%;
    max-width:900px;
    max-height:90vh;
    border-radius:18px;
    overflow:hidden;
    display:flex;
    flex-direction:column;
    ">

        <div
        style="
        background:#f59e0b;
        color:white;
        padding:18px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        ">

            <h3 style="margin:0;">

                Editar Información

            </h3>

            <button
            type="button"
            onclick="cerrarModalEditar()"
            style="
            background:none;
            border:none;
            color:white;
            font-size:24px;
            cursor:pointer;
            ">

                ×

            </button>

        </div>

        <div
        id="contenedorEditar"
        style="
        padding:25px;
        overflow-y:auto;
        max-height:75vh;
        ">
        </div>

    </div>

</div>

</div>
<script src="{{ asset('js/admin/infors.js') }}"></script>
</x-app-layout>
<script>

function abrirModalCrear(){

    document.getElementById('modalCrear').style.display = 'flex';

}

function cerrarModalCrear(){

    document.getElementById('modalCrear').style.display = 'none';

}

</script>
<script>

function abrirModalEditar(id){

    fetch('/admin/infors/'+id+'/edit')

    .then(response=>response.text())

    .then(html=>{

        document.getElementById('contenedorEditar').innerHTML=html;

        document.getElementById('modalEditar').style.display='flex';

    });

}

function cerrarModalEditar(){

    document.getElementById('modalEditar').style.display='none';

}

</script>
