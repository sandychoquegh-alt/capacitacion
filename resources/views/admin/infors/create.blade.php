<div id="modalCrear"
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
height:90vh;
border-radius:18px;
display:flex;
flex-direction:column;
overflow:hidden;
box-shadow:0 20px 60px rgba(0,0,0,.25);
">
<form
action="{{ route('admin.infors.store') }}"
method="POST">

    @csrf

    <div
    style="
    flex:1;
    overflow-y:auto;
    padding:25px;
    ">

        @php
    $info = null;
@endphp

@include('admin.infors._form')

    </div>

    <div
    style="
    display:flex;
    justify-content:space-between;
    border-top:1px solid #e5e7eb;
    padding:20px;
    ">

        <button
        type="button"
        onclick="cerrarModalCrear()"
        style="
        background:#6b7280;
        color:white;
        border:none;
        padding:12px 20px;
        border-radius:10px;
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
        ">

            Guardar Información

        </button>

    </div>

</form>
</div>
</div>