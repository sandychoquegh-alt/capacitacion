<x-app-layout>

<br>

<div class="max-w-7xl mx-auto px-6 py-8">


@if(session('success'))

<div
style="
background:#dcfce7;
color:#166534;
padding:15px;
border-radius:10px;
margin-bottom:20px;
">

{{ session('success') }}

</div>

@endif



<!-- CABECERA -->

<div
style="
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
">


<h2>

Sección Empresarial

</h2>



<button
type="button"
onclick="abrirModalCrear()"
style="
background:#2563eb;
color:white;
border:none;
padding:12px 18px;
border-radius:10px;
cursor:pointer;
">

<i class="fa-solid fa-plus"></i>

Nueva Sección

</button>


</div>




<table
style="
width:100%;
border-collapse:collapse;
">


<thead>


<tr
style="
background:#f8fafc;
border-bottom:2px solid #e5e7eb;
">


<th style="padding:15px;">
Imagen
</th>


<th>
Título
</th>


<th>
Descripción
</th>


<th>
Botón
</th>


<th style="text-align:center;">
Acciones
</th>


</tr>


</thead>



<tbody>


@forelse($seccionesEmpresariales as $seccion)


<tr
style="
border-bottom:1px solid #e5e7eb;
">


<td style="padding:15px;">


@if($seccion->imagen)


<img
src="{{ asset('storage/'.$seccion->imagen) }}"
style="
width:120px;
height:70px;
object-fit:cover;
border-radius:10px;
">


@endif


</td>



<td>

{{ $seccion->titulo }}

</td>



<td>

{{ Str::limit($seccion->descripcion,80) }}

</td>



<td>

{{ $seccion->texto_boton }}

</td>




<td
style="
text-align:center;
">



<button
type="button"
onclick="abrirModalEditar({{ $seccion->id }})"
style="
background:#f59e0b;
color:white;
border:none;
padding:10px 12px;
border-radius:8px;
cursor:pointer;
">


<i class="fa-solid fa-pen"></i>


</button>





<form
action="{{ route('admin.secciones_empresariales.destroy',$seccion->id) }}"
method="POST"
style="display:inline;">


@csrf

@method('DELETE')



<button
onclick="return confirm('¿Eliminar esta sección?')"
style="
background:#dc2626;
color:white;
border:none;
padding:10px 12px;
border-radius:8px;
cursor:pointer;
">


<i class="fa-solid fa-trash"></i>


</button>


</form>



</td>


</tr>



@empty


<tr>

<td
colspan="5"
style="
padding:40px;
text-align:center;
">


No existen registros.


</td>


</tr>


@endforelse



</tbody>


</table>



<br>


{{ $seccionesEmpresariales->links() }}



</div>



@include('admin.secciones_empresariales.create')

@include('admin.secciones_empresariales.edit')



<script>


function abrirModalCrear(){

document.getElementById('modalCrear').style.display="flex";

}



function cerrarModalCrear(){

document.getElementById('modalCrear').style.display="none";

}





async function abrirModalEditar(id){


const modal=document.getElementById('modalEditar');


modal.style.display="flex";



const respuesta=await fetch(
`/admin/secciones_empresariales/${id}/edit`
);



document.body.insertAdjacentHTML(
'beforeend',
await respuesta.text()
);


}



function cerrarModalEditar(){

document.getElementById('modalEditar').style.display="none";

}


</script>



</x-app-layout>