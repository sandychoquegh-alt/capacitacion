<style>
    /* FORMULARIOS */
.form-container {
    width: 100%;
    background: white;
    padding: 10px;
    border-radius: 10px;
}
.form-scroll {

    max-height: 75vh; /* altura máxima del formulario */

    overflow-y: auto; /* activa scroll vertical */

    padding-right: 15px;

}


/* Personalizar scrollbar */
.form-scroll::-webkit-scrollbar {
    width: 8px;
}


.form-scroll::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}


.form-scroll::-webkit-scrollbar-thumb:hover {
    background: #555;
}
.form-title {
    font-size: 20px;
    margin-bottom: 20px;
    border-bottom: 2px solid #eee;
    padding-bottom: 10px;
}

.form-group {
    margin-bottom: 12px;
}

.form-group label {
    font-weight: bold;
    margin-bottom: 5px;
}

.form-control {
    padding: 8px 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.form-control:focus {
    outline: none;
    border-color: #1d4ed8;
}

/* BOTÓN PRINCIPAL */
.btn-primary {
    background: #1d4ed8;
    color: white;
    padding: 10px 18px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-weight: 500;
}

.btn-primary:hover {
    background: #153ea3;
}

/* IMAGEN */
.preview-img {
    width: 150px;
    border-radius: 8px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
}
</style>


<div class="form-container">

    <div class="form-scroll">

        <h2 class="form-title">
            {{ isset($curso) ? 'Editar Curso' : 'Registrar Curso' }}
        </h2>

        <form method="POST"
      action="{{ isset($curso) ? route('admin.cursos.update', $curso->id) : route('admin.cursos.store') }}"
      enctype="multipart/form-data">
    
    @csrf

    @if(isset($curso))
        @method('PUT')
    @endif

    {{-- IMAGEN ACTUAL --}}
    @if(isset($curso) && $curso->imagen)
    <div class="form-group">
        <label>Imagen actual</label>
        <img src="{{ asset('storage/' . $curso->imagen) }}" class="preview-img">
    </div>
    @endif

    {{-- IMAGEN --}}
    <div class="form-group">
        <label>Imagen del curso</label>
        <input type="file" name="imagen" class="form-control">
    </div>
     <div class="form-group">
        <label>Imagen del QR</label>
        <input type="file" name="imgqr" class="form-control">
    </div>

    {{-- TITULO --}}
    <div class="form-group">
        <label>Título</label>
        <input type="text" name="titulo" 
               value="{{ $curso->titulo ?? '' }}" 
               class="form-control" required>
    </div>

    {{-- DESCRIPCION --}}
    <div class="form-group">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control" rows="4">
{{ $curso->descripcion ?? '' }}
        </textarea>
    </div>

    {{-- PRECIO --}}
    <div class="form-group">
        <label>Precio</label>
        <input type="number" name="precio" 
               value="{{ $curso->precio ?? '' }}" 
               class="form-control">
    </div>
    {{-- ESTADO --}}
{{-- ESTADO --}}
<div class="form-group">

    <label>Estado</label>

    <select name="estado" class="form-control">

        <option value="">
            Seleccione un estado
        </option>


        <option value="activo"
            {{ ($curso->estado ?? '') == 'activo' ? 'selected' : '' }}>
            Activo
        </option>


        <option value="populares"
            {{ ($curso->estado ?? '') == 'populares' ? 'selected' : '' }}>
            Populares
        </option>


        <option value="destacados"
            {{ ($curso->estado ?? '') == 'destacados' ? 'selected' : '' }}>
            Destacados
        </option>


        <option value="recientes"
            {{ ($curso->estado ?? '') == 'recientes' ? 'selected' : '' }}>
            Recientes
        </option>


        <option value="emprendedor1"
            {{ ($curso->estado ?? '') == 'emprendedor1' ? 'selected' : '' }}>
            Emprendedor Nivel 1
        </option>


        <option value="emprendedor2"
            {{ ($curso->estado ?? '') == 'emprendedor2' ? 'selected' : '' }}>
            Emprendedor Nivel 2
        </option>


        <option value="emprendedor3"
            {{ ($curso->estado ?? '') == 'emprendedor3' ? 'selected' : '' }}>
            Emprendedor Nivel 3
        </option>


        <option value="empresario1"
            {{ ($curso->estado ?? '') == 'empresario1' ? 'selected' : '' }}>
            Empresario Nivel 1
        </option>


        <option value="empresario2"
            {{ ($curso->estado ?? '') == 'empresario2' ? 'selected' : '' }}>
            Empresario Nivel 2
        </option>


        <option value="empresario3"
            {{ ($curso->estado ?? '') == 'empresario3' ? 'selected' : '' }}>
            Empresario Nivel 3
        </option>


    </select>

</div>

    {{-- BOTON --}}
    <div style="margin-top:20px; display:flex; justify-content:space-between;">
    
    <button type="submit" class="btn-primary">
        {{ isset($curso) ? 'Actualizar' : 'Guardar' }}
    </button>

    <button type="button" onclick="cerrarModal()" 
        style="background:#ccc; padding:10px 15px; border-radius:6px; border:none;">
        Cancelar
    </button>

</div>

</form>

</div>
</div>
</div>