<div
style="
display:grid;
grid-template-columns:1fr;
gap:25px;
">

    <!-- TÍTULO -->

    <div>

        <label
        style="
        font-weight:600;
        color:#374151;
        ">

            Título

        </label>

        <input
        type="text"
        name="titulo"
        value="{{ old('titulo', $info->titulo ?? '') }}"
        required
        style="
        width:100%;
        margin-top:8px;
        padding:12px;
        border:1px solid #d1d5db;
        border-radius:10px;
        outline:none;
        ">

    </div>

    <!-- DESCRIPCIÓN -->

    <div>

        <label
        style="
        font-weight:600;
        color:#374151;
        ">

            Descripción

        </label>

        <textarea
        name="descripcion"
        rows="8"
        required
        style="
        width:100%;
        margin-top:8px;
        padding:12px;
        border:1px solid #d1d5db;
        border-radius:10px;
        resize:none;
        outline:none;
        ">{{ old('descripcion', $info->descripcion ?? '') }}</textarea>

    </div>

</div>