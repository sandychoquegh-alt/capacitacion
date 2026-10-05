<x-app-layout>

<br>

<div class="max-w-7xl mx-auto px-6 py-8">

    @if(session('success'))

        <div
        style="
        background:#dcfce7;
        color:#166534;
        padding:15px;
        border-radius:10px;
        margin-bottom:20px;
        ">

            {{ session('success') }}

        </div>

    @endif



    <!-- CABECERA -->

    <div
    style="
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    ">

        <h2>

            Sección Empresas

        </h2>



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
        ">

            <i class="fa-solid fa-plus"></i>

            Nueva Empresa

        </button>

    </div>




    <!-- TABLA -->

    <table
    style="
    width:100%;
    border-collapse:collapse;
    ">

        <thead>

            <tr
            style="
            background:#f8fafc;
            border-bottom:2px solid #e5e7eb;
            ">

                <th style="padding:15px;">
                    Imagen
                </th>

                <th>
                    Título
                </th>

                <th>
                    Descripción
                </th>

                <th style="text-align:center;">
                    Total Imágenes
                </th>

                <th style="text-align:center;">
                    Acciones
                </th>

            </tr>

        </thead>



        <tbody>

        @forelse($secciones as $seccion)

            <tr
            style="
            border-bottom:1px solid #e5e7eb;
            ">

                <!-- PRIMERA IMAGEN -->

                <td style="padding:15px;">

                    @if($seccion->imagenes && $seccion->imagenes->count())

                        <img
                        src="{{ asset('storage/'.$seccion->imagenes->first()->imagen) }}"
                        style="
                        width:120px;
                        height:70px;
                        object-fit:cover;
                        border-radius:10px;
                        ">

                    @else

                        Sin imagen

                    @endif

                </td>



                <!-- TITULO -->

                <td>

                    {{ $seccion->titulo }}

                </td>



                <!-- DESCRIPCION -->

                <td>

                    {{ Str::limit($seccion->descripcion,80) }}

                </td>



                <!-- TOTAL -->

                <td
                style="text-align:center;">

                    {{ $seccion->imagenes ? $seccion->imagenes->count() : 0 }}

                </td>




                <!-- BOTONES -->

                <td
                style="
                text-align:center;
                ">

                    <button
                    type="button"
                    onclick="abrirModalEditar({{ $seccion->id }})"
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
                    action="{{ route('admin.secciones_empresas.destroy',$seccion->id) }}"
                    method="POST"
                    style="display:inline;">

                        @csrf

                        @method('DELETE')

                        <button
                        onclick="return confirm('¿Eliminar este registro?')"
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

                <td
                colspan="5"
                style="
                padding:40px;
                text-align:center;
                ">

                    No existen registros.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>



    <br>

    {{ $secciones->links() }}

</div>



{{-- MODAL CREAR --}}

@include('admin.secciones_empresas.create')



{{-- MODAL EDITAR --}}

<div id="modalEditar"
style="
display:none;
position:fixed;
inset:0;
background:rgba(0,0,0,.60);
z-index:9999;
justify-content:center;
align-items:center;
padding:20px;
">

    <div
    style="
    background:white;
    width:95%;
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
        padding:15px 20px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        ">

            <h3 style="margin:0;">

                <i class="fa-solid fa-pen"></i>

                Editar Empresa

            </h3>

            <button
            type="button"
            onclick="cerrarModalEditar()"
            style="
            background:none;
            border:none;
            color:white;
            font-size:26px;
            cursor:pointer;
            ">

                ×

            </button>

        </div>



        <div
        id="contenedorEditar"
        style="
        overflow-y:auto;
        max-height:70vh;
        padding:25px;
        ">

        </div>

    </div>

</div>

</x-app-layout>
<script>

function abrirModalCrear(){

    document.getElementById('modalCrear').style.display = "flex";

}



function cerrarModalCrear(){

    document.getElementById('modalCrear').style.display = "none";

}





async function abrirModalEditar(id){

    const modal = document.getElementById('modalEditar');

    const contenedor = document.getElementById('contenedorEditar');

    modal.style.display = "flex";

    contenedor.innerHTML = "<p>Cargando formulario...</p>";

    try{

        const respuesta = await fetch(

            `/admin/secciones_empresas/${id}/edit`

        );

        contenedor.innerHTML = await respuesta.text();

    }

    catch(error){

        contenedor.innerHTML =

        "<p>No se pudo cargar el formulario.</p>";

    }

}




function cerrarModalEditar(){

    document.getElementById('modalEditar').style.display = "none";

    document.getElementById('contenedorEditar').innerHTML = "";

}





window.onclick = function(event){

    const modalCrear = document.getElementById('modalCrear');

    const modalEditar = document.getElementById('modalEditar');



    if(event.target === modalCrear){

        cerrarModalCrear();

    }



    if(event.target === modalEditar){

        cerrarModalEditar();

    }

}

</script>