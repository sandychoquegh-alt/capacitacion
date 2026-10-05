<x-app-layout>
    <div id="modalContainer"></div>




<div class="container">

<h2 class="mb-4">📚 Módulos del Curso: {{ $curso->titulo }}</h2>

<button class="btn btn-success"
    onclick="abrirModalCrear({{ $curso->id }})">
    + Nuevo Módulo
</button>

<div class="card p-3">
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Módulo</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @forelse($curso->modulos as $modulo)
            <tr>
                <td>{{ $modulo->orden }}</td>

                <td>
                    <strong>{{ $modulo->titulo }}</strong>
                </td>

                <td>
                    <div class="d-flex gap-2">
                        

                        {{-- EDITAR --}}
          
                        <button class="btn btn-warning btn-sm"
    onclick="abrirModalEditar({{ $modulo->id }})">
    ✏️
</button>

<a href="{{ route('admin.videos.index', $modulo->id) }}"
    class="btn btn-primary btn-sm">
    🎬 Ver Videos
</a>
                        {{-- ELIMINAR --}}
                        <form action="{{ route('admin.modulos.destroy', $modulo->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Eliminar módulo?')">
                                🗑
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
