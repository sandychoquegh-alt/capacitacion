@include('../css/estudiante/dashboard')
@include('../js/estudiante/dashboard')
<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <br>

<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">

   Panel del Estudiante
</h2>
 
</x-slot>
 <h2 class="text-2xl font-bold">
    Bienvenid@, {{ auth()->user()->nombre }} 
</h2>
<p class="text-gray-500">
    
</p>

 <div class="py-6 px-4 ">

        <!-- KPIs -->
       <div class="bg-white p-5 rounded-xl shadow-md">
    
    <div class="flex gap-3">

       <!-- Cursos inscritos -->
         <div class="flex-1 bg-blue-50 p-4 rounded-lg text-center border border-blue-200"
           style="background: blue;">

           <p class="text-blue-600 text-sm font-medium" style="color:white;">
            Cursos inscritos
           </p>

            <h3 class="text-2xl font-bold text-blue-700" style="color:white;">
             <!-- {{ isset($inscripciones) ? $inscripciones->count() : 0 }}-->

              
                 {{ isset($inscripciones)
    ? $inscripciones->where('estado', 'aprobado')->count()
    : 0 }}
            </h3>

          </div>

        <!-- Completados -->
        <div class="flex-1 bg-green-50 p-4 rounded-lg text-center border border-green-200" style=" background:green; color:white;">
            <p >
    Modulos Completados
</p>

<h3 class="text-2xl font-bold text-green-700">

    {{
        \App\Models\ProgresoModulo::where(
            'usuario_id',
            auth()->id()
        )

        ->where(
            'completado',
            1
        )

        ->count()
    }}

</h3>
        </div>

        <!-- Certificados -->
        <div class="flex-1 bg-purple-50 p-4 rounded-lg text-center border border-purple-200" style=" background:purple; color:white;">
            <p class="text-purple-600 text-sm font-medium">Certificados</p>
            <h3 class="text-2xl font-bold text-purple-700"><h3 class="text-2xl font-bold text-purple-700">

    {{ \App\Models\Certificado::whereHas('inscripcion', function($q){

        $q->where('usuario_id', auth()->id());

    })->count() }}

</h3></h3>
        </div>

    </div>

</div>
<br><br>
      

            <!-- CURSOS -->
<h3 class="text-lg font-semibold mb-4">
    <i class="bi bi-journal-bookmark me-2"></i> Mis Cursos
</h3>

<div class="contenedor">
    @if(isset($inscripciones) && $inscripciones->count())
        <div class="cards">
            @foreach($inscripciones as $inscripcion)
                @php
                    $totalModulos = $inscripcion->curso->modulos->count();

                    $modulosIds = $inscripcion->curso->modulos->pluck('id');

                    $completados = \App\Models\ProgresoModulo::where('usuario_id', auth()->id())
                        ->whereIn('modulo_id', $modulosIds)
                        ->where('completado', true)
                        ->count();
                    $cursoFinalizado = $totalModulos > 0 && $totalModulos == $completados;
                @endphp
                @if(!$cursoFinalizado)
                    <div class="card">
                        {{-- IMAGEN --}}
                        @if($inscripcion->curso && $inscripcion->curso->imagen)

                            <img src="{{ asset('storage/'.$inscripcion->curso->imagen) }}"
                                alt="Imagen del curso"
                                >
                        @else
                         <p>Curso no disponible</p>
                        @endif
                        {{-- TÍTULO --}}
                        <h3>
                            {{ $inscripcion->curso->titulo ?? 'Curso no disponible' }}
                        </h3>
                        {{-- DESCRIPCIÓN --}}
                        <p>
                            {{ $inscripcion->curso->descripcion ?? 'Sin descripción disponible' }}
                        </p>
                        {{-- PRECIO --}}
                        <p>
                            <strong>Precio:</strong>
                            Bs. {{ $inscripcion->curso->precio ?? '0' }}
                        </p>
                        {{-- ESTADO --}}
                        <p>
                            <strong>Estado:</strong>
                            {{ $inscripcion->estado ?? 'Sin estado' }}
                        </p>
                        {{-- PROGRESO --}}
                        
                        {{-- BARRA --}}
                        <div class="barra">
                            <div class="progreso azul"
                                style="width:{{ ($completados * 100) / max($totalModulos,1) }}%;">
                            </div>
                        </div>
                        <br>
                        {{-- BOTÓN --}}
                        <a href="{{ route('estudiante.videos',$inscripcion->curso->id) }}"
                            class="btn azul">
                            ▶ Ver curso
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <p>No tienes cursos inscritos.</p>
    @endif

</div>
<br><br>
<!-- EMPIEZA PARA LOS CURSOS FINALIZADOS -->
<div class="cursos-finalizados">

    <h3 class="text-lg font-semibold mb-4 titulo-finalizados">
        <i class="fa-solid fa-circle-check"></i>
        Cursos Finalizados
    </h3>


        <div class="cards">

            @foreach($inscripciones as $inscripcion)

                @php
                    $totalModulos = $inscripcion->curso->modulos->count();

                    $modulosIds = $inscripcion->curso->modulos->pluck('id');

                    $completados = \App\Models\ProgresoModulo::where(
                        'usuario_id',
                        auth()->id()
                    )
                    ->whereIn('modulo_id',$modulosIds)
                    ->where('completado',true)
                    ->count();

                    $cursoFinalizado =
                        $totalModulos > 0 &&
                        $totalModulos == $completados;
                @endphp


                @if($cursoFinalizado)

                    <div class="card">

                    


                        {{-- TITULO --}}
                        <h3>
                            {{ $inscripcion->curso->titulo }}
                        </h3>

                        {{-- ESTADO --}}
                        <span class="estado-finalizado">
                            <i class="fa-solid fa-check"></i>
                            Curso completado
                        </span>


                        {{-- PROGRESO --}}
                        <div class="barra">

                            <div
                                class="progreso verde"
                                style="width:100%;">
                            </div>

                        </div>


                        <p class="texto-progreso">
                            {{ $completados }}/{{ $totalModulos }}
                            módulos completados
                        </p>
