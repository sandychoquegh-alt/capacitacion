<x-app-layout>
    
<div class="curso-container">

   {{-- SIDEBAR --}}
<div class="sidebar">
    <h4>CONTENIDO DEL CURSO</h4>

    @foreach($modulos as $modulo)
            <div class="modulo"
     id="modulo-{{ $loop->index }}"
     data-modulo-id="{{ $modulo->id }}">

            {{-- SOLO TÍTULO SIEMPRE VISIBLE --}}
            <div class="titulo-modulo"
                 onclick="toggleModulo({{ $loop->index }})">

                <strong>
                    {{ $modulo->titulo }}
                    |
                    {{ $modulo->videos->count() }} lecciones
                </strong>

            </div>

            {{-- LECCIONES: SOLO EL PRIMER MÓDULO ABIERTO --}}
            <div class="lecciones-container {{ $loop->first ? 'activo' : '' }}"
                 id="lecciones-{{ $loop->index }}">

                @foreach($modulo->videos as $video)

                    @php
                        $id = $video->youtube_id;

                        if (str_contains($id, 'youtu.be/')) {
                            $id = explode('youtu.be/', $id)[1];
                        }

                        if (str_contains($id, 'watch?v=')) {
                            $id = explode('v=', $id)[1];
                        }

                        $id = explode('?', $id)[0];
                    @endphp

                    <div class="leccion"
                         data-youtube="{{ $id }}"
                         onclick="cambiarVideo('{{ $id }}', this)">

                        <span class="icono">✔</span>
                        <span class="titulo">{{ $video->titulo }}</span>

                    </div>

                @endforeach

            </div>

        </div>
    @endforeach

    {{-- BOTONES --}}
    <div class="acciones">
        <button class="btn-prev">⬅ Anterior</button>
        <button class="btn-next">Siguiente ➡</button>
    </div>
</div>

    {{-- CONTENIDO PRINCIPAL --}}
    {{-- CONTENIDO PRINCIPAL --}}
<div class="contenido">

    {{-- VIDEO --}}
    <div class="video-box">

        <div id="videoPlayer"></div>

        {{-- BOTÓN REPLAY --}}
        <div style="margin-top:20px; text-align:center;">

            <button
                id="btnReplay"
                onclick="reproducirOtraVez()"
                style="display:none;"
                class="btn azul">

                🔁 Volver a reproducir

            </button>

        </div>

    </div>

    {{-- PROGRESO --}}
    <div class="progreso">
        <span>{{ $progreso }}% completado</span>

        <div class="barra">
            <div
                class="barra-interna"
                style="width: {{ $progreso }}%">
            </div>
        </div>
    </div>

</div>

</div>

<style>
    .curso-container {
    display: flex;
    height: 100vh;
    font-family: sans-serif;
}

/* SIDEBAR */
.sidebar {
    width: 300px;
    background: #f5f7fb;
    padding: 20px;
    overflow-y: auto;
    
}

.modulo {
    background: white;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 15px;
    border:1px solid blue;
}




/* TITULO MODULO */
.titulo-modulo {
    cursor: pointer;
    padding: 0px;
    border-radius: 8px;
    transition: 0.3s;
}

/* MODULO PENDIENTE */
.titulo-modulo {
    color: green;
}

/* MODULO COMPLETADO */
.modulo.completado .titulo-modulo {
    color: red;
}

/* CONTENEDOR LECCIONES */
.lecciones-container {
    display: none;
    margin-top: 10px;
}

/* SOLO MODULO ACTIVO */
.lecciones-container.activo {
    display: block;
}





/* BASE */
.leccion {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px;
    cursor: pointer;
    border-radius: 6px;
    transition: all 0.3s ease;
    padding: 15;
    margin:5px;
}

/* ICONO */
.leccion .icono {
    font-size: 18px;
}

/* HOVER */
.leccion:hover {
    background: #e6eeff;
}

