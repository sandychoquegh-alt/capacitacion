@include('../css/cursos')
<x-app-layout>
    <br>
hola
    <div class="max-w-5xl mx-auto px-6 py-8">
     <div class="contenedor-cursos">

@foreach($populares as $curso)

    <div class="curso-card">

        <div class="curso-img">
            <img src="{{ asset('storage/' . $curso->imagen) }}" alt="Curso">
            
        </div>

        <div class="curso-body">

            <!-- 🔥 TITULO DINÁMICO -->
            <h1 style="font-size:25px;"><b>{{ $curso->titulo }}</b></h1>

        

            <h5 class="estudiantes" style="font-size: 0.7rem;">
                👥 +{{ $curso->estudiantes ?? 0 }} estudiantes
            </h5>

            <!-- 🔥 DESCRIPCIÓN -->
            <p class="descripcion">
                {{ $curso->descripcion }}
            </p>

            <div class="curso-info-extra">

                <!-- 💰 PRECIO -->
                <p class="precio">
                    <span class="precio-antiguo">Bs {{ $curso->precio_antiguo ?? 0 }}</span>
                    <span class="precio-actual">Bs {{ $curso->precio }}</span>
                </p>

                <!-- 📅 FECHA -->
                <p class="oferta">
                    Promoción válida hasta 
                    <strong>{{ $curso->fecha_fin ?? '---' }}</strong>
                </p>

                <!-- 📌 ESTADO -->
                <p class="estado">
                    <span class="badge disponible">
                        {{ $curso->estado ?? 'DISPONIBLE' }}
                    </span>
                </p>

                <!-- 💻 MODALIDAD -->
                <p class="modalidad">
                    <!-- ICONO COMPUTADORA -->
        <svg class="icono" viewBox="0 0 24 24">
            <path d="M4 4h16v12H4zM2 18h20v2H2z"/>
        </svg>
                    Modalidad: <strong>{{ $curso->modalidad ?? 'Virtual' }}</strong>
                </p>

                <!-- 📱 PAGO -->
                <p class="pago">
                     <!-- ICONO CELULAR -->
        <svg class="icono" viewBox="0 0 24 24">
            <path d="M7 2h10a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm5 18a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
        </svg>
                    Acceso luego de confirmar pago

                    <a href="https://wa.me/{{ $curso->whatsapp ?? '59165467726' }}" 
                       target="_blank"
                       class="btn-contacto"
                       style="color:red; font-size: 0.6rem;">
                        Contactar / Reportar Pago
                    </a>
                </p>

            </div>

            <!-- ⏱ INFO -->
            <div class="info">

                <span class="info-item">
                       <!-- ICONO RELOJ -->
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        <path d="M12 6v6l4 2" stroke-width="2"/>
                    </svg>
                    {{ $curso->duracion ?? '3 horas' }}
                </span>

                <span class="info-item">
                    <!-- ICONO CERTIFICADO -->
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4" stroke-width="2"/>
                        <circle cx="12" cy="12" r="10" stroke-width="2"/>
                    </svg>
                    {{ $curso->certificado ? 'Certificado' : '+ con certificado' }}
                </span>

            </div>

            <!-- 🔘 BOTONES -->
            <div class="curso-botones">

                <button class="btn-detalles" onclick="verDetalles({{ $curso->id }})">
                     <!-- ICONO INFO -->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 1 8 0a8 8 0 0 1 0 16zm.93-11.412-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 .877-.252 1.02-.598l.088-.416c.066-.293.134-.352.428-.352h.451l.082-.38-2.29-.287.082-.38 2.29-.287.082-.38-.45-.083c-.294-.07-.352-.176-.288-.469l.738-3.468c.194-.897-.105-1.319-.808-1.319-.545 0-.877.252-1.02.598l-.088.416c-.066.293-.134.352-.428.352h-.451l-.082.38zM8 4.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                </svg>
                    Ver/Detalles
                </button>

 @php

    $inscripcion = $inscripciones->firstWhere(
        'curso_id',
        $curso->id
    );

