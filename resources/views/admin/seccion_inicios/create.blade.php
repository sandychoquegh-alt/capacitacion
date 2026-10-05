<!-- ===========================
     MODAL CREAR SECCIÓN INICIO
=========================== -->

<div id="modalCrear"style=" display:none; position:fixed; inset:0; background:rgba(0,0,0,.65); z-index:9999; justify-content:center; align-items:center; padding:20px;
    ">

    <div style="
    background:#fff;
    width:50%;
    max-width:900px;
    max-height:90vh;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 20px 60px rgba(0,0,0,.25);
    display:flex;
    flex-direction:column;
">
        <!-- CABECERA -->

        <div
            style="
                background:#2563eb;
                color:white;
                padding:18px 25px;
                display:flex;
                justify-content:space-between;
                align-items:center;
                flex-shrink:0;
            ">

            <h3 style="margin:0;font-size:22px;font-weight:700;">

                <i class="fa-solid fa-house"></i>

                Nueva Sección Inicio

            </h3>

            <button
                type="button"
                onclick="cerrarModalCrear()"
                style="
                    background:none;
                    border:none;
                    color:white;
                    font-size:24px;
                    cursor:pointer;
                ">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

        <!-- FORMULARIO -->

       <form
    action="{{ route('admin.seccion_inicios.store') }}"
    method="POST"
    enctype="multipart/form-data"
    style="
        overflow-y:auto;
        padding:25px;
    ">

    @csrf

         <!-- TITULO -->

<div>

    <label style="font-weight:600;">
        Título principal
    </label>

    <input
        type="text"
        name="titulo"
        required
        placeholder="Ej: Hecho en Bolivia"
        style="
            width:100%;
            margin-top:8px;
            padding:12px;
            border:1px solid #d1d5db;
            border-radius:10px;
        ">

</div>


<!-- SUBTITULO -->

<div>

    <label style="font-weight:600;">
        Subtítulo
    </label>

    <input
        type="text"
        name="subtitulo"
        required
        placeholder="Ej: Impulsando productos nacionales"
        style="
            width:100%;
            margin-top:8px;
            padding:12px;
            border:1px solid #d1d5db;
            border-radius:10px;
        ">

</div>


<!-- IMAGEN -->

<div>

    <label style="font-weight:600;">
        Imagen del banner
    </label>

    <input
        type="file"
        name="imagen"
        accept="image/*"
        onchange="previewImagen(event)"
        required
        style="
            width:100%;
            margin-top:8px;
            padding:10px;
            border:1px solid #d1d5db;
            border-radius:10px;
        ">

</div>


<!-- PREVIEW -->

<div style="text-align:center;">

    <img
        id="preview"
        src=""
        style="
            display:none;
            width:250px;
            height:140px;
            object-fit:cover;
            border-radius:12px;
            border:2px dashed #d1d5db;
        ">

</div>



<!-- BOTON -->

<div>

    <label style="font-weight:600;">
        Texto del botón
    </label>

    <input
        type="text"
        name="texto_boton"
        placeholder="Ej: Conoce más"
        style="
            width:100%;
            margin-top:8px;
            padding:12px;
            border:1px solid #d1d5db;
            border-radius:10px;
        ">

</div>



<!-- DESCRIPCION 0 -->

<div style="grid-column:1/-1;">

    <label style="font-weight:600;">
        Descripción principal
    </label>

    <textarea
        name="descripcion0"
        rows="3"
        placeholder="Texto principal del banner"
        style="
            width:100%;
            margin-top:8px;
            padding:12px;
            border:1px solid #d1d5db;
            border-radius:10px;
            resize:none;
        "></textarea>

</div>



<!-- DESCRIPCION 1 -->

<div>

    <label style="font-weight:600;">
        Descripción secundaria 1
    </label>

    <textarea
        name="descripcion1"
        rows="3"
        placeholder="Información adicional"
        style="
            width:100%;
            margin-top:8px;
            padding:12px;
            border:1px solid #d1d5db;
            border-radius:10px;
            resize:none;
        "></textarea>

</div>




          

            <!-- FOOTER -->

     <div style="
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:30px;
    padding-top:20px;
    border-top:1px solid #e5e7eb;
">
    <button
        type="submit"
        style="
            background:#2563eb;
            color:white;
            border:none;
            padding:12px 22px;
            border-radius:10px;
            cursor:pointer;
            font-weight:600;
        ">

        <i class="fa-solid fa-floppy-disk"></i>

        Guardar Información

    </button>

    <button
        type="button"
        onclick="cerrarModalCrear()"
        style="
            background:#6b7280;
            color:white;
            border:none;
            padding:12px 22px;
            border-radius:10px;
            cursor:pointer;
            font-weight:600;
        ">

        <i class="fa-solid fa-xmark"></i>

        Cancelar

    </button>

</div>


        </form>

    </div>

</div>

<script>

function abrirModalCrear(){

    document.getElementById('modalCrear').style.display='flex';

}

function cerrarModalCrear(){

    document.getElementById('modalCrear').style.display='none';

}

function previewImagen(event){

    let archivo = event.target.files[0];

    if(!archivo) return;

    let reader = new FileReader();

    reader.onload = function(e){

        let img = document.getElementById('preview');

        img.src = e.target.result;

        img.style.display='block';

    }

    reader.readAsDataURL(archivo);

}

</script>