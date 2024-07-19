@extends('tablar::page')

@section('title', 'View Inventario')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Ver Inventario</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('inventarios.index') }}">Volver</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Stock</th>
                                <td>{{ $inventario->stock }}</td>
                            </tr>
                            <tr>
                                <th>Fecha Movimiento</th>
                                <td>{{ $inventario->fecha_movimiento }}</td>
                            </tr>
                            {{-- <tr>
                                <th>Tipo Movimiento</th>
                                <td>{{ $inventario->tipo_movimiento }}</td>
                            </tr> --}}
                            <tr>
                                <th>Producto</th>
                                <td>{{ $inventario->producto->nombre_producto }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
