<x-app-layout>
     <div class="max-w-7xl mx-auto px-6 py-8">

     <h2>{{ $curso->titulo }}</h2>

<p>{{ $curso->descripcion }}</p>

<p>
    Estado: 
    <strong>{{ $curso->estado }}</strong>
</p>

<a href="{{ route('cursos.edit', $curso->id) }}">Editar</a>
<a href="{{ route('cursos.index') }}">Volver</a>
</div>
</x-app-layout>