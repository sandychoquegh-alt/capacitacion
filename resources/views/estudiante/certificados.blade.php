<x-app-layout>
    Contenido de la página

<div class="container-certificados">

    <!-- TITULO -->
    <div class="header-certificados">

        <h1>
             Mis Certificados
        </h1>

        <p>
            Aquí podrás visualizar y descargar
            todos los certificados obtenidos.
        </p>

    </div>



    <!-- GRID -->
    <div class="grid-certificados">

        @if(isset($certificados) && $certificados->count())

            @foreach($certificados as $certificado)

            <div class="card-certificado">

                <!-- ICONO -->
                <div class="icono-certificado">
                
                </div>

                <!-- CODIGO -->
                <h2>
                    {{ $certificado->codigo }}
                </h2>

                <!-- BOTON -->
                <a
                    href="{{ asset('storage/' . $certificado->ruta) }}"
                    target="_blank"
                    class="btn-ver-certificado">

                    👁 Ver Certificado

                </a>

            </div>

            @endforeach

        @else

            <!-- MENSAJE -->
            <div class="sin-certificados">

                <div class="icono-vacio">
                    
                </div>

                <h2>
                    Aún no tienes certificados
                </h2>

                <p>
                    Completa un curso para poder
                    generar y visualizar tus certificados.
                </p>

            </div>

        @endif

    </div>

</div>



<style>

.sin-certificados{
    width:100%;

    background:#fff;

    border-radius:24px;

    padding:60px 30px;

    text-align:center;

    box-shadow:
        0 10px 30px rgba(0,0,0,0.08);
}

.icono-vacio{
    font-size:70px;

    margin-bottom:20px;
}

.sin-certificados h2{
    font-size:28px;

    color:#111827;

    margin-bottom:12px;
}

.sin-certificados p{
    color:#6b7280;

    font-size:16px;

    max-width:500px;

    margin:auto;

    line-height:1.7;
}

</style>



<style>

.container-certificados{
    width:100%;
    padding:40px 20px;
}

/* HEADER */
.header-certificados{
    margin-bottom:35px;
}

.header-certificados h1{
    font-size:34px;
    font-weight:800;
    color:#111827;

    margin-bottom:10px;
}

.header-certificados p{
    color:#6b7280;
    font-size:16px;
}

/* GRID */
.grid-certificados{
    display:grid;
    grid-template-columns:
        repeat(auto-fit,minmax(320px,1fr));

    gap:25px;
}

/* CARD */
.card-certificado{
    background:#fff;

    border-radius:22px;

    padding:28px;

    display:flex;
    flex-direction:column;

    gap:20px;

    box-shadow:
        0 10px 30px rgba(0,0,0,0.08);

    transition:0.3s;

    border:1px solid #f1f1f1;
}

.card-certificado:hover{
    transform:translateY(-6px);

    box-shadow:
        0 15px 40px rgba(0,0,0,0.12);
}

/* ICONO */
.icono-certificado{
    width:75px;
    height:75px;

    border-radius:18px;

    background:
        linear-gradient(
            135deg,
            #7c3aed,
            #9333ea
        );

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:34px;

    color:#fff;
}

/* INFO */
.info-certificado h2{
    font-size:22px;
    font-weight:700;

    color:#111827;

    margin-bottom:8px;
}

.info-certificado p{
    color:#6b7280;
    line-height:1.5;
}

/* BOTON */
.btn-ver-certificado{
    text-decoration:none;

    background:
        linear-gradient(
            135deg,
            #7c3aed,
            #9333ea
        );

    color:#fff;

    padding:14px 18px;

    border-radius:14px;

    text-align:center;

    font-weight:700;

    transition:0.3s;
}

.btn-ver-certificado:hover{
    transform:scale(1.03);

    box-shadow:
        0 10px 25px rgba(147,51,234,0.3);
}

</style>

</x-app-layout>
