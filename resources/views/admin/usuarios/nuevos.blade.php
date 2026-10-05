<x-app-layout>
<br><br>
<div class="container-fluid">

    <div class="card">

        <div class="card-header bg-primary text-white">
            <h3 class="card-title">
                <i class="fa-solid fa-user-plus"></i>
                Usuarios Nuevos
            </h3>
        </div>


        <div class="card-body">


            @if($usuarios->count())


            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-light">

                        <tr>

                            

                            <th>Nombre</th>

                            <th>Apellido</th>

                            <th>Email</th>

                            <th>Teléfono</th>

                            <th>Estado</th>

                            <th width="200px">
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @foreach($usuarios as $usuario)

                        <tr>

                           

                            <td>
                                {{ $usuario->nombre }}
                            </td>


                            <td>
                                {{ $usuario->apellido }}
                            </td>


                            <td>
                                {{ $usuario->email }}
                            </td>


                            <td>
                                {{ $usuario->telefono ?? 'Sin registro' }}
                            </td>


                            <td>

                                <span class="badge bg-warning">
                                    Pendiente
                                </span>

                            </td>


                            <td>

    {{-- APROBAR USUARIO --}}
    <form action="{{ route('admin.usuarios.aprobar', $usuario->id) }}"
          method="POST"
          style="display:inline">

        @csrf

        <button 
            type="submit"
            class="btn btn-success btn-sm"
            onclick="return confirm('¿Aprobar este usuario?')">

            <i class="fa-solid fa-check"></i>
            Aprobar

        </button>

    </form>



    {{-- RECHAZAR USUARIO --}}
    <form action="{{ route('admin.usuarios.rechazar', $usuario->id) }}"
          method="POST"
          style="display:inline">

        @csrf

        <button 
            type="submit"
            class="btn btn-danger btn-sm"
            onclick="return confirm('¿Rechazar este usuario?')">

            <i class="fa-solid fa-xmark"></i>
            Rechazar

        </button>

    </form>


</td>


                        </tr>


                    @endforeach


                    </tbody>


                </table>

            </div>


            @else

                <div class="alert alert-info">

                    <i class="fa-solid fa-circle-info"></i>

                    No existen usuarios nuevos pendientes.

                </div>

            @endif


        </div>

    </div>

</div>


</x-app-layout>