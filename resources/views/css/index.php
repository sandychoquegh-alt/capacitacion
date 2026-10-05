<style>

   
/*  Variables (ESCALABLE) */


html {
    scroll-behavior: auto !important;
}
body{
  background: #f8fafc;
  margin:0;
    padding:0;

}

:root {
  --primary: #0A1E3F;
  --accent: #fccd35;
  --glass: rgba(255,255,255,0.08);
}

/* Navbar base */
.navbar {min-height: 75px; backdrop-filter: blur(10px);}
/* Fondo elegante */
.bg-primary-custom { background: linear-gradient(135deg, #0A1E3F, #102a5c);}
/* Links */
.navbar .nav-link { color: #eaeaea; font-weight: 500; position: relative; }
.navbar .nav-link:hover { color: var(--accent); }
/* Línea animada */
.navbar .nav-link::after { content: ''; position: absolute; width: 0%; height: 2px; background: var(--accent); left: 0; bottom: -5px; transition: 0.3s; }
.navbar .nav-link:hover::after { width: 100%; }
/* Buscador */
.search-box input { border: none;outline: none;padding: 6px 12px;border-radius: 20px; background: var(--glass); color: #fff; width: 180px;  position:relative;}

.search-box input::placeholder {color: #ccc;}
.search-box input:focus {box-shadow: 0 0 0 2px rgba(252, 205, 53, 0.4);}
#resultadosBusqueda{
position:absolute;
background:white;
width:250px;
border-radius:5px;

overflow:hidden;
display:none;
z-index:999;
}

.resultado{

display:flex;
padding:12px;
  gap:10px;
cursor:pointer;

color:#0f172a;

}

.resultado:hover{

background:#f1f5f9;

}

/* Botones */
.btn-warning {
  background: var(--accent);
  border: none;
  font-weight: 600;
}

.btn-outline-light:hover {
  background: white;
  color: black;
}



/* 
DROPDOWN CURSOS PROFESIONAL
SUBMENU DEBAJO (NO LATERAL) */


/* ICONO NORMAL */
.dropdown-link i {
    font-size: 12px;
    transition: transform 0.3s ease;
}

/* ROTACIÓN DEL ICONO */
.rotate-icon {
    transform: rotate(90deg);
}

/* SUBMENU CERRADO */
.submenu {
    display: none;
}

/* SUBMENU ABIERTO */
.dropdown-item.active > .submenu {
    display: block;
}
.nav-item.dropdown {
    position: relative;
}

/* LINK PRINCIPAL */
.nav-item.dropdown .nav-link {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

/* MENU PRINCIPAL */
.nav-item.dropdown > .dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 270px;
    background: #ffffff;
    border-radius: 14px;
    padding: 12px 0;
    box-shadow: 0 20px 45px rgba(0,0,0,0.08);
    border: none;
    z-index: 9999;

    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.3s ease;
    display: block;
}

/* ABRIR MENU */
.nav-item.dropdown:hover > .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* ITEM INTERNO */
.dropdown-item {
    position: relative;
    padding: 0;
    background: transparent;
}

/* LINK INTERNO */
.dropdown-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 22px;
    text-decoration: none;
    color: #1e293b;
    font-size: 14px;
    font-weight: 500;
    transition: 0.3s;
}

.dropdown-link:hover {
    background: #f8fafc;
    color: #0d6efd;
    padding-left: 28px;
}

/*SUBMENU DEBAJO DEL DROPDOWN*/

.submenu {
     position:  relative;/* importante */
    top: auto;
    left: 0;
    width: 100%;
    background: #f8fafc;
    border-radius: 0;
    padding: 0;
    box-shadow: none;
    z-index: 1;

    opacity: 0;
    visibility: hidden;
    max-height: 0;
    overflow: hidden;
    transform: none;
    transition: all 0.3s ease;
}

/* ABRIR SUBMENU */
.dropdown-item:hover > .submenu {
    opacity: 1;
    visibility: visible;
    max-height: 500px;
    padding: 8px 0;
}

/* LINKS DEL SUBMENU */
.submenu a {
    display: block;
    padding: 12px 35px;
    text-decoration: none;
    color: #475569;
    font-size: 14px;
    transition: 0.3s;
    border-left: 3px solid transparent;
}

.submenu a:hover {
    background: #ffffff;
    color: #0d6efd;
    border-left: 3px solid #0d6efd;
    padding-left: 40px;
}

/* MOBILE */

@media (max-width: 991px) {

    .nav-item.dropdown > .dropdown-menu {
        position: static;
        opacity: 1;
        visibility: visible;
        transform: none;
        box-shadow: none;
        background: transparent;
        padding: 0;
        display: none;
    }

    .nav-item.dropdown.active > .dropdown-menu {
        display: block;
    }

    .submenu {
        position: static;
        opacity: 1;
        visibility: visible;
        max-height: none;
        transform: none;
        box-shadow: none;
        background: rgba(255,255,255,0.05);
        margin-left: 0;
        display: none;
        padding: 0;
    }

    .dropdown-item.active > .submenu {
        display: block;
    }

    .dropdown-link,
    .submenu a {
        color: white;
    }
}


/* Mobile estilo app */
@media (max-width: 991px) {

/* DROPDOWN PRINCIPAL */
    .nav-item.dropdown > .dropdown-menu {
        display: none;
    }

    .nav-item.dropdown.active > .dropdown-menu {
        display: block;
    }

    /* SUBMENU */
    .submenu {
        display: none;
    }

    .dropdown-item.active > .submenu {
        display: block;
    }


  .navbar-collapse {
    background: #0A1E3F;
    padding: 20px;
    border-radius: 12px;
    margin-top: 10px;
    animation: fadeIn 0.3s ease;
  }

  .navbar .nav-link {
    padding: 10px 0;
    font-size: 16px;
  }

 .search-box input {
    width: 100%;
  }

  .navbar .btn {
    width: 100%;
  }
}

/* Animación */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* HERO SECTION ESTILO BOCETO */
header{
    margin:0;
}
.hero {
    position: relative;
    min-height: 750px;
    overflow: visible;
    margin-top:0;
    padding-top:28px;
   height: 80%;
    
}

/* FONDO */
.heroSwiper {
    position: absolute;
    inset: 0;
    z-index: 1;
}

.heroSwiper .swiper-slide {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

/* CAPA OSCURA */
.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        rgba(10, 30, 63, 0.80),
        rgba(16, 42, 92, 0.55)
    );
    z-index: 2;
}

/* CONTENIDO SUPERIOR */
/* CONTENIDO SUPERIOR */
.hero-content {
    position: relative;
    z-index: 3;
    width: 100%;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

/* WRAPPER GENERAL */
.hero-cards-wrapper {
    width: 97%;
    position: relative;
    height:80vh;
}

/* CONTENEDOR SLIDER */
.hero-cards {
    width: 100%;
    height: 100vh;
    position: relative;
    overflow: hidden;
}

/* CARD */
.mini-card{
    

    position:absolute;

    inset:0;

    width:100%;
    height:75%;

    opacity:0;

    transform:translateX(100%);

    transition:
        transform .8s ease,
        opacity .8s ease;

    pointer-events:none;

    z-index:1;

}
/* CARD QUE SALE */
.mini-card.exit{

    opacity:0;

    transform:translateX(-100%);

    z-index:1;

}

/* CARD ACTIVA */
.mini-card.active{

    opacity:1;

    transform:translateX(0);

    z-index:2;

    pointer-events:auto;

}
.mini-card:not(.active):not(.exit){

    visibility:hidden;

}

/* IMAGEN */
.mini-card img {
    width: 100%;
    height: 100%;
    object-position: center;
    display: block;
}


/* CAPA OSCURA */
.mini-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.45);
    z-index: 1;
}

/* BOTÓN */
/* TEXTO / BOTÓN */
.mini-card a{
    position: absolute;
    left: 70px;
    bottom: 80px;
    z-index: 3;
    color: #ffffff;
    font-size: 20px;
    font-weight: 700;
    text-decoration: none;
    background: rgba(8, 3, 31, 0.92);
    padding: 8px 20px;
    border-radius: 14px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    transition: 0.3s ease;
    /* ANIMACIÓN */
    opacity: 0;
    /* ENTRA DESDE ABAJO */
    transform: translateY(-20px);
}

/* CUANDO LA CARD ESTÁ ACTIVA */
.mini-card.active a{

    opacity: 1;
    transition:
        opacity 0.8s ease 0.4s,
        transform 0.8s ease 0.4s;
}

/* HOVER */

.mini-card a:hover {
   background: rgba(255,255,255,0.22);
    transform: translateY(-4px);
}

/* TITULOS Y TEXTOS */
.mini-card h1,
.mini-card p{
    position: absolute;
    z-index: 3;
    color: white;
    opacity: 0;
    transform: translateX(-80px);
}

/* TITULO */
.mini-card h1{
    top: 250px;
    left: 70px;
    font-size: 40px;
    font-weight: 800;
}

/* TEXTO */
.mini-card p{
    top: 295px;
    left: 70px;
    font-size: 20px;
    max-width: 600px;
}

/* ANIMACIONES */
.mini-card.active h1{
    opacity: 1;
    transform: translateX(0);
    transition:
        opacity 0.8s ease 0.3s,
        transform 0.8s ease 0.3s;
}

.mini-card.active p{
    opacity: 1;
    transform: translateX(0);
    transition:
        opacity 0.8s ease 0.6s,
        transform 0.8s ease 0.6s;
}

/* NAVEGACIÓN */

/* DOTS CENTRO */

.dots-navigation {
    position:absolute;
    bottom:45px;
    left:50%;
    transform:translateX(-20%);
    z-index:2;

}

/* BOTONES IZQUIERDA */

.buttons-navigation {
    position:absolute;
    bottom:45px;
    left:70px;
    z-index:4;
    display:flex;
    gap:20px;

}


/* BOTONES */

.nav-btn {

    width:55px;

    height:55px;

    border-radius:50%;
   border:1px solid White;

    background: transparent;

    display:flex;

    align-items:center;

    justify-content:center;

    cursor:pointer;

    box-shadow:
    0 10px 30px rgba(0,0,0,.2);

    transition:.3s;

}


.nav-btn:hover{

    transform:translateY(-5px);

    background:White;

}


.nav-btn:hover i{

    color:#02142e;

}


.nav-btn i{

    color:White;

}



/* ===================== */
/* DOTS */
/* ===================== */


.nav-dots{

    display:flex;

    gap:12px;

}


.dot{

    width:12px;

    height:12px;

    border-radius:50%;

    background:white;

    opacity:.6;

    transition:.3s;

}


.dot.active{

    width:35px;

    border-radius:20px;

    background:#fccd35;

    opacity:1;

}

/* RESPONSIVE */
@media(max-width:768px){

    .hero-cards {
        height: 100vh;
    }

    .mini-card a {
        left: 20px;
        bottom: 90px;
        margin-left:45px;

        padding: 14px 22px;
        font-size: 14px;
    }

    .nav-btn {
        width: 42px;
        height: 42px;
    }

}

/* CONTENEDOR */
.row-cards{

    width:80%;

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));

    gap:25px;

    margin:0 auto;

}
.card-box{

    border-radius:20px;

    display:flex;

    flex-direction:column;

    gap:10px;

    color:#0f172a;

    transition:.3s;

    padding:20px;

    height:100%;
    text-align:center;

}

