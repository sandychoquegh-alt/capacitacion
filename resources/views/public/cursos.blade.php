@include('../css/cursos')
@include('../js/cursos')
<section id="cursos">
    <br><br>
    <h2 style="margin-lift:10px;">
        Cursos destacados
    </h2>
    <div class="max-w-5xl mx-auto px-6 py-8">
        <div class="swiper cursosSwiper">
            <div class="swiper-wrapper">
                @if(isset($cursos) && $cursos->count())
                    @foreach($cursos as $curso)
                        <div class="swiper-slide">
                            <div class="curso-card">
                                <!-- IMAGEN -->
                                <div class="curso-img">
                                    <img src="{{ asset('storage/' . $curso->imagen) }}" alt="Curso">
                                </div>
                                <!-- CUERPO -->
                                <div class="curso-body">
                                    <!-- TÍTULO -->
                                    <h3 style="font-size:25px;">
                                        <b>{{ $curso->titulo }}</b>
                                    </h3>
                                    <!-- DESCRIPCIÓN -->
                                    <p class="descripcion" style="color:;">
                                        {{ $curso->descripcion }}
                                    </p>
                                    <!-- PRECIO -->
                                    <div class="curso-info-extra">
                                        <p class="precio">
                                            <span class="precio-actual">
                                                Bs {{ $curso->precio }}
                                            </span>
                                        </p>
                                        <!-- PAGO -->
                                        <p class="pago">
                                            <svg class="icono" viewBox="0 0 24 24">
                                                <path d="M7 2h10a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm5 18a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                            </svg>
                                            Acceso luego de confirmar pago
                                        </p>
                                    </div>
                                    <!-- INFORMACIÓN -->
                                    <div class="info">
                                        <span class="info-item">
                                            <svg class="icon" fill="none" stroke="currentColor"  viewBox="0 0 24 24">
                                                <circle cx="12" cy="12"  r="10" stroke-width="2"/>
                                                <path  d="M12 6v6l4 2" stroke-width="2"/>
                                            </svg>
                                            {{ $curso->duracion ?? '3 horas' }}
                                        </span>
                                        <span class="info-item">
                                            <svg  class="icon"  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M9 12l2 2 4-4" stroke-width="2"/>
                                                <circle  cx="12"cy="12" r="10" stroke-width="2"/>
                                            </svg>
                                            {{ $curso->certificado ? 'Certificado' : '+ con certificado' }}
                                        </span>
                                    </div>
                                    <!-- BOTONES -->
                                    <div class="curso-botones">
                                        <!-- VER DETALLES -->
                                        <button class="btn-detalles" onclick="verDetalles({{ $curso->id }})">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor"  viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 1 8 0a8 8 0 0 1 0 16zm.93-11.412-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 .877-.252 1.02-.598l.088-.416c.066-.293.134-.352.428-.352h.451l.082-.38-2.29-.287.082-.38 2.29-.287.082-.38-.45-.083c-.294-.07-.352-.176-.288-.469l.738-3.468c.194-.897-.105-1.319-.808-1.319-.545 0-.877.252-1.02.598l-.088.416c-.066.293-.134.352-.428.352h-.451l-.082.38zM8 4.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                            </svg>
                                            Ver/Detalles
                                        </button>
                                        @php
                                            $inscripcion = $inscripciones[$curso->id] ?? null;
                                        @endphp
                                        @if(!$inscripcion)

                                            <!-- NO INSCRITO -->
                                            <button class="btn-inscribirse" onclick="abrirModalPreinscripcion({{ $curso->id }})">
                                                Inscribirse
                                            </button>
                                        @elseif($inscripcion->estado == 'preinscrito')
                                            <!-- CONTINUAR INSCRIPCIÓN -->
                                            <button class="btn-inscribirse pendiente" onclick="abrirModalPago({{ $curso->id }})">
                                                Continuar inscripción
                                            </button>
                                        @elseif($inscripcion->estado == 'pago_en_revision')
                                            <!-- EN REVISIÓN -->
                                            <button  class="btn-inscribirse" disabled>
                                                Pago en revisión
                                            </button>
                                        @elseif($inscripcion->estado == 'verificado')
                                            <!-- INSCRITO -->
                                            <button class="btn-inscribirse activo" disabled>
                                                Inscrito
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No hay cursos disponibles</p>
                @endif
            </div>
            <!-- FLECHAS -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

    
   @if(isset($cursos) && $cursos->count())
    @foreach($cursos as $curso)
        <!-- MODAL DETALLES -->
        <div id="modalDetalles_{{ $curso->id }}" class="modal" style="display:none;">
            <div class="modal-content">
                <!-- HEADER -->
                <div class="modal-header">
                    <h3>Detalles del Curso</h3>
                    <span class="close" onclick="cerrarDetalles({{ $curso->id }})">&times;</span>
                </div>
                <!-- CONTENIDO -->
                <div id="contenidoDetalles_{{ $curso->id }}">
                    <div class="detalle-header">
                        <!-- IZQUIERDA -->
                        <div class="detalle-izquierda">
                            <img src="{{ asset('storage/' . $curso->imagen) }}" alt="Curso">
                            <p class="descripcion" style="color:;">
                                {{ $curso->descripcion }}
                            </p>
                        </div>
                        <!-- DERECHA -->
                        <div class="detalle-derecha">
                            <h4>Lanzo por </h4>
                            <img src="{{ asset('img/FHB PNG.png') }}" alt="QR Facebook" class="qr-img">
                            <a href="https://www.facebook.com/FundacionHechoBolivia/" 
   target="_blank" 
   rel="noopener noreferrer"
   class="btn-facebook">
    Facebook
