@extends('tablar::page')

@section('content')
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12">
                <form method="POST" action="{{ route('compras.store') }}" id="compraForm" role="form">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">{{ Form::label('numero_factura', 'Número de Factura') }}</label>
                        <div>
                            {{ Form::text('numero_factura', old('numero_factura', isset($compra->numero_factura) ? $compra->numero_factura : (isset($nuevoNumeroFactura) ? $nuevoNumeroFactura : '')), ['class' => 'form-control' . ($errors->has('numero_factura') ? ' is-invalid' : ''), 'placeholder' => 'Número de Factura', 'readonly' => true]) }}
                            {!! $errors->first('numero_factura', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">{{ Form::label('fecha_compra', 'Fecha de Compra') }}</label>
                        <div>
                            {{ Form::date('fecha_compra', \Carbon\Carbon::now()->format('Y-m-d'), [
                                'class' => 'form-control' . ($errors->has('fecha_compra') ? ' is-invalid' : ''),
                                'placeholder' => 'Fecha de Compra',
                                'readonly' => 'readonly', // Esto hace que el campo sea no editable
                            ]) }}
                            {!! $errors->first('fecha_compra', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>


                    <div class="form-group mb-3">
                        <label class="form-label">{{ Form::label('subtotal', 'Subtotal') }}</label>
                        <div>
                            {{ Form::text('subtotal', old('subtotal', isset($compra) ? $compra->subtotal : ''), ['class' => 'form-control' . ($errors->has('subtotal') ? ' is-invalid' : ''), 'placeholder' => 'Subtotal', 'readonly' => true]) }}
                            {!! $errors->first('subtotal', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">{{ Form::label('impuesto', 'Impuesto (%)') }}</label>
                        <div>
                            {{ Form::number('impuesto', old('impuesto', isset($compra) ? $compra->impuesto : ''), ['class' => 'form-control' . ($errors->has('impuesto') ? ' is-invalid' : ''), 'placeholder' => 'Impuesto']) }}
                            {!! $errors->first('impuesto', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">{{ Form::label('total_compra', 'Total de la Compra') }}</label>
                        <div>
                            {{ Form::text('total_compra', old('total_compra', isset($compra) ? $compra->total_compra : ''), ['class' => 'form-control' . ($errors->has('total_compra') ? ' is-invalid' : ''), 'placeholder' => 'Total de la Compra', 'readonly' => true]) }}
                            {!! $errors->first('total_compra', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="form-group mb-3"> <label
                            class="form-label">{{ Form::label('metodo_pago', 'Método de Pago') }}</label>
                        <div>
                            {{ Form::select('metodo_pago', ['efectivo' => 'Efectivo', 'transferencia' => 'Transferencia'], old('metodo_pago', isset($compra) ? $compra->metodo_pago : ''), ['class' => 'form-control' . ($errors->has('metodo_pago') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el método de pago']) }}
                            {!! $errors->first('metodo_pago', '<div class="invalid-feedback">:message</div>') !!} </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">{{ Form::label('estado', 'Estado de la Compra') }}</label>
                        <div>
                            {{ Form::select('estado', ['pendiente' => 'Pendiente', 'completada' => 'Completada', 'cancelada' => 'Cancelada'], old('estado', isset($compra) ? $compra->estado : ''), ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el estado']) }}
                            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">{{ Form::label('proveedor_id', 'Proveedor') }}</label>
                        <div class="d-flex">
                            {{ Form::select('proveedor_id', $proveedores->pluck('nombre_proveedor', 'proveedor_id'), old('proveedor_id', isset($compra) ? $compra->proveedor_id : ''), ['class' => 'form-control' . ($errors->has('proveedor_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un proveedor']) }}
                            <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal"
                                data-bs-target="#nuevoProveedorModal">
                                Nuevo Proveedor
                            </button>
                        </div>
                        {!! $errors->first('proveedor_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- Tabla de Productos -->
                    <div class="card">
                        <div class="card-header">
                            Productos
                        </div>
                        <div class="card-body">
                            <table class="table" id="products_table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio de Compra</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($compra) && $compra->productos->count() > 0)
                                        @foreach ($compra->productos as $key => $producto)
                                            <tr id="product{{ $key }}">
                                                <td>
                                                    <select name="producto_id[]" class="form-control producto-select"
                                                        required>
                                                        <option value="">Seleccione un producto</option>
                                                        @foreach ($productos as $prod)
                                                            <option value="{{ $prod->producto_id }}"
                                                                data-precio="{{ $prod->precio_compra }}"
                                                                {{ $prod->producto_id == $producto->producto_id ? 'selected' : '' }}>
                                                                {{ $prod->nombre_producto }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="cantidad[]" class="form-control"
                                                        value="{{ $producto->pivot->cantidad }}"
                                                        oninput="calculateSubtotal()" />
                                                </td>
                                                <td>
                                                    <input type="number" name="precio_compra[]"
                                                        class="form-control precio-unitario"
                                                        value="{{ $producto->pivot->precio_compra }}" readonly required />
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#nuevoProductoModal">
                                                        Nuevo Producto
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr id="product0">
                                            <td>
                                                <select name="producto_id[]" class="form-control producto-select" required>
                                                    <option value="">Seleccione un producto</option>
                                                    @foreach ($productos as $producto)
                                                        <option value="{{ $producto->producto_id }}"
                                                            data-precio="{{ $producto->precio_compra }}">
                                                            {{ $producto->nombre_producto }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="cantidad[]" class="form-control"
                                                    oninput="calculateSubtotal()" />
                                            </td>
                                            <td>
                                                <input type="number" step="0.01" name="precio_compra[]"
                                                    class="form-control precio-unitario" readonly required />
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#nuevoProductoModal">
                                                    Nuevo Producto
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="add_row" class="btn btn-default pull-left">+ Añadir Fila</button>
                                    <button id='delete_row' class="pull-right btn btn-danger">- Eliminar Fila</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botón para obtener precios de compra -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button id="obtenerPrecios" class="btn btn-success" type="button">Obtener Precios de
                                Compra</button>
                        </div>
                    </div>


                    <div class="form-footer mt-3">
                        <div class="text-end">
                            <div class="d-flex">
                                <a href="{{ route('compras.index') }}" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-primary ms-auto">Guardar</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @include('tablar::extra.modalproveedor')
    @include('tablar::extra.modalproducto')

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var nuevoProveedorModal = document.getElementById('nuevoProveedorModal');
            var guardarProveedorBtn = document.getElementById('guardarProveedor');

            guardarProveedorBtn.addEventListener('click', function() {
                var formData = new FormData(document.getElementById('nuevoProveedorForm'));

                fetch("{{ route('proveedores.store') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw response;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: data.success,
                            });

                            // Actualizar el select de proveedores
                            var selectProveedor = document.querySelector('select[name="proveedor_id"]');
                            if (selectProveedor) {
                                var option = document.createElement('option');
                                option.value = data.proveedor.proveedor_id;
                                option.textContent = data.proveedor.nombre_proveedor;
                                option.selected = true;
                                selectProveedor.appendChild(option);
                                selectProveedor.dispatchEvent(new Event('change'));
                            }

                            // Cerrar el modal
                            var modal = bootstrap.Modal.getInstance(nuevoProveedorModal);
                            modal.hide();

                            // Limpiar el formulario
                            document.getElementById('nuevoProveedorForm').reset();
                        }
                    })
                    .catch(error => {
                        if (error.status === 422) {
                            error.json().then(errorData => {
                                let errorMessages = '';
                                for (let key in errorData.errors) {
                                    errorMessages += errorData.errors[key].join('<br>') +
                                        '<br>';
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Errores de Validación',
                                    html: errorMessages,
                                });
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un error al crear el proveedor.',
                            });
                        }
                    });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var nuevoProductoModal = document.getElementById('nuevoProductoModal');
            var guardarProductoBtn = document.getElementById('guardarProducto');
            guardarProductoBtn.addEventListener('click', function() {
                var formData = new FormData(document.getElementById('nuevoProductoForm'));
                fetch("{{ route('productos.store') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert('Producto creado con éxito.');
                            // Actualizar el select de productos
                            var selectProducto = document.querySelector('select[name="producto_id[]"]');
                            var option = document.createElement('option');
                            option.value = data.producto.producto_id;
                            option.textContent = data.producto.nombre_producto;
                            option.selected = true;
                            selectProducto.appendChild(option);
                            // Cerrar el modal
                            var modal = bootstrap.Modal.getInstance(nuevoProductoModal);
                            modal.hide();
                            // Limpiar el formulario
                            document.getElementById('nuevoProductoForm').reset();
                            // window.location.reload(true);
                        } else {
                            alert('Hubo un error al crear el producto: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Hubo un error al procesar la solicitud.');
                    });
            });
        });

        function updateProveedoresList() {
            fetch("{{ route('proveedores.list') }}")
                .then(response => response.json())
                .then(proveedores => {
                    var selectProveedor = document.querySelector('select[name="proveedor_id"]');
                    if (selectProveedor) {
                        // Guardar el valor seleccionado actualmente
                        var selectedValue = selectProveedor.value;

                        // Limpiar las opciones existentes
                        selectProveedor.innerHTML = '<option value="">Seleccione un proveedor</option>';

                        // Añadir las nuevas opciones
                        proveedores.forEach(proveedor => {
                            var option = document.createElement('option');
                            option.value = proveedor.proveedor_id;
                            option.textContent = proveedor.nombre_proveedor;
                            selectProveedor.appendChild(option);
                        });

                        // Restaurar el valor seleccionado si aún existe
                        if (proveedores.some(p => p.proveedor_id == selectedValue)) {
                            selectProveedor.value = selectedValue;
                        }

                        // Disparar el evento change
                        selectProveedor.dispatchEvent(new Event('change'));
                    }
                })
                .catch(error => {
                    console.error('Error al actualizar la lista de proveedores:', error);
                });
        }
    </script>
    <script>
        $(document).ready(function() {
            let row_number =
                {{ isset($compra) && $compra->productos->count() > 0 ? $compra->productos->count() : 1 }};

            function initializeSelectListeners() {
                document.querySelectorAll('.producto-select').forEach(function(selectElement) {
                    if (!selectElement.hasAttribute('data-initialized')) {
                        selectElement.setAttribute('data-initialized', 'true');
                    }
                });

                document.querySelectorAll('input[name="cantidad[]"]').forEach(function(inputElement) {
                    inputElement.addEventListener('input', calculateSubtotal);
                });
            }

            initializeSelectListeners();

            $("#add_row").click(function(e) {
                e.preventDefault();
                let new_row_number = row_number++;
                let new_row = $('#product0').clone().attr('id', 'product' + new_row_number);
                new_row.find('input').val('');
                new_row.find('select').val('');
                $('#products_table tbody').append(new_row);
                initializeSelectListeners();
            });

            $("#delete_row").click(function(e) {
                e.preventDefault();
                if ($('#products_table tbody tr').length > 1) {
                    $('#products_table tbody tr:last').remove();
                    row_number--;
                    calculateSubtotal();
                }
            });

            function calculateSubtotal() {
                let subtotal = 0;
                $('input[name="cantidad[]"]').each(function(index, element) {
                    let cantidad = parseFloat($(element).val());
                    let precio_compra = parseFloat($(element).closest('tr').find(
                        'input[name="precio_compra[]"]').val());
                    if (!isNaN(cantidad) && !isNaN(precio_compra)) {
                        subtotal += cantidad * precio_compra;
                    }
                });
                $('#subtotal').val(subtotal.toFixed(2));
                calculateTotal();
            }

            function calculateTotal() {
                let subtotal = parseFloat($('#subtotal').val());
                let impuesto = parseFloat($('#impuesto').val());
                if (!isNaN(subtotal) && !isNaN(impuesto)) {
                    let total = subtotal + (subtotal * (impuesto / 100));
                    $('#total_compra').val(total.toFixed(2));
                }
            }

            $('#impuesto').on('input', calculateTotal);

            $('#obtenerPrecios').click(function(e) {
                e.preventDefault();
                $('select[name="producto_id[]"]').each(function() {
                    let selectElement = this;
                    let selectedOption = selectElement.options[selectElement.selectedIndex];
                    let unitPrice = selectedOption.getAttribute('data-precio');
                    let priceInput = selectElement.closest('tr').querySelector('.precio-unitario');
                    priceInput.value = unitPrice;
                });
                calculateSubtotal();
            });

            calculateSubtotal();
        });
    </script>



@endsection