/* SOLO LOS P */

.card-box p{

    font-size:15px;

    font-weight:400;

    line-height:1.6;

    text-align:left;

    white-space:normal;

    word-break:normal;

    overflow-wrap:break-word;

    hyphens:none;

}



/* RESPONSIVE */

@media(max-width:992px){
    .row-cards{
        grid-template-columns:
        repeat(2,1fr);
    }

}


@media(max-width:600px){
    .row-cards{
        grid-template-columns:1fr;
    }
}

/*esto es para seccion de los curso1, curso2, curso3*/
.informacion{
    max-width:1200px;
    margin:auto;
    padding:0px 0px;
    text-align:center;
}

/* ETIQUETA */

.badge-emprendedor{
    display:inline-block;
    background:#e0f2fe;
    color:#0369a1;
    padding:10px 25px;
    border-radius:50px;
    font-weight:700;
    font-size:15px;
    letter-spacing:1px;
    text-transform:uppercase;
}

/* TITULO */

.info h2{

    font-size:55px;

    color:#0f172a;

    margin-top:25px;

    margin-bottom:20px;

    font-weight:800;

    line-height:1.1;

}

/* DESCRIPCION */

.descripcion-principal{

    max-width:850px;
    margin:auto;
    color:#64748b;
    font-size:20px;
    line-height:1.9;
    margin-bottom:60px;

}

