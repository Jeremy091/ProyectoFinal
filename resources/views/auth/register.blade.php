@extends('tablar::auth.layout')

@section('title', 'Register')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    .container-full {
        display: flex;
        width: 100vw;
        height: 100vh;
        margin: 0;
        padding: 0;
        align-items: stretch; 
    }

    .left-container, .right-container {
        flex: 1; 
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .left-container {
        background: linear-gradient(to right, #549dd7, #6ba8e5);


    }

    .right-container {
        background: linear-gradient(to right, #89CFF0, #89CFF0); 
        align-items: center;
    }

    .card {
        max-width: 420px;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.9); 
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2); 
        margin: 0 auto; 
    }

    .card-body h2 {
        text-align: center;
        margin-bottom: 4rem; 
    }
    .custom-auth-text {
    color: #FFFFFF; 
}





</style>

<div class="container-full">
    <!-- Contenedor del logo y texto de bienvenida a la izquierda -->
    <div class="left-container">
        <img src="{{ asset('assets/Ferro.png') }}" alt="Ferro Center Logo" style="width: 50%; margin-bottom: 20px;">
        
    </div>

    <!-- Contenedor del formulario de registro a la derecha -->
    <div class="right-container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Crear nueva cuenta</h2>
                <form action="{{ route('register') }}" method="post" autocomplete="off" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" placeholder="Ingrese su nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control" placeholder="Ingrese su correo electrónico" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="Ingrese su contraseña" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme su contraseña" required>
                    </div>
                    <div class="form-group mt-3">
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Crear cuenta</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center text-muted mt-3 custom-auth-text">
        ¿Ya tiene una cuenta? <a href="{{ route('login') }}" class="custom-signin-link" tabindex="-1">Iniciar sesión</a>
</div>

    </div>
</div>


<script>
    var onloadCallback = function() {
        alert("grecaptcha is ready");
    };
</script>

@endsection











