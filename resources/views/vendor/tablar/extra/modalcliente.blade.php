<div class="modal fade" id="nuevoClienteModal" tabindex="-1" aria-labelledby="nuevoClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoClienteModalLabel">Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="nuevoClienteForm">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre_cliente" class="form-label">Nombre del Cliente</label>
                        <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required>
                        <div class="error-message text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_cliente" class="form-label">Apellido del Cliente</label>
                        <input type="text" class="form-control" id="apellido_cliente" name="apellido_cliente" required>
                        <div class="error-message text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="cedula_cliente" class="form-label">Cédula</label>
                        <input type="text" class="form-control" id="cedula_cliente" name="cedula_cliente" required>
                        <div class="error-message text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="direccion_cliente" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente" required>
                        <div class="error-message text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="telefono_cliente" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono_cliente" name="telefono_cliente" required>
                        <div class="error-message text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email_cliente" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_cliente" name="email_cliente" required>
                        <div class="error-message text-danger"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarCliente">Guardar</button>
            </div>
        </div>
    </div>
</div>
