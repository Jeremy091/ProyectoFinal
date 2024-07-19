@extends('tablar::auth.layout')

@section('title', 'Login')

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
        width: 50%;
    }

    .left-container {
        background: linear-gradient(to right, #add8e6, #add8e6);
    }

    .right-container {
        background: linear-gradient(to right, #6a11cb, #2575fc);
        align-items: flex-start;
    }

    .card {
        max-width: 420px;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-left: auto;
        margin-right: auto;
    }

    .card-body h2 {
        text-align: center;
        margin-bottom: 4rem;
    }
</style>

<div class="container-full">
    <div class="left-container">
        <img src="{{ asset('assets/Ferro.png') }}" alt="Ferro Center Logo" style="width: 50%; margin-bottom: 20px;">
    </div>

    <div class="right-container">
        <div class="card">
            <div class="card-body">
                <h2>Ingrese a su cuenta</h2>
                <form id="loginForm" action="{{ route('login') }}" method="post" novalidate>
                    @csrf

                    @if ($errors->has('email'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                    @if (session('throttle_error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('throttle_error') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="email" class="form-label">Dirección de correo electrónico</label>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña"
                            required>
                        <div class="mt-3">
                            <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                        <div id="captchaError" class="alert alert-danger" style="display: none;">
                            Debe completar la verificación captcha.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                </form>
                <div class="mt-3 text-center">
                    ¿No tienes una cuenta? <a href="{{ route('register') }}">Registrar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById('loginForm');
    const captchaError = document.getElementById('captchaError');

    loginForm.addEventListener('submit', function(event) {
        var response = grecaptcha.getResponse();
        if(response.length === 0) { 
            event.preventDefault();
            captchaError.style.display = 'block'; // Mostrar mensaje de error
        } else {
            captchaError.style.display = 'none'; // Ocultar mensaje de error
        }
    });
});
</script>
@endsection
