<div id="modalCurso" style="display:none;">

    {{-- 🔥 FONDO OSCURO --}}
    <div onclick="cerrarModal()"
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

    {{-- 🔥 MODAL CENTRADO --}}
    <div
        style="
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 25px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            z-index: 1000;
        "
    >

        {{-- HEADER --}}
        <div style="display:flex; justify-content:space-between;">
            <h2>Editar Curso</h2>
            <button onclick="cerrarModal()">✖</button>
        </div>

        <hr>

        {{-- 🔥 FORMULARIO --}}
        @include('admin.cursos.form')

    </div>
</div>

<script>
function cerrarModal() {
    document.getElementById('modalCurso').style.display = 'none';
}
</script>