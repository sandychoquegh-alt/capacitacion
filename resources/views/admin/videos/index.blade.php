<x-app-layout>
<div class="admin-container">

<div class="videos-header">
    <div>
        <span class="videos-subtitle">GESTIÓN DE CONTENIDO</span>
        <h2 class="admin-title">
            Videos del Curso: <strong>{{ $modulo->titulo }}</strong>
        </h2>
        <p class="videos-description">
            Administra los videos correspondientes a este módulo del curso.
        </p>
    </div>

    <button class="btn-new-video" onclick="abrirModal()">
        <i class="bi bi-plus-lg"></i>
        Nuevo Video
    </button>
</div>

<div class="videos-card">

    <div class="videos-card-header">
        <div>
            <h5>
                <i class="bi bi-play-circle"></i>
                Videos registrados
            </h5>
            <span>Arrastra los videos para cambiar su orden.</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="videos-table">
            <thead>
                <tr>
                    <th class="order-column">Orden</th>
                    <th>Título</th>
                    <th>Video</th>
                    <th class="actions-column">Acciones</th>
                </tr>
            </thead>

            <tbody id="sortableVideos">

                @forelse($modulo->videos as $video)

                    <tr data-id="{{ $video->id }}">

                        {{-- ORDEN --}}
                        <td class="order-column">
                            <span class="drag-handle" title="Arrastrar para ordenar">
                                <i class="bi bi-grip-vertical"></i>
                            </span>
                        </td>

                        {{-- TÍTULO --}}
                        <td>
                            <div class="video-title">
                                {{ $video->titulo }}
                            </div>
                        </td>

                        {{-- VIDEO --}}
                        <td>
                            @if($video->youtube_id)

                                <div class="youtube-preview">
                                    <iframe
                                        src="https://www.youtube.com/embed/{{ $video->youtube_id }}"
                                        title="{{ $video->titulo }}"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen>
                                    </iframe>
                                </div>

                            @else

                                <span class="video-unavailable">
                                    <i class="bi bi-exclamation-circle"></i>
                                    Video no disponible
                                </span>

                            @endif
                        </td>

                        {{-- ACCIONES --}}
                        <td class="actions-column">

                            <div class="video-actions">

                                {{-- EDITAR --}}
                                <button
                                    type="button"
                                    onclick="abrirModalEditar(
                                        {{ $video->id }},
                                        @js($video->titulo),
                                        @js($video->youtube_id)
                                    )"
                                    class="action-btn edit-btn"
                                    title="Editar video">

                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                {{-- ELIMINAR --}}
                                <form
                                    action="{{ route('admin.videos.destroy', $video->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('¿Está seguro de eliminar este video?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn delete-btn"
                                        title="Eliminar video">

                                        <i class="bi bi-trash3"></i>
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="empty-videos">

                            <div class="empty-icon">
                                <i class="bi bi-camera-video"></i>
                            </div>

                            <h6>No hay videos registrados</h6>

                            <p>
                                Agrega el primer video de este módulo para comenzar.
                            </p>

                            <button class="btn-new-video empty-button" onclick="abrirModal()">
                                <i class="bi bi-plus-lg"></i>
                                Agregar video
                            </button>

                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>
    </div>

</div>

</div>

<!--/* modal para editar el video*/-->

<div id="modalEditar" class="modal">
    <div class="modal-content">

        <span onclick="cerrarModalEditar()" class="close">&times;</span>

        <h3>Editar Video</h3>

        <form id="formEditar" method="POST">
            @csrf
            @method('PUT')

            {{-- TITULO --}}
            <div class="form-group">
                <label>Título</label>
                <input type="text" name="titulo" id="editTitulo" class="form-control" required>
            </div>

            {{-- URL YOUTUBE --}}
            <div class="form-group">
                <label>URL YouTube</label>
                <input type="text" name="youtube_url" id="editYoutube" 
                       class="form-control" oninput="previewEdit()" required>
            </div>

            {{-- PREVIEW --}}
            <iframe id="previewEdit" width="100%" height="200"
                style="margin-top:10px; border-radius:10px;">
            </iframe>

            <button class="btn btn-primary" style="margin-top:15px;">
                Actualizar
            </button>

        </form>

    </div>
</div>

