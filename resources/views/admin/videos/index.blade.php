<x-app-layout>
<div class="admin-container">

<h2 class="admin-title">Videos del Curso: {{ $modulo->titulo }}</h2>

<button class="btn btn-primary" onclick="abrirModal()">
    + Nuevo Video
</button>

<div class="table-container">
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Título</th>
            <th>Video</th>
            <th>Acciones</th>
        </tr>
    </thead>

   <tbody id="sortableVideos">
@forelse($modulo->videos as $video)
    <tr data-id="{{ $video->id }}">
    <td>☰</td>
        
        <td>{{ $video->titulo }}</td>

        <td>
            @if($video->youtube_id)
    <iframe width="220" height="130"
    style="border-radius:10px;"
    src="https://www.youtube.com/embed/{{ $video->youtube_id }}"
    frameborder="0"
    allowfullscreen>
</iframe>
@else
    <span style="color:red;">Video no disponible</span>
@endif
        </td>

       <td>
    <div style="display:flex; gap:8px;">

        {{-- EDITAR --}}
        <button 
            onclick="abrirModalEditar({{ $video->id }}, '{{ $video->titulo }}', '{{ $video->youtube_id }}')" 
            class="btn btn-warning btn-sm">
            <i class="bi bi-pencil-square"></i>
        </button>

        {{-- ELIMINAR --}}
        <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger btn-sm"
                onclick="return confirm('¿Eliminar este video?')">
                <i class="bi bi-trash"></i>
            </button>
        </form>

    </div>
</td>
    </tr>
@empty
    <tr>
        <td colspan="3" style="text-align:center;">
            No hay videos registrados
        </td>
    </tr>
    
@endforelse
</tbody>
</table>
</div>

</div>

/* modal para editar el video*/

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