/* ACTIVO */
.leccion.activo {
    border-left: 4px solid #3b82f6;
    background: #eef2ff;
}

/* VISTO (VIDEO COMPLETADO) */
.leccion.visto {
    background: #fee0e0;
     color: #0d1253;
    font-weight: bold;
}
/* CHECK BONITO */
.leccion.visto input {
    accent-color: green;
    padding:10px;
}
/* TEXTO VISTO */
.leccion.visto .titulo {
    color: #1e3a8a; /* azul oscuro 🔥 */
    font-weight: bold;
}

/* ICONO COMPLETADO ✔✔ */
.leccion.visto .icono {
    content: "✔✔";
    color: #0d1253;
}

/* CONTENIDO */
.contenido {
    flex: 1;
    padding: 20px;
    
}

/* VIDEO */
.video-box iframe {
    width: 100%;
    height: 500px;
    border-radius: 12px;
    border:1px solid blue;
}

/* PROGRESO */
.progreso {
    margin-top: 15px;
}

.barra {
    width: 100%;
    height: 8px;
    background: #ddd;
    border-radius: 10px;
}

.barra-interna {
    height: 100%;
    background: #3b82f6;
    border-radius: 10px;
}

/* BOTONES */
.acciones {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
}

.btn-prev, .btn-next {
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    background: #3b82f6;
    color: white;
    cursor: pointer;
}

.mensaje {
    position: fixed;
    top: 90%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #3b82f6;
    color: white;
    padding: 20px 30px;
    border-radius: 12px;
    font-size: 18px;
    display: none;
    z-index: 999;
    box-shadow: 0px 10px 30px rgba(0,0,0,0.2);
}
/* ICONO PRINCIPAL */
.icono-exito i {
    font-size: 65px;
    color: #facc15; /* dorado 🏆 */
    animation: bounce 1s infinite alternate;
}

/* ICONOS DE TEXTO */
.usuario i,
.mensaje i,
.curso i {
    margin-right: 6px;
    color: #2563eb;
}

/* ICONO CHECK */
.mensaje i {
    color: #16a34a;
}

/* ICONO CURSO */
.curso i {
    color: #9333ea;
}



/* BOTON PROFESIONAL */
.btn-formul{
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    padding: 12px 22px;
    border-radius: 14px;

    background: linear-gradient(135deg, #7c3aed, #9333ea);
    color: #ffffff;

    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.5px;

    border: none;
    cursor: pointer;

    box-shadow:
        0 8px 20px rgba(147, 51, 234, 0.35),
        inset 0 1px 0 rgba(255,255,255,0.2);

    transition: all 0.35s ease;

    position: relative;
    overflow: hidden;
}

/* EFECTO BRILLO */
.btn-formul::before{
    content: '';
    position: absolute;
    top: 0;
    left: -120%;
    width: 100%;
    height: 100%;

    background: rgba(255,255,255,0.2);
    transform: skewX(-25deg);

    transition: 0.6s;
}

/* HOVER */
.btn-formul:hover{
    transform: translateY(-3px) scale(1.03);

    box-shadow:
        0 12px 28px rgba(147, 51, 234, 0.45),
        inset 0 1px 0 rgba(255,255,255,0.3);

    background: linear-gradient(135deg, #9333ea, #6d28d9);
}

/* EFECTO BRILLO EN HOVER */
.btn-formul:hover::before{
    left: 130%;
}

/* CLICK */
.btn-formul:active{
    transform: scale(0.97);
}

/* ICONO */
.btn-formul i{
    font-size: 18px;
}



/* ICONO BOTON */
.btn-certificado i {
    margin-right: 6px;
}

.modal-final {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);

    justify-content: center;
    align-items: center;
}

.modal-contenido {
    background: white;
    padding: 30px;
    border-radius: 12px;
    text-align: center;
    width: 350px;
    animation: aparecer 0.4s ease;
}

.modal-contenido h2 {
    color: #16a34a;
}

.modal-contenido button {
    margin-top: 15px;
    padding: 10px 20px;
    background: #2563eb;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.modal-contenido button:hover {
    background: #1e40af;
}

#btnReplay {
    padding: 12px 25px;
    border: none;
    border-radius: 10px;
    background: #2563eb;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

#btnReplay:hover {
    transform: scale(1.05);
}

