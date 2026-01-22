@extends('layouts.app')

@section('title', 'Editar Banda')

@section('content')

<h1>Editar Banda</h1>

<form method="POST" action="{{ route('bands.update', $band) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="name" value="{{ $band->name }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Foto</label>
        <input type="file" name="photo" class="form-control">
    </div>

    <button class="btn btn-success">Guardar</button>
</form>

@endsection
