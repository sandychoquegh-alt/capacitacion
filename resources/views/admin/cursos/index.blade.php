<x-app-layout>
    <div id="modalContainer"></div>
<div class="admin-container">


<div class="mb-3">
<button class="btn btn-primary" onclick="abrirModalCurso()">
    + Nuevo Curso
</button>
</div>


<div class="table-container">
<table class="table">
    <thead>
        <tr>
            <th>Título</th>
            <th>Imagen</th>
            <th>ImagenQR</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($cursos as $curso)
        <tr>
            <td>{{ $curso->titulo }}</td>

            <td>
                @if($curso->imagen)
                    <img src="{{ asset('storage/' . $curso->imagen) }}" class="img-thumb">
                @endif
            </td>
            <td><!-- de aca debo de llevar para afuera -->
                @if($curso->imgqr)
                    <img src="{{ asset('storage/' . $curso->imgqr) }}" class="img-thumb">
                @endif
            </td>

            <td>
                @if($curso->estado == 'activo')
                    <span class="badge badge-activo">Activo</span>
                @else
                    <span class="badge badge-inactivo">Inactivo</span>
                @endif
            </td>

            <td>
                <button onclick="abrirModalEditar({{ $curso->id }})" class="btn btn-warning btn-sm">
                   <i class="bi bi-pencil-square"></i>   
                    Editar
                </button>
               <a href="{{ route('admin.modulos.index', $curso->id) }}" 
                class="btn btn-primary btn-sm">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    Crear Módulos
                </a>
                <form action="{{ route('admin.cursos.destroy', $curso->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                         onclick="return confirm('¿Eliminar este curso?')">
                <i class="bi bi-trash"></i>
                        Eliminar
                    </button>
         
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

</div>
<style>
    /* CONTENEDOR */
.admin-container {
    max-width: 1100px;
    margin: auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

/* TITULOS */
.admin-title {
    font-size: 22px;
    margin-bottom: 20px;
}

/* BOTONES */
.btn {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 5px;
    font-size: 13px;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: #1d4ed8;
    color: white;
}

.btn-warning {
    background: #f59e0b;
    color: white;
}

.btn-danger {
    background: #dc2626;
    color: white;
}

.btn-sm {
    font-size: 12px;
    padding: 5px 8px;
}

/* TABLAS */
.table-container {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    overflow: hidden;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table thead {
    background: #f1f1f1;
}

.table th,
.table td {
    padding: 12px;
}

.table tr {
    border-bottom: 1px solid #ddd;
}

.table tr:hover {
    background: #f9f9f9;
}

/* BADGES */
.badge {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
}

.badge-activo {
    background: #e6f4ea;
    color: #1e7e34;
}

.badge-inactivo {
    background: #fbeaea;
    color: #a71d2a;
}

/* IMAGEN */
.img-thumb {
    width: 80px;
    border-radius: 5px;
}

/* ESPACIADO */
.mb-3 {
    margin-bottom: 15px;
}
</style>
</x-app-layout>

<script>
function abrirModalCurso() {
    fetch("{{ route('admin.cursos.create') }}")
        .then(response => response.text())
        .then(html => {
            document.getElementById('modalContainer').innerHTML = html;

            // mostrar modal
            document.getElementById('modalCurso').style.display = 'block';
        });
}
function cerrarModal() {
    document.getElementById('modalCurso').style.display = 'none';
}
</script>

<script>
function abrirModalEditar(id) {
    fetch(`/admin/cursos/${id}/edit`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('modalContainer').innerHTML = html;

            document.getElementById('modalCurso').style.display = 'block';
        });
}
</script>
