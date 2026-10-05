
 
<script>

function abrirModalPreinscripcion(cursoId) {
    const modal = document.getElementById("modalInscripcion_" + cursoId);
    if (modal) {
        modal.style.display = "flex";
        document.body.style.overflow = "hidden";
    }
}

function cerrarModalInscripcion(cursoId) {
    const modal = document.getElementById("modalInscripcion_" + cursoId);
    if (modal) {
        modal.style.display = "none";
        document.body.style.overflow = "auto";
    }
}
</script>


<script>
function verDetalles(cursoId) {
    const modal = document.getElementById("modalDetalles_" + cursoId);
    if (modal) {
        modal.style.display = "flex";
        document.body.style.overflow = "hidden";
    }
}
function cerrarDetalles(cursoId) {
    const modal = document.getElementById("modalDetalles_" + cursoId);
    if (modal) {
        modal.style.display = "none";
        document.body.style.overflow = "auto";
    }
}
/* cerrar haciendo click fuera */
window.addEventListener("click", function (event) {
    document.querySelectorAll(".modal").forEach(function(modal) {
        if (event.target === modal) {
            modal.style.display = "none";
            document.body.style.overflow = "auto";
        }
    });
});
</script>

<script>
document.querySelectorAll('form[id^="formInscripcion_"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        fetch(this.action, {
            method: "POST",
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) return;
            // 🔥 CONTROL DE MODALES
            if (data.metodo_pago === "bancaria") {
                abrirModalBanco(data.inscripcion_id);
            }
            if (data.metodo_pago === "qr") {
                abrirModalQR(data.inscripcion_id);
            }
        })
        .catch(err => console.error("Error fetch:", err));
    });
});

//  MODAL QR
function abrirModalQR(id){
console.log("INSCRIPCION:",id);
console.log("INSCRIPCION BANCO:",id);
    document.getElementById("inscripcion_id_qr").value = id;
    fetch(`/inscripcion/info/${id}`)
    .then(res => res.json())
    .then(data => {
        document.getElementById("curso_id_qr").value = data.curso_id;
document.getElementById("modalQR").style.display="block";

});

}
//  MODAL BANCO
function abrirModalBanco(id){
console.log("INSCRIPCION BANCO:",id);
document.getElementById("inscripcion_id").value=id;
fetch(`/inscripcion/info/${id}`)
.then(res=>res.json())
.then(data=>{
document.getElementById("curso_id").value=data.curso_id;
document.getElementById("modalBanco").style.display="block";
});
}
</script>

<script>
// FORMULARIO QR
const inputFileQR = document.getElementById('comprobante');
const previewImagenQR = document.getElementById('previewImagen');
const textoPreviewQR = document.getElementById('textoPreview');
// FORMULARIO BANCO
const inputFileBanco = document.getElementById('comprobantet');
const previewImagenBanco = document.getElementById('previewImagent');
const textoPreviewBanco = document.getElementById('textoPreviewt');
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
previewComprobante("comprobante", "previewImagen", "textoPreview");
previewComprobante("comprobantet", "previewImagent", "textoPreviewt");
</script>