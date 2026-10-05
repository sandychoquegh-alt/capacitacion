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
        value="{{ old('titulo', $sobre->titulo ?? '') }}"
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





        @if(isset($sobre) && $sobre->imagen)


            <div class="mt-3">


                <label class="form-label text-muted">

                    Imagen actual:

                </label>



                <br>


                <img
                src="{{ asset('storage/'.$sobre->imagen) }}"
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
    rows="4"
    class="form-control"
    required>{{ old('descripcion', $sobre->descripcion ?? '') }}</textarea>


</div>







<div class="mb-3">


    <label class="form-label fw-bold">

        Misión

    </label>



    <textarea
    name="mision"
    rows="4"
    class="form-control"
    required>{{ old('mision', $sobre->mision ?? '') }}</textarea>


</div>







<div class="mb-3">


    <label class="form-label fw-bold">

        Visión

    </label>



    <textarea
    name="vision"
    rows="4"
    class="form-control"
    required>{{ old('vision', $sobre->vision ?? '') }}</textarea>


</div>