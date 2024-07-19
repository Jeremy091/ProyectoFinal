<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('nombre_cliente') }}</label>
    <div>
        {{ Form::text('nombre_cliente', $cliente->nombre_cliente, [
            'class' => 'form-control' . ($errors->has('nombre_cliente') ? ' is-invalid' : ''),
            'placeholder' => 'Nombre Cliente',
        ]) }}
        <div class="invalid-feedback" id="error-nombre_cliente"></div>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('apellido_cliente') }}</label>
    <div>
        {{ Form::text('apellido_cliente', $cliente->apellido_cliente, [
            'class' => 'form-control' . ($errors->has('apellido_cliente') ? ' is-invalid' : ''),
            'placeholder' => 'Apellido Cliente',
        ]) }}
        <div class="invalid-feedback" id="error-apellido_cliente"></div>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('direccion_cliente') }}</label>
    <div>
        {{ Form::text('direccion_cliente', $cliente->direccion_cliente, [
            'class' => 'form-control' . ($errors->has('direccion_cliente') ? ' is-invalid' : ''),
            'placeholder' => 'Direccion Cliente',
        ]) }}
        <div class="invalid-feedback" id="error-direccion_cliente"></div>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('telefono_cliente') }}</label>
    <div>
        {{ Form::text('telefono_cliente', $cliente->telefono_cliente, [
            'class' => 'form-control' . ($errors->has('telefono_cliente') ? ' is-invalid' : ''),
            'placeholder' => 'Telefono Cliente',
        ]) }}
        <div class="invalid-feedback" id="error-telefono_cliente"></div>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('email_cliente') }}</label>
    <div>
        {{ Form::text('email_cliente', $cliente->email_cliente, [
            'class' => 'form-control' . ($errors->has('email_cliente') ? ' is-invalid' : ''),
            'placeholder' => 'Email Cliente',
        ]) }}
        <div class="invalid-feedback" id="error-email_cliente"></div>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('cedula_cliente') }}</label>
    <div>
        {{ Form::text('cedula_cliente', $cliente->cedula_cliente, [
            'class' => 'form-control' . ($errors->has('cedula_cliente') ? ' is-invalid' : ''),
            'placeholder' => 'Cédula Cliente',
            'oninput' => 'validarCedula(this)'
        ]) }}
        <div class="invalid-feedback" id="error-cedula_cliente"></div>
    </div>
</div>
<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('clientes.index') }}" class="btn btn-danger" id="btn-cancelar">Cancelar</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit" onclick="return validarFormulario()">Guardar</button>
        </div>
    </div>
</div>

<script>
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
    document.getElementById('error-' + input.id).innerText = mensaje;
}

function validarFormulario() {
    const inputs = document.querySelectorAll('.form-control');
    let formValid = true;

    inputs.forEach(input => {
        if (!input.checkValidity()) {
            formValid = false;
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    });

    return formValid;
}
</script>
