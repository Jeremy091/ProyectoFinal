@extends('tablar::page')

@section('content')
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12">
            <form method="POST" action="{{ route('transaccions.store') }}" id="transaccionForm" role="form">
                @csrf
                <!-- Formulario de Transacción -->                                
                
                <div class="form-group mb-3">
                    <label class="form-label">{{ Form::label('fecha_transaccion', 'Fecha de Transacción') }}</label>
                    <div>
                        {{ Form::date('fecha_transaccion', \Carbon\Carbon::now()->format('Y-m-d'), ['class' => 'form-control' . ($errors->has('fecha_transaccion') ? ' is-invalid' : ''), 'readonly' => true]) }}
                        {!! $errors->first('fecha_transaccion', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ Form::label('total_transaccion', 'Total de la Transacción') }}</label>
                    <div>
                        {{ Form::text('total_transaccion', old('total_transaccion'), ['class' => 'form-control' . ($errors->has('total_transaccion') ? ' is-invalid' : ''), 'placeholder' => 'Total de la Transacción', 'readonly' => true]) }}
                        {!! $errors->first('total_transaccion', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ Form::label('metodo_pago', 'Método de Pago') }}</label>
                    <div>
                        {{ Form::select('metodo_pago', [
                            'efectivo' => 'Efectivo'                            
                        ], null, ['class' => 'form-control' . ($errors->has('metodo_pago') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un método de pago']) }}
                        {!! $errors->first('metodo_pago', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ Form::label('tipo_transaccion', 'Tipo de Transacción') }}</label>
                    <div>
                        {{ Form::select('tipo_transaccion', ['venta' => 'Venta'], null, ['class' => 'form-control' . ($errors->has('tipo_transaccion') ? ' is-invalid' : ''), 'readonly' => true]) }}
                        {!! $errors->first('tipo_transaccion', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ Form::label('cliente_id', 'Cliente') }}</label>
                    <div class="d-flex">
                        <select name="cliente_id" class="form-control{{ $errors->has('cliente_id') ? ' is-invalid' : '' }}">
                            <option value="">Seleccione un cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->cliente_id }}" {{ old('cliente_id', isset($transaccion) ? $transaccion->cliente_id : '') == $cliente->cliente_id ? 'selected' : '' }}>
                                    {{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#nuevoClienteModal">
                            Nuevo Cliente
                        </button>
                    </div>
                    {!! $errors->first('cliente_id', '<div class="invalid-feedback">:message</div>') !!}
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
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="product0">
                                    <td>
                                        <select name="producto_id[]" class="form-control" onchange="setProductPrice(this)">
                                            <option value="">-- Selecciona un producto --</option>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->producto_id }}">
                                                    {{ $producto->nombre_producto }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="cantidad[]" class="form-control" oninput="calculateSubtotal(this)" />
                                    </td>
                                    <td>
                                        <input type="number" name="precio_unitario[]" class="form-control" readonly />
                                    </td>
                                    <td>
                                        <input type="number" name="subtotal[]" class="form-control" readonly />
                                    </td>
                                </tr>
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

                <div class="form-footer mt-3">
                    <div class="text-end">
                        <div class="d-flex">
                            <a href="{{ route('transaccions.index') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-primary ms-auto">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('tablar::extra.modalcliente')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let row_number = 1;

        $("#add_row").click(function(e) {
            e.preventDefault();
            let new_row_number = row_number;
            let new_row = $('#product0').clone().attr('id', 'product' + new_row_number);
            new_row.find('input').val('');
            $('#products_table tbody').append(new_row);
            row_number++;
        });

        $("#delete_row").click(function(e) {
            e.preventDefault();
            if ($('#products_table tbody tr').length > 1) {
                $('#products_table tbody tr:last').remove();
                row_number--;
                calculateTotal();
            }
        });
    });

    function setProductPrice(selectElement) {
        let selectedProductId = selectElement.value;
        let selectedProduct = @json($productos).find(product => product.producto_id == selectedProductId);
        if (selectedProduct) {
            $(selectElement).closest('tr').find('input[name="precio_unitario[]"]').val(selectedProduct.precio_unitario);
        }
        calculateSubtotal(selectElement);
    }

    function calculateSubtotal(element) {
        let row = $(element).closest('tr');
        let cantidad = parseFloat(row.find('input[name="cantidad[]"]').val());
        let precio_unitario = parseFloat(row.find('input[name="precio_unitario[]"]').val());
        let subtotal = 0;
        if (!isNaN(cantidad) && !isNaN(precio_unitario)) {
            subtotal = cantidad * precio_unitario;
        }
        row.find('input[name="subtotal[]"]').val(subtotal.toFixed(2));
        calculateTotal();
    }

    function calculateTotal() {
        let total = 0;
        $('input[name="subtotal[]"]').each(function(index, element) {
            let subtotal = parseFloat($(element).val());
            if (!isNaN(subtotal)) {
                total += subtotal;
            }
        });
        $('#total_transaccion').val(total.toFixed(2));
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var nuevoClienteModal = document.getElementById('nuevoClienteModal');
    var guardarClienteBtn = document.getElementById('guardarCliente');

    // Añadir el evento blur al campo de cédula para validar
    var cedulaInput = document.getElementById('cedula_cliente');
    cedulaInput.addEventListener('blur', function() {
        validarCedula(cedulaInput);
    });

    guardarClienteBtn.addEventListener('click', function() {
        var cedulaValida = cedulaInput.checkValidity();
        if (!cedulaValida) {
            alert('La cédula no es válida. Por favor, revise el campo de cédula.');
            return;
        }

        var formData = new FormData(document.getElementById('nuevoClienteForm'));
        fetch("{{ route('clientes.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Cliente creado con éxito.');

                    // Añadir el nuevo cliente a la lista
                    var selectCliente = document.querySelector('select[name="cliente_id"]');
                    var option = document.createElement('option');
                    option.value = data.cliente.cliente_id;
                    option.textContent = data.cliente.nombre_cliente + ' ' + data.cliente.apellido_cliente;
                    option.selected = true;
                    selectCliente.appendChild(option);

                    // Cerrar el modal
                    var modal = bootstrap.Modal.getInstance(nuevoClienteModal);
                    modal.hide();

                    // Limpiar el formulario
                    document.getElementById('nuevoClienteForm').reset();
                } else {
                    alert('Hubo un error al crear el cliente.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al procesar la solicitud.');
            });
    });
});

