<x-app-layout>
    <div id="modalContainer"></div>




<div class="container">

<h2 class="mb-4">
    <i class="bi bi-journal-bookmark-fill me-2" style="color: #b28a1e;"></i>
    Módulos del Curso: {{ $curso->titulo }}
</h2>

<button class="btn btn-success"
    onclick="abrirModalCrear({{ $curso->id }})">
    + Nuevo Módulo
</button>

<div class="card p-3">
<table class="table table-hover">
    <thead>
        <tr>
           
            <th>Módulo</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @forelse($curso->modulos as $modulo)
            <tr>
                

                <td>
                    <strong>{{ $modulo->titulo }}</strong>
                </td>

                <td>
                    <div class="d-flex gap-2">
                                                
                        {{-- EDITAR --}}
                        <button
                            type="button"
                            class="btn btn-warning btn-sm"
                            onclick="abrirModalEditar({{ $modulo->id }})"
                            title="Editar módulo">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        {{-- VIDEOS --}}
                        <a href="{{ route('admin.videos.index', $modulo->id) }}"
                        class="btn btn-primary btn-sm"
                        title="Crear videos">
                            <i class="bi bi-collection-play-fill"></i>
                            Crear Videos
                        </a>

                        {{-- ELIMINAR --}}
                        <form action="{{ route('admin.modulos.destroy', $modulo->id) }}"
                            method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Eliminar módulo?')"
                                title="Eliminar módulo">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>

                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">No hay módulos</td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>

</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function abrirModalCrear(curso_id) {
    fetch("/admin/cursos/" + curso_id + "/modulos/create")
        .then(response => response.text())
        .then(html => {

            document.getElementById('modalContainer').innerHTML = html;

            document.getElementById('modalCrear').style.display = 'flex';
            
        
        });
}


function cerrarModal() {
    document.getElementById('modalCrear').style.display = 'none';
    
        
}
</script>

<script>
function abrirModalEditar(id) {
    fetch("/admin/modulos/" + id + "/edit")
        .then(response => response.text())
        .then(html => {

            document.getElementById('modalContainer').innerHTML = html;

            document.getElementById('modalEditar').style.display = 'flex';
        });
}

function cerrarModal() {
    document.getElementById('modalContainer').innerHTML = '';
}
</script>
