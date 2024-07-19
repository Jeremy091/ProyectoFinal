@extends('tablar::page')

@section('title')
    Producto
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Lista
                    </div>
                    <h2 class="page-title">
                        {{ __('Producto ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('productos.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Crear Producto
                        </a>

                        <a href="{{ route('productos.pdf') }}" class="btn btn-secondary d-none d-sm-inline-block">
                            Exportar a PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if (config('tablar', 'display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Producto</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                
                                <div class="ms-auto text-muted">
                                    Buscar:
                                    <div class="ms-2 d-inline-block">
                                        <form action="{{ route('productos.index') }}" method="GET">
                                            <input type="text" name="search" class="form-control form-control-sm"
                                                aria-label="Search category" value="{{ request()->input('search') }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                       
                                        <th class="w-1">No.
                                            <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-sm text-dark icon-thick" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <polyline points="6 15 12 9 18 15" />
                                            </svg>
                                        </th>
                                        
                                        <th>Nombre Producto</th>
                                        <th>Descripcion Producto</th>
                                        <th>Precio Unitario</th>
                                        <th>Precio Compra</th>
                                        <th>Categoría</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($productos as $producto)
                                        <tr>
                                            
                                            <td>{{ ++$i }}</td>
                                            
                                            <td style="word-wrap: break-word; white-space: pre-wrap;">
                                                {{ $producto->nombre_producto }}</td>
                                            <td style="word-wrap: break-word; white-space: pre-wrap;">
                                                {{ $producto->descripcion_producto }}</td>
                                            <td style="word-wrap: break-word; white-space: pre-wrap;">
                                                {{ $producto->precio_unitario }}</td>
                                            <td style="word-wrap: break-word; white-space: pre-wrap;">
                                                {{ $producto->precio_compra }}</td>
                                            <td style="word-wrap: break-word; white-space: pre-wrap;">
                                                {{ $producto->categoria->nombre_categoria }}</td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                            Comportamiento
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            @can('view.products')
                                                            <a class="dropdown-item"
                                                                href="{{ route('productos.show', $producto->producto_id) }}">
                                                                Vista
                                                            </a>
                                                            @endcan
                                                            @can('edit.products')
                                                            <a class="dropdown-item"
                                                                href="{{ route('productos.edit', $producto->producto_id) }}">
                                                                Editar
                                                            </a>
                                                            @endcan
                                                            @can('delete.products')
                                                            <form
                                                                action="{{ route('productos.destroy', $producto->producto_id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    onclick="if(!confirm('Do you Want to Proceed?')){return false;}"
                                                                    class="dropdown-item text-red"><i
                                                                        class="fa fa-fw fa-trash"></i>
                                                                    Borrar
                                                                </button>
                                                            </form>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <td>Datos no encontrados</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {!! $productos->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
