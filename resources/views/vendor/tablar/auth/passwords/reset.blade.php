@extends('tablar::auth.layout')

@section('content')
<div style="display: flex; align-items: center; justify-content: center; min-height: 100vh; background-color: #e1ecf4;">
    <div style="width: 100%; max-width: 400px; padding: 20px; background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <div style="text-align: center;">
            <img src="{{ asset('assets/Ferro.png') }}" alt="Logo de Ferro Center" style="height: 50px;">
            <h2 style="font-size: 24px; margin-top: 20px; color: #202124;">Restablecer contraseña</h2>
        </div>
        <p style="text-align: center; color: #5f6368; margin-top: 20px;">Introduce tu dirección de correo electrónico y tu nueva contraseña.</p>
        <form method="POST" action="{{ route('password.request') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" id="email" name="email" required autofocus class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Ingresa tu correo" value="{{ $email ?? old('email') }}">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" style="display: block;"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Contraseña nueva</label>
                <input type="password" id="password" name="password" required class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña nueva">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" style="display: block;"><strong>{{ $errors->first('password') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="password-confirm" class="form-label">Confirmar contraseña</label>
                <input type="password" id="password-confirm" name="password_confirmation" required class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Confirmar contraseña">
                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback" style="display: block;"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                @endif
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; border-radius: 4px; background-color: #1a73e8; border: none; color: white;">Restablecer contraseña</button>
            </div>
        </form>
    </div>
</div>
@endsection

