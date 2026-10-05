<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                      <img
    src="{{ asset('img/FHB PNG.PNg') }}"
    alt="Logo"
    style="
        width:50px;
        height:50px;
        transform:scale(2.5);
    ">
                    </a>
                </div>

    <!-- Navigation Links deployarlo-->
    {{-- ADMIN --}}
    @if(auth()->user()->rol_id == 1)
        
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
              <x-nav-link 
                :href="'http://127.0.0.1:8000/empresa/dashboard'"
                :active="false">
                INICIO
            </x-nav-link>
            <x-nav-link :href="url('/admin/dashboard')" 
                :active="request()->is('admin/dashboard')">
                Dashboard
            </x-nav-link>

        </div>
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
     
         <!-- MENÚ DESPLEGABLE -->
            <div style="position:relative; display:inline-block;">
            <br>
                <button onclick="toggleMenu()"
                    style="
                        display:flex;
                        align-items:center;
                        gap:10px;
                        background:none;
                        border:none;
                        color:black;
                        font-weight:600;
                        font-size:15px;
                        cursor:pointer;
                    ">

                    <i class="fa-solid fa-layer-group"></i>

                    Contenido

                    <i id="iconoMenu"
                    class="fa-solid fa-chevron-down"
                    style="transition:.3s;"></i>

                </button>

                <!-- SUBMENÚ -->
                <div id="submenu"
                    style="
                        display:none;
                        position:absolute;
                        top:42px;
                        left:0;
                        min-width:220px;
                        background:white;
                        border-radius:12px;
                        overflow:hidden;
                        box-shadow:0 15px 35px rgba(0,0,0,.18);
                        z-index:999;
                    ">

                    <a href="{{ route('admin.seccion_inicios.index') }}"
                        style="display:block;padding:14px 18px;text-decoration:none;color:#374151;">
                        <i class="fa-solid fa-house"></i>
                        Sección Inicio
                    </a>
                    <a href="{{ route('admin.infors.index') }}"
                        style="display:block;padding:14px 18px;text-decoration:none;color:#374151;">
                        <i class="fa-solid fa-images"></i>
                        Informaciones Inicio
                    </a>
            <!--
                    <a href="admin.seccion_inicios.index"
                        style="display:block;padding:14px 18px;text-decoration:none;color:#374151;">
                        <i class="fa-solid fa-building"></i>
                        Sobre Nosotros
                    </a>-->
                    <a href="{{ route('admin.sobre_nosotros.index') }}"
            style="
            display:block;
            padding:14px 18px;
            text-decoration:none;
            color:#374151;
            ">

                <i class="fa-solid fa-users"></i>

                Sobre Nosotros

            </a>

                <a href="{{ route('admin.secciones_empresariales.index') }}"
            style="display:block;padding:14px 18px;text-decoration:none;color:#374151;">

                <i class="fa-solid fa-briefcase"></i>

                Sección Empresarial

            </a>
                    <a href="{{ route('admin.secciones_empresas.index') }}"
            style="display:block;padding:14px 18px;text-decoration:none;color:#374151;">

                <i class="fa-solid fa-building"></i>

                Empresas

            </a>

                </div>

            </div>

<script>
function toggleMenu(){

    const menu = document.getElementById('submenu');
    const icono = document.getElementById('iconoMenu');

    if(menu.style.display === 'block'){

        menu.style.display = 'none';
        icono.style.transform = 'rotate(0deg)';

    }else{

        menu.style.display = 'block';
        icono.style.transform = 'rotate(180deg)';

    }

}

window.addEventListener('click',function(e){

    if(!e.target.closest('#submenu') && !e.target.closest('button')){

        document.getElementById('submenu').style.display='none';
        document.getElementById('iconoMenu').style.transform='rotate(0deg)';

    }

});
</script>
      </div>
        
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="url('/admin/cursos')" 
            :active="request()->is('admin/cursos')">
             Cursos
        </x-nav-link>
        </div>

        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="url('/admin/inscripciones')" 
            :active="request()->is('admin/inscripciones')">
             Inscripcion
        </x-nav-link>
        </div>
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link 
        :href="url('/admin/usuariosNuevo')" 
        :active="request()->is('admin/usuariosNuevo')">
        Usuarios Nuevos
    </x-nav-link>
</div>

        
         
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="url('/admin/usuarios')" 
            :active="request()->is('admin/usuarios')">
             Usuarios
        </x-nav-link>
        </div>

    @endif

    {{-- ESTUDIANTE --}}
  {{-- ESTUDIANTE --}}
@if(auth()->user()->rol_id == 2)

    <!-- INICIO -->
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

        <x-nav-link
            :href="url('/estudiante/dashboard')"
            :active="request()->is('estudiante/dashboard')">

            Inicio

        </x-nav-link>

    </div>

    <!-- MENÚ CURSOS -->
   <!-- MENÚ CURSOS ESTUDIANTE -->