<BR>

                        {{-- BOTONES --}}
                        <div class="acciones-finalizado">

                            <a
                                href="{{ route('estudiante.videos',$inscripcion->curso->id) }}"
                                class="btn azul">

                                ▶Ver Nuevamente

                            </a>
<BR>

                            
                        </div>


                    </div>

                @endif

            @endforeach

        </div>
    

</div>
<!-- ACA TERMINA PARA LA FINALIZACION DE LOS MODULOS -->
<br>
<hr>
<br>
<h3 class="text-lg font-semibold mb-4" style="margin-left:80px;">
   <i class="fa-solid fa-chart-line"></i>    
     Curosos avanzados
</h3> 
<div class="cardst">

@foreach($recientes as $curso)

<div class="cardt">

    <div class="course-card">

        <div class="image-box">

            <img
                src="{{ asset('storage/'.$curso->imagen) }}"
                alt="{{ $curso->titulo }}">

        </div>

        <div class="course-content">
            <h2 class="course-title">
                {{ $curso->titulo }}
            </h2>

            <p class="course-description">
                {{ $curso->descripcion }}
            </p>

            <div class="course-footer">
<button
    type="button"
    class="btn-inscribirse"
    onclick="inscribirse({{ $curso->id }})">

    Inscribirse

</button>

            </div>

        </div>

    </div>

</div>

@endforeach

</div>
<br>
<br>

<!-- MODAL METODO PAGO -->
<div id="modalPago" class="modal">
    <div class="modal-content">
        <!-- HEADER -->
        <div class="modal-header">
            <h3>
                Seleccione método de pago

            </h3>
            <span
                class="close"
                onclick="cerrarModalPago()">
                &times;
            </span>
        </div>
        <!-- BODY -->
        <div class="modal-body">
            <button
    class="btn-metodo"
    onclick="mostrarQR()">
    <i class="fa-solid fa-qrcode"></i>
    Pago por QR

</button>
<button
    class="btn-metodo"
    onclick="mostrarBanco()">
    <i class="fa-solid fa-building-columns"></i>
    Transferencia Bancaria
</button>
        </div>
    </div>
</div>

<!-- MODAL QR -->

<div id="modalQR" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Pago por QR </h3>
            <span class="close" onclick="cerrarModalQR()"> &times;  </span>

        </div>
        <div class="modal-body">
            <img src="{{ asset('img/qr.png') }}" class="img-qr" alt="QR">
            <p> Escanee el QR para realizar el pago.</p>

        </div>
        <form
    id="formComprobanteQR"
    action="{{ route('comprobanteth.enviar') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    <input
        type="hidden"
        name="inscripcion_id"
        id="inscripcion_id_qr">

    <input
        type="hidden"
        name="curso_id"
        id="curso_id_qr">

    <input
        type="file"
        name="comprobante"
        id="comprobanteQR"
        accept="image/*"
        required>

    <img
        id="previewImagenQR"
        src=""
        style="display:none;">

    <p id="textoPreviewQR">
        Vista previa del comprobante
    </p>

    <button type="submit">
        Subir comprobante
    </button>

</form>

    </div>

</div>
<!-- MODAL BANCO -->

<div id="modalBanco" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3> Transferencia Bancaria  </h3>

            <span
                class="close"
                onclick="cerrarModalBanco()">
                &times;
            </span>

        </div>

        <div class="modal-body">

            <div class="datos-banco">

                <p><strong>Banco:</strong>
                    Banco Nacional

                </p>
                <p><strong>Cuenta:</strong>
                    123456789

                </p>
                <p> <strong>Titular:</strong>
                    FUNDACIÓN
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
        <h3> Datos Bancarios</h3>

        <p><strong>Banco:</strong> Banco Nacional</p>

        <p>
            <strong>Cuenta:</strong>
            1234567890 FUNDACION
        </p>

        <p>
            <strong>Monto:</strong>
            Bs <span id="montoBanco"></span>
        </p>

    </div>
    <!-- FORMULARIO -->
<form
    id="formComprobanteBanco"
    action="{{ route('comprobanteth.enviar') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    <input
        type="hidden"
        name="inscripcion_id"
        id="inscripcion_id_banco">

    <input
        type="hidden"
        name="curso_id"
        id="curso_id_banco">

    <input
        type="file"
        name="comprobante"
        id="comprobanteBanco"
        accept="image/*"
        required>

    <img
        id="previewImagenBanco"
        src=""
        style="display:none;">

    <p id="textoPreviewBanco">
        Vista previa del comprobante
    </p>

    <button type="submit">
        Subir comprobante
    </button>

</form>
        </div>

    </div>

</div>
</div>


</x-app-layout>
