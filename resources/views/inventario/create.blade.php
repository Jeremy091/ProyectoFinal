@extends('tablar::page')

@section('title', 'Create Inventario')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Crear
                    </div>
                    <h2 class="page-title">
                        {{ __('Inventario ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('inventarios.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Lista de inventario
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if(config('tablar','display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalles del inventario</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('inventarios.store') }}" id="ajaxForm" role="form"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label">Stock</label>
                                    <div>
                                        <input type="number" name="stock" class="form-control" placeholder="Stock">
                                        @if ($errors->has('stock'))
                                            <div class="invalid-feedback">{{ $errors->first('stock') }}</div>
                                        @endif
                                        <small class="form-hint">Enter the stock amount.</small>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Fecha Movimiento</label>
                                    <div>
                                        <input type="date" name="fecha_movimiento" class="form-control" placeholder="Fecha Movimiento">
                                        @if ($errors->has('fecha_movimiento'))
                                            <div class="invalid-feedback">{{ $errors->first('fecha_movimiento') }}</div>
                                        @endif
                                        <small class="form-hint">Enter the date of movement.</small>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Tipo Movimiento</label>
                                    <div>
                                        <input type="text" name="tipo_movimiento" class="form-control" placeholder="Tipo Movimiento">
                                        @if ($errors->has('tipo_movimiento'))
                                            <div class="invalid-feedback">{{ $errors->first('tipo_movimiento') }}</div>
                                        @endif
                                        <small class="form-hint">Enter the type of movement.</small>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Producto</label>
                                    <div>
                                        <select name="producto_id" class="form-control">
                                            @foreach($productos as $producto)
                                                <option value="{{ $producto->producto_id }}">{{ $producto->nombre_producto }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('producto_id'))
                                            <div class="invalid-feedback">{{ $errors->first('producto_id') }}</div>
                                        @endif
                                        <small class="form-hint">Select the product.</small>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="text-end">
                                        <div class="d-flex">
                                            <a href="{{ route('inventarios.index') }}" class="btn btn-danger">Cancelar</a>
                                            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Entregar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

