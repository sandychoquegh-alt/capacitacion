<style>
.contenedor {
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* Contenedor de tarjetas */
.cards {
    display: flex;
    justify-content: center;
    gap: 25px;

}

/* Tarjeta */
.card {
    background: #ffffff;
    width: 20%;
    height: auto;
    padding: 20px;
    border-radius: 22px;
    border: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    transition: 0.3s;
    overflow: hidden;
}
.btn.azul:hover {
    background-color: white;
    color: #eeeaea;
    border-color: white;
}

/* CONTENEDOR DE IMAGEN */
.card img {
    width: 100%;
    height: 120px;       /* Tamaño exacto para todas */
    object-fit: cover;   /* Recorta sin deformar */
    border-radius:10px 10px 0 0;
    display: block;
}

/* Efecto */
.card:hover {
    box-shadow: 0 6px 18px rgba(120, 238, 65, 0.47);
    
}

/* Barra */
.barra {
    background: #e5e7eb;
    height: 8px;
    border-radius: 6px;
    margin-top: 10px;
}

.progreso {
    height: 8px;
    border-radius: 6px;
}

/* Colores */
.azul {
    background: #3b82f6;
}

.verde {
    background: #10b981;
}

/* Botón */
.btn {
    margin-top: auto;
    padding: 10px 15px;
    border: none;
    color: white;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.btn.azul:hover {
    background: #0b1b3f;
}

.btn.verde:hover {
    background: #059669;
}

/* ===============================
   CURSOS FINALIZADOS
================================ */

.titulo-finalizados{
    margin-left:20px;
    font-size:20px;
    font-weight:600;
    margin-bottom:20px;
}


.titulo-finalizados i{
    color:#10b981;
    margin-right:8px;
}


/* CONTENEDOR */
.cursos-finalizados{
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);

}
/* ESTADO */
.estado-finalizado{

    display:inline-block;
    width:max-content;

    background:#dcfce7;
    color:#15803d;

    padding:6px 14px;

    border-radius:20px;

    font-size:14px;

    margin:10px 0;

}


/* TEXTO PROGRESO */
.texto-progreso{

    font-size:14px;
    color:#6b7280;

}


/* BOTONES */
.acciones-finalizado{

    display:flex;
    gap:10px;
    margin-top:5px;

}

/* Contenedor */
/* CONTENEDOR */


/* CONTENEDOR */

.cardst{

    display:grid;

    grid-template-columns: repeat(4, 1fr);
     
    gap:35px;
    padding:30px;

}

/* TARJETA */

.course-card{

    background:#ffffff;

    border-radius:22px;

    overflow:hidden;

    box-shadow:0 12px 35px rgba(0,0,0,.08);

    transition:.45s;

    border:1px solid #b4b6bb;
padding:20px;
    height:100%;

    display:flex;

    flex-direction:column;

}

/* HOVER */

.course-card:hover{

    transform:translateY(-10px);

    box-shadow:0 25px 50px rgba(0,0,0,.15);

}

/* IMAGEN */

.image-box{
    position: relative;
    width:100%;
    aspect-ratio:12/9;
    overflow:hidden;
    border-radius:20px 20px 0 0;
    background:#eef2f7;
}

.image-box img{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    object-fit:cover;
    object-position:center;
    transition:transform .5s;
}

.course-card:hover img{
    transform:scale(1.05);
}
/* DEGRADADO */
.image-box::after{
    content:"";
    position:absolute;
    inset:0;
    background:linear-gradient(
        to top,
        rgba(0,0,0,.55),
        rgba(0,0,0,.10)
    );
}

/* CONTENIDO */

.course-content{
    padding:0px 10px 0px 0px;
margin:0px;
    display:flex;
    flex-direction:column;
    flex:1;
}

/* ETIQUETA */



/* TITULO */

.course-title{
    margin-top:0px;
 padding:0px 20px 0px;
    font-size:25px;
    font-weight:700;
    color:#0f172a;
    line-height:1.3;
}

/* DESCRIPCIÓN */

.course-description{
    margin-top:0px;
 padding:0px 10px 0px 0px;
    color:#64748b;
    line-height:1.8;
    flex:1;
}

/* FOOTER */

.course-footer{
    margin-top:30px;
}

/* BOTÓN */

.btn-inscribirse{
    width:100%;
    padding:15px;
    border:none;
    border-radius:14px;
    background:linear-gradient(90deg, #0b1d44, #061338);
    color:white;
    font-size:15px;
    font-weight:700;
    cursor:pointer;
    transition:.35s;
}

/* HOVER BOTÓN */
.btn-inscribirse:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 25px rgba(37,99,235,.35);
}

/* RESPONSIVE */
@media(max-width:768px){
    .cardst{
        grid-template-columns:1fr;
    }

}
/* ========================= */
/* MODAL */
/* ========================= */

/* FONDO DEL MODAL */
.modal{
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.55);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    padding: 20px;
}
/* CONTENEDOR */
.modal-content{
    width: 100%;
    max-width: 420px;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(0,0,0,.25);
    animation: aparecer .30s ease;
}
/* CABECERA */
.modal-header{
    padding:18px 22px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    background: #142c4d;
    color: #fff;
}
.modal-header h3{
    margin:0;
    font-size:20px;
    font-weight:700;
}
/* BOTÓN CERRAR */
.close{
    font-size:30px;
    cursor:pointer;
    transition:.3s;
}
.close:hover{
    transform:rotate(90deg);
}
/* CUERPO */
.modal-body{
    padding:25px;
    display:flex;
    flex-direction:column;
    gap:18px;
}
/* BOTONES */
.btn-metodo{
    width:100%;
    padding:16px;
    border:none;
    border-radius:12px;
    background:#f8f9fa;
    cursor:pointer;
    font-size:16px;
    font-weight:600;

    transition:.3s;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
}
.btn-metodo:hover{
    background: #061b3b;
    color:white;
    transform:translateY(-3px);
}
/* ANIMACIÓN */
@keyframes aparecer{
    from{
        opacity:0;
        transform:scale(.85);
    }
    to{
        opacity:1;
        transform:scale(1);
    }

}

.img-qr{

    width: 250px;

    margin-bottom: 20px;
}

.datos-banco{

    text-align: left;

    line-height: 2;
}



</style>