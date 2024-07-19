<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('empleado_id') }}</label>
    <div>
        {{ Form::text('empleado_id', $empleado->empleado_id, ['class' => 'form-control' .
        ($errors->has('empleado_id') ? ' is-invalid' : ''), 'placeholder' => 'Empleado Id']) }}
        {!! $errors->first('empleado_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nombre_empleado') }}</label>
    <div>
        {{ Form::text('nombre_empleado', $empleado->nombre_empleado, ['class' => 'form-control' .
        ($errors->has('nombre_empleado') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Empleado']) }}
        {!! $errors->first('nombre_empleado', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('apellido_empleado') }}</label>
    <div>
        {{ Form::text('apellido_empleado', $empleado->apellido_empleado, ['class' => 'form-control' .
        ($errors->has('apellido_empleado') ? ' is-invalid' : ''), 'placeholder' => 'Apellido Empleado']) }}
        {!! $errors->first('apellido_empleado', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('email_empleado') }}</label>
    <div>
        {{ Form::text('email_empleado', $empleado->email_empleado, ['class' => 'form-control' .
        ($errors->has('email_empleado') ? ' is-invalid' : ''), 'placeholder' => 'Email Empleado']) }}
        {!! $errors->first('email_empleado', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('direccion_empleado') }}</label>
    <div>
        {{ Form::text('direccion_empleado', $empleado->direccion_empleado, ['class' => 'form-control' .
        ($errors->has('direccion_empleado') ? ' is-invalid' : ''), 'placeholder' => 'Direccion Empleado']) }}
        {!! $errors->first('direccion_empleado', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('telefono_empleado') }}</label>
    <div>
        {{ Form::text('telefono_empleado', $empleado->telefono_empleado, ['class' => 'form-control' .
        ($errors->has('telefono_empleado') ? ' is-invalid' : ''), 'placeholder' => 'Telefono Empleado']) }}
        {!! $errors->first('telefono_empleado', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('rol') }}</label>
    <div>
        {{ Form::text('rol', $empleado->rol, ['class' => 'form-control' .
        ($errors->has('rol') ? ' is-invalid' : ''), 'placeholder' => 'Rol']) }}
        {!! $errors->first('rol', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="{{ route('empleados.index') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Guardar</button>
            </div>
        </div>
    </div>