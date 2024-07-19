
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nombre_permiso') }}</label>
    <div>
        {{ Form::text('nombre_permiso', $permiso->nombre_permiso, ['class' => 'form-control' .
        ($errors->has('nombre_permiso') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Permiso']) }}
        {!! $errors->first('nombre_permiso', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">permiso <b>nombre_permiso</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('descripcion_permiso') }}</label>
    <div>
        {{ Form::text('descripcion_permiso', $permiso->descripcion_permiso, ['class' => 'form-control' .
        ($errors->has('descripcion_permiso') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion Permiso']) }}
        {!! $errors->first('descripcion_permiso', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">permiso <b>descripcion_permiso</b> instruction.</small>
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
            </div>
        </div>
    </div>
