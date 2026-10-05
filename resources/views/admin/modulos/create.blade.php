<div id="modalCrear" class="modal-custom">
    <div class="modal-box">

        <h3>📚 Nuevo Módulo</h3>

        <form method="POST" action="{{ route('admin.modulos.store') }}">
            @csrf

            <input type="hidden" name="curso_id" value="{{ $curso->id }}">

            <input type="text" name="titulo" class="form-control mb-2"
                placeholder="Nombre del módulo" required>

            <button class="btn btn-success">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cancelar</button>

        </form>

    </div>
</div>