<script>
function abrirModalEditar(id, titulo, youtube_id) {
    document.getElementById('modalEditar').style.display = 'flex';

    document.getElementById('editTitulo').value = titulo;

    let url = "https://www.youtube.com/watch?v=" + youtube_id;
    document.getElementById('editYoutube').value = url;

    document.getElementById('previewEdit').src =
        "https://www.youtube.com/embed/" + youtube_id;

    document.getElementById('formEditar').action = "/admin/videos/" + id;
}

function cerrarModalEditar() {
    document.getElementById('modalEditar').style.display = 'none';
}

function previewEdit() {
    let url = document.getElementById('editYoutube').value;
    let match = url.match(/(?:v=|youtu\.be\/)([^&]+)/);

    if(match) {
        document.getElementById('previewEdit').src =
            "https://www.youtube.com/embed/" + match[1];
    }
}
</script>
<style>
    /* MODAL */
.modal {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
}

.modal-content {
    background: white;
    width: 400px;
    margin: 10% auto;
    padding: 20px;
    border-radius: 8px;
    position: relative;
}

.close {
    position: absolute;
    right: 15px;
    top: 10px;
    font-size: 20px;
    cursor: pointer;
}

 /* =========================================
    GESTIÓN DE VIDEOS
    ========================================= */

.videos-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 25px;
    margin-bottom: 25px;
}

.videos-subtitle {
    display: block;
    margin-bottom: 7px;
    color: #b28a1e;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
}

.admin-title {
    margin: 0;
    color: #16233b;
    font-size: 26px;
    font-weight: 700;
}

.admin-title strong {
    color: #b28a1e;
}

.videos-description {
    margin: 7px 0 0;
    color: #6c757d;
    font-size: 14px;
}

/* Botón nuevo video */

.btn-new-video {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 11px 18px;
    border: none;
    border-radius: 8px;
    background: #16233b;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.btn-new-video:hover {
    background: #b28a1e;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(22, 35, 59, 0.15);
}

/* Tarjeta */

.videos-card {
    overflow: hidden;
    border: 1px solid #e6e9ee;
    border-radius: 12px;
    background: #fff;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
}

.videos-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 22px;
    border-bottom: 1px solid #edf0f4;
    background: #fafbfc;
}

.videos-card-header h5 {
    display: flex;
    align-items: center;
    gap: 9px;
    margin: 0;
    color: #16233b;
    font-size: 16px;
    font-weight: 700;
}

.videos-card-header h5 i {
    color: #b28a1e;
}

.videos-card-header span {
    display: block;
    margin-top: 4px;
    color: #7a8494;
    font-size: 12px;
}

/* Tabla */

.table-responsive {
    overflow-x: auto;
}

.videos-table {
    width: 100%;
    margin: 0;
    border-collapse: collapse;
}

.videos-table thead th {
    padding: 15px 18px;
    border-bottom: 1px solid #e7eaf0;
    background: #fff;
    color: #687386;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.4px;
    text-align: left;
    text-transform: uppercase;
    white-space: nowrap;
}

.videos-table tbody tr {
    border-bottom: 1px solid #edf0f4;
    transition: background 0.2s ease;
}

.videos-table tbody tr:last-child {
    border-bottom: none;
}

.videos-table tbody tr:hover {
    background: #fafbfc;
}

.videos-table tbody td {
    padding: 17px 18px;
    vertical-align: middle;
}

/* Orden */

.order-column {
    width: 75px;
    text-align: center !important;
}

.drag-handle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 7px;
    background: #f1f3f6;
    color: #7a8494;
    cursor: grab;
    transition: all 0.2s ease;
}

.drag-handle:hover {
    background: #e7eaf0;
    color: #16233b;
}

.drag-handle:active {
    cursor: grabbing;
}

/* Título */

.video-title {
    max-width: 280px;
    color: #26344d;
    font-size: 14px;
    font-weight: 600;
    line-height: 1.5;
}

/* YouTube */

.youtube-preview {
    width: 220px;
    height: 125px;
    overflow: hidden;
    border-radius: 9px;
    background: #101010;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
}

.youtube-preview iframe {
    display: block;
    width: 100%;
    height: 100%;
    border: 0;
}

/* Video no disponible */

.video-unavailable {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 10px;
    border-radius: 6px;
    background: #fff4f4;
    color: #c0392b;
    font-size: 13px;
    font-weight: 500;
}

/* Acciones */

.actions-column {
    width: 130px;
    text-align: center !important;
}

