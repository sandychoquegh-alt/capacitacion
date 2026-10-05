  <!--esto es para es para la animacion de las imagenes del HERO-->
  <script>
const buscador =
document.getElementById("buscador");
const resultados =
document.getElementById("resultadosBusqueda");

// contenido que quieres buscar

const secciones = [

{
    titulo:"Cursos",
    palabras:"cursos capacitacion programas aprendizaje",
    id:"cursos"
},

{
    titulo:"Nosotros",
    palabras:"historia mision vision valores institucion",
    id:"nosotros"
},

{
    titulo:"Empresas Asociadas",
    palabras:"empresas aliados socios convenios",
    id:"empresas"
},

{
    titulo:"Emprendedor",
    palabras:"ideas negocio emprendimiento",
    id:"emprendedor"
}


];
buscador.addEventListener("keyup",()=>{

let texto =
buscador.value.toLowerCase();
resultados.innerHTML="";

if(texto.length < 2){

    resultados.style.display="none";
    return;
}

let encontrados =
secciones.filter(item=>
item.palabras
.toLowerCase()
.includes(texto)

||
item.titulo
.toLowerCase()
.includes(texto)
);

if(encontrados.length){
resultados.style.display="block";
encontrados.forEach(item=>{
resultados.innerHTML += `

<div class="resultado"
onclick="irSeccion('${item.id}')">

<i class="fa-solid fa-magnifying-glass"></i>
${item.titulo}

</div>

`;

});

}else{

    resultados.style.display="block";

    resultados.innerHTML =

    `
    <div class="resultado">

        <i class="fa-solid fa-circle-exclamation"></i>

        Sin resultados encontrados

    </div>
    `;

}

});


function irSeccion(id){
document
.getElementById(id)
.scrollIntoView({

behavior:"smooth"

});

resultados.style.display="none";

buscador.value="";

}

</script>


<script>
const reveals = document.querySelectorAll('.reveal');

const observer = new IntersectionObserver((entries)=>{
  entries.forEach(entry=>{
    if(entry.isIntersecting){
      entry.target.classList.add('active');
    }else{
      entry.target.classList.remove('active'); // vuelve a animar
    }
  });
},{ threshold:0.2 });

reveals.forEach(r => observer.observe(r));
</script>

<!--ESTO VA IR PARA EL MODAL DE NOSOTROS-->


