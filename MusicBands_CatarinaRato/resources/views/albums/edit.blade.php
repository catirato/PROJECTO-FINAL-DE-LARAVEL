@extends('layouts.app')

@section('title', 'Editar Álbum')

@section('content')

<h1>Editar Álbum</h1>

<form method="POST" action="{{ route('albums.update', $album) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="title" value="{{ $album->title }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Imagem</label>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="mb-3">
        <label>Ano</label>
        <input type="number" name="release_year" value="{{ $album->release_year }}" class="form-control">
    </div>

    <button class="btn btn-success">Guardar</button>
</form>

@endsection
