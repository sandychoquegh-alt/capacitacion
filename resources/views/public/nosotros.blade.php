
@if($sobreNosotros->count())

@php
    $sobre = $sobreNosotros->first();
@endphp

<section id="nosotros" class="nosotros-section reveal">

    <div class="nosotros-container">

        <!-- LADO IZQUIERDO -->
        <div class="nosotros-content">
            <span class="section-tag">
                Sobre Nosotros
            </span>
            <h2>  {{ $sobre->titulo }}</h2>
            <p>{{ $sobre->descripcion }}  </p>

            <!-- BOTONES -->
            <div class="nosotros-buttons">
                <button  onclick="abrirModal('mision')" class="btn-mision">
                    Misión
                </button>
                <button  onclick="abrirModal('vision')" class="btn-vision">
                    Visión
                </button>
            </div>

        </div>

        <!-- LADO DERECHO -->

        <div class="nosotros-image">
            @if($sobre->imagen)
                <img src="{{ asset('storage/'.$sobre->imagen) }}"  alt="{{ $sobre->titulo }}">
            @else
                <img src="{{ asset('img/descarga1.jpg') }}" alt="Nosotros">
            @endif
        </div>

    </div>

</section>

@endif
<div id="modalNosotros" class="modal-nosotros">
    <div class="modal-content-nosotros">
        <span class="cerrar-modal" onclick="cerrarModal()">
            &times;
        </span>
        <h3 id="tituloModal"></h3>
        <p id="contenidoModal"></p>
    </div>
</div>

<script>
function abrirModal(tipo){
    const modal = document.getElementById("modalNosotros");
    if(tipo == "mision"){
        document.getElementById("tituloModal").innerHTML = "Nuestra Misión";
        document.getElementById("contenidoModal").innerHTML =
            @json($sobre->mision);
    }
    if(tipo == "vision"){
        document.getElementById("tituloModal").innerHTML = "Nuestra Visión";
        document.getElementById("contenidoModal").innerHTML =
            @json($sobre->vision);
    }
    modal.style.display = "flex";
}

function cerrarModal(){
    document.getElementById("modalNosotros").style.display = "none";
}

window.onclick = function(e){
    const modal = document.getElementById("modalNosotros");
    if(e.target == modal){
        cerrarModal();
    }
}
</script>