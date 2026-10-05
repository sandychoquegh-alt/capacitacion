
<div style="
display:grid;
grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
gap:20px;
">


<div>
<label style="font-weight:600;">
Título
</label>

<input
type="text"
name="titulo"
value="{{ old('titulo',$seccion->titulo ?? '') }}"
required
style="width:100%;padding:12px;border:1px solid #ddd;border-radius:10px;">
</div>



<div>

<label style="font-weight:600;">
Subtítulo
</label>

<input
type="text"
name="subtitulo"
value="{{ old('subtitulo',$seccion->subtitulo ?? '') }}"
required
style="width:100%;padding:12px;border:1px solid #ddd;border-radius:10px;">

</div>




<div>

<label style="font-weight:600;">
Imagen
</label>


<input
type="file"
name="imagen"
accept="image/*"
onchange="previewImagen(event)"
style="width:100%;padding:10px;border:1px solid #ddd;border-radius:10px;">


@if(isset($seccion) && $seccion->imagen)

<img
src="{{asset('storage/'.$seccion->imagen)}}"
style="
width:200px;
height:120px;
margin-top:10px;
object-fit:cover;
border-radius:10px;
">

@endif


</div>



<div style="text-align:center;">

<img id="preview"
style="
display:none;
width:200px;
height:120px;
object-fit:cover;
border-radius:10px;
">

</div>




<div>

<label style="font-weight:600;">
Texto botón
</label>

<input
type="text"
name="texto_boton"
value="{{ old('texto_boton',$seccion->texto_boton ?? '') }}"
style="width:100%;padding:12px;border-radius:10px;border:1px solid #ddd;">

</div>




<div style="grid-column:1/-1;">

<label style="font-weight:600;">
Descripción principal
</label>


<textarea
name="descripcion0"
rows="3"
style="width:100%;padding:12px;border-radius:10px;border:1px solid #ddd;">{{old('descripcion0',$seccion->descripcion0 ?? '')}}</textarea>

</div>



<div>

<label>Descripción 1</label>

<textarea
name="descripcion1"
rows="3"
style="width:100%;padding:12px;border-radius:10px;border:1px solid #ddd;">{{old('descripcion1',$seccion->descripcion1 ?? '')}}</textarea>

</div>



<div>

<label>Descripción 2</label>

<textarea
name="descripcion2"
rows="3"
style="width:100%;padding:12px;border-radius:10px;border:1px solid #ddd;">{{old('descripcion2',$seccion->descripcion2 ?? '')}}</textarea>

</div>



<div style="grid-column:1/-1;">

<label>Descripción 3</label>

<textarea
name="descripcion3"
rows="3"
style="width:100%;padding:12px;border-radius:10px;border:1px solid #ddd;">{{old('descripcion3',$seccion->descripcion3 ?? '')}}</textarea>

</div>


</div>
