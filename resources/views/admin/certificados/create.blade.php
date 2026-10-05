<div id="modalCertificado" style="display:none;">

    <!-- 🔴 FONDO OSCURO (OVERLAY) -->
    <div
        onclick="cerrarModalCertificado()"
        style="
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 999;
        ">
    </div>

    <!-- 🟢 MODAL CONTENIDO -->
    <div
        style="
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            width: 100%;
            max-width: 520px;
            border-radius: 14px;
            padding: 25px;
            z-index: 1000;
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        ">

        <!-- HEADER -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">

            <h2 style="margin:0; font-size:22px; font-weight:bold;">
                Crear Certificado
            </h2>

            <button
                onclick="cerrarModalCertificado()"
                style="
                    font-size:22px;
                    border:none;
                    background:none;
                    cursor:pointer;
                ">
                ✕
            </button>

        </div>

        <hr style="margin-bottom:15px;">

        <!-- FORM -->
   <div 
style="
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,.65);
display:flex;
justify-content:center;
align-items:center;
padding:20px;
z-index:999;
">


<div

style="
background:white;
width:100%;
max-width:550px;
max-height:90vh;
overflow-y:auto;
border-radius:18px;
padding:25px;
box-shadow:0 20px 50px rgba(0,0,0,.3);
">


<!-- HEADER -->

<div style="
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
">


<h2 style="
font-size:22px;
font-weight:700;
">

Crear Certificado

</h2>


<button
onclick="cerrarModalCertificado()"
style="
border:none;
background:none;
font-size:25px;
cursor:pointer;
">

✕

</button>


</div>



<!-- FORMULARIO -->

<form>


@csrf



<div style="
display:grid;
grid-template-columns:1fr 1fr;
gap:15px;
">


<!-- NOMBRE -->

<div>

<label>Nombre</label>

<input
type="text"
style="
width:100%;
padding:9px;
border:1px solid #ddd;
border-radius:8px;
">

</div>



<!-- APELLIDOS -->

<div>

<label>Apellidos</label>

<input
type="text"
style="
width:100%;
padding:9px;
border:1px solid #ddd;
border-radius:8px;
">

</div>


</div>




<!-- SIGLA -->

<div style="margin-top:15px;">

<label>Sigla certificado</label>

<input
type="text"
placeholder="CERT-001"
style="
width:100%;
padding:9px;
border:1px solid #ddd;
border-radius:8px;
">


</div>





<!-- CURSO -->

<div style="margin-top:15px;">


<label>Curso</label>


<input
type="text"
placeholder="Nombre del curso"
style="
width:100%;
padding:9px;
border:1px solid #ddd;
border-radius:8px;
">


</div>






<!-- DESCRIPCION -->


<div style="margin-top:15px;">


<label>Descripción</label>


<textarea

rows="3"

style="
width:100%;
padding:9px;
border:1px solid #ddd;
border-radius:8px;
resize:none;
">

</textarea>


</div>






<!-- FECHA -->

<div style="margin-top:15px;">


<label>Fecha emisión</label>


<input
type="date"

style="
width:100%;
padding:9px;
border:1px solid #ddd;
border-radius:8px;
">


</div>





<button

style="
margin-top:20px;
width:100%;
padding:12px;
border:none;
border-radius:10px;
background:linear-gradient(135deg,#2563eb,#1e40af);
color:white;
font-weight:bold;
cursor:pointer;
">

Gererar certificado

</button>



</form>



</div>


</div>

    </div>

</div>
<style>
    /* FONDO OSCURO */
.modal-certificado {

    display:none;

    position:fixed;

    top:0;
    left:0;

    width:100%;
    height:100vh;

    background:rgba(0,0,0,0.65); /* 👈 fondo oscuro */

    backdrop-filter: blur(4px); /* efecto profesional */

    z-index:9999;

    justify-content:center;
    align-items:center;

}

@keyframes aparecerModal {

    from{
        opacity:0;
        transform:translateY(-20px) scale(.95);
    }


    to{
        opacity:1;
        transform:translateY(0) scale(1);
    }

}


.animate-modal{

    animation:
        aparecerModal .25s ease;

}


</style>


<script>

function abrirModalCertificado(){

    const modal =
        document.getElementById('modalCertificado');


    modal.classList.remove('hidden');

    modal.classList.add('flex');

}



function cerrarModalCertificado(){

    const modal =
        document.getElementById('modalCertificado');


    modal.classList.add('hidden');

    modal.classList.remove('flex');

}

</script>