/* COLUMNAS */

.row-info{

    display:grid;

    grid-template-columns:repeat(2,1fr);

    gap:30px;

}

/* TARJETAS */

.col-info{

    background:white;

    padding:40px;

    border-radius:25px;

    box-shadow:
    0 15px 40px rgba(0,0,0,.08);

    transition:.3s;

}

.col-info:hover{

    transform:translateY(-10px);

    box-shadow:
    0 25px 60px rgba(0,0,0,.12);

}

/* ICONO */

.icono{

    font-size:50px;

    margin-bottom:20px;

}

/* SUBTITULO */

.col-info h3{

    color:#0f172a;

    font-size:28px;

    margin-bottom:15px;

}

/* TEXTO */

.col-info p{

    color:#64748b;

    line-height:1.8;

    font-size:17px;

}

/* RESPONSIVE */

@media(max-width:768px){

    .row-info{

        grid-template-columns:1fr;

    }

    .info h2{

        font-size:38px;

    }

}

/* COURSES */


.courses-section {
  padding: 80px 20px;
  background: #f8f9fc;
}

/* HEADER */
.courses-header {
  text-align: center;
  margin-bottom: 30px;
}

.courses-header h2 {
  font-size: 32px;
  font-weight: 700;
}

.courses-header p {
  color: #666;
  margin-top: 10px;
}

