@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Editar Perfil</h3>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')  {{-- Asegúrate de que el método sea POST si estás creando recursos, o PATCH/PUT si estás actualizando --}}

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $user->name) }}">
        </div>

        <div class="form-group">
            <label for="profile_photo">Foto de Perfil:</label>
            <input type="file" name="profile_photo" id="profile_photo" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
    </form>
</div>
@endsection