function validarCedula(input) {
    const cedula = input.value;
    let mensaje = '';
    if (cedula.length !== 10) {
        mensaje = "La cédula debe tener 10 dígitos.";
    } else {
        const coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];
        const digitos = cedula.split('').map(Number);
        const verificador = digitos.pop();
        const provincia = parseInt(cedula.substring(0, 2), 10);
        if (provincia < 1 || provincia > 24) {
            mensaje = "La provincia de la cédula no es válida.";
        } else {
            let suma = 0;
            for (let i = 0; i < digitos.length; i++) {
                let multiplicacion = digitos[i] * coeficientes[i];
                if (multiplicacion >= 10) {
                    multiplicacion -= 9;
                }
                suma += multiplicacion;
            }
            const digitoCalculado = (10 - (suma % 10)) % 10;
            if (digitoCalculado !== verificador) {
                mensaje = "La cédula no es válida.";
            }
        }
    }

    input.setCustomValidity(mensaje);
    var errorElement = document.getElementById('error-' + input.id);
    if (!errorElement) {
        errorElement = document.createElement('div');
        errorElement.id = 'error-' + input.id;
        errorElement.style.color = 'red';
        input.parentNode.appendChild(errorElement);
    }
    errorElement.innerText = mensaje;
}

</script>


@endsection