.video-box {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
}

/* 🔥 ocultar barra inferior de YouTube */
.video-box iframe {
    width: 100%;
    height: 500px;
    border: none;
    /*pointer-events: none;*/
}
/*
.ytp-share-button,
.ytp-youtube-button,
.ytp-chrome-top,
.ytp-title,
.ytp-watermark,
.ytp-cards-button,
.ytp-ce-element,
.ytp-pause-overlay,
.ytp-show-cards-title,
.ytp-impression-link {
    display: none !important;
}
*/
@keyframes aparecer {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}





.modulos-completados{

    margin-top: 40px;

    background: #fff;

    padding: 30px;

    border-radius: 20px;

    box-shadow:
        0 10px 40px rgba(0,0,0,0.08);
}

.modulos-completados h3{

    margin-bottom: 20px;

    color: #0f172a;

    font-size: 26px;
}

.modulo-ok{

    padding: 18px 20px;

    margin-bottom: 14px;

    border-radius: 14px;

    background: #ecfdf5;

    color: #166534;

    font-weight: 700;

    border-left: 5px solid #22c55e;

    transition: 0.3s ease;
}

.modulo-ok:hover{

    transform: translateX(5px);

}

.cerrar-modal{
    position:absolute;
    top:15px;
    right:20px;

    font-size:34px;
    font-weight:bold;

    color:#fff;

    cursor:pointer;

    transition:0.3s;
}

.cerrar-modal:hover{
    transform:scale(1.2);
    color:#ff4d4d;
}
</style>

</x-app-layout>

<div id="mensajeMotivacional" class="mensaje">
    🎉 ¡Excelente! Sigue así 💪
</div>

<div id="modalFinal" class="modal-final">
    

    <div class="modal-contenido">

       

        <!-- ICONO -->
        <div class="icono-final">
            🎓
        </div>
<span
            class="cerrar-modal"
            onclick="cerrarModalFinal()">

            &times;

        </span>
        <!-- TÍTULO -->
        <h2>
            ¡Felicidades!
        </h2>

        <!-- MENSAJE -->
        <p>
            Has completado correctamente todos los módulos del curso.
        </p>

        <p>
            Ahora debes realizar la
            <strong>Evaluación Final</strong>
            para habilitar tu certificado y finalizar tu capacitación.
        </p>

        <!-- MÓDULOS COMPLETADOS -->
        <div class="modulos-completados">

            <h3>
                ✅ Módulos completados
            </h3>

            <div class="lista-modulos">

                @foreach($modulos as $modulo)

                    @php

                        $completado = \App\Models\ProgresoModulo::where(

                            'usuario_id',
                            auth()->id()

                        )
                        ->where('modulo_id', $modulo->id)
                        ->where('completado', true)
                        ->exists();

                    @endphp

                    @if($completado)

                        <div class="modulo-ok">

                            <span class="check">
                                ✔
                            </span>

                            <span class="texto-modulo">
                                {{ $modulo->titulo }}
                            </span>

                        </div>

                    @endif

                @endforeach

            </div>

        </div>

        <!-- BOTÓN FORMULARIO -->
 <!-- FORMULARIO FINAL -->
<div
    class="acciones-final"
    id="formularioFinal">

    <!-- IR AL FORMULARIO -->
    <a
        href="https://forms.gle/bynsrkJ5Yh3Z9M2r8"
        target="_blank"
        class="btn-formulario btn-formul">

        📝 Llenar Formulario Final

    </a>

    <!-- BOTON -->
    <button
        type="button"
        class="btn-certificado btn-primary"
        onclick="mostrarOpciones()">

        ✅ Ya llené el formulario

    </button>

