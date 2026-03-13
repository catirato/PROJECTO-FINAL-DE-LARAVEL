@extends('layouts.app')

@section('title', 'Nova Banda')

@section('content')

<h1>Nova Banda</h1>

<form method="POST" action="{{ route('bands.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Foto</label>
        <input type="file" name="photo" class="form-control">
    </div>

    <button class="btn btn-success">Guardar</button>
</form>

@endsection