<script>
document.querySelectorAll('a[href^="#"]').forEach(link=>{
  link.addEventListener('click',function(e){
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));

    const y = target.getBoundingClientRect().top + window.pageYOffset
            - (window.innerHeight/2) + (target.offsetHeight/2);

    window.scrollTo({
      top:y,
      behavior:'smooth'
    });
  });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const toggler = document.querySelector('.navbar-toggler');
  const icon = document.getElementById('iconMenu');
  const menu = document.getElementById('navbarMain');

  menu.addEventListener('show.bs.collapse', () => {
    icon.classList.remove('fa-bars');
    icon.classList.add('fa-xmark');
  });

  menu.addEventListener('hide.bs.collapse', () => {
    icon.classList.remove('fa-xmark');
    icon.classList.add('fa-bars');
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
const swiper = new Swiper(".heroSwiper", {
    effect: "fade",
    loop: true,
    speed: 1000,

    /* QUITAMOS AUTOPLAY */
    autoplay: false,

    /* BOTONES MANUALES */
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const swiperCursos = new Swiper(".cursosSwiper", {
        slidesPerView: 4,
        spaceBetween: 0,
        loop: true,

        /* QUITAMOS AUTOPLAY */
        autoplay: false,

        /* SOLO FUNCIONA CON BOTONES */
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        breakpoints: {
            576: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 4,
            }
        }
    });

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* SECCIÓN EMPRESAS*/

    const linkEmpresas = document.querySelector('a[href="#empresas"]');

    if (linkEmpresas) {
        linkEmpresas.addEventListener("click", function (e) {
            e.preventDefault();

            const section = document.getElementById("empresas");

            if (section) {
                window.scrollTo({
                    top: section.offsetTop,
                    behavior: "auto"
                });
            }
        });
    }


    /*  SECCIÓN NOSOTROS */

    const linkNosotros = document.querySelector('a[href="#nosotros"]');

    if (linkNosotros) {
        linkNosotros.addEventListener("click", function (e) {
            e.preventDefault();

            const section = document.getElementById("nosotros");

            if (section) {
                window.scrollTo({
                    top: section.offsetTop,
                    behavior: "auto"
                });
            }
        });
    }

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* TODOS LOS DROPDOWNS */
    const dropdownItems = document.querySelectorAll(".dropdown-item");

    dropdownItems.forEach(function (item) {

        const link = item.querySelector(".dropdown-link");
        const submenu = item.querySelector(".submenu");
        const icon = link.querySelector("i");

        if (link && submenu && icon) {

            link.addEventListener("click", function (e) {
                e.preventDefault();

                /* cerrar otros abiertos */
                dropdownItems.forEach(function (otherItem) {
                    if (otherItem !== item) {
                        otherItem.classList.remove("active");

                        const otherIcon = otherItem.querySelector(".dropdown-link i");
                        if (otherIcon) {
                            otherIcon.classList.remove("rotate-icon");
                        }
                    }
                });

                /* abrir/cerrar actual */
                item.classList.toggle("active");
                icon.classList.toggle("rotate-icon");
            });

        }

    });

});
</script>
<script>

function abrirModalSeccion(s){modalTitulo.innerHTML=s.titulo;modalSubtitulo.innerHTML=s.subtitulo;modalImagen.src="/storage/"+s.imagen;modalDescripcion0.innerHTML=s.descripcion0??'';modalDescripcion1.innerHTML=s.descripcion1??'';modalDescripcion2.innerHTML=s.descripcion2??'';modalDescripcion3.innerHTML=s.descripcion3??'';new bootstrap.Modal(document.getElementById('modalSeccion')).show();}

function cerrarModalSeccion(){bootstrap.Modal.getInstance(document.getElementById('modalSeccion')).hide();}

</script>

<script>

document.addEventListener("DOMContentLoaded", () => {

    const cards = document.querySelectorAll(".mini-card");
    const dots = document.querySelectorAll(".dot");

    const btnNext = document.querySelector(".nav-next");
    const btnPrev = document.querySelector(".nav-prev");

    if (cards.length === 0) return;

    let actual = 0;
    let intervalo;

    function mostrar(indice){

        if(indice === actual) return;

        // Quitar clases de todas las tarjetas
        cards.forEach(card => {

            card.classList.remove("active");
            card.classList.remove("exit");

        });

        // Quitar clase active de todos los dots
        dots.forEach(dot => {

            dot.classList.remove("active");

        });

        // Animación de salida
        cards[actual].classList.add("exit");

        // Animación de entrada
        cards[indice].classList.remove("exit");
        cards[indice].classList.add("active");

        // Activar dot si existe
        if(dots[indice]){

            dots[indice].classList.add("active");

        }

        actual = indice;

    }

    function siguiente(){

        let nuevo = actual + 1;

        if(nuevo >= cards.length){

            nuevo = 0;

        }

        mostrar(nuevo);

    }

    function anterior(){

        let nuevo = actual - 1;

        if(nuevo < 0){

            nuevo = cards.length - 1;

        }

        mostrar(nuevo);

    }

    // Primera tarjeta
    cards[0].classList.add("active");

    if(dots[0]){

        dots[0].classList.add("active");

    }

    // Click en dots
    dots.forEach((dot,index)=>{

        dot.addEventListener("click",()=>{

            mostrar(index);

            reiniciarAuto();

        });

    });

    // Botón siguiente
    if(btnNext){

        btnNext.addEventListener("click",()=>{

            siguiente();

            reiniciarAuto();

        });

    }

    // Botón anterior
    if(btnPrev){

        btnPrev.addEventListener("click",()=>{

            anterior();

            reiniciarAuto();

        });

    }

    // Auto rotación
    function iniciarAuto(){

        intervalo = setInterval(siguiente,5000);

    }

    function reiniciarAuto(){

        clearInterval(intervalo);

        iniciarAuto();

    }

    iniciarAuto();

});

</script>