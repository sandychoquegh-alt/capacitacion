<nav class="navbar navbar-expand-lg navbar-dark bg-primary-custom fixed-top shadow-sm">
  <div class="container-fluid px-4">

    <!-- LOGO -->
    <a class="navbar-brand fw-bold text-warning" href="/">
      <img
    src="{{ asset('img/FHB PNG.PNg') }}"
    alt="Logo"
    style="
        width:50px;
        height:50px;
        transform:scale(2.5);
    ">

    <!-- <p> ACADEMIA</p>-->
    </a>

    <!-- TOGGLER -->
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <i class="fa-solid fa-bars" id="iconMenu"></i>
    </button>

    <!-- CONTENIDO -->
    <div class="collapse navbar-collapse" id="navbarMain">

      <!--  MOBILE: BUSCADOR ARRIBA -->
      <div class="d-lg-none mb-3">
        <div class="search-box w-100">
          <input type="text" placeholder="Buscar cursos...">
        </div>
      </div>

      <!--  MOBILE: BOTONES ARRIBA -->
      <div class="d-lg-none mb-3 border-bottom pb-3">
        <a href="{{ route('login') }}" class="btn btn-light w-100 mb-2 fw-semibold">
          Iniciar sesión
        </a>
        <a href="{{ route('register') }}" class="btn btn-warning w-100 fw-semibold">
          Registrarse
        </a>
      </div>

      <!-- MENÚ -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-lg-3">
       
        <li class="nav-item">
             <a class="nav-link" href="#nosotros">
              Nosotros
             </a>
        </li>
        <li class="nav-item">
          <a class="nav-link "  href="#empresas">empresas</a>
          
        </li>

           <li class="nav-item dropdown">

            <a href="javascript:void(0)" class="nav-link">
                  Cursos
                 <i class="fa-solid fa-chevron-down"></i>
            </a>

    <div class="dropdown-menu">

        <div class="dropdown-item">
            <a href="#" class="dropdown-link">
                Desarrollo Web
                <i class="fa-solid fa-chevron-right"></i>
            </a>

            <div class="submenu">
                <a href="#">Landing Pages</a>
                <a href="#">Sistemas Web</a>
                <a href="#">Tiendas Online</a>
                <a href="#">Portales Empresariales</a>
            </div>
        </div>

        <div class="dropdown-item">
            <a href="#" class="dropdown-link">
                Diseño UX/UI
                <i class="fa-solid fa-chevron-right"></i>
            </a>

            <div class="submenu">
                <a href="#">Wireframes</a>
                <a href="#">Prototipos</a>
                <a href="#">Diseño Mobile</a>
                <a href="#">Experiencia Usuario</a>
            </div>
        </div>

        <div class="dropdown-item">
            <a href="#" class="dropdown-link">
                Marketing Digital
                <i class="fa-solid fa-chevron-right"></i>
            </a>

            <div class="submenu">
                <a href="#">SEO</a>
                <a href="#">Publicidad</a>
                <a href="#">Redes Sociales</a>
            </div>
        </div>

    </div>

</li>
        
        
      </ul>

      <!--  DESKTOP: BUSCADOR -->
     <div class="search-box d-none d-lg-block me-3">

    <input 
        type="text" 
        id="buscador"
        placeholder="Buscar cursos..."
        autocomplete="off">

    <div id="resultadosBusqueda"></div>

</div>

      <!-- BOTONES DESKTOP {{ route('login') }}
       {{ route('register') }}
       -->
      <div class="d-none d-lg-flex gap-2">
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3">
          Iniciar sesión
        </a>
        <a href="{{ route('register') }}" class="btn btn-warning btn-sm px-3">
          Registrarse
        </a>
      </div>

    </div>
  </div>
</nav>