/* GRID RESPONSIVE */
.courses-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 30px;
}

/* CARD */
.course-card {
  background: #fff;
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.3s ease;
  border: 1px solid #eee;
}

.course-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

/* IMAGEN */
.course-image {
  position: relative;
}

.course-image img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}

/* BADGE */
.badge {
  position: absolute;
  top: 10px;
  left: 10px;
  background: #fccd35;
  color: #000;
  padding: 5px 10px;
  font-size: 12px;
  border-radius: 6px;
  font-weight: 600;
}

/* BODY */
.course-body {
  padding: 18px;
}

.course-body h3 {
  font-size: 18px;
  font-weight: 600;
}

/* DESCRIPCIÓN */
.course-desc {
  font-size: 14px;
  color: #666;
  margin: 10px 0;
}

/* META */
.course-meta {
  font-size: 13px;
  color: #888;
  display: flex;
  justify-content: space-between;
  margin-bottom: 15px;
}

/* FOOTER */
.course-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

/* PRECIO */
.price .old {
  text-decoration: line-through;
  color: #aaa;
  font-size: 14px;
}

.price .new {
  color: #0A1E3F;
  font-weight: 700;
  font-size: 18px;
}

/* BOTÓN */
.btn-course {
  background: #0A1E3F;
  color: #fff;
  padding: 6px 14px;
  border-radius: 8px;
  text-decoration: none;
  font-size: 14px;
  transition: 0.3s;
}

.btn-course:hover {
  background: #fccd35;
  color: #000;
}


