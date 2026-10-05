<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
/* Quitar margen del body */
body {
  margin: 0;
  background: #fff;
}

/* IMAGEN FULL */
.register-image {
  height: 100vh;
  position: relative;
}

.register-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Overlay pro */
.register-image::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(
    rgba(10,30,63,0.6),
    rgba(0,0,0,0.6)
  );
}

/* FORMULARIO LADO DERECHO */
.register-form {
  background: #fff;
  height: 100vh;
  padding: 40px;
}

/* CAJA INTERNA */
.form-box {
  width: 100%;
  max-width: 400px;
  margin: auto;
}

/* TITULOS */
.form-box h2 {
  font-size: 30px;
  font-weight: 700;
}

.form-box p {
  color: #666;
  margin-bottom: 25px;
}

/* INPUTS */
.input {
  width: 100%;
  padding: 12px;
  border-radius: 10px;
  border: 1px solid #ddd;
}

.input:focus {
  border-color: #fccd35;
  box-shadow: 0 0 0 3px rgba(252,205,53,0.2);
}

/* BOTÓN */
.btn-register {
  width: 100%;
  margin-top: 15px;
  background: #0A1E3F;
  color: #fff;
  padding: 12px;
  border-radius: 10px;
}

.btn-register:hover {
  background: #fccd35;
  color: #000;
}
@media (max-width: 768px) {

  .register-image {
    display: none; /* ocultamos imagen */
  }

  .register-form {
    width: 100%;
  }

}



.cerrar-modal{
    position: absolute;
    top: 15px;
    right: 20px;
    width: 40px;
    height: 40px;
    background: #ff4d4d;
    color: white;
    font-size: 28px;
    font-weight: bold;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: .3s;
    z-index: 1000;
}

.cerrar-modal:hover{
    background: #d90000;
    transform: scale(1.1);
}
</style>

<div class="row g-0 vh-100">
  <div></div>

  <!-- IZQUIERDA (IMAGEN FULL) -->
  <div class="col-md-6 register-image">
    <img src="{{ asset('img/images.jpg') }}" alt="Registro">
   <!-- http://127.0.0.1:8000/img/images.jpg-->
  </div>

  <!-- DERECHA (FORMULARIO) -->
  <div class="col-md-6 register-form d-flex align-items-center">
    <!-- BOTON CERRAR -->
    <div class="cerrar-modal" onclick="cerrarFormulario()">
        &times;
    </div>

    <div class="form-box">

      <h2>Crear cuenta</h2>
      <p>Empieza tu aprendizaje hoy mismo </p>

      <form method="POST" action="{{ route('register') }}"> 
        @csrf <!-- Nombre --> 
        <div class="form-group"> 
            <x-input-label for="nombre" value="Nombre" /> 
            <x-text-input id="nombre" type="text" name="nombre" class="input" required /> 
        </div> 
        <!-- Apellido --> 
       <div class="form-group"> 
            <x-input-label for="nombre" value="Apellidos" /> 
            <x-text-input id="apellido" type="text" name="apellido" class="input" required /> 
        </div>
        <!-- Email --> 
        <div class="form-group"> 
            <x-input-label for="email" value="Correo electrónico" /> 
            <x-text-input id="email" type="email" name="email" class="input" required /> 
        </div> 
        <!-- Password --> 
         <div class="form-group"> 
            <x-input-label for="password" value="Contraseña" /> 
            <x-text-input id="password" type="password" name="password" class="input" required /> 
        </div> <!-- Confirmar --> 
        <div class="form-group"> 
            <x-input-label for="password_confirmation" value="Confirmar contraseña" /> 
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" class="input" required /> 
        </div> 
        <!-- BOTONES --> 
         <div class="form-footer"> 
            <a href="{{ route('login') }}">¿Ya tienes cuenta?</a> 
            <button type="submit" class="btn-register"> Registrarse 
                
            </button> 
        </div> </form>

    </div>

  </div>

</div>

<script>
function cerrarFormulario() {

    // REDIRECCIONAR A WELCOME
  window.location.href = "/";

}
</script>