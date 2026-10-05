<form
action="{{ route('admin.infors.update',$info->id) }}"
method="POST">

    @csrf
    @method('PUT')

    @include('admin.infors._form')

    <div
    style="
    display:flex;
    justify-content:space-between;
    margin-top:20px;
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

            Cancelar

        </button>

        <button
        type="submit"
        style="
        background:#2563eb;
        color:white;
        border:none;
        padding:12px 20px;
        border-radius:10px;
        cursor:pointer;
        ">

            Actualizar

        </button>

    </div>

</form>