/* FEATURES */
.features{
  display:flex;
  justify-content:center;
  gap:40px;
  padding:80px 20px;
  background:linear-gradient(180deg,#0A1E3F,#0B0B0B);
  text-align:center;
}

.feature{
  background:#0f172a;
  border-radius:25px;
  padding:40px 30px;
  width:260px;
  color:white;
  box-shadow:0 10px 25px rgba(0,0,0,0.4);
  transition:transform .4s ease, box-shadow .4s ease;
  border:1px solid rgba(212,175,55,0.4);
}

.feature:hover{
  transform:translateY(-10px) scale(1.05);
  box-shadow:0 20px 40px rgba(0,0,0,0.6);
}

.icon-box{
  width:70px;
  height:70px;
  border-radius:50%;
  background:linear-gradient(145deg,#D4AF37,#b8962e);
  display:flex;
  align-items:center;
  justify-content:center;
  margin:0 auto 20px;
  box-shadow:0 0 15px rgba(212,175,55,0.7);
}

.icon-box i{
  font-size:30px;
  color:#0A1E3F;
}

.feature h3{
  color:#D4AF37;
  margin-bottom:8px;
  font-weight:600;
}

.main-footer{
  background:linear-gradient(180deg,#0A1E3F,#020617);
  color:white;
  padding:60px 20px 0;
  border-top:2px solid rgba(212,175,55,0.5);
}

.footer-container{
  max-width:1100px;
  margin:auto;
  display:flex;
  justify-content:space-between;
  flex-wrap:wrap;
  gap:40px;
}

.footer-brand h3{
  color:#D4AF37;
  font-size:22px;
  margin-bottom:8px;
}

.footer-links h4,
.footer-contact h4{
  color:#D4AF37;
  margin-bottom:10px;
}

.footer-links a{
  display:block;
  color:#ddd;
  text-decoration:none;
  margin-bottom:6px;
  transition:.3s;
}

.footer-links a:hover{
  color:#D4AF37;
}

.footer-contact p{
  margin:6px 0;
  color:#ddd;
}

.footer-bottom{
  text-align:center;
  margin-top:40px;
  padding:15px;
  background:#020617;
  font-size:14px;
  border-top:1px solid rgba(212,175,55,0.3);
}


.footer-social h4{
  color:#D4AF37;
  margin-bottom:12px;
}

.social-icons{
  display:flex;
  gap:15px;
}

.social{
  width:45px;
  height:45px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  background:#0f172a;
  color:#D4AF37;
  font-size:18px;
  border:1px solid rgba(212,175,55,0.4);
  transition:.4s ease;
  
}

.social:hover{
  background:#D4AF37;
  color:#0A1E3F;
  transform:translateY(-6px) scale(1.1);
  box-shadow:0 0 15px rgba(212,175,55,0.7);
}

/* Animación al hacer scroll */
.reveal{
  opacity:0;
  transform:translateY(60px);
  transition:all 0.9s ease;
}

.reveal.active{
  opacity:1;
  transform:translateY(0);
}

/*esto va ir para el modal de NOSOTROS*/

.about-modal{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.85);
  display:flex;
  align-items:center;
  justify-content:center;
  opacity:0;
  pointer-events:none;
  transition:.4s ease;
  z-index:9999;
}

.about-modal.active{
  opacity:1;
  pointer-events:auto;
}

.about-box{
  background:linear-gradient(180deg,#0A1E3F,#020617);
  color:white;
  width:90%;
  max-width:700px;
  border-radius:25px;
  padding:40px;
  position:relative;
  border:1px solid rgba(212,175,55,0.5);
  box-shadow:0 0 30px rgba(212,175,55,0.5);
  transform:scale(0.8);
  transition:.4s ease;
}

.about-modal.active .about-box{
  transform:scale(1);
}

.about-box h2{
  color:#D4AF37;
  margin-bottom:5px;
}

.subtitle{
  color:#ccc;
  margin-bottom:20px;
}

.about-content{
  max-height:300px;
  overflow-y:auto;
  padding-right:10px;
}

.about-content p{
  line-height:1.7;
  margin-bottom:12px;
}

.close-btn{
  position:absolute;
  top:15px;
  right:20px;
  font-size:28px;
  color:#D4AF37;
  cursor:pointer;
}

section{
  scroll-margin-top:100px; /* altura de tu nav */
}

.nav-item {
    position: relative;
}

.nav-link {
    text-decoration: none;
    color: #2d3748;
    font-weight: 600;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 0;
    cursor: pointer;
    transition: 0.3s;
}

.nav-link:hover {
    color: #0d6efd;
}

.nav-link i {
    font-size: 12px;
    transition: 0.3s;
}

/* DROPDOWN */

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    width: 250px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    padding: 15px 0;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: 0.3s;
    z-index: 999;
}

.nav-item.dropdown.active > .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* SUBMENU ITEMS */

.dropdown-item {
    position: relative;
}

.dropdown-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 13px 22px;
    text-decoration: none;
    color: #2d3748;
    font-size: 14px;
    font-weight: 500;
    transition: 0.3s;
}

.dropdown-link:hover {
    background: #f8fafc;
    color: #0d6efd;
    padding-left: 28px;
}

/* SUBMENU */

.submenu {
    position: absolute;
    top: 0;
    left: 100%;
    width: 230px;
    background: white;
    border-radius: 14px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    padding: 15px 0;
    opacity: 0;
    visibility: hidden;
    transform: translateX(10px);
    transition: 0.3s;
    z-index: 999;
}

.dropdown-item:hover > .submenu {
    opacity: 1;
    visibility: visible;
    transform: translateX(0);
}

.submenu a {
    display: block;
    padding: 13px 22px;
    text-decoration: none;
    color: #2d3748;
    font-size: 14px;
    transition: 0.3s;
}

.submenu a:hover {
    background: #f8fafc;
    color: #0d6efd;
    padding-left: 28px;
}
</style>



<style>
/* SECCIÓN NOSOTROS */

.nosotros-section {
    padding: 100px 8%;
    background: #f8fafc;
}

.nosotros-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 60px;
    flex-wrap: wrap;
}