@endphp


<div class="acciones-curso">

    {{-- ========================= --}}
    {{-- NO INSCRITO --}}
    {{-- ========================= --}}
    @if(!$inscripcion)

        <button
            class="btn-curso btn-inscribirse"
            onclick="abrirModal({{ $curso->id }})">

            Reali/Pago

        </button>

    {{-- ========================= --}}
    {{-- PREINSCRITO --}}
    {{-- ========================= --}}
    @elseif($inscripcion->estado == 'preinscrito')

        <button
            class="btn-curso btn-preinscrito"
            onclick="abrirModalComprobante({{ $curso->id }})">

            CompletarInscripción

        </button>

    {{-- ========================= --}}
    {{-- EN REVISIÓN --}}
    {{-- ========================= --}}
    @elseif($inscripcion->estado == 'pendiente')

        <button
            class="btn-curso btn-pendiente"
            disabled>

            PagoRevisión

        </button>

    {{-- ========================= --}}
    {{-- APROBADO --}}
    {{-- ========================= --}}
    @elseif($inscripcion->estado == 'aprobado')

        <a
            href="{{ route('estudiante.videos', $curso->id) }}"
            class="btn-curso btn-aprobado">

            ▶VerCurso

        </a>

    {{-- ========================= --}}
    {{-- RECHAZADO --}}
    {{-- ========================= --}}
    @elseif($inscripcion->estado == 'rechazado')

        <button
            class="btn-curso btn-rechazado"
            disabled>

            ❌PagoRecha

        </button>

    @endif

</div>


            </div>

        </div>

    </div>

@endforeach

</div>

    <!-- CURSO -->
   

    </div>



    
</x-app-layout>


@foreach($populares as $curso)
<div id="modalDetalles{{ $curso->id }}" class="modal" style="width: 750px;
   justify-content: center; max-width: 100%;">

    <div class="modal-content" >

        <!-- HEADER -->
        <div class="modal-header">
            <h3>📘 Detalles del Curso</h3>
             <!-- BOTON CERRAR -->
        <span class="close"
              onclick="cerrarModal({{ $curso->id }})">
            &times;
        </span>
        </div>

        
    <div class="detalle-header ">
           <!-- IZQUIERDA (IMAGEN) -->
    <div class="detalle-izquierda col-md-9">
        <img src="{{ asset('storage/' . $curso->imagen) }}" alt="Curso">
    </div>

    <!-- DERECHA (QR + INFO) -->
    <div class="detalle-derecha col-md-3" style="background: #0d2bff;" >

        <img src="{{ asset('storage/' . $curso->imagen) }}" alt="Curso">

        <p class="seguir">Síguenos en Facebook</p>

        <p class="badge-org">ORGANIZADOR</p>
            Organizado por<br>
            <strong>Fundación Hecho en Bolivia</strong>
        </p>

    </div>



            <!-- GRID -->
            <div class="detalle-grid">

                <!-- IZQUIERDA -->
                <div class="detalle-col">

                    <p><strong>Duración:</strong> 24/7 luego de reportar el pago</p>

                    <p><strong>Modalidad:</strong> Virtual</p>

                    <p>
                        <strong>Sitio web:</strong><br>
                        <a href="#">https://cursos.bo/cursoley602</a>
                    </p>

                    <p>
                        <strong>WhatsApp:</strong><br>
                        <a href="https://wa.me/59175025725">75025725</a>
                    </p>

                </div>

                <!-- DERECHA -->
                <div class="detalle-col">

                    <p><strong>Inversión:</strong> <span class="tachado">89 Bs.</span></p>

                    <p class="oferta">
                        <span class="precio-actual">Bs {{ $curso->precio }}</span> hasta el 07/04
                    </p>

                    <p><strong>Pagos:</strong></p>
                    <ul>
                        <li>Banco Unión</li>
                        <li>Tigo Money</li>
                    </ul>

                    <p class="badge">DISPONIBLE AHORA</p>

                </div>

            </div>

        </div>

       

    </div>
   
