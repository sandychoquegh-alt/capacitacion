<script>

let inscripcionActual = {};

function inscribirse(curso_id){

    fetch("/inscripciones/store",{

        method:"POST",

        headers:{
            "Content-Type":"application/json",
            "X-CSRF-TOKEN":document
                .querySelector('meta[name="csrf-token"]')
                .content
        },

        body:JSON.stringify({

            curso_id:curso_id

        })

    })

    .then(res=>res.json())

    .then(data=>{

        if(!data.success){

            alert(data.message);

            return;

        }

        inscripcionActual=data;

        abrirModalmetPago();

    });

}

// ======================================
// ABRIR MODAL PRINCIPAL
// ======================================

function abrirModalmetPago(){

    document.getElementById(
        'modalPago'
    ).style.display = 'flex';
}

// ======================================
// CERRAR
// ======================================

function cerrarModalPago(){

    document.getElementById(
        'modalPago'
    ).style.display = 'none';
}

// ======================================
// QR
// ======================================

function mostrarQR(){

    document.getElementById("inscripcion_id_qr").value =
        inscripcionActual.inscripcion_id;

    document.getElementById("curso_id_qr").value =
        inscripcionActual.curso_id;

    cerrarModalPago();

    document.getElementById("modalQR").style.display = "flex";

}

function cerrarModalQR(){

    document.getElementById(
        'modalQR'
    ).style.display = 'none';
}

// ======================================
// BANCO
// ======================================

function mostrarBanco(){

    // Llenar los campos ocultos
    document.getElementById("inscripcion_id_banco").value =
        inscripcionActual.inscripcion_id;

    document.getElementById("curso_id_banco").value =
        inscripcionActual.curso_id;

    // Mostrar el monto
    document.getElementById("montoBanco").innerHTML =
        inscripcionActual.monto;

    // Cerrar el modal de métodos de pago
    cerrarModalPago();

    // Abrir el modal Banco
    document.getElementById("modalBanco").style.display = "flex";

}

function cerrarModalBanco(){

    document.getElementById(
        'modalBanco'
    ).style.display = 'none';
}


</script>

<script>

// ======================================
// PREVIEW IMAGEN
// ======================================

const comprobante =
    document.getElementById(
        'comprobante'
    );

const previewImagen =
    document.getElementById(
        'previewImagen'
    );

const textoPreview =
    document.getElementById(
        'textoPreview'
    );

comprobante.addEventListener(
    'change',

    function(e){

        const archivo =
            e.target.files[0];

        if(!archivo) return;

        const reader =
            new FileReader();

        reader.onload = function(ev){

            previewImagen.src =
                ev.target.result;

            previewImagen.style.display =
                'block';

            textoPreview.style.display =
                'none';
        };

        reader.readAsDataURL(
            archivo
        );

    }
);

// =====================================================
// FORMULARIO QR
// =====================================================
const inputFileQR = document.getElementById("comprobanteQR");
const previewImagenQR = document.getElementById("previewImagenQR");
const textoPreviewQR = document.getElementById("textoPreviewQR");

// =====================================================
// FORMULARIO BANCO
// =====================================================
const inputFileBanco = document.getElementById("comprobanteBanco");
const previewImagenBanco = document.getElementById("previewImagenBanco");
const textoPreviewBanco = document.getElementById("textoPreviewBanco");


// =====================================================
// PREVISUALIZAR COMPROBANTE
// =====================================================
function previewComprobante(inputId, previewId, textoId){

    const input = document.getElementById(inputId);

    if(!input) return;

    const preview = document.getElementById(previewId);
    const texto = document.getElementById(textoId);

    input.addEventListener("change", function(e){

        const archivo = e.target.files[0];

        if(!archivo) return;

        const lector = new FileReader();

        lector.onload = function(evento){

            preview.src = evento.target.result;

            preview.style.display = "block";

            texto.innerHTML = "✅ Imagen seleccionada correctamente";

        };

        lector.readAsDataURL(archivo);

    });

}


// =====================================================
// ACTIVAR PREVIEW QR
// =====================================================
previewComprobante(
    "comprobanteQR",
    "previewImagenQR",
    "textoPreviewQR"
);


// =====================================================
// ACTIVAR PREVIEW BANCO
// =====================================================
previewComprobante(
    "comprobanteBanco",
    "previewImagenBanco",
    "textoPreviewBanco"
);

</script>


