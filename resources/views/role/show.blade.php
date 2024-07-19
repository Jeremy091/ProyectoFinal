@extends('tablar::page')

@section('title', 'View Role')

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
                        {{ __('Role ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('roles.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Lista de roles
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
                    @if (config('tablar', 'display_alert'))
                        @include('tablar::common.alert')
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalles del rol</h3>
                        </div>
                        <div class="card-body">

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Detalles del Rol</h5>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Nombre del Rol:</label>
                                        <div class="col-sm-9">
                                            <p class="form-control-plaintext">{{ $role->name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 col-form-label ">Descripción del Rol:</label>
                                        <div class="col-sm-9">
                                            <p class="form-control-plaintext">{{ $role->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <strong class="pt-3" style="font-size: 1.2em;">Permisos Asociados:</strong>
                                <div class="row pt-3 pb-3">
                                    @foreach ($role->permissions as $permission)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="permission-{{ $permission->id }}" name="permissions[]"
                                                    value="{{ $permission->id }}"{{ in_array($permission->id, $rolePermissions) ? ' checked' : '' }}>
                                                <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                    {{ $permission->description }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
