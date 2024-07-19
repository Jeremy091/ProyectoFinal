@extends('tablar::page')

@section('title', 'View Compra')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        View
                    </div>
                    <h2 class="page-title">
                        {{ __('Compra ') }}
                    </h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('compras.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Compra List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    @if (config('tablar', 'display_alert'))
                        @include('tablar::common.alert')
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Compra Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="form-label"><strong>Fecha Compra:</strong></label>
                                <div class="form-control">{{ $compra->fecha_compra }}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><strong>Proveedor:</strong></label>
                                <div class="form-control">{{ $compra->proveedor->nombre_proveedor }}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><strong>Subtotal:</strong></label>
                                <div class="form-control">{{ $compra->subtotal }}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><strong>Impuesto:</strong></label>
                                <div class="form-control">{{ $compra->impuesto }}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><strong>Total Compra:</strong></label>
                                <div class="form-control">{{ $compra->total_compra }}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><strong>Metodo Pago:</strong></label>
                                <div class="form-control">{{ $compra->metodo_pago }}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><strong>Estado:</strong></label>
                                <div class="form-control">{{ $compra->estado }}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><strong>Productos:</strong></label>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio Compra</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($compra->productos as $producto)
                                                <tr>
                                                    <td>{{ $producto->nombre_producto }}</td>
                                                    <td>{{ $producto->pivot->cantidad }}</td>
                                                    <td>{{ number_format($producto->pivot->precio_compra, 2) }}</td>
                                                    <td>{{ number_format($producto->pivot->cantidad * $producto->pivot->precio_compra, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
