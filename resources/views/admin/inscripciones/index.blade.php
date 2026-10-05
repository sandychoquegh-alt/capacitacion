<x-app-layout>
<div class="contenedor">

    <h2 class="titulo">
        <!-- ICONO -->
        <svg class="icono" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="2" d="M9 17v-6h6v6m-6 0h6M5 21h14a2 2 0 002-2V7l-7-4-7 4v12a2 2 0 002 2z"/>
        </svg>
        Gestión de Inscripciones
    </h2>

    {{-- ALERTAS --}}
    @if(session('success'))
        <div class="alerta exito">
            <svg class="icono-small" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alerta error">
            <svg class="icono-small" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="tabla-container">
        <table class="tabla">

            <thead class="tabla-header">
                <tr>
                    <th>Usuario</th>
                    <th>Curso</th>
                    <th>comprobante</th>
                    <th>Estado</th>
                     
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($inscripciones as $inscripcion)
                <tr>

                    <td>{{ $inscripcion->usuario->nombre ?? 'Sin usuario' }}</td>
                    <td>{{ $inscripcion->curso->titulo ?? 'Sin curso' }}</td>
                      <td>
    @if($inscripcion->comprobante)

        <img 
            src="{{ asset('storage/' . $inscripcion->comprobante) }}" 
            alt="Comprobante"
            style="
                width: 120px;
                height: auto;
                border-radius: 8px;
                border: 1px solid #ddd;
                object-fit: cover;
            "
        >

    @else

        <span>Sin comprobante</span>

    @endif
</td>

                    <td>
                        @if($inscripcion->estado == 'pendiente_whatsapp')
                            <span class="badge pendiente">
                                <svg class="icono-small" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-width="2" d="M12 8v4l3 3"/>
                                </svg>
                                Pendiente
                            </span>
                        @elseif($inscripcion->estado == 'aprobado')
                            <span class="badge aprobado">
                                <svg class="icono-small" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Aprobado
                            </span>
                        @elseif($inscripcion->estado == 'rechazado')
                            <span class="badge rechazado">
                                <svg class="icono-small" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Rechazado
                            </span>
                        @endif
                    </td>

                    <td>

                        @if($inscripcion->estado != 'aprobado')
                        <form action="/admin/inscripciones/aprobar/{{ $inscripcion->id }}" method="POST" class="inline">
                            @csrf
                            <button class="btn aprobar">
                                <svg class="icono-btn" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Aprobar
                            </button>
                        </form>
                        @endif

                        @if($inscripcion->estado != 'rechazado')
                        <form action="/admin/inscripciones/rechazar/{{ $inscripcion->id }}" method="POST" class="inline">
                            @csrf
                            <button class="btn rechazar">
                                <svg class="icono-btn" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Rechazar
                            </button>
                        </form>
                        @endif

                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

<style>

/* BASE */
.contenedor {
    max-width: 1100px;
    margin: auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

.titulo {
    font-size: 22px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* ICONOS */
.icono {
    width: 28px;
    height: 28px;
}

.icono-small {
    width: 16px;
    height: 16px;
    margin-right: 5px;
}

.icono-btn {
    width: 14px;
    height: 14px;
    margin-right: 4px;
}

/* ALERTAS */
.alerta {
    display: flex;
    align-items: center;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
}

.exito {
    background: #e6f4ea;
    color: #1e7e34;
}

.error {
    background: #fbeaea;
    color: #a71d2a;
}

/* TABLA */
.tabla-container {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.tabla {
    width: 100%;
    border-collapse: collapse;
}

.tabla th {
    background: #f1f1f1;
    padding: 12px;
}

.tabla td {
    padding: 12px;
}

.tabla tr {
    border-bottom: 1px solid #ddd;
}

/* BADGES */
.badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
}

.pendiente {
    background: #fff3cd;
    color: #856404;
}

.aprobado {
    background: #e6f4ea;
    color: #1e7e34;
}

.rechazado {
    background: #fbeaea;
    color: #a71d2a;
}

/* BOTONES */
.btn {
    display: inline-flex;
    align-items: center;
    padding: 6px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 12px;
}

.aprobar {
    background: #2e7d32;
    color: white;
}

.rechazar {
    background: #c62828;
    color: white;
}

.inline {
    display: inline;
}

</style>

</x-app-layout>