</div>



<!-- OPCIONES EXTRA -->
<!-- OPCIONES EXTRA -->
<div
    class="acciones-final acciones-secundarias"
    id="opcionesExtra"
    style="display:none;">

    <!-- BOTON ABRIR MODAL -->
    <button
        type="button"
        class="btn-certificado btn-primary"
        onclick="abrirModalCertificado()">

        <i class="fas fa-file-pdf"></i>
        Generar Certificado

    </button>

    <!-- OTROS CURSOS -->
    <a
        href="{{ route('estudiante.cursos') }}"
        class="btn-certificado btn-secondary">

        <i class="fas fa-book"></i>
        Ver otros cursos

    </a>

</div>

<script>

function generarCertificado(id)
{
    // OBTENER NOMBRE
    let nombre = document.getElementById(
        'nombreCertificado'
    ).value;

    // VALIDAR
    if(nombre.trim() == '')
    {
        alert('Ingrese el nombre');

        return;
    }

    // REDIRECCIONAR
    window.location.href =
        '/certificado/' + id +
        '?nombre=' + encodeURIComponent(nombre);
}

</script>

<!-- MODAL -->
<div
    id="modalCertificado"
    class="modal-certificado">

    <div class="contenido-certificado">

        <!-- CERRAR -->
        <span
            class="cerrar-certificado"
            onclick="cerrarModalCertificado()">

            &times;

        </span>

        <h2>Verificar datos del certificado</h2>

        <!-- FORM -->
      <!-- FORM -->
<form
    id="formCertificado"
    onsubmit="generarCertificado(event, {{ $inscripcion->id }})">

    <!-- NOMBRE -->
    <div class="grupo-form">

        <label>
            Nombre completo
        </label>

        <input
            type="text"
            id="nombre"
            value="{{ auth()->user()->nombre }}"
            required>

    </div>

    <!-- CURSO -->
    <div class="grupo-form">

        <label>
            Nombre del curso
        </label>

        <input
            type="text"
            id="curso"
            value="{{ $inscripcion->curso->titulo }}"
            required>

    </div>

    <!-- BOTON -->
    <button
        type="submit"
        class="btn-certificado btn-primary">

        Descargar Certificado

    </button>

</form>

<script>

function cerrarModalFinal()
{
    document.getElementById(
        'modalFinal'
    ).style.display = 'none';
}

</script>

<script>

function generarCertificado(event, id)
{
    // EVITAR RECARGA
    event.preventDefault();

    // OBTENER VALORES
    let nombre = document.getElementById(
        'nombre'
    ).value;

    let curso = document.getElementById(
        'curso'
    ).value;

    // VALIDAR
    if(nombre.trim() == '')
    {
        alert('Ingrese el nombre');

        return;
    }

    // REDIRECCIONAR
    window.location.href =
        '/certificado/' + id +
        '?nombre=' + encodeURIComponent(nombre) +
        '&curso=' + encodeURIComponent(curso);
}

</script>

    </div>

</div>



<style>

.modal-certificado{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.7);
    z-index:9999;

    justify-content:center;
    align-items:center;
}

.contenido-certificado{
    width:90%;
    max-width:500px;

    background:#fff;
    border-radius:20px;

    padding:30px;

    position:relative;

    box-shadow:
        0 10px 30px rgba(0,0,0,0.2);
}

.cerrar-certificado{
    position:absolute;
    top:15px;
    right:20px;

    font-size:32px;
    cursor:pointer;
}

.grupo-form{
    margin-bottom:20px;
}

.grupo-form label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

.grupo-form input{
    width:100%;
    padding:12px;

    border:1px solid #ddd;
    border-radius:10px;
}

</style>



<script>

function abrirModalCertificado()
{
    document.getElementById(
        'modalCertificado'
    ).style.display = 'flex';
}

function cerrarModalCertificado()
{
    document.getElementById(
        'modalCertificado'
    ).style.display = 'none';
}

</script>



<script>