</div>
 @endforeach


@foreach($populares as $curso)

<!-- MODAL SELECCION -->

<div id="modalInscripcion_{{ $curso->id }}" class="modal" style="display:none;">

    <div class="modal-content">

        <div class="modal-header">

            <h3>Seleccione el método de pago</h3>

            <span class="close"
                  onclick="cerrarModalInscripcion({{ $curso->id }})">
                &times;
            </span>

        </div>

        <div class="datos">

            <form id="formMetodoPago_{{ $curso->id }}">

                @csrf

                <input type="hidden"
                       name="curso_id"
                       value="{{ $curso->id }}">

          

                <div class="form-group">

                    <label>Opción de pago (*)</label>

                    <select
                        name="metodo_pago"
                        id="metodo_pago_{{ $curso->id }}"
                        required>

                        <option value="">
                            Seleccione una opción
                        </option>

                        <option value="qr">
                            Pago por QR
                        </option>

                        <option value="bancaria">
                            Transferencia Bancaria
                        </option>

                    </select>

                </div>

                <button class="btn-inscribirse" type="button"
                        onclick="procesarMetodoPago({{ $curso->id }})">

                    Procesar

                </button>

            </form>

        </div>

    </div>

</div>

<!-- MODAL QR -->
<div id="modalQR_{{ $curso->id }}" class="modal" style="display:none;">

    <div class="modal-content">

        <div class="modal-header">

            <h3>Pago por QR</h3>

            <span class="close"
                  onclick="cerrarModalQR({{ $curso->id }})">

                &times;

            </span>

        </div>

        <div class="datos">

       @if($curso->imgqr)

<img 
    src="{{ asset('storage/' . $curso->imgqr) }}"
    style="width:250px; margin:auto; display:block;"
>

@else

<p style="text-align:center;">
    No hay código QR disponible
</p>

@endif

            <p style="text-align:center; margin-top:20px;">

                Escanee el código QR para realizar el pago.

            </p>

        </div>


        <div class="alerta-importante">
        <strong>AVISO IMPORTANTE</strong>
        <p>
            Para poder ser habilitado y recibir los accesos al curso,
            es necesario subir el comprobante de pago.
        </p>
    </div>

    <!-- TITULO SECCION -->
    <div class="titulo-seccion">
         SUBIR COMPROBANTE DE PAGO
    </div>

    <!-- DATOS BANCARIOS -->
    <div class="card-info">
        

        <p class="oferta">
                        <span class="precio-actual">Bs {{ $curso->precio }}</span> hasta el 07/04
                    </p>

    </div>

  

    <!-- FORMULARIO -->
    <!-- FORMULARIO -->
<form
    class="formComprobante"
    enctype="multipart/form-data">

    @csrf

   
<input
    type="hidden"
    name="curso_id"
    value="{{ $curso->id }}">


    <div class="preview-container">

        <div class="preview-box">

            <img id="previewImagen"
                 src=""
                 alt="Vista previa">

            <p id="textoPreview">
                Vista previa del comprobante
            </p>

        </div>

        <!-- LABEL -->
        <label class="label-file">
            Seleccionar comprobante
        </label>

        <!-- FILE -->

        
        <input
            type="file"
            name="comprobante"
            id="comprobante"
            accept="image/*"
            required>

        <!-- ERROR -->
        <small id="errorComprobante"
               style="color:red; display:none; margin-top:8px;">
        </small>

    </div>

    <!-- BOTON -->
    <button type="submit" class="btn-inscribirse">

        Subir Comprobante

    </button>

