<div class="row">


    <!-- TÍTULO -->

    <div class="col-md-12 mb-3">

        <label class="form-label fw-bold">

            Título

        </label>

        <input
        type="text"
        name="titulo"
        class="form-control"
        value="{{ old('titulo', $seccion->titulo ?? '') }}"
        required>

    </div>


</div>




<!-- DESCRIPCIÓN -->

<div class="mb-3">

    <label class="form-label fw-bold">

        Descripción

    </label>

    <textarea
    name="descripcion"
    rows="5"
    class="form-control"
    required>{{ old('descripcion', $seccion->descripcion ?? '') }}</textarea>

</div>




<!-- IMÁGENES -->

<div class="mb-3">

    <label class="form-label fw-bold">

        Imágenes

    </label>

    <input
    type="file"
    name="imagenes[]"
    class="form-control"
    multiple>

    <small class="text-muted">

        Puede seleccionar una o varias imágenes.

    </small>

</div>




@if(isset($seccion) && $seccion->imagenes && $seccion->imagenes->count())

    <div class="mt-4">

        <label class="form-label fw-bold">

            Imágenes actuales

        </label>

        <div class="row">

            @foreach($seccion->imagenes as $imagen)

                <div class="col-md-3 mb-3">

                    <img
                    src="{{ asset('storage/'.$imagen->imagen) }}"
                    class="img-thumbnail"
                    style="width:100%;height:150px;object-fit:cover;">

                </div>

            @endforeach

        </div>

    </div>

@endif