.nosotros-content {
    flex: 1;
    min-width: 320px;
}

.section-tag {
    display: inline-block;
    background: #e7f1ff;
    color: #0d6efd;
    padding: 8px 18px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 20px;
}

.nosotros-content h2 {
    font-size: 42px;
    line-height: 1.3;
    color: #1e293b;
    margin-bottom: 25px;
    font-weight: 700;
}

.nosotros-content p {
    font-size: 16px;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 18px;
}

/* BOTONES */

.nosotros-buttons {
    display: flex;
    gap: 18px;
    margin-top: 30px;
}

.btn-mision,
.btn-vision {
    border: none;
    padding: 14px 28px;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.btn-mision {
    background: #0d6efd;
    color: white;
}

.btn-mision:hover {
    background: #0b5ed7;
}

.btn-vision {
    background: white;
    color: #0d6efd;
    border: 2px solid #0d6efd;
}

.btn-vision:hover {
    background: #0d6efd;
    color: white;
}

/* IMAGEN */

.nosotros-image {
    flex: 1;
    min-width: 320px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.nosotros-image img {
    width: 100%;
    max-width: 550px;
    height: clamp(350px, 75vh, 550px);
    object-fit: cover;
    border-radius: 24px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
}

/* MODAL */

.modal-nosotros {
    display: none;
    position: fixed;
    z-index: 9999;
    inset: 0;
    background: rgba(0,0,0,0.55);
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.modal-content-nosotros {
    background: white;
    width: 100%;
    max-width: 650px;
    border-radius: 20px;
    padding: 40px;
    position: relative;
    animation: fadeIn 0.3s ease;
}

.modal-content-nosotros h3 {
    font-size: 30px;
    color: #1e293b;
    margin-bottom: 20px;
}

.modal-content-nosotros p {
    font-size: 16px;
    line-height: 1.8;
    color: #475569;
}

.cerrar-modal {
    position: absolute;
    top: 20px;
    right: 25px;
    font-size: 30px;
    cursor: pointer;
    color: #64748b;
}

.cerrar-modal:hover {
    color: #0d6efd;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<style>
/* SECCIÓN EMPRESAS */

.empresas-section {
    padding: 90px 0;
    background: #ffffff;
    overflow: hidden;
}

.container-empresas {
    width: 90%;
    margin: auto;
}

.titulo-empresas {
    text-align: center;
    margin-bottom: 60px;
}

.titulo-empresas span {
    display: inline-block;
    background: #eaf3ff;
    color: #0d6efd;
    padding: 8px 18px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 18px;
}

.titulo-empresas h2 {
    font-size: 38px;
    color: #1e293b;
    margin-bottom: 20px;
    font-weight: 700;
}

.titulo-empresas p {
    max-width: 700px;
    margin: auto;
    color: #64748b;
    font-size: 16px;
    line-height: 1.8;
}

/* CARRUSEL LOGOS */ 

.slider-logos {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.slide-track {
    display: flex;
    width: calc(250px * 12);
    animation: scroll 30s linear infinite;
}

.slide {
    width: 250px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.slide img {
    width: 160px;
    max-width: 100%;
    height: auto;
    object-fit: contain;
    filter: grayscale(100%);
    opacity: 0.75;
    transition: 0.3s;
}

.slide img:hover {
    filter: grayscale(0%);
    opacity: 1;
    transform: scale(1.05);
}

/* Animación infinita */

@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(calc(-250px * 6));
    }
}

.whatsapp-float-text{

    position: fixed;

    left: 20px;

    bottom: 20px;

    background: #25D366;

    color: white;

    padding: 12px 18px;

    border-radius: 50px;

    display: flex;

    align-items: center;

    gap: 10px;

    text-decoration: none;

    font-weight: 600;

    z-index: 999999;

    box-shadow: 0 5px 20px rgba(0,0,0,.25);

    transition: .3s;

}

.whatsapp-float-text i{

    font-size: 30px;

}

.whatsapp-float-text:hover{

    color: white;

    transform: translateY(-3px);

}

</style>