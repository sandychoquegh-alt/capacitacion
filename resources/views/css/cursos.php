<style>
/* SLIDE */
.swiper-slide {
  display: flex;
  justify-content: center;
  padding:0px;
  margin:0px;
}
h2{
    padding:20px;

}
/* TARJETA */
.curso-card {
   background: linear-gradient(145deg, #fcfcfc, #ffffff);
  border-radius: 20px;
  overflow: hidden;
  width: 300px;
  border: 1px solid rgba(88, 88, 88, 0.18);
  transition: 0.3s;
}

/* HOVER */
.curso-card:hover {
     transform: translateY(-6px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.4);
}

/* IMAGEN */
.curso-img {

    width:100%;
    height:230px;
    overflow:hidden;
    padding:20px;

}


/* IMAGEN */

.curso-img img {

    width:100%;
    height:100%;
    object-fit:cover;
border-radius:15px;
    display:block;

}
/* BADGE SOBRE IMAGEN */
.badge.nuevo {
    position: absolute;
  top: 10px;
  left: 10px;
  background: #fccd35;
  color: #000;
  font-size: 12px;
  padding: 5px 10px;
  border-radius: 20px;
  font-weight: 600;
}

/* BODY */
.curso-body {
    padding: 15px ;
    color: #080808;
    
}

/* TITULO */
.curso-body h3 {
    font-size: 18px;
  margin-bottom: 8px;
  
}

/* DESCRIPCIÓN */
.descripcion {
    font-size: 14px;
    color: #555;
    margin-bottom: 15px;
    margin:0px;
  padding:0px;
}

.curso-info-extra {
    margin-top: 10px;
    font-size: 14px;
    margin:0px;
  padding:0px;
}

/* PRECIO */
.precio {
    margin-bottom: 5px;
}

.precio-antiguo {
    text-decoration: line-through;
    color: #888;
    margin-right: 8px;
}

.precio-actual {
    color: #fccd35;
  font-weight: bold;
  font-size: 18px;
}

/* OFERTA */
.oferta {
    color: #b91c1c;
    font-size: 13px;
    margin-bottom: 5px;
}

/* BADGE */
.badge.disponible {
    position: absolute;
  top: 10px;
  left: 10px;
  background: #fccd35;
  color: #000;
  font-size: 12px;
  padding: 5px 10px;
  border-radius: 20px;
  font-weight: 600;
}

/* MODALIDAD */
.modalidad {
    margin-top: 5px;
}

/* es son para los iconos*/

.icono {
    width: 16px;
    height: 16px;
    margin-right: 6px;
    vertical-align: middle;
    fill: #1e3a8a;
}

.icono-small {
    width: 14px;
    height: 14px;
    margin-right: 4px;
    fill: white;
}

.icono-btn {
    width: 16px;
    height: 16px;
    margin-right: 6px;
    fill: white;
}

/* TEXTO ALINEADO */
.curso-info-extra p {
    display: flex;
    align-items: center;
    gap: 6px;
    margin:0px;
  padding:0px;
}
/* INFO */
.info {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    margin-bottom: 15px;
    
}

/* BOTÓN */
.curso-botones {
    display: flex;
    justify-content: space-between; /* 👈 separa izquierda/derecha */
    align-items: center;
    gap: 10px;
}

/* BOTONES */
.btn-detalles,
.btn-inscribirse {
    width: auto; /* 👈 importante */
    padding: 10px 15px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* DETALLES */
.btn-detalles {
    background: #e5e7eb;
    border: none;
}

.btn-detalles:hover {
    background: #d1d5db;
}

/* INSCRIBIRSE */
.btn-inscribirse {
    background: linear-gradient(135deg, #4f46e5, #3b82f6);
    color: white;
    border: none;
    transition: 0.3s;
}

.btn-inscribirse:hover {
    transform: scale(1.05);
}
/* VERDE */
.btn-inscribirse.verde {
    background: linear-gradient(135deg, #10b981, #059669);
}
/* ICONOS GENERALES */
.icon {
    width: 16px;
    height: 16px;
    margin-right: 5px;
    vertical-align: middle;
}

/* CONTENEDOR INFO */
.info-item {
    display: flex;
    align-items: center;
    gap: 5px;
}

/* ICONO BOTÓN */
.icon-btn {
    width: 18px;
    height: 18px;
    margin-right: 8px;
}

/* FONDO MODAL */
.modal {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;

    /* SOLO VERTICAL */
    overflow-y: auto;
    overflow-x: hidden;
    /* centrado */
    justify-content: center;
    align-items: center;
    background: rgba(0, 0, 0, 0.6);
}

/* CONTENIDO */
.modal-content {
   background: #fff;
    margin: 80px auto;
    width: 750px;
    max-width: 95%;
    z-index: 50px;
    max-height: 80vh;

    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);

    /* SOLO SCROLL VERTICAL */
    overflow-y: auto;
    overflow-x: hidden;

    animation: fadeIn 0.3s ease;
}

/* HEADER */
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.modal-header h3 {
    margin: 0;
}
.datos{
    margin:10px;
    padding:20px;
}



/* CONTENEDOR GENERAL */
#contenidoDetalles {
    padding: 20px;
}
/* CONTENEDOR HEADER */
.detalle-header {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 5px;
    margin-bottom: 25px;
    align-items: stretch;
}

/* IZQUIERDA */
.detalle-izquierda img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 15px;
    display: block;
}

/* DERECHA */
.detalle-derecha {
    background: #f9fafb;
    border: 2px solid #1e3a8a;
    border-radius: 15px;

    padding: 3px;

    width: 100%;
    min-width: 250px;
    box-sizing: border-box;

    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    
}

.detalle-derecha h4 {
    font-size: 24px;
    font-weight: 700;
    color: #222;
    margin: 0;
}

/* QR */


/* BOTÓN FACEBOOK */
.btn-facebook {
    display: inline-block;
    background: #0d2bff;
    color: white;
    text-decoration: none;
    padding: 12px 35px;
    border-radius: 30px;
    font-size: 16px;
    font-weight: 600;
    transition: 0.3s;
}

.btn-facebook:hover {
    background: #001fc7;
}

/* INFO INFERIOR */
.detalle-info-box {
    display: flex;
    gap: 30px;
    background: #f5f5f5;
    padding: 25px;
    border-radius: 8px;
    align-items: flex-start;
    margin-top: 20px;
}

.info-col {
    flex: 1;
}

.fila-info {
    display: flex;
    gap: 10px;
    margin-bottom: 14px;
    font-size: 15px;
    align-items: flex-start;
    margin:0px;
    padding:0;
    
}

.fila-info strong {
    min-width: 110px;
    color: #111;
    font-weight: 700;
}

.fila-info span {
    color: #333;
    line-height: 1.5;
}

.linea-vertical {
    width: 1px;
    background: #dcdcdc;
    min-height: 250px;
}

.descuento-box span {
    background: #f7f7f7;
    padding: 10px;
    border-radius: 4px;
    display: inline-block;
    color: #5ba84f;
    font-weight: 600;
}

/* COLUMNAS */
.info-col h4 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 18px;
    color: #222;
}

