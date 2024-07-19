<!-- Modal -->
<div class="modal fade" id="nuevoProveedorModal" tabindex="-1" aria-labelledby="nuevoProveedorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoProveedorModalLabel">Nuevo Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="nuevoProveedorForm">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre_proveedor" class="form-label">Nombre del Proveedor</label>
                        <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion_proveedor" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion_proveedor" name="direccion_proveedor"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono_proveedor" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono_proveedor" name="telefono_proveedor"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="email_proveedor" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_proveedor" name="email_proveedor" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarProveedor">Guardar</button>
            </div>
        </div>
    </div>
</div>