</a>
                        </div>
                    </div>
                    <div class="detalle-info-box">
                        <!-- COLUMNA IZQUIERDA -->
                        <div class="info-col">
                            <div class="fila-info">
                                <strong>Duración</strong>
                                <span>: 24/7 en su tiempo libre</span>
                            </div>
                            <div class="fila-info">
                                <strong>Modalidad</strong>
                                <span>: Virtual</span>
                            </div>
                            <div class="fila-info">
                                <strong>Sitio web</strong>
                                <span>: <a href="http://127.0.0.1:8000/">http://127.0.0.1:8000/</a></span>
                            </div>
                            <div class="fila-info">
                                <strong>Whatsapp</strong>
                                <span>: <a href="https://wa.me/59167467726" target="_blank">67467726</a></span>
                            </div>
                        </div>
                        <!-- LÍNEA DIVISORIA -->
                        <div class="linea-vertical"></div>
                        <!-- COLUMNA DERECHA -->
                        <div class="info-col">
                            <div class="fila-info">
                                <strong>Inversión</strong>
                                <span>: {{ $curso->precio }} Bs.</span>
                            </div>
                            <div class="fila-info descuento-box">
                                <strong>Descuento</strong>
                                <span>
                                    POR PAGO ANTICIPADO <br>
                                    Inversión: 89 Bs. hasta el Martes 28 de Abril
                                </span>
                            </div>
                            <div class="fila-info">
                                <strong>Pagos</strong>
                                <span>: Banco UNION cuenta 10000035417258</span>
                            </div>
                            <div class="fila-info">
                                <strong></strong>
                                <span>: Titular FUNDACION (representante Fundacion Hecho)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FOOTER -->
                <div class="modal-footer">
                    <button class="btn-secundario" onclick="cerrarDetalles({{ $curso->id }})">
                        Cerrar
                    </button>
                    <!-- FOOTER boton de detalles -->
                    @php
                        $inscripcion = $inscripciones[$curso->id] ?? null;
                    @endphp
                    @if(!$inscripcion)
                        <!-- NO inscrito -->
                        <button
                            class="btn-inscribirse"
                            onclick="abrirModalPreinscripcion({{ $curso->id }})">
                            Inscribirse
                        </button>
                    @elseif($inscripcion->estado == 'preinscrito')
                        <!-- ya registrado pero no pagó -->
                        <button
                            class="btn-inscribirse pendiente"
                            onclick="abrirModalPago({{ $curso->id }})">
                            Continuar inscripción
                        </button>
                    @elseif($inscripcion->estado == 'pago_en_revision')
                        <!-- esperando validación -->
                        <button class="btn-inscribirse" disabled>
                            Pago en revisión
                        </button>
                    @elseif($inscripcion->estado == 'verificado')
                        <!-- ya pagó -->
                        <button class="btn-inscribirse activo" disabled>
                            Inscrito
                        </button>
                    @endif
                    <!-- FOOTER termina -->
                </div>
            </div>
        </div>
    

        <!-- MODAL INSCRIPCIÓN -->
