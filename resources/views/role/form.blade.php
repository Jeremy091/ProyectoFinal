<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('name') }}</label>
    <div>
        {{ Form::text('name', $role->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Role <b>name</b> instruction.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('description') }}</label>
    <div>
        {{ Form::text('description', $role->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Role <b>description</b> instruction.</small>
    </div>
</div>
@php
    // Verificar si $rolePermissions está definida, si no, definirla como un array vacío
    $rolePermissions = $rolePermissions ?? [];
@endphp

<div class="form-group mb-3">
    <label class="form-label">Permissions</label>
    <div class="row">
        @foreach ($permissions as $permission)
            <div class="col-md-6 col-lg-4">
                <div class="form-check">
                    {{ Form::checkbox('permissions[]', $permission->id, in_array($permission->id, $rolePermissions), ['class' => 'form-check-input', 'id' => 'permission-' . $permission->id]) }}
                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                        {{ $permission->description }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('roles.index') }}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Entregar</button>
        </div>
    </div>
</div>
