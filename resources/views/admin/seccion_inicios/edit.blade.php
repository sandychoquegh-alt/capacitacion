 <div style="margin:-25px -25px 25px -25px;padding:20px 25px;background:#f59e0b;display:flex;justify-content:space-between;align-items:center;border-radius:18px 18px 0 0;">
    <h2 style="margin:0;font-size:24px;font-weight:700;color:black;
    ">
     <i class="fa-solid fa-pen-to-square"></i>
         Editar Sección

    </h2>

    <button
    type="button"
    onclick="cerrarModalEditar()"
    style="
    width:40px;
    height:40px;
    border:none;
    border-radius:50%;
    background:#ef4444;
    color:white;
    cursor:pointer;
    ">
        <i class="fa-solid fa-xmark"></i>
    </button>

</div>
<br>
<form
action="{{ route('admin.seccion_inicios.update',$seccion->id) }}"
method="POST"
enctype="multipart/form-data"
>

    @csrf
    @method('PUT')

    


    <div style="
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
    gap:20px;
    ">

        <!-- TITULO -->

        <div>

            <label style="font-weight:600;">

                Título

            </label>

            <input
            type="text"
            name="titulo"
            value="{{ old('titulo',$seccion->titulo) }}"
            required
            style="
            width:100%;
            padding:12px;
            border:1px solid #ddd;
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
            value="{{ old('subtitulo',$seccion->subtitulo) }}"
            required
            style="
            width:100%;
            padding:12px;
            border:1px solid #ddd;
            border-radius:10px;
            ">

        </div>


        <!-- IMAGEN -->

        <div>

            <label style="font-weight:600;">

                Imagen

            </label>

            <input
            type="file"
            name="imagen"
            accept="image/*"
            onchange="previewImagenEditar(event)"
            style="
            width:100%;
            padding:10px;
            border:1px solid #ddd;
            border-radius:10px;
            ">

        </div>


        <!-- IMAGEN ACTUAL -->

        <div style="text-align:center;">

            <label style="font-weight:600;display:block;margin-bottom:10px;">

                Imagen actual

            </label>

            <img

            id="previewEditar"

            src="{{ asset('storage/'.$seccion->imagen) }}"

            style="
            width:220px;
            height:140px;
            object-fit:cover;
            border-radius:12px;
            border:1px solid #ddd;
            ">

        </div>


        <!-- TEXTO BOTON -->

        <div>

            <label style="font-weight:600;">

                Texto del botón

            </label>

            <input
            type="text"
            name="texto_boton"
            value="{{ old('texto_boton',$seccion->texto_boton) }}"
            style="
            width:100%;
            padding:12px;
            border-radius:10px;
            border:1px solid #ddd;
            ">

        </div>


        <!-- DESCRIPCION PRINCIPAL -->

        <div style="grid-column:1/-1;">

            <label style="font-weight:600;">

                Descripción principal

            </label>

            <textarea

            name="descripcion0"

            rows="4"

            style="
            width:100%;
            padding:12px;
            border-radius:10px;
            border:1px solid #ddd;
            "

            >{{ old('descripcion0',$seccion->descripcion0) }}</textarea>

        </div>

                <!-- DESCRIPCIÓN 1 -->

        <div>

            <label style="font-weight:600;">

                Descripción 1

            </label>

            <textarea
            name="descripcion1"
            rows="4"
            style="
            width:100%;
            padding:12px;
            border-radius:10px;
            border:1px solid #ddd;
            ">{{ old('descripcion1',$seccion->descripcion1) }}</textarea>

        </div>


        <!-- DESCRIPCIÓN 2 -->

        <div>

            <label style="font-weight:600;">

                Descripción 2

            </label>

            <textarea
            name="descripcion2"
            rows="4"
            style="
            width:100%;
            padding:12px;
            border-radius:10px;
            border:1px solid #ddd;
            ">{{ old('descripcion2',$seccion->descripcion2) }}</textarea>

        </div>


        <!-- DESCRIPCIÓN 3 -->

        <div style="grid-column:1/-1;">

            <label style="font-weight:600;">

                Descripción 3

            </label>

            <textarea
            name="descripcion3"
            rows="4"
            style="
            width:100%;
            padding:12px;
            border-radius:10px;
            border:1px solid #ddd;
            ">{{ old('descripcion3',$seccion->descripcion3) }}</textarea>

        </div>

    </div>


    <!-- BOTONES -->

    <div style="
    display:flex;
    justify-content:flex-end;
    gap:15px;
    margin-top:30px;
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

            <i class="fa-solid fa-floppy-disk"></i>

            Actualizar

        </button>

    </div>

</form>


<script>

function previewImagenEditar(event)
{

    let reader = new FileReader();

    reader.onload = function(){

        document.getElementById('previewEditar').src = reader.result;

    }

    reader.readAsDataURL(event.target.files[0]);

}

</script>