</form>

    <!-- MENSAJE -->
    <div class="mensaje-validacion">
        ⚠️ Tu pago será validado manualmente por el administrador.
    </div>

    </div>


    </div>

</div>

<!-- MODAL BANCARIO -->
<div id="modalBanco_{{ $curso->id }}" class="modal" style="display:none;">

    <div class="modal-content">

        <div class="modal-header">

            <h3>Transferencia Bancaria</h3>

            <span class="close"
                  onclick="cerrarModalBanco({{ $curso->id }})">

                &times;

            </span>

        </div>

        <div class="alerta-importante">
        <strong>AVISO IMPORTANTE</strong>
        <p>
            Para poder ser habilitado y recibir los accesos al curso,
            es necesario subir el comprobante de pago.
        </p>
    </div>

    <!-- TITULO SECCION -->
    <div class="titulo-seccion">
         SUBIR COMPROBANTE DE PAGO
    </div>

    <!-- DATOS BANCARIOS -->
    <div class="card-info">
        <h3> Datos Bancarios</h3>

        <p><strong>Banco:</strong> Banco Nacional</p>

        <p>
            <strong>Cuenta:</strong>
            1234567890 FUNDACION
        </p>

       <p class="oferta">
        <span class="precio-actual">Bs {{ $curso->precio }}</span> hasta el 07/04
        </p>

    </div>

  

    <!-- FORMULARIO -->
    <!-- FORMULARIO -->
<form
    class="formComprobante"
    enctype="multipart/form-data">

    @csrf

   
<input
    type="hidden"
    name="curso_id"
    value="{{ $curso->id }}">


    <div class="preview-container">

        <div class="preview-box">

            <img id="previewImagen"
                 src=""
                 alt="Vista previa">

            <p id="textoPreview">
                Vista previa del comprobante
            </p>

        </div>

        <!-- LABEL -->
        <label class="label-file">
            Seleccionar comprobante
        </label>

        <!-- FILE -->

        
        <input
            type="file"
            name="comprobante"
            id="comprobante"
            accept="image/*"
            required>

        <!-- ERROR -->
        <small id="errorComprobante"
               style="color:red; display:none; margin-top:8px;">
        </small>

    </div>

    <!-- BOTON -->
    <button type="submit" class="btn-inscribirse">

        Subir Comprobante

    </button>

</form>

    <!-- MENSAJE -->
    <div class="mensaje-validacion">
        ⚠️ Tu pago será validado manualmente por el administrador.
    </div>

    </div>

</div>

@endforeach

<script>
function abrirModal(cursoId){
    document.getElementById('modalInscripcion_' + cursoId).style.display = 'block';
}

function abrirModalComprobante(cursoId){
    document.getElementById('modalComprobante_' + cursoId).style.display = 'block';
}

// ✅ Cerrar inscripción
function cerrarModalInscripcion(cursoId){
    document.getElementById('modalInscripcion_' + cursoId).style.display = 'none';
}

// ✅ Cerrar comprobante
function cerrarModalComprobante(cursoId){
    document.getElementById('modalComprobante_' + cursoId).style.display = 'none';
}
</script>
<script>

function verDetalles(id) {

    // CERRAR TODOS
    let modales = document.querySelectorAll('.modal');

    modales.forEach(modal => {
        modal.style.display = 'none';
    });

    // ABRIR SOLO UNO
    document.getElementById('modalDetalles' + id).style.display = 'block';
}

function cerrarModal(id) {
    document.getElementById('modalDetalles' + id).style.display = 'none';
}

</script>

<script>





function cerrarDetalles() {
    document.getElementById("modalDetalles").style.display = "none";
}

// CERRAR MODAL QR

function cerrarModalQR(cursoId){

    document.getElementById(

        'modalQR_' + cursoId

    ).style.display = 'none';
}
// CERRAR MODAL COMPROBANTE
function cerrarModalBanco(cursoId){

    document.getElementById(

        'modalBanco_' + cursoId

    ).style.display = 'none';
}