<div id="modalInscripcion_{{ $curso->id }}" class="modal" style="display:none;">
    <div class="modal-content">
        <!-- HEADER -->
        <div class="modal-header">
            <h3>Datos para el certificado</h3>
            <span class="close" onclick="cerrarModalInscripcion({{ $curso->id }})">
                &times;
            </span>
        </div>
        <!-- CONTENIDO -->
        <div class="datos">
            <p> Ingresa los datos del participante que tomará el curso, estos datos también se utilizarán para la emisión del certificado.</p>
            @if ($errors->any())
                <div style="color:red; padding:10px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- FORMULARIO -->
            <form  id="formInscripcion_{{ $curso->id }}" action="{{ route('inscripcion.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- CURSO -->
                <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                <p class="nota">
                    Los datos con (*) son obligatorios
                </p>
                <!-- CI -->
                <div class="form-group">
                    <label>C.I. (*)</label>
                    <input type="text" name="ci" placeholder="Ej: 4354646" required>
                </div>
                <!-- NOMBRES -->
                <div class="form-group">
                    <label>Nombres (*)</label>
                    <input  type="text"  name="nombres" placeholder="Nombres..." required>
                </div>
                <!-- APELLIDOS -->
                <div class="form-group">
                    <label>Apellidos (*)</label>
                    <input type="text" name="apellido"  placeholder="Apellidos..." required>
                </div>
                <!-- PREFIJO -->
                <div class="form-group">
                    <label>Prefijo</label>
                    <input type="text" name="prefijo" placeholder="Lic. / Ing. / Dr.">
                </div>
                <!-- CORREO -->
                <div class="form-group">
                    <label>Correo (*)</label>
                    <input type="email" name="email" id="correo_{{ $curso->id }}" placeholder="Correo..."   required>
                </div>
                <!-- CELULAR -->
                <div class="form-group">
                    <label>Celular (*)</label>
                    <input type="text" name="telefono" placeholder="Ej: 70000000" required>
                </div>
                <!-- DEPARTAMENTO -->
                <div class="form-group">
                    <label>Departamento</label>
                    <select name="departamento">
                        <option value="La Paz">La Paz</option>
                        <option value="Cochabamba">Cochabamba</option>
                        <option value="Santa Cruz">Santa Cruz</option>
                        <option value="Oruro">Oruro</option>
                        <option value="Potosí">Potosí</option>
                        <option value="Tarija">Tarija</option>
                        <option value="Beni">Beni</option>
                        <option value="Pando">Pando</option>
                        <option value="Chuquisaca">Chuquisaca</option>
                    </select>
                </div>
                <!-- MÉTODO DE PAGO -->
                <div class="form-group">
                    <label>Opción de pago (*)</label>
                    <select
                        name="metodo_pago"
                        required>

                        <option value="">Seleccione una opción</option>
                        <option value="qr">Pago por QR</option>
                        <option value="bancaria">Transferencia Bancaria</option>
                    </select>
                </div>
                <!-- BOTÓN -->
                <button type="submit" class="btn-register">
                    Registrarme e inscribirme
                </button>
            </form>
        </div>
    </div>
</div>
@endforeach
@else
    <p>No hay cursos disponibles</p>
@endif


