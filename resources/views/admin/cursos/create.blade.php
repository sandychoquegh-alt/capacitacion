<div id="modalCurso" style="display:none;">

  

    {{-- 🔥 CONTENIDO DEL MODAL --}}
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
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        "
    >

        {{-- HEADER --}}
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <h2>Crear Curso</h2>
            <button onclick="cerrarModal()" style="font-size:20px; border:none; background:none; cursor:pointer;">
                ✖
            </button>
        </div>

        <hr>

        {{-- FORMULARIO --}}
        @include('admin.cursos.form')

    </div>
</div>
