<div id="modalCrear"
style="
display:none;
position:fixed;
inset:0;
background:rgba(0,0,0,.60);
z-index:9999;
justify-content:center;
align-items:center;
padding:20px;
">


    <div
    style="
    background:white;
    width:95%;
    max-width:900px;
    max-height:90vh;
    border-radius:18px;
    overflow:hidden;
    display:flex;
    flex-direction:column;
    ">



        <!-- CABECERA -->

        <div
        style="
        background:#2563eb;
        color:white;
        padding:15px 20px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        ">


            <h3 style="margin:0;">

                <i class="fa-solid fa-plus"></i>

                Nueva Información


            </h3>



            <button
            type="button"
            onclick="cerrarModalCrear()"
            style="
            background:none;
            border:none;
            color:white;
            font-size:26px;
            cursor:pointer;
            ">

                ×


            </button>


        </div>





        <form
        action="{{ route('admin.sobre_nosotros.store') }}"
        method="POST"
        enctype="multipart/form-data">


            @csrf



            @php
                $sobre = null;
            @endphp





            <!-- CONTENIDO -->

            <div
            style="
            overflow-y:auto;
            max-height:65vh;
            padding:25px;
            ">


                @include('admin.sobre_nosotros._form')


            </div>





            <!-- BOTONES -->

            <div
            style="
            padding:20px;
            border-top:1px solid #e5e7eb;
            display:flex;
            justify-content:space-between;
            ">



                <button
                type="button"
                onclick="cerrarModalCrear()"
                style="
                background:#6b7280;
                color:white;
                border:none;
                padding:12px 20px;
                border-radius:10px;
                cursor:pointer;
                ">


                    <i class="fa-solid fa-xmark"></i>

                    Cancelar


                </button>





                <button
                type="submit"
                style="
                background:#2563eb;
                color:white;
                border:none;
                padding:12px 20px;
                border-radius:10px;
                cursor:pointer;
                ">


                    <i class="fa-solid fa-floppy-disk"></i>

                    Guardar


                </button>



            </div>



        </form>



    </div>



</div>