.video-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.video-actions form {
    margin: 0;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    padding: 0;
    border: none;
    border-radius: 7px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.edit-btn {
    background: #fff7df;
    color: #a77900;
}

.edit-btn:hover {
    background: #b28a1e;
    color: #fff;
}

.delete-btn {
    background: #fff0f0;
    color: #c0392b;
}

.delete-btn:hover {
    background: #c0392b;
    color: #fff;
}

/* Sin videos */

.empty-videos {
    padding: 55px 20px !important;
    text-align: center !important;
}

.empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    margin: 0 auto 15px;
    border-radius: 50%;
    background: #f3f5f8;
    color: #8993a3;
    font-size: 25px;
}

.empty-videos h6 {
    margin: 0 0 6px;
    color: #26344d;
    font-size: 15px;
    font-weight: 700;
}

.empty-videos p {
    margin: 0 0 18px;
    color: #7a8494;
    font-size: 13px;
}

.empty-button {
    padding: 9px 15px;
    font-size: 13px;
}

/* Responsive */

@media (max-width: 768px) {

    .videos-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .btn-new-video {
        width: 100%;
    }

    .admin-title {
        font-size: 21px;
    }

    .videos-card-header {
        padding: 15px;
    }

    .videos-table tbody td,
    .videos-table thead th {
        padding: 12px;
    }

    .youtube-preview {
        width: 180px;
        height: 105px;
    }
}
.videos-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 25px;
    margin: 0 25px 25px;
}

.videos-card {
    margin: 0 25px;
}
</style>
<div id="previewVideo" style="margin-top:10px;"></div>

</x-app-layout>

<div id="modalVideo" class="modal">
    <div class="modal-content">

        <span class="close" onclick="cerrarModal()">&times;</span>

        <h3>Agregar Video</h3>

        <form action="{{ route('admin.videos.store', $modulo->id) }}" method="POST">
    @csrf

    

            
            {{-- TITULO --}}
            <div class="form-group">
                <label>Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>

            {{-- URL YOUTUBE --}}
            <div class="form-group">
                <label>URL YouTube</label>
                <input type="text" name="youtube_url" id="youtube_url" 
                       class="form-control" oninput="previewVideo()" required>
            </div>

            {{-- PREVIEW --}}
            <iframe id="preview" width="100%" height="200"
                style="margin-top:10px; border-radius:8px;">
            </iframe>

            <button class="btn btn-primary" style="margin-top:15px;">
                Guardar
            </button>

        </form>

    </div>
</div>
<iframe id="preview" width="100%" height="200"></iframe>

<script>
function previewVideo() {
    let url = document.getElementById('youtube_url').value;
    let match = url.match(/(?:v=|youtu\.be\/)([^&]+)/);

    if(match) {
        document.getElementById('preview').src =
            "https://www.youtube.com/embed/" + match[1];
    }
}
</script>
<script>
function abrirModal() {
    document.getElementById('modalVideo').style.display = 'block';
}

function cerrarModal() {
    document.getElementById('modalVideo').style.display = 'none';
}

// cerrar si hace click fuera
window.onclick = function(event) {
    let modal = document.getElementById('modalVideo');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}
</script>

<script>
document.getElementById('urlVideo').addEventListener('input', function() {
    let url = this.value;

    // 👉 Detectar formato corto (youtu.be)
    if (url.includes('youtu.be/')) {
        let id = url.split('youtu.be/')[1].split('?')[0];
        this.value = 'https://www.youtube.com/watch?v=' + id;
    }

    // 👉 Detectar embed y convertir
    if (url.includes('embed/')) {
        let id = url.split('embed/')[1];
        this.value = 'https://www.youtube.com/watch?v=' + id;
    }
});
</script>


<script>
document.getElementById('urlVideo').addEventListener('blur', function() {
    let url = this.value;
    let id = '';

    if (url.includes('v=')) {
        id = url.split('v=')[1].split('&')[0];
    }

    if (id) {
        document.getElementById('previewVideo').innerHTML =
            `<iframe width="100%" height="200"
                src="https://www.youtube.com/embed/${id}"
                frameborder="0" allowfullscreen></iframe>`;
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
new Sortable(document.getElementById('sortableVideos'), {
    animation: 150,
    onEnd: function () {

        let orden = [];

        document.querySelectorAll('#sortableVideos tr').forEach((el, index) => {
            orden.push({
                id: el.dataset.id,
                orden: index + 1
            });
        });

        fetch("{{ route('admin.videos.ordenar') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ orden: orden })
        });
    }
});
</script>