.info-col p {
    font-size: 20px;
    margin: 10px 0;
    color: #333;
}

/* LÍNEA VERTICAL */
.linea-vertical {
    width: 1px;
    min-height: 140px;
    background: #999;
}

/* BOTÓN CERRAR */
.close {
    font-size: 22px;
    cursor: pointer;
}





/* FORM */
.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-size: 14px;
    display: block;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

/* BOTÓN */
.btn-guardar {
    width: 100%;
    padding: 10px;
    background: #1e3a8a;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn-guardar:hover {
    background: #163172;
}

@media (max-width: 480px) {
    .detalle-header {
        grid-template-columns: 1fr;
    }
}


/* HEADER */
.modal-header {
    background: #1e3a8a;
    color: white;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.close {
    cursor: pointer;
    font-size: 22px;
}

/* BODY */
.modal-body {
    padding: 20px;
}

/* IMAGEN */
.detalle-img {
    width: 100%;
    border-radius: 8px;
    margin-bottom: 15px;
}

/* GRID */
.detalle-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin:10px;
    padding:20px ;
}

.detalle-col p {
    margin-bottom: 10px;
}

/* PRECIO */
.tachado {
    text-decoration: line-through;
    color: gray;
}

.oferta {
    color: #16a34a;
    font-weight: bold;
}

/* BADGE */
.badge {
    display: inline-block;
    background: #16a34a;
    color: white;
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 12px;
}

/* FOOTER */
.modal-footer {
    padding: 15px;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    border-top: 1px solid #eee;
}

/* BOTONES */
.btn-secundario {
    background: #e5e7eb;
    border: none;
    padding: 8px 15px;
    border-radius: 6px;
    cursor: pointer;
}

.btn-principal {
    background: #1e3a8a;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 6px;
    cursor: pointer;
}

.btn-principal:hover {
    background: #162d6b;
}

/* ANIMACIÓN */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(-20px);}
    to {opacity: 1; transform: translateY(0);}
}