function mostrarOpciones()
{
    // OCULTAR PRIMER BLOQUE
    document.getElementById(
        'formularioFinal'
    ).style.display = 'none';

    // MOSTRAR SEGUNDO BLOQUE
    document.getElementById(
        'opcionesExtra'
    ).style.display = 'flex';
}

</script>

    </div>

</div>

<!--
@foreach($modulos as $modulo)

    <div class="modulo"

         data-modulo-id="{{ $modulo->id }}"

         id="modulo-{{ $loop->index }}">

       ---- contenido--- <p>hola</p>

    </div>

@endforeach
 BOTÓN FORMULARIO -->
     
<script src="https://www.youtube.com/iframe_api"></script>

<script>
let player;
let listaVideos = [];
let indiceActual = 0;

document.addEventListener("DOMContentLoaded", function () {

    listaVideos = Array.from(document.querySelectorAll('.leccion')).map(el => ({
        id: el.dataset.youtube,
        element: el
    }));

    console.log("LISTA COMPLETA:", listaVideos);

    let actualId = listaVideos[0]?.id;

    indiceActual = 0;

});

function siguienteVideo() {

    console.log("Indice actual:", indiceActual);
    console.log("Total videos:", listaVideos.length);

    let siguienteIndex = indiceActual + 1;

    if (siguienteIndex < listaVideos.length) {

        let siguiente = listaVideos[siguienteIndex];

        console.log("Siguiente:", siguiente);

        indiceActual = siguienteIndex;

        if (player && player.loadVideoById) {
            player.loadVideoById(siguiente.id);
        } else {
            console.error("Player no válido");
        }

        marcarActivo();

    } else {
        console.log("CURSO TERMINADO");
        mostrarFinal();
    }
}

function onYouTubeIframeAPIReady() {

    let primerVideo = document.querySelector('.leccion')?.dataset.youtube;

    if (!primerVideo) {
        console.error("No hay video válido");
        return;
    }

    player = new YT.Player('videoPlayer', {
    height: '500',
    width: '100%',
    videoId: primerVideo,
    playerVars: {
       autoplay: 1,

      /*
        controls: 1
        = deja play + pause + fullscreen
        */

        controls: 1,

        /*
        fs: 1
        = permite fullscreen
        */

        fs: 1,

        /*
        rel: 0
        = sin videos relacionados
        */

        rel: 0,

        /*
        modestbranding: 1
        = reduce logo YouTube
        */

        modestbranding: 1,

        /*
        iv_load_policy: 3
        = quita anotaciones
        */

        iv_load_policy: 3,

        /*
        playsinline: 1
        */

        playsinline: 1,

        /*
        disablekb: 1
        = bloquea teclado
        */

        disablekb: 1,

        /*
        cc_load_policy: 0
        = sin subtítulos automáticos
        */

        cc_load_policy: 0
    },
    events: {
        'onReady': onPlayerReady,
        'onStateChange': onPlayerStateChange
    }

    });
}



function onPlayerStateChange(event) {

    console.log("Estado:", event.data);

    if (event.data === YT.PlayerState.ENDED) {

        console.log("VIDEO TERMINADO 🔥");

        marcarComoVisto();
          // mostrar botón replay
        mostrarBotonReplay();

        setTimeout(() => {
            siguienteVideo();
        }, 1500);
    }
}





let intervaloGuardado;

function onPlayerReady(event) {

    // cargar tiempo guardado
    let actual = listaVideos[indiceActual];
    if (!actual) return;

   // fetch(`/progreso/video/${actual.id}`)
    //    .then(res => res.json())
      //   .then(data => {

        //     if (data.segundo > 0) {
       //          player.seekTo(data.segundo, true);
        //     }

      //       player.playVideo();
     //    });

    // guardar progreso cada 5 segundos
    intervaloGuardado = setInterval(() => {
//
     //   if (player && typeof player.getCurrentTime === 'function') {

        //    let segundos = Math.floor(player.getCurrentTime());

           //    fetch('/guardar-tiempo-video', {
           //        method: 'POST',
           //        headers: {
             //          'Content-Type': 'application/json',
             //          'X-CSRF-TOKEN': document.querySelector(
               //          'meta[name="csrf-token"]'
                  //   ).content
            //     },
            //     body: JSON.stringify({
               //      video_id: actual.id,
             //        segundo: segundos
             //    })
         //    });
       //  }

    }, 5000);
}

