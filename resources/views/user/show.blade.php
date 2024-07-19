@extends('tablar::page')

@section('title', 'View User')

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
                        {{ __('Usuario ') }}
                    </h2>
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
                            <h3 class="card-title">Detalles de usuario</h3>
                        </div>
                        <div class="card-body">
                            @if($user)
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Nombre:</th>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Correo electrónico:</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Roles:</th>
                                            <td>
                                                @if($roles->isNotEmpty())
                                                    <ol>
                                                        @foreach($roles as $role)
                                                            <li>{{ $role->name }}</li>
                                                        @endforeach
                                                    </ol>
                                                @else
                                                    <p>No tiene roles asignados.</p>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <p>Usuario no encontrado.</p>
                            @endif
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('home') }}" class="btn btn-secondary">Volver</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger">Salir</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
