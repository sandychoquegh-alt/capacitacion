<div class="row">

    {{-- TÍTULO --}}

    <div class="col-md-6 mb-3">

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



    {{-- IMAGEN --}}

    <div class="col-md-6 mb-3">

        <label class="form-label fw-bold">

            Imagen

        </label>

        <input
        type="file"
        name="imagen"
        class="form-control">

        @if(!empty($seccion?->imagen))

            <div class="mt-3">

                <p class="text-muted mb-2">

                    Imagen actual:

                </p>

                <img
                src="{{ asset('storage/'.$seccion->imagen) }}"
                class="img-thumbnail"
                width="220">

            </div>

        @endif

    </div>

</div>



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



<div class="mb-3">

    <label class="form-label fw-bold">

        Texto del Botón

    </label>

    <textarea
    name="texto_boton"
    rows="3"
    class="form-control"
    placeholder="Ejemplo: Ver más detalles"
    required>{{ old('texto_boton', $seccion->texto_boton ?? '') }}</textarea>

</div>