function mostrarBotonReplay() {

    let replayBtn = document.getElementById("btnReplay");

    if (!replayBtn) return;

    replayBtn.style.display = "inline-block";
}

function reproducirOtraVez() {

    if (player) {
        player.seekTo(0);
        player.playVideo();
    }

    let replayBtn = document.getElementById("btnReplay");

    if (replayBtn) {
        replayBtn.style.display = "none";
    }
}

function marcarComoVisto() {
    let actual = listaVideos[indiceActual];
    if (!actual) return;

    actual.element.classList.add('visto');

    // 👉 cambiar icono a ✔✔
    let icono = actual.element.querySelector('.icono');
    if (icono) {
        icono.textContent = "✔✔";
    }

     // 🔥 guardar en BD
    //fetch('/progreso', {
       // method: 'POST',
    //    headers: {
      //      'Content-Type': 'application/json',
        //    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
     //   },
      //  body: JSON.stringify({
        ///    video_id: actual.id
     //   })
   // });


    // 🔥 AQUÍ
    marcarModuloCompletado(actual.element);

//actualizarProgresoVisual();
    mostrarMensaje();
}



function marcarActivo() {

    document.querySelectorAll('.leccion').forEach(el => {
        el.classList.remove('activo');
    });

    if (listaVideos[indiceActual]) {
        listaVideos[indiceActual].element.classList.add('activo');
    }
}

function mostrarMensaje() {
    let msg = document.getElementById('mensajeMotivacional');

    msg.style.display = 'block';

    setTimeout(() => {
        msg.style.display = 'none';
    }, 1500);
}

function mostrarFinal() {

    let modal = document.getElementById('modalFinal');
    modal.style.display = 'flex';

    const jsConfetti = new JSConfetti();
    jsConfetti.addConfetti();
}





function marcarModuloCompletado(elementoLeccion) {

    const moduloActual = elementoLeccion.closest('.modulo');

    if (!moduloActual) return;

    const total = moduloActual.querySelectorAll('.leccion').length;

    const vistos = moduloActual.querySelectorAll('.leccion.visto').length;

    // SI TERMINÓ TODO EL MÓDULO
    if (total === vistos) {

        // PONER ESTILO COMPLETADO
        moduloActual.classList.add('completado');

        // ID DEL MÓDULO
        const moduloId = moduloActual.dataset.moduloId;
        alert("Módulo completado");

        // GUARDAR EN BASE DE DATOS
        fetch('/guardar-progreso-modulo', {

    method: 'POST',

    headers: {

        'Content-Type': 'application/json',

        'X-CSRF-TOKEN':
        document.querySelector(
            'meta[name="csrf-token"]'
        ).content

    },

    body: JSON.stringify({

        modulo_id: moduloId

    })

})

.then(response => response.json())

.then(data => {

    console.log('Guardado');

})

.catch(error => {

    console.error(error);

});

        // CERRAR MÓDULO ACTUAL
        const actualContainer = moduloActual.querySelector('.lecciones-container');

        if (actualContainer) {

            actualContainer.classList.remove('activo');

        }

        // ABRIR SIGUIENTE MÓDULO
        const siguienteModulo = moduloActual.nextElementSibling;

        if (
            siguienteModulo &&
            siguienteModulo.classList.contains('modulo')
        ) {

            const siguienteContainer = siguienteModulo.querySelector('.lecciones-container');

            if (siguienteContainer) {

                siguienteContainer.classList.add('activo');

            }

        }

    }

}
</script>