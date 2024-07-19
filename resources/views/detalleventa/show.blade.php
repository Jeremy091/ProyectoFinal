@extends('tablar::page')

@section('title', 'View Detalleventa')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Vista
                    </div>
                    <h2 class="page-title">
                        {{ __('Detalleventa ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('detalleventas.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Lista Detalle Venta 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    @if(config('tablar','display_alert'))
                        @include('tablar::common.alert')
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalle de venta</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="form-label"><strong>Detalleventa Id:</strong></label>
                                <div class="form-control">{{ $detalleventa->detalleventa_id }}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><strong>Precio Venta Unidad:</strong></label>
                                <div class="form-control">{{ $detalleventa->precio_venta_unidad }}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><strong>Descuento:</strong></label>
                                <div class="form-control">{{ $detalleventa->descuento }}</div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><strong>Impuesto:</strong></label>
                                <div class="form-control">{{ $detalleventa->impuesto }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
