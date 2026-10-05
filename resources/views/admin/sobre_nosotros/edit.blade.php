<div id="modalEditar" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.60); z-index:9999; justify-content:center; align-items:center; padding:20px;">

    <div style="background:white; width:95%; max-width:900px; max-height:90vh; border-radius:18px; overflow:hidden; display:flex; flex-direction:column;">
        <div style="background:#f59e0b; color:white; padding:15px 20px; display:flex; justify-content:space-between; align-items:center;">

            <h3 style="margin:0;">

                <i class="fa-solid fa-pen"></i>

                Editar Información

            </h3>

            <button
            type="button"
            onclick="cerrarModalEditar()"
            style="background:none; border:none; color:white; font-size:26px; cursor:pointer;">

                ×

            </button>

        </div>

        @if(isset($sobre))

        <form
        action="{{ route('admin.sobre_nosotros.update',$sobre->id) }}"
        method="POST"
        enctype="multipart/form-data"
        style="padding:40px; max-height:65vh; overflow-y:auto;">

            @csrf
            @method('PUT')

            @include('admin.sobre_nosotros._form')

            <div style="display:flex; justify-content:space-between; margin-top:25px;">

                <button
                type="button"
                onclick="cerrarModalEditar()"
                style="background:#6b7280; color:white; border:none; padding:12px 20px; border-radius:10px;">

                    <i class="fa-solid fa-xmark"></i>

                    Cancelar

                </button>

                <button
                type="submit"
                style="background:#f59e0b; color:white; border:none; padding:12px 20px; border-radius:10px;">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Actualizar

                </button>

            </div>

        </form>

        @endif

    </div>

</div>