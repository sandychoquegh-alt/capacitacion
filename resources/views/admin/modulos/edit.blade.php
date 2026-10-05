<div id="modalEditar" class="modal-custom">
    <div class="modal-box">

        <h3>✏️ Editar Módulo</h3>

        <form method="POST" action="{{ route('admin.modulos.update', $modulo->id) }}">
            @csrf
            @method('PUT')

            <input type="text" name="titulo"
                class="form-control mb-2"
                value="{{ $modulo->titulo }}"
                required>

            <button class="btn btn-warning">Actualizar</button>
            <button type="button" class="btn btn-secondary" onclick="cerrarModal()">
                Cancelar
            </button>

        </form>

    </div>
</div>