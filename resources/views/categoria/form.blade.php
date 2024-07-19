
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nombre_categoria') }}</label>
    <div>
        {{ Form::text('nombre_categoria', $categoria->nombre_categoria, ['class' => 'form-control' .
        ($errors->has('nombre_categoria') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Categoria']) }}
        {!! $errors->first('nombre_categoria', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('descripcion_categoria') }}</label>
    <div>
        {{ Form::text('descripcion_categoria', $categoria->descripcion_categoria, ['class' => 'form-control' .
        ($errors->has('descripcion_categoria') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion Categoria']) }}
        {!! $errors->first('descripcion_categoria', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="{{ route('categorias.index') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Guardar</button>
            </div>
        </div>
    </div>