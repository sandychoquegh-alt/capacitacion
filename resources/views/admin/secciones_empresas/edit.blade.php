@if(isset($seccion))

<form
action="{{ route('admin.secciones_empresas.update',$seccion->id) }}"
method="POST"
enctype="multipart/form-data"
style="
padding:40px;
max-height:65vh;
overflow-y:auto;
">

    @csrf
    @method('PUT')

    @include('admin.secciones_empresas._form')

    <div
    style="
    display:flex;
    justify-content:space-between;
    margin-top:25px;
    ">

        <button
        type="button"
        onclick="cerrarModalEditar()"
        style="
        background:#6b7280;
        color:white;
        border:none;
        padding:12px 20px;
        border-radius:10px;
        cursor:pointer;
        ">

            <i class="fa-solid fa-xmark"></i>

            Cancelar

        </button>

        <button
        type="submit"
        style="
        background:#f59e0b;
        color:white;
        border:none;
        padding:12px 20px;
        border-radius:10px;
        cursor:pointer;
        ">

            <i class="fa-solid fa-floppy-disk"></i>

            Actualizar

        </button>

    </div>

</form>

@endif