/* NOTA */
.nota {
    font-size: 13px;
    color: #777;
    margin-bottom: 10px;
}

/* CI EN FILA */
.ci-group {
    display: flex;
    gap: 10px;
}

.ci-group input {
    flex: 2;
}

.ci-group select {
    flex: 1;
}

/* INPUTS */
.form-group input,
.form-group select {
    width: 100%;
    padding: 9px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

/* CHECKBOX */
.checkbox {
    display: flex;
    align-items: center;
    gap: 8px;
}
.checkbox input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #1e3a8a; /* azul institucional */
    cursor: pointer;
}

/* ERROR */
.error {
    color: red;
    font-size: 12px;
}

/* ANIMACIÓN */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(-20px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>

<style>

.preview-container{
    margin-top:20px;
}

.label-file{
    display:block;
    margin-bottom:10px;
    font-weight:700;
    color:#111827;
}

#comprobante{
    width:100%;
    border:2px dashed #cbd5e1;
    padding:18px;
    border-radius:12px;
    background:#f8fafc;
    cursor:pointer;
    transition:0.3s;
}

#comprobante:hover{
    border-color:#0d6efd;
    background:#eff6ff;
}

/* BOX PREVIEW */
.preview-box{
    margin-top:20px;
    border:1px solid #e5e7eb;
    border-radius:16px;
    padding:15px;
    background:white;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

/* IMAGEN */
#previewImagen{
    width:50%;
    max-height:400px;
    object-fit:contain;
    border-radius:12px;
    display:none;
    border:1px solid #d1d5db;
    
}

/* TEXTO */
#textoPreview{
    color:#6b7280;
    margin-top:10px;
    font-size:14px;
}



.icono-check{
    width:90px;
    height:90px;
    background:linear-gradient(135deg,#16a34a,#22c55e);
    color:white;
    font-size:45px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    margin:0 auto 25px;
    box-shadow:
        0 10px 25px rgba(34,197,94,0.35),
        0 0 0 10px rgba(34,197,94,0.08);
    
    animation:zoomIcon 0.6s ease;
}

/* ANIMACION */
@keyframes zoomIcon{

    0%{
        transform:scale(0.5);
        opacity:0;
    }

    100%{
        transform:scale(1);
        opacity:1;
    }

}

/* TITULO */
.datos h2{
    text-align:center;
    color:#111827;
    margin-bottom:25px;
    font-size:30px;
    font-weight:700;
}

/* ALERTA */
.alerta-importante{
    background:#fff7ed;
    border-left:5px solid #f97316;
    padding:18px;
    border-radius:12px;
    margin-bottom:25px;
}

.alerta-importante strong{
    display:block;
    color:#ea580c;
    margin-bottom:8px;
    font-size:16px;
}

.alerta-importante p{
    color:#444;
    line-height:1.6;
    margin:0;
}

/* TITULO SECCION */
.titulo-seccion{
    background:#0d6efd;
    color:white;
    text-align:center;
    padding:14px;
    border-radius:12px;
    font-size:18px;
    font-weight:700;
    margin-bottom:25px;
}

/* CARDS */
.card-info{
    background:#f9fafb;
    border:1px solid #e5e7eb;
    padding:20px;
    border-radius:15px;
    margin-bottom:20px;
}

.card-info h3{
    margin-top:0;
    margin-bottom:15px;
    color:#0d6efd;
    font-size:20px;
}

.card-info p{
    margin:10px 0;
    color:#374151;
    font-size:15px;
}

/* REFERENCIA */
.referencia{
    background:#eff6ff;
    border:1px solid #bfdbfe;
}

/* FORM */
#formComprobante{
    margin-top:25px;
    display:flex;
    flex-direction:column;
    gap:15px;
}

.label-file{
    font-weight:700;
    color:#111827;
}

#formComprobante input[type="file"]{
    border:2px dashed #cbd5e1;
    padding:20px;
    border-radius:12px;
    background:#f8fafc;
    cursor:pointer;
}

#formComprobante button{
    background:#16a34a;
    color:white;
    border:none;
    padding:15px;
    border-radius:12px;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
    transition:0.3s;
}

#formComprobante button:hover{
    background:#15803d;
    transform:translateY(-2px);
}

/* MENSAJE */
.mensaje-validacion{
    margin-top:20px;
    background:#fef3c7;
    color:#92400e;
    padding:15px;
    border-radius:12px;
    font-size:14px;
    border:1px solid #fcd34d;
    text-align:center;
}

/* RESPONSIVE */
@media(max-width:768px){

    .datos{
        padding:20px;
        margin:20px;
    }

    .datos h2{
        font-size:24px;
    }

}

