<div class="form-group mb-3">
    
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nombre_proveedor') }}</label>
    <div>
        {{ Form::text('nombre_proveedor', $proveedore->nombre_proveedor, ['class' => 'form-control' .
        ($errors->has('nombre_proveedor') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Proveedor']) }}
        {!! $errors->first('nombre_proveedor', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('direccion_proveedor') }}</label>
    <div>
        {{ Form::text('direccion_proveedor', $proveedore->direccion_proveedor, ['class' => 'form-control' .
        ($errors->has('direccion_proveedor') ? ' is-invalid' : ''), 'placeholder' => 'Direccion Proveedor']) }}
        {!! $errors->first('direccion_proveedor', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('telefono_proveedor') }}</label>
    <div>
        {{ Form::text('telefono_proveedor', $proveedore->telefono_proveedor, ['class' => 'form-control' .
        ($errors->has('telefono_proveedor') ? ' is-invalid' : ''), 'placeholder' => 'Telefono Proveedor']) }}
        {!! $errors->first('telefono_proveedor', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('email_proveedor') }}</label>
    <div>
        {{ Form::text('email_proveedor', $proveedore->email_proveedor, ['class' => 'form-control' .
        ($errors->has('email_proveedor') ? ' is-invalid' : ''), 'placeholder' => 'Email Proveedor']) }}
        {!! $errors->first('email_proveedor', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="{{ route('proveedores.index') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Guardar</button>
            </div>
        </div>
    </div>
