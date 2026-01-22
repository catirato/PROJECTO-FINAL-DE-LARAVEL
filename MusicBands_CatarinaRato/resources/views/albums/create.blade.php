@extends('layouts.app')

@section('title', 'Novo Álbum')

@section('content')

<h1>Novo Álbum – {{ $band->name }}</h1>

<form method="POST" action="{{ route('albums.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="band_id" value="{{ $band->id }}">

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Imagem</label>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="mb-3">
        <label>Ano de Lançamento</label>
        <input type="number" name="release_year" class="form-control" min="1900" max="{{ date('Y') }}">
    </div>

    <button class="btn btn-success">Guardar</button>
</form>

@endsection
