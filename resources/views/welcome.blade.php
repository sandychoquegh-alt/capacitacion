<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Academia F.H.B.</title>
    
    <link rel="icon" type="image/png" href="{{ asset('img/Imagen2.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

</head>

<body>

    @include('css.index')
    <!-- HEADER -->
    @include('public.header')
    <br>
    <!-- HERO -->
    <section class="hero reveal" id="contenedorHero">
        <div class="hero-content">
            <div class="hero-cards-wrapper">
                Cantidad de secciones: {{ $secciones->count() }}
                <div class="hero-cards" id="heroCards">
                    @foreach($secciones as $seccion)
                        <div class="mini-card {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset('storage/'.$seccion->imagen) }}" alt="{{ $seccion->titulo }}">
                            <h1>{{ $seccion->titulo }} </h1>
                            <p> {{ $seccion->subtitulo }} </p>
                            <a href="javascript:void(0)" onclick='abrirModalSeccion(@json($seccion))'>
                                Ver más → 
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- DOTS -->

                <div class="hero-navigation dots-navigation">
                    <div class="nav-dots">
                        @foreach($secciones as $seccion)
                            <span class="dot {{ $loop->first ? 'active' : '' }}"></span>
                        @endforeach
                    </div>
                </div>

                <!-- BOTONES -->

                <div class="hero-navigation buttons-navigation">
                    <div class="nav-btn nav-prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </div>
                    <div class="nav-btn nav-next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>

            </div>

        </div>
        <!-- TARJETAS INFERIORES -->
        <div class="row-cards">
            @foreach($infors as $info)
                <div class="card-box">
                    <h3> {{ $info->titulo }} </h3>
                    <p> {{ $info->descripcion }} </p>
                </div>
            @endforeach
        </div>
    </section>
    <!-- SECCIONES -->
    @include('public/nosotros')
    @include('public/cursos')
    
    <main>
        @yield('content')
    </main>
    @include('public/empresas')
    @include('public/empresa')
    @include('public/beneficios')
    @include('public/footer')
    @include('js/index')
    @stack('scripts')

    <!-- BOTÓN WHATSAPP -->

    <a href="https://wa.me/59165351816" target="_blank" class="whatsapp-float-text">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- MODAL SECCIONES -->

    <div class="modal fade" id="modalSeccion" tabindex="-1" style="z-index:99999;">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-3 overflow-hidden">
                <div class="modal-header text-white py-2 px-3" style="background-color:#001f3f;">
                    <h1 class="modal-title fs-5 mb-0" id="modalTitulo"></h1>
                    <button type="button" class="btn-close btn-close-white" onclick="cerrarModalSeccion()"> </button>
                </div>

                <!-- CONTENIDO -->

                <div class="modal-body p-4">
                    <img id="modalImagen"  class="img-fluid rounded-4 mb-4 w-100"  style="height:300px; object-fit:cover;">
                    <h3 id="modalSubtitulo" class="fw-bold mb-4"> </h3>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <p id="modalDescripcion0" class="text-muted"> </p>
                        </div>
                        <div class="col-md-6">
                            <p id="modalDescripcion1" class="text-muted"></p>
                        </div>
                    </div>
                    <p id="modalDescripcion2" class="text-muted"></p>
                    <p id="modalDescripcion3" class="text-muted"></p>
                </div>
            </div>
        </div>
    </div>
<script>
    function ajustarImagen(img) {
    const ancho = img.naturalWidth;
    const alto = img.naturalHeight;

    if (ancho > alto) {
        // Imagen horizontal
        img.style.objectFit = "contain";
    } 
    else if (alto > ancho) {
        // Imagen vertical
        img.style.objectFit = "contain";
    } 
    else {
        // Imagen cuadrada
        img.style.objectFit = "contain";
    }
}

</script>
</body>
</html>