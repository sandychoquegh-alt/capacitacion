<!-- SECCIÓN EMPRESAS ASOCIADAS -->
<section class="empresas-section reveal" id="empresas">

    <div class="container-empresas">

        @foreach($seccionesEmpresas as $empresa)

            <div class="titulo-empresas">

                <span>
                    Empresas Asociadas
                </span>

                <h2>
                    {{ $empresa->titulo }}
                </h2>

                <p>
                    {{ $empresa->descripcion }}
                </p>

            </div>
            <div class="slider-logos">

                <div class="slide-track">

                    {{-- PRIMER RECORRIDO --}}

                    @foreach($empresa->imagenes as $imagen)

                        <div class="slide">
                            <img
                            src="{{ asset('storage/'.$imagen->imagen) }}"
                            alt="{{ $empresa->titulo }}">
                        </div>

                    @endforeach

                    {{-- SEGUNDO RECORRIDO (duplicado para efecto infinito) --}}

                    @foreach($empresa->imagenes as $imagen)

                        <div class="slide">
                            <img
                            src="{{ asset('storage/'.$imagen->imagen) }}"
                            alt="{{ $empresa->titulo }}">
                        </div>
                    @endforeach

                </div>

            </div>

        @endforeach

    </div>

</section>