@if(isset($cursos) && $cursos->count())

    @foreach($cursos as $curso)

        <!-- MODAL BANCO -->
        <div id="modalBanco" class="modal">
            <div class="modal-content">
                <!-- HEADER -->
                <div class="modal-header">
                    <p>
                        <strong>Curso: {{ $curso->titulo }}</strong>
                        <span id="cursoNombreBanco"></span>
                    </p>
                    <span class="close" onclick="cerrarModalInscripcion({{ $curso->id }})">
                        &times;
                    </span>
                </div>
                <!-- CONTENIDO -->
                <div class="datos">
                    <!-- ICONO -->
                    <div class="icono-check">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <!-- TITULO -->
                    <h2>¡Registro realizado correctamente!</h2>
                    <!-- ALERTA -->
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
                        <h3>Datos Bancarios</h3>
                        <p> <strong>Banco:</strong> Banco Nacional</p>
                        <p><strong>Cuenta:</strong>  1234567890 FUNDACION</p>
                        <p> <strong>Monto:</strong>  <span>: {{ $curso->precio }} Bs.</span> </p>
                        <p> <strong>Tipo:</strong> Cuenta Corriente  </p>
                    </div>
                    <!-- REFERENCIA -->
                    <div class="card-info referencia">
                        <h3>Referencia de Inscripción</h3>
                        <p> <strong>Referencia:</strong> INS-<span id="refBanco">{{ $curso->id }}</span> </p>
                    </div>
                    <!-- FORMULARIO -->
                    <form  id="formComprobante" action="{{ route('comprobantes.enviar') }}"  method="POST"  enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="inscripcion_id" id="inscripcion_id">
                        <input  type="hidden" name="curso_id" id="curso_id">
                        <div class="preview-container">
                            <!-- PREVISUALIZACION -->
                            <div class="preview-box">
                                <img id="previewImagen" src="" alt="Vista previa">
                                <p id="textoPreview">
                                    Vista previa del comprobante
                                </p>
                            </div>
                            <label class="label-file">
                                Seleccionar comprobante
                            </label>
                            <input  type="file" name="comprobante"  id="comprobante" accept="image/*" required>
                        </div>
                        <button type="submit">
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
        <!-- MODAL QR -->
        <div id="modalQR" class="modal">
            <div class="modal-content">
                <!-- HEADER -->
                <div class="modal-header">
                    <p> <strong>Curso:</strong> <span>{{ $curso->titulo }}</span> </p>
                    <span class="close" onclick="cerrarModalInscripcion({{ $curso->id }})">
                        &times;
                    </span>
                </div>
                <!-- CONTENIDO -->
                <div class="datos">
                    <!-- TITULO -->
                    <h2>¡Registro realizado correctamente!</h2>
                    <!-- ALERTA -->
                    <div class="alerta-importante">
                        <strong>AVISO IMPORTANTE</strong>
                        <p> Para poder ser habilitado y recibir los accesos al curso,  es necesario subir el comprobante de pago.</p>
                    </div>
                    <img src="{{ asset('storage/' . $curso->imgqr) }}" alt="Curso">
                    <!-- TITULO SECCION -->
                    <div class="titulo-seccion">
                        SUBIR COMPROBANTE DE PAGO
                    </div>
                    <p id="monto">
                        {{ $curso->precio }}
                    </p>
                </div>
                <!-- FORMULARIO -->
                <form  id="formComprobanteQR" action="{{ route('comprobantes.enviar') }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="inscripcion_id" id="inscripcion_id_qr">
                    <input type="hidden" name="curso_id"
                        id="curso_id_qr">
                    <div class="preview-container">
                        <!-- PREVISUALIZACION -->
                        <div class="preview-box">
                            <img  id="previewImagent" src="" alt="Vista previa">
                            <p id="textoPreviewt">
                                Vista previa del comprobante
                            </p>
                        </div>
                        <label class="label-file">
                            Seleccionar comprobante
                        </label>
                        <input type="file" name="comprobante" id="comprobantet"  accept="image/*" required>
                    </div>
                    <button type="submit">
                        Subir comprobante
                    </button>
                </form>
                <!-- MENSAJE -->
                <div class="mensaje-validacion">
                    ⚠️ Tu pago será validado manualmente por el administrador.
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>No hay cursos disponibles</p>
@endif