<div class="hidden sm:flex sm:items-center sm:ms-10">

    <div class="cursos-menu">

        <button type="button" id="btnCursos" class="cursos-btn">

            Cursos

            <i class="fas fa-chevron-down"></i>

        </button>

        <div id="panelCursos" class="cursos-panel">

            <!-- EMPRESARIO -->
            <div class="cursos-item">

                <button type="button" class="cursos-item-btn">
                    Empresario
                    <i class="fas fa-chevron-down"></i>
                </button>

                <div class="cursos-submenu">

                    <a href="{{ route('estudiante.cursos') }}">
                        Landing Pages
                    </a>

                    <a href="{{ route('estudiante.cursos.empresarios.finanzas') }}">
                        Sistemas Web
                    </a>
                </div>

            </div>

            <!-- EMPRENDEDOR 
            <div class="cursos-item">

                <button type="button" class="cursos-item-btn">
                    Emprendedor
                    <i class="fas fa-chevron-down"></i>
                </button>

                <div class="cursos-submenu">

                    <a href="#">Landing Pages</a>
                    <a href="#">Sistemas Web</a>

                </div>

            </div>

           HERRAMIENTAS 
            <div class="cursos-item">

                <button type="button" class="cursos-item-btn">
                    Herramientas
                    <i class="fas fa-chevron-down"></i>
                </button>

                <div class="cursos-submenu">

                    <a href="#">Básico</a>
                    <a href="#">Intermedio</a>

                </div>

            </div>-->

        </div>

    </div>

</div>

    <!-- CERTIFICADOS -->
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

        <x-nav-link
            :href="route('estudiante.certificados')"
            :active="request()->routeIs('estudiante.certificados')">

            Certificados

        </x-nav-link>

    </div>

@endif
</div>
<style>
/* CONTENEDOR */
.cursos-menu{
    position:relative;
}

/* BOTÓN PRINCIPAL */
.cursos-btn{
    display:flex;
    align-items:center;
    gap:8px;
    background:none;
    border:none;
    padding:10px 16px;
    border-radius:10px;
    font-weight:600;
    color:#111827;
    cursor:pointer;
    transition:.3s;
}

.cursos-btn:hover{
    background:#f3f4f6;
}

/* PANEL PRINCIPAL */
.cursos-panel{
    position:absolute;
    top:48px;
    left:0;
    width:280px;
    background:white;
    border-radius:14px;
    box-shadow:0 12px 30px rgba(0,0,0,.15);
    overflow:hidden;
    display:none;
    z-index:99999;
}

.cursos-panel.active{
    display:block;
}

/* ITEM */
.cursos-item{
    border-bottom:1px solid #f3f4f6;
}

/* BOTÓN ITEM */
.cursos-item-btn{
    width:100%;
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:white;
    border:none;
    padding:14px 18px;
    cursor:pointer;
    font-weight:600;
    color:#111827;
    transition:.3s;
}

.cursos-item-btn:hover{
    background:#eff6ff;
    color:#2563eb;
}

/* SUBMENÚ */
.cursos-submenu{
    display:none;
    background:#f9fafb;
    border-top:1px solid #e5e7eb;
}

.cursos-submenu.active{
    display:block;
}

/* ENLACES */
.cursos-submenu a{
    display:block;
    padding:12px 22px;
    text-decoration:none;
    color:#374151;
    transition:.3s;
}

.cursos-submenu a:hover{
    background:#dbeafe;
    color:#2563eb;
    padding-left:28px;
}
/* Flecha */
.menu-item-btn i{

    transition: transform .3s ease;

}

/* Girar flecha */
.menu-item-btn.active i{

    transform: rotate(90deg);

}
</style>
<script>

document.addEventListener("DOMContentLoaded", function(){

    const btnCursos = document.getElementById("btnCursos");
    const panelCursos = document.getElementById("panelCursos");

    // Abrir / cerrar menú principal
    btnCursos.addEventListener("click", function(e){

        e.preventDefault();
        e.stopPropagation();

        panelCursos.classList.toggle("active");

    });

    // Abrir / cerrar submenús
    document.querySelectorAll(".cursos-item-btn").forEach(btn => {

        btn.addEventListener("click", function(e){

            e.preventDefault();
            e.stopPropagation();

            const submenu = this.nextElementSibling;

            // cerrar otros
            document.querySelectorAll(".cursos-submenu").forEach(menu => {

                if(menu !== submenu){

                    menu.classList.remove("active");

                }

            });

            submenu.classList.toggle("active");

        });

    });

    // Cerrar todo al hacer click fuera
    document.addEventListener("click", function(){

        panelCursos.classList.remove("active");

        document.querySelectorAll(".cursos-submenu").forEach(menu => {

            menu.classList.remove("active");

        });

    });

});

</script>




            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>
                              {{ Auth::user()->nombre }}
                              <span class="text-xs text-gray-400">
                            {{ Auth::user()->rol }}
                             </span>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Finalizar la Sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->nombre }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