</script>

<script>

// PREVIEW
const inputFile =
    document.getElementById('comprobante');

const previewImagen =
    document.getElementById('previewImagen');

const textoPreview =
    document.getElementById('textoPreview');

// CAMBIO FILE
inputFile.addEventListener('change', function(e){

    const archivo = e.target.files[0];

    if(!archivo) return;

    // VALIDAR IMAGEN
    const tiposPermitidos = [
        'image/png',
        'image/jpeg',
        'image/jpg',
        'image/webp'
    ];

    // ERROR
    const error =
        document.getElementById('errorComprobante');

    // SI NO ES IMAGEN
    if(!tiposPermitidos.includes(archivo.type)){

        error.style.display = 'block';

        error.innerHTML =
            'Solo se permiten imágenes PNG, JPG o WEBP';

        inputFile.value = '';

        previewImagen.style.display = 'none';

        return;
    }

    // MAXIMO 5MB
    if(archivo.size > 5 * 1024 * 1024){

        error.style.display = 'block';

        error.innerHTML =
            'La imagen no debe superar los 5MB';

        inputFile.value = '';

        previewImagen.style.display = 'none';

        return;
    }

    // LIMPIAR ERROR
    error.style.display = 'none';

    // PREVIEW
    const reader = new FileReader();

    reader.onload = function(event){

        previewImagen.src = event.target.result;

        previewImagen.style.display = 'block';

        textoPreview.innerHTML =
            '✅ Imagen seleccionada correctamente';

    };

    reader.readAsDataURL(archivo);

});

// ENVIAR FORM

// =========================
// PROCESAR INSCRIPCIÓN
// =========================

// ===============================
// PROCESAR MÉTODO PAGO
// ===============================

function procesarMetodoPago(cursoId){

    // SELECT
    const metodo = document.getElementById(
        'metodo_pago_' + cursoId
    ).value;

    // VALIDAR
    if(!metodo){

        alert(
            'Seleccione un método de pago'
        );

        return;
    }

    // CERRAR MODAL PRINCIPAL
    cerrarModalInscripcion(cursoId);

    // =========================
    // ABRIR QR
    // =========================

    if(metodo === 'qr'){

        document.getElementById(
            'modalQR_' + cursoId
        ).style.display = 'flex';
    }

    // =========================
    // ABRIR BANCARIA
    // =========================

    if(metodo === 'bancaria'){

        document.getElementById(
            'modalBanco_' + cursoId
        ).style.display = 'flex';
    }
}

// ========================================
// SUBIR COMPROBANTE + CREAR INSCRIPCIÓN
// ========================================

document.querySelectorAll('.formComprobante')

.forEach(form => {

    form.addEventListener('submit', function(e){

        e.preventDefault();

        // FORM DATA
        const formData = new FormData(this);

        // DEBUG
        console.log(
            formData.get('curso_id')
        );

        console.log(
            formData.get('metodo_pago')
        );

        // BOTÓN
        const boton =
            this.querySelector('button');

        boton.disabled = true;

        boton.innerHTML =
            'Procesando...';
 
        // FETCH
        fetch('/comprobante/enviar', {

            method: 'POST',

            body: formData,

            headers: {

                'X-CSRF-TOKEN':
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,

                'Accept': 'application/json'
            }

        })

        .then(async response => {

            const data = await response.json();

            if(!response.ok){

                throw data;
            }

            return data;
        })

        .then(data => {

            if(!data.success){

                alert(
                    data.message ||
                    'Error al enviar'
                );

                return;
            }

            alert(
                '✅ Comprobante enviado correctamente'
            );

            location.reload();

        })

        .catch(error => {

            console.error(error);

            alert(
                error.message ||
                'Error del servidor'
            );

        })

        .finally(() => {

            boton.disabled = false;

            boton.innerHTML =
                'Subir Comprobante';

        });

    });

});
</script>
