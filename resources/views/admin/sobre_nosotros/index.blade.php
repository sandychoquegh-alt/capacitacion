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

            Sobre Nosotros

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

            Nueva Información

        </button>

    </div>


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

                <th style="padding:15px;">Imagen</th>

                <th>Título</th>

                <th>Misión</th>

                <th>Visión</th>

                <th style="text-align:center;">
                    Acciones
                </th>

            </tr>

        </thead>

        <tbody>

        @forelse($sobreNosotros as $sobre)

            <tr
            style="
            border-bottom:1px solid #e5e7eb;
            ">

                <td style="padding:15px;">

                    @if($sobre->imagen)

                        <img
                        src="{{ asset('storage/'.$sobre->imagen) }}"
                        style="
                        width:120px;
                        height:70px;
                        object-fit:cover;
                        border-radius:10px;
                        ">

                    @endif

                </td>

                <td>

                    {{ $sobre->titulo }}

                </td>

                <td>

                    {{ Str::limit($sobre->mision,60) }}

                </td>

                <td>

                    {{ Str::limit($sobre->vision,60) }}

                </td>

                <td
                style="
                text-align:center;
                ">

                    <button
                    type="button"
                    onclick="abrirModalEditar({{ $sobre->id }})"
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
                    action="{{ route('admin.sobre_nosotros.destroy',$sobre->id) }}"
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

                    No existe información registrada.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    <br>

    {{ $sobreNosotros->links() }}

</div>
@include('admin.sobre_nosotros.create')
@include('admin.sobre_nosotros.edit', ['modal' => true])
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

    contenedor.innerHTML = "<p>Cargando...</p>";

    try{

        const respuesta = await fetch(
            `/admin/sobre_nosotros/${id}/edit`
        );

        contenedor.innerHTML = await respuesta.text();

    }catch(error){

        contenedor.innerHTML =
        "<p>No se pudo cargar el formulario.</p>";

    }

}

function cerrarModalEditar(){

    document.getElementById('modalEditar').style.display = "none";

}

</script>