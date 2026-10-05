<section class="beneficiarios-section reveal">

    <div class="beneficiarios-container">

        <!-- LADO IZQUIERDO -->
        <div class="beneficiarios-content">

            <span class="section-badge">
                Sección Empresarial
            </span>

            @foreach($seccionesEmpresariales as $seccion)
                <h2> {{ $seccion->titulo }} </h2>
                <p>  {{ $seccion->descripcion }}    </p>
                <button  class="btn-beneficiarios"  onclick="abrirModalEmpresas()">
                    Ver más detalles
                </button>

            @endforeach

        </div>
        <!-- LADO DERECHO -->

        <div class="beneficiarios-image">
            @foreach($seccionesEmpresariales as $seccion)
                @if($seccion->imagen)
                    <img src="{{ asset('storage/'.$seccion->imagen) }}"  alt="{{ $seccion->titulo }}">
                @endif
            @endforeach

        </div>
    </div>
</section>


<!-- ====================================== -->
<!-- MODAL DETALLES -->
<!-- ====================================== -->

<div id="modalEmpresas" class="modal-empresas">
    <div class="modal-content-empresas">

        <span class="cerrar-modal-empresas" onclick="cerrarModalEmpresas()">
            &times;
        </span>

        <h3>
            ¿A quiénes apoyamos?
        </h3>

        <p>
            {{ $seccion->texto_boton }}
            Nuestra fundación apoya a pequeñas y medianas empresas,
            startups, emprendedores independientes, instituciones académicas,
            organizaciones sin fines de lucro y proyectos de impacto social.
        </p>

        <p>
            El apoyo se realiza mediante programas de formación especializada,
            consultoría estratégica, acompañamiento en innovación empresarial,
            transformación digital, acceso a redes de colaboración y fortalecimiento institucional.
        </p>

        <p>
            Nuestro objetivo es generar crecimiento sostenible,
            competitividad empresarial y desarrollo social a través
            de soluciones reales y de alto impacto.
        </p>

    </div>
</div>


<style>
/* ====================================== */
/* SECCIÓN BENEFICIARIOS */
/* ====================================== */

.beneficiarios-section {
    padding: 100px 8%;
    background: #ffffff;
}

.beneficiarios-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 70px;
    flex-wrap: wrap;
}

.beneficiarios-content {
    flex: 1;
    min-width: 320px;
}

.section-badge {
    display: inline-block;
    background: #edf4ff;
    color: #0d6efd;
    padding: 8px 18px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 20px;
}

.beneficiarios-content h2 {
    font-size: 42px;
    line-height: 1.3;
    color: #1e293b;
    margin-bottom: 25px;
    font-weight: 700;
}

.beneficiarios-content p {
    font-size: 16px;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 18px;
}

/* BOTÓN */

.btn-beneficiarios {
    margin-top: 25px;
    background: #0d6efd;
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 14px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.btn-beneficiarios:hover {
    background: #0b5ed7;
    transform: translateY(-2px);
}

/* IMAGEN */

.beneficiarios-image {
    flex: 1;
    min-width: 320px;
    text-align: center;
}

.beneficiarios-image img {
    width: 100%;
    max-width: 560px;
    height: clamp(350px, 75vh, 550px);
    border-radius: 24px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
    object-fit: cover;
}

/* ====================================== */
/* MODAL */
/* ====================================== */

.modal-empresas {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    z-index: 9999;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.modal-content-empresas {
    background: white;
    width: 100%;
    max-width: 700px;
    border-radius: 22px;
    padding: 40px;
    position: relative;
    animation: fadeModal 0.3s ease;
}

.modal-content-empresas h3 {
    font-size: 30px;
    margin-bottom: 22px;
    color: #1e293b;
}

.modal-content-empresas p {
    font-size: 16px;
    line-height: 1.8;
    color: #475569;
    margin-bottom: 18px;
}

.cerrar-modal-empresas {
    position: absolute;
    top: 18px;
    right: 25px;
    font-size: 30px;
    cursor: pointer;
    color: #64748b;
}

.cerrar-modal-empresas:hover {
    color: #0d6efd;
}

@keyframes fadeModal {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}



</style>


<script>
function abrirModalEmpresas() {
    document.getElementById("modalEmpresas").style.display = "flex";
}

function cerrarModalEmpresas() {
    document.getElementById("modalEmpresas").style.display = "none";
}

window.addEventListener("click", function(e) {
    const modal = document.getElementById("modalEmpresas");

    if (e.target === modal) {
        modal.style.display = "none";
    }
});
</script>
