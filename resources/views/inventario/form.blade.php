<div class="form-group mb-3">
{{ Form::hidden('inventario_id', $inventario->inventario_id) }}
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('stock', 'Stock') }}</label>
    <div>
        {{ Form::text('stock', $inventario->stock, ['class' => 'form-control' . ($errors->has('stock') ? ' is-invalid' : ''), 'placeholder' => 'Stock']) }}
        {!! $errors->first('stock', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">inventario <b>stock</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('fecha_movimiento', 'Fecha Movimiento') }}</label>
    <div>
        {{ Form::date('fecha_movimiento', $inventario->fecha_movimiento, ['class' => 'form-control' . ($errors->has('fecha_movimiento') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Movimiento']) }}
        {!! $errors->first('fecha_movimiento', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">inventario <b>fecha_movimiento</b> instruction.</small>
    </div>
</div>
{{-- <div class="form-group mb-3">
    <label class="form-label">{{ Form::label('tipo_movimiento', 'Tipo Movimiento') }}</label>
    <div>
        {{ Form::text('tipo_movimiento', $inventario->tipo_movimiento, ['class' => 'form-control' . ($errors->has('tipo_movimiento') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Movimiento']) }}
        {!! $errors->first('tipo_movimiento', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">inventario <b>tipo_movimiento</b> instruction.</small>
    </div>
</div> --}}

<!-- Campo Producto ID -->
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('producto_id', 'Producto') }}</label>
    <div>
        {{ Form::select('producto_id', $productos->pluck('nombre_producto', 'producto_id'), $inventario->producto_id, ['class' => 'form-control' . ($errors->has('producto_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un producto']) }}
        {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccione el <b>producto</b> relacionado con este inventario.</small>
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('inventarios.index') }}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Guardar</button>
        </div>
    </div>
</div>
