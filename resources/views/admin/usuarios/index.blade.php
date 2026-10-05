<x-app-layout>
    <br><br>
<div class="max-w-7xl mx-auto px-6 py-10" style="
background:white;
padding:20px;
border-radius:16px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
">

 <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;margin-bottom:20px;">

    <div style="display:flex;align-items:center;gap:12px;">
        <h2 style="font-size:18px;font-weight:600;margin:0;">
            <i class="fa-solid fa-users"></i> Usuarios registrados
        </h2>

        <span style="background:#2563eb;color:white;padding:6px 12px;border-radius:8px;font-size:13px;">
            Total: {{ $usuarios->count() }}
        </span>
    </div>

    <form method="GET" style="margin:0;">
        <div style="display:flex;align-items:center;gap:10px;">
            
            <div style="display:flex;align-items:center;background:#f3f4f6;padding:10px 14px;border-radius:12px;width:320px;">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="buscar" value="{{ $buscar }}" placeholder="Buscar usuario..." style="border:none;background:transparent;outline:none;margin-left:10px;width:100%;">
            </div>

            <button style="background:linear-gradient(135deg,#2563eb,#1d4ed8);color:white;border:none;padding:11px 22px;border-radius:12px;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:8px;">
                <i class="fa-solid fa-filter"></i>
                Buscar
            </button>

        </div>
    </form>

</div>


<div style="display:flex;justify-content:center;margin-top:20px;">
    <div style="width:85%;background:#fff;padding:20px;border-radius:16px;border:1px solid rgba(55, 56, 56, 0.25);overflow-x:auto;">

        <table style="width:100%;border-collapse:collapse;text-align:left;font-size:14px;">

            <thead>
                <tr style="background:#f3f4f6;">
                    <th style="padding:12px;">Usuario</th>
                    <th style="padding:12px;">Email</th>
                    <th style="padding:12px;">Fecha</th>
                    <th style="padding:12px;">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($usuarios as $user)

                    <tr style="border-bottom:1px solid #eee;transition:.2s;">

                        <td style="padding:12px;">
                            <div style="display:flex;align-items:center;gap:8px;">
                                <span>{{ $user->nombre }}</span>
                                <span>{{ $user->apellido }}</span>
                            </div>
                        </td>

                        <td style="padding:12px;">
                            {{ $user->email }}
                        </td>

                        <td style="padding:12px;">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>

                        <td style="padding:12px;">
                            <button
                                onclick="abrirEliminar({{ $user->id }})"
                                style="background:#dc2626;color:white;border:none;padding:8px 10px;border-radius:8px;cursor:pointer;display:flex;align-items:center;gap:6px;">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- PAGINACION -->

<div style="margin-top:20px;">

{{ $usuarios->links() }}

</div>



</div>
</x-app-layout>
<div id="modalEliminar"
style="
display:none;
position:fixed;
inset:0;
background:rgba(0,0,0,.6);
align-items:center;
justify-content:center;
z-index:999;
">


<div style="
background:white;
padding:30px;
border-radius:16px;
width:400px;
text-align:center;
">


<i class="fa-solid fa-triangle-exclamation"
   style="font-size:50px; color:#dc2626;"></i>


<h3>
¿Eliminar usuario?
</h3>


<form id="formEliminar" method="POST">

@csrf

@method('DELETE')


<button style="
background:#dc2626;
color:white;
padding:10px 20px;
border:none;
border-radius:8px;
">

Eliminar

</button>


<button 
type="button"
onclick="cerrarEliminar()"
style="
padding:10px;
border:none;
">

Cancelar

</button>


</form>


</div>

</div>

<script>

function abrirEliminar(id){

let modal=document.getElementById('modalEliminar');

modal.style.display='flex';


document.getElementById('formEliminar')
.action =
"/admin/usuarios/"+id;

}



function cerrarEliminar(){

document.getElementById('modalEliminar')
.style.display='none';

}

</script>