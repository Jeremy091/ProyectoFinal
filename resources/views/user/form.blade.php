<div class="form-group mb-3">
    <label class="form-label" for="name">{{ __('Nombre') }}</label>
    <div>
        {{ Form::text('name', old('name', $user->name ?? ''), ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre', 'id' => 'name']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Instrucciones para el <b>nombre</b> de usuario.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="email">{{ __('Correo electrónico') }}</label>
    <div>
        {{ Form::email('email', old('email', $user->email ?? ''), ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Correo electrónico', 'id' => 'email']) }}
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Instrucciones para el <b>correo electrónico</b> del usuario.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="password">{{ __('Contraseña') }}</label>
    <div>
        {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Contraseña', 'id' => 'password']) }}
        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Instrucciones para la <b>contraseña</b> del usuario.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="password_confirmation">{{ __('Confirmar Contraseña') }}</label>
    <div>
        {{ Form::password('password_confirmation', ['class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'placeholder' => 'Confirmar Contraseña', 'id' => 'password_confirmation']) }}
        {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Instrucciones para la confirmación de <b>contraseña</b> del usuario.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="roles">{{ __('Roles') }}</label>
    <div>
        @foreach($roles as $role)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role-{{ $role->id }}"
                    {{ in_array($role->id, old('roles', $userRoles ?? [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="role-{{ $role->id }}">
                    {{ $role->name }}
                </label>
            </div>
        @endforeach
        {!! $errors->first('roles', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Asignar roles al usuario.</small>
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('users.index') }}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary ms-auto">Enviar</button>
        </div>
    </div>
</div>