</style>

<style>

/* FONDO */
.mensaje-exito{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.65);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:999999;
    padding:20px;
}

/* CARD */
.mensaje-card{
    background:white;
    width:100%;
    max-width:560px;
    border-radius:25px;
    padding:40px;
    text-align:center;
    box-shadow:0 20px 50px rgba(0,0,0,0.2);
    animation:zoomIn .4s ease;
}

/* ICONO */
.icon-success{
    width:95px;
    height:95px;
    margin:0 auto 25px;
    border-radius:50%;
    background:linear-gradient(135deg,#16a34a,#22c55e);
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:48px;
}

/* TITULO */
.mensaje-card h2{
    font-size:32px;
    color:#111827;
    margin-bottom:20px;
}

/* TEXTOS */
.mensaje-card p{
    color:#4b5563;
    line-height:1.8;
    margin-bottom:16px;
    font-size:16px;
}

.gracias{
    font-weight:700;
    color:#111827 !important;
}

/* BOTON */
.mensaje-card button{
    margin-top:15px;
    background:#16a34a;
    color:white;
    border:none;
    padding:15px 35px;
    border-radius:14px;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
    transition:.3s;
}

.mensaje-card button:hover{
    background:#15803d;
    transform:translateY(-2px);
}

/* ANIMACION */
@keyframes zoomIn{

    from{
        transform:scale(.7);
        opacity:0;
    }

    to{
        transform:scale(1);
        opacity:1;
    }

}

</style>







<style>
  .contenedor-cursos {
    display: flex;
    gap: 25px;
    flex-wrap: wrap;
}

.badge-org {
    background: #1e3a8a;
    color: white;
    font-size: 11px;
    padding: 3px 8px;
    border-radius: 5px;
}


/* TEXTOS */
.seguir {
    font-size: 13px;
    color: #555;
}

.organizador {
    font-size: 13px;
    color: #333;
}
/* BOTÓN CERRAR */


/* BOTÓN */
.btn-guardar {
    width: 100%;
    padding: 10px;
    background: #1e3a8a;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn-guardar:hover {
    background: #163172;
}

@media (max-width: 480px) {
    .detalle-header {
        grid-template-columns: 1fr;
    }
}

 ========================= */
/* CONTENEDOR */
/* ========================= */

.acciones-curso{

    width: 100%;

    margin-top: 25px;
}

/* ========================= */
/* BOTÓN BASE */
/* ========================= */

.btn-curso{

    width: 100%;

    min-height: 56px;

    border: none;

    border-radius: 16px;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 10px;

    text-decoration: none;

    font-size: 16px;

    font-weight: 700;

    cursor: pointer;

    transition: all .3s ease;

    padding: 14px 20px;
}

/* ========================= */
/* INSCRIBIRSE */
/* ========================= */

.btn-inscribirse{

    background: linear-gradient(
        135deg,
        #2563eb,
        #1d4ed8
    );

    color: white;

    box-shadow:
        0 10px 30px rgba(37,99,235,.25);
}

.btn-inscribirse:hover{

    transform: translateY(-3px);

    box-shadow:
        0 20px 40px rgba(37,99,235,.35);
}

/* ========================= */
/* PREINSCRITO */
/* ========================= */

.btn-preinscrito{

    background: linear-gradient(
        135deg,
        #f59e0b,
        #d97706
    );

    color: white;

    box-shadow:
        0 10px 30px rgba(245,158,11,.25);
}

.btn-preinscrito:hover{

    transform: translateY(-3px);

    box-shadow:
        0 20px 40px rgba(245,158,11,.35);
}

/* ========================= */
/* PENDIENTE */
/* ========================= */

.btn-pendiente{

    background: #fef3c7;

    color: #92400e;

    cursor: not-allowed;
}

/* ========================= */
/* APROBADO */
/* ========================= */

.btn-aprobado{

    background: linear-gradient(
        135deg,
        #22c55e,
        #16a34a
    );

    color: white;

    box-shadow:
        0 10px 30px rgba(34,197,94,.25);
}

.btn-aprobado:hover{

    transform: translateY(-3px);

    box-shadow:
        0 20px 40px rgba(34,197,94,.35);
}

/* ========================= */
/* RECHAZADO */
/* ========================= */

.btn-rechazado{

    background: #fee2e2;

    color: #991b1b;

    cursor: not-allowed;
}

/* ========================= */
/* RESPONSIVE */
/* ========================= */

@media(max-width:768px){

    .btn-curso{

        font-size: 15px;

        min-height: 52px;